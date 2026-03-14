<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\TestSession;
use App\Models\TestResult;
use App\Services\AssessmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    protected $assessmentService;

    public function __construct(AssessmentService $assessmentService)
    {
        $this->assessmentService = $assessmentService;
    }

    public function showTest(Request $request)
    {
        $user = Auth::user();

        // 1. Check Admin Role - Bypass profile completion
        if ($user->role === 'admin') {
            return redirect('/admin');
        }

        // 2. Check Profile Completeness
        if (!$user->isProfileComplete()) {
            return view('student.complete-profile', [
                'user' => $user
            ]);
        }

        // 3. Get or Create Session
        $session = TestSession::where('user_id', $user->id)
            ->where('status', 'in_progress')
            ->first();

        if (!$session) {
            // Check if already has a result
            $existingResult = TestResult::whereHas('testSession', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })->first();

            if ($existingResult) {
                return redirect()->route('student.result', $existingResult->id);
            }

            // Create new session
            $session = TestSession::create([
                'user_id' => $user->id,
                'status' => 'in_progress',
                'started_at' => now(),
            ]);
        }

        // 4. Handle Step Navigation
        $totalQuestions = Question::count();
        $answers = $request->session()->get('test_answers', []);
        $currentQuestionIndex = count($answers);

        if ($currentQuestionIndex >= $totalQuestions) {
            return $this->processResults($session, $answers);
        }

        $question = Question::with('options')->skip($currentQuestionIndex)->first();

        if (!$question) {
            return $this->processResults($session, $answers);
        }

        // Store current question ID in session for submission
        $request->session()->put('current_question_id', $question->id);

        return view('student.test', [
            'question' => $question,
            'currentStep' => $currentQuestionIndex + 1,
            'totalSteps' => $totalQuestions,
            'session' => $session
        ]);
    }

    public function submitAnswer(Request $request)
    {
        $request->validate([
            'option_id' => 'required|exists:options,id'
        ]);

        $questionId = $request->session()->get('current_question_id');
        $answers = $request->session()->get('test_answers', []);
        $answers[$questionId] = $request->option_id;
        $request->session()->put('test_answers', $answers);

        return redirect()->route('tes');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'address' => 'required|string',
            'pob' => 'required|string|max:255',
            'dob' => 'required|date',
            'current_school' => 'required|string|max:255',
            'nisn' => 'required|string|max:255',
        ]);

        $user->update($validated);

        return redirect()->route('tes');
    }

    protected function processResults($session, $answers)
    {
        // Calculate scores using service
        $scores = $this->assessmentService->calculateScores($answers);
        $recommendationData = $this->assessmentService->getRecommendation($scores, null);

        $result = TestResult::create([
            'test_session_id' => $session->id,
            'score_r' => $scores['R'],
            'score_i' => $scores['I'],
            'score_a' => $scores['A'],
            'score_s' => $scores['S'],
            'score_e' => $scores['E'],
            'score_c' => $scores['C'],
            'recommendation' => $recommendationData['recommendation'],
            'final_reasoning' => $recommendationData['reasoning'],
        ]);

        $session->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        // Clear session answers
        session()->forget('test_answers');

        return redirect()->route('student.result', $result->id);
    }

    public function showResult(TestResult $result)
    {
        // Ensure user can only see their own result (or is admin)
        if ($result->testSession->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }

        return view('student.result', [
            'result' => $result
        ]);
    }
}

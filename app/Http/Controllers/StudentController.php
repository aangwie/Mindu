<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\TestSession;
use App\Models\TestResult;
use App\Models\Setting;
use App\Services\AssessmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    protected $assessmentService;

    public function __construct(AssessmentService $assessmentService)
    {
        $this->assessmentService = $assessmentService;
    }

    public function dashboard()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect('/admin');
        }

        $totalTests = TestResult::whereHas('testSession', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->count();

        $lastResult = TestResult::whereHas('testSession', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->with('testSession')->latest()->first();

        $hasTestInProgress = TestSession::where('user_id', $user->id)
            ->where('status', 'in_progress')
            ->exists();

        return view('student.dashboard', compact('user', 'totalTests', 'lastResult', 'hasTestInProgress'));
    }

    public function showTest(Request $request, $question_number = null)
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect('/admin');
        }

        if (!$user->isProfileComplete()) {
            return view('student.complete-profile', ['user' => $user]);
        }

        $session = TestSession::where('user_id', $user->id)
            ->where('status', 'in_progress')
            ->first();

        if (!$session) {
            $session = TestSession::create([
                'user_id' => $user->id,
                'status' => 'in_progress',
                'started_at' => now(),
            ]);
            // Clear any old answers if starting fresh without session
            $request->session()->forget('test_answers');
        }

        $totalQuestions = Question::count();
        $answers = $request->session()->get('test_answers', []);
        
        // Handle Question Ordering
        $order = Setting::get('question_order', 'ordered');
        $questionsQuery = Question::with('options');
        
        if ($order === 'random') {
            // For randomization, we should probably store the order in the session if we want to support the navigation board
            // But let's try a simpler approach if we just want random order for the session.
            // Better: Store the randomized IDs in session if not exists
            if (!$request->session()->has('random_question_ids')) {
                $ids = Question::pluck('id')->shuffle()->toArray();
                $request->session()->put('random_question_ids', $ids);
            }
            $randomIds = $request->session()->get('random_question_ids');
            
            // If question count changed, reset
            if (count($randomIds) !== $totalQuestions) {
                $randomIds = Question::pluck('id')->shuffle()->toArray();
                $request->session()->put('random_question_ids', $randomIds);
            }
        }

        // Current Question Logic
        $currentQuestionIndex = $question_number ? (int)$question_number - 1 : 0;
        if ($currentQuestionIndex < 0) $currentQuestionIndex = 0;
        if ($currentQuestionIndex >= $totalQuestions) $currentQuestionIndex = $totalQuestions - 1;

        if ($order === 'random') {
            $randomIds = $request->session()->get('random_question_ids');
            $questionId = $randomIds[$currentQuestionIndex];
            $question = Question::with('options')->find($questionId);
        } else {
            $question = Question::with('options')->orderBy('id', 'asc')->skip($currentQuestionIndex)->first();
        }

        if (!$question) {
            return redirect()->route('student.history')->with('error', 'Soal tidak ditemukan.');
        }

        $request->session()->put('current_question_id', $question->id);
        $request->session()->put('current_question_number', $currentQuestionIndex + 1);

        return view('student.test', [
            'question' => $question,
            'currentStep' => $currentQuestionIndex + 1,
            'totalSteps' => $totalQuestions,
            'session' => $session,
            'answers' => $answers,
            'randomIds' => $order === 'random' ? $request->session()->get('random_question_ids') : null
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

        $currentNumber = $request->session()->get('current_question_number');
        $totalQuestions = Question::count();

        if ($request->has('finish')) {
            // Check if all answered
            if (count($answers) < $totalQuestions) {
                 return redirect()->route('tes', $currentNumber)->with('error', 'Harap jawab semua soal sebelum menyelesaikan tes.');
            }
            
            $session = TestSession::where('user_id', Auth::id())
                ->where('status', 'in_progress')
                ->first();
                
            return $this->processResults($session, $answers);
        }

        // Auto move to next if exists
        if ($currentNumber < $totalQuestions) {
            return redirect()->route('tes', $currentNumber + 1);
        }

        return redirect()->route('tes', $currentNumber);
    }

    public function resetTest()
    {
        $user = Auth::user();
        TestSession::where('user_id', $user->id)->where('status', 'in_progress')->update(['status' => 'cancelled']);
        session()->forget(['test_answers', 'random_question_ids', 'current_question_id', 'current_question_number']);
        return redirect()->route('tes');
    }

    public function history()
    {
        $user = Auth::user();
        $results = TestResult::whereHas('testSession', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->with('testSession')->latest()->get();

        return view('student.history', compact('results'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('student.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'full_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'required|string',
            'pob' => 'required|string|max:255',
            'dob' => 'required|date',
            'current_school' => 'required|string|max:255',
            'school_origin' => 'required|string|max:255',
            'nisn' => 'required|string|max:255',
            'password' => 'nullable|min:8|confirmed',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui.');
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

        // Attach recommended majors with rank and match score
        if (!empty($recommendationData['recommended_majors'])) {
            foreach ($recommendationData['recommended_majors'] as $index => $majorData) {
                $result->majors()->attach($majorData['major_id'], [
                    'rank' => $index + 1,
                    'match_score' => $majorData['match_score'],
                ]);
            }
        }

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

        $result->load('majors');

        return view('student.result', [
            'result' => $result,
            'recommendationDetails' => $result->getRecommendationDetails(),
        ]);
    }
}

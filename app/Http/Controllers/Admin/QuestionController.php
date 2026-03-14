<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('options')->latest()->paginate(10);
        return view('admin.questions.index', compact('questions'));
    }

    public function create()
    {
        return view('admin.questions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'category' => 'required|in:R,I,A,S,E,C',
            'options' => 'required|array|min:5|max:5',
            'options.*.text' => 'required|string',
            'options.*.point' => 'required|integer|min:1|max:5',
        ]);

        $question = Question::create([
            'question_text' => $validated['question_text'],
            'category' => $validated['category'],
        ]);

        foreach ($validated['options'] as $optionData) {
            $question->options()->create([
                'option_text' => $optionData['text'],
                'point' => $optionData['point'],
            ]);
        }

        return redirect()->route('admin.questions.index')->with('success', 'Soal berhasil ditambahkan.');
    }

    public function edit(Question $question)
    {
        $question->load('options');
        return view('admin.questions.edit', compact('question'));
    }

    public function update(Request $request, Question $question)
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'category' => 'required|in:R,I,A,S,E,C',
            'options' => 'required|array|min:5|max:5',
            'options.*.id' => 'required|exists:options,id',
            'options.*.text' => 'required|string',
            'options.*.point' => 'required|integer|min:1|max:5',
        ]);

        $question->update([
            'question_text' => $validated['question_text'],
            'category' => $validated['category'],
        ]);

        foreach ($validated['options'] as $optionData) {
            Option::find($optionData['id'])->update([
                'option_text' => $optionData['text'],
                'point' => $optionData['point'],
            ]);
        }

        return redirect()->route('admin.questions.index')->with('success', 'Soal berhasil diperbarui.');
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('admin.questions.index')->with('success', 'Soal berhasil dihapus.');
    }
}

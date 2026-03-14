<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestResult;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        $results = TestResult::with('testSession.user')->latest()->paginate(10);
        return view('admin.results.index', compact('results'));
    }

    public function destroy(TestResult $result)
    {
        $result->delete();
        return redirect()->route('admin.results.index')->with('success', 'Hasil tes berhasil dihapus.');
    }
}

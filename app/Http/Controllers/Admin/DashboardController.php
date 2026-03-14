<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TestSession;
use App\Models\TestResult;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = User::where('role', 'student')->count();
        $completedTests = TestSession::where('status', 'completed')->count();
        
        $smaCount = TestResult::where('recommendation', 'SMA')->count();
        $smkCount = TestResult::where('recommendation', 'SMK')->count();

        return view('admin.dashboard', compact('totalStudents', 'completedTests', 'smaCount', 'smkCount'));
    }
}

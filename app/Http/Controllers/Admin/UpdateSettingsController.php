<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class UpdateSettingsController extends Controller
{
    public function index()
    {
        $githubToken = Setting::get('github_token');
        return view('admin.update-settings', compact('githubToken'));
    }

    public function updateToken(Request $request)
    {
        $request->validate([
            'github_token' => ['required', 'string', 'regex:/^github_pat_[a-zA-Z0-9_]+$/'],
        ], [
            'github_token.regex' => 'Format token harus github_pat_xxxx (boleh menyertakan angka, huruf, dan underscore)',
        ]);

        Setting::set('github_token', $request->github_token);

        return back()->with('success', 'Token GitHub berhasil disimpan.');
    }

    public function clearCache()
    {
        try {
            Artisan::call('cache:clear');
            Artisan::call('view:clear');
            Artisan::call('route:clear');
            return response()->json(['status' => 'success', 'message' => 'Cache berhasil dibersihkan.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function clearConfig()
    {
        try {
            Artisan::call('config:clear');
            return response()->json(['status' => 'success', 'message' => 'Konfigurasi berhasil dibersihkan.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function runUpdate()
    {
        // This is a placeholder for the actual update logic via Github
        // For now, we'll just simulate some output
        $output = "Checking for updates...\n";
        $output .= "Fetching from origin...\n";
        $output .= "Already up to date.\n";
        
        return response()->json(['status' => 'success', 'output' => $output]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function edit()
    {
        $admin = Auth::user();
        $site_logo = Setting::get('site_logo');
        $site_favicon = Setting::get('site_favicon');
        $site_address = Setting::get('site_address');
        $question_order = Setting::get('question_order', 'ordered');

        // SMTP Settings
        $smtp = [
            'mail_host' => Setting::get('mail_host'),
            'mail_port' => Setting::get('mail_port'),
            'mail_username' => Setting::get('mail_username'),
            'mail_password' => Setting::get('mail_password'),
            'mail_encryption' => Setting::get('mail_encryption'),
            'mail_from_address' => Setting::get('mail_from_address'),
            'mail_from_name' => Setting::get('mail_from_name'),
        ];

        return view('admin.settings', compact('admin', 'site_logo', 'site_favicon', 'site_address', 'smtp', 'question_order'));
    }

    public function update(Request $request)
    {
        $admin = Auth::user();

        $validated = $request->validate([
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'password' => 'nullable|min:8|confirmed',
            'site_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:800',
            'site_favicon' => 'nullable|string',
            'site_address' => 'required|string',
            'question_order' => 'required|in:ordered,random',
            // SMTP Validation
            'mail_host' => 'nullable|string',
            'mail_port' => 'nullable|string',
            'mail_username' => 'nullable|string',
            'mail_password' => 'nullable|string',
            'mail_encryption' => 'nullable|string',
            'mail_from_address' => 'nullable|email',
            'mail_from_name' => 'nullable|string',
        ]);

        // Update Site Settings
        if ($request->hasFile('site_logo')) {
            $file = $request->file('site_logo');
            $imageData = base64_encode(file_get_contents($file->getRealPath()));
            $base64 = 'data:' . $file->getMimeType() . ';base64,' . $imageData;
            Setting::set('site_logo', $base64);
        }
        
        Setting::set('site_favicon', $validated['site_favicon'] ?? '');
        Setting::set('site_address', $validated['site_address']);
        Setting::set('question_order', $validated['question_order']);

        // Update SMTP Settings
        Setting::set('mail_host', $validated['mail_host'] ?? '');
        Setting::set('mail_port', $validated['mail_port'] ?? '');
        Setting::set('mail_username', $validated['mail_username'] ?? '');
        Setting::set('mail_password', $validated['mail_password'] ?? '');
        Setting::set('mail_encryption', $validated['mail_encryption'] ?? '');
        Setting::set('mail_from_address', $validated['mail_from_address'] ?? '');
        Setting::set('mail_from_name', $validated['mail_from_name'] ?? '');

        // Update Admin Profile
        $admin->email = $validated['email'];
        if ($request->filled('password')) {
            $admin->password = Hash::make($validated['password']);
        }
        $admin->save();

        return redirect()->route('admin.settings.edit')->with('success', 'Pengaturan berhasil diperbarui.');
    }

    public function tcEdit()
    {
        $about_us = Setting::get('about_us', '');
        $terms_conditions = Setting::get('terms_conditions', '');

        return view('admin.tc', compact('about_us', 'terms_conditions'));
    }

    public function tcUpdate(Request $request)
    {
        $validated = $request->validate([
            'about_us' => 'nullable|string',
            'terms_conditions' => 'nullable|string',
        ]);

        Setting::set('about_us', $validated['about_us'] ?? '');
        Setting::set('terms_conditions', $validated['terms_conditions'] ?? '');

        return redirect()->route('admin.tc.edit')->with('success', 'Konten T&C berhasil diperbarui.');
    }
}

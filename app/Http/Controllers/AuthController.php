<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            if (!Auth::user()->is_active) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun Anda belum aktif. Silakan cek email untuk aktivasi.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin');
            }

            return redirect()->intended('/tes');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'full_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'required|string',
            'pob' => 'required|string|max:255',
            'dob' => 'required|date',
            'current_school' => 'required|string|max:255',
            'school_origin' => 'required|string|max:255',
            'nisn' => 'required|string|max:255',
        ]);

        $token = \Illuminate\Support\Str::random(64);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'full_name' => $validated['full_name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'pob' => $validated['pob'],
            'dob' => $validated['dob'],
            'current_school' => $validated['current_school'],
            'school_origin' => $validated['school_origin'],
            'nisn' => $validated['nisn'],
            'role' => 'student',
            'is_active' => false,
            'activation_token' => $token,
        ]);

        try {
            $this->configureMail();
            \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\ActivationMail($user, $token));
            return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan cek email Anda untuk mengaktifkan akun.');
        } catch (\Exception $e) {
            // If mail fails, user is still created but inactive. Better to show error.
            return redirect()->route('login')->with('success', 'Registrasi berhasil! Namun gagal mengirim email aktivasi. Silakan hubungi admin. Error: ' . $e->getMessage());
        }
    }

    public function activate($token)
    {
        $user = User::where('activation_token', $token)->first();

        if (!$user) {
            return redirect()->route('login')->withErrors(['email' => 'Token aktivasi tidak valid.']);
        }

        $user->is_active = true;
        $user->activation_token = null;
        $user->save();

        return redirect()->route('login')->with('success', 'Akun berhasil diaktifkan! Silakan login.');
    }

    private function configureMail()
    {
        $settings = \App\Models\Setting::all()->pluck('value', 'key');
        
        config([
            'mail.mailers.smtp.host' => $settings['mail_host'] ?? config('mail.mailers.smtp.host'),
            'mail.mailers.smtp.port' => $settings['mail_port'] ?? config('mail.mailers.smtp.port'),
            'mail.mailers.smtp.username' => $settings['mail_username'] ?? config('mail.mailers.smtp.username'),
            'mail.mailers.smtp.password' => $settings['mail_password'] ?? config('mail.mailers.smtp.password'),
            'mail.mailers.smtp.encryption' => $settings['mail_encryption'] ?? config('mail.mailers.smtp.encryption'),
            'mail.from.address' => $settings['mail_from_address'] ?? config('mail.from.address'),
            'mail.from.name' => $settings['mail_from_name'] ?? config('mail.from.name'),
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

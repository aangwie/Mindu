<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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

            return redirect()->intended('/dashboard');
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
            'is_active' => true,
            'activation_token' => $token,
        ]);

        try {
            $this->configureMail();
            Mail::to($user->email)->send(new \App\Mail\ActivationMail($user, $token));
            return redirect()->route('verification.notice')->with('email', $user->email);
        }
        catch (\Exception $e) {
            return redirect()->route('verification.notice')->with([
                'email' => $user->email,
                'error' => 'Gagal mengirim email aktivasi: ' . $e->getMessage()
            ]);
        }
    }

    public function showVerifyEmail()
    {
        $email = session('email');
        if (!$email)
            return redirect()->route('login');
        return view('auth.verify-email', compact('email'));
    }

    public function resendActivation(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->where('is_active', false)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User tidak ditemukan atau sudah aktif.']);
        }

        // Keep old token or generate new? Let's use the one in DB.
        $token = $user->activation_token;
        if (!$token) {
            $token = Str::random(64);
            $user->activation_token = $token;
            $user->save();
        }

        try {
            $this->configureMail();
            Mail::to($user->email)->send(new \App\Mail\ActivationMail($user, $token));
            return back()->with('success', 'Email aktivasi telah dikirim ulang.');
        }
        catch (\Exception $e) {
            return back()->withErrors(['email' => 'Gagal mengirim email: ' . $e->getMessage()]);
        }
    }

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
        ['email' => $request->email],
        ['token' => $token, 'created_at' => now()]
        );

        try {
            $this->configureMail();
            Mail::to($request->email)->send(new \App\Mail\ResetPasswordMail($token, $request->email));
            return back()->with('success', 'Tautan reset password telah dikirim ke email Anda.');
        }
        catch (\Exception $e) {
            return back()->withErrors(['email' => 'Gagal mengirim email: ' . $e->getMessage()]);
        }
    }

    public function showResetPassword(Request $request, $token)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $reset = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$reset) {
            return back()->withErrors(['email' => 'Token reset tidak valid atau sudah kedaluwarsa.']);
        }

        // Check expiry (1 hour)
        $createdAt = \Illuminate\Support\Carbon::parse($reset->created_at);
        if (now()->diffInMinutes($createdAt) > 60) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return back()->withErrors(['email' => 'Token reset sudah kedaluwarsa.']);
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Password berhasil diubah. Silakan login.');
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

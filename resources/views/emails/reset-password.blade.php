<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body style="font-family: sans-serif; line-height: 1.6; color: #334155; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background-color: #ffffff; padding: 40px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);">
        <h2 style="color: #2563eb; margin-bottom: 24px;">Reset Password Anda</h2>
        <p>Halo,</p>
        <p>Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda.</p>
        <div style="text-align: center; margin: 40px 0;">
            <a href="{{ route('password.reset', ['token' => $token, 'email' => $email]) }}" 
               style="background-color: #2563eb; color: #ffffff; padding: 12px 32px; border-radius: 8px; text-decoration: none; font-weight: bold; display: inline-block;">
                Reset Password
            </a>
        </div>
        <p>Jika Anda tidak merasa melakukan permintaan ini, silakan abaikan email ini.</p>
        <p>Tautan ini akan kedaluwarsa dalam 60 menit.</p>
        <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 32px 0;">
        <p style="font-size: 12px; color: #64748b;">Jika tombol di atas tidak berfungsi, salin dan tempel URL berikut ke browser Anda:</p>
        <p style="font-size: 12px; color: #2563eb; word-break: break-all;">{{ route('password.reset', ['token' => $token, 'email' => $email]) }}</p>
    </div>
</body>
</html>

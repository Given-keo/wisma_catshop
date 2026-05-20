<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Sandi — Wisma CatShop</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #ff4a17;
            --primary-hover: #e63e0d;
            --bg-body: #f0f2f5;
            --text-main: #1a1d23;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-container {
            width: 100%;
            max-width: 1100px;
            background: white;
            overflow: hidden;
            display: flex;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
        }

        /* Hero Section */
        .auth-hero {
            flex: 1.2;
            background: var(--primary-color);
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
        }

        /* Form Section */
        .auth-form-section {
            flex: 1;
            padding: 50px 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-header h2 { font-weight: 800; color: var(--text-main); margin-bottom: 8px; }
        .form-header p { color: var(--text-muted); margin-bottom: 30px; }

        .input-group-custom { margin-bottom: 18px; }
        .input-group-custom label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 6px;
        }

        .input-wrapper { position: relative; display: flex; align-items: center; }
        .input-wrapper input {
            width: 100%;
            padding: 12px 16px 12px 45px;
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .input-wrapper input:focus {
            outline: none;
            border-color: var(--primary-color);
            background: white;
            box-shadow: 0 0 0 4px rgba(255, 74, 23, 0.1);
        }

        .input-icon { position: absolute; left: 16px; color: #94a3b8; display: flex; }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            margin-top: 10px;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }

        .error-msg { color: #dc3545; font-size: 0.75rem; margin-top: 5px; font-weight: 500; }

        @media (max-width: 992px) {
            .auth-hero { display: none; }
            .auth-container { max-width: 500px; border-radius: 16px; }
            .auth-form-section { padding: 40px 30px; }
        }
    </style>
</head>
<body>
    
<div class="auth-container">
    <!-- Hero Area Kiri -->
    <div class="auth-hero">
        <h2 style="font-size: 2.5rem; font-weight: 800;">Amankan Akun Anda.</h2>
        <p style="font-size: 1.1rem; opacity: 0.9;">Silakan buat kata sandi baru untuk kembali mengakses layanan Wisma CatShop.</p>
    </div>

    <!-- Area Form Kanan -->
    <div class="auth-form-section">
        <div class="form-header">
            <h2>Reset Kata Sandi</h2>
            <p>Masukkan email dan kata sandi baru Anda.</p>
        </div>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="input-group-custom">
                <label for="email">Alamat Email</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    </span>
                    <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" placeholder="email@anda.com">
                </div>
                @if($errors->has('email'))
                    <div class="error-msg">{{ $errors->first('email') }}</div>
                @endif
            </div>

            <!-- Password Baru -->
            <div class="input-group-custom">
                <label for="password">Kata Sandi Baru</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    </span>
                    <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Min. 8 karakter">
                </div>
                @if($errors->has('password'))
                    <div class="error-msg">{{ $errors->first('password') }}</div>
                @endif
            </div>

            <!-- Konfirmasi Password -->
            <div class="input-group-custom">
                <label for="password_confirmation">Konfirmasi Kata Sandi Baru</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                    </span>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi kata sandi">
                </div>
                @if($errors->has('password_confirmation'))
                    <div class="error-msg">{{ $errors->first('password_confirmation') }}</div>
                @endif
            </div>

            <button type="submit" class="btn-submit">Simpan Kata Sandi</button>
        </form>
    </div>
</div>

</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Daftar — Wisma CatShop</title>

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
            --glass-bg: rgba(255, 255, 255, 0.95);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body);
            background-image: 
                radial-gradient(at 0% 0%, rgba(255, 74, 23, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(255, 74, 23, 0.05) 0px, transparent 50%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-container {
            width: 100%;
            max-width: 1100px;
            background: var(--glass-bg);
            overflow: hidden;
            display: flex;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Hero Section (kiri) */
        .register-hero {
            flex: 1.2;
            background: var(--primary-color);
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .hero-text {
            font-size: 1.1rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        /* Form Section (kanan) */
        .register-form-section {
            flex: 1;
            padding: 50px 60px;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand-wrapper {
            margin-bottom: 30px;
        }

        .logo-circle {
            width: 60px;
            height: 60px;
            background: #fff;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }

        .logo-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .form-header h2 {
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .form-header p {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-bottom: 30px;
        }

        /* Input styling (sama persis dengan login) */
        .input-group-custom {
            margin-bottom: 20px;
            position: relative;
        }

        .input-group-custom label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper input {
            width: 100%;
            padding: 14px 16px 14px 45px;
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .input-wrapper input:focus {
            outline: none;
            background: white;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(255, 74, 23, 0.1);
        }

        .input-icon {
            position: absolute;
            left: 16px;
            color: #94a3b8;
            display: flex;
            align-items: center;
        }

        .btn-register {
            width: 100%;
            padding: 14px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 10px 15px -3px rgba(255, 74, 23, 0.3);
            margin-top: 10px;
        }

        .btn-register:hover {
            background: var(--primary-hover);
        }

        .error-msg {
            color: #dc3545;
            font-size: 0.75rem;
            margin-top: 5px;
            font-weight: 500;
        }

        /* Responsive Tablet (≤992px) */
        @media (max-width: 992px) {
            .register-hero {
                display: none;
            }
            .register-container {
                max-width: 500px;
            }
            .register-form-section {
                padding: 40px 30px;
            }
            .brand-wrapper {
                text-align: center;
            }
            .logo-circle {
                margin-left: auto;
                margin-right: auto;
            }
            .form-header {
                text-align: center;
            }
        }

        /* Mobile FULLSCREEN (≤576px) - sesuai gaya login */
        @media (max-width: 576px) {
            body {
                padding: 0;
            }
            .register-container {
                height: 100vh;
                max-width: 100%;
                border-radius: 0;
                box-shadow: none;
            }
            .register-form-section {
                justify-content: flex-start;
                padding-top: 60px;
                padding-bottom: 40px;
                overflow-y: auto;
            }
            .brand-wrapper {
                margin-bottom: 20px;
            }
            .form-header h2 {
                font-size: 1.75rem;
            }
            .btn-register {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>

@include('sweetalert::alert')

<div class="register-container">
    <div class="register-hero">
        <h2 class="hero-title">Mulai Petualangan Bersama Anabul</h2>
        <p class="hero-text">Daftar sekarang dan nikmati kemudahan grooming, produk berkualitas, serta layanan khusus untuk kucing kesayangan Anda.</p>
    </div>

    <!-- Form Kanan -->
    <div class="register-form-section">
        <!-- Optional Logo (seperti di login) -->
        <div class="brand-wrapper">
            <div class="logo-circle">
                <img src="{{ asset('template/assets/img/logo.jpeg') }}" alt="Wisma CatShop">
            </div>
        </div>

        <div class="form-header">
            <h2>Daftar Akun</h2>
            <p>Isi data diri Anda dengan benar.</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nama Lengkap -->
            <div class="input-group-custom">
                <label for="name">Nama Lengkap</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    </span>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Nama lengkap" required autofocus>
                </div>
                @if($errors->has('name'))
                    <div class="error-msg">{{ $errors->first('name') }}</div>
                @endif
            </div>

            <!-- Email -->
            <div class="input-group-custom">
                <label for="email">Alamat Email</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    </span>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="nama@gmail.com" required>
                </div>
                @if($errors->has('email'))
                    <div class="error-msg">{{ $errors->first('email') }}</div>
                @endif
            </div>

            <!-- WhatsApp -->
            <div class="input-group-custom">
                <label for="whatsapp">Nomor WhatsApp</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                    </span>
                    <input id="whatsapp" type="text" name="whatsapp" value="{{ old('whatsapp') }}" placeholder="0812xxxxxx" required>
                </div>
                @if($errors->has('whatsapp'))
                    <div class="error-msg">{{ $errors->first('whatsapp') }}</div>
                @endif
            </div>

            <!-- Password -->
            <div class="input-group-custom">
                <label for="password">Kata Sandi</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    </span>
                    <input id="password" type="password" name="password" placeholder="Minimal 8 karakter" required autocomplete="new-password">
                </div>
                @if($errors->has('password'))
                    <div class="error-msg">{{ $errors->first('password') }}</div>
                @endif
            </div>

            <!-- Konfirmasi Password -->
            <div class="input-group-custom">
                <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                    </span>
                    <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Ulangi kata sandi" required>
                </div>
            </div>

            <button type="submit" class="btn-register">Daftar Sekarang</button>

            <div class="text-center mt-4">
                <span class="text-muted small">Sudah punya akun?</span>
                <a href="{{ route('login') }}" class="small fw-bold text-decoration-none" style="color: var(--primary-color);">Masuk di sini</a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
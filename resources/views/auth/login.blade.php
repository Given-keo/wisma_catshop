<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Wisma CatShop</title>

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

        .login-container {
            width: 100%;
            max-width: 1100px;
            background: var(--glass-bg);
            overflow: hidden;
            display: flex;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .login-hero {
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
            font-size: 3rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 20px;
            z-index: 1;
        }

        .hero-text {
            font-size: 1.1rem;
            opacity: 0.9;
            line-height: 1.6;
            z-index: 1;
        }

        /* --- Sisi Kanan (Form) --- */
        .login-form-section {
            flex: 1;
            padding: 60px;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand-wrapper {
            margin-bottom: 40px;
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

        /* Input Styling */
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

        /* Utils */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            font-size: 0.85rem;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            cursor: pointer;
        }

        .checkbox-group input {
            accent-color: var(--primary-color);
            width: 16px;
            height: 16px;
        }

        .forgot-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .btn-submit {
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
        }

        .btn-submit:hover {
            background: var(--primary-hover);
        }

        .register-footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .register-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 700;
        }

        /* --- Responsive --- */
        @media (max-width: 992px) {
            .login-hero { display: none; }
            .login-container { max-width: 500px; }
            .login-form-section { padding: 40px 30px; }
        }

        @media (max-width: 576px) {
            body { padding: 0; }
            .login-container { border-radius: 0; height: 100vh; max-width: 100%; }
            .login-form-section { justify-content: flex-start; padding-top: 60px; }
        }
    </style>
</head>
<body>
    
    @include('sweetalert::alert')
    <div class="login-container">
        <!-- Section Kiri: Hero -->
        <div class="login-hero">
            <h2 class="hero-title">Rawat. Manjakan. Sayangi.</h2>
            <p class="hero-text">Bergabunglah dengan kami. Kelola pesanan, grooming, dan kebutuhan anabul Anda dalam satu tempat.</p>
        </div>

        <!-- Section Kanan: Form -->
        <div class="login-form-section">
            <div class="brand-wrapper text-center text-lg-start">
                <div class="logo-circle mx-auto mx-lg-0">
                    <img src="{{ asset('template/assets/img/logo.jpeg') }}" alt="CatShop Logo">
                </div>
            </div>

            <div class="form-header text-center text-lg-start">
                <h2>Selamat Datang</h2>
                <p>Silakan masuk ke akun Wisma CatShop Anda</p>
            </div>

            <form action="/login" method="POST">
                <!-- CSRF Token (Penting untuk Laravel) -->
                @csrf 

                <!-- Email Field -->
                <div class="input-group-custom">
                    <label for="email">Alamat Email</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        </span>
                        <input type="email" id="email" name="email" placeholder="nama@gmail.com" required>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="input-group-custom">
                    <label for="password">Kata Sandi</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        </span>
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                    </div>
                </div>

                <!-- Options -->
                <div class="form-options">
                    {{-- <label class="checkbox-group">
                        <input type="checkbox" name="remember"> Ingat saya
                    </label> --}}
                    {{-- <a href="{{ route('password.request') }}" class="forgot-link">Lupa Sandi?</a> --}}
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-submit">Masuk</button>
            </form>

            <div class="register-footer">
                Belum punya akun? <a href="/register">Daftar sekarang</a>
            </div>
            
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - KiosTix</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* CSS reset & base */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #ffffff; color: #333; overflow-x: hidden; }
        a { text-decoration: none; color: inherit; }
        
        /* Navbar (Same as home) */
        .navbar-wrapper { padding: 15px 20px 0 20px; background-color: white;}
        .navbar { background-color: #1a1b35; color: white; padding: 15px 0; border-radius: 12px; margin: 0; }
        .nav-inner { display: flex; justify-content: space-between; align-items: center; padding: 0 20px;}
        .nav-left { display: flex; align-items: center; gap: 30px; }
        .logo { font-size: 24px; font-weight: bold; display: flex; align-items: center; }
        .logo span { background-color: #fca311; color: #1a1b35; padding: 2px 8px; border-radius: 4px; margin-left: 4px; }
        .nav-links { display: flex; gap: 20px; font-size: 15px; }
        .nav-search { flex-grow: 1; max-width: 600px; position: relative; margin: 0 20px; }
        .nav-search input { width: 100%; padding: 10px 15px 10px 40px; border-radius: 20px; border: none; outline: none; font-size: 14px; color: #333;}
        .nav-search i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #888; }
        .nav-right { display: flex; align-items: center; gap: 20px; }
        .cart-icon { font-size: 20px; }
        .btn-masuk-nav { background-color: #ffaa00; color: #1a1b35; padding: 8px 24px; border-radius: 4px; font-weight: 600; font-size: 14px; transition: 0.2s; border: none; cursor: pointer; text-align: center; }

        /* Login Form Section */
        .login-container { max-width: 450px; margin: 60px auto; padding: 20px; }
        .login-title { text-align: center; font-size: 16px; font-weight: 500; margin-bottom: 30px; color: #333; }
        .form-group { margin-bottom: 20px; position: relative; }
        .form-label { display: block; font-size: 14px; color: #444; margin-bottom: 8px; }
        .form-control { width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; outline: none; transition: border-color 0.2s; }
        .form-control:focus { border-color: #1a1b35; }
        
        .password-toggle { position: absolute; right: 15px; top: 38px; color: #888; cursor: pointer; }
        
        .btn-submit { width: 100%; background-color: #fba424; color: white; border: none; padding: 12px; border-radius: 4px; font-size: 14px; font-weight: 500; cursor: pointer; transition: 0.2s; margin-bottom: 15px; }
        .btn-submit:hover { background-color: #e5940e; }
        
        .login-options { display: flex; justify-content: space-between; align-items: center; font-size: 13px; margin-bottom: 40px; color: #444;}
        .remember-me { display: flex; align-items: center; gap: 8px; cursor: pointer; }
        
        .btn-register { width: 100%; background-color: #2e3184; color: white; border: none; padding: 12px; border-radius: 4px; font-size: 14px; font-weight: 500; cursor: pointer; transition: 0.2s; display: block; text-align: center; }
        .btn-register:hover { background-color: #1f2261; }

        .alert-error { background-color: #f8d7da; color: #721c24; padding: 10px 15px; border-radius: 4px; margin-bottom: 20px; font-size: 14px; text-align: center; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>

    <!-- Navbar Wrapper -->
    <div class="navbar-wrapper">
        <nav class="navbar">
            <div class="nav-inner">
                <div class="nav-left">
                    <a href="<?= base_url() ?>" class="logo">kios<span>Tix</span></a>
                    <div class="nav-links">
                        <a href="#">Event</a>
                        <a href="#">Atraksi</a>
                    </div>
                </div>
                <div class="nav-search">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Cari event dan atraksi di sini ...">
                </div>
                <div class="nav-right">
                    <a href="#" class="cart-icon"><i class="fas fa-shopping-cart"></i></a>
                    <a href="<?= base_url('login') ?>" class="btn-masuk-nav">Masuk</a>
                </div>
            </div>
        </nav>
    </div>

    <!-- Login Container -->
    <div class="login-container">
        <div class="login-title">Masuk ke akun anda</div>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert-error">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert-success" style="background-color: #d4edda; color: #155724; padding: 10px 15px; border-radius: 4px; margin-bottom: 20px; font-size: 14px; text-align: center; border: 1px solid #c3e6cb;">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('login') ?>" method="POST">
            <div class="form-group">
                <label class="form-label">Alamat Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Kata Sandi</label>
                <input type="password" name="password" id="passwordField" class="form-control" required>
                <i class="fas fa-eye password-toggle" id="togglePassword"></i>
            </div>
            
            <button type="submit" class="btn-submit">Masuk</button>
            
            <div class="login-options">
                <label class="remember-me">
                    <input type="checkbox" name="remember"> Ingat saya
                </label>
                <a href="#">Lupa kata sandi?</a>
            </div>
            
            <a href="<?= base_url('register') ?>" class="btn-register">Daftar Kiostix</a>
        </form>
    </div>

    <script>
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('passwordField');

        togglePassword.addEventListener('click', function () {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>

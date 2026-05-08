<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - KiosTix</title>
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

        /* Register Form Section */
        .register-container { max-width: 600px; margin: 40px auto; padding: 20px; }
        .register-header { text-align: center; margin-bottom: 30px; }
        .register-logo { font-size: 28px; font-weight: bold; display: inline-flex; align-items: center; margin-bottom: 10px; color: #1a1b35; }
        .register-logo span { background-color: #fca311; color: #1a1b35; padding: 2px 8px; border-radius: 4px; margin-left: 4px; }
        .register-title { font-size: 18px; font-weight: 500; color: #333; }
        
        .form-group { margin-bottom: 20px; position: relative; }
        .form-label { display: block; font-size: 14px; color: #444; margin-bottom: 8px; }
        .form-control { width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; outline: none; transition: border-color 0.2s; }
        .form-control:focus { border-color: #1a1b35; }
        .form-control.filled { background-color: #f0f4fa; } /* light blueish background */
        
        .password-toggle { position: absolute; right: 15px; top: 38px; color: #888; cursor: pointer; }
        
        .phone-group { display: flex; }
        .phone-prefix { background-color: #2e3184; color: white; padding: 12px 15px; border-radius: 4px 0 0 4px; font-size: 14px; font-weight: 500; border: 1px solid #2e3184; }
        .phone-input { flex-grow: 1; padding: 12px 15px; border: 1px solid #ddd; border-left: none; border-radius: 0 4px 4px 0; font-size: 14px; outline: none; }
        .phone-input:focus { border-color: #1a1b35; }
        
        .btn-submit { width: 100%; background-color: #fca311; color: white; border: none; padding: 14px; border-radius: 4px; font-size: 15px; font-weight: 500; cursor: pointer; transition: 0.2s; margin-top: 10px; }
        .btn-submit:hover { background-color: #e5940e; }

        .alert-error { background-color: #f8d7da; color: #721c24; padding: 10px 15px; border-radius: 4px; margin-bottom: 20px; font-size: 14px; text-align: center; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>

    <!-- Navbar Wrapper -->
    <div class="navbar-wrapper">
        <nav class="navbar">
            <div class="nav-inner">
                <div class="nav-left">
                    <a href="<?= base_url() ?>" class="logo" style="color:white;">kios<span>Tix</span></a>
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

    <!-- Register Container -->
    <div class="register-container">
        <div class="register-header">
            <div class="register-logo">kios<span>Tix</span></div>
            <div class="register-title">Daftar</div>
        </div>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert-error">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('register') ?>" method="POST">
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control filled" value="<?= old('email') ?? 'arir6772@gmail.com' ?>" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Nama Depan</label>
                <input type="text" name="nama_depan" class="form-control" placeholder="Your First Name" value="<?= old('nama_depan') ?>" required>
            </div>

            <div class="form-group">
                <label class="form-label">Nama Belakang</label>
                <input type="text" name="nama_belakang" class="form-control" placeholder="Your Last Name" value="<?= old('nama_belakang') ?>" required>
            </div>

            <div class="form-group">
                <label class="form-label">Nomor Telepon</label>
                <div class="phone-group">
                    <div class="phone-prefix">+62</div>
                    <input type="text" name="phone" class="phone-input" placeholder="ex: 8211xxxxx" value="<?= old('phone') ?>" required>
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Kata Sandi</label>
                <input type="password" name="password" id="passwordField" class="form-control filled" placeholder="••••••••••••" required>
                <i class="fas fa-eye-slash password-toggle" id="togglePassword"></i>
            </div>

            <div class="form-group">
                <label class="form-label">Konfirmasi Kata Sandi</label>
                <input type="password" name="confirm_password" id="confirmPasswordField" class="form-control" placeholder="Your Password" required>
                <i class="fas fa-eye-slash password-toggle" id="toggleConfirmPassword"></i>
            </div>
            
            <button type="submit" class="btn-submit">Buat Akun</button>
        </form>
    </div>

    <script>
        // Toggle password visibility
        function setupPasswordToggle(toggleId, fieldId) {
            const toggle = document.getElementById(toggleId);
            const field = document.getElementById(fieldId);

            toggle.addEventListener('click', function () {
                const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
                field.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        }

        setupPasswordToggle('togglePassword', 'passwordField');
        setupPasswordToggle('toggleConfirmPassword', 'confirmPasswordField');
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun - KiosTix</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* CSS reset & base */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #f8f9fa; color: #333; overflow-x: hidden; }
        a { text-decoration: none; color: inherit; }
        ul { list-style: none; }
        
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        
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
        
        /* Profile Dropdown */
        .profile-dropdown { position: relative; display: flex; align-items: center;}
        .profile-trigger { display: flex; align-items: flex-end; cursor: pointer; position: relative; width: 40px; height: 40px; border-radius: 4px; overflow: hidden; border: 2px solid white; background-color: white;}
        .profile-thumb { width: 100%; height: 100%; object-fit: cover; }
        .trigger-arrow { position: absolute; bottom: 0; right: 0; background: white; padding: 1px 2px; font-size: 10px; color: #333; border-top-left-radius: 4px;}
        
        .dropdown-menu { position: absolute; top: 120%; right: 0; background: white; border-radius: 4px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); width: 260px; display: none; flex-direction: column; z-index: 100; border: 1px solid #eee; overflow: hidden;}
        .dropdown-menu.active { display: flex; }
        .dropdown-header { display: flex; align-items: center; padding: 15px; border-bottom: 1px solid #f0f0f0; gap: 12px; }
        .dropdown-header img { width: 35px; height: 35px; border-radius: 4px; object-fit: cover; }
        .dropdown-name { font-weight: 500; font-size: 15px; color: #1a1b35; word-break: break-word;}
        .dropdown-item { padding: 15px; font-size: 15px; color: #333; transition: 0.2s; border-bottom: 1px solid #f0f0f0;}
        .dropdown-item:last-child { border-bottom: none; }
        .dropdown-item:hover { background-color: #f5f5f5; }

        /* Profile Layout */
        .profile-header-wrap { display: flex; align-items: center; gap: 20px; margin: 40px 0 30px; }
        .profile-header-img { width: 60px; height: 60px; border-radius: 50%; object-fit: cover; }
        .profile-greeting { font-size: 24px; font-weight: 500; color: #333; margin-bottom: 5px; }
        .profile-subtitle { font-size: 14px; color: #666; }

        .profile-content { display: flex; background: white; border-radius: 8px; border: 1px solid #e0e0e0; min-height: 500px; margin-bottom: 60px;}
        
        /* Sidebar */
        .sidebar { width: 250px; border-right: 1px solid #e0e0e0; padding: 20px 0; }
        .menu-item { display: flex; justify-content: space-between; align-items: center; padding: 15px 20px; color: #a0a0a0; font-size: 14px; border-left: 3px solid transparent; cursor: pointer; transition: 0.2s; }
        .menu-item:hover { background-color: #f9f9f9; color: #333; }
        .menu-item.active { color: #555; border-left-color: #fca311; font-weight: 600; }
        .menu-item.active .menu-icon { color: #fca311; }
        .menu-icon { width: 25px; font-size: 16px; color: #a0a0a0; }
        .menu-arrow { font-size: 12px; }

        .form-area { flex-grow: 1; padding: 30px 40px; overflow-x: auto; }
        .form-header { font-size: 16px; font-weight: 500; padding-bottom: 15px; border-bottom: 1px solid #eee; margin-bottom: 25px; color: #333; }
        
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 14px; color: #555; margin-bottom: 8px; }
        .form-control { width: 100%; padding: 10px 15px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; outline: none; transition: 0.2s; background-color: white;}
        .form-control:focus { border-color: #1a1b35; }
        .form-control:disabled, .form-control[readonly] { background-color: #eef2f5; color: #666; cursor: not-allowed; }

        .password-group { position: relative; display: flex; align-items: center; }
        .password-group .form-control { padding-right: 45px; border-radius: 4px 0 0 4px; border-right: none;}
        .password-toggle { background-color: #1a1b35; color: white; border: none; padding: 0 15px; height: 100%; position: absolute; right: 0; top: 0; border-radius: 0 4px 4px 0; cursor: pointer; display: flex; align-items: center; justify-content: center; }

        select.form-control { appearance: none; background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23333%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E"); background-repeat: no-repeat; background-position: right 15px top 50%; background-size: 10px auto; padding-right: 30px; }

        .phone-group { display: flex; }
        .phone-prefix { width: 30%; border-right: none; border-radius: 4px 0 0 4px; background-position: right 10px top 50%; }
        .phone-input { width: 70%; border-radius: 0 4px 4px 0; }

        .btn-submit { width: 100%; background-color: #ffb700; color: white; border: none; padding: 12px; border-radius: 4px; font-size: 14px; font-weight: 600; cursor: pointer; transition: 0.2s; margin-top: 10px; }
        .btn-submit:hover { background-color: #e5a400; }

        .alert-success { background-color: #d4edda; color: #155724; padding: 10px 15px; border-radius: 4px; margin-bottom: 20px; font-size: 14px; border: 1px solid #c3e6cb; }
        .alert-danger { background-color: #f8d7da; color: #721c24; padding: 10px 15px; border-radius: 4px; margin-bottom: 20px; font-size: 14px; border: 1px solid #f5c6cb; }

        /* Tables & Empty State */
        .tab-section { display: none; }
        .tab-section.active { display: block; }
        
        .transaction-table { width: 100%; border-collapse: collapse; font-size: 13px; text-align: left; }
        .transaction-table th { padding: 15px; border-bottom: 1px solid #ddd; font-weight: 600; color: #333; }
        .transaction-table td { padding: 15px; border-bottom: 1px solid #eee; color: #555; }
        
        .empty-state { text-align: center; padding: 60px 20px; color: #aaa; font-size: 14px; }
        .empty-icon { font-size: 40px; color: #ddd; margin-bottom: 15px; display: block;}
        
        .btn-details { background-color: #fca311; color: white; border: none; padding: 6px 15px; border-radius: 4px; cursor: pointer; font-size: 12px; }

        /* Toast Popup */
        @keyframes slideIn { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
        .toast-icon { background-color: #28a745; color: white; border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; font-size: 10px; margin-top: 2px;}
        .toast-content { flex-grow: 1; }
        .toast-title { font-weight: 600; font-size: 14px; color: #333; margin-bottom: 5px; }
        .toast-message { font-size: 12px; color: #666; }
        .toast-close { background: none; border: none; font-size: 14px; color: #aaa; cursor: pointer; }
        
        /* Footer */
        .footer { background-color: #1a1b35; color: white; padding: 50px 20px 20px; text-align: center; }
        .footer-logo { font-size: 28px; font-weight: bold; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; }
        .footer-logo span { background-color: #fca311; color: #1a1b35; padding: 2px 8px; border-radius: 4px; margin-left: 4px; }
        .social-icons { display: flex; justify-content: center; gap: 15px; margin-bottom: 25px; }
        .social-icons a { color: white; font-size: 20px; transition: 0.3s; }
        .social-icons a:hover { color: #fca311; }
        .footer-links { display: flex; justify-content: center; gap: 30px; font-size: 14px; margin-bottom: 30px; flex-wrap: wrap; }
        .footer-links a:hover { text-decoration: underline; }
        .copyright { font-size: 12px; color: #888; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px; }
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
                    <?php 
                        $userName = session()->get('userName');
                        $avatarUrl = "https://ui-avatars.com/api/?name=" . urlencode($userName) . "&background=random";
                    ?>
                    <div class="profile-dropdown">
                        <div class="profile-trigger" id="profileTrigger">
                            <img src="<?= $avatarUrl ?>" class="profile-thumb" alt="Profile">
                            <div class="trigger-arrow"><i class="fas fa-chevron-down"></i></div>
                        </div>
                        <div class="dropdown-menu" id="dropdownMenu">
                            <a href="<?= base_url('profile') ?>" class="dropdown-header" style="text-decoration:none;">
                                <img src="<?= $avatarUrl ?>" alt="Profile">
                                <div class="dropdown-name"><?= esc($userName) ?></div>
                            </a>
                            <a href="<?= base_url('profile?tab=transaksi-event-section') ?>" class="dropdown-item">Riwayat Transaksi</a>
                            <a href="<?= base_url('profile?tab=wishlist-section') ?>" class="dropdown-item">Wishlist</a>
                            <div class="dropdown-divider"></div>
                            <a href="<?= base_url('logout') ?>" class="dropdown-item" style="background-color: #f8f9fa;">Keluar</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <div class="container">
        <!-- Profile Header -->
        <div class="profile-header-wrap">
            <img src="<?= $avatarUrl ?>" class="profile-header-img" alt="Avatar">
            <div>
                <div class="profile-greeting">Hai, <?= esc($userName) ?></div>
                <div class="profile-subtitle">Atur akun kamu disini.</div>
            </div>
        </div>

        <?php if(session()->getFlashdata('success')): ?>
            <div class="toast-popup" id="toastPopup">
                <div class="toast-icon"><i class="fas fa-check"></i></div>
                <div class="toast-content">
                    <div class="toast-title">Berhasil</div>
                    <div class="toast-message"><?= session()->getFlashdata('success') ?></div>
                </div>
                <button class="toast-close" onclick="document.getElementById('toastPopup').remove()"><i class="fas fa-times"></i></button>
            </div>
            <script>
                setTimeout(() => {
                    const toast = document.getElementById('toastPopup');
                    if (toast) toast.remove();
                }, 5000);
            </script>
        <?php endif; ?>
        <?php if(session()->getFlashdata('password_success')): ?>
            <div class="toast-popup" id="toastPopupPw">
                <div class="toast-icon"><i class="fas fa-check"></i></div>
                <div class="toast-content">
                    <div class="toast-title">Berhasil</div>
                    <div class="toast-message"><?= session()->getFlashdata('password_success') ?></div>
                </div>
                <button class="toast-close" onclick="document.getElementById('toastPopupPw').remove()"><i class="fas fa-times"></i></button>
            </div>
            <script>
                setTimeout(() => {
                    const toast = document.getElementById('toastPopupPw');
                    if (toast) toast.remove();
                }, 5000);
            </script>
        <?php endif; ?>

        <!-- Profile Content -->
        <div class="profile-content">
            <!-- Sidebar -->
            <div class="sidebar">
                <a href="#" class="menu-item active" data-target="pengaturan-akun-section" onclick="switchTab(event, this)">
                    <div><i class="fas fa-cog menu-icon"></i> Pengaturan Akun</div>
                    <i class="fas fa-chevron-right menu-arrow"></i>
                </a>
                <a href="#" class="menu-item" data-target="transaksi-event-section" onclick="switchTab(event, this)">
                    <div><i class="fas fa-shopping-cart menu-icon"></i> Transaksi Event</div>
                    <i class="fas fa-chevron-right menu-arrow"></i>
                </a>
                <a href="#" class="menu-item" data-target="transaksi-atraksi-section" onclick="switchTab(event, this)">
                    <div><i class="fas fa-shopping-cart menu-icon"></i> Transaksi Attraksi</div>
                    <i class="fas fa-chevron-right menu-arrow"></i>
                </a>
                <a href="#" class="menu-item" data-target="atur-kata-sandi-section" onclick="switchTab(event, this)">
                    <div><i class="fas fa-shield-alt menu-icon"></i> Atur Kata Sandi</div>
                    <i class="fas fa-chevron-right menu-arrow"></i>
                </a>
                <a href="#" class="menu-item" data-target="wishlist-section" onclick="switchTab(event, this)">
                    <div><i class="fas fa-shield-alt menu-icon"></i> Wishlist</div>
                    <i class="fas fa-chevron-right menu-arrow"></i>
                </a>
            </div>

            <!-- Form Area -->
            <div class="form-area">
                
                <!-- Pengaturan Akun Tab -->
                <div id="pengaturan-akun-section" class="tab-section active">
                    <div class="form-header">Pengaturan Akun</div>
                    <form action="<?= base_url('profile') ?>" method="POST">
                    
                    <div class="form-group">
                        <label class="form-label">Alamat Email</label>
                        <input type="email" class="form-control" value="<?= esc($user['email']) ?>" readonly disabled>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nama Depan</label>
                        <input type="text" name="nama_depan" class="form-control" value="<?= esc($namaDepan) ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nama Belakang</label>
                        <input type="text" name="nama_belakang" class="form-control" value="<?= esc($namaBelakang) ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="<?= esc($user['tanggal_lahir'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="Laki-Laki" <?= (isset($user['gender']) && $user['gender'] == 'Laki-Laki') ? 'selected' : '' ?>>Laki-Laki</option>
                            <option value="Perempuan" <?= (isset($user['gender']) && $user['gender'] == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Negara</label>
                        <select id="countrySelect" name="negara" class="form-control">
                            <option value="<?= esc($user['negara'] ?? '') ?>"><?= esc($user['negara'] ?? 'Memuat data negara...') ?></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Kota/Kabupaten</label>
                        <input type="text" name="kota" class="form-control" value="<?= esc($user['kota'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nomor Handphone</label>
                        <div class="phone-group">
                            <select id="phonePrefixSelect" name="phone_prefix" class="form-control phone-prefix">
                                <option value="+62">ID (+62)</option>
                            </select>
                            <input type="text" id="phoneNumberInput" name="phone_number" class="form-control phone-input" placeholder="ex: 8211xxxxx" value="">
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">Simpan</button>
                </form>
                </div>

                <!-- Transaksi Event Tab -->
                <div id="transaksi-event-section" class="tab-section">
                    <div class="form-header">Transaksi Event</div>
                    <table class="transaction-table">
                        <thead>
                            <tr>
                                <th>ID Transaksi</th>
                                <th>Event</th>
                                <th>Tanggal Transaksi</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Total Harga</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        <i class="fas fa-inbox empty-icon"></i>
                                        No data
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Transaksi Attraksi Tab -->
                <div id="transaksi-atraksi-section" class="tab-section">
                    <div class="form-header">Transaksi Attraksi</div>
                    <table class="transaction-table">
                        <thead>
                            <tr>
                                <th>ID Transaksi</th>
                                <th>Tanggal Transaksi</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Total Harga</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($atraksiOrders)): ?>
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="fas fa-inbox empty-icon"></i>
                                        No data
                                    </div>
                                </td>
                            </tr>
                            <?php else: ?>
                                <?php foreach($atraksiOrders as $order): ?>
                                <tr>
                                    <td>
                                        <div style="font-weight:600; color:#1a1b35;"><?= esc($order['order_no']) ?></div>
                                        <div style="font-size:11px; color:#888;"><?= esc($order['title']) ?></div>
                                    </td>
                                    <td><?= esc(date('d M Y, H:i', strtotime($order['created_at']))) ?></td>
                                    <td><?= esc($order['quantity']) ?> Tiket</td>
                                    <td>
                                        <span style="background-color:#d4edda; color:#155724; padding:3px 8px; border-radius:4px; font-size:11px; font-weight:600;">
                                            <?= esc($order['pay_status']) ?>
                                        </span>
                                    </td>
                                    <td style="font-weight:600; color:#fca311;">Rp. <?= number_format($order['grand_total'], 0, ',', '.') ?></td>
                                    <td>
                                        <a href="<?= base_url('atraksi/waiting-payment/' . $order['order_id']) ?>" class="btn-details">Detail</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Atur Kata Sandi Tab -->
                <div id="atur-kata-sandi-section" class="tab-section">
                    <div class="form-header">Perbarui Kata Sandi</div>
                    
                    <?php if(session()->getFlashdata('password_error')): ?>
                        <div class="alert-danger">
                            <?= session()->getFlashdata('password_error') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('profile/update-password') ?>" method="POST">
                        <div class="form-group">
                            <label class="form-label">Masukan Kata Sandi Lama</label>
                            <div class="password-group">
                                <input type="password" name="old_password" id="old_password" class="form-control" required>
                                <button type="button" class="password-toggle" onclick="togglePassword('old_password', this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Masukan Kata Sandi Baru</label>
                            <div class="password-group">
                                <input type="password" name="new_password" id="new_password" class="form-control" required>
                                <button type="button" class="password-toggle" onclick="togglePassword('new_password', this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Masukan Kembali Kata Sandi Baru</label>
                            <div class="password-group">
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                                <button type="button" class="password-toggle" onclick="togglePassword('confirm_password', this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn-submit">Perbarui Password</button>
                    </form>
                </div>

                <!-- Wishlist Tab -->
                <div id="wishlist-section" class="tab-section">
                    <div class="form-header">Wishlist</div>
                    <table class="transaction-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Event</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="3">
                                    <div class="empty-state">
                                        <i class="fas fa-inbox empty-icon"></i>
                                        No data
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-logo">kios<span>Tix</span></div>
        <div class="social-icons">
            <a href="https://web.facebook.com/kiostix?_rdc=1&_rdr#" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="https://x.com/kiosTix" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com/accounts/login/?next=https%3A%2F%2Fwww.instagram.com%2Fkiostix%2F&is_from_rle" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://www.linkedin.com/company/kiostix?originalSubdomain=id" target="_blank"><i class="fab fa-linkedin"></i></a>
        </div>
        <div class="footer-links">
            <a href="<?= base_url('about') ?>">Apa itu Kiostix?</a>
            <a href="<?= base_url('terms') ?>">Syarat dan Ketentuan</a>
            <a href="<?= base_url('privacy') ?>">Kebijakan Privasi</a>
        </div>
        <div class="copyright">
            &copy;2023 PT Kios Cipta Kreasi. All Rights Reserved.
        </div>
    </footer>

    <script>
        // Profile Dropdown Toggle
        const profileTrigger = document.getElementById('profileTrigger');
        const dropdownMenu = document.getElementById('dropdownMenu');

        if (profileTrigger && dropdownMenu) {
            profileTrigger.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdownMenu.classList.toggle('active');
            });

            document.addEventListener('click', function(e) {
                if (!profileTrigger.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.remove('active');
                }
            });
        }

        // Tab Switching Logic
        function switchTab(event, element) {
            event.preventDefault();
            
            // Remove active from all sidebar items
            const menuItems = document.querySelectorAll('.menu-item');
            menuItems.forEach(item => {
                item.classList.remove('active');
                const icon = item.querySelector('.menu-icon');
                if(icon) {
                    // reset all icon colors to default grey
                    icon.style.color = '#a0a0a0';
                }
            });

            // Add active to clicked item
            element.classList.add('active');
            const clickedIcon = element.querySelector('.menu-icon');
            if(clickedIcon) {
                // make active icon orange
                clickedIcon.style.color = '#fca311';
            }

            // Hide all tab sections
            const tabSections = document.querySelectorAll('.tab-section');
            tabSections.forEach(section => {
                section.classList.remove('active');
            });

            // Show target section
            const targetId = element.getAttribute('data-target');
            if (targetId) {
                document.getElementById(targetId).classList.add('active');
            }
        }

        // Initialize first icon color
        const firstActiveIcon = document.querySelector('.menu-item.active .menu-icon');
        if(firstActiveIcon) firstActiveIcon.style.color = '#fca311';

        const savedCountry = "<?= esc($user['negara'] ?? 'Djibouti') ?>";
        const savedPhone = "<?= esc($user['no_handphone'] ?? '') ?>";
        
        // Priority 1: URL parameter tab (from clicking dropdown)
        // Priority 2: Flashdata active_tab (from updating password)
        const urlParams = new URLSearchParams(window.location.search);
        const urlTab = urlParams.get('tab');
        const flashTab = "<?= esc(session()->getFlashdata('active_tab') ?? '') ?>";
        
        const activeTabTarget = urlTab || flashTab;

        if (activeTabTarget) {
            const targetMenu = document.querySelector(`.menu-item[data-target="${activeTabTarget}"]`);
            if (targetMenu) {
                switchTab({preventDefault: () => {}}, targetMenu);
            }
        }

        // Fetch countries from RestCountries API
        fetch('https://restcountries.com/v3.1/all?fields=name,cca2,idd')
            .then(response => response.json())
            .then(data => {
                // Sort by common name
                data.sort((a, b) => a.name.common.localeCompare(b.name.common));

                const countrySelect = document.getElementById('countrySelect');
                const phonePrefixSelect = document.getElementById('phonePrefixSelect');
                const phoneNumberInput = document.getElementById('phoneNumberInput');
                
                countrySelect.innerHTML = ''; 
                phonePrefixSelect.innerHTML = ''; 

                let phoneMatched = false;
                let bestPrefix = "+62";
                let bestNumber = "";

                data.forEach(country => {
                    // Populate Country Dropdown
                    const option = document.createElement('option');
                    option.value = country.name.common;
                    option.textContent = country.name.common;
                    
                    if(country.name.common === savedCountry) {
                        option.selected = true; 
                    }
                    countrySelect.appendChild(option);

                    // Populate Phone Prefix Dropdown
                    if (country.idd && country.idd.root) {
                        const suffixes = country.idd.suffixes || [''];
                        suffixes.forEach(suffix => {
                            const fullCode = country.idd.root + suffix;
                            const prefixOption = document.createElement('option');
                            prefixOption.value = fullCode;
                            prefixOption.textContent = `${country.cca2} (${fullCode})`;
                            
                            phonePrefixSelect.appendChild(prefixOption);

                            // Auto-detect saved phone prefix
                            if (savedPhone.startsWith(fullCode) && fullCode.length > bestPrefix.length) {
                                bestPrefix = fullCode;
                                bestNumber = savedPhone.substring(fullCode.length);
                                phoneMatched = true;
                            }
                        });
                    }
                });

                // Set selected phone prefix
                if (phoneMatched) {
                    phonePrefixSelect.value = bestPrefix;
                    phoneNumberInput.value = bestNumber;
                } else if (savedPhone) {
                    // fallback if parsing fails, just put all in number
                    phoneNumberInput.value = savedPhone;
                }
            })
            .catch(error => {
                console.error('Error fetching countries:', error);
                document.getElementById('countrySelect').innerHTML = '<option value="">Gagal memuat negara</option>';
            });

        // Toggle password visibility
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>

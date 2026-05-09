<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menunggu Pembayaran - KiosTix</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #f8f9fa; color: #333; display: flex; flex-direction: column; min-height: 100vh; }
        
        /* Navbar */
        .navbar-wrapper { padding: 15px 20px 0 20px; background-color: white;}
        .navbar { background-color: #1a1b35; color: white; padding: 15px 0; border-radius: 12px; }
        .nav-inner { display: flex; justify-content: space-between; align-items: center; padding: 0 20px;}
        .nav-left { display: flex; align-items: center; gap: 30px; }
        .logo { font-size: 24px; font-weight: bold; display: flex; align-items: center; text-decoration: none; color: white; }
        .logo span { background-color: #fca311; color: #1a1b35; padding: 2px 8px; border-radius: 4px; margin-left: 4px; }
        .nav-links { display: flex; gap: 20px; font-size: 15px; }
        .nav-links a { color: white; text-decoration: none; }
        .nav-search { flex-grow: 1; max-width: 600px; position: relative; margin: 0 20px; }
        .nav-search input { width: 100%; padding: 10px 15px 10px 40px; border-radius: 20px; border: none; outline: none; font-size: 14px; color: #333; }
        .nav-search i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #888; }
        
        /* Main Content */
        .main-container { flex: 1; max-width: 800px; margin: 40px auto; background: white; border-radius: 12px; padding: 40px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); text-align: center; width: 100%; }
        
        .icon-circle { width: 60px; height: 60px; border-radius: 50%; background-color: #ffaa00; color: white; display: flex; justify-content: center; align-items: center; font-size: 24px; margin: 0 auto 15px; font-weight: bold; font-family: serif;}
        
        .title { font-size: 20px; font-weight: bold; color: #1a1b35; margin-bottom: 10px; }
        .timer { font-size: 20px; font-weight: bold; color: #d32f2f; margin-bottom: 30px; }
        
        .divider { height: 1px; background: #eee; margin: 20px 0; }
        
        .row-detail { display: flex; justify-content: space-between; font-size: 13px; text-align: left; margin-bottom: 15px; }
        .row-label { font-weight: bold; color: #111; flex: 1; }
        .row-value { color: #555; text-align: right; flex: 2; line-height: 1.5; }
        
        .btn-klik { display: block; width: 100%; background: #3b50e6; color: white; border: none; padding: 12px; border-radius: 6px; font-weight: bold; text-decoration: none; margin-top: 20px; }
        .btn-klik:hover { background: #2f40b8; }
        .btn-klik i { margin-right: 5px; }
        
        /* QR Section */
        .qr-section { margin-top: 30px; }
        .qr-title { font-weight: bold; font-size: 15px; margin-bottom: 15px; color: #111; }
        .qris-logo { height: 30px; margin-bottom: 10px; }
        .qr-code { width: 200px; height: 200px; margin: 0 auto; display: block; margin-bottom: 10px; }
        .nmid { font-size: 12px; color: #555; margin-bottom: 30px; }
        
        .instructions { text-align: left; font-size: 12px; color: #555; line-height: 1.8; margin-top: 20px; }

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
        .dropdown-divider { height: 5px; background-color: #f5f5f5; border: none; }

        .btn-masuk { background-color: #ffaa00; color: #1a1b35; padding: 8px 24px; border-radius: 4px; font-weight: 600; font-size: 14px; border: none; cursor: pointer; text-decoration: none; }

        /* Footer */
        .footer { background-color: #1a1b35; color: white; padding: 30px 20px; text-align: center; margin-top: auto; }
        .footer-logo { font-size: 24px; font-weight: bold; display: flex; align-items: center; justify-content: center; margin-bottom: 15px; }
        .footer-logo span { background-color: #fca311; color: #1a1b35; padding: 2px 8px; border-radius: 4px; margin-left: 4px; }
        .social-icons { display: flex; justify-content: center; gap: 15px; margin-bottom: 15px; }
        .social-icons a { color: white; font-size: 18px; }
        .footer-links { display: flex; justify-content: center; gap: 20px; font-size: 12px; margin-bottom: 15px; }
        .footer-links a { color: white; text-decoration: none; }
        .copyright { font-size: 11px; color: #888; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar-wrapper">
        <nav class="navbar">
            <div class="nav-inner">
                <div class="nav-left">
                    <a href="<?= base_url() ?>" class="logo">kios<span>Tix</span></a>
                    <div class="nav-links">
                        <a href="<?= base_url() ?>">Event</a>
                        <a href="<?= base_url('atraksi') ?>">Atraksi</a>
                    </div>
                </div>
                <div class="nav-search">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Cari event dan atraksi di sini ...">
                </div>
                <div class="nav-right" style="display:flex; align-items:center; gap:20px;">
                    <a href="<?= base_url('cart') ?>" style="color:white; position:relative;"><i class="fas fa-shopping-cart"></i></a>
                    <?php if(session()->get('isLoggedIn')): ?>
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
                    <?php else: ?>
                        <a href="<?= base_url('login') ?>" class="btn-masuk">Masuk</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-container">
        <div class="icon-circle">i</div>
        <div class="title">Menunggu Pembayaran</div>
        <div class="timer" id="paymentTimer">15 Menit 00 Detik</div>
        
        <div class="divider"></div>
        
        <div class="row-detail">
            <div class="row-label">Nomor Pemesanan</div>
            <div class="row-value"><?= esc($order['order_no']) ?></div>
        </div>
        
        <div class="divider"></div>
        
        <div class="row-detail">
            <div class="row-label">Detail Pemesanan</div>
            <div class="row-value"></div>
        </div>
        <div class="row-detail" style="margin-top: -10px;">
            <div class="row-label">Tiket</div>
            <div class="row-value">
                <?= esc($atraksi['title']) ?><br>
                <?= esc($atraksi['category_name'] ?? 'General') ?><br>
                <?= esc(date('d M Y', strtotime($orderItem['visit_date']))) ?>
            </div>
        </div>
        
        <div class="divider"></div>
        
        <div class="row-detail">
            <div class="row-label">Detail Pembayaran</div>
            <div class="row-value"></div>
        </div>
        <div class="row-detail" style="margin-top: -10px;">
            <div class="row-label">Total Harga</div>
            <div class="row-value">Rp. <?= number_format($order['grand_total'], 0, ',', '.') ?></div>
        </div>
        <div class="row-detail">
            <div class="row-label">Pay Channel</div>
            <div class="row-value"><?= esc($order['payment_method']) ?></div>
        </div>
        
        <?php if($order['payment_method'] === 'QR Payment'): ?>
        <button id="btnDownloadQR" class="btn-klik" style="cursor:pointer;">
            <i class="fas fa-download"></i> Klik Disini
        </button>
        <div class="qr-section">
            <div class="qr-title">Atau Scan QR Dibawah Ini</div>
            <img src="https://upload.wikimedia.org/wikipedia/commons/a/a2/Logo_QRIS.svg" class="qris-logo" alt="QRIS">
            <!-- Dummy QR Code -->
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=<?= urlencode($order['order_no']) ?>" class="qr-code" id="qrCodeImage" alt="QR Code">
            <div class="nmid">NMID: ID<?= date('YmdHis') . rand(100,999) ?></div>
            
            <div class="instructions">
                1. Buka aplikasi pembayaran yang akan digunakan<br>
                2. Pilih QRIS sebagai metode pembayaran<br>
                3. Scan kode QRIS ATAU unduh kode QRIS yg terdapat di layar pembayaran tiket dan unggah file tersebut pada aplikasi M-Banking Anda<br>
                4. Masukan PIN Anda<br>
                5. Bayar
            </div>
        </div>
        <?php else: ?>
        <a href="<?= base_url('profile?tab=transaksi-event-section') ?>" class="btn-klik">
            <i class="fas fa-arrow-right"></i> Kembali ke Profil
        </a>
        <div class="instructions" style="text-align: center;">
            <br>
            Instruksi pembayaran untuk <b><?= esc($order['payment_method']) ?></b> telah dikirimkan ke email Anda. Silakan selesaikan pembayaran sebelum batas waktu berakhir.<br>
            Klik tombol "Klik Disini" di atas untuk melihat status pesanan di halaman Profil.
        </div>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-logo">kios<span>Tix</span></div>
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin"></i></a>
        </div>
        <div class="footer-links">
            <a href="#">Apa itu Kiostix?</a>
            <a href="#">Syarat dan Ketentuan</a>
            <a href="#">Kebijakan Privasi</a>
        </div>
        <div class="copyright">
            &copy;2023 PT Kios Cipta Kreasi. All Rights Reserved.
        </div>
    </footer>

    <script>
        // Timer Logic
        let timeInSeconds = 15 * 60; // 15 minutes
        const timerDisplay = document.getElementById('paymentTimer');
        
        const timerInterval = setInterval(() => {
            const minutes = Math.floor(timeInSeconds / 60);
            const seconds = timeInSeconds % 60;
            timerDisplay.innerText = `${minutes} Menit ${seconds.toString().padStart(2, '0')} Detik`;
            
            if(timeInSeconds <= 0) {
                clearInterval(timerInterval);
                alert('Waktu pembayaran habis.');
                window.location.href = '<?= base_url('profile?tab=transaksi-event-section') ?>';
            }
            timeInSeconds--;
        }, 1000);

        // Download QR Logic
        const btnDownloadQR = document.getElementById('btnDownloadQR');
        if (btnDownloadQR) {
            btnDownloadQR.addEventListener('click', async (e) => {
                e.preventDefault();
                const qrImageSrc = document.getElementById('qrCodeImage').src;
                try {
                    const response = await fetch(qrImageSrc);
                    const blob = await response.blob();
                    const objectUrl = URL.createObjectURL(blob);
                    
                    const a = document.createElement('a');
                    a.href = objectUrl;
                    a.download = 'QRIS_<?= esc($order['order_no']) ?>.png';
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                    
                    URL.revokeObjectURL(objectUrl);
                } catch (error) {
                    console.error("Gagal mendownload gambar QR:", error);
                    alert("Gagal mendownload gambar QR. Silakan screenshot halaman ini secara manual.");
                }
            });
        }

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
    </script>
</body>
</html>

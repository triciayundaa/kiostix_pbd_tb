<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syarat dan Ketentuan - KiosTix</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* CSS reset & base */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #ffffff; color: #333; overflow-x: hidden; }
        a { text-decoration: none; color: inherit; }
        
        /* Navbar */
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

        /* Footer */
        .footer { background-color: #1a1b35; color: white; padding: 50px 20px 20px; text-align: center; margin-top: 50px; }
        .footer-logo { font-size: 28px; font-weight: bold; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; }
        .footer-logo span { background-color: #fca311; color: #1a1b35; padding: 2px 8px; border-radius: 4px; margin-left: 4px; }
        .social-icons { display: flex; justify-content: center; gap: 15px; margin-bottom: 25px; }
        .social-icons a { color: white; font-size: 20px; transition: 0.3s; }
        .social-icons a:hover { color: #fca311; }
        .footer-links { display: flex; justify-content: center; gap: 30px; font-size: 14px; margin-bottom: 30px; flex-wrap: wrap; }
        .footer-links a:hover { text-decoration: underline; }
        .copyright { font-size: 12px; color: #888; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px; }

        /* Page Content */
        .page-container { max-width: 1000px; margin: 50px auto; padding: 0 20px; }
        .page-title { text-align: center; font-size: 24px; font-weight: 500; color: #1a1b35; margin-bottom: 40px; position: relative;}
        .page-title::after { content: ''; position: absolute; bottom: -10px; left: 50%; transform: translateX(-50%); width: 60px; height: 3px; background-color: #fca311; }

        .terms-content { font-size: 13px; line-height: 1.8; color: #444; }
        .terms-content p { margin-bottom: 15px; }
        .terms-content ol { padding-left: 20px; margin-bottom: 15px; }
        .terms-content li { margin-bottom: 8px; }
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
                        <a href="<?= base_url('login') ?>" class="btn-masuk-nav">Masuk</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </div>

    <!-- Page Content -->
    <div class="page-container">
        <h1 class="page-title">Syarat dan Ketentuan</h1>

        <div class="terms-content">
            <p>Pelanggan yang terhormat, mohon dicatat bahwa setiap tiket yang dibeli di KiosTix & kiostix.com haruslah mengikuti Syarat & Ketentuan sebagai berikut:</p>
            <p>Semua tiket yang dijual oleh kiostix.com (KiosTix) sebagai agen untuk dan atas nama Manajemen atau Pemilik Tempat Acara (Venue) atau Pemilik Acara (Promotor) yang bertanggung jawab atas Tiket Acara yang dijual. Semua pesanan atau pembelian bergantung pada ketersediaan, KiosTix berhak untuk menerima atau menolak pesanan tiket karena alasan apapun. Dengan memesan atau membeli tiket berarti Anda setuju dengan ketentuan yang ada, yaitu:</p>
            <ol>
                <li>Pembeli Tiket tidak dapat disamakan dengan Pemegang Tiket. Pembeli Tiket adalah orang-orang yang membeli tiket untuk pertunjukan dan melakukan pembayaran sesuai dengan metode pembayaran tertentu. Sedangkan Pemegang Tiket adalah orang yang memegang tiket pada suatu acara dan berhak untuk memasuki acara sesuai dengan peraturan yang berlaku.</li>
                <li>Dalam hal/kejadian tertentu Pemegang Tiket adalah orang yang melakukan pembelian tiket (Pembeli Tiket), maka pemegang tiket wajib menunjukkan Identitas Diri yang jelas (KTP / SIM / Paspor), serta menyertai bukti pembelian yang sah apabila diperlukan.</li>
                <li>Apabila Pemegang Tiket bukan Pembeli Tiket, maka Pemegang Tiket harus melengkapi dan menyerahkan "Surat Kuasa" yang telah ditandatangani oleh Pembeli Tiket di atas Materai dan disertai dengan salinan Identitas Diri Pembeli Tiket yang sah (KTP / SIM / Paspor).</li>
                <li>Baik Pembeli Tiket maupun Pemegang Tiket sepenuhnya tunduk kepada semua ketentuan umum Kiostix.com (KiosTix) dan atau Operator Acara, Penyelenggara Acara (Promotor), Pemilik Acara, dan Tempat Acara.</li>
                <li>Terdapat kemungkinan bahwa Pemegang Tiket Acara dapat ditolak untuk memasuki Acara jika ditemukan / dibuktikan bahwa Pemegang Tiket tidak membeli melalui Kiostix.com (KiosTix) atau di setiap kanal distribusi dan penjualan resmi Kiostix.com (KiosTix).</li>
                <li>Pemegang Tiket setuju untuk meletakkan barang apapun yang diambil dan dilarang oleh Penyelenggara Acara atau Operator Acara yang diatur sesuai dengan peraturan yang berlaku, seperti; Makanan & Minuman, Senjata Tajam / Senjata Api, Zat Ilegal Berbahaya, Alat Perekam Video, atau Barang Ilegal lainnya.</li>
                <li>Tiket yang telah dibeli tidak dapat ditukarkan atau dikembalikan karena alasan apapun tanpa pengecualian dan tidak dapat ditransfer atau dijual kembali. Kiostix.com (KiosTix) ataupun Penyelenggara Acara atau Operator Acara masing-masing berhak untuk membatalkan tiket yang telah ditransfer atau dijual kembali untuk menolak masuknya Pemegang Tiket.</li>
                <li>Tidak ada pengembalian berupa uang tiket dalam keadaan apapun kecuali jika dalam kondisi tertentu, seperti; Acara ditunda atau dibatalkan dan diberitahukan dalam pernyataan terbuka atau pemberitahuan penundaan Acara yang dibuat secara publik oleh Penyelenggara Acara (Promotor) atau Pemilik Acara melalui Kiostix.com (KiosTix) ataupun media terbuka lainnya yang bersifat resmi.</li>
                <li>Tiket (Thermal) yang hilang atau rusak karena kelalaian Pembeli Tiket atau Pemegang Tiket tidak dapat dicetak ulang karena alasan apapun.</li>
                <li>Pemegang Tiket atau Pengunjung Acara yang tidak membawa Tiket (Thermal / Kertas / Elektronik), tidak diperbolehkan memasuki Tempat Acara atau Acara dengan alasan apapun.</li>
                <li>Khusus untuk Tiket Elektronik (E-Ticket), jika Pemegang Tiket / Pembeli Tiket tidak membawa Tiket, maka dapat mencetak Tiket Elektronik (E-Ticket) dengan dikenakan biaya cetak senilai Rp. 20.000,- (Dua Puluh Ribu Rupiah) per transaksi (Kebijakan ini bergantung pada ketersediaan fasilitas dan sesuai dengan peraturan yang berlaku di Tempat Acara).</li>
                <li>Tiket hanya berlaku untuk 1 (satu) Orang dan 1 (satu) kali penggunaan sesuai dengan kategori atau kelas, waktu & tanggal acara, atau dengan peraturan yang diatur oleh Penyelenggara Acara (Promotor) atau Operator Acara.</li>
            </ol>
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
    </script>
</body>
</html>

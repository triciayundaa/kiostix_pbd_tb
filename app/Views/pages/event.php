<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event - KiosTix</title>
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

        /* Banner Event */
        .event-header { background-color: #1e203f; color: white; padding: 80px 20px 100px 20px; text-align: center; position: relative; border-radius: 12px; margin: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .event-title { font-size: 56px; font-weight: 700; margin-bottom: 20px; }
        
        /* Filter Bar */
        .filter-bar { background: white; border-radius: 16px; padding: 15px; display: flex; box-shadow: 0 5px 20px rgba(0,0,0,0.05); max-width: 1000px; margin: -50px auto 30px auto; position: relative; z-index: 10; align-items: center; justify-content: space-between;}
        .filter-item { flex: 1; border-right: 1px solid #eee; padding: 0 20px; position: relative; cursor: pointer;}
        .filter-item:last-child { border-right: none; }
        .filter-label { font-size: 14px; color: #555; display: flex; align-items: center; justify-content: space-between;}
        .filter-label i { color: #888; font-size: 12px;}

        /* Filter Form inside label for simplicity */
        .filter-input { width: 100%; border: none; outline: none; background: transparent; font-size: 14px; color: #555; cursor: pointer;}
        .filter-select { width: 100%; border: none; outline: none; background: transparent; font-size: 14px; color: #555; cursor: pointer; appearance: none; -webkit-appearance: none;}
        
        /* Main Content */
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; margin-top: 40px;}
        .results-count { font-size: 14px; color: #666; }
        
        .search-here { position: relative; width: 300px; }
        .search-here input { width: 100%; padding: 10px 15px 10px 40px; border-radius: 8px; border: 1px solid #eee; background-color: #f8f9fa; outline: none; font-size: 14px; }
        .search-here i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #aaa; }

        /* Card Grid - EXACTLY LIKE HOMEPAGE */
        .grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 40px; }
        .card { border-radius: 12px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.05); border: 1px solid #eee; background: white; transition: transform 0.3s; display: flex; flex-direction: column;}
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .card-img { height: 200px; width: 100%; object-fit: cover; }
        .card-body { padding: 15px; display: flex; flex-direction: column; height: 180px; }
        .card-meta { display: flex; align-items: center; gap: 8px; font-size: 13px; color: #666; margin-bottom: 5px; }
        .card-title { font-weight: 700; font-size: 16px; margin: 10px 0; flex-grow: 1; }
        .card-price-row { display: flex; justify-content: space-between; align-items: flex-end; }
        .card-price { color: #f26522; font-weight: 700; font-size: 18px; }
        .card-price-label { font-size: 12px; color: #888; }
        .text-green { color: #28a745; font-size: 14px; }
        .text-gray { color: #6c757d; font-size: 14px; }
        
        .empty-state { text-align: center; padding: 50px 20px; color: #666; font-size: 16px; }

        /* Footer */
        .footer { background-color: #1a1b35; color: white; padding: 50px 20px 20px; text-align: center; margin-top: 60px;}
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
                        <a href="<?= base_url('event') ?>">Event</a>
                        <a href="<?= base_url('atraksi') ?>">Atraksi</a>
                    </div>
                </div>
                <div class="nav-search">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Cari event dan atraksi di sini ...">
                </div>
                <div class="nav-right">
                    <a href="<?= base_url('cart') ?>" class="cart-icon"><i class="fas fa-shopping-cart"></i></a>
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

    <!-- Banner -->
    <div class="event-header">
        <h1 class="event-title">Event</h1>
    </div>

    <form action="<?= base_url('event') ?>" method="GET" id="eventFilterForm">
        <!-- Filter Bar -->
        <div class="filter-bar">
            
            <div class="filter-item">
                <div class="filter-label">
                    <div style="display:flex; align-items:center; width:100%;">
                        <i class="far fa-calendar-alt" style="margin-right:10px; font-size:14px; color:#555;"></i> 
                        <input type="date" name="date" class="filter-input" value="<?= esc($date ?? '') ?>" onchange="document.getElementById('eventFilterForm').submit();" style="flex-grow:1;">
                    </div>
                </div>
            </div>
            
            <div class="filter-item">
                <div class="filter-label">
                    <div style="display:flex; align-items:center; width:100%;">
                        <i class="fas fa-arrows-alt-v" style="margin-right:10px; font-size:14px; color:#555;"></i>
                        <select name="sort" class="filter-select" onchange="document.getElementById('eventFilterForm').submit();" style="flex-grow:1;">
                            <option value="terbaru" <?= ($sort == 'terbaru' || empty($sort)) ? 'selected' : '' ?>>Terbaru / Terdekat</option>
                            <option value="terlama" <?= ($sort == 'terlama') ? 'selected' : '' ?>>Terlama / Terjauh</option>
                        </select>
                        <i class="fas fa-caret-down"></i>
                    </div>
                </div>
            </div>

        </div>

        <!-- Main Content -->
        <div class="container">
            <div class="top-bar">
                <div class="results-count">Menampilkan 1 sampai <?= count($events) ?> dari <?= count($events) ?> event</div>
                <div class="search-here">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" value="<?= esc($search ?? '') ?>" placeholder="Search here ..." onkeypress="if(event.key === 'Enter') document.getElementById('eventFilterForm').submit();">
                </div>
            </div>

            <?php if(!empty($events)): ?>
                <div class="grid-4">
                    <?php foreach($events as $event): ?>
                        <a href="<?= base_url('event/' . esc($event['slug'])) ?>" class="card">
                            <img src="<?= esc($event['image']) ?>" class="card-img" alt="<?= esc($event['title']) ?>">
                            <div class="card-body">
                                <div class="card-meta"><i class="fas fa-map-marker-alt"></i> <?= esc($event['location']) ?></div>
                                <div class="card-meta"><i class="far fa-calendar-alt"></i> <?= esc($event['date_str']) ?></div>
                                <div class="card-title"><?= esc($event['title']) ?></div>
                                <div class="card-price-row">
                                    <div>
                                        <?php if($event['price_val'] > 0): ?>
                                            <div class="card-price-label">Mulai dari</div>
                                            <div class="card-price"><?= esc($event['price_str']) ?></div>
                                        <?php else: ?>
                                            <div class="card-price-label">&nbsp;</div>
                                            <div class="card-price">&nbsp;</div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="<?= ($event['status'] == 'Tiket Tersedia') ? 'text-green' : 'text-gray' ?>"><?= esc($event['status']) ?></div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="far fa-frown" style="font-size: 48px; margin-bottom: 15px; color: #ccc;"></i>
                    <p>Maaf, tidak ada event yang ditemukan sesuai kriteria filter Anda.</p>
                    <a href="<?= base_url('event') ?>" style="display: inline-block; margin-top: 15px; color: #4a6ee0; text-decoration: underline;">Reset Filter</a>
                </div>
            <?php endif; ?>
        </div>
    </form>

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

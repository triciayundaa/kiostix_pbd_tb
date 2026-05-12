<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KiosTix - Clone</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* CSS reset & base */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #ffffff; color: #333; overflow-x: hidden; }
        a { text-decoration: none; color: inherit; }
        ul { list-style: none; }
        
        /* Utility Classes */
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        .flex { display: flex; }
        .items-center { align-items: center; }
        .justify-between { justify-content: space-between; }
        .text-orange { color: #f26522; }
        .text-green { color: #28a745; font-size: 14px; }
        .text-gray { color: #6c757d; font-size: 14px; }
        .font-bold { font-weight: 700; }
        .font-semibold { font-weight: 600; }
        .section-title { font-size: 24px; font-weight: 700; margin-bottom: 20px; display: flex; align-items: center;}
        .section-title span { margin-left: 15px; font-size: 14px; font-weight: normal; color: #0066cc; cursor: pointer; }
        .mt-40 { margin-top: 40px; }
        .mb-40 { margin-bottom: 40px; }

        /* Navbar */
        .navbar { background-color: #1a1b35; color: white; padding: 15px 0; border-radius: 0 0 10px 10px; margin: 0 20px; }
        @media(min-width: 1240px) {
             .navbar-wrapper { padding: 15px 20px 0 20px; background-color: white;}
             .navbar { margin: 0; border-radius: 12px; }
        }
        .nav-inner { display: flex; justify-content: space-between; align-items: center; padding: 0 20px;}
        .nav-left { display: flex; align-items: center; gap: 30px; }
        .logo { font-size: 24px; font-weight: bold; display: flex; align-items: center; }
        .logo span { background-color: #fca311; color: #1a1b35; padding: 2px 8px; border-radius: 4px; margin-left: 4px; }
        .nav-links { display: flex; gap: 20px; font-size: 15px; }
        .nav-search { flex-grow: 1; max-width: 600px; position: relative; margin: 0 20px; }
        .nav-search input { width: 100%; padding: 10px 15px 10px 40px; border-radius: 20px; border: none; outline: none; font-size: 14px; color: #333; }
        .nav-search i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #888; }
        .nav-right { display: flex; align-items: center; gap: 20px; }
        .cart-icon { font-size: 20px; }
        .btn-masuk { background-color: #ffaa00; color: #1a1b35; padding: 8px 24px; border-radius: 4px; font-weight: 600; font-size: 14px; transition: 0.2s; border: none; cursor: pointer; text-align: center; }
        .btn-masuk:hover { background-color: #e69900; }

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
        /* Banner Carousel */
        .banner-section { position: relative; margin: 30px auto; max-width: 1200px; height: 350px; border-radius: 15px; overflow: hidden; }
        .banner-img { width: 100%; height: 100%; object-fit: cover; }
        .carousel-btn { position: absolute; top: 50%; transform: translateY(-50%); background: white; border: none; width: 40px; height: 40px; border-radius: 50%; box-shadow: 0 2px 5px rgba(0,0,0,0.2); cursor: pointer; display: flex; justify-content: center; align-items: center; }
        .carousel-btn.left { left: 20px; }
        .carousel-btn.right { right: 20px; }
        .carousel-dots { position: absolute; bottom: 15px; left: 50%; transform: translateX(-50%); display: flex; gap: 8px; }
        .dot { width: 25px; height: 4px; background: rgba(255,255,255,0.5); border-radius: 2px; }
        .dot.active { background: #fca311; }

        /* Card Grid */
        .grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
        .card { border-radius: 12px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.05); border: 1px solid #eee; background: white; transition: transform 0.3s; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .card-img { height: 200px; width: 100%; object-fit: cover; }
        .card-body { padding: 15px; display: flex; flex-direction: column; height: 180px; }
        .card-meta { display: flex; align-items: center; gap: 8px; font-size: 13px; color: #666; margin-bottom: 5px; }
        .card-title { font-weight: 700; font-size: 16px; margin: 10px 0; flex-grow: 1; }
        .card-price-row { display: flex; justify-content: space-between; align-items: flex-end; }
        .card-price { color: #f26522; font-weight: 700; font-size: 18px; }
        .card-price-label { font-size: 12px; color: #888; }
        
        .nav-arrows { display: flex; gap: 10px; }
        .nav-arrow-btn { width: 35px; height: 35px; border-radius: 50%; border: 1px solid #ddd; background: white; display: flex; justify-content: center; align-items: center; cursor: pointer; color: #555; transition: 0.3s; }
        .nav-arrow-btn:hover { background: #fca311; color: white; border-color: #fca311; }
        .section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }

        /* Section 2: Singapura */
        .singapore-section { background-image: url('https://images.unsplash.com/photo-1542359649-31e03cd4d909?q=80&w=2000&auto=format&fit=crop'); background-size: cover; background-position: center; padding: 60px 0; position: relative; border-radius: 20px; margin: 40px auto; max-width: 1200px;}
        .singapore-section::before { content: ''; position: absolute; top:0; left:0; right:0; bottom:0; background: rgba(0,0,0,0.5); border-radius: 20px; }
        .singapore-content { position: relative; z-index: 1; }
        .singapore-title { color: white; text-align: center; font-size: 30px; font-weight: bold; margin-bottom: 30px; }
        .btn-outline { display: block; width: fit-content; margin: 30px auto 0; padding: 10px 30px; border: 1px solid white; color: white; border-radius: 25px; text-decoration: none; transition: 0.3s; }
        .btn-outline:hover { background: white; color: #333; }

        /* Section 3: Destinasi Favorit */
        .destinasi-section { background-color: #3b50e6; padding: 50px 0; border-radius: 20px; margin: 40px auto; max-width: 1200px; color: white; text-align: center; }
        .destinasi-title { font-size: 28px; font-weight: bold; margin-bottom: 30px; }
        .grid-5 { display: grid; grid-template-columns: repeat(5, 1fr); gap: 15px; }
        .destinasi-card { position: relative; border-radius: 15px; overflow: hidden; height: 220px; cursor: pointer; }
        .destinasi-img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
        .destinasi-card:hover .destinasi-img { transform: scale(1.1); }
        .destinasi-label { position: absolute; bottom: 10px; left: 50%; transform: translateX(-50%); background: white; color: #3b50e6; font-weight: bold; padding: 8px 20px; border-radius: 20px; font-size: 14px; box-shadow: 0 4px 10px rgba(0,0,0,0.2); transition: 0.3s; }
        .destinasi-card:hover .destinasi-label { bottom: 15px; }

        /* Footer */
        .footer { background-color: #1a1b35; color: white; padding: 50px 20px 20px; text-align: center; margin-top: 60px; }
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
                    <div class="logo">kios<span>Tix</span></div>
                    <div class="nav-links">
                        <a href="<?= base_url() ?>">Event</a>
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
                            // using a colorful background placeholder if ui-avatars is not perfectly matching, but ui-avatars is good
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

    <div class="container">
        <!-- Banner Carousel -->
        <div class="banner-section">
            <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=2000&auto=format&fit=crop" class="banner-img" alt="Banner">
            <button class="carousel-btn left"><i class="fas fa-chevron-left"></i></button>
            <button class="carousel-btn right"><i class="fas fa-chevron-right"></i></button>
            <div class="carousel-dots">
                <div class="dot active"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
        </div>

        <!-- Event Terbaru -->
        <div class="mt-40">
            <div class="section-header">
                <div class="section-title">Event Terbaru <span><a href="<?= base_url('event') ?>">Lihat semua</a></span></div>
                <div class="nav-arrows">
                    <button class="nav-arrow-btn"><i class="fas fa-arrow-left"></i></button>
                    <button class="nav-arrow-btn"><i class="fas fa-arrow-right"></i></button>
                </div>
            </div>
            
            <div class="grid-4">
                <!-- Card 1 -->
                <a href="<?= base_url('event/teras-2026') ?>" class="card">
                    <img src="https://images.unsplash.com/photo-1459749411175-04bf5292ceea?q=80&w=600&auto=format&fit=crop" class="card-img" alt="Event">
                    <div class="card-body">
                        <div class="card-meta"><i class="fas fa-map-marker-alt"></i> Jakarta Pusat</div>
                        <div class="card-meta"><i class="far fa-calendar-alt"></i> 29 Agt 26</div>
                        <div class="card-title">TERAS 2026</div>
                        <div class="card-price-row">
                            <div>
                                <div class="card-price-label">Mulai dari</div>
                                <div class="card-price">Rp. 95.000</div>
                            </div>
                            <div class="text-green">Tiket Tersedia</div>
                        </div>
                    </div>
                </a>
                <!-- Card 2 -->
                <a href="<?= base_url('event/regent-cup') ?>" class="card">
                    <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=600&auto=format&fit=crop" class="card-img" alt="Event">
                    <div class="card-body">
                        <div class="card-meta"><i class="fas fa-map-marker-alt"></i> Jakarta Timur</div>
                        <div class="card-meta"><i class="far fa-calendar-alt"></i> 08 - 17 Mei 26</div>
                        <div class="card-title">REGENT CUP</div>
                        <div class="card-price-row">
                            <div>
                                <div class="card-price-label">Mulai dari</div>
                                <div class="card-price">Rp. 15.000</div>
                            </div>
                            <div class="text-green">Tiket Tersedia</div>
                        </div>
                    </div>
                </a>
                <!-- Card 3 -->
                <a href="<?= base_url('event/regent-of-sky-2') ?>" class="card">
                    <img src="https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?q=80&w=600&auto=format&fit=crop" class="card-img" alt="Event">
                    <div class="card-body">
                        <div class="card-meta"><i class="fas fa-map-marker-alt"></i> Jakarta Timur</div>
                        <div class="card-meta"><i class="far fa-calendar-alt"></i> 20 Jun 26</div>
                        <div class="card-title">REGENT OF SKY 2</div>
                        <div class="card-price-row">
                            <div>
                                <div class="card-price-label">Mulai dari</div>
                                <div class="card-price">Rp. 100.000</div>
                            </div>
                            <div class="text-green">Tiket Tersedia</div>
                        </div>
                    </div>
                </a>
                <!-- Card 4 -->
                <a href="<?= base_url('event/kompilasik') ?>" class="card">
                    <img src="https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?q=80&w=600&auto=format&fit=crop" class="card-img" alt="Event">
                    <div class="card-body">
                        <div class="card-meta"><i class="fas fa-map-marker-alt"></i> NTB</div>
                        <div class="card-meta"><i class="far fa-calendar-alt"></i> 21 Jun 26</div>
                        <div class="card-title">Kompilasik</div>
                        <div class="card-price-row">
                            <div>
                                <div class="card-price-label">Mulai dari</div>
                                <div class="card-price">Rp. 64.000</div>
                            </div>
                            <div class="text-green">Tiket Tersedia</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Section Singapura -->
        <div class="singapore-section">
            <div class="singapore-content container">
                <div class="singapore-title">Yang Seru di Singapura</div>
                <div class="grid-4">
                    <!-- Card 1 -->
                    <a href="<?= base_url('event/artscience-museum') ?>" class="card" style="height: 250px;">
                        <img src="https://images.unsplash.com/photo-1548013146-72479768bada?q=80&w=600&auto=format&fit=crop" class="card-img" style="height:150px" alt="Singapore">
                        <div class="card-body" style="height: 100px; padding: 10px 15px;">
                            <div class="card-title" style="margin:0 0 5px 0;">ArtScience Museum™</div>
                            <div class="card-price-row">
                                <div>
                                    <span class="card-price-label">Mulai dari</span>
                                    <span class="card-price" style="font-size:15px">Rp. 236.061</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    <!-- Card 2 -->
                    <a href="<?= base_url('event/national-orchid-garden') ?>" class="card" style="height: 250px;">
                        <img src="https://images.unsplash.com/photo-1505159940484-eb2b9f2588e2?q=80&w=600&auto=format&fit=crop" class="card-img" style="height:150px" alt="Singapore">
                        <div class="card-body" style="height: 100px; padding: 10px 15px;">
                            <div class="card-title" style="margin:0 0 5px 0;">National Orchid Garden</div>
                            <div class="card-price-row">
                                <div>
                                    <span class="card-price-label">Mulai dari</span>
                                    <span class="card-price" style="font-size:15px">Rp. 100.109</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    <!-- Card 3 -->
                    <a href="<?= base_url('event/combo-gardens-by-the-bay') ?>" class="card" style="height: 250px;">
                        <img src="https://images.unsplash.com/photo-1525625293386-3f8f99389edd?q=80&w=600&auto=format&fit=crop" class="card-img" style="height:150px" alt="Singapore">
                        <div class="card-body" style="height: 100px; padding: 10px 15px;">
                            <div class="card-title" style="margin:0 0 5px 0;">COMBO: Gardens by the Bay</div>
                            <div class="card-price-row">
                                <div>
                                    <span class="card-price-label">Mulai dari</span>
                                    <span class="card-price" style="font-size:15px">Rp. 714.560</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    <!-- Card 4 -->
                    <a href="<?= base_url('event/gardens-by-the-bay') ?>" class="card" style="height: 250px;">
                        <img src="https://images.unsplash.com/photo-1583417319070-4a69db38a482?q=80&w=600&auto=format&fit=crop" class="card-img" style="height:150px" alt="Singapore">
                        <div class="card-body" style="height: 100px; padding: 10px 15px;">
                            <div class="card-title" style="margin:0 0 5px 0;">Gardens by the Bay</div>
                            <div class="card-price-row">
                                <div>
                                    <span class="card-price-label">Mulai dari</span>
                                    <span class="card-price" style="font-size:15px">Rp. 111.360</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <a href="<?= base_url('event?search=Singapura') ?>" class="btn-outline">Lihat Lebih Banyak</a>
            </div>
        </div>

        <!-- Lagi Populer di Malaysia -->
        <div class="mt-40">
            <div class="section-header">
                <div class="section-title">Lagi Populer di Negeri Malaysia <span><a href="<?= base_url('atraksi') ?>">Lihat semua</a></span></div>
                <div class="nav-arrows">
                    <button class="nav-arrow-btn"><i class="fas fa-arrow-left"></i></button>
                    <button class="nav-arrow-btn"><i class="fas fa-arrow-right"></i></button>
                </div>
            </div>
            
            <div class="grid-4">
                <!-- Image Cards -->
                <div class="card" style="border:none; box-shadow:none;">
                    <img src="https://images.unsplash.com/photo-1523482580672-f109ba8cb9be?q=80&w=600&auto=format&fit=crop" style="width:100%; height:250px; object-fit:cover; border-radius:15px;" alt="Malaysia">
                </div>
                <div class="card" style="border:none; box-shadow:none;">
                    <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?q=80&w=600&auto=format&fit=crop" style="width:100%; height:250px; object-fit:cover; border-radius:15px;" alt="Malaysia">
                </div>
                <div class="card" style="border:none; box-shadow:none;">
                    <img src="https://images.unsplash.com/photo-1583417319070-4a69db38a482?q=80&w=600&auto=format&fit=crop" style="width:100%; height:250px; object-fit:cover; border-radius:15px;" alt="Malaysia">
                </div>
                <div class="card" style="border:none; box-shadow:none;">
                    <img src="https://images.unsplash.com/photo-1599839619722-39751411ea63?q=80&w=600&auto=format&fit=crop" style="width:100%; height:250px; object-fit:cover; border-radius:15px;" alt="Malaysia">
                </div>
            </div>
        </div>

        <!-- Destinasi Favorit -->
        <div class="destinasi-section">
            <div class="destinasi-title">Destinasi Favorit</div>
            <div class="grid-5" style="margin-bottom: 40px; padding: 0 40px;">
                <div class="destinasi-card">
                    <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?q=80&w=400&auto=format&fit=crop" class="destinasi-img" alt="Bali">
                    <div class="destinasi-label">Bali</div>
                </div>
                <div class="destinasi-card">
                    <img src="https://images.unsplash.com/photo-1523482580672-f109ba8cb9be?q=80&w=400&auto=format&fit=crop" class="destinasi-img" alt="Australia">
                    <div class="destinasi-label">Australia</div>
                </div>
                <div class="destinasi-card">
                    <img src="https://images.unsplash.com/photo-1546412414-e1885259563a?q=80&w=400&auto=format&fit=crop" class="destinasi-img" alt="Turkey">
                    <div class="destinasi-label">Turkey</div>
                </div>
                <div class="destinasi-card">
                    <img src="https://images.unsplash.com/photo-1517154421773-0529f29ea451?q=80&w=400&auto=format&fit=crop" class="destinasi-img" alt="South Korea">
                    <div class="destinasi-label">South Korea</div>
                </div>
                <div class="destinasi-card">
                    <img src="https://images.unsplash.com/photo-1599839619722-39751411ea63?q=80&w=400&auto=format&fit=crop" class="destinasi-img" alt="Malaysia">
                    <div class="destinasi-label">Malaysia</div>
                </div>
            </div>
            <a href="<?= base_url('atraksi') ?>" class="btn-outline">Lihat Lebih Banyak</a>
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

        // Banner Carousel Logic
        const bannerImg = document.querySelector('.banner-img');
        const dots = document.querySelectorAll('.carousel-dots .dot');
        const leftBtn = document.querySelector('.carousel-btn.left');
        const rightBtn = document.querySelector('.carousel-btn.right');
        
        if(bannerImg && dots.length > 0) {
            const bannerImages = [
                'https://picsum.photos/id/104/2000/800',
                'https://picsum.photos/id/122/2000/800',
                'https://picsum.photos/id/134/2000/800',
                'https://picsum.photos/id/164/2000/800',
                'https://picsum.photos/id/183/2000/800',
                'https://picsum.photos/id/192/2000/800'
            ];
            
            let currentSlide = 0;
            bannerImg.style.transition = 'opacity 0.3s ease-in-out';
            
            function updateBanner(index) {
                currentSlide = index;
                if(currentSlide < 0) currentSlide = bannerImages.length - 1;
                if(currentSlide >= bannerImages.length) currentSlide = 0;
                
                bannerImg.style.opacity = '0';
                setTimeout(() => {
                    bannerImg.src = bannerImages[currentSlide];
                    bannerImg.style.opacity = '1';
                }, 300);
                
                dots.forEach((dot, i) => {
                    dot.classList.toggle('active', i === currentSlide);
                });
            }
            
            leftBtn.addEventListener('click', () => { updateBanner(currentSlide - 1); resetInterval(); });
            rightBtn.addEventListener('click', () => { updateBanner(currentSlide + 1); resetInterval(); });
            
            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => { updateBanner(index); resetInterval(); });
            });
            
            let slideInterval = setInterval(() => { updateBanner(currentSlide + 1); }, 5000);
            
            function resetInterval() {
                clearInterval(slideInterval);
                slideInterval = setInterval(() => { updateBanner(currentSlide + 1); }, 5000);
            }
        }

        // Horizontal Scrolling Logic for arrow buttons
        document.querySelectorAll('.section-header').forEach(header => {
            const navArrows = header.querySelector('.nav-arrows');
            if(navArrows) {
                const prevBtn = navArrows.children[0];
                const nextBtn = navArrows.children[1];
                const container = header.nextElementSibling;
                
                if(prevBtn && nextBtn && container) {
                    // Convert grid to scrollable flex container
                    if(container.classList.contains('grid-4') || container.classList.contains('grid-5')) {
                        container.style.display = 'flex';
                        container.style.overflowX = 'auto';
                        container.style.scrollBehavior = 'smooth';
                        // hide scrollbar
                        container.style.scrollbarWidth = 'none'; 
                        container.style.msOverflowStyle = 'none';
                        const style = document.createElement('style');
                        style.innerHTML = `.${container.className.split(' ')[0]}::-webkit-scrollbar { display: none; }`;
                        document.head.appendChild(style);
                        
                        container.style.paddingBottom = '15px';
                        
                        Array.from(container.children).forEach(child => {
                            child.style.flex = '0 0 auto';
                            child.style.minWidth = container.classList.contains('grid-4') ? 'calc(25% - 15px)' : 'calc(20% - 12px)';
                        });
                    }
                    
                    prevBtn.addEventListener('click', () => {
                        container.scrollBy({ left: -350, behavior: 'smooth' });
                    });
                    
                    nextBtn.addEventListener('click', () => {
                        container.scrollBy({ left: 350, behavior: 'smooth' });
                    });
                }
            }
        });
    </script>
</body>
</html>

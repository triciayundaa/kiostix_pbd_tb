<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($atraksi['title']) ?> - KiosTix</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Base and Navbar copied from home */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #f8f9fa; color: #333; overflow-x: hidden; }
        a { text-decoration: none; color: inherit; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        .text-orange { color: #f26522; }
        .text-gray { color: #6c757d; }
        .text-blue { color: #3b50e6; }
        
        /* Navbar */
        .navbar-wrapper { padding: 15px 20px 0 20px; background-color: white;}
        .navbar { background-color: #1a1b35; color: white; padding: 15px 0; border-radius: 12px; }
        .nav-inner { display: flex; justify-content: space-between; align-items: center; padding: 0 20px;}
        .nav-left { display: flex; align-items: center; gap: 30px; }
        .logo { font-size: 24px; font-weight: bold; display: flex; align-items: center; }
        .logo span { background-color: #fca311; color: #1a1b35; padding: 2px 8px; border-radius: 4px; margin-left: 4px; }
        .nav-links { display: flex; gap: 20px; font-size: 15px; }
        .nav-search { flex-grow: 1; max-width: 600px; position: relative; margin: 0 20px; }
        .nav-search input { width: 100%; padding: 10px 15px 10px 40px; border-radius: 20px; border: none; outline: none; font-size: 14px; color: #333; }
        .nav-search i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #888; }
        .nav-right { display: flex; align-items: center; gap: 20px; position: relative; }
        
        .cart-wrapper { position: relative; }
        .cart-icon { position: relative; font-size: 20px; color: white; display: inline-block; cursor: pointer; padding: 10px; }
        .cart-badge { position: absolute; top: 0; right: 0; background: #f26522; color: white; border-radius: 50%; width: 18px; height: 18px; font-size: 11px; display: flex; justify-content: center; align-items: center; font-weight: bold; }
        
        .cart-dropdown { position: absolute; top: 100%; right: 0; background: white; width: 320px; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); border: 1px solid #eee; display: none; flex-direction: column; z-index: 200; overflow: hidden; margin-top: 10px;}
        .cart-dropdown.active { display: flex; }
        
        /* Empty Cart State */
        .cart-empty { padding: 40px 20px; text-align: center; }
        .cart-empty-icon { font-size: 40px; color: #555; margin-bottom: 15px; }
        .cart-empty-title { font-size: 15px; font-weight: 600; color: #333; margin-bottom: 5px; }
        .cart-empty-subtitle { font-size: 12px; color: #888; }
        
        /* Filled Cart State */
        .cart-items { max-height: 300px; overflow-y: auto; }
        .cart-item { display: flex; gap: 15px; padding: 15px; border-bottom: 1px solid #f0f0f0; }
        .cart-item-img { width: 60px; height: 60px; object-fit: cover; border-radius: 6px; }
        .cart-item-info { flex: 1; }
        .cart-item-title { font-size: 13px; font-weight: 600; color: #333; margin-bottom: 5px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .cart-item-price { font-size: 13px; font-weight: bold; color: #f26522; }
        .cart-item-qty { font-size: 12px; color: #888; margin-top: 5px; }
        .cart-footer { padding: 15px; border-top: 1px solid #eee; }
        .btn-checkout-cart { display: block; width: 100%; background: #3b50e6; color: white; text-align: center; padding: 10px; border-radius: 6px; font-weight: 600; font-size: 14px; text-decoration: none; }
        
        .btn-masuk { background-color: #ffaa00; color: #1a1b35; padding: 8px 24px; border-radius: 4px; font-weight: 600; font-size: 14px; border: none; cursor: pointer; }

        /* Breadcrumb */
        .breadcrumb { padding: 20px 0; font-size: 14px; color: #555; }
        .breadcrumb a { color: #555; }
        .breadcrumb a:hover { text-decoration: underline; }
        .breadcrumb span { margin: 0 5px; }
        .breadcrumb .current { font-weight: 600; color: #333; }

        /* Header Title */
        .page-header { margin-bottom: 20px; }
        .page-title { font-size: 32px; font-weight: bold; margin-bottom: 10px; color: #1a1b35; }
        .page-location { font-size: 15px; color: #666; display: flex; align-items: center; gap: 8px; }
        .page-location i { color: #aaa; }

        /* Image Gallery Grid */
        .gallery-grid { display: grid; grid-template-columns: 2fr 1fr 1fr; grid-template-rows: 200px 200px; gap: 15px; margin-bottom: 40px; }
        .gallery-img { width: 100%; height: 100%; object-fit: cover; border-radius: 12px; cursor: pointer; transition: 0.3s; }
        .gallery-img:hover { opacity: 0.9; }
        .img-main { grid-column: 1 / 2; grid-row: 1 / 3; }
        
        /* Section Title styling like screenshot */
        .section-box { margin-bottom: 40px; }
        .section-header-title { font-size: 20px; font-weight: bold; color: #1a1b35; display: flex; align-items: center; gap: 10px; margin-bottom: 15px; }
        .section-header-title::before { content: ''; display: block; width: 6px; height: 24px; background-color: #3b50e6; border-radius: 3px; }
        .section-content { font-size: 15px; color: #555; line-height: 1.6; }

        /* Ticket Selection */
        .ticket-card { background: white; border-radius: 8px; padding: 20px; margin-bottom: 20px; border: 1px solid #eee; }
        .ticket-header { display: flex; justify-content: space-between; align-items: center; }
        .ticket-title { font-size: 16px; font-weight: bold; color: #111; margin-bottom: 10px; }
        .ticket-features { display: flex; gap: 15px; font-size: 12px; color: #888; align-items: center; flex-wrap: wrap; }
        .ticket-features i { margin-right: 5px; }
        .btn-pilih { border: 1px solid #3b50e6; color: #3b50e6; background: transparent; padding: 8px 25px; border-radius: 6px; font-weight: 600; cursor: pointer; transition: 0.2s; }
        .btn-pilih:hover { background: #f0f4ff; }
        
        /* Ticket Details (Expanded) */
        .ticket-details { display: none; margin-top: 20px; border-top: 1px solid #eee; padding-top: 20px; }
        .ticket-details.active { display: block; }
        .date-picker { border: 1px solid #ddd; padding: 10px 15px; border-radius: 8px; display: inline-flex; align-items: center; gap: 10px; color: #555; font-size: 14px; margin-bottom: 10px; width: 300px; }
        .date-picker input { border: none; outline: none; font-size: 14px; width: 100%; color: #333; }
        .unavailable-text { color: #e74c3c; font-size: 13px; margin-bottom: 20px; }
        
        .ticket-footer { display: flex; justify-content: space-between; align-items: flex-end; border-top: 1px solid #eee; padding-top: 20px; margin-top: 20px;}
        .total-price-label { font-size: 14px; color: #333; font-weight: 600; margin-bottom: 5px; }
        .total-price { font-size: 22px; font-weight: bold; color: #f26522; }
        .ticket-actions { display: flex; gap: 10px; }
        .btn-batal { border: 1px solid #ddd; background: white; padding: 10px 20px; border-radius: 6px; color: #555; font-weight: 600; cursor: pointer; }
        .btn-pesan { background: #ffaa00; border: none; padding: 10px 20px; border-radius: 6px; color: white; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 8px;}
        .btn-keranjang { background: #7b88ff; border: none; padding: 10px 20px; border-radius: 6px; color: white; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 8px; }
        
        /* Map Area */
        .map-container { width: 100%; height: 350px; border-radius: 12px; overflow: hidden; background: #ddd; position: relative; }
        .map-container img { width: 100%; height: 100%; object-fit: cover; }
        
        /* Cards & Carousels */
        .scroll-container { display: flex; overflow-x: auto; scroll-behavior: smooth; gap: 20px; padding-bottom: 15px; scrollbar-width: none; }
        .scroll-container::-webkit-scrollbar { display: none; }
        .card { flex: 0 0 auto; width: calc(25% - 15px); border-radius: 12px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.05); border: 1px solid #eee; background: white; }
        .card-img { height: 180px; width: 100%; object-fit: cover; }
        .card-body { padding: 15px; display: flex; flex-direction: column; }
        .card-meta { display: flex; align-items: center; gap: 8px; font-size: 13px; color: #666; margin-bottom: 5px; }
        .card-title { font-weight: 700; font-size: 16px; margin: 5px 0 10px 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .card-price-row { display: flex; justify-content: space-between; align-items: flex-end; }
        .card-price { color: #f26522; font-weight: 700; font-size: 16px; }
        .card-price-label { font-size: 12px; color: #888; }
        .text-green { color: #28a745; font-size: 13px; }

        .article-card { flex: 0 0 auto; width: 48%; display: flex; background: white; border: 1px solid #eee; border-radius: 12px; overflow: hidden; }
        .article-content { padding: 20px; flex: 1; }
        .article-date { font-size: 12px; color: #888; margin-bottom: 10px; }
        .article-title { font-size: 16px; font-weight: bold; color: #111; margin-bottom: 10px; }
        .article-desc { font-size: 13px; color: #666; margin-bottom: 15px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
        .article-readmore { font-size: 13px; font-weight: bold; color: #333; }
        .article-img { width: 180px; height: 100%; object-fit: cover; }

        .nav-arrows-section { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;}
        .nav-arrows { display: flex; gap: 10px; }
        .nav-arrow-btn { width: 35px; height: 35px; border-radius: 50%; border: 1px solid #ddd; background: white; display: flex; justify-content: center; align-items: center; cursor: pointer; color: #555; }
        
        /* Modal Popup */
        .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 1000; display: none; justify-content: center; align-items: center; }
        .modal-overlay.active { display: flex; }
        .modal { background: white; width: 100%; max-width: 400px; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2); max-height: 90vh; display: flex; flex-direction: column; text-align: center; }
        .modal-header { padding: 20px; border-bottom: none; display: flex; justify-content: center; align-items: center; position: relative; }
        .modal-title { font-size: 20px; font-weight: bold; }
        .modal-body { padding: 0 30px 20px; }
        .confirm-box { background: #f9f9f9; padding: 15px; border-radius: 8px; margin-bottom: 15px; text-align: center; font-size: 13px; color: #555; }
        .confirm-box span { font-weight: 600; color: #333; }
        .modal-footer { padding: 20px; border-top: none; display: flex; justify-content: center; gap: 15px; }
        .btn-ya-lanjutkan { background: #3b50e6; color: white; padding: 10px 30px; border-radius: 6px; font-weight: 600; cursor: pointer; border: none; text-decoration: none; display: inline-block; }

        /* Toast Notification */
        .toast { position: fixed; top: 20px; left: 50%; transform: translateX(-50%); background: #333; color: white; padding: 15px 30px; border-radius: 8px; z-index: 2000; box-shadow: 0 4px 12px rgba(0,0,0,0.2); display: flex; align-items: center; gap: 15px; opacity: 0; pointer-events: none; transition: 0.3s; }
        .toast.show { opacity: 1; top: 30px; }
        .toast button { background: white; color: #333; border: none; padding: 5px 15px; border-radius: 4px; font-weight: bold; cursor: pointer; }

        /* Footer */
        .footer { background-color: #1a1b35; color: white; padding: 50px 20px 20px; text-align: center; margin-top: 60px; }
        .footer-logo { font-size: 28px; font-weight: bold; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; }
        .footer-logo span { background-color: #fca311; color: #1a1b35; padding: 2px 8px; border-radius: 4px; margin-left: 4px; }
        .social-icons { display: flex; justify-content: center; gap: 15px; margin-bottom: 25px; }
        .social-icons a { color: white; font-size: 20px; }
        .footer-links { display: flex; justify-content: center; gap: 30px; font-size: 14px; margin-bottom: 30px; }
        .copyright { font-size: 12px; color: #888; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px; }
    </style>
</head>
<body>

    <!-- Navbar Wrapper -->
    <div class="navbar-wrapper">
        <nav class="navbar">
            <div class="nav-inner container">
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
                    <div class="cart-wrapper">
                        <div class="cart-icon" id="cartTrigger">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-badge" id="cartBadge" style="display:none;">0</span>
                        </div>
                        <div class="cart-dropdown" id="cartDropdown">
                            <!-- Injected by JS -->
                            <div class="cart-empty">
                                <i class="fas fa-shopping-basket cart-empty-icon"></i>
                                <div class="cart-empty-title">Tidak Ada Item di Keranjang</div>
                                <div class="cart-empty-subtitle">Sepertinya kamu belum menambahkan tiket</div>
                            </div>
                        </div>
                    </div>
                    <?php if(session()->get('isLoggedIn')): ?>
                        <div class="profile-dropdown">
                            <!-- Placeholder -->
                            <div class="profile-trigger" style="width: 40px; height: 40px; border-radius: 4px; background: white; border: 2px solid white; display:flex; align-items:center; justify-content:center;">
                                <i class="fas fa-user" style="color:#333;"></i>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="<?= base_url('login') ?>" class="btn-masuk">Masuk</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </div>

    <div class="container" style="background: white; padding: 20px 40px; border-radius: 12px; margin-top: 20px; margin-bottom: 40px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
        
        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="<?= base_url() ?>">Home</a> <span>›</span>
            <a href="<?= base_url('atraksi') ?>">Aktivitas & Hiburan</a> <span>›</span>
            <span class="current"><?= esc($atraksi['title']) ?></span>
        </div>

        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title"><?= esc($atraksi['title']) ?></h1>
            <div class="page-location">
                <i class="fas fa-map-marker-alt"></i> <?= esc($atraksi['city_name']) ?>, <?= esc($atraksi['country_name']) ?>
            </div>
        </div>

        <!-- Gallery -->
        <div class="gallery-grid">
            <img src="<?= esc($atraksi['banner_image']) ?>" class="gallery-img img-main" alt="Main Image">
            <img src="https://images.unsplash.com/photo-1523482580672-f109ba8cb9be?q=80&w=400&auto=format&fit=crop" class="gallery-img" alt="Gallery 1">
            <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=400&auto=format&fit=crop" class="gallery-img" alt="Gallery 2">
            <img src="https://images.unsplash.com/photo-1505159940484-eb2b9f2588e2?q=80&w=400&auto=format&fit=crop" class="gallery-img" alt="Gallery 3">
            <img src="https://images.unsplash.com/photo-1533174000223-14ee2823b123?q=80&w=400&auto=format&fit=crop" class="gallery-img" alt="Gallery 4">
        </div>

        <!-- Section 1 -->
        <div class="section-box">
            <div class="section-header-title">Tentang Aktivitas Ini</div>
            <div class="section-content">
                Step aboard <?= esc($atraksi['title']) ?>, a legendary experience combining history and modern entertainment. Stroll past Art Deco salons, first-class staterooms and historic corridors once used by royalty and stars. Peer into the engine room and other working spaces to see the engineering up close. Pause on the open decks to enjoy sweeping views of the harbour and skyline. Enjoy your wonderful vacation with us!
            </div>
        </div>

        <!-- Section 2 -->
        <div class="section-box">
            <div class="section-header-title">Catatan</div>
            <div class="section-content">
                Explore more than 23 historic exhibits showcasing Art Deco design, wartime service and life aboard an iconic liner.<br>
                Descend into the engine room and propeller areas to witness the powerful mechanics.<br>
                Enjoy wide open decks with panoramic views of the skyline.<br><br>
                Child policy:<br>
                - Children under 3 years old are free of charge.<br><br>
                Good to know:<br>
                - Operating hours and access to certain areas may change due to special events, private functions or maintenance.<br>
                Admission<br>
                10:00 - 18:00
            </div>
        </div>

        <!-- Ticket Selection -->
        <div class="section-box">
            <div class="section-header-title">Pilihan Tiket</div>
            
            <div class="ticket-card">
                <div class="ticket-header">
                    <div>
                        <div class="ticket-title">General Admission - Self Guided Experience</div>
                        <div class="ticket-features">
                            <span><i class="fas fa-qrcode"></i> Instant/Tiket tidak perlu dicetak</span>
                            <span><i class="fas fa-times-circle"></i> Dapat dibatalkan</span>
                            <span><i class="fas fa-exchange-alt"></i> E-Ticket tidak perlu ditukar</span>
                            <span><i class="fas fa-users"></i> Min : 1 Pax | Max : 20 Pax</span>
                            <span><i class="fas fa-hourglass-half"></i> 3 Hour(s)</span>
                        </div>
                    </div>
                    <button class="btn-pilih" id="btnPilihTiket">Pilih Tiket</button>
                </div>
                
                <!-- Expanded details -->
                <div class="ticket-details" id="ticketDetails">
                    <div class="date-picker">
                        <i class="far fa-calendar-alt"></i>
                        <input type="date" id="ticketDate" min="<?= date('Y-m-d') ?>">
                    </div>
                    <div class="unavailable-text" id="statusText" style="display:none;">Silakan pilih tanggal.</div>
                    
                    <div class="ticket-footer">
                        <div>
                            <div class="total-price-label">Total Harga</div>
                            <div class="total-price">Rp. <span id="priceDisplay">0</span></div>
                        </div>
                        <div class="ticket-actions">
                            <button class="btn-batal" id="btnBatal">Batalkan</button>
                            <button class="btn-pesan"><i class="fas fa-ticket-alt"></i> Pesan Sekarang</button>
                            <button class="btn-keranjang"><i class="fas fa-shopping-cart"></i> Tambah Keranjang</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Location Map -->
        <div class="section-box">
            <div class="section-header-title">Lokasi</div>
            <div class="map-container">
                <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?= urlencode($atraksi['city_name']) ?>&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
            </div>
        </div>

        <!-- Kamu juga mungkin suka -->
        <div class="section-box">
            <div class="nav-arrows-section">
                <div class="section-header-title" style="margin:0;">Kamu juga mungkin suka</div>
                <div class="nav-arrows">
                    <button class="nav-arrow-btn prev-btn"><i class="fas fa-arrow-left"></i></button>
                    <button class="nav-arrow-btn next-btn"><i class="fas fa-arrow-right"></i></button>
                </div>
            </div>
            <div class="scroll-container">
                <?php if(isset($relatedAtraksi) && !empty($relatedAtraksi)): ?>
                    <?php foreach($relatedAtraksi as $item): ?>
                    <a href="<?= base_url('atraksi/' . $item['slug']) ?>" class="card">
                        <img src="<?= esc($item['banner_image']) ?>" class="card-img" alt="<?= esc($item['title']) ?>">
                        <div class="card-body">
                            <div class="card-meta"><i class="fas fa-map-marker-alt"></i> <?= esc($item['city_name'] ?? 'City') ?></div>
                            <div class="card-title"><?= esc($item['title']) ?></div>
                            <div class="card-price-row">
                                <div>
                                    <div class="card-price-label">Mulai dari</div>
                                    <div class="card-price">Rp. <?= number_format($item['price'], 0, ',', '.') ?></div>
                                </div>
                                <div class="text-green">Tiket Tersedia</div>
                            </div>
                        </div>
                    </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Tips dan Artikel -->
        <div class="section-box">
            <div class="nav-arrows-section">
                <div class="section-header-title" style="margin:0;">Tips dan Artikel</div>
                <div class="nav-arrows">
                    <button class="nav-arrow-btn prev-btn"><i class="fas fa-arrow-left"></i></button>
                    <button class="nav-arrow-btn next-btn"><i class="fas fa-arrow-right"></i></button>
                </div>
            </div>
            <div class="scroll-container">
                <!-- Article 1 -->
                <div class="article-card">
                    <div class="article-content">
                        <div class="article-date">14 Mei 2024</div>
                        <div class="article-title">Rekomendasi Theme Park Seluruh dunia!</div>
                        <div class="article-desc">Apakah kalian sedang mencari tujuan liburan yang sempurna untuk keluarga atau sekadar ingin menikmati waktu senggang dengan penuh kegembiraan? Tixi punya rekomendasinya untuk kamu!</div>
                        <a href="#" class="article-readmore">Readmore ></a>
                    </div>
                    <img src="https://images.unsplash.com/photo-1513889961551-628c1e5e2ee9?q=80&w=400&auto=format&fit=crop" class="article-img" alt="Article">
                </div>
                <!-- Article 2 -->
                <div class="article-card">
                    <div class="article-content">
                        <div class="article-date">06 Maret 2024</div>
                        <div class="article-title">Musim Liburan Tiba? Museum Sejarah di Yunani Bisa Jadi Edukasi Hiburan</div>
                        <div class="article-desc">Ketika musim liburan tiba, Yunani menjadi destinasi yang menakjubkan untuk mengeksplorasi sejarah dan kebudayaan kuno. Selain pesona alamnya yang mempesona...</div>
                        <a href="#" class="article-readmore">Readmore ></a>
                    </div>
                    <img src="https://images.unsplash.com/photo-1546412414-e1885259563a?q=80&w=400&auto=format&fit=crop" class="article-img" alt="Article">
                </div>
                <!-- Article 3 -->
                <div class="article-card">
                    <div class="article-content">
                        <div class="article-date">21 Jan 2024</div>
                        <div class="article-title">Cara Murah Backpacker ke Jepang</div>
                        <div class="article-desc">Liburan ke Jepang identik dengan biaya mahal. Tapi tenang saja, kali ini Tixi akan membagikan tips jitu agar kamu bisa keliling Jepang dengan budget minim namun pengalaman maksimal.</div>
                        <a href="#" class="article-readmore">Readmore ></a>
                    </div>
                    <img src="https://images.unsplash.com/photo-1492571350019-22de08371fd3?q=80&w=400&auto=format&fit=crop" class="article-img" alt="Article">
                </div>
            </div>
        </div>

    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toastMsg">
        <div>Berhasil ditambahkan ke keranjang!</div>
        <button id="toastOk">OK</button>
    </div>

    <!-- Modal Konfirmasi -->
    <div class="modal-overlay" id="pesanModal">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title">Konfirmasi</div>
            </div>
            <div class="modal-body">
                <div class="confirm-box">
                    E-Tiket anda akan dikirim ke<br>
                    Email : <span><?= isset($user) ? esc($user['email']) : '-' ?></span><br>
                    Whatsapp : <span><?= isset($user['no_handphone']) && !empty($user['no_handphone']) ? esc($user['no_handphone']) : '-' ?></span>
                </div>
                <div class="confirm-box">
                    List item yang dibeli<br>
                    Schedule : <span><?= esc($atraksi['title']) ?></span><br>
                    Category : <span><?= esc($atraksi['category_name']) ?></span><br>
                    Quantity : <span>1 Ticket</span>
                </div>
                <div style="font-size: 13px; color: #555; margin-top: 10px;">
                    Anda yakin ingin melanjutkan?
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-batal" id="cancelModal" style="padding: 10px 30px; font-size:14px; background:white; border: 1px solid #3b50e6; color: #3b50e6;">Batalkan</button>
                <a href="#" class="btn-ya-lanjutkan" id="btnLanjutkan">Ya, Lanjutkan</a>
            </div>
        </div>
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
            <a href="<?= base_url('about') ?>">Apa itu Kiostix?</a>
            <a href="<?= base_url('terms') ?>">Syarat dan Ketentuan</a>
            <a href="<?= base_url('privacy') ?>">Kebijakan Privasi</a>
        </div>
        <div class="copyright">
            &copy;2023 PT Kios Cipta Kreasi. All Rights Reserved.
        </div>
    </footer>

    <script>
        // Scroll containers logic
        document.querySelectorAll('.nav-arrows-section').forEach(section => {
            const prevBtn = section.querySelector('.prev-btn');
            const nextBtn = section.querySelector('.next-btn');
            const container = section.nextElementSibling;
            
            if(prevBtn && nextBtn && container && container.classList.contains('scroll-container')) {
                prevBtn.addEventListener('click', () => {
                    container.scrollBy({ left: -350, behavior: 'smooth' });
                });
                
                nextBtn.addEventListener('click', () => {
                    container.scrollBy({ left: 350, behavior: 'smooth' });
                });
            }
        });

        // Ticket selection logic
        const btnPilih = document.getElementById('btnPilihTiket');
        const ticketDetails = document.getElementById('ticketDetails');
        const btnBatalTicket = document.getElementById('btnBatal');
        const ticketDate = document.getElementById('ticketDate');
        const priceDisplay = document.getElementById('priceDisplay');
        const basePrice = <?= $atraksi['price'] ?>;

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID').format(angka);
        }

        btnPilih.addEventListener('click', () => {
            ticketDetails.classList.add('active');
            btnPilih.style.display = 'none';
        });

        btnBatalTicket.addEventListener('click', () => {
            ticketDetails.classList.remove('active');
            btnPilih.style.display = 'inline-block';
            ticketDate.value = '';
            priceDisplay.innerText = '0';
        });

        ticketDate.addEventListener('change', (e) => {
            if(e.target.value) {
                priceDisplay.innerText = formatRupiah(basePrice);
            } else {
                priceDisplay.innerText = '0';
            }
        });

        // Cart Logic
        const btnKeranjang = document.querySelector('.btn-keranjang');
        const cartBadge = document.getElementById('cartBadge');
        const cartTrigger = document.getElementById('cartTrigger');
        const cartDropdown = document.getElementById('cartDropdown');
        const toastMsg = document.getElementById('toastMsg');
        const toastOk = document.getElementById('toastOk');
        const isLoggedIn = <?= session()->get('isLoggedIn') ? 'true' : 'false' ?>;

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID').format(angka);
        }

        async function fetchCart() {
            if(!isLoggedIn) return;
            try {
                const response = await fetch('<?= base_url('cart/get') ?>');
                const data = await response.json();
                if(data.status === 'success') {
                    renderCartDropdown(data.items);
                }
            } catch(e) {
                console.error('Error fetching cart:', e);
            }
        }

        function renderCartDropdown(items) {
            if(items.length > 0) {
                cartBadge.style.display = 'flex';
                let totalQty = 0;
                let html = '<div class="cart-items">';
                items.forEach(item => {
                    totalQty += parseInt(item.quantity);
                    html += `
                        <div class="cart-item">
                            <img src="${item.banner_image}" class="cart-item-img">
                            <div class="cart-item-info">
                                <div class="cart-item-title">${item.title}</div>
                                <div class="cart-item-price">Rp. ${formatRupiah(item.price)}</div>
                                <div class="cart-item-qty">Qty: ${item.quantity}</div>
                            </div>
                        </div>
                    `;
                });
                html += '</div>';
                html += `
                    <div class="cart-footer">
                        <a href="<?= base_url('profile?tab=keranjang') ?>" class="btn-checkout-cart">Lihat Keranjang</a>
                    </div>
                `;
                cartDropdown.innerHTML = html;
                cartBadge.innerText = totalQty;
            } else {
                cartBadge.style.display = 'none';
                cartDropdown.innerHTML = `
                    <div class="cart-empty">
                        <i class="fas fa-shopping-basket cart-empty-icon"></i>
                        <div class="cart-empty-title">Tidak Ada Item di Keranjang</div>
                        <div class="cart-empty-subtitle">Sepertinya kamu belum menambahkan tiket</div>
                    </div>
                `;
            }
        }

        cartTrigger.addEventListener('click', () => {
            cartDropdown.classList.toggle('active');
        });
        
        document.addEventListener('click', (e) => {
            if(!e.target.closest('.cart-wrapper')) {
                cartDropdown.classList.remove('active');
            }
        });

        fetchCart(); // Load cart on start

        btnKeranjang.addEventListener('click', async () => {
            if(!isLoggedIn) {
                window.location.href = '<?= base_url('login') ?>';
                return;
            }
            if(!ticketDate.value) {
                alert('Silakan pilih tanggal terlebih dahulu!');
                return;
            }
            
            // Disable button during process
            btnKeranjang.disabled = true;
            btnKeranjang.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
            
            try {
                const formData = new FormData();
                formData.append('ticket_id', '<?= $atraksi['id'] ?>');
                formData.append('quantity', 1); // For simplicity, always 1 here

                const response = await fetch('<?= base_url('cart/add') ?>', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();
                
                if(result.status === 'success') {
                    // Refresh cart
                    fetchCart();
                    
                    // Show toast
                    toastMsg.classList.add('show');
                    setTimeout(() => { toastMsg.classList.remove('show'); }, 3000);
                } else {
                    alert(result.message);
                }
            } catch(e) {
                console.error(e);
                alert("Terjadi kesalahan sistem.");
            } finally {
                btnKeranjang.disabled = false;
                btnKeranjang.innerHTML = '<i class="fas fa-shopping-cart"></i> Tambah Keranjang';
            }
        });

        toastOk.addEventListener('click', () => {
            toastMsg.classList.remove('show');
        });

        // Modal Logic
        const modal = document.getElementById('pesanModal');
        const btnPesan = document.querySelector('.ticket-actions .btn-pesan');
        const btnCancelModal = document.getElementById('cancelModal');
        const btnLanjutkan = document.getElementById('btnLanjutkan');

        btnPesan.addEventListener('click', () => {
            if(!isLoggedIn) {
                window.location.href = '<?= base_url('login') ?>';
                return;
            }
            if(!ticketDate.value) {
                alert('Silakan pilih tanggal terlebih dahulu!');
                return;
            }
            
            // Set checkout link with date
            btnLanjutkan.href = '<?= base_url("atraksi/checkout/" . $atraksi["slug"]) ?>?date=' + ticketDate.value;
            
            modal.classList.add('active');
        });

        function closeModal() {
            modal.classList.remove('active');
        }

        btnCancelModal.addEventListener('click', closeModal);
        modal.addEventListener('click', (e) => {
            if(e.target === modal) closeModal();
        });
    </script>
</body>
</html>

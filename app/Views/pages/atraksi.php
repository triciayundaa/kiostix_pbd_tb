<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atraksi - KiosTix</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* CSS reset & base */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #f8f9fa; color: #333; overflow-x: hidden; }
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

        /* Banner Atraksi */
        .atraksi-header { background-color: #1e203f; color: white; padding: 60px 20px 80px 20px; text-align: center; position: relative; border-radius: 12px; margin: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .atraksi-title { font-size: 42px; font-weight: 700; margin-bottom: 20px; }
        
        /* Filter Bar */
        .filter-bar { background: white; border-radius: 12px; padding: 15px; display: flex; box-shadow: 0 5px 20px rgba(0,0,0,0.05); max-width: 1000px; margin: -50px auto 30px auto; position: relative; z-index: 10; align-items: center; justify-content: space-between;}
        .filter-item { flex: 1; border-right: 1px solid #eee; padding: 0 20px; position: relative; cursor: pointer;}
        .filter-item:last-child { border-right: none; }
        .filter-label { font-size: 14px; color: #555; display: flex; align-items: center; justify-content: space-between;}
        .filter-label i { color: #888; font-size: 12px;}
        
        /* Filter Dropdowns */
        .filter-dropdown { position: absolute; top: 130%; left: 0; background: white; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); padding: 20px; width: 320px; display: none; z-index: 20; border: 1px solid #eee;}
        .filter-dropdown.active { display: block; }
        .filter-dropdown-title { font-size: 16px; font-weight: 600; margin-bottom: 15px; text-align: center;}
        
        .filter-search { position: relative; margin-bottom: 15px; }
        .filter-search input { width: 100%; padding: 10px 15px 10px 35px; border-radius: 8px; border: 1px solid #ddd; outline: none; }
        .filter-search i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #aaa; }
        
        .tabs { display: flex; margin-bottom: 15px; border: 1px solid #4a6ee0; border-radius: 8px; overflow: hidden; }
        .tab-btn { flex: 1; padding: 8px; text-align: center; font-size: 14px; cursor: pointer; color: #666; background: white; border: none; }
        .tab-btn.active { background: #4a6ee0; color: white; }
        
        .checkbox-list { max-height: 200px; overflow-y: auto; margin-bottom: 15px; }
        .checkbox-item { display: flex; align-items: center; margin-bottom: 10px; font-size: 14px; color: #555;}
        .checkbox-item input { margin-right: 10px; width: 16px; height: 16px; accent-color: #4a6ee0; }
        
        .radio-list { display: flex; flex-direction: column; gap: 10px; }
        .radio-item { display: flex; align-items: center; font-size: 14px; color: #555;}
        .radio-item input { margin-right: 10px; width: 16px; height: 16px; accent-color: #4a6ee0; }
        .radio-item hr { border: none; border-bottom: 1px solid #eee; margin: 5px 0; width: 100%;}
        
        .filter-actions { display: flex; gap: 10px; }
        .btn-clear { flex: 1; padding: 10px; border: 1px solid #4a6ee0; background: white; color: #4a6ee0; border-radius: 8px; cursor: pointer; font-weight: 500;}
        .btn-apply { flex: 1; padding: 10px; background: #4a6ee0; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 500;}

        /* Main Content */
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .results-count { font-size: 14px; color: #666; }
        .search-here { position: relative; width: 250px; }
        .search-here input { width: 100%; padding: 10px 15px 10px 35px; border-radius: 20px; border: 1px solid #ddd; outline: none; font-size: 14px; }
        .search-here i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #aaa; }

        /* Card Grid */
        .grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 40px; }
        .card { border-radius: 12px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.05); border: 1px solid #eee; background: white; transition: transform 0.3s; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .card-img { height: 200px; width: 100%; object-fit: cover; }
        .card-body { padding: 15px; display: flex; flex-direction: column; height: 180px; }
        .card-meta { display: flex; align-items: center; gap: 8px; font-size: 13px; color: #666; margin-bottom: 5px; }
        .card-title { font-weight: 700; font-size: 16px; margin: 10px 0; flex-grow: 1; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .card-price-row { display: flex; justify-content: space-between; align-items: flex-end; }
        .card-price { color: #f26522; font-weight: 700; font-size: 18px; }
        .card-price-label { font-size: 12px; color: #888; }
        .text-green { color: #28a745; font-size: 12px; }

        /* Pagination */
        .pagination { display: flex; justify-content: center; gap: 8px; margin-bottom: 60px; }
        .page-btn { width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; border-radius: 4px; border: none; background: transparent; color: #666; cursor: pointer; font-size: 14px; transition: 0.2s;}
        .page-btn:hover { background: #eee; }
        .page-btn.active { background: #fca311; color: white; font-weight: bold;}
        .page-btn:disabled { color: #ccc; cursor: not-allowed; }

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
                        <a href="<?= base_url() ?>">Event</a>
                        <a href="<?= base_url('atraksi') ?>">Atraksi</a>
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

    <!-- Banner -->
    <div class="atraksi-header">
        <h1 class="atraksi-title">Atraksi & Hiburan</h1>
    </div>

    <!-- Filter Bar -->
    <div class="filter-bar">
        <!-- Destinasi -->
        <div class="filter-item" id="filter-destinasi" onclick="toggleDropdown('dropdown-destinasi')">
            <div class="filter-label"><i class="fas fa-map-marker-alt" style="color:red; margin-right:8px; font-size:14px;"></i> Pilih Destinasi <i class="fas fa-caret-down" style="margin-left:auto;"></i></div>
            
            <div class="filter-dropdown" id="dropdown-destinasi" onclick="event.stopPropagation()">
                <div class="filter-dropdown-title">Pilih Destinasi</div>
                <div class="filter-search">
                    <i class="fas fa-search"></i>
                    <input type="text" id="search-destinasi" placeholder="Search here ...">
                </div>
                <div class="tabs">
                    <button class="tab-btn active" onclick="switchRegionTab('Indonesia')">Indonesia</button>
                    <button class="tab-btn" onclick="switchRegionTab('Mancanegara')">Mancanegara</button>
                </div>
                <div style="font-size: 13px; color: #555; margin-bottom: 8px;">Pilih Provinsi / Negara</div>
                <div class="checkbox-list" id="destinasi-list">
                    <!-- Checkboxes populated via JS -->
                </div>
                <div class="filter-actions">
                    <button class="btn-clear" onclick="clearDestinasi()">Clear</button>
                    <button class="btn-apply" onclick="applyFilters()">Terapkan</button>
                </div>
            </div>
        </div>

        <!-- Kategori -->
        <div class="filter-item" id="filter-kategori" onclick="toggleDropdown('dropdown-kategori')">
            <div class="filter-label"><i class="fas fa-th-large" style="margin-right:8px; font-size:14px;"></i> Pilih Kategori <i class="fas fa-caret-down" style="margin-left:auto;"></i></div>
            
            <div class="filter-dropdown" id="dropdown-kategori" onclick="event.stopPropagation()">
                <div class="filter-dropdown-title">Pilih Kategori</div>
                <div class="filter-search">
                    <i class="fas fa-search"></i>
                    <input type="text" id="search-kategori" placeholder="Search here ...">
                </div>
                <div class="checkbox-list" id="kategori-list">
                    <!-- Checkboxes populated via JS -->
                </div>
                <div class="filter-actions">
                    <button class="btn-clear" onclick="clearKategori()">Clear</button>
                    <button class="btn-apply" onclick="applyFilters()">Terapkan</button>
                </div>
            </div>
        </div>

        <!-- Urutkan -->
        <div class="filter-item" id="filter-urutkan" onclick="toggleDropdown('dropdown-urutkan')">
            <div class="filter-label"><i class="fas fa-sort-amount-down" style="margin-right:8px; font-size:14px;"></i> Urutkan <i class="fas fa-caret-down" style="margin-left:auto;"></i></div>
            
            <div class="filter-dropdown" id="dropdown-urutkan" style="width: 200px;" onclick="event.stopPropagation()">
                <div class="radio-list">
                    <label class="radio-item"><input type="radio" name="sort" value="terbaru" checked onchange="applyFilters()"> Terbaru</label>
                    <hr>
                    <label class="radio-item"><input type="radio" name="sort" value="termahal" onchange="applyFilters()"> Termahal</label>
                    <hr>
                    <label class="radio-item"><input type="radio" name="sort" value="termurah" onchange="applyFilters()"> Termurah</label>
                    <hr>
                    <label class="radio-item"><input type="radio" name="sort" value="terpopuler" onchange="applyFilters()"> Terpopuler</label>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="top-bar">
            <div class="results-count" id="results-count">Menampilkan 0 atraksi</div>
            <div class="search-here">
                <i class="fas fa-search"></i>
                <input type="text" id="search-main" placeholder="Search here ..." oninput="applyFilters()">
            </div>
        </div>

        <div class="grid-4" id="cards-container">
            <!-- Cards populated via JS -->
        </div>

        <div class="pagination" id="pagination-container">
            <!-- Pagination populated via JS -->
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

        // Generate Dummy Data (40 items)
        const atraksiData = [];
        const baseImages = [
            'https://images.unsplash.com/photo-1542359649-31e03cd4d909?q=80&w=600&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1505159940484-eb2b9f2588e2?q=80&w=600&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1525625293386-3f8f99389edd?q=80&w=600&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1583417319070-4a69db38a482?q=80&w=600&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1537996194471-e657df975ab4?q=80&w=600&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1546412414-e1885259563a?q=80&w=600&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1517154421773-0529f29ea451?q=80&w=600&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1599839619722-39751411ea63?q=80&w=600&auto=format&fit=crop'
        ];
        const locationsID = ['Bali', 'Lombok', 'Jakarta', 'Bandung', 'Yogyakarta'];
        const locationsManca = ['Los Angeles', 'New York', 'San Diego', 'Orlando', 'San Francisco'];
        const categories = ['Shopping', 'Transport', 'Attraction', 'Eat & Drink', 'Adventure'];
        
        for(let i=1; i<=40; i++) {
            let isID = Math.random() > 0.5;
            let region = isID ? 'Indonesia' : 'Mancanegara';
            let loc = isID ? locationsID[Math.floor(Math.random()*locationsID.length)] : locationsManca[Math.floor(Math.random()*locationsManca.length)];
            let cat = categories[Math.floor(Math.random()*categories.length)];
            
            atraksiData.push({
                id: i,
                image: baseImages[i % baseImages.length],
                location: loc,
                region: region,
                title: `${cat} Experience in ${loc} - Tour ${i}`,
                slug: `${cat.toLowerCase()}-experience-in-${loc.toLowerCase().replace(' ', '-')}-tour-${i}`,
                price: Math.floor(Math.random() * 2000000) + 100000,
                category: cat,
                dateAdded: new Date(2023, Math.floor(Math.random()*12), Math.floor(Math.random()*28)).getTime(),
                popularity: Math.floor(Math.random() * 100)
            });
        }
        
        // Ensure specific titles mentioned in screenshot are present
        atraksiData[0] = { id: 1, image: baseImages[0], location: 'Los Angeles', region: 'Mancanegara', title: 'The Queen Mary Ticket', slug: 'the-queen-mary-ticket', price: 621064, category: 'Attraction', dateAdded: Date.now(), popularity: 100 };
        atraksiData[1] = { id: 2, image: baseImages[1], location: 'Orlando', region: 'Mancanegara', title: 'Universal Orlando Resort Ticket: Universal Studios...', slug: 'universal-orlando-resort', price: 5276376, category: 'Adventure', dateAdded: Date.now()-1000, popularity: 99 };
        atraksiData[2] = { id: 3, image: baseImages[2], location: 'Los Angeles', region: 'Mancanegara', title: 'The Dolby Theatre Guided Tour, Home of the Acade...', slug: 'the-dolby-theatre', price: 375145, category: 'Attraction', dateAdded: Date.now()-2000, popularity: 98 };
        atraksiData[3] = { id: 4, image: baseImages[3], location: 'San Diego', region: 'Mancanegara', title: '2-Visit Pass: San Diego Zoo + San Diego Zoo Safari Pa...', slug: 'san-diego-zoo', price: 1965040, category: 'Adventure', dateAdded: Date.now()-3000, popularity: 97 };

        // State
        let filteredData = [...atraksiData];
        let currentPage = 1;
        const itemsPerPage = 12;
        let activeRegionTab = 'Indonesia';
        
        // Elements
        const cardsContainer = document.getElementById('cards-container');
        const paginationContainer = document.getElementById('pagination-container');
        const resultsCount = document.getElementById('results-count');
        const searchMain = document.getElementById('search-main');
        const destinasiList = document.getElementById('destinasi-list');
        const kategoriList = document.getElementById('kategori-list');
        const searchDestinasi = document.getElementById('search-destinasi');
        const searchKategori = document.getElementById('search-kategori');

        function toggleDropdown(id) {
            const dropdowns = document.querySelectorAll('.filter-dropdown');
            dropdowns.forEach(el => {
                if(el.id !== id) el.classList.remove('active');
            });
            document.getElementById(id).classList.toggle('active');
        }

        document.addEventListener('click', (e) => {
            if(!e.target.closest('.filter-item')) {
                document.querySelectorAll('.filter-dropdown').forEach(el => el.classList.remove('active'));
            }
        });

        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }

        function renderCards() {
            cardsContainer.innerHTML = '';
            
            const start = (currentPage - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const paginatedItems = filteredData.slice(start, end);
            
            resultsCount.textContent = `Menampilkan ${start + 1} sampai ${Math.min(end, filteredData.length)} dari ${filteredData.length} atraksi`;
            
            paginatedItems.forEach(item => {
                const card = `
                <a href="<?= base_url('atraksi') ?>/${item.slug}" class="card" style="text-decoration:none; color:inherit;">
                    <img src="${item.image}" class="card-img" alt="${item.title}">
                    <div class="card-body">
                        <div class="card-meta"><i class="fas fa-map-marker-alt"></i> ${item.location}</div>
                        <div class="card-title">${item.title}</div>
                        <div class="card-price-row">
                            <div>
                                <div class="card-price-label">Mulai dari</div>
                                <div class="card-price">Rp. ${formatRupiah(item.price)}</div>
                            </div>
                            <div class="text-green">Tiket Tersedia</div>
                        </div>
                    </div>
                </a>`;
                cardsContainer.innerHTML += card;
            });
        }

        function renderPagination() {
            paginationContainer.innerHTML = '';
            const totalPages = Math.ceil(filteredData.length / itemsPerPage);
            if(totalPages <= 1) return;

            let html = `<button class="page-btn" onclick="changePage(1)" ${currentPage === 1 ? 'disabled' : ''}>&laquo;</button>`;
            html += `<button class="page-btn" onclick="changePage(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''}>&lsaquo;</button>`;
            
            for(let i=1; i<=totalPages; i++) {
                if(i === currentPage) {
                    html += `<button class="page-btn active">${i}</button>`;
                } else if(i >= currentPage - 2 && i <= currentPage + 2) {
                    html += `<button class="page-btn" onclick="changePage(${i})">${i}</button>`;
                }
            }
            
            html += `<button class="page-btn" onclick="changePage(${currentPage + 1})" ${currentPage === totalPages ? 'disabled' : ''}>&rsaquo;</button>`;
            html += `<button class="page-btn" onclick="changePage(${totalPages})" ${currentPage === totalPages ? 'disabled' : ''}>&raquo;</button>`;
            
            paginationContainer.innerHTML = html;
        }

        function changePage(page) {
            currentPage = page;
            renderCards();
            renderPagination();
            window.scrollTo({ top: 300, behavior: 'smooth' });
        }

        function switchRegionTab(region) {
            activeRegionTab = region;
            document.querySelectorAll('.tab-btn').forEach(btn => {
                if(btn.textContent === region) btn.classList.add('active');
                else btn.classList.remove('active');
            });
            renderDestinasiFilters();
        }

        function renderDestinasiFilters() {
            const query = searchDestinasi.value.toLowerCase();
            const locs = activeRegionTab === 'Indonesia' ? locationsID : locationsManca;
            
            destinasiList.innerHTML = '';
            locs.forEach(loc => {
                if(loc.toLowerCase().includes(query)) {
                    destinasiList.innerHTML += `
                    <label class="checkbox-item">
                        <input type="checkbox" value="${loc}" class="destinasi-checkbox">
                        ${loc}
                    </label>
                    <hr style="border:none; border-bottom:1px solid #eee; width:100%; margin:2px 0;">`;
                }
            });
        }

        function renderKategoriFilters() {
            const query = searchKategori.value.toLowerCase();
            kategoriList.innerHTML = '';
            categories.forEach(cat => {
                if(cat.toLowerCase().includes(query)) {
                    kategoriList.innerHTML += `
                    <label class="checkbox-item">
                        <input type="checkbox" value="${cat}" class="kategori-checkbox">
                        ${cat}
                    </label>
                    <hr style="border:none; border-bottom:1px solid #eee; width:100%; margin:2px 0;">`;
                }
            });
        }

        function clearDestinasi() {
            document.querySelectorAll('.destinasi-checkbox').forEach(cb => cb.checked = false);
            applyFilters();
        }

        function clearKategori() {
            document.querySelectorAll('.kategori-checkbox').forEach(cb => cb.checked = false);
            applyFilters();
        }

        function applyFilters() {
            const searchQuery = searchMain.value.toLowerCase();
            
            const selectedDestinasi = Array.from(document.querySelectorAll('.destinasi-checkbox:checked')).map(cb => cb.value);
            const selectedKategori = Array.from(document.querySelectorAll('.kategori-checkbox:checked')).map(cb => cb.value);
            const sortOption = document.querySelector('input[name="sort"]:checked').value;
            
            filteredData = atraksiData.filter(item => {
                // Search Main
                if(searchQuery && !item.title.toLowerCase().includes(searchQuery) && !item.location.toLowerCase().includes(searchQuery)) return false;
                
                // Destinasi (only filter if some are selected)
                if(selectedDestinasi.length > 0 && !selectedDestinasi.includes(item.location)) return false;
                
                // Kategori (only filter if some are selected)
                if(selectedKategori.length > 0 && !selectedKategori.includes(item.category)) return false;
                
                return true;
            });
            
            // Sorting
            if(sortOption === 'terbaru') {
                filteredData.sort((a,b) => b.dateAdded - a.dateAdded);
            } else if(sortOption === 'termahal') {
                filteredData.sort((a,b) => b.price - a.price);
            } else if(sortOption === 'termurah') {
                filteredData.sort((a,b) => a.price - b.price);
            } else if(sortOption === 'terpopuler') {
                filteredData.sort((a,b) => b.popularity - a.popularity);
            }
            
            currentPage = 1;
            renderCards();
            renderPagination();
            
            // Close dropdowns
            document.querySelectorAll('.filter-dropdown').forEach(el => el.classList.remove('active'));
        }

        // Search in filters
        searchDestinasi.addEventListener('input', renderDestinasiFilters);
        searchKategori.addEventListener('input', renderKategoriFilters);

        // Initial Render
        renderDestinasiFilters();
        renderKategoriFilters();
        applyFilters();

    </script>
</body>
</html>

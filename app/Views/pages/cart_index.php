<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - KiosTix</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #f8f9fa; color: #333; overflow-x: hidden; }
        a { text-decoration: none; color: inherit; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        
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
        
        .page-header { margin: 40px 0 20px; font-size: 24px; font-weight: bold; color: #1a1b35; }
        
        .cart-container { display: flex; gap: 30px; align-items: flex-start; margin-bottom: 60px; }
        
        .cart-list { flex: 1; display: flex; flex-direction: column; gap: 20px; }
        
        .cart-item { background: white; border-radius: 12px; padding: 20px; display: flex; gap: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border: 1px solid #eee; position: relative; }
        .cart-item-img { width: 120px; height: 120px; object-fit: cover; border-radius: 8px; }
        .cart-item-details { flex: 1; display: flex; flex-direction: column; justify-content: space-between; }
        .cart-item-title { font-size: 18px; font-weight: bold; color: #111; margin-bottom: 5px; }
        .cart-item-price { font-size: 16px; font-weight: 600; color: #f26522; margin-bottom: 15px; }
        
        .cart-actions { display: flex; justify-content: space-between; align-items: center; }
        .qty-control { display: flex; align-items: center; border: 1px solid #ddd; border-radius: 6px; overflow: hidden; }
        .qty-btn { background: #f9f9f9; border: none; width: 35px; height: 35px; display: flex; justify-content: center; align-items: center; cursor: pointer; color: #555; transition: 0.2s; }
        .qty-btn:hover { background: #eee; }
        .qty-input { width: 40px; text-align: center; border: none; border-left: 1px solid #ddd; border-right: 1px solid #ddd; height: 35px; font-weight: 600; color: #333; outline: none; }
        
        .btn-delete { background: none; border: none; color: #e74c3c; cursor: pointer; font-size: 18px; transition: 0.2s; padding: 5px; }
        .btn-delete:hover { color: #c0392b; }
        
        .cart-summary { width: 350px; background: white; border-radius: 12px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border: 1px solid #eee; position: sticky; top: 20px; }
        .summary-title { font-size: 18px; font-weight: bold; color: #111; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #eee; }
        .summary-row { display: flex; justify-content: space-between; margin-bottom: 15px; font-size: 14px; color: #555; }
        .summary-total { display: flex; justify-content: space-between; margin-top: 20px; padding-top: 15px; border-top: 1px solid #eee; font-size: 18px; font-weight: bold; color: #111; }
        .total-price-text { color: #f26522; }
        
        .btn-checkout { display: block; width: 100%; background: #3b50e6; color: white; border: none; padding: 15px; border-radius: 8px; font-weight: bold; font-size: 16px; margin-top: 25px; cursor: pointer; text-align: center; transition: 0.2s; }
        .btn-checkout:hover { background: #2f40b8; }
        
        .empty-cart-msg { text-align: center; padding: 60px 20px; background: white; border-radius: 12px; border: 1px solid #eee; width: 100%; }
        .empty-cart-msg i { font-size: 60px; color: #ccc; margin-bottom: 20px; }
        .empty-cart-msg h2 { font-size: 20px; color: #333; margin-bottom: 10px; }
        .empty-cart-msg p { color: #888; margin-bottom: 25px; }
        .btn-back-shop { display: inline-block; background: #ffaa00; color: #1a1b35; padding: 10px 25px; border-radius: 6px; font-weight: 600; text-decoration: none; }

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
        .footer { background-color: #1a1b35; color: white; padding: 50px 20px 20px; text-align: center; margin-top: auto; }
        .footer-logo { font-size: 28px; font-weight: bold; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; }
        .footer-logo span { background-color: #fca311; color: #1a1b35; padding: 2px 8px; border-radius: 4px; margin-left: 4px; }
        .social-icons { display: flex; justify-content: center; gap: 15px; margin-bottom: 25px; }
        .social-icons a { color: white; font-size: 20px; }
        .footer-links { display: flex; justify-content: center; gap: 30px; font-size: 14px; margin-bottom: 30px; }
        .copyright { font-size: 12px; color: #888; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar-wrapper">
        <nav class="navbar">
            <div class="nav-inner container">
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
                <div class="nav-right" style="display:flex; align-items:center; gap:20px;">
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

    <div class="container">
        <h1 class="page-header">Keranjang Belanja</h1>

        <?php if(empty($cartItems)): ?>
            <div class="empty-cart-msg">
                <i class="fas fa-shopping-basket"></i>
                <h2>Keranjang Anda Kosong</h2>
                <p>Sepertinya Anda belum menambahkan aktivitas apapun ke keranjang.</p>
                <a href="<?= base_url('atraksi') ?>" class="btn-back-shop">Eksplor Atraksi</a>
            </div>
        <?php else: ?>
            <div class="cart-container">
                <div class="cart-list">
                    <?php foreach($cartItems as $item): ?>
                        <div class="cart-item" data-id="<?= esc($item['cart_id']) ?>">
                            <img src="<?= esc($item['banner_image']) ?>" class="cart-item-img" alt="Item">
                            <div class="cart-item-details">
                                <div>
                                    <a href="<?= base_url('atraksi/' . $item['slug']) ?>" class="cart-item-title"><?= esc($item['title']) ?></a>
                                    <div class="cart-item-price">Rp. <?= number_format($item['price'], 0, ',', '.') ?></div>
                                </div>
                                <div class="cart-actions">
                                    <div class="qty-control">
                                        <button class="qty-btn btn-minus" onclick="updateQty('<?= $item['cart_id'] ?>', 'decrease')"><i class="fas fa-minus"></i></button>
                                        <input type="text" class="qty-input" value="<?= esc($item['quantity']) ?>" readonly>
                                        <button class="qty-btn btn-plus" onclick="updateQty('<?= $item['cart_id'] ?>', 'increase')"><i class="fas fa-plus"></i></button>
                                    </div>
                                    <button class="btn-delete" onclick="removeItem('<?= $item['cart_id'] ?>')" title="Hapus Item"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="cart-summary">
                    <div class="summary-title">Ringkasan Belanja</div>
                    <div class="summary-row">
                        <span>Total Harga (<?= count($cartItems) ?> item)</span>
                        <span>Rp. <?= number_format($totalPrice, 0, ',', '.') ?></span>
                    </div>
                    <div class="summary-total">
                        <span>Grand Total</span>
                        <span class="total-price-text">Rp. <?= number_format($totalPrice, 0, ',', '.') ?></span>
                    </div>
                    <a href="<?= base_url('cart/checkout') ?>" class="btn-checkout">Lanjutkan Pembayaran</a>
                </div>
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
            <a href="<?= base_url('about') ?>">Apa itu Kiostix?</a>
            <a href="<?= base_url('terms') ?>">Syarat dan Ketentuan</a>
            <a href="<?= base_url('privacy') ?>">Kebijakan Privasi</a>
        </div>
        <div class="copyright">
            &copy;2023 PT Kios Cipta Kreasi. All Rights Reserved.
        </div>
    </footer>

    <script>
        async function updateQty(cartId, action) {
            try {
                const formData = new FormData();
                formData.append('cart_id', cartId);
                formData.append('action', action);

                const res = await fetch('<?= base_url('cart/update-qty') ?>', {
                    method: 'POST',
                    body: formData
                });
                const data = await res.json();
                if(data.status === 'success') {
                    window.location.reload();
                } else {
                    alert(data.message || 'Terjadi kesalahan');
                }
            } catch(e) {
                console.error(e);
            }
        }

        async function removeItem(cartId) {
            if(!confirm('Yakin ingin menghapus item ini dari keranjang?')) return;
            try {
                const formData = new FormData();
                formData.append('cart_id', cartId);

                const res = await fetch('<?= base_url('cart/remove') ?>', {
                    method: 'POST',
                    body: formData
                });
                const data = await res.json();
                if(data.status === 'success') {
                    window.location.reload();
                }
            } catch(e) {
                console.error(e);
            }
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

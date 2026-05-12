<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($event['title']) ?> - KiosTix</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* CSS reset & base */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #f8f9fa; color: #333; overflow-x: hidden; padding-bottom: 80px; }
        a { text-decoration: none; color: inherit; }
        
        /* Navbar */
        .navbar-wrapper { padding: 15px 20px 0 20px; background-color: #f8f9fa;}
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
        .btn-masuk-nav { background-color: #ffaa00; color: #1a1b35; padding: 8px 24px; border-radius: 4px; font-weight: 600; font-size: 14px; border: none; cursor: pointer; }
        
        .container { max-width: 1000px; margin: 0 auto; padding: 0 20px; }
        
        /* Breadcrumb */
        .breadcrumb { font-size: 14px; color: #666; margin: 30px 0 20px 0; }
        .breadcrumb a { color: #333; }
        .breadcrumb span { margin: 0 8px; color: #ccc; }

        /* Detail Header */
        .detail-title { font-size: 32px; font-weight: 700; color: #1a1b35; margin-bottom: 10px; }
        .detail-location { font-size: 15px; color: #888; margin-bottom: 25px; display: flex; align-items: center; }
        .detail-location i { margin-right: 8px; }
        
        .detail-poster { width: 100%; max-height: 400px; object-fit: cover; border-radius: 12px; margin-bottom: 40px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); }

        /* Sections */
        .section-box { background: white; border-radius: 12px; padding: 30px; margin-bottom: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.02); }
        .section-title { font-size: 20px; font-weight: 700; color: #1a1b35; margin-bottom: 20px; display: flex; align-items: center; }
        .section-title::before { content: ''; display: inline-block; width: 6px; height: 24px; background: #3b50e6; border-radius: 3px; margin-right: 12px; }
        
        /* Tickets */
        .ticket-header { padding-bottom: 15px; border-bottom: 1px dashed #ddd; margin-bottom: 20px; }
        .ticket-header h3 { font-size: 18px; color: #1a1b35; font-weight: 700; margin-bottom: 8px; }
        .ticket-header .meta { display: flex; gap: 20px; font-size: 13px; color: #666; }
        
        .ticket-item { display: flex; justify-content: space-between; align-items: center; padding: 20px 0; border-bottom: 1px solid #eee; }
        .ticket-item:last-child { border-bottom: none; padding-bottom: 0; }
        .ticket-info h4 { font-size: 16px; color: #3b50e6; margin-bottom: 5px; }
        .ticket-price { font-size: 20px; font-weight: 700; color: #1a1b35; margin-top: 5px; }
        .ticket-price-label { font-size: 12px; color: #666; }
        
        .qty-control { display: flex; align-items: center; gap: 15px; }
        .btn-qty { width: 36px; height: 36px; border-radius: 6px; border: 1px solid #ddd; background: white; font-size: 18px; font-weight: bold; color: #3b50e6; cursor: pointer; display: flex; justify-content: center; align-items: center; transition: 0.2s; }
        .btn-qty:hover { background: #f5f7ff; border-color: #3b50e6; }
        .btn-qty:disabled { color: #ccc; border-color: #eee; cursor: not-allowed; background: #fafafa; }
        .qty-val { width: 40px; text-align: center; font-size: 16px; font-weight: 600; color: white; background: #3b50e6; padding: 8px 0; border-radius: 6px; }

        /* Map */
        .map-container { width: 100%; height: 300px; border-radius: 8px; overflow: hidden; margin-bottom: 10px; }
        .map-text { font-size: 14px; color: #555; }

        /* Recommended */
        .grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-top: 20px; }
        .card { border-radius: 12px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.05); border: 1px solid #eee; background: white; transition: transform 0.3s; display: flex; flex-direction: column;}
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .card-img { height: 160px; width: 100%; object-fit: cover; }
        .card-body { padding: 15px; display: flex; flex-direction: column; height: 160px; }
        .card-meta { display: flex; align-items: center; gap: 8px; font-size: 12px; color: #666; margin-bottom: 5px; }
        .card-title { font-weight: 700; font-size: 15px; margin: 8px 0; flex-grow: 1; }
        .card-price-row { display: flex; justify-content: space-between; align-items: flex-end; }
        .card-price { color: #f26522; font-weight: 700; font-size: 16px; }
        .card-price-label { font-size: 11px; color: #888; }

        /* Bottom Checkout Bar */
        .checkout-bar { position: fixed; bottom: 0; left: 0; right: 0; background: white; box-shadow: 0 -5px 20px rgba(0,0,0,0.05); padding: 15px 0; z-index: 100; border-top: 1px solid #eee; }
        .checkout-inner { max-width: 1000px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center; }
        .total-label { font-size: 14px; color: #666; }
        .total-price { font-size: 24px; font-weight: 700; color: #1a1b35; }
        .btn-checkout { background-color: white; color: #888; border: 1px solid #ccc; padding: 12px 30px; border-radius: 6px; font-weight: 600; font-size: 16px; cursor: not-allowed; transition: 0.3s; }
        .btn-checkout.active { background-color: #3b50e6; color: white; border-color: #3b50e6; cursor: pointer; }
        .btn-checkout.active:hover { background-color: #2a3db6; }
        
        .description-content { font-size: 15px; line-height: 1.6; color: #555; }

        /* Modal Styles */
        .modal-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.5); z-index: 1000;
            display: none; align-items: center; justify-content: center;
        }
        .modal-overlay.active { display: flex; }
        
        .modal-container {
            background: white; border-radius: 8px; width: 100%; max-width: 500px;
            max-height: 90vh; display: flex; flex-direction: column; overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        .modal-header {
            padding: 15px 20px; border-bottom: 1px solid #eee; display: flex;
            justify-content: space-between; align-items: center;
        }
        .modal-header h3 { font-size: 16px; font-weight: 600; margin: 0; color: #333; }
        .modal-close { cursor: pointer; color: #888; font-size: 24px; border: none; background: transparent; line-height: 1; }
        
        .modal-body {
            padding: 20px; overflow-y: auto; flex-grow: 1;
        }
        
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-size: 13px; color: #333; margin-bottom: 8px; font-weight: 500; }
        .form-control {
            width: 100%; padding: 10px 15px; border: 1px solid #ddd; border-radius: 6px;
            font-size: 14px; outline: none; transition: 0.2s;
        }
        .form-control:focus { border-color: #3b50e6; }
        
        .phone-input-group { display: flex; gap: 0; }
        .phone-prefix {
            padding: 10px 15px; background: white; border: 1px solid #ddd;
            border-right: none; border-radius: 6px 0 0 6px; font-size: 14px; color: #333;
            display: flex; align-items: center; gap: 5px;
        }
        .phone-input-group .form-control { border-radius: 0 6px 6px 0; }
        
        .checkbox-group { display: flex; align-items: flex-start; gap: 10px; margin-top: 20px; }
        .checkbox-group input[type="checkbox"] { margin-top: 3px; }
        .checkbox-group label { font-size: 12px; color: #666; font-weight: 400; line-height: 1.5; margin:0; }
        .checkbox-group a { color: #3b50e6; font-weight: 600; text-decoration: none; }
        
        .modal-footer {
            padding: 15px 20px; border-top: 1px solid #eee; display: flex;
            justify-content: flex-end; gap: 10px; background: white;
        }
        .btn-modal-cancel {
            padding: 10px 20px; background: white; color: #3b50e6; border: 1px solid #ddd;
            border-radius: 6px; font-size: 14px; font-weight: 500; cursor: pointer; transition: 0.2s;
        }
        .btn-modal-cancel:hover { border-color: #3b50e6; }
        .btn-modal-submit {
            padding: 10px 20px; background: #3b50e6; color: white; border: none;
            border-radius: 6px; font-size: 14px; font-weight: 500; cursor: pointer; transition: 0.2s;
        }
        .btn-modal-submit:disabled { background: #a5b4fc; cursor: not-allowed; }
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
                    <a href="<?= base_url('login') ?>" class="btn-masuk-nav">Masuk</a>
                </div>
            </div>
        </nav>
    </div>

    <div class="container">
        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="<?= base_url() ?>">Home</a> <span><i class="fas fa-chevron-right" style="font-size:10px;"></i></span> 
            <a href="<?= base_url('event') ?>">Event</a> <span><i class="fas fa-chevron-right" style="font-size:10px;"></i></span> 
            <b><?= esc($event['title']) ?></b>
        </div>

        <!-- Header Event -->
        <h1 class="detail-title"><?= esc($event['title']) ?></h1>
        <div class="detail-location">
            <i class="fas fa-map-marker-alt"></i> <?= esc($event['venue_name']) ?>, <?= esc($event['city_name']) ?>
        </div>
        
        <?php if($event['banner_image']): ?>
            <img src="<?= esc($event['banner_image']) ?>" alt="<?= esc($event['title']) ?>" class="detail-poster">
        <?php endif; ?>

        <!-- Tentang Event -->
        <div class="section-box">
            <h2 class="section-title">Tentang Event Ini</h2>
            <div class="description-content">
                <!-- Using raw since it contains HTML like <br> from our DB -->
                <?= $event['description'] ?>
            </div>
        </div>

        <!-- Pilihan Tiket -->
        <form id="checkoutForm" action="<?= base_url('event/checkout') ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="event_slug" value="<?= esc($event['slug']) ?>">
            
        <div class="section-box" style="background-color: #f8f9ff; border: 1px solid #edf0ff;">
            <h2 class="section-title">Pilihan Tiket</h2>
            

                <div class="ticket-header">
                    <h3><?= esc($event['title']) ?></h3>
                    <div class="meta">
                        <?php 
                            $firstSchedule = !empty($schedules) ? $schedules[0] : null;
                            $lastSchedule = !empty($schedules) ? end($schedules) : null;
                            $dateDisplay = "Jadwal belum tersedia";
                            if ($firstSchedule) {
                                $startDate = date('d M Y', strtotime($firstSchedule['started_at']));
                                if ($lastSchedule && $lastSchedule['id'] !== $firstSchedule['id']) {
                                    $endDate = date('d M Y', strtotime($lastSchedule['started_at']));
                                    $dateDisplay = $startDate . " - " . $endDate;
                                } else {
                                    $dateDisplay = $startDate;
                                }
                            }
                        ?>
                        <div><i class="far fa-calendar-alt"></i> <?= esc($dateDisplay) ?></div>
                        <div><i class="fas fa-map-marker-alt"></i> <?= esc($event['venue_name']) ?>, <?= esc($event['city_name']) ?></div>
                    </div>
                </div>

                <div class="ticket-list">
                    <?php foreach($tickets as $ticket): ?>
                    <div class="ticket-item" data-id="<?= esc($ticket['id']) ?>" data-price="<?= esc($ticket['price']) ?>">
                        <div class="ticket-info">
                            <h4><?= esc($ticket['name']) ?></h4>
                            <div class="ticket-price-label">Harga</div>
                            <div class="ticket-price">Rp. <?= number_format($ticket['price'], 0, ',', '.') ?></div>
                        </div>
                        <div class="qty-control">
                            <button type="button" class="btn-qty btn-minus" disabled>-</button>
                            <input type="hidden" name="tickets[<?= esc($ticket['id']) ?>]" class="ticket-input" value="0">
                            <div class="qty-val">0</div>
                            <button type="button" class="btn-qty btn-plus">+</button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
        </div>

        <!-- Lokasi -->
        <div class="section-box">
            <h2 class="section-title">Lokasi</h2>
            <div class="map-container">
                <iframe 
                    width="100%" 
                    height="100%" 
                    frameborder="0" 
                    style="border:0" 
                    src="https://www.google.com/maps?q=<?= urlencode($event['venue_name'] . ', ' . $event['city_name']) ?>&output=embed" 
                    allowfullscreen>
                </iframe>
            </div>
            <div class="map-text">
                <?= esc($event['venue_name']) ?>, <?= esc($event['city_name']) ?>
            </div>
        </div>

        <!-- Rekomendasi Event -->
        <?php if(!empty($relatedEvents)): ?>
        <div style="margin-bottom: 100px;">
            <div class="section-title" style="font-size: 24px; margin-bottom: 20px;">Event Terbaru <span><a href="<?= base_url('event') ?>" style="margin-left: 15px; font-size: 14px; font-weight: normal; color: #0066cc;">Lihat semua</a></span></div>
            <div class="grid-4">
                <?php foreach($relatedEvents as $rel): ?>
                    <a href="<?= base_url('event/' . esc($rel['slug'])) ?>" class="card">
                        <img src="<?= esc($rel['banner_image']) ?>" class="card-img" alt="<?= esc($rel['title']) ?>">
                        <div class="card-body">
                            <div class="card-meta"><i class="fas fa-map-marker-alt"></i> <?= esc($rel['city_name']) ?></div>
                            <div class="card-meta"><i class="far fa-calendar-alt"></i> <?= date('d M y', strtotime($rel['event_date'])) ?></div>
                            <div class="card-title"><?= esc($rel['title']) ?></div>
                            <div class="card-price-row">
                                <div>
                                    <div class="card-price-label">Mulai dari</div>
                                    <div class="card-price">Rp. <?= number_format($rel['start_price'], 0, ',', '.') ?></div>
                                </div>
                                <div style="color: #28a745; font-size: 13px;">Tiket Tersedia</div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Bottom Checkout Bar -->
    <div class="checkout-bar">
        <div class="checkout-inner">
            <div>
                <div class="total-label">Total</div>
                <div class="total-price" id="totalPriceDisplay">Rp. 0</div>
            </div>
            <button type="button" class="btn-checkout" id="btnCheckoutTrigger" disabled>Pesan Sekarang</button>
        </div>
    </div>

    <!-- Data Completion Modal -->
    <div class="modal-overlay" id="dataModal">
        <div class="modal-container">
            <div class="modal-header">
                <h3>Mohon Lengkapi data</h3>
                <button type="button" class="modal-close" id="modalClose">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="guest_name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="guest_email" class="form-control" placeholder="Insert Email Address" required>
                </div>
                <div class="form-group">
                    <label>Konfirmasi Email</label>
                    <input type="email" name="guest_email_confirm" class="form-control" placeholder="Email Address Confirmation" required>
                </div>
                <div class="form-group">
                    <label>Nomor Whatsapp</label>
                    <div class="phone-input-group">
                        <div class="phone-prefix">ID (+62) <i class="fas fa-chevron-down" style="font-size:10px; color:#888;"></i></div>
                        <input type="text" name="guest_phone" class="form-control" placeholder="ex: 8211xxxxx" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="guest_gender" class="form-control" required>
                        <option value="" disabled selected>Select Gender</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Provinsi</label>
                    <select name="guest_province" class="form-control" required>
                        <option value="" disabled selected>Select Province</option>
                        <option value="DKI Jakarta">DKI Jakarta</option>
                        <option value="Jawa Barat">Jawa Barat</option>
                        <option value="Jawa Tengah">Jawa Tengah</option>
                        <option value="Jawa Timur">Jawa Timur</option>
                        <option value="Banten">Banten</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tanggal Lahir (DD/MM/YYYY)</label>
                    <input type="text" name="guest_dob" class="form-control" placeholder="" required>
                </div>
                
                <div class="checkbox-group">
                    <input type="checkbox" id="tncCheck" required>
                    <label for="tncCheck">Dengan ini saya menyetujui <a href="#">Terms & Conditions</a> dan <a href="#">Privacy Policy</a> yang berlaku.</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-modal-cancel" id="modalCancel">Batal</button>
                <button type="submit" class="btn-modal-submit" id="modalSubmit" disabled>Pesan Sekarang</button>
            </div>
        </div>
    </div>
    
    </form> <!-- End of checkoutForm -->

    <script>
        const ticketItems = document.querySelectorAll('.ticket-item');
        const totalPriceDisplay = document.getElementById('totalPriceDisplay');
        const btnCheckout = document.getElementById('btnCheckoutTrigger');
        
        let total = 0;

        function formatRupiah(amount) {
            return 'Rp. ' + parseInt(amount).toLocaleString('id-ID');
        }

        function updateTotal() {
            total = 0;
            let totalQty = 0;
            
            ticketItems.forEach(item => {
                const price = parseFloat(item.dataset.price);
                const qty = parseInt(item.querySelector('.qty-val').innerText);
                total += price * qty;
                totalQty += qty;
            });
            
            totalPriceDisplay.innerText = formatRupiah(total);
            
            if (btnCheckout) {
                if (totalQty > 0) {
                    btnCheckout.classList.add('active');
                    btnCheckout.disabled = false;
                } else {
                    btnCheckout.classList.remove('active');
                    btnCheckout.disabled = true;
                }
            }
        }

        ticketItems.forEach(item => {
            const btnMinus = item.querySelector('.btn-minus');
            const btnPlus = item.querySelector('.btn-plus');
            const qtyVal = item.querySelector('.qty-val');
            const hiddenInput = item.querySelector('.ticket-input');
            
            btnPlus.addEventListener('click', () => {
                let qty = parseInt(qtyVal.innerText);
                qty++;
                qtyVal.innerText = qty;
                hiddenInput.value = qty;
                btnMinus.disabled = false;
                updateTotal();
            });
            
            btnMinus.addEventListener('click', () => {
                let qty = parseInt(qtyVal.innerText);
                if (qty > 0) {
                    qty--;
                    qtyVal.innerText = qty;
                    hiddenInput.value = qty;
                    if (qty === 0) {
                        btnMinus.disabled = true;
                    }
                    updateTotal();
                }
            });
        });

        // Modal Logic
        const btnCheckoutTrigger = document.getElementById('btnCheckoutTrigger');
        const dataModal = document.getElementById('dataModal');
        const modalClose = document.getElementById('modalClose');
        const modalCancel = document.getElementById('modalCancel');
        const tncCheck = document.getElementById('tncCheck');
        const modalSubmit = document.getElementById('modalSubmit');
        const checkoutForm = document.getElementById('checkoutForm');

        // Open modal
        if (btnCheckoutTrigger) {
            btnCheckoutTrigger.addEventListener('click', function() {
                dataModal.classList.add('active');
            });
        }

        // Close modal functions
        function closeModal() {
            dataModal.classList.remove('active');
        }

        if (modalClose) modalClose.addEventListener('click', closeModal);
        if (modalCancel) modalCancel.addEventListener('click', closeModal);

        // Close when clicking outside container
        if (dataModal) {
            dataModal.addEventListener('click', function(e) {
                if (e.target === dataModal) {
                    closeModal();
                }
            });
        }

        // Enable/disable submit based on T&C checkbox
        if (tncCheck && modalSubmit) {
            tncCheck.addEventListener('change', function() {
                modalSubmit.disabled = !this.checked;
            });
        }

        // Form submission validation
        if (checkoutForm) {
            checkoutForm.addEventListener('submit', function(e) {
                const email = checkoutForm.querySelector('[name="guest_email"]').value;
                const emailConfirm = checkoutForm.querySelector('[name="guest_email_confirm"]').value;
                
                if (email !== emailConfirm) {
                    e.preventDefault();
                    alert('Konfirmasi email tidak cocok!');
                }
            });
        }
    </script>
</body>
</html>

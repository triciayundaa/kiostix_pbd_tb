<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - KiosTix</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #f5f6f8; color: #333; }
        
        /* Top Banner */
        .top-timer-banner { background-color: #d32f2f; color: white; padding: 12px 30px; display: flex; justify-content: space-between; font-weight: 500; font-size: 14px; position: sticky; top: 0; z-index: 100; }
        .timer { font-weight: bold; font-size: 16px; }

        .container { max-width: 1100px; margin: 30px auto; display: flex; gap: 30px; align-items: flex-start; padding: 0 20px;}
        
        /* Left Column */
        .left-column { flex: 1; }
        .page-title { font-size: 24px; font-weight: bold; margin-bottom: 20px; color: #1a1b35; }
        
        .payment-accordion { background: white; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 10px; overflow: hidden; }
        .payment-header { padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; cursor: pointer; }
        .payment-header:hover { background: #fcfcfc; }
        .payment-name { font-size: 14px; font-weight: 500; }
        .payment-logo { height: 20px; object-fit: contain; }
        .payment-right { display: flex; align-items: center; gap: 15px; }
        .payment-right i { color: #888; font-size: 14px; transition: transform 0.3s; }
        .payment-accordion.active .payment-right i { transform: rotate(180deg); }
        .payment-body { display: none; padding: 15px 20px; border-top: 1px solid #eee; background: #fafafa; font-size: 13px; color: #666; }
        .payment-accordion.active .payment-body { display: block; }
        
        /* Right Column */
        .right-column { width: 380px; background: white; border-radius: 12px; padding: 25px; border: 1px solid #eee; position: sticky; top: 70px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); }
        .user-info { margin-bottom: 25px; }
        .user-name { font-weight: bold; font-size: 16px; margin-bottom: 5px; }
        .user-detail { font-size: 13px; color: #666; line-height: 1.6; }
        
        .divider { height: 1px; background: #eee; margin: 15px 0; }
        
        .summary-row { display: flex; justify-content: space-between; font-size: 13px; color: #555; margin-bottom: 10px; }
        .summary-row.bold { font-weight: bold; color: #333; }
        .item-row { display: flex; justify-content: space-between; font-size: 13px; color: #555; margin-bottom: 20px;}
        
        .seats-info { font-size: 13px; color: #888; margin-bottom: 20px; }
        
        .voucher-box { display: flex; border: 1px solid #ddd; border-radius: 4px; overflow: hidden; margin-bottom: 15px; }
        .voucher-input { background: #d32f2f; color: white; padding: 10px 15px; flex: 1; font-size: 13px; border: none; outline: none;}
        .voucher-input::placeholder { color: rgba(255,255,255,0.8); }
        .voucher-value { background: #f5f5f5; padding: 10px 15px; font-size: 13px; font-weight: bold; border-left: 1px solid #ddd; }
        
        .grand-total-row { display: flex; justify-content: space-between; align-items: center; margin-top: 20px; margin-bottom: 20px; }
        .grand-total-label { font-size: 18px; font-weight: bold; color: #1a1b35; }
        .grand-total-value { font-size: 20px; font-weight: bold; color: #ffaa00; }
        
        .btn-bayar { width: 100%; background: #ffca7a; color: white; border: none; padding: 15px; border-radius: 8px; font-weight: bold; font-size: 16px; cursor: not-allowed; transition: 0.3s; }
        .btn-bayar.active { background: #ffaa00; cursor: pointer; }
        .btn-bayar.active:hover { background: #e69900; }
        
        /* Payment icons placeholder */
        .pay-icon { font-weight: bold; font-style: italic; color: #3b50e6; }
    </style>
</head>
<body>

    <div class="top-timer-banner">
        <div>Sisa Waktu Proses Transaksi</div>
        <div class="timer" id="timerDisplay">10:00</div>
    </div>

    <form action="<?= base_url('atraksi/process-payment') ?>" method="POST" id="paymentForm">
        <?= csrf_field() ?>
        <input type="hidden" name="slug" value="<?= esc($atraksi['slug']) ?>">
        <input type="hidden" name="visit_date" value="<?= esc($visitDate) ?>">
        <input type="hidden" name="payment_method" id="selectedPaymentMethod" value="">

        <div class="container">
            <!-- Left Column -->
            <div class="left-column">
                <h1 class="page-title">Metode Pembayaran</h1>
                
                <?php
                $methods = [
                    'BNC' => 'https://upload.wikimedia.org/wikipedia/commons/e/e5/Bank_Neo_Commerce_logo.svg',
                    'BSI' => 'https://upload.wikimedia.org/wikipedia/commons/a/a0/Bank_Syariah_Indonesia.svg',
                    'Sinarmas' => 'https://upload.wikimedia.org/wikipedia/commons/f/f6/Bank_Sinarmas_logo.svg',
                    'QR Payment' => 'https://upload.wikimedia.org/wikipedia/commons/a/a2/Logo_QRIS.svg',
                    'Mandiri' => 'https://upload.wikimedia.org/wikipedia/commons/a/ad/Bank_Mandiri_logo_2016.svg',
                    'BRI Virtual Account' => 'https://upload.wikimedia.org/wikipedia/commons/2/2e/BRI_2020.svg',
                    'Permata' => 'https://upload.wikimedia.org/wikipedia/commons/3/38/Bank_Permata_logo.svg',
                    'BNI' => 'https://upload.wikimedia.org/wikipedia/id/5/55/BNI_logo.svg',
                    'Muamalat' => 'https://upload.wikimedia.org/wikipedia/commons/7/75/Bank_Muamalat_logo.svg'
                ];
                foreach($methods as $name => $logoUrl):
                ?>
                <div class="payment-accordion" data-method="<?= esc($name) ?>">
                    <div class="payment-header">
                        <div class="payment-name"><?= esc($name) ?></div>
                        <div class="payment-right">
                            <img src="<?= esc($logoUrl) ?>" class="payment-logo" alt="<?= esc($name) ?>" onerror="this.outerHTML='<span class=\'pay-icon\'><?= esc($name) ?></span>'">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="payment-body">
                        Anda memilih pembayaran menggunakan <?= esc($name) ?>. Silakan klik tombol Bayar Sekarang untuk mendapatkan instruksi pembayaran atau Virtual Account Number.
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Right Column -->
            <div class="right-column">
                <div class="user-info">
                    <div class="user-name"><?= esc($user['full_name']) ?></div>
                    <div class="user-detail"><?= esc($user['email']) ?></div>
                    <div class="user-detail"><?= esc($user['no_handphone'] ?? '-') ?></div>
                </div>
                
                <div class="divider"></div>
                
                <div class="item-row">
                    <div><?= esc($atraksi['title']) ?> (1)</div>
                    <div>Rp.<?= number_format($atraksi['price'], 0, ',', '.') ?></div>
                </div>
                
                <div class="seats-info">
                    Seats: <br>
                    Visit Date: <?= esc($visitDate) ?>
                </div>
                
                <div class="divider"></div>
                
                <div class="summary-row bold">
                    <div>Sub Total</div>
                    <div>Rp.<?= number_format($atraksi['price'], 0, ',', '.') ?></div>
                </div>
                
                <div class="voucher-box">
                    <input type="text" class="voucher-input" placeholder="Masukkan Voucher" readonly>
                    <div class="voucher-value">Rp.0</div>
                </div>
                
                <div class="summary-row">
                    <div>Biaya Layanan</div>
                    <div>Rp.3.000</div>
                </div>
                
                <div class="summary-row">
                    <div>Biaya Transaksi</div>
                    <div>Rp.0</div>
                </div>
                
                <div class="divider"></div>
                
                <div class="summary-row">
                    <div>Metode Pembayaran</div>
                    <div id="methodDisplay">...</div>
                </div>
                
                <div class="grand-total-row">
                    <div class="grand-total-label">Grand Total</div>
                    <div class="grand-total-value">Rp.<?= number_format($atraksi['price'] + 3000, 0, ',', '.') ?></div>
                </div>
                
                <button type="submit" class="btn-bayar" id="btnBayar" disabled>Bayar Sekarang</button>
            </div>
        </div>
    </form>

    <script>
        // Timer Logic
        let timeInSeconds = 10 * 60; // 10 minutes
        const timerDisplay = document.getElementById('timerDisplay');
        
        const timerInterval = setInterval(() => {
            const minutes = Math.floor(timeInSeconds / 60);
            const seconds = timeInSeconds % 60;
            timerDisplay.innerText = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            
            if(timeInSeconds <= 0) {
                clearInterval(timerInterval);
                alert('Waktu pembayaran habis. Anda akan diarahkan kembali.');
                window.location.href = '<?= base_url('atraksi/' . $atraksi['slug']) ?>';
            }
            timeInSeconds--;
        }, 1000);

        // Accordion Logic
        const accordions = document.querySelectorAll('.payment-accordion');
        const inputMethod = document.getElementById('selectedPaymentMethod');
        const methodDisplay = document.getElementById('methodDisplay');
        const btnBayar = document.getElementById('btnBayar');

        accordions.forEach(acc => {
            const header = acc.querySelector('.payment-header');
            header.addEventListener('click', () => {
                // close all
                accordions.forEach(a => {
                    if(a !== acc) a.classList.remove('active');
                });
                // toggle current
                acc.classList.toggle('active');
                
                if(acc.classList.contains('active')) {
                    const method = acc.getAttribute('data-method');
                    inputMethod.value = method;
                    methodDisplay.innerText = method;
                    btnBayar.disabled = false;
                    btnBayar.classList.add('active');
                } else {
                    inputMethod.value = '';
                    methodDisplay.innerText = '...';
                    btnBayar.disabled = true;
                    btnBayar.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>

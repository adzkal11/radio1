<?php
include __DIR__ . '/sistem/koneksi.php';

require_once __DIR__ . '/midtrans-php/Midtrans/Config.php';
require_once __DIR__ . '/midtrans-php/Midtrans/Snap.php';
require_once __DIR__ . '/midtrans-php/Midtrans/CoreApi.php';
require_once __DIR__ . '/midtrans-php/Midtrans/Transaction.php';
require_once __DIR__ . '/midtrans-php/Midtrans/Notification.php';
require_once __DIR__ . '/midtrans-php/Midtrans/ApiRequestor.php';
require_once __DIR__ . '/midtrans-php/Midtrans/Sanitizer.php';
require_once __DIR__ . '/midtrans-php/Midtrans/SnapApiRequestor.php';

\Midtrans\Config::$serverKey = 'Mid-server-4WzxdmAVx2sr1niruP9rqBQG';
\Midtrans\Config::$isProduction = false;

$order_id = mysqli_real_escape_string($koneksi, $_GET['order_id'] ?? '');
if (!$order_id) {
    echo "<h3>Order ID tidak valid.</h3>";
    exit;
}

$query = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE order_id = '$order_id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<h3>Transaksi tidak ditemukan.</h3>";
    exit;
}

// Ambil status dari Midtrans
$midtransStatus = \Midtrans\Transaction::status($order_id);
$status = $midtransStatus->transaction_status;
$pdf_url = $midtransStatus->pdf_url ?? null;

if ($status == 'settlement' || ($status == 'capture' && $midtransStatus->fraud_status == 'accept')) {
    $final_status = 'sukses';
} else if ($status == 'pending') {
    $final_status = 'pending';
} else {
    $final_status = 'gagal';
}

// Update status transaksi
mysqli_query($koneksi, "
    UPDATE transaksi 
    SET status = '$final_status', pdf_url = '$pdf_url'
    WHERE order_id = '$order_id'
");

echo "<h3 style='text-align:center;'>Terima kasih! Status pembayaran Anda: <b>{$final_status}</b></h3>";
?>

<?php if ($final_status === 'sukses'): ?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

body {
    font-family: 'Poppins', sans-serif;
    background-color: #fff0f6;
    padding: 20px;
}

.nota-container {
    background: linear-gradient(135deg, #fdfbfb, #ebedee);
    border: 3px dashed #f48fb1;
    border-radius: 16px;
    padding: 30px;
    max-width: 720px;
    margin: 30px auto;
    font-family: 'Poppins', sans-serif;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
}

.nota-header {
    text-align: center;
    margin-bottom: 25px;
}

.nota-header h2 {
    font-weight: 700;
    font-size: 26px;
    color: #ec407a;
}

.nota-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 40px;
}

.nota-table th, .nota-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px dashed #ccc;
    font-size: 15px;
}

.nota-table th {
    background-color: #ffe4ec;
    color: #c2185b;
    font-weight: 600;
}

.nota-footer {
    display: flex;
    justify-content: flex-end;
    margin-top: 30px;
}

.nota-footer-content {
    text-align: right;
}

.nota-total {
    font-size: 18px;
    font-weight: 700;
    color: #d81b60;
    margin-bottom: 10px;
}

.barcode-box img {
    max-width: 120px;
    height: auto;
}

.barcode-box p {
    font-size: 13px;
    color: #888;
    margin-top: 5px;
}

.invoice-link {
    display: inline-block;
    margin-top: 20px;
    background: #f48fb1;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    margin-right: 10px;
}

.invoice-link:hover {
    background: #ec407a;
}

@media print {
    body {
        background: white !important;
        color: black !important;
    }

    .invoice-link {
        display: none !important;
    }

    .nota-container {
        box-shadow: none;
        border: none;
        padding: 0;
        max-width: 100%;
    }

    .nota-table th {
        background-color: #f0f0f0 !important;
        color: black !important;
    }

    .nota-total, .barcode-box p {
        color: black !important;
    }
}
</style>

<div class="nota-container">
    <div class="nota-header">
        <h2>Nota Pembayaran Kamu</h2>
        <p>Terima kasih sudah menggunakan layanan kami</p>
    </div>

    <table class="nota-table">
        <thead>
            <tr>
                <th>Layanan</th>
                <th>Jadwal</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $queryDetail = mysqli_query($koneksi, "
            SELECT l.nama_produk, k.jml_pesan, l.harga, k.desain, k.catatan, k.tanggal_booking, k.jam_booking 
            FROM keranjang k
            JOIN layanan l ON k.id_produk = l.id_produk
            WHERE k.id_user = '{$data['id_user']}'
        ");
        $total = 0;
        while ($row = mysqli_fetch_assoc($queryDetail)):
            $subtotal = $row['jml_pesan'] * $row['harga'];
            if ($row['desain']) $subtotal += 60000;
            $total += $subtotal;
        ?>
            <tr>
                <td>
                    <?= $row['nama_produk'] ?>
                    <?php if ($row['catatan']): ?><br><small><em>Note: <?= $row['catatan'] ?></em></small><?php endif; ?>
                    <?php if ($row['desain']): ?><br><small><em>+ Biaya Desain Rp60.000</em></small><?php endif; ?>
                </td>
                <td><?= $row['tanggal_booking'] ?> <?= $row['jam_booking'] ?></td>
                <td><?= $row['jml_pesan'] ?>x</td>
                <td>Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <div class="nota-footer">
        <div class="nota-footer-content">
            <div class="nota-total">Total: Rp <?= number_format($total, 0, ',', '.') ?></div>
            <div class="barcode-box">
                <img src="assets/img/rri-barcode.png" alt="Barcode" />
                <p>*Scane Barcode Ini</p>
            </div>
        </div>
    </div>

    <?php if ($pdf_url): ?>
        <a class="invoice-link" href="<?= $pdf_url ?>" target="_blank">📄 Lihat / Download Invoice PDF</a>
    <?php endif; ?>

    <button onclick="window.print()" class="invoice-link">Cetak Nota</button>
</div>

<?php
// Hapus isi keranjang setelah transaksi sukses
$id_user = $data['id_user'];
mysqli_query($koneksi, "DELETE FROM keranjang WHERE id_user = '$id_user'");
endif;
?>

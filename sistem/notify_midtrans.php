<?php
// Logging POST data untuk debugging
file_put_contents('debug.txt', print_r($_POST, true));

// Load library Midtrans
require_once __DIR__ . '/../midtrans-php/Midtrans/Config.php';
require_once __DIR__ . '/../midtrans-php/Midtrans/Snap.php';
require_once __DIR__ . '/../midtrans-php/Midtrans/CoreApi.php';
require_once __DIR__ . '/../midtrans-php/Midtrans/Transaction.php';
require_once __DIR__ . '/../midtrans-php/Midtrans/Notification.php';
require_once __DIR__ . '/../midtrans-php/Midtrans/ApiRequestor.php';
require_once __DIR__ . '/../midtrans-php/Midtrans/Sanitizer.php';
require_once __DIR__ . '/../midtrans-php/Midtrans/SnapApiRequestor.php';

// Koneksi ke database
include '../koneksi.php'; // Pastikan path file ini benar

// Konfigurasi Midtrans
\Midtrans\Config::$serverKey = 'Mid-server-4WzxdmAVx2sr1niruP9rqBQG'; // Ganti dengan key milikmu
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

$json = file_get_contents('php://input');
$notif = json_decode($json);

$transaction_status = $notif->transaction_status;
$payment_type = $notif->payment_type;
$order_id = $notif->order_id;
$transaction_time = $notif->transaction_time;
$pdf_url = $notif->pdf_url ?? '';

$status = 'pending';
if ($transaction_status == 'settlement') {
    $status = 'sukses';
} elseif ($transaction_status == 'expire' || $transaction_status == 'cancel') {
    $status = 'gagal';
}

mysqli_query($koneksi, "UPDATE transaksi 
    SET status='$status', payment_type='$payment_type', transaction_time='$transaction_time', pdf_url='$pdf_url' 
    WHERE order_id='$order_id'");

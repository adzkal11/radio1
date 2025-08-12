<?php
require_once __DIR__ . '/../midtrans-php/Midtrans/Config.php';
require_once __DIR__ . '/../midtrans-php/Midtrans/Notification.php';

// Konfigurasi Midtrans
\Midtrans\Config::$serverKey = 'Mid-server-4WzxdmAVx2sr1niruP9rqBQG';
\Midtrans\Config::$isProduction = false;

// Koneksi ke DB
$koneksi = new mysqli("localhost", "root", "", "radio1"); // Ganti sesuai

// Tangkap notifikasi dari Midtrans
$notif = new \Midtrans\Notification();

$order_id = $notif->order_id;
$transaction_status = $notif->transaction_status;
$payment_type = $notif->payment_type;
$transaction_time = $notif->transaction_time;
$pdf_url = $notif->pdf_url ?? null;

// Default status ke 0 (belum bayar)
$status = 0;

// Ubah status berdasarkan status pembayaran
if ($transaction_status == 'settlement' || $transaction_status == 'capture') {
    $status = 1; // Menunggu Pengerjaan
} elseif ($transaction_status == 'expire' || $transaction_status == 'cancel') {
    $status = 0;
}

// Update ke tabel transaksi
$stmt = $koneksi->prepare("UPDATE transaksi SET status = ?, payment_type = ?, transaction_time = ?, pdf_url = ? WHERE order_id = ?");
$stmt->bind_param("issss", $status, $payment_type, $transaction_time, $pdf_url, $order_id);
$stmt->execute();

http_response_code(200); // Beri respons OK ke Midtrans

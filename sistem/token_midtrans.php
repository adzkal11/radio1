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

// ✅ Koneksi ke database
include __DIR__ . '/koneksi.php'; // 🔧 Diperbaiki path-nya

// Konfigurasi Midtrans
\Midtrans\Config::$serverKey = 'Mid-server-4WzxdmAVx2sr1niruP9rqBQG'; // Ganti dengan key kamu
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

header('Content-Type: application/json');

// Validasi input
if (!isset($_POST['nama_user'], $_POST['id_user'], $_POST['total'])) {
    echo json_encode(['error' => 'Data tidak lengkap']);
    exit;
}

$nama_user = $_POST['nama_user'];
$id_user = $_POST['id_user'];
$total = $_POST['total'];

$order_id = 'ORDER-' . time() . '-' . rand(100, 999);

// Transaksi Midtrans
$transaction = [
    'transaction_details' => [
        'order_id' => $order_id,
        'gross_amount' => (int)$total,
    ],
    'customer_details' => [
        'first_name' => $nama_user,
        'email' => 'user' . $id_user . '@example.com',
    ],
    'enabled_payments' => ['credit_card'], // Optional: Hanya tampilkan kartu kredit
];

$snapToken = \Midtrans\Snap::getSnapToken($transaction);

// Simpan transaksi awal ke DB
mysqli_query($koneksi, "
    INSERT INTO transaksi (order_id, id_user, nama_user, jumlah, status, transaction_time)
    VALUES ('$order_id', '$id_user', '$nama_user', '$total', 'pending', NOW())
");

echo json_encode(['token' => $snapToken]);

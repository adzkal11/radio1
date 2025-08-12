<?php
session_start();
include '../koneksi.php';
require_once '../vendor/autoload.php';
require_once '../midtrans_config.php'; // file ini memuat konfigurasi Midtrans kamu

// Pastikan user login
if (!isset($_SESSION['id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Anda harus login']);
    exit;
}

$id_user = $_SESSION['id'];
$subtotal = $_POST['subtotal'];
$total = $_POST['total'];

// Simpan transaksi ke database
$query = mysqli_query($koneksi, "INSERT INTO transaksi (id_user, subtotal, total, status, tanggal) VALUES ('$id_user', '$subtotal', '$total', 'pending', NOW())");

if (!$query) {
    http_response_code(500);
    echo json_encode(['error' => 'Gagal menyimpan transaksi: ' . mysqli_error($koneksi)]);
    exit;
}

$id_transaksi = mysqli_insert_id($koneksi);

// Ambil detail keranjang user
$produk = [];
$keranjang = mysqli_query($koneksi, "SELECT * FROM keranjang JOIN layanan ON keranjang.id_produk = layanan.id_produk WHERE id_user = '$id_user'");

while ($row = mysqli_fetch_assoc($keranjang)) {
    $harga = $row['harga'];
    $jumlah = $row['jml_pesan'];
    $total_harga = $harga * $jumlah;
    if ($row['desain'] == 1) $total_harga += 60000;

    // Simpan ke detail transaksi
    mysqli_query($koneksi, "INSERT INTO detail_transaksi (id_transaksi, id_produk, jml_pesan, harga, catatan, desain) VALUES ('$id_transaksi', '{$row['id_produk']}', '$jumlah', '$harga', '{$row['catatan']}', '{$row['desain']}')");

    $produk[] = [
        'id' => $row['id_produk'],
        'price' => $harga,
        'quantity' => $jumlah,
        'name' => $row['nama_produk']
    ];

    if ($row['desain'] == 1) {
        $produk[] = [
            'id' => 'desain',
            'price' => 60000,
            'quantity' => 1,
            'name' => 'Biaya Desain'
        ];
    }
}

// Hapus keranjang user setelah checkout
mysqli_query($koneksi, "DELETE FROM keranjang WHERE id_user = '$id_user'");

// Buat Snap Token
$transaction_details = [
    'order_id' => 'ORDER-' . $id_transaksi,
    'gross_amount' => (int) $total
];

$customer_details = [
    'first_name' => $_SESSION['nama'],
    'email' => $_SESSION['email'],
];

$payload = [
    'transaction_details' => $transaction_details,
    'item_details' => $produk,
    'customer_details' => $customer_details
];

try {
    $snapToken = \Midtrans\Snap::getSnapToken($payload);
    header('Content-Type: application/json');
    echo json_encode(['snapToken' => $snapToken]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Gagal membuat Snap Token: ' . $e->getMessage()]);
}

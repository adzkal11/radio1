<?php
require_once 'vendor/autoload.php'; // Pastikan path ini sesuai dengan lokasi autoload.php

\Midtrans\Config::$serverKey = 'SERVER-KEY-ANDA';
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

// Ambil notifikasi dari Midtrans (JSON)
$json_result = file_get_contents('php://input');
$notification = json_decode($json_result);

// Debug log (opsional, bisa hapus ini di production)
file_put_contents("notif_log.txt", $json_result . PHP_EOL, FILE_APPEND);

// Proses notifikasi hanya jika ada
if ($notification) {
    $status = $notification->transaction_status;
    $order_id = $notification->order_id;

    // Koneksi ke database
    $koneksi = new mysqli("localhost", "root", "", "radio1");

    // Cek koneksi
    if ($koneksi->connect_error) {
        http_response_code(500);
        exit("Database connection failed: " . $koneksi->connect_error);
    }

    // Update status transaksi di database
    if ($status == 'settlement' || $status == 'capture') {
        $id = str_replace('ORDER-', '', $order_id);
        $sql = "UPDATE transaksi SET status='berhasil' WHERE id_transaksi='$id'";
    } elseif ($status == 'pending') {
        $sql = "UPDATE transaksi SET status='pending' WHERE id_transaksi='$order_id'";
    } elseif ($status == 'expire' || $status == 'cancel' || $status == 'deny') {
        $sql = "UPDATE transaksi SET status='gagal' WHERE id_transaksi='$order_id'";
    }

    if (isset($sql)) {
        $koneksi->query($sql);
    }

    // Response OK ke Midtrans
    http_response_code(200);
}

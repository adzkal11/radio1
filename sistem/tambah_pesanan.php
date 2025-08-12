<?php
session_start();
include_once "koneksi.php";

if (isset($_POST['simpan'])) {
    $id_produk        = $_POST['id_produk'];
    $jml_pesanan      = $_POST['jml_pesan'];
    $catatan          = $_POST['catatan'];
    $desain           = isset($_POST['desain']) ? 1 : 0;
    $id_user          = $_SESSION['id'] ?? 0;
    $tanggal_booking  = $_POST['tanggal_booking'];
    $jam_booking      = $_POST['jam_booking'];

    // Validasi user login
    if (!$id_user) {
        $_SESSION['pesan'] = ['status' => 'danger', 'isi' => 'Anda harus login terlebih dahulu.'];
        header('Location: ../login.php');
        exit;
    }

    // Validasi tanggal dan jam booking tidak boleh ke masa lalu
    $booking_time = strtotime("$tanggal_booking $jam_booking");
    if ($booking_time < time()) {
        $_SESSION['pesan'] = ['status' => 'danger', 'isi' => 'Tanggal dan jam booking tidak boleh di masa lalu.'];
        header('Location: ../index.php?page=detail_produk&id=' . $id_produk);
        exit;
    }

    // Default path file
    $fullpath = '';

    if (isset($_FILES['ilustrasi']) && $_FILES['ilustrasi']['error'] == 0) {
        $file = $_FILES['ilustrasi'];
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = time() . '_' . rand(100, 999) . '.' . $ext;

        $folder_user = strtolower(str_replace(' ', '_', $_SESSION['nama']));
        $path_upload = "../upload/$folder_user/";

        if (!file_exists($path_upload)) {
            mkdir($path_upload, 0777, true);
        }

        move_uploaded_file($file['tmp_name'], $path_upload . $filename);
        $fullpath = str_replace('../', '', $path_upload) . $filename;
    }

    // Simpan ke keranjang
    $query = mysqli_query($koneksi, "INSERT INTO keranjang 
        (jml_pesan, desain, file, catatan, id_produk, id_user, tanggal_booking, jam_booking) 
        VALUES ('$jml_pesanan', '$desain', '$fullpath', '$catatan', '$id_produk', '$id_user', '$tanggal_booking', '$jam_booking')");

    if ($query) {
        $check = mysqli_query($koneksi, "SELECT COUNT(*) as jml FROM keranjang WHERE id_user = '$id_user'");
        $result = mysqli_fetch_assoc($check);
        $_SESSION['jml_keranjang'] = $result['jml'];

        $_SESSION['pesan'] = ['status' => 'success', 'isi' => 'Pesanan berhasil disimpan.'];
        header('Location: ../index.php?page=keranjang');
    } else {
        $_SESSION['pesan'] = ['status' => 'danger', 'isi' => 'Pesanan gagal disimpan. Error: ' . mysqli_error($koneksi)];
        header('Location: ../index.php?page=detail_produk&id=' . $id_produk);
    }
} else {
    $_SESSION['pesan'] = ['status' => 'danger', 'isi' => 'Form tidak dikirim'];
    header('Location: ../index.php?page=detail_produk&id=' . ($_POST['id_produk'] ?? ''));
}

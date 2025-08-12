<?php
session_start();
include_once "../../sistem/koneksi.php";

if (isset($_POST['simpan'])) {
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $keterangan = $_POST['keterangan'];
    $gambar = '';

    if (!empty($_FILES['gambar']['name']) && $_FILES['gambar']['error'] == 0) {
        $file = $_FILES['gambar'];
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = strtolower(str_replace(' ', '-', pathinfo($file['name'], PATHINFO_FILENAME))) . '.' . $ext;
        $path_upload = '../../assets/img/layanan/';
        if (!file_exists($path_upload)) mkdir($path_upload, 0777, true);
        move_uploaded_file($file['tmp_name'], $path_upload . $filename);
        $gambar = 'assets/img/layanan/' . $filename;
    }

    $query = mysqli_query($koneksi, "INSERT INTO layanan (nama_produk, harga, gambar, keterangan) 
                        VALUES ('$nama_produk', '$harga', '$gambar', '$keterangan')");

    $_SESSION['pesan'] = [
        'status' => $query ? 'success' : 'danger',
        'isi' => $query ? 'Layanan berhasil ditambahkan' : 'Layanan gagal ditambahkan'
    ];
}
header('Location: ../index.php?page=layanan');

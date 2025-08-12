<?php
session_start();
include_once "../../sistem/koneksi.php";

if (isset($_POST['simpan'])) {
    $id_produk   = $_POST['id_produk'];
    $nama_produk = $_POST['nama_produk'];
    $harga       = $_POST['harga'];
    $keterangan  = $_POST['keterangan'];
    $update_gambar = "";

    // Jika ada file gambar diupload
    if (!empty($_FILES['gambar']['name']) && $_FILES['gambar']['error'] == 0) {
        $file       = $_FILES['gambar'];
        $ext        = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename   = strtolower(str_replace(' ', '-', pathinfo($file['name'], PATHINFO_FILENAME))) . '.' . $ext;
        $path_upload = "../../assets/img/layanan/";

        // Buat folder jika belum ada
        if (!file_exists($path_upload)) {
            mkdir($path_upload, 0777, true);
        }

        // Simpan file gambar ke folder tujuan
        if (move_uploaded_file($file['tmp_name'], $path_upload . $filename)) {
            $fullpath = "assets/img/layanan/$filename";
            $update_gambar = ", gambar = '$fullpath'";
        }
    }

    // Update data layanan
    $query = mysqli_query($koneksi, "
        UPDATE layanan 
        SET nama_produk = '$nama_produk',
            harga = '$harga',
            keterangan = '$keterangan'
            $update_gambar
        WHERE id_produk = '$id_produk'
    ");

    // Set notifikasi sesi
    $_SESSION['pesan'] = [
        'status' => $query ? 'success' : 'danger',
        'isi'    => $query ? 'Layanan berhasil diubah' : 'Layanan gagal diubah'
    ];
} else {
    $_SESSION['pesan'] = [
        'status' => 'danger',
        'isi'    => 'Data tidak lengkap untuk mengubah layanan.'
    ];
}

// Redirect ke halaman layanan
header('Location: ../index.php?page=layanan');
exit;

<?php
session_start();
include_once __DIR__ . '/../sistem/koneksi.php'; // sesuaikan path

// Tangkap id dari GET, baik 'id' maupun 'id_user'
$id_user = null;
if (isset($_GET['id_user'])) {
    $id_user = filter_var($_GET['id_user'], FILTER_VALIDATE_INT);
} elseif (isset($_GET['id'])) {
    $id_user = filter_var($_GET['id'], FILTER_VALIDATE_INT);
}

$return = $_SERVER['HTTP_REFERER'] ?? '../user.php';

if (!$id_user) {
    $_SESSION['pesan'] = ['status' => 'danger', 'isi' => 'ID user tidak valid!'];
    header("Location: $return");
    exit;
}

// Ambil foto user
$stmt = $koneksi->prepare("SELECT foto FROM user WHERE id_user = ?");
$stmt->bind_param("i", $id_user);
$stmt->execute();
$stmt->bind_result($foto);
$found = $stmt->fetch();
$stmt->close();

if (!$found) {
    $_SESSION['pesan'] = ['status' => 'warning', 'isi' => 'User tidak ditemukan!'];
    header("Location: $return");
    exit;
}

// Hapus foto fisik jika ada dan bukan default
if (!empty($foto) && $foto !== 'no-foto.png') {
    $foto_path = __DIR__ . '/../assets/img/foto/' . $foto;
    if (file_exists($foto_path)) {
        @unlink($foto_path);
    }
}

// Hapus user dari DB
$stmt = $koneksi->prepare("DELETE FROM user WHERE id_user = ?");
$stmt->bind_param("i", $id_user);
$exec = $stmt->execute();
$stmt->close();

if ($exec) {
    $_SESSION['pesan'] = ['status' => 'success', 'isi' => 'User berhasil dihapus!'];
} else {
    $_SESSION['pesan'] = ['status' => 'danger', 'isi' => 'Gagal menghapus user!'];
}

header("Location: $return");
var_dump($_GET);
exit;


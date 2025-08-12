<?php
include_once '../sistem/koneksi.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function is_login($role = 'admin') {
    if (!isset($_SESSION['login']) || $_SESSION['level'] !== $role) {
        header("Location: ../login.php");
        exit();
    }
}

is_login('admin');

$page = $_GET['page'] ?? 'dashboard';

switch ($page) {
    case 'dashboard':
        $dashboard_active = 'active';
        $page_header = 'Dashboard';
        $page = 'dashboard.php';
        break;

    case 'tentang':
        $tentang_active = 'active';
        $page_header = 'Tentang';
        $page = 'tentang.php';
        break;

    case 'layanan': // perbaikan di sini
        $layanan_active = 'active';
        $page_header = 'Katalog Layanan';
        $page = 'layanan.php';
        break;

    case 'tambah_layanan':
        $layanan_active = 'active';
        $page_header = 'Tambah Layanan';
        $page = 'tambah_layanan.php';
        break;

    case 'edit_layanan':
        $layanan_active = 'active';
        $page_header = 'Edit Layanan';
        $page = 'edit_layanan.php';
        break;

    case 'user':
        $user_active = 'active';
        $page_header = 'Daftar User';
        $page = 'user.php';
        break;

    case 'pesanan':
        $pesanan_active = 'active';
        $page_header = 'Daftar Pesanan';
        $page = 'pesanan.php';
        break;

    case 'report':
        $report_active = 'active';
        $page_header = 'Laporan';
        $page = 'report.php';
        break;

    case 'profil':
        $page_header = 'Profil Admin';
        $page = 'profil_user.php';
        break;

    case 'kontak':
        $kontak_active = 'active';
        $page_header = 'Kontak Pesan';
        $page = 'kontak.php';
        break;

    default:
        $dashboard_active = 'active';
        $page_header = 'Dashboard';
        $page = 'dashboard.php';
        break;
}

<?php
include_once 'koneksi.php';
include_once 'fungsi.php'; // Pastikan file ini berisi definisi is_login()

$get_page = isset($_GET['page']) ? $_GET['page'] : '';
switch ($get_page) {
    case 'home':
        $home_active = 'active';
        $page = "views/home.php";
        break;

    case 'layanan':
        $produk_active = 'active';
        $page = "views/layanan.php";
        break;

    case 'detail_layanan':
        is_login('user');
        $produk_active = 'active';
        $page = "views/detail_layanan.php";
        break;

    case 'keranjang':
        is_login('user');
        $keranjang_active = 'active';
        $page = "views/keranjang.php";
        break;

    case 'riwayat':
        is_login('user');
        $riwayat_active = 'active';
        $page = "views/riwayat.php";
        break;

    case 'tentang':
        $tentang_active = 'active';
        $page = "views/tentang.php";
        break;

    case 'profil':
        is_login('user');
        $profil_active = 'active';
        $page = "views/profil.php";
        break;

    case 'edit_profil':
        is_login('user');
        $profil_active = 'active';
        $page = "views/edit_profil.php";
        break;

    case 'edit_password':
        is_login('user');
        $profil_active = 'active';
        $page = "views/edit_password.php";
        break;

    default:
        $home_active = 'active';
        $page = "views/home.php";
        break;
}
?>
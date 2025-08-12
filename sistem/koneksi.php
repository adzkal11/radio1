<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$koneksi = mysqli_connect('localhost', 'root', '', 'radio1');

if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

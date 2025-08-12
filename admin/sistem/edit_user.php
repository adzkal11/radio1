<?php
include_once '../../sistem/koneksi.php';
session_start();

$id_user = $_POST['id_user'];
$nama    = $_POST['nama'];
$email   = $_POST['email'];
$telp    = $_POST['telp'];

$foto = $_FILES['foto']['name'];

if ($foto != '') {
    $ext      = pathinfo($foto, PATHINFO_EXTENSION);
    $filename = 'user_' . time() . '.' . $ext;

    // Pindahkan file foto baru
    move_uploaded_file($_FILES['foto']['tmp_name'], '../../assets/img/foto/' . $filename);

    // Update dengan foto baru
    $query = mysqli_query($koneksi, "
        UPDATE user 
        SET nama='$nama', 
            email='$email', 
            telp='$telp', 
            foto='$filename' 
        WHERE id_user='$id_user'
    ");
} else {
    // Update tanpa ganti foto
    $query = mysqli_query($koneksi, "
        UPDATE user 
        SET nama='$nama', 
            email='$email', 
            telp='$telp' 
        WHERE id_user='$id_user'
    ");
}

if ($query) {
    $_SESSION['pesan'] = ['status' => 'success', 'isi' => 'User berhasil diedit'];
} else {
    $_SESSION['pesan'] = ['status' => 'danger', 'isi' => 'Gagal mengedit user'];
}

header('location: ../index.php?page=user');
exit;
?>

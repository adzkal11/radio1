<?php
include_once '../../sistem/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama  = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $telp  = mysqli_real_escape_string($koneksi, $_POST['telp']);

    $foto = '';

    if (!empty($_FILES['foto']['name'])) {
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
        $file_name   = $_FILES['foto']['name'];
        $file_tmp    = $_FILES['foto']['tmp_name'];
        $file_ext    = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (in_array($file_ext, $allowed_ext)) {
            $new_name   = time() . '_' . uniqid() . '.' . $file_ext;
            $upload_dir = '../../assets/img/foto/';

            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            if (move_uploaded_file($file_tmp, $upload_dir . $new_name)) {
                $foto = $new_name;
            } else {
                die("Gagal mengupload foto!");
            }
        } else {
            die("Format file tidak didukung. Hanya JPG, JPEG, PNG, GIF.");
        }
    }

    $sql = "INSERT INTO user (nama, email, telp, foto) VALUES ('$nama', '$email', '$telp', '$foto')";
    if (mysqli_query($koneksi, $sql)) {
        header("Location: ../user.php?status=sukses");
        exit;
    } else {
        die("Gagal menambahkan user: " . mysqli_error($koneksi));
    }
} else {
    header("Location: ../user.php");
    exit;
}
?>

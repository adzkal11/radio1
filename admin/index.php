<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once 'sistem/content.php';

if (!isset($_SESSION['login'])) {
    header('location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RRI Kota Padang <?= $page_header ?></title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="../assets/plugins/datatables/datatables.min.css">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="../assets/fonts/font-awesome/css/font-awesome.min.css">

    <!-- AdminLTE -->
    <link rel="stylesheet" href="../assets/css/adminLTE.min.css">

    <!-- Cute Custom Style -->
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #fff5fb;
        }

        .main-header, .main-sidebar {
            background: linear-gradient(to right, #ff9a9e, #fad0c4);
        }

        .logo {
            font-weight: bold;
            font-size: 18px;
            color: white !important;
        }

        .navbar-nav > li > a {
            color: white !important;
            font-weight: 600;
        }

        .navbar-nav > li > a:hover {
            background-color: rgba(255,255,255,0.3);
            border-radius: 8px;
        }

        .sidebar-menu > li > a {
            border-radius: 12px;
            margin: 5px 10px;
            color: white !important;
            font-weight: 600;
            transition: all 0.2s ease-in-out;
        }

        .sidebar-menu > li.active > a,
        .sidebar-menu > li > a:hover {
            background-color: white !important;
            color: #ff69b4 !important;
        }

        .user-panel {
            background-color: #ffeef8;
            padding: 10px;
            border-radius: 20px;
            margin: 0px;
        }

        .user-panel img {
            border: 2px solid #fff;
        }

        .content-wrapper {
            background-color: #ffffff;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            padding: 20px;
        }

        .content-header h1 {
            color: #ff69b4;
            font-weight: 600;
        }

        .btn-flat {
            border-radius: 10px;
        }

        .alert {
            border-radius: 10px;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Header -->
        <header class="main-header">
            <a href="index.php" class="logo">
                <span class="logo-mini"><b>RRI</b></span>
                <span class="logo-lg"><b>RRI Kota Padang</b></span>
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <!-- Navbar Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Main Menu in Navbar -->
                        <li><a href="index.php?page=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                        <li><a href="index.php?page=layanan"><i class="fa fa-cubes"></i> Layanan</a></li>
                        <li><a href="index.php?page=user"><i class="fa fa-users"></i> User</a></li>
                        <li><a href="index.php?page=pesanan"><i class="fa fa-list"></i> Pemesanan</a></li>
                        <li><a href="index.php?page=report"><i class="fa fa-list-alt"></i> Laporan</a></li>

                        <!-- User Dropdown -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="../<?= $_SESSION['foto'] ?>" class="user-image" alt="<?= $_SESSION['nama'] ?>">
                                <span class="hidden-xs"><?= $_SESSION['nama'] ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="../<?= $_SESSION['foto'] ?>" class="img-circle" alt="<?= $_SESSION['nama'] ?>">
                                    <p><?= $_SESSION['nama'] ?></p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="index.php?page=profil" class="btn btn-default btn-flat">Profil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="../sistem/logout.php" class="btn btn-default btn-flat">Logout</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Sidebar -->
        <aside class="main-sidebar">
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="../<?= $_SESSION['foto'] ?>" class="img-circle" alt="<?= $_SESSION['nama'] ?>" width="45">
                    </div>
                    <div class="pull-left info">
                        <p><?= $_SESSION['nama'] ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
            </section>
        </aside>

        <!-- Content -->
        <div class="content-wrapper">
            <section class="content-header">
                <h1><?= $page_header ?></h1>
            </section>

            <section class="content container-fluid">
                <?php if (@$_SESSION['pesan']): ?>
                    <div class="alert alert-<?= $_SESSION['pesan']['status'] ?> alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?= $_SESSION['pesan']['isi'] ?>
                    </div>
                <?php endif; ?>

                <?php include_once 'views/' . $page ?>
            </section>
        </div>
    </div>

    <!-- Scripts -->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/AdminLTE.min.js"></script>
    <script src="../assets/plugins/tinymce/tinymce.min.js"></script>
    <script src="../assets/plugins/datatables/datatables.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.data-table').dataTable();
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>
</html>
<?php unset($_SESSION['pesan']) ?>

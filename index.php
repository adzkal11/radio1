<?php
session_start();
include_once "sistem/content.php";

// Default halaman jika tidak ada yang dipilih
$page = $page ?? 'views/home.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>RRI Kota Padang | Aplikasi Pembookingan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Fonts & CSS -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Serif:400,400italic,700|Open+Sans:300,400,600,700">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/flexslider.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/skins/default.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">


  <style>
    body {
  font-family: 'Poppins', sans-serif;
  background: #fefcff;
}

.navbar {
  background: linear-gradient(to right, #a1c4fd, #c2e9fb);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
  transition: all 0.3s ease-in-out;
  font-weight: 600;
  border-radius: 0 0 24px 24px;
  padding: 0.8rem 1rem;
  position: fixed;
  width: 100%;
  top: 0;
  z-index: 999;
}

.navbar-logo img {
  max-height: 64px;
  transition: transform 0.3s ease-in-out;
}

.navbar-logo img:hover {
  transform: rotate(-5deg) scale(1.05);
}

.navbar a {
  color: #fff !important;
  transition: all 0.3s ease;
  font-size: 1rem;
  position: relative;
  text-shadow: 1px 1px 0 #6fb1fc;
}

.navbar a:hover {
  color: #ffffff !important;
  text-shadow: 0 0 8px #00e0ff, 0 0 12px #00e0ff;
}

.navbar a::after {
  content: "";
  position: absolute;
  width: 0%;
  height: 2px;
  background: #ffffff;
  bottom: -6px;
  left: 0;
  transition: width 0.3s ease-in-out;
}

.navbar a:hover::after {
  width: 100%;
}

.dropdown-menu {
  background-color: #fff0fb;
  border-radius: 16px;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
  padding: 12px;
  margin-top: 18px;
  border: none;
  animation: fadeInDown 0.3s ease;
}

.dropdown-menu a {
  color: #6f42c1 !important;
  font-weight: 500;
  border-radius: 12px;
  padding: 8px 14px;
  transition: all 0.2s ease-in-out;
}

.dropdown-menu a:hover {
  background-color: #fceaff;
  color: #9c27b0 !important;
}

.scrollup {
  background: #ff85c1;
  color: white;
  padding: 10px 16px;
  border-radius: 50px;
  position: fixed;
  right: 20px;
  bottom: 20px;
  display: none;
  z-index: 999;
  font-size: 14px;
  box-shadow: 0 8px 16px rgba(255, 133, 193, 0.4);
  transition: all 0.2s ease;
}

.scrollup:hover {
  background: #f06292;
}

@keyframes fadeInDown {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Tambahkan ini untuk memberi jarak antara navbar dan konten */
.main-content,
section:first-of-type {
  margin-top: 70px;
}

/* Responsive Navbar */
@media (max-width: 992px) {
  .navbar {
    padding: 0.6rem 1rem;
    border-radius: 0;
  }

  .navbar a {
    font-size: 0.95rem;
  }

  .navbar-logo img {
    max-height: 150px;
    max-width: 150px;
  }

  .navbar-collapse {
    background-color: rgba(255, 255, 255, 0.95);
    border-radius: 16px;
    padding: 1rem;
    margin-top: 10px;
  }

  .navbar-nav .nav-item {
    margin-bottom: 8px;
  }

  .dropdown-menu {
    position: relative !important;
    float: none;
    box-shadow: none;
    margin-top: 10px;
  }
}

/* Responsive Layanan Card */
@media (max-width: 768px) {
  .service-card .card-img-top {
    height: 180px;
  }

  .service-card .card-title {
    font-size: 1.2rem;
  }

  .service-card .card-text {
    font-size: 0.9rem;
  }

  .service-card {
    margin-bottom: 1.5rem;
  }

  .section-heading {
    font-size: 1.5rem;
  }

  .scrollup {
    padding: 8px 12px;
    font-size: 12px;
  }
}

/* Extra small devices (≤576px) */
@media (max-width: 576px) {
  .navbar a {
    font-size: 0.9rem;
  }

  .navbar-logo img {
    max-height: 48px;
  }

  .service-card .card-img-top {
    height: 150px;
  }

  .service-card .card-title {
    font-size: 1.1rem;
  }

  .service-card .card-body {
    padding: 1.2rem;
  }

  .service-card .btn {
    padding: 8px 12px;
    font-size: 0.85rem;
  }
}

  </style>
</head>

<body>
  <section id="header" class="appear"></section>

  <div class="navbar navbar-fixed-top" role="navigation">
    <div class="container" style="overflow: unset">
      <div class="navbar-header d-flex">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="fa fa-bars color-white"></span>
        </button>
        <div class="navbar-logo col-sm-3">
          <a href="index.php">
            <img src="assets/img/rri/rri-logo1.png" alt="Logo RRI" width="300%">
          </a>
        </div>
      </div>

      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav" style="margin-top: 25px;">
          <li class="<?= @$home_active ?>"><a href="index.php"><i class="fa fa-home"></i> Beranda</a></li>
          <li class="<?= @$produk_active ?>"><a href="index.php?page=layanan"><i class="fa fa-list"></i> Daftar Layanan</a></li>
          <?php if (isset($_SESSION['login']) && $_SESSION['level'] == 'user'): ?>
            <li class="<?= @$profil_active ?> dropdown">
              <a href="#" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user"></i> Profil &nbsp;<span class="caret"></span>
              </a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li><a href="index.php?page=profil"><?= $_SESSION['nama'] ?? 'Profil' ?></a></li>
                <li><a href="index.php?page=riwayat">Riwayat Pesanan</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="sistem/logout.php">Logout</a></li>
              </ul>
            </li>
            <li class="<?= @$keranjang_active ?>">
              <a href="index.php?page=keranjang">
                <i class="fa fa-shopping-cart"></i> Keranjang (<?= $_SESSION['jml_keranjang'] ?? 0 ?>)
              </a>
            </li>
          <?php else: ?>
            <li class="<?= @$login_active ?>"><a href="login.php"><i class="fa fa-sign-in-alt"></i> Login</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </div>

  <div class="main-content container">
    <?php
    if (isset($_SESSION['pesan'])) {
     // jika user adalah array
if (isset($_SESSION['user']) && is_array($_SESSION['user'])) {
  echo $_SESSION['user']['nama']; // sesuaikan key-nya
}
    }

    if (file_exists($page)) {
      include $page;
    } else {
      echo "<div class='alert alert-warning text-center'>Halaman tidak ditemukan!</div>";
    }
    ?>
  </div>

  <a href="#header" class="scrollup"><i class="fa fa-chevron-up"></i></a>

  <!-- JS -->
  <script src="assets/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/jquery.easing.1.3.js"></script>
  <script src="assets/js/jquery.flexslider-min.js"></script>
  <script src="assets/js/jquery.localScroll.min.js"></script>
  <script src="assets/js/skrollr.min.js"></script>
  <script src="assets/js/main.js"></script>

  <script>
    $(window).scroll(function() {
      if ($(this).scrollTop() > 200) {
        $('.scrollup').fadeIn();
      } else {
        $('.scrollup').fadeOut();
      }
    });

    $('.scrollup').click(function() {
      $("html, body").animate({ scrollTop: 0 }, 600);
      return false;
    });
  </script>
</body>
</html>

<?php unset($_SESSION['pesan']); ?>

<?php
if ($koneksi) {
  $query_produk = mysqli_query($koneksi, "SELECT * FROM kategori WHERE gambar != '' LIMIT 0, 5");
  $query_testi = mysqli_query($koneksi, "SELECT testimoni.pesan, user.nama, user.foto FROM testimoni JOIN user ON testimoni.id_user = user.id_user WHERE status = '1'");
} else {
  echo "Gagal koneksi ke database!";
}
?>

<!-- Banner Section -->
<section id="intro">
  <div class="flexslider banner-slider">
    <ul class="slides">
      <li>
        <div class="banner">
          <img src="assets/img/rri/rri7.jpg">
          <div class="banner-content">
            <!-- Optional Welcome Text -->
          </div>
        </div>
      </li>
      <li>
        <div class="banner">
          <img src="assets/img/rri/rri8.jpg">
          <div class="banner-content">
            <!-- Optional Welcome Text -->
          </div>
        </div>
      </li>
    </ul>
  </div>
</section>

<!-- Kategori Produk -->
<section id="kategori" class="section" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row mar-bot30">
      <div class="col-md-6 col-md-offset-3">
        <div class="section-header text-center">
          <h2 class="section-heading animated" data-animation="bounceInUp">Layanan Kami</h2>
          <p>Inilah beberapa layanan yang kalian bisa pesan/booking untuk kebutuhan kalian ya.</p>
        </div>
      </div>
    </div>
    
    <section class="py-5 bg-light">
  <div class="container">
    <div class="row">

    <style>
    /* Font */
body, h1, h2, h3, h4, h5, p, a {
  font-family: 'Poppins', sans-serif;
}

/* Section Heading */
.section-heading {
  font-size: 4rem;
  font-weight: 700;
  color: #007acc;
  margin-bottom: 10px;
}

.section-header p {
  font-size: 1.5rem;
  color: #666;
}

/* Banner */
.banner img {
  width: 100%;
  max-height: 900px;
  object-fit: cover;
  filter: brightness(0.9);
  border-radius: 16px;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
}

/* Cute Layanan Card - Bigger Version */
.service-card {
  border: none;
  border-radius: 25px;
  overflow: hidden;
  background: linear-gradient(135deg, #fff3fd, #e1f5fe);
  box-shadow: 0 14px 32px rgba(0, 0, 0, 0.08);
  transition: all 0.35s ease;
  position: relative;
  min-height: 420px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.service-card:hover {
  transform: translateY(-10px) rotate(-0.3deg);
  box-shadow: 0 22px 45px rgba(0, 0, 0, 0.12);
}

.service-card::after {
  content: '';
  position: absolute;
  top: -18px;
  right: -18px;
  width: 65px;
  height: 65px;
  background: url('https://img.icons8.com/color/48/strawberry.png') no-repeat center center;
  background-size: contain;
  opacity: 0.05;
  transform: rotate(15deg);
}

/* Gambar */
.service-card .card-img-top {
  height: 250px;
  object-fit: cover;
  transition: transform 0.4s ease;
  border-bottom: 5px solid #ffe0f9;
}

.service-card:hover .card-img-top {
  transform: scale(1.06);
}

/* Konten */
.service-card .card-body {
  padding: 2rem;
  text-align: center;
  background-color: rgba(255, 255, 255, 0.9);
}

.service-card .card-title {
  font-size: 1.6rem;
  font-weight: 800;
  color: #7e3ff2;
  margin-bottom: 1rem;
}

.service-card .card-text {
  font-size: 1.05rem;
  color: #444;
  margin-bottom: 1.6rem;
  line-height: 1.6;
}

/* Tombol */
.service-card .btn {
  border-radius: 20px;
  font-weight: 600;
  font-size: 1.05rem;
  padding: 12px 22px;
  transition: all 0.3s ease-in-out;
}

.btn-outline-primary {
  border-color: #cbaaff;
  color: #7e3ff2;
}

.btn-outline-primary:hover {
  background-color: #e9d7ff;
  color: white;
}

.btn-outline-success {
  border-color: #a8e6a3;
  color: #2e7d32;
}

.btn-outline-success:hover {
  background-color: #d2fbd2;
  color: white;
}

.btn-outline-warning {
  border-color: #ffe082;
  color: #f9a825;
}

.btn-outline-warning:hover {
  background-color: #fff3c1;
  color: white;
}

.btn-outline-info {
  border-color: #9be7ff;
  color: #0277bd;
}

.btn-outline-info:hover {
  background-color: #d5f6ff;
  color: white;
}

/* Responsive tweaks */
@media (max-width: 768px) {
  .service-card {
    min-height: unset;
  }

  .service-card .card-title {
    font-size: 1.4rem;
  }

  .service-card .card-text {
    font-size: 0.95rem;
  }

  .service-card .btn {
    font-size: 0.95rem;
  }
}

</style>

      <!-- Siaran Radio -->
      <div class="col-md-6 col-lg-3 mb-4">
        <div class="card service-card h-100">
          <img src="assets/img/rri/rri1.jpg" class="card-img-top" alt="Studio siaran radio">
          <div class="card-body">
            <h4 class="card-title fw-bold">Siaran Radio</h4>
            <p class="card-text">Jasa siaran radio untuk berbagai keperluan baik komersial maupun non-komersial.</p>
            <div class="d-grid">
              <a href="index.php?page=detail_layanan&id=1" class="btn btn-outline-primary">Detail Layanan</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Produksi Iklan -->
      <div class="col-md-6 col-lg-3 mb-4">
        <div class="card service-card h-100">
          <img src="assets/img/rri/rri2.jpg" class="card-img-top" alt="Tim produksi iklan">
          <div class="card-body">
            <h4 class="card-title fw-bold">Spot Iklan</h4>
            <p class="card-text">Layanan pembuatan dan penyiaran iklan radio dengan kualitas profesional.</p>
            <div class="d-grid">
              <a href="index.php?page=detail_layanan&id=2" class="btn btn-outline-success">Detail Layanan</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Auditorium -->
      <div class="col-md-6 col-lg-3 mb-4">
        <div class="card service-card h-100">
          <img src="assets/img/rri/rri3.jpg" class="card-img-top" alt="Auditorium">
          <div class="card-body">
            <h4 class="card-title fw-bold">Auditorium</h4>
            <p class="card-text">Tersedia ruangan auditorium yang nyaman untuk berbagai acara dan kegiatan.</p>
            <div class="d-grid">
              <a href="index.php?page=detail_layanan&id=3" class="btn btn-outline-warning">Detail Layanan</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Ruangan Multipurpose -->
      <div class="col-md-6 col-lg-3 mb-4">
        <div class="card service-card h-100">
          <img src="assets/img/rri/rri4.jpg" class="card-img-top" alt="Ruangan multipurpose">
          <div class="card-body">
            <h4 class="card-title fw-bold">Ruangan Multipurpose</h4>
            <p class="card-text">Fasilitas ruangan serbaguna untuk rapat, pelatihan, atau kegiatan lainnya.</p>
            <div class="d-grid">
              <a href="index.php?page=detail_layanan&id=4" class="btn btn-outline-info">Detail Layanan</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


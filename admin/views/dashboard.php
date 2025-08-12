<?php
include __DIR__ . '/../../sistem/koneksi.php';

// Query per jenis layanan
$radio = mysqli_fetch_assoc(mysqli_query($koneksi, "
    SELECT COUNT(DISTINCT t.id_transaksi) AS jml 
    FROM transaksi t
    JOIN detail_transaksi dt ON t.id_transaksi = dt.id_transaksi
    JOIN layanan l ON dt.id_produk = l.id_produk
    WHERE l.nama_produk LIKE '%Siaran Radio%' AND t.status < 4
"));

$iklan = mysqli_fetch_assoc(mysqli_query($koneksi, "
    SELECT COUNT(DISTINCT t.id_transaksi) AS jml 
    FROM transaksi t
    JOIN detail_transaksi dt ON t.id_transaksi = dt.id_transaksi
    JOIN layanan l ON dt.id_produk = l.id_produk
    WHERE l.nama_produk LIKE '%Spot Iklan%' AND t.status < 4
"));

$auditorium = mysqli_fetch_assoc(mysqli_query($koneksi, "
    SELECT COUNT(DISTINCT t.id_transaksi) AS jml 
    FROM transaksi t
    JOIN detail_transaksi dt ON t.id_transaksi = dt.id_transaksi
    JOIN layanan l ON dt.id_produk = l.id_produk
    WHERE l.nama_produk LIKE '%Auditorium%' AND t.status < 4
"));

$ruang = mysqli_fetch_assoc(mysqli_query($koneksi, "
    SELECT COUNT(DISTINCT t.id_transaksi) AS jml 
    FROM transaksi t
    JOIN detail_transaksi dt ON t.id_transaksi = dt.id_transaksi
    JOIN layanan l ON dt.id_produk = l.id_produk
    WHERE l.nama_produk LIKE '%Multipurpose%' AND t.status < 4
"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
 body {
  background: #fafafa;
  font-family: 'Segoe UI', sans-serif;
  margin: 0;
  padding: 0;
}

.container {
  padding: 40px 20px;
}

.dashboard-title {
  font-size: 26px;
  font-weight: 700;
  color: #444;
  margin-bottom: 30px;
}

.dashboard-wrapper {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 20px;
}

.dashboard-box {
  display: flex;
  align-items: center;
  padding: 15px 20px;
  border-radius: 16px;
  background: #fff;
  box-shadow: 0 6px 12px rgba(0,0,0,0.06);
  transition: all 0.3s ease;
}

.dashboard-box:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 20px rgba(0,0,0,0.08);
}

.dashboard-box .icon {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background: #ccc;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 15px;
  font-size: 22px;
  color: white;
}

/* Color Theme */
.box-radio .icon      { background: #a29bfe; }
.box-iklan .icon      { background: #fab1a0; }
.box-auditorium .icon { background: #81ecec; color: #333; }
.box-ruang .icon      { background: #ffeaa7; color: #333; }

.label {
  font-size: 15px;
  font-weight: 600;
  color: #555;
}

.value {
  font-size: 18px;
  font-weight: bold;
  color: #222;
}

/* Responsive */
@media (max-width: 768px) {
  .dashboard-wrapper {
    grid-template-columns: 1fr;
  }

  .dashboard-box {
    flex-direction: row;
    text-align: left;
  }

  .dashboard-box .icon {
    margin-bottom: 0;
  }
}

    </style>
</head>
<body>

<div class="container">
  <h2 class="dashboard-title text-center">Ringkasan Booking Layanan</h2>
  <div class="dashboard-wrapper">
    <div class="dashboard-box box-radio">
      <div class="icon"><i class="fa fa-microphone"></i></div>
      <div>
        <div class="label">Siaran Radio</div>
        <div class="value"><?= $radio['jml'] ?> Pesanan</div>
      </div>
    </div>
    
    <div class="dashboard-box box-iklan">
      <div class="icon"><i class="fa fa-bullhorn"></i></div>
      <div>
        <div class="label">Spot Iklan</div>
        <div class="value"><?= $iklan['jml'] ?> Pesanan</div>
      </div>
    </div>

    <div class="dashboard-box box-auditorium">
      <div class="icon"><i class="fa fa-building"></i></div>
      <div>
        <div class="label">Auditorium</div>
        <div class="value"><?= $auditorium['jml'] ?> Pesanan</div>
      </div>
    </div>

    <div class="dashboard-box box-ruang">
      <div class="icon"><i class="fa fa-door-open"></i></div>
      <div>
        <div class="label">Multipurpose</div>
        <div class="value"><?= $ruang['jml'] ?> Pesanan</div>
      </div>
    </div>
  </div>
</div>

</body>
</html>

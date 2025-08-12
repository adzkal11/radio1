<?php
include __DIR__ . '/../sistem/koneksi.php';

$id = $_GET['id'] ?? null;
$produk = null;

if ($id) {
    $stmt = mysqli_prepare($koneksi, "SELECT * FROM layanan WHERE id_produk = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($result && mysqli_num_rows($result) > 0) {
        $produk = mysqli_fetch_assoc($result);
    }
}

if (!$produk) {
    echo "<div class='alert alert-warning'>Layanan tidak ditemukan atau ID tidak valid.</div>";
    exit;
}
?>

<style>
  body {
  font-family: 'Poppins', sans-serif;
  background-color: #fefeff;
}

.layanan-detail-section {
  background: linear-gradient(to bottom right, #fdfbff, #f2faff);
  padding-top: 4rem;
  padding-bottom: 4rem;
}

.cute-card {
  background-color: #fff7fa;
  border-radius: 20px;
  padding: 1.5rem;
  transition: 0.3s ease;
  border: 2px dashed #ffc6e8;
}

.cute-card-2 {
  background-color: #f0f9ff;
  border-radius: 20px;
  padding: 1.5rem;
  border: 2px dashed #aee7ff;
}

.cute-img {
  border-radius: 15px;
  height: 260px;
  object-fit: cover;
  box-shadow: 0 6px 15px rgba(0,0,0,0.05);
}

.cute-title {
  font-size: 1.6rem;
  font-weight: 700;
  color: #333;
}

.cute-list li {
  border: none;
  padding: 0.8rem 0;
  font-size: 1.5rem;
  color: #444;
}

.cute-input {
  border-radius: 12px;
  background-color: #fff;
  border: 1px solid #d4eaf7;
  box-shadow: none;
  padding: 20px;
  transition: all 0.2s ease-in-out;
}

.cute-input:focus {
  border-color: #86d1f7;
  box-shadow: 0 0 0 4px rgba(174, 231, 255, 0.2);
}

.cute-btn {
  background: linear-gradient(to right, #00c6ff, #0072ff);
  color: white;
  font-weight: 600;
  padding: 12px 20px;
  font-size: 1.05rem;
  border-radius: 14px;
  transition: transform 0.2s ease;
  margin-top: 20px; /* ✅ Tambahkan jarak di sini */
}

.cute-btn:hover {
  transform: scale(1.03);
  background: linear-gradient(to right, #00b5f5, #0055d4);
}

/* Responsive tweak */
@media (max-width: 768px) {
  .cute-title {
    font-size: 1.3rem;
  }

  .cute-btn {
    font-size: 1rem;
  }

  .cute-img {
    height: auto;
  }
}

</style>
<section>
<section class="layanan-detail-section py-5">
  <div class="container">
    <div class="row g-4 justify-content-center align-items-start">

      <!-- 💖 Detail Layanan -->
      <div class="col-lg-5 col-md-6 col-sm-12">
        <div class="card cute-card shadow-sm border-0">
          <div class="card-body">
            <div class="section-header mb-3">
              <h3 class="section-heading text-left cute-title">Detail Layanan</h3>
            </div>
            <img src="<?= htmlspecialchars($produk['gambar']) ?>" alt="Gambar Layanan" class="img-fluid rounded mb-3 cute-img">
            <ul class="list-group list-group-flush cute-list">
              <li class="list-group-item bg-transparent"><strong>Nama Layanan:</strong><br><?= htmlspecialchars($produk['nama_produk']) ?></li>
              <li class="list-group-item bg-transparent"><strong>Harga:</strong><br>Rp. <?= number_format($produk['harga'], 2, ',', '.') ?></li>
              <li class="list-group-item bg-transparent"><strong>Keterangan:</strong><br><?= nl2br(htmlspecialchars($produk['keterangan'])) ?></li>
            </ul>
          </div>
        </div>
      </div>

      <!-- 📨 Form Pemesanan -->
      <div class="col-lg-7 col-md-6 col-sm-12">
        <div class="card cute-card-2 shadow-sm border-0">
          <div class="card-body">
            <div class="section-header mb-3">
              <h3 class="section-heading text-left cute-title">Pesan Layanan</h3>
            </div>
            <form action="sistem/tambah_pesanan.php" method="post" enctype="multipart/form-data">
              <input type="hidden" name="id_produk" value="<?= $produk['id_produk'] ?>">

              <div class="mb-3">
                <label for="jml" class="form-label">Lama Pemesanan/Jam :</label>
                <input type="number" name="jml_pesan" id="jml" class="form-control cute-input" placeholder="Masukkan jumlah pesanan" required>
              </div>

              <div class="mb-3">
                <label for="catatan" class="form-label">Catatan Tambahan:</label>
                <textarea name="catatan" id="catatan" rows="5" class="form-control cute-input" placeholder="Tambahkan catatan jika ada..."></textarea>
              </div>

              <div class="mb-3">
  <label for="tanggal_booking" class="form-label">Tanggal Booking:</label>
  <input type="date" name="tanggal_booking" id="tanggal_booking" class="form-control cute-input" required>
</div>

<div class="mb-3">
  <label for="jam_booking" class="form-label">Jam Mulai:</label>
  <input type="time" name="jam_booking" id="jam_booking" class="form-control cute-input" required>
</div>

              <div class="d-grid mt-4">
                <button type="submit" name="simpan" value="simpan" class="btn cute-btn">
                  Kirim Pesanan <i class="fa fa-send ms-1"></i>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
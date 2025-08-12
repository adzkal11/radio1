<?php
$query_produk = mysqli_query($koneksi, "SELECT * FROM layanan");

if (!$query_produk) {
    die("Query layanan gagal: " . mysqli_error($koneksi));
}
?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap');

body {
  font-family: 'Poppins', sans-serif;
  background-color: #f5f7fa;
  color: #444;
}

/* Kurangi jarak antara navbar dan heading */
.main-content,
.section {
  padding-top: 0px; /* sebeumnya mungkin 130px */
}

/* Atau jika pakai margin di heading, kecilkan juga */
#layanan h3.txt-bold {
  margin-top: 0px;
}

/* Heading */
#layanan h3.txt-bold {
  font-size: 2.5rem;
  font-weight: 800;
  text-align: center;
  color: #1e3a5f;
  margin-bottom: 2.5rem;
  position: relative;
}

#layanan h3.txt-bold::after {
  content: "";
  display: block;
  width: 60px;
  height: 4px;
  background-color: #c1a35f;
  margin: 10px auto 0;
  border-radius: 10px;
}

/* Produk Card */
.produk-panel {
  background: #ffffff;
  border-radius: 20px;
  padding: 1.8rem;
  border: 1px solid #e0e0e0;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
  transition: all 0.3s ease;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 100%;
}

.produk-panel:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
}

/* Gambar */
.produk-img img {
  width: 100%;
  max-height: 200px;
  border-radius: 16px;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.produk-panel:hover img {
  transform: scale(1.02);
}

/* Judul */
.produk-title {
  font-size: 2rem;
  font-weight: 700;
  color: #1e3a5f;
  margin-top: 1rem;
}

/* Harga */
.produk-price {
  font-size: 1.5rem;
  color: #28a745;
  font-weight: 600;
  margin-bottom: 1.2rem;
}

/* Tombol Elegan */
.btn-detail-lucu {
  background-color: #1e3a5f;
  color: #fff;
  border: 2px solid #c1a35f;
  border-radius: 30px;
  padding: 10px 20px;
  font-weight: 600;
  font-size: 1.2rem;
  transition: all 0.25s ease;
}

.btn-detail-lucu:hover {
  background-color: #c1a35f;
  color: #fff;
  border-color: #1e3a5f;
  transform: scale(1.03);
  box-shadow: 0 6px 14px rgba(193, 163, 95, 0.4);
}

/* Responsive */
@media (max-width: 767.98px) {
  #layanan h3.txt-bold {
    font-size: 1.8rem;
  }

  .produk-title {
    font-size: 1.2rem;
  }

  .produk-price {
    font-size: 1rem;
  }

  .btn-detail-lucu {
    font-size: 0.9rem;
    padding: 8px 18px;
  }
}

</style>

<section id="layanan" class="section">
  <div class="container">
    <div class="row mar-bot20">
      <div class="col-md-12 col-sm-12">
        <h3 class="txt-bold">Semua Daftar Layanan</h3>
        <div class="banner-slider bg-gray"></div>

        <div class="row mar-top10 produk-list">
          <?php if (mysqli_num_rows($query_produk) >= 1): ?>
            <?php while ($produk = mysqli_fetch_assoc($query_produk)): ?>
              <div class="col-md-4 col-sm-12 mb-4">
                <div class="panel produk-panel">
                  <a href="index.php?page=detail_layanan&id=<?= $produk['id_produk'] ?>">
                    <div class="panel-body">
                      <div class="produk-img text-center mb-3">
                        <img src="<?= !empty($produk['gambar']) ? $produk['gambar'] : 'assets/img/no-image.png' ?>" alt="Gambar Produk" style="max-height: 200px; object-fit: cover;">
                      </div>
                      <div class="produk-desc text-center">
  <h4 class="produk-title"><?= htmlspecialchars(substr($produk['nama_produk'], 0, 30)) ?></h4>
  <h5 class="produk-price text-success">Rp. <?= number_format($produk['harga'], 2, ',', '.') ?></h5>
  <a href="index.php?page=detail_layanan&id=<?= $produk['id_produk'] ?>" class="btn btn-detail-lucu mt-2">Detail Layanan 🌟</a>
</div>

                    </div>
                  </a>
                </div>
              </div>
            <?php endwhile; ?>
          <?php else: ?>
            <div class="col-sm-12">
              <h4 class="text-center text-muted">Tidak Ada Data Layanan</h4>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>

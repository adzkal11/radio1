<?php
if (!isset($_SESSION['id'])) {
    echo "<div class='alert alert-warning'>Anda harus login untuk melihat keranjang.</div>";
    exit;
}

$nama_user = $_SESSION['nama']; // atau 'username' tergantung nama session kamu
$id_user = mysqli_real_escape_string($koneksi, $_SESSION['id']);
$query = mysqli_query($koneksi, "SELECT * FROM keranjang JOIN layanan ON keranjang.id_produk = layanan.id_produk WHERE id_user = '$id_user'");

if (!$query) {
    echo "<div class='alert alert-danger'>Query error: " . mysqli_error($koneksi) . "</div>";
    exit;
}

$subtotal = 0;
?>

<style>
.section-header h4 {
  font-family: 'Poppins', sans-serif;
  font-weight: 700;
  color: #007acc;
  margin-bottom: 20px;
  letter-spacing: 0.5px;
  font-size: 24px;
}

.panel {
  background: linear-gradient(135deg, #e6f0ff, #f9f9ff);
  border-radius: 16px;
  border: none;
  box-shadow: 0 8px 20px rgba(0,0,0,0.08);
  margin-bottom: 24px;
}

.panel-body {
  padding: 24px;
}

.produk-desc {
  background: #ffffff;
  border-radius: 14px;
  padding: 20px;
  margin-bottom: 20px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.05);
  transition: transform 0.2s ease;
}

.produk-desc:hover {
  transform: scale(1.01);
}

.produk-title {
  font-weight: 600;
  font-size: 18px;
  color: #222;
  margin-bottom: 10px;
}

.produk-desc dl dd {
  font-size: 14px;
  color: #666;
  margin-bottom: 6px;
}

.btn-danger {
  background: #ff5a5f;
  border: none;
  transition: background 0.3s ease;
}

.btn-danger:hover {
  background: #e04045;
}

.btn-warning {
  background: linear-gradient(135deg, #00bfff, #007acc);
  color: white;
  font-size: 16px;
  font-weight: 600;
  padding: 12px;
  border-radius: 10px;
  border: none;
  transition: background 0.3s ease, transform 0.2s ease;
  width: 100%;
}

.btn-warning:hover {
  background: linear-gradient(135deg, #009be0, #005c99);
  transform: translateY(-2px);
}

.txt-bold {
  font-weight: 700;
  color: #444;
  font-size: 16px;
}

.list-group-item {
  background: transparent;
  border: none;
  padding: 16px 10px;
}

h4.txt-bold span {
  font-weight: 700;
  color: #007acc;
}

@media (max-width: 767px) {
  .produk-title {
    font-size: 16px;
  }

  .btn-warning {
    font-size: 15px;
  }

  .section-header h4 {
    font-size: 18px;
  }
}
</style>

<section class="section" id="keranjang">
  <div class="container">
    <?php if (@$_SESSION['pesan']): ?>
      <div class="alert alert-<?= $_SESSION['pesan']['status'] ?> alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?= $_SESSION['pesan']['isi'] ?>
      </div>
    <?php endif; ?>

<div class="row">
  <div class="col-md-8 col-sm-12">
    <div class="section-header">
      <h4 class="section-heading text-left txt-bold">Detail Pesanan</h4>
    </div>
    <div class="panel">
      <div class="panel-body">
        <div class="list-group kat-list">
          <?php while ($p = mysqli_fetch_assoc($query)): ?>
            <?php
              $ptotal = $p['jml_pesan'] * $p['harga'];
              if ($p['desain'] == 1) {
                  $ptotal += 60000;
              }
              $subtotal += $ptotal;
            ?>
            <div class="produk-desc list-group-item">
              <div class="row">
                <div class="col-sm-8">
                  <h5 class="produk-title"><?= $p['nama_produk'] ?></h5>
                  <dl>
                    <dd><?= $p['jml_pesan'] . ' x ' . number_format($p['harga'], 0, ',', '.') ?></dd>
                    <?php if ($p['desain'] == 1): ?>
                      <dd>Biaya desain Rp. 60.000</dd>
                    <?php endif; ?>
                    <?php if ($p['catatan']): ?>
                      <dd>Note: <?= $p['catatan'] ?></dd>
                    <?php endif; ?>
                    
                    <!-- Tanggal & Jam Booking -->
                    <?php if (!empty($p['tanggal_booking']) && !empty($p['jam_booking'])): ?>
                      <dd>Tanggal Booking: <?= date('d M Y', strtotime($p['tanggal_booking'])) ?></dd>
                      <dd>Jam Booking: <?= date('H:i', strtotime($p['jam_booking'])) ?></dd>
                    <?php endif; ?>
                    
                  </dl>
                </div>
                <div class="col-sm-4 text-right">
                  <a href="sistem/hapus_keranjang.php?id_keranjang=<?= $p['id_keranjang'] ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus pesanan?')">
                    <i class="fa fa-trash"></i>
                  </a>
                  <h5 class="produk-title mar-top20">
                    Rp <span><?= number_format($ptotal, 0, ',', '.') ?></span>
                  </h5>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  </div>

      <div class="col-md-4 col-sm-12">
        <div class="section-header">
          <h4 class="section-heading text-left txt-bold">Ringkasan Pesanan</h4>
        </div>
        <div class="panel">
          <div class="panel-body">
            <div class="list-group kat-list">
              <div class="list-group-item">
                <dt class="txt-bold">
                  Subtotal
                  <span class="text-right pull-right">Rp. <?= number_format($subtotal, 0, ',', '.') ?></span>
                </dt>
                <input type="hidden" name="subtotal" value="<?= $subtotal ?>">
              </div>
            </div>

            <h4 class="txt-bold">
              Total
              <span class="text-right pull-right">Rp. <?= number_format($subtotal, 0, ',', '.') ?></span>
            </h4>
            <input type="hidden" name="total" value="<?= $subtotal ?>">

            <div class="mar-top20">
              <button type="button" id="pay-button" class="btn btn-warning">Bayar Sekarang</button>
              <input type="hidden" id="nama_user" value="<?= $nama_user ?>">
            <input type="hidden" id="id_user" value="<?= $id_user ?>">
              <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="Mid-client-YO4KXZoPmXnlRajb"></script>
              <script>
                document.getElementById('pay-button').addEventListener('click', function () {
    const nama_user = document.getElementById('nama_user')?.value || '';
    const id_user = document.getElementById('id_user')?.value || '';
    const total = <?= $subtotal ?>;

    // 🔍 Log untuk debugging sebelum kirim ke Midtrans
    console.log("Kirim ke Midtrans:", {
        nama_user, id_user, total
    });

    fetch('sistem/token_midtrans.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `nama_user=${nama_user}&id_user=${id_user}&total=${total}`
    })
    .then(response => response.json())
    .then(data => {
        snap.pay(data.token, {
            onSuccess: function(result) {
    window.location.href = "sukses.php?order_id=" + result.order_id;
            },
            onPending: function(result) {
                alert("Transaksi belum selesai.");
            },
            onError: function(result) {
                alert("Pembayaran gagal.");
            },
            onClose: function() {
                alert("Kamu menutup popup tanpa menyelesaikan pembayaran.");
            }
        });
    })
    .catch(error => console.error('Error:', error));
});

                </script>                   

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
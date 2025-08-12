<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../sistem/koneksi.php';

$id_user = $_SESSION['id'];
$query = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_user = '$id_user' ORDER BY id_transaksi DESC");
?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap');

body {
  font-family: 'Poppins', sans-serif;
  background-color: #f5f7fa;
  color: #444;
}

.section-transaksi {
  padding: 60px 20px;
}

.section-transaksi h2 {
  text-align: center;
  font-size: 2.5rem;
  font-weight: 800;
  color: #1e3a5f;
  margin-bottom: 2.5rem;
  position: relative;
}

.section-transaksi h2::after {
  content: "";
  display: block;
  width: 60px;
  height: 4px;
  background-color: #c1a35f;
  margin: 10px auto 0;
  border-radius: 10px;
}

.transaksi-table {
  width: 100%;
  border-collapse: collapse;
  background: #ffffff;
  border-radius: 16px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
  overflow: hidden;
}

.transaksi-table th,
.transaksi-table td {
  padding: 14px 16px;
  text-align: left;
}

.transaksi-table thead {
  background-color: #f9a8d4;
  color: #7c2d12;
}

.transaksi-table tbody tr:nth-child(even) {
  background-color: #ffe4e6;
}

.transaksi-table tbody tr:hover {
  background-color: #fce7f3;
}

.badge {
  padding: 6px 12px;
  border-radius: 20px;
  font-size: 13px;
  font-weight: bold;
  display: inline-block;
  text-align: center;
}

.success {
  background-color: #d1fae5;
  color: #065f46;
}

.pending {
  background-color: #fef9c3;
  color: #92400e;
}

.failed {
  background-color: #fee2e2;
  color: #991b1b;
}

.btn-invoice {
  background-color: #3b82f6;
  color: white;
  padding: 6px 12px;
  border-radius: 10px;
  text-decoration: none;
  font-size: 13px;
  transition: background 0.3s ease;
}

.btn-invoice:hover {
  background-color: #2563eb;
}

.empty {
  text-align: center;
  padding: 20px;
  color: #999;
  font-style: italic;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.05);
  max-width: 600px;
  margin: 30px auto 0;
}
</style>

<section class="section section-transaksi">
  <div class="container">
    <h2>Riwayat Transaksi Kamu</h2>

    <?php if (mysqli_num_rows($query) > 0): ?>
    <div class="table-responsive">
      <table class="transaksi-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Order ID</th>
            <th>Jumlah</th>
            <th>Status</th>
            <th>Waktu</th>
            <th>Invoice</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; while ($data = mysqli_fetch_assoc($query)): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $data['order_id'] ?></td>
            <td><strong style="color: #7c3aed;">Rp <?= number_format($data['jumlah'], 0, ',', '.') ?></strong></td>
            <td>
              <?php
                $status = strtolower($data['status']);
                $badgeClass = $status === 'success' ? 'success' : ($status === 'pending' ? 'pending' : 'failed');
              ?>
              <span class="badge <?= $badgeClass ?>"><?= ucfirst($status) ?></span>
            </td>
            <td><?= $data['transaction_time'] ?></td>
            <td>
              <?php if (!empty($data['pdf_url'])): ?>
                <a href="<?= $data['pdf_url'] ?>" class="btn-invoice" target="_blank">Lihat</a>
              <?php else: ?>
                <span class="badge failed">-</span>
              <?php endif; ?>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
    <?php else: ?>
      <div class="empty">Belum ada transaksi</div>
    <?php endif; ?>
  </div>
</section>

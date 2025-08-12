<?php
include 'sistem/koneksi.php';

$subtotal = 0;

// Cek apakah id_transaksi dikirim via URL
if (!isset($_GET['id_transaksi']) || empty($_GET['id_transaksi'])) {
    echo "<div class='alert alert-danger text-center'>ID Transaksi tidak ditemukan.</div>";
    exit;
}

$id_transaksi = intval($_GET['id_transaksi']); // Hindari SQL Injection

$query = mysqli_query($koneksi, "SELECT * FROM detail_transaksi 
                                JOIN produk ON detail_transaksi.id_produk = produk.id_produk 
                                JOIN transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi 
                                WHERE detail_transaksi.id_transaksi = '$id_transaksi'");

if (!$query) {
    echo "<div class='alert alert-danger text-center'>Data transaksi gagal dimuat: " . mysqli_error($koneksi) . "</div>";
    exit;
}
?>

<div class="list-group kat-list">
    <?php while ($p = mysqli_fetch_assoc($query)): ?>
        <?php $ptotal = $p['jml_pesan'] * $p['harga']; ?>
        <div class="produk-desc list-group-item">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="produk-title"><?= htmlspecialchars($p['nama_produk']) ?></h5>
                    <dl>
                        <dd><?= $p['jml_pesan'] . ' x Rp. ' . number_format($p['harga'], 0, ',', '.') ?></dd>
                        <?php if ($p['desain'] == 1): ?>
                            <?php $ptotal += 60000 ?>
                            <dd>Biaya design: Rp. 60.000</dd>
                        <?php endif; ?>
                        <?php if (!empty($p['catatan'])): ?>
                            <dd>Note: <?= htmlspecialchars($p['catatan']) ?></dd>
                        <?php endif; ?>
                    </dl>
                </div>
                <div class="col-sm-6 text-right">
                    <h5 class="produk-title mar-top20">
                        Rp <span><?= number_format($ptotal, 0, ',', '.') ?></span>
                    </h5>
                    <?php if (isset($_SESSION['level']) && $_SESSION['level'] === 'admin' && !empty($p['file'])): ?>
                        <button class="open-file btn btn-primary" data-toggle="modal" data-target="#file-viewer" data-path="<?= htmlspecialchars($p['file']) ?>"><i class="fa fa-file"></i></button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php $subtotal += $ptotal; ?>
    <?php endwhile; ?>
</div>

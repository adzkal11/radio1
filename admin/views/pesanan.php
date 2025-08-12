<?php
// Query transaksi + relasi user & status pembayaran
$query = mysqli_query($koneksi, "
    SELECT transaksi.*, user.nama
    FROM transaksi
    JOIN user ON transaksi.id_user = user.id_user
    ORDER BY transaksi.transaction_time DESC, transaksi.status ASC
");


date_default_timezone_set('Asia/Jakarta');

if (!$query) {
    die("Query error: " . mysqli_error($koneksi));
}

$no = 1;
?>

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Daftar Transaksi</h3>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Nama Pemesan</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($query) >= 1): ?>
                        <?php while ($row = mysqli_fetch_assoc($query)): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['order_id'] ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td>
                                    <?php
                                        $tanggal = $row['tanggal_booking'] ?? '';
                                        $jam = $row['jam_booking'] ?? '';

                                        if (!empty($tanggal) && $tanggal !== '0000-00-00' && !empty($jam) && $jam !== '00:00:00') {
                                            echo date('d-F-Y H:i', strtotime($tanggal . ' ' . $jam));
                                        } elseif (!empty($row['transaction_time'])) {
                                            echo date('d-F-Y H:i', strtotime($row['transaction_time']));
                                        } else {
                                            echo '-';
                                        }
                                    ?>
                                </td>
                                <td>Rp. <?= number_format($row['jumlah'], 2, ',', '.') ?></td>
                                <td>
                                <?php 
                                $status = strtolower(trim($row['status'])); 

                                if ($status === '0' || $status === 0) {
                                  echo '<span class="badge bg-aqua">Menunggu Pembayaran</span>';
                                } elseif ($status === '1' || $status === 'sukses') {
                                    echo '<span class="badge bg-success">Sukses</span>';
                                } else {
                                   echo '<span class="badge bg-default">Pending</span>';
                                }
                                ?>

                                </td>
                                <td>
                                    <button class="btn btn-sm btn-primary btn-detail-pesanan" data-toggle="modal" data-target="#detail-pesanan" data-transaksi="<?= $row['id_transaksi'] ?>">
                                        <i class="fa fa-search" title="Detail Pesanan"></i>
                                    </button>

                                    <?php if ($row['status'] > 0): ?>
                                        <button class="btn btn-sm btn-info btn-detail-transaksi" data-toggle="modal" data-target="#detail-transaksi" data-transaksi="<?= $row['id_transaksi'] ?>">
                                            <i class="fa fa-file-text" title="Detail Transaksi"></i>
                                        </button>
                                    <?php endif; ?>

                                    <?php if ($row['status'] == 1): ?>
                                        <a href="sistem/update_transaksi.php?id_transaksi=<?= $row['id_transaksi'] ?>&status=2" class="btn btn-sm btn-warning" onclick="return confirm('Konfirmasi Pengerjaan?')">
                                            <i class="fa fa-tasks"></i>
                                        </a>
                                    <?php elseif ($row['status'] == 2): ?>
                                        <button class="btn btn-sm btn-success konfirm-kirim" data-toggle="modal" data-target="#kirim-pesanan" data-transaksi="<?= $row['id_transaksi'] ?>">
                                            <i class="fa fa-truck" title="Kirim Pesanan"></i>
                                        </button>
                                    <?php endif; ?>

                                    <?php if (@$row['status_pembayaran'] && $row['status_pembayaran'] == 1): ?>
                                        <i class="fa fa-check-circle text-success" title="Pembayaran Telah Dikonfirmasi"></i>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="7" class="text-center">Tidak ada data</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

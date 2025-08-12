<?php
include '../sistem/koneksi.php';

$status = $_POST['status'] ?? '';
$t_dari = $_POST['tgl_dari'] ?? date('Y-m-01');
$t_sampai = $_POST['tgl_sampai'] ?? date('Y-m-t');
$filter_user = $_POST['filter_user'] ?? '';

switch ($status) {
    case '0':
        $nama_status = 'Pending';
        break;
    case '4':
        $nama_status = 'Sukses';
        break;
    default:
        $nama_status = '';
        break;
}

$query = "
    SELECT transaksi.*, user.nama
    FROM transaksi
    JOIN user ON transaksi.id_user = user.id_user
    WHERE DATE(transaksi.transaction_time) BETWEEN '$t_dari' AND '$t_sampai'
";

if ($nama_status !== '') {
    $query .= " AND transaksi.status = '" . mysqli_real_escape_string($koneksi, $nama_status) . "'";
}

if ($filter_user !== '') {
    $filter_user_esc = mysqli_real_escape_string($koneksi, $filter_user);
    $query .= " AND (user.id_user LIKE '%$filter_user_esc%' OR user.nama LIKE '%$filter_user_esc%')";
}

$query .= " ORDER BY transaksi.transaction_time ASC";

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Laporan Transaksi</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <style>
        body {
            background: #f0f8ff;
            font-family: 'Segoe UI', sans-serif;
            padding: 30px;
        }
        .laporan-container {
            background: linear-gradient(to bottom right, #e0f0ff, #ffffff);
            padding: 30px;
            border-radius: 14px;
            border: 1px solid #d0e7ff;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            max-width: 1000px;
            margin: auto;
        }
        .logo {
            text-align: center;
            margin-bottom: 10px;
        }
        .logo img {
            width: 80px;
        }
        h3 {
            color: #004c97;
            font-weight: bold;
            text-align: center;
            margin-bottom: 0;
        }
        h5 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        table thead {
            background: linear-gradient(to right, #b2d8ff, #e6f2ff);
            color: #003366;
        }
        table th, table td {
            font-size: 14px;
            vertical-align: middle;
        }
        tfoot {
            background-color: #e6f2ff;
            font-weight: bold;
        }
        @media print {
            @page { size: landscape; margin: 1cm; }
            .laporan-container { box-shadow: none; border: none; padding: 0; }
            body { background: white; }
            button { display: none; }
        }
    </style>
</head>
<body>

<div class="laporan-container">
    <div class="logo">
        <img src="../assets/img/rri/rri-logo1.png" alt="Logo RRI" />
    </div>

    <h3>Laporan Transaksi</h3>
    <h5>Status: <?= htmlspecialchars($nama_status ?: 'Semua') ?> | Periode: <?= date('d-m-Y', strtotime($t_dari)) ?> s/d <?= date('d-m-Y', strtotime($t_sampai)) ?></h5>
    <?php if ($filter_user !== ''): ?>
        <h5>Filter User: <?= htmlspecialchars($filter_user) ?></h5>
    <?php endif; ?>
    <hr />

    <table class="table table-bordered table-sm mt-3">
        <thead class="text-center">
            <tr>
                <th>No</th>
                <th>Kode Transaksi</th>
                <th>Nama</th>
                <th>Tanggal Pesanan</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $grand_total = 0;

            if ($result && mysqli_num_rows($result) > 0):
                while ($row = mysqli_fetch_assoc($result)):
            ?>
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['order_id']) ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td><?= date('d-m-Y H:i', strtotime($row['transaction_time'])) ?></td>
                <td class="text-end">Rp <?= number_format($row['jumlah'], 2, ',', '.') ?></td>
            </tr>
            <?php
                $grand_total += $row['jumlah'];
                endwhile;
            else:
            ?>
            <tr><td colspan="5" class="text-center">Data tidak ditemukan.</td></tr>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-end">Total</td>
                <td class="text-end">Rp <?= number_format($grand_total, 2, ',', '.') ?></td>
            </tr>
        </tfoot>
    </table>

    <div class="text-center mt-4">
        <button class="btn btn-primary" onclick="window.print()">Cetak Laporan</button>
    </div>
</div>

</body>
</html>

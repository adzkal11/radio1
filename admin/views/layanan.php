<?php
$query = mysqli_query($koneksi, "SELECT * FROM layanan");
?>

<style>
    .box-cute {
        background: linear-gradient(145deg, #ffffff, #f3f3f3);
        border-radius: 18px;
        box-shadow: 6px 6px 12px #dcdcdc, -6px -6px 12px #ffffff;
        padding: 20px;
        margin-bottom: 30px;
    }

    .box-cute h3 {
        font-weight: 700;
        font-size: 20px;
        color: #ff69b4;
        margin-bottom: 20px;
    }

    .btn-pastel {
        border-radius: 10px;
        font-weight: 600;
        border: none;
    }

    .btn-pastel-success {
        background: linear-gradient(135deg, #a1ffce, #faffd1);
        color: #2f855a;
    }

    .btn-pastel-primary {
        background: linear-gradient(135deg, #c3aed6, #f9c5d1);
        color: #5a3e79;
    }

    .btn-pastel-danger {
        background: linear-gradient(135deg, #ffb3ba, #ffdfba);
        color: #d7263d;
    }

    .btn-pastel:hover {
        opacity: 0.9;
        transform: scale(1.02);
    }

    .table-cute {
        background-color: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .table-cute th {
        background-color: #ffeef8;
        color: #ff69b4;
        text-align: center;
    }

    .table-cute td {
        vertical-align: middle !important;
    }

    .table img {
        border-radius: 10px;
        box-shadow: 2px 2px 8px rgba(0,0,0,0.1);
    }
</style>

<div class="box-cute">
    <div class="box-header with-border d-flex justify-content-between align-items-center">
        <h3 class="box-title">Daftar Layanan</h3>
        <a href="index.php?page=tambah_layanan" class="btn btn-sm btn-pastel btn-pastel-success">
            <i class="fa fa-plus"></i> Tambah Layanan
        </a>
    </div>
    <div class="box-body mt-3">
        <div class="table-responsive table-cute">
            <table class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Layanan</th>
                        <th>Gambar</th>
                        <th>Harga</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; while ($row = mysqli_fetch_assoc($query)): ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= $row['nama_produk'] ?></td>
                            <td class="text-center"><img src="../<?= $row['gambar'] ?>" width="90"></td>
                            <td>Rp. <?= number_format($row['harga'], 0, ',', '.') ?></td>
                            <td><?= $row['keterangan'] ?></td>
                            <td class="text-center">
                                <a href="index.php?page=edit_layanan&id=<?= $row['id_produk'] ?>" class="btn btn-sm btn-pastel btn-pastel-primary" title="Edit">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="sistem/hapus_layanan.php?id=<?= $row['id_produk'] ?>" onclick="return confirm('Yakin hapus layanan ini?')" class="btn btn-sm btn-pastel btn-pastel-danger" title="Hapus">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

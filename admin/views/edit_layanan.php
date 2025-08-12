<?php
$id_produk = $_GET['id'];
$produk = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM layanan WHERE id_produk = '$id_produk'"));
?>

<div class="box box-info">
    <form action="sistem/edit_layanan.php" method="post" enctype="multipart/form-data">
        <div class="box-header with-border">
            <h3 class="box-title">Form Edit Layanan</h3>
        </div>

        <div class="box-body">
            <div class="row">
                <!-- Nama Layanan -->
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="nama_produk">Nama Layanan :</label>
                        <input type="hidden" name="id_produk" value="<?= $produk['id_produk'] ?>">
                        <input type="text" name="nama_produk" id="nama_produk" class="form-control" value="<?= $produk['nama_produk'] ?>" placeholder="Masukkan Nama Layanan" required>
                    </div>
                </div>

                <!-- Harga -->
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="harga">Harga Layanan :</label>
                        <input type="number" name="harga" id="harga" class="form-control" value="<?= $produk['harga'] ?>" placeholder="Masukkan Harga Layanan" required>
                    </div>
                </div>

                <!-- Gambar -->
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="gambar">Gambar Layanan :</label><br>
                        <?php if (!empty($produk['gambar'])): ?>
                            <img src="../<?= $produk['gambar'] ?>" alt="Gambar Layanan" style="height: 150px; margin-bottom: 10px;"><br>
                        <?php endif; ?>
                        <input type="file" name="gambar" id="gambar" class="form-control">
                    </div>
                </div>

                <!-- Keterangan -->
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="keterangan">Keterangan :</label>
                        <textarea name="keterangan" id="keterangan" rows="5" class="form-control" placeholder="Masukkan Keterangan"><?= $produk['keterangan'] ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="box-footer">
            <button type="submit" name="simpan" value="simpan" class="btn btn-primary">
                <i class="fa fa-save"></i> Simpan
            </button>
            <button type="reset" class="btn btn-danger">
                <i class="fa fa-refresh"></i> Kosongkan
            </button>
        </div>
    </form>
</div>

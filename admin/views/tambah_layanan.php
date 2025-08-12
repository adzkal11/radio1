<div class="box box-info">
    <form action="sistem/tambah_layanan.php" method="post" enctype="multipart/form-data">
        <div class="box-header with-border">
            <h3 class="box-title">Form Tambah Layanan</h3>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama_produk">Nama Layanan:</label>
                        <input type="text" name="nama_produk" id="nama_produk" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="harga">Harga Layanan:</label>
                        <input type="number" name="harga" id="harga" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="gambar">Gambar Layanan:</label>
                        <input type="file" name="gambar" id="gambar" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="keterangan">Keterangan:</label>
                        <textarea name="keterangan" id="keterangan" rows="5" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="box-footer">
            <button type="submit" name="simpan" class="btn btn-primary">Simpan <i class="fa fa-save"></i></button>
            <button type="reset" class="btn btn-danger pull-left">Kosongkan <i class="fa fa-refresh"></i></button>
        </div>
    </form>
</div>

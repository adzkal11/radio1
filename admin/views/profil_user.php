<?php
$query = mysqli_query($koneksi, "SELECT * FROM admin WHERE id_admin = '$_SESSION[id]'");
$profil = mysqli_fetch_assoc($query);
?>

<div class="row">
    <!-- Foto Profil -->
    <div class="col-md-4 col-sm-12">
        <div class="card shadow-sm rounded-xl border-0">
            <form action="sistem/update_foto_profil_user.php" method="post" enctype="multipart/form-data">
                <div class="card-header bg-purple-500 text-white rounded-t-xl">
                    <h3 class="card-title text-lg font-semibold">Edit Foto Profil</h3>
                </div>
                <div class="card-body">
                    <div class="form-group text-center">
                        <img src="../<?= $profil['foto'] ?>" alt="Foto Profil" class="img-fluid rounded-circle border border-purple-300 shadow mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <div class="form-group">
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>
                </div>
                <div class="card-footer text-end">
                    <input type="submit" name="simpan" value="Simpan" class="btn btn-success px-4">
                </div>
            </form>
        </div>
    </div>

    <!-- Form Profil -->
    <div class="col-md-8 col-sm-12">
        <div class="card shadow-sm rounded-xl border-0">
            <form action="sistem/update_profil_user.php" method="post">
                <div class="card-header bg-pink-400 text-white rounded-t-xl">
                    <h3 class="card-title text-lg font-semibold">Edit Profil</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row mb-3">
                        <label for="nama" class="col-md-3 col-form-label">Nama Lengkap:</label>
                        <div class="col-md-9">
                            <input type="text" name="nama" value="<?= $profil['nama'] ?>" id="nama" class="form-control rounded-lg" placeholder="Masukan Nama Lengkap" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="username" class="col-md-3 col-form-label">Username:</label>
                        <div class="col-md-9">
                            <input type="text" name="username" value="<?= $profil['username'] ?>" id="username" class="form-control rounded-lg" placeholder="Masukan Username" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="password" class="col-md-3 col-form-label">Password:</label>
                        <div class="col-md-9">
                            <input type="password" name="password" id="password" class="form-control rounded-lg" placeholder="**************">
                            <small class="text-muted">* Kosongkan jika tidak ingin diubah</small>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <input type="submit" name="simpan" value="Simpan" class="btn btn-primary px-4">
                </div>
            </form>
        </div>
    </div>
</div>

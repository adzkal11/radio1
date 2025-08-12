<?php
include_once '../sistem/koneksi.php';

// Ambil data user
$query = mysqli_query($koneksi, "SELECT * FROM user");
$no = 1;
?>

<style>
  .box-info {
    background: #fdf6ff;
    border-radius: 12px;
    padding: 20px;
    border: 1px solid #e0d4f7;
    box-shadow: 0 4px 8px rgba(215, 190, 255, 0.2);
  }
  .box-title {
    font-size: 24px;
    font-weight: bold;
    color: #5e17eb;
    margin-bottom: 10px;
    font-family: 'Poppins', sans-serif;
  }
  .table thead {
    background-color: #e5d1ff;
    color: #5a189a;
  }
  .table tbody tr:hover {
    background-color: #fceeff;
    transition: all 0.2s ease-in-out;
  }
  .btn-edit-user {
    background-color: #8eecf5;
    border-color: #8eecf5;
    color: #333;
  }
  .btn-edit-user:hover {
    background-color: #4dd0e1;
    color: white;
  }
  .btn-hapus {
    background-color: #ffd6e8;
    border-color: #ffd6e8;
    color: #d63384;
  }
  .btn-hapus:hover {
    background-color: #ffb3cf;
    color: white;
  }
  .btn-tambah-user {
    background-color: #c8f7c5;
    border-color: #c8f7c5;
    color: #2d6a4f;
  }
  .btn-tambah-user:hover {
    background-color: #95d5b2;
    color: white;
  }
  .modal-header {
    background: linear-gradient(to right, #fbc2eb, #a6c1ee);
    color: #fff;
    border-top-left-radius: 6px;
    border-top-right-radius: 6px;
  }
  .modal-title {
    font-weight: bold;
  }
  .form-group label {
    font-weight: 500;
    color: #7b2cbf;
  }
</style>

<div class="box box-info">
  <div class="box-header with-border d-flex justify-content-between align-items-center">
    <h3 class="box-title"><i class="fa fa-users"></i> Daftar User</h3>
    <button class="btn btn-sm btn-tambah-user" data-toggle="modal" data-target="#tambah-user">
      <i class="fa fa-plus"></i> Tambah User
    </button>
  </div>
  <div class="box-body">
    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama User</th>
            <th>Foto</th>
            <th>Email</th>
            <th>Telp</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (mysqli_num_rows($query) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($query)): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td><img src="../assets/img/foto/<?= htmlspecialchars($row['foto']) ?>" width="80" class="img-thumbnail"></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['telp']) ?></td>
                <td>
                  <button class="btn btn-sm btn-edit-user" data-toggle="modal" data-target="#edit-user"
                    data-id="<?= $row['id_user'] ?>"
                    data-nama="<?= htmlspecialchars($row['nama']) ?>"
                    data-email="<?= htmlspecialchars($row['email']) ?>"
                    data-telp="<?= htmlspecialchars($row['telp']) ?>"
                    data-alamat="<?= htmlspecialchars($row['alamat']) ?>"
                    data-ket="<?= htmlspecialchars($row['keterangan']) ?>">
                    <i class="fa fa-pencil"></i> Edit
                  </button>

                  <button class="btn btn-sm btn-hapus" data-toggle="modal" data-target="#hapus-user"
                    data-id="<?= $row['id_user'] ?>" data-uri="hapus_user">
                    <i class="fa fa-trash"></i> Hapus
                  </button>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan="6" class="text-center text-muted">Belum ada data user</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal Tambah User -->
<div class="modal fade" id="tambah-user">
  <div class="modal-dialog">
    <form action="sistem/tambah_user.php" method="post" enctype="multipart/form-data" class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Tambah User</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="form-group"><label>Nama</label><input type="text" name="nama" class="form-control" required></div>
        <div class="form-group"><label>Email</label><input type="email" name="email" class="form-control" required></div>
        <div class="form-group"><label>Telp</label><input type="text" name="telp" class="form-control"></div>
        <div class="form-group"><label>Foto</label><input type="file" name="foto" class="form-control"></div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Edit User -->
<div class="modal fade" id="edit-user">
  <div class="modal-dialog">
    <form action="sistem/edit_user.php" method="post" enctype="multipart/form-data" class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit User</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id_user" id="edit-id_user">
        <div class="form-group"><label>Nama</label><input type="text" name="nama" id="edit-nama" class="form-control" required></div>
        <div class="form-group"><label>Email</label><input type="email" name="email" id="edit-email" class="form-control" required></div>
        <div class="form-group"><label>Telp</label><input type="text" name="telp" id="edit-telp" class="form-control"></div>
        <div class="form-group"><label>Ganti Foto</label><input type="file" name="foto" class="form-control"></div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
      </div>
    </form>
  </div>
</div>


<!-- Modal hapus -->
<div class="modal fade" id="hapus-user" tabindex="-1" role="dialog" aria-labelledby="hapusUserLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i> Konfirmasi Hapus</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>Apakah kamu yakin ingin menghapus user ini?</p>
      </div>
      <div class="modal-footer">
        <a href="sistem/hapus_user.php" id="link-hapus-user" class="btn btn-danger" onclick="return confirm('Yakin hapus user ini?')">Hapus</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).on('click', '.btn-hapus', function () {
    const id = $(this).data('id');
    $('#link-hapus-user').attr('href', 'sistem/hapus_user.php?id_user=' + id);
});
</script>

<script>
$(document).on('click', '.btn-edit-user', function () {
  const btn = $(this);
  $('#edit-id_user').val(btn.data('id'));
  $('#edit-nama').val(btn.data('nama'));
  $('#edit-email').val(btn.data('email'));
  $('#edit-telp').val(btn.data('telp'));
  $('#edit-alamat').val(btn.data('alamat'));
  $('#edit-ket').val(btn.data('ket'));
});

</script>

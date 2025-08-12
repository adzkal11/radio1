<?php
$selected_status = $_POST['status'] ?? '';
$selected_tgl_dari = $_POST['tgl_dari'] ?? '';
$selected_tgl_sampai = $_POST['tgl_sampai'] ?? '';
$filter_user = $_POST['filter_user'] ?? '';
?>

<div class="box box-info shadow-lg rounded-xl border border-purple-300">
    <form action="print_laporan.php" method="post" target="_blank">
        <div class="box-header with-border bg-purple-100 p-3 rounded-t-xl">
            <h3 class="box-title text-lg font-bold text-purple-800">
                <i class="fa fa-print mr-1"></i> Cetak Laporan
            </h3>
        </div>

        <div class="box-body bg-white p-4 rounded-b-xl">
            <!-- Dropdown Status -->
            <div class="form-group row mb-4">
                <label class="col-md-2 col-form-label font-medium text-purple-700" for="status">Status :</label>
                <div class="col-md-10">
                    <select name="status" id="status" class="form-control border border-purple-300 rounded">
                        <option value="" <?= $selected_status === '' ? 'selected' : '' ?>>Semua Status</option>
                        <option value="4" <?= $selected_status === '4' ? 'selected' : '' ?>>Sukses</option>
                        <option value="0" <?= $selected_status === '0' ? 'selected' : '' ?>>Menunggu Pembayaran / Pending</option>
                    </select>
                </div>
            </div>

            <!-- Filter Nama / ID User -->
            <div class="form-group row mb-4">
                <label class="col-md-2 col-form-label font-medium text-purple-700" for="filter_user">Nama / ID User :</label>
                <div class="col-md-10">
                    <input type="text" name="filter_user" id="filter_user" class="form-control border border-purple-300 rounded" placeholder="Masukkan nama atau ID user" value="<?= htmlspecialchars($filter_user) ?>">
                </div>
            </div>

            <!-- Periode Tanggal -->
            <div class="form-group row mb-4">
                <label class="col-md-2 col-form-label font-medium text-purple-700" for="tgl_dari">Periode :</label>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-5 mb-2">
                            <input type="date" name="tgl_dari" class="form-control border border-purple-300 rounded" required value="<?= htmlspecialchars($selected_tgl_dari ?: date('Y-m-01')) ?>">
                        </div>
                        <div class="col-md-1 text-center d-flex align-items-center justify-content-center">
                            <span class="text-purple-700 font-semibold">s/d</span>
                        </div>
                        <div class="col-md-5">
                            <input type="date" name="tgl_sampai" class="form-control border border-purple-300 rounded" required value="<?= htmlspecialchars($selected_tgl_sampai ?: date('Y-m-t')) ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Cetak -->
        <div class="box-footer text-center p-3 bg-purple-50 rounded-b-xl">
            <button type="submit" class="btn btn-success px-4 py-2 rounded-pill shadow">
                <i class="fa fa-print mr-1"></i> Cetak
            </button>
        </div>
    </form>
</div>

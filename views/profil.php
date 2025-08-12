<?php
    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$_SESSION[id]'");
    $profil = mysqli_fetch_assoc($query);
?>

<style>
    .profil-section {
        font-family: 'Poppins', sans-serif;
        background-color: #fefeff;
        padding: 3rem 0;
    }

    .profil-card {
        background-color: #fff7fa;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 6px 15px rgba(0,0,0,0.05);
        border: 2px dashed #ffc6e8;
    }

    .profil-title {
        font-size: 1.6rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 1rem;
    }

    .profil-img {
        border-radius: 50%;
        width: 180px;
        height: 180px;
        object-fit: cover;
        border: 4px solid #ffb9d2;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        margin-bottom: 1rem;
    }

    .profil-dt dt {
        font-weight: 600;
        color: #555;
        margin-top: 0.5rem;
    }

    .profil-dt dd {
        margin-bottom: 0.8rem;
        color: #444;
    }

    .profil-btn {
        padding: 10px 18px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .profil-btn-edit {
        background: linear-gradient(to right, #ff7eb3, #ff758c);
        color: white;
        margin-right: 10px;
    }

    .profil-btn-edit:hover {
        background: linear-gradient(to right, #ff5f9e, #ff4e88);
    }

    .profil-btn-pass {
        background: linear-gradient(to right, #7ee8fa, #80ffdb);
        color: #333;
    }

    .profil-btn-pass:hover {
        background: linear-gradient(to right, #56e0e0, #62ffcb);
        color: #222;
    }

    @media (max-width: 768px) {
        .profil-img {
            width: 130px;
            height: 130px;
        }

        .profil-title {
            font-size: 1.3rem;
        }
    }
</style>

<section class="profil-section" id="profil">
    <div class="container">
        <?php if (@$_SESSION['pesan']): ?>
            <div class="alert alert-<?= $_SESSION['pesan']['status'] ?> alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $_SESSION['pesan']['isi'] ?>
            </div>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="profil-card">
                    <div class="row align-items-center">
                        <!-- Foto Profil -->
                        <div class="col-md-4 text-center">
                            <img src="assets/img/foto/<?= $profil['foto'] ?>" alt="Foto Profil" class="profil-img">
                        </div>

                        <!-- Data Profil -->
                        <div class="col-md-8">
                            <h3 class="profil-title">Halo, <?= htmlspecialchars($profil['nama']) ?> ✨</h3>
                            <dl class="profil-dt">
                                <dt>Nama:</dt>
                                <dd><?= $profil['nama'] ?></dd>

                                <dt>Email:</dt>
                                <dd><?= $profil['email'] ?></dd>

                                <dt>Telp:</dt>
                                <dd><?= $profil['telp'] ?></dd>
                            </dl>

                            <!-- Tombol Aksi -->
                            <div class="mt-4">
                                <a href="index.php?page=edit_profil" class="profil-btn profil-btn-edit">
                                    <i class="fa fa-user"></i> Edit Profil
                                </a>
                                <a href="index.php?page=edit_password" class="profil-btn profil-btn-pass">
                                    <i class="fa fa-lock"></i> Edit Password
                                </a>
                            </div>
                        </div>
                    </div> <!-- row -->
                </div>
            </div>
        </div>
    </div>
</section>

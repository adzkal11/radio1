<?php session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar | RRI Kota Padang</title>

    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
      body {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        background: linear-gradient(-45deg, #fbd5e7, #c3dafe, #e0f2fe, #f7fafc);
        background-size: 400% 400%;
        animation: gradientBG 15s ease infinite;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: 'Segoe UI', sans-serif;
      }

      @keyframes gradientBG {
        0% {background-position: 0% 50%;}
        50% {background-position: 100% 50%;}
        100% {background-position: 0% 50%;}
      }

      .register-card {
        width: 100%;
        max-width: 500px;
        padding: 40px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.8);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.3);
      }

      .form-control::placeholder {
        font-size: 0.9rem;
      }

      .input-group-text {
        background-color: #e2e8f0;
        border: none;
      }

      .form-control {
        border-left: none;
      }

      .input-group .form-control:focus {
        box-shadow: none;
        border-color: #60a5fa;
      }

      .btn-primary {
        border-radius: 50px;
        font-weight: 600;
      }

      .logo-img {
        width: 140px;
        margin-bottom: 20px;
      }

      .title {
        font-weight: 600;
        font-size: 1.5rem;
        margin-bottom: 25px;
        color: #1e3a8a;
      }
    </style>
  </head>

  <body>
    <div class="register-card text-center">
      <form action="sistem/aksi_daftar.php" method="post" class="needs-validation" novalidate>
        <img src="assets/img/rri/rri-logo1.png" alt="JasaCetak Logo" class="logo-img">
        <div class="title">DAFTAR</div>

        <!-- Flash Message -->
        <?php if (@$_SESSION['pesan']): ?>
          <div class="alert alert-<?= $_SESSION['pesan']['status'] ?> alert-dismissible fade show text-start" role="alert">
            <?= $_SESSION['pesan']['isi'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>

        <!-- Nama -->
        <div class="input-group mb-3">
          <span class="input-group-text"><i class="bi bi-person-badge-fill"></i></span>
          <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
          <div class="invalid-feedback text-start ps-5">Nama wajib diisi.</div>
        </div>

        <!-- Email -->
        <div class="input-group mb-3">
          <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
          <input type="email" name="email" class="form-control" placeholder="Email Aktif" required>
          <div class="invalid-feedback text-start ps-5">Email tidak valid.</div>
        </div>

        <!-- No Telp -->
        <div class="input-group mb-3">
          <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
          <input type="text" name="telp" class="form-control" placeholder="Nomor Telepon" required>
          <div class="invalid-feedback text-start ps-5">Nomor telepon wajib diisi.</div>
        </div>

        <!-- Password -->
        <div class="input-group mb-3">
          <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="invalid-feedback text-start ps-5">Password wajib diisi.</div>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary w-100 py-2">Daftar Sekarang</button>

        <p class="small mt-3 mb-0">
          Sudah punya akun? <a href="login.php">Login di sini</a>
        </p>
        <p class="text-muted small mt-3 mb-0">
          <a href="index.php"><i class="bi bi-arrow-left-circle"></i> Kembali ke halaman utama</a>
        </p>
      </form>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
          form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      })();
    </script>
  </body>
</html>
<?php unset($_SESSION['pesan']); ?>

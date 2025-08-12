<?php
session_start();
if (!empty($_SESSION['login'])) {
  header('Location: sistem/index.php');
  exit;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | RRI Padang</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
      body {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        background: linear-gradient(-45deg, #c3dafe, #bee3f8, #e0f2fe, #f7fafc);
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

      .login-card {
        width: 100%;
        max-width: 420px;
        padding: 40px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.75);
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
    <div class="login-card text-center">
      <form class="needs-validation" novalidate action="sistem/aksi_login.php" method="POST">
        <img src="assets/img/rri/rri-logo1.png" alt="RRI Logo" class="logo-img">
        <div class="title">Login Aplikasi</div>

        <?php if (@$_SESSION['pesan']): ?>
          <div class="alert alert-<?= $_SESSION['pesan']['status'] ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['pesan']['isi'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>

        <!-- Email -->
        <div class="input-group mb-3">
          <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
          <input type="email" name="email" class="form-control" placeholder="Masukkan Email" required>
          <div class="invalid-feedback text-start ps-5">Email wajib diisi.</div>
        </div>

        <!-- Password -->
        <div class="input-group mb-3">
          <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
          <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
          <div class="invalid-feedback text-start ps-5">Password wajib diisi.</div>
        </div>

        <!-- Button -->
        <button class="btn btn-primary w-100 py-2" type="submit">Login</button>

        <p class="small mt-3">Belum punya akun? <a href="daftar.php" class="text-primary">Daftar Sekarang</a></p>
        <p class="text-muted small mt-4 mb-0">&copy; 2025 RRI Padang</p>
      </form>
    </div>

    <!-- Validation Script -->
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

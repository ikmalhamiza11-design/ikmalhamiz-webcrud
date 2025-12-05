<?php
require 'function.php';

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "
        <script>
            alert('User baru berhasil ditambahkan!');
            document.location.href='login.php';
        </script>";
    } else {
        echo mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
     body {
          background: linear-gradient(145deg, #0a0f1f, #111827);
          min-height: 100vh;
          color: white;
          font-family: "Poppins", sans-serif;
     }

     .register-card {
          width: 450px;
          margin: auto;
          margin-top: 80px;
          padding: 30px;
          border-radius: 18px;
          background: rgba(255,255,255,0.04);
          border: 1px solid rgba(255,255,255,0.1);
          box-shadow:
               0 0 20px rgba(0, 255, 255, 0.2),
               inset 0 0 10px rgba(255,255,255,0.05);
          backdrop-filter: blur(10px);
     }

     .title {
          font-size: 26px;
          font-weight: bold;
          text-align: center;
          margin-bottom: 20px;
          text-shadow: 0 0 12px cyan;
     }

     .form-control {
          background: rgba(255,255,255,0.08);
          border: 1px solid rgba(255,255,255,0.2);
          color: #fff;
          border-radius: 10px;
     }

     .form-control:focus {
          background: rgba(255,255,255,0.15);
          color: cyan;
          border-color: cyan;
          box-shadow: 0 0 8px cyan;
     }

     label {
          font-weight: 500;
     }

     .btn-futuristic {
          width: 100%;
          padding: 10px;
          border-radius: 12px;
          border: none;
          background: linear-gradient(90deg, #00eaff, #007bff);
          color: #fff;
          font-weight: 600;
          transition: .3s;
     }

     .btn-futuristic:hover {
          transform: scale(1.05);
          box-shadow: 0 0 15px #00eaff;
     }

     .link-login {
          text-align: center;
          margin-top: 15px;
     }

     .link-login a {
          color: #00eaff;
          text-decoration: none;
          text-shadow: 0 0 6px cyan;
     }

</style>

</head>

<body>

<div class="register-card">

     <div class="title">🔐 Register Account</div>

     <form action="" method="post">
          <div class="mb-3">
               <label for="username">Username</label>
               <input type="text" class="form-control" name="username" id="username" required autocomplete="off">
          </div>

          <div class="mb-3">
               <label for="password">Password</label>
               <input type="password" class="form-control" name="password" id="password" required autocomplete="off">
          </div>

          <div class="mb-3">
               <label for="password2">Konfirmasi Password</label>
               <input type="password" class="form-control" name="password2" id="password2" required autocomplete="off">
          </div>

          <button type="submit" class="btn-futuristic" name="register">
               REGISTER
          </button>

          <div class="link-login">
               <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
          </div>
     </form>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

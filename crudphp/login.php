<?php
session_start();

if (isset($_SESSION['login'])) {
    header('location:index.php');
    exit;
}

require 'function.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $result = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
    $cek = mysqli_num_rows($result);

    if ($cek > 0) {
        $_SESSION['login'] = true;

        if (isset($_POST['remember'])) {
            $row = mysqli_fetch_assoc($result);
            setcookie('id', $row['id'], time() + 60);
            setcookie('key', hash('sha256', $row['username']), time() + 60);
        }

        header('location:index.php');
        exit;
    }

    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login - Wishlist App</title>

<!-- BOOTSTRAP -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- ICON -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
    body {
        background: linear-gradient(145deg, #0a0f1f, #111827);
        height: 100vh; 
        display: flex; 
        justify-content: center; 
        align-items: center;
        color: white;
        font-family: "Poppins", sans-serif;
    }

    .login-card {
        width: 420px;
        padding: 30px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255,255,255,0.1);
        backdrop-filter: blur(15px);
        box-shadow: 
            0 0 20px rgba(0, 255, 255, 0.15),
            inset 0 0 10px rgba(255,255,255,0.1);
        animation: fadeIn 1s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }

    .title {
        text-align: center;
        font-weight: bold;
        font-size: 28px;
        text-shadow: 0 0 10px cyan;
        margin-bottom: 20px;
    }

    input.form-control {
        background: rgba(255, 255, 255, 0.07);
        border: 1px solid rgba(255,255,255,0.2);
        color: white;
        border-radius: 12px;
    }

    input.form-control::placeholder {
        color: #cce6ff;
    }

    input.form-control:focus {
        background: rgba(255,255,255,0.12);
        box-shadow: 0 0 8px cyan;
        color: white;
    }

    .btn-login {
        width: 100%;
        background: linear-gradient(90deg, #00eaff, #007bff);
        border: none;
        color: white;
        font-weight: bold;
        border-radius: 12px;
        padding: 10px;
        transition: .3s;
        margin-top: 10px;
    }

    .btn-login:hover {
        transform: scale(1.05);
        box-shadow: 0 0 15px #00eaff;
    }

    .signup {
        margin-top: 15px;
        text-align: center;
        font-size: 14px;
    }

    .signup a {
        color: #00eaff;
        text-decoration: none;
    }

    .signup a:hover {
        text-shadow: 0 0 8px cyan;
    }
</style>

</head>

<body>

<div class="login-card">

    <div class="title">🚀 Login</div>

    <?php if (isset($error)) : ?>
        <div class="alert alert-danger text-center py-2">
            Username atau Password Salah!
        </div>
    <?php endif; ?>

    <form action="" method="post">
        <div class="mb-3">
            <input 
                type="text" 
                class="form-control" 
                placeholder="Username"
                name="username"
                required>
        </div>

        <div class="mb-3">
            <input 
                type="password" 
                class="form-control" 
                placeholder="Password"
                name="password"
                required>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label" for="remember">
                Remember Me
            </label>
        </div>

        <button type="submit" name="login" class="btn-login">
            LOGIN
        </button>

        <div class="signup">
            Belum punya akun? 
            <a href="registrasi.php">Sign Up</a>
        </div>
    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

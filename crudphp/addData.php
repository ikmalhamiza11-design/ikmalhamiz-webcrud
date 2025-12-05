<?php
session_start();
if (!isset($_SESSION['login'])) { header('location:login.php'); exit; }
require 'function.php';

if (isset($_POST['simpan'])) {
    if (tambah($_POST) > 0) {
        echo "<script>alert('Item berhasil ditambahkan!'); document.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menambah item!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&family=Orbitron:wght@600&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #0d1117;
            color: white;
            font-family: "Poppins";
        }
        .card-glass {
            background: rgba(255,255,255,0.06);
            padding: 25px;
            border-radius: 14px;
            border: 1px solid rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
        }
        .form-control, .form-select {
            background: rgba(255,255,255,0.12);
            border: none;
            color: white;
        }
        .btn-modern {
            background: #0dcaf0;
            border: none;
            color: #000;
            font-weight: bold;
        }
    </style>

    <title>Tambah Wishlist</title>
</head>

<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand">WishlistApp</span>
    </div>
</nav>

<div class="container mt-4">
    <div class="card-glass w-75 mx-auto">
        <h3 class="fw-bold text-uppercase">Tambah Wishlist</h3>
        <hr>

        <form method="post">

            <label class="mt-2">Nama Item</label>
            <input type="text" name="nama_item" class="form-control mb-2" required>

            <label>Kategori</label>
            <input type="text" name="kategori" class="form-control mb-2" required>

            <label>Tanggal Ditambahkan</label>
            <input type="date" name="tanggal_ditambahkan" class="form-control mb-2" required>

            <label>Harga Estimasi</label>
            <input type="number" name="harga_estimasi" class="form-control mb-2" required>

            <label>Status</label>
            <select name="status" class="form-select mb-2">
                <option value="Pending">Pending</option>
                <option value="Dibeli">Dibeli</option>
                <option value="Ditunda">Ditunda</option>
            </select>

            <label>Catatan</label>
            <textarea name="catatan" rows="4" class="form-control mb-3"></textarea>

            <a href="index.php" class="btn btn-secondary">Kembali</a>
            <button type="submit" name="simpan" class="btn btn-modern">Simpan</button>
        </form>
    </div>
</div>

</body>
</html>

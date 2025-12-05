<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

require 'function.php';

// Ambil id wishlist
$id = $_GET['id'];

// Ambil data dari tabel whishlist
$data = query("SELECT * FROM whishlist WHERE id_wishlist = '$id'")[0];

// Proses ubah data
if (isset($_POST['ubah'])) {
    if (ubah($_POST) > 0) {
        echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>alert('Data gagal diubah!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="css/style.css">

     <title>Ubah Wishlist</title>
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">WishlistApp</a>
    </div>
</nav>

<div class="container mt-4">
    <h3 class="fw-bold text-uppercase">Ubah Data Wishlist</h3>
    <hr>

    <form action="" method="post">
        <input type="hidden" name="id_wishlist" value="<?= $data['id_wishlist']; ?>">

        <div class="mb-3">
            <label class="form-label">Nama Item</label>
            <input type="text" class="form-control w-50" name="nama_item"
                   value="<?= $data['nama_item']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <input type="text" class="form-control w-50" name="kategori"
                   value="<?= $data['kategori']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Ditambahkan</label>
            <input type="date" class="form-control w-50" name="tanggal_ditambahkan"
                   value="<?= $data['tanggal_ditambahkan']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga Estimasi</label>
            <select class="form-select w-50" name="harga_estimasi" required>
                <option value="Rp_50000"     <?= ($data['harga_estimasi'] == "Rp_50000") ? "selected" : "" ?>>Rp 50.000</option>
                <option value="Rp_100000"    <?= ($data['harga_estimasi'] == "Rp_100000") ? "selected" : "" ?>>Rp 100.000</option>
                <option value="Rp_500000"    <?= ($data['harga_estimasi'] == "Rp_500000") ? "selected" : "" ?>>Rp 500.000</option>
                <option value="Rp_1000000"   <?= ($data['harga_estimasi'] == "Rp_1000000") ? "selected" : "" ?>>Rp 1.000.000</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select class="form-select w-50" name="status" required>
                <option value="Pending"  <?= ($data['status'] == "Pending") ? "selected" : "" ?>>Pending</option>
                <option value="Dibeli"   <?= ($data['status'] == "Dibeli") ? "selected" : "" ?>>Dibeli</option>
                <option value="Ditunda"  <?= ($data['status'] == "Ditunda") ? "selected" : "" ?>>Ditunda</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Catatan</label>
            <textarea class="form-control w-50" rows="4" name="catatan"><?= $data['catatan']; ?></textarea>
        </div>

        <a href="index.php" class="btn btn-secondary">Kembali</a>
        <button type="submit" name="ubah" class="btn btn-warning">Ubah</button>
    </form>
</div>

</body>
</html>

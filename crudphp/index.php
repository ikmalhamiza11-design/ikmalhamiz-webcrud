<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

require 'function.php';

$wishlist = query("SELECT * FROM whishlist ORDER BY id_wishlist DESC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Wishlist App</title>

<!-- Bootstrap 5 & Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
    body {
        background: linear-gradient(145deg, #0a0f1f, #111827);
        min-height: 100vh;
        color: white;
        font-family: "Poppins", sans-serif;
    }

    /* Navbar Futuristik */
    .navbar {
        backdrop-filter: blur(20px);
        background: rgba(0,0,0,0.65) !important;
        border-bottom: 1px solid rgba(255,255,255,0.08);
    }

    .title {
        text-shadow: 0 0 12px cyan;
        letter-spacing: 1px;
    }

    .neo-card {
        background: rgba(255, 255, 255, 0.04);
        backdrop-filter: blur(10px);
        padding: 20px;
        border-radius: 20px;
        border: 1px solid rgba(255,255,255,0.1);
        box-shadow: 0 0 15px rgba(0, 255, 255, 0.1), inset 0 0 10px rgba(255,255,255,0.05);
    }

    table {
        color: white !important;
    }

    thead {
        background: rgba(0, 255, 255, 0.3);
        text-shadow: 0 0 3px cyan;
    }

    tbody tr:hover {
        background: rgba(0, 255, 255, 0.1) !important;
        cursor: pointer;
    }

    .btn-futuristic {
        background: linear-gradient(90deg, #00eaff, #007bff);
        border: none;
        border-radius: 10px;
        transition: 0.3s;
        color: white;
    }

    .btn-futuristic:hover {
        transform: scale(1.05);
        box-shadow: 0 0 12px #00eaff;
    }

    .btn-danger, .btn-warning, .btn-success {
        border-radius: 10px;
    }

    .footer {
        margin-top: 50px;
        padding: 20px;
        background: rgba(0,0,0,0.4);
        backdrop-filter: blur(10px);
        border-top: 1px solid rgba(255,255,255,0.08);
    }
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark px-3">
    <a class="navbar-brand fw-bold text-cyan" href="#">🌌 WishlistApp</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        </ul>
    </div>
</nav>

<div class="container py-5">

    <h2 class="text-center mb-4 title fw-bold">🌟 WISHLIST DATA</h2>

    <div class="neo-card">

        <div class="d-flex mb-3">
            <a href="addData.php" class="btn btn-futuristic">
                <i class="bi bi-plus-circle"></i> Tambah Data
            </a>
            <a href="export.php" target="_blank" class="btn btn-success ms-2">
                <i class="bi bi-file-earmark-spreadsheet"></i> Export
            </a>
        </div>

        <table class="table table-hover text-center align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Item</th>
                    <th>Kategori</th>
                    <th>Tanggal</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $no=1; foreach($wishlist as $row): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['nama_item']; ?></td>
                    <td><?= $row['kategori']; ?></td>
                    <td><?= $row['tanggal_ditambahkan']; ?></td>
                    <td><?= $row['harga_estimasi']; ?></td>
                    <td><?= $row['status']; ?></td>
                    <td>
                        <button class="btn btn-success btn-sm detail" data-id="<?= $row['id_wishlist']; ?>">
                            <i class="bi bi-info-circle-fill"></i>
                        </button>
                        <a href="ubah.php?id=<?= $row['id_wishlist']; ?>" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="hapus.php?id=<?= $row['id_wishlist']; ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('Hapus item ini?');">
                           <i class="bi bi-trash-fill"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="detail" tabindex="-1">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content text-white bg-dark" style="backdrop-filter: blur(10px); border-radius: 20px;">
      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold text-uppercase">Detail Wishlist</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center" id="detail-wishlist"></div>
    </div>
  </div>
</div>

<!-- FOOTER -->
<div class="footer text-center text-white">
    <p class="m-0">Dibuat oleh Ikmal Hamiz Azhari (50423605)</p>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
$(document).ready(function(){
    $('.detail').click(function(){
        var id = $(this).data("id");
        $.post("detail.php", { id:id }, function(result){
            $('#detail-wishlist').html(result);
            var detailModal = new bootstrap.Modal(document.getElementById('detail'));
            detailModal.show();
        });
    });
});
</script>

</body>
</html>

<?php
session_start();

// Jika belum login
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

require 'function.php';

// Cek apakah id ada di URL
if (!isset($_GET['id']) || $_GET['id'] == "") {
    echo "<script>
            alert('ID tidak valid!');
            document.location.href = 'index.php';
          </script>";
    exit;
}

$id = $_GET['id']; // VARCHAR, jangan pakai intval

// Jalankan fungsi hapus
if (hapus($id) > 0) {
    echo "<script>
            alert('Item wishlist berhasil dihapus!');
            document.location.href = 'index.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal menghapus item wishlist!');
            document.location.href = 'index.php';
          </script>";
}

?>

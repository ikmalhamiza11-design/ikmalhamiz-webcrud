<?php
// Memanggil file function.php (koneksi + query)
require 'function.php';

// Ambil semua data wishlist
$wishlist = query("SELECT * FROM whishlist ORDER BY tanggal_ditambahkan DESC");

// Membuat nama file otomatis
$filename = "data-wishlist-" . date('Ymd') . ".xls";

// Header untuk download file Excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$filename");

?>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr style="background: #ddd; font-weight: bold;">
            <th>No</th>
            <th>ID Wishlist</th>
            <th>Nama Item</th>
            <th>Kategori</th>
            <th>Tanggal Ditambahkan</th>
            <th>Harga Estimasi</th>
            <th>Status</th>
            <th>Catatan</th>
        </tr>
    </thead>

    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($wishlist as $row) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['id_wishlist']; ?></td>
                <td><?= $row['nama_item']; ?></td>
                <td><?= $row['kategori']; ?></td>
                <td><?= date("d M Y", strtotime($row['tanggal_ditambahkan'])); ?></td>

                <!-- Hilangkan underscore agar tampil rapi -->
                <td><?= str_replace("_", " ", $row['harga_estimasi']); ?></td>

                <td><?= $row['status']; ?></td>
                <td><?= $row['catatan']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

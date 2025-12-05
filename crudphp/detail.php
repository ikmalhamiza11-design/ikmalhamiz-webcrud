<?php
require 'function.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Ambil data dari tabel whishlist
    $data = query("SELECT * FROM whishlist WHERE id_wishlist = '$id'")[0];

    // Bersihkan harga agar number_format aman
    $harga = preg_replace('/[^0-9]/', '', $data['harga_estimasi']);

    $output = '
    <div style="
        background: rgba(255,255,255,0.08);
        padding: 25px;
        border-radius: 16px;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255,255,255,0.15);
        color: white;
        font-size: 16px;
    ">
        <h4 class="text-uppercase fw-bold mb-3" style="color:#9ddfff; text-shadow:0 0 8px cyan;">Detail Item</h4>

        <table class="table table-borderless text-white">
            <tr>
                <th style="width:180px;">Nama Item</th>
                <td>' . htmlspecialchars($data['nama_item']) . '</td>
            </tr>
            <tr>
                <th>Kategori</th>
                <td>' . htmlspecialchars($data['kategori']) . '</td>
            </tr>
            <tr>
                <th>Tanggal Ditambahkan</th>
                <td>' . htmlspecialchars($data['tanggal_ditambahkan']) . '</td>
            </tr>
            <tr>
                <th>Harga Estimasi</th>
                <td>Rp ' . number_format((int)$harga, 0, ",", ".") . '</td>
            </tr>
            <tr>
                <th>Status</th>
                <td><span class="badge bg-info text-dark px-3 py-2" style="font-size:14px;">' . htmlspecialchars($data['status']) . '</span></td>
            </tr>
            <tr>
                <th>Catatan</th>
                <td>' . nl2br(htmlspecialchars($data['catatan'])) . '</td>
            </tr>
        </table>
    </div>';

    echo $output;
}
?>

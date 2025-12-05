<?php
// Koneksi Database
$koneksi = mysqli_connect("localhost", "root", "", "whishlist");

// Fungsi Query
function query($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// Fungsi Tambah Wishlist
function tambah($data)
{
    global $koneksi;

    // Generate ID otomatis (WL001, WL002, ...)
    $queryId = mysqli_query($koneksi, "SELECT MAX(id_wishlist) AS maxID FROM whishlist");
    $resultId = mysqli_fetch_assoc($queryId);
    
    $maxID = $resultId['maxID'];
    $number = (int) substr($maxID, 2, 3); // ambil 3 digit angka
    $number++;
    $newID = "WL" . sprintf("%03d", $number);

    // Ambil data form
    $nama_item = htmlspecialchars($data['nama_item']);
    $kategori = htmlspecialchars($data['kategori']);
    $tanggal = htmlspecialchars($data['tanggal_ditambahkan']);
    $harga = htmlspecialchars($data['harga_estimasi']);
    $status = htmlspecialchars($data['status']);
    $catatan = htmlspecialchars($data['catatan']);

    // Query insert
    $query = "INSERT INTO whishlist 
              VALUES 
              ('$newID', '$nama_item', '$kategori', '$tanggal', '$harga', '$status', '$catatan')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}


// Fungsi Hapus Wishlist
function hapus($id)
{
    global $koneksi;
    $id = mysqli_real_escape_string($koneksi, $id);

    mysqli_query($koneksi, "DELETE FROM whishlist WHERE id_wishlist = '$id'");

    return mysqli_affected_rows($koneksi);
}


// Fungsi Ubah Wishlist
function ubah($data)
{
    global $koneksi;

    $id = htmlspecialchars($data['id_wishlist']);
    $nama = htmlspecialchars($data['nama_item']);
    $kategori = htmlspecialchars($data['kategori']);
    $tanggal = htmlspecialchars($data['tanggal_ditambahkan']);
    $harga = htmlspecialchars($data['harga_estimasi']);
    $status = htmlspecialchars($data['status']);
    $catatan = htmlspecialchars($data['catatan']);

    $sql = "UPDATE whishlist SET
                nama_item = '$nama',
                kategori = '$kategori',
                tanggal_ditambahkan = '$tanggal',
                harga_estimasi = '$harga',
                status = '$status',
                catatan = '$catatan'
            WHERE id_wishlist = '$id'";

    mysqli_query($koneksi, $sql);

    return mysqli_affected_rows($koneksi);
}

// Fungsi Registrasi User
function registrasi($data)
{
    global $koneksi;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>alert('Username sudah terdaftar');</script>";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>alert('Konfirmasi password tidak sesuai');</script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru
    mysqli_query($koneksi, "INSERT INTO user VALUES('', '$username', '$password')");

    return mysqli_affected_rows($koneksi);
}

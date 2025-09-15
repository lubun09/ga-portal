<?php
session_start();
include '../../koneksi/koneksi.php';

// Ambil data dari form
$nama       = trim(mysqli_real_escape_string($db, $_POST['nama_pelanggan'] ?? ''));
$username   = trim(mysqli_real_escape_string($db, $_POST['username_pelanggan'] ?? ''));
$password   = trim(mysqli_real_escape_string($db, sha1($_POST['password'] ?? '')));
$tanggal    = trim(mysqli_real_escape_string($db, $_POST['tanggal_lahir'] ?? ''));
$alamat     = trim(mysqli_real_escape_string($db, $_POST['alamat_pelanggan'] ?? ''));
$no_hp      = trim(mysqli_real_escape_string($db, $_POST['no_hp_pelanggan'] ?? ''));
$email      = trim(mysqli_real_escape_string($db, $_POST['email_pelanggan'] ?? ''));

// File upload
$nama_file_lengkap = $_FILES['gambar']['name'] ?? '';
$tmp_file          = $_FILES['gambar']['tmp_name'] ?? '';
$ukuran_file       = $_FILES['gambar']['size'] ?? 0;
$ext_file          = strtolower(pathinfo($nama_file_lengkap, PATHINFO_EXTENSION));
$allowed_types     = ['jpg','jpeg','png','gif'];
$max_size          = 2 * 1024 * 1024; // 2MB

// Cek semua kolom wajib
if (!$nama || !$username || !$password || !$tanggal || !$alamat || !$no_hp || !$email) {
    die("<center><h2>Isi semua kolom wajib!</h2></center>
         <meta http-equiv='refresh' content='2;url=../daftar'>");
}

// Cek file upload
if ($nama_file_lengkap) {
    if (!in_array($ext_file, $allowed_types)) {
        die("<center><h2>Format file tidak diizinkan!</h2></center>
             <meta http-equiv='refresh' content='2;url=../daftar'>");
    }
    if ($ukuran_file > $max_size) {
        die("<center><h2>Ukuran file terlalu besar! Max 2MB.</h2></center>
             <meta http-equiv='refresh' content='2;url=../daftar'>");
    }

    // Buat Jenis Barang baru
    $nama_baru = $username . "_" . time() . "." . $ext_file;
    $path = "../images/" . $nama_baru;

    // Pastikan folder punya permission
    if (!is_writable(dirname($path))) {
        die("<center><h2>Folder tujuan tidak bisa ditulis! Periksa permission.</h2></center>");
    }

    if (!move_uploaded_file($tmp_file, $path)) {
        die("<center><h2>Gagal memindahkan file!</h2></center>");
    }
} else {
    $nama_baru = ''; // jika tidak upload
}

// Insert data ke database
$sql = "INSERT INTO tb_pelanggan 
        (nama_pelanggan, username_pelanggan, password, tanggal_lahir, alamat_pelanggan, no_hp_pelanggan, email_pelanggan, gambar)
        VALUES ('$nama', '$username', '$password', '$tanggal', '$alamat', '$no_hp', '$email', '$nama_baru')";

if (mysqli_query($db, $sql)) {
    echo "<center><h2>Terima Kasih! Silahkan Login.</h2></center>
          <meta http-equiv='refresh' content='2;url=../../../ga-messenger'>";
} else {
    die("<center><h2>Gagal menyimpan data: " . mysqli_error($db) . "</h2></center>");
}
?>

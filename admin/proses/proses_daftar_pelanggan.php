<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include '../../koneksi/koneksi.php';

$nama      = mysqli_real_escape_string($db, $_POST['nama_pelanggan']);
$username  = mysqli_real_escape_string($db, $_POST['username_pelanggan']);
$password  = mysqli_real_escape_string($db, sha1($_POST['password']));
$tanggal   = mysqli_real_escape_string($db, $_POST['tanggal_lahir']);
$alamat    = mysqli_real_escape_string($db, $_POST['alamat_pelanggan']);
$no_hp     = mysqli_real_escape_string($db, $_POST['no_hp_pelanggan']);
$email     = mysqli_real_escape_string($db, $_POST['email_pelanggan']);

$gambar_nama = $_FILES['gambar']['name'];
$gambar_tmp  = $_FILES['gambar']['tmp_name'];
$gambar_size = $_FILES['gambar']['size'];
$ext         = strtolower(pathinfo($gambar_nama, PATHINFO_EXTENSION));

if (!$nama || !$username || !$password || !$tanggal || !$alamat || !$no_hp || !$email) {
    die("Semua field wajib diisi!");
}

if (!in_array($ext, ["jpg","jpeg","png"])) {
    die("Format gambar harus JPG / JPEG / PNG!");
}

if ($gambar_size > 2100000) {
    die("Ukuran gambar tidak boleh lebih dari 2MB!");
}

$nama_baru = $username . "_" . time() . "." . $ext;
$path = "../../pelanggan/images/" . $nama_baru;

if (move_uploaded_file($gambar_tmp, $path)) {
    $sql = "INSERT INTO tb_pelanggan 
            (nama_pelanggan, username_pelanggan, password, tanggal_lahir, alamat_pelanggan, no_hp_pelanggan, email_pelanggan, gambar)
            VALUES 
            ('$nama','$username','$password','$tanggal','$alamat','$no_hp','$email','$nama_baru')";
    
    if (mysqli_query($db, $sql)) {
        echo "<center><h2><br>Pelanggan berhasil didaftarkan</h2></center>
              <meta http-equiv='refresh' content='2;url=../datapelanggan.php'>";
    } else {
        echo "Error Query: " . mysqli_error($db);
    }
} else {
    echo "Upload gambar gagal!";
}
?>

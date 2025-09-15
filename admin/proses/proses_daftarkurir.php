<?php
// Mulai session (cek dulu biar tidak dobel)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include '../../koneksi/koneksi.php';

// Ambil data dari form
$nama       = mysqli_real_escape_string($db, $_POST['nama_kurir']);
$username   = mysqli_real_escape_string($db, $_POST['username_kurir']);
$password   = mysqli_real_escape_string($db, sha1($_POST['password']));
$tanggal    = mysqli_real_escape_string($db, $_POST['tanggal_lahir_kurir']);
$alamat     = mysqli_real_escape_string($db, $_POST['alamat']);
$no_hp      = mysqli_real_escape_string($db, $_POST['no_hp_kurir']);
$no_plat    = mysqli_real_escape_string($db, $_POST['no_plat']);
$email      = mysqli_real_escape_string($db, $_POST['email_kurir']); // tambahkan input email di form

// File upload
$nama_file_lengkap = $_FILES['gambar']['name'];
$nama_file         = substr($nama_file_lengkap, 0, strripos($nama_file_lengkap, '.'));
$ext_file          = substr($nama_file_lengkap, strripos($nama_file_lengkap, '.'));
$tipe_file         = $_FILES['gambar']['type'];
$ukuran_file       = $_FILES['gambar']['size'];
$tmp_file          = $_FILES['gambar']['tmp_name'];

// Validasi input
if (
    $nama != '' && $username != '' && $password != '' && $tanggal != '' && 
    $alamat != '' && $no_hp != '' && $no_plat != '' && $email != '' &&
    ($tipe_file == "image/jpeg" || $tipe_file == "image/jpg" || $tipe_file == "image/png") &&
    ($ukuran_file <= 2100000)
) {
    $nama_baru = $username . $ext_file;
    $path      = "../../kurir/images/" . $nama_baru;
    move_uploaded_file($tmp_file, $path);

    // Query INSERT lengkap dengan email
    $sql = "INSERT INTO tb_kurir(
                nama_kurir, username_kurir, password, tanggal_lahir_kurir,
                alamat, no_hp_kurir, no_plat, email_kurir, gambar
            )
            VALUES (
                '$nama', '$username', '$password', '$tanggal',
                '$alamat', '$no_hp', '$no_plat', '$email', '$nama_baru'
            )";
    $execute = mysqli_query($db, $sql);

    echo "<center><h2><br>Terima Kasih<br>Kurir Telah Didaftarkan ke Sistem</h2></center>
          <meta http-equiv='refresh' content='2;url=../datakurir.php'>";
} else {
    echo "<center><h2>Silahkan isi semua kolom dengan benar lalu tekan submit<br>Terima Kasih</h2></center>
          <meta http-equiv='refresh' content='2;url=../input-kurir.php'>";
}
?>

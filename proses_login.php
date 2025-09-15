<?php
session_start();
include "koneksi/koneksi.php";

$username = mysqli_real_escape_string($db, $_POST['username']);
$password = mysqli_real_escape_string($db, sha1($_POST['password']));

// Cek ke admin
$query = mysqli_query($db, "SELECT * FROM tb_admin WHERE username_admin='$username' AND password='$password'");
if ($data = $query->fetch_array()) {
    $_SESSION['r3su']     = 'dmn';
    $_SESSION['id']       = $data['id_admin'];
    $_SESSION['username'] = $data['username_admin'];
    $_SESSION['nama']     = $data['nama_admin'];
    header("Location: admin/");
    exit;
}

// Cek ke kurir
$query = mysqli_query($db, "SELECT * FROM tb_kurir WHERE username_kurir='$username' AND password='$password'");
if ($data = $query->fetch_array()) {
    $_SESSION['r3su']     = 'krr';
    $_SESSION['id']       = $data['id_kurir'];
    $_SESSION['username'] = $data['username_kurir'];
    $_SESSION['nama']     = $data['nama_kurir'];
    header("Location: kurir/");
    exit;
}

// Cek ke pelanggan
$query = mysqli_query($db, "SELECT * FROM tb_pelanggan WHERE username_pelanggan='$username' AND password='$password'");
if ($data = $query->fetch_array()) {
    $_SESSION['r3su']     = 'plg';
    $_SESSION['id']       = $data['id_pelanggan'];
    $_SESSION['username'] = $data['username_pelanggan'];
    $_SESSION['nama']     = $data['nama_pelanggan'];
    header("Location: pelanggan/");
    exit;
}

// Kalau tidak ketemu di manapun
echo "<center>Username atau Password salah<br><br><h3>Silahkan ulangi</h3></center>";
echo "<meta http-equiv='refresh' content='2;url=login/index.php'>";
?>

<?php
session_start();
include '../../koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_SESSION['id']);

    $nama     = mysqli_real_escape_string($db, $_POST['nama_pelanggan']);
    $username = mysqli_real_escape_string($db, $_POST['username_pelanggan']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $tanggal  = mysqli_real_escape_string($db, $_POST['tanggal_lahir']);
    $alamat   = mysqli_real_escape_string($db, $_POST['alamat_pelanggan']);
    $no_hp    = mysqli_real_escape_string($db, $_POST['no_hp_pelanggan']);
    $gambar   = $_FILES['gambar']['name'];

    $query = mysqli_query($db, "SELECT * FROM tb_pelanggan WHERE id_pelanggan = '$id'");
    $data = mysqli_fetch_array($query);

    if ($gambar == '') {
        $ext     = pathinfo($data['gambar'], PATHINFO_EXTENSION);
        $nama_b  = $username . "." . $ext;
        rename("../images/" . $data['gambar'], "../images/" . $nama_b);
    } else {
        $tipe_file = $_FILES['gambar']['type'];
        $ukuran_file = $_FILES['gambar']['size'];
        if (in_array($tipe_file, ["image/jpeg", "image/jpg", "image/png"]) && $ukuran_file <= 2100000) {
            @unlink("../images/" . $data['gambar']);
            $ext_file = pathinfo($gambar, PATHINFO_EXTENSION);
            $nama_baru = $username . "_" . time() . "." . $ext_file;
            move_uploaded_file($_FILES['gambar']['tmp_name'], "../images/" . $nama_baru);
            $nama_b = $nama_baru;
        } else {
            echo "<center><h2><br>Gambar tidak sesuai<br>Silakan ulangi</h2></center>";
            echo "<meta http-equiv='refresh' content='2;url=../edit-profilepelanggan.php'>";
            exit;
        }
    }

    $sql = "UPDATE tb_pelanggan SET 
                nama_pelanggan = '$nama',
                username_pelanggan = '$username',
                password = '$password',
                tanggal_lahir = '$tanggal',
                alamat_pelanggan = '$alamat',
                no_hp_pelanggan = '$no_hp',
                gambar = '$nama_b' 
            WHERE id_pelanggan = $id";
    mysqli_query($db, $sql);

    $_SESSION['username'] = $username;
    $_SESSION['nama'] = $nama;

    echo "<center><h2><br>Data anda telah diperbarui</h2></center>";
    echo "<meta http-equiv='refresh' content='2;url=../detail-pelanggan.php'>";
}
?>

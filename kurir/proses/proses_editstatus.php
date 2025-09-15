<?php
session_start();
include '../../koneksi/koneksi.php';

$no_transaksi = mysqli_real_escape_string($db, $_POST['no_transaksi']);
$status       = mysqli_real_escape_string($db, $_POST['status']);

$sql = "SELECT * FROM tb_transaksi WHERE no_transaksi='$no_transaksi'";
$query = mysqli_query($db, $sql);
$data = mysqli_fetch_array($query);

$gambar_awal_path  = $data['gambar_awal'];
$gambar_akhir_path = $data['gambar_akhir'];

$dir_awal  = "../images/diambil/";
$dir_akhir = "../images/selesai/";

if(!is_dir($dir_awal)) mkdir($dir_awal, 0755, true);
if(!is_dir($dir_akhir)) mkdir($dir_akhir, 0755, true);

function uploadFile($fileInput, $targetDir, $no_transaksi) {
    if (!isset($_FILES[$fileInput]) || $_FILES[$fileInput]['name'] == "") return [false, null];
    if ($_FILES[$fileInput]['error'] !== 0) return [false, null];

    $fileName = $no_transaksi."_".time()."_".preg_replace('/[^a-zA-Z0-9_\-\.]/', '_', basename($_FILES[$fileInput]['name']));
    $targetFile = $targetDir . $fileName;

    if (!move_uploaded_file($_FILES[$fileInput]['tmp_name'], $targetFile)) return [false, null];
    return [true, $fileName];
}

if ($status == 'Proses Pengiriman') {
    list($success, $fileName) = uploadFile('gambar_awal', $dir_awal, $no_transaksi);
    if ($success) $gambar_awal_path = $fileName;
}

if ($status == 'Terkirim') {
    list($success, $fileName) = uploadFile('gambar_akhir', $dir_akhir, $no_transaksi);
    if ($success) $gambar_akhir_path = $fileName;
}

date_default_timezone_set('Asia/Jakarta');
$date = date("d-m-Y H:i:s");
$waktu = $data['waktu'].'<br>'.$status.' &nbsp;&nbsp;('.$date.')';

$sqlUpdate = "UPDATE tb_transaksi SET 
                status='$status',
                gambar_awal='$gambar_awal_path',
                gambar_akhir='$gambar_akhir_path',
                kurir='".$_SESSION['id']."',
                waktu='$waktu'
              WHERE no_transaksi='$no_transaksi'";
mysqli_query($db, $sqlUpdate);

$pesan_pelanggan = ($status == 'Proses Pengiriman') ? "Barang Diambil" : "Barang Sampai";
$sql_notif_pelanggan = "INSERT INTO tb_notifikasi (id_pelanggan, pesan, status) 
                        VALUES ('".$data['pengirim']."', '$pesan_pelanggan', 'unread')";
mysqli_query($db, $sql_notif_pelanggan);

$admin_id = 6;
$sql_notif_admin = "INSERT INTO tb_notifikasi (id_pelanggan, pesan, status) 
                    VALUES ('$admin_id', '$pesan_pelanggan', 'unread')";
mysqli_query($db, $sql_notif_admin);

echo "<center><h2>Status Telah Diubah Menjadi ".$status."</h2></center>";

if ($status == 'Terkirim') {
    echo "<meta http-equiv='refresh' content='2;url=../orderterkirim.php'>";
} else {
    echo "<meta http-equiv='refresh' content='2;url=../ambilorder.php?no_transaksi=".$no_transaksi."'>";
}
?>

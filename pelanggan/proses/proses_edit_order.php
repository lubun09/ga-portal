<?php
session_start();
include '../../koneksi/koneksi.php';

$no_transaksi   = $_GET['no_transaksi'];
$nama_barang    = mysqli_real_escape_string($db, $_POST['nama_barang']);
$alamat_asal    = mysqli_real_escape_string($db, $_POST['alamat_asal']);
$alamat_tujuan  = mysqli_real_escape_string($db, $_POST['alamat_tujuan']);
$penerima       = mysqli_real_escape_string($db, $_POST['penerima']);
$no_hp          = mysqli_real_escape_string($db, $_POST['no_hp_penerima']);

// cek foto lama
$q = mysqli_query($db, "SELECT foto_barang FROM tb_transaksi WHERE no_transaksi='$no_transaksi'");
$old = mysqli_fetch_assoc($q);
$foto_lama = $old['foto_barang'];

// proses foto baru
$foto_barang  = $_FILES['foto_barang']['name'];
$tmp_foto     = $_FILES['foto_barang']['tmp_name'];

if(!empty($foto_barang)){
    // folder tujuan
    $folder = "../../pelanggan/images/Kirim/";
    if(!is_dir($folder)){ mkdir($folder, 0777, true); }

    // hapus foto lama jika ada
    if(!empty($foto_lama) && file_exists($folder.$foto_lama)){
        unlink($folder.$foto_lama);
    }

    // buat nama unik dan upload
    $nama_file_baru = time()."_".$foto_barang;
    move_uploaded_file($tmp_foto, $folder.$nama_file_baru);

    $foto_final = $nama_file_baru;
} else {
    // tidak upload foto baru
    $foto_final = $foto_lama;
}

// update data
$sql = "UPDATE tb_transaksi SET 
        nama_barang='$nama_barang',
        alamat_asal='$alamat_asal',
        alamat_tujuan='$alamat_tujuan',
        penerima='$penerima',
        no_hp_penerima='$no_hp',
        foto_barang='$foto_final'
        WHERE no_transaksi='$no_transaksi'";

$update = mysqli_query($db, $sql);

if($update){
    echo "<center><h2>Data Order berhasil diupdate</h2></center>
    <meta http-equiv='refresh' content='2;url=../dataorder.php'>";
} else {
    echo "<center><h2>Gagal mengupdate data</h2></center>
    <meta http-equiv='refresh' content='2;url=../edit-order.php?no_transaksi=$no_transaksi'>";
}
?>

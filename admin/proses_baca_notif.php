<?php
session_start();
include '../koneksi/koneksi.php';

if(isset($_GET['id'])){
    $id_notif = intval($_GET['id']);
    mysqli_query($db, "UPDATE tb_notifikasi SET status='read' WHERE id_notif='$id_notif'");
}

// Kembali ke halaman sebelumnya
header("Location: index.php");
exit();
?>

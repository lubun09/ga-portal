<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include '../koneksi/koneksi.php';

if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    // Update notifikasi menjadi read
    mysqli_query($db, "UPDATE tb_notifikasi SET status='read' WHERE id_notif='$id'");

    // Redirect kembali ke halaman asal
    $redirect = !empty($_GET['redirect']) ? $_GET['redirect'] : 'index.php';
    header("Location: ".$redirect);
    exit;
}
?>

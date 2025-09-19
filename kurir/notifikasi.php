<?php
session_start();
include '../koneksi/koneksi.php';

// Cek apakah ada id_notif dari URL
if (isset($_GET['id'])) {
    $id_notif = intval($_GET['id']);

    // Validasi id_notif
    if ($id_notif > 0) {
        $stmt = mysqli_prepare($db, "UPDATE tb_notifikasi SET status='read' WHERE id_notif=?");
        mysqli_stmt_bind_param($stmt, "i", $id_notif);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

// Redirect kembali ke halaman index kurir
header("Location: index.php");
exit();
?>

<?php
// Mulai session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include '../koneksi/koneksi.php';

// Cek login
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit;
}

$id_pelanggan = $_SESSION['id'];

// Jika ada aksi "tandai sebagai sudah dibaca"
if (isset($_GET['read']) && is_numeric($_GET['read'])) {
    $id_notif = intval($_GET['read']);
    mysqli_query($db, "UPDATE tb_notifikasi SET status='read' 
                       WHERE id_notif='$id_notif' AND id_pelanggan='$id_pelanggan'");
    header("Location: notifikasi.php");
    exit;
}

// Ambil semua notifikasi
$notif_q = mysqli_query($db, "SELECT * FROM tb_notifikasi 
                              WHERE id_pelanggan='$id_pelanggan'
                              ORDER BY tanggal DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Notifikasi</title>
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
  <style>
    body { background: #f7f7f7; }
    .notif-card {
      background: #fff;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 10px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      transition: 0.2s;
    }
    .notif-card.unread {
      border-left: 5px solid #ff9800;
      background: #fff9f0;
    }
    .notif-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
    .notif-time {
      font-size: 12px;
      color: #777;
    }
  </style>
</head>
<body>
<div class="container" style="margin-top:30px;">

  <h3><i class="fa fa-bell-o"></i> Notifikasi Anda</h3>
  <hr>

  <?php 
  if (mysqli_num_rows($notif_q) > 0) {
      while ($n = mysqli_fetch_assoc($notif_q)) {
          $statusClass = $n['status'] == 'unread' ? 'unread' : '';
          echo '
          <div class="notif-card '.$statusClass.'">
            <p><i class="fa fa-info-circle text-aqua"></i> '.$n['pesan'].'</p>
            <div class="d-flex justify-content-between">
              <span class="notif-time">'.date("d-m-Y H:i", strtotime($n['tanggal'])).'</span>';
          
          if ($n['status'] == 'unread') {
              echo '<a href="notifikasi.php?read='.$n['id_notif'].'" class="btn btn-xs btn-primary">
                      Tandai sudah dibaca
                    </a>';
          } else {
              echo '<span class="label label-success">Sudah dibaca</span>';
          }
          
          echo '</div>
          </div>';
      }
  } else {
      echo '<div class="alert alert-info"><i class="fa fa-check"></i> Tidak ada notifikasi.</div>';
  }
  ?>

</div>
</body>
</html>

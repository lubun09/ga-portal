<?php 
session_start(); 
include "login/ceksession.php";
include '../koneksi/koneksi.php';
?>
<html>
<head>
  <meta charset="utf-8">
  <title>GA-Messenger</title>
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
  <style>
    body {
      background: #f4f6f9;
    }
    .order-list {
      background: #fff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,.1);
    }
    .order-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 14px 16px;
      border-bottom: 1px solid #eee;
      transition: background .2s;
    }
    .order-item:last-child {
      border-bottom: none;
    }
    .order-item:hover {
      background: #f9f9f9;
    }
    .order-icon {
      font-size: 22px;
      margin-right: 12px;
      color: #3498db;
      width: 30px;
      text-align: center;
    }
    .order-text {
      flex: 1;
    }
    .order-text p {
      margin: 0;
      font-size: 14px;
    }
    .order-text .id {
      font-weight: 600;
      font-size: 15px;
      margin-bottom: 4px;
    }
    .order-status .label {
      font-size: 12px;
      padding: 3px 8px;
      border-radius: 12px;
    }
    .order-arrow {
      font-size: 16px;
      color: #bbb;
    }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include "header.php"; ?>
  <?php include "menu.php"; ?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1><i class="fa fa-truck text-primary"></i> Data Order</h1>
    </section>

    <section class="content">
      <?php
      $sql = "SELECT tb_transaksi.*, tb_pelanggan.nama_pelanggan 
              FROM tb_transaksi 
              INNER JOIN tb_pelanggan ON tb_transaksi.pengirim = tb_pelanggan.id_pelanggan
              WHERE status='Belum Terkirim' 
                 OR (status='Proses Pengiriman' AND kurir='".$_SESSION['id']."')
              ORDER BY no_transaksi ASC";                        
      $query = mysqli_query($db, $sql);
      $total = mysqli_num_rows($query);

      if ($total == 0) {
          echo "<div class='text-center'><h4 class='text-muted'>Belum Ada Data Pengiriman</h4></div>";
      } else {
        echo '<div class="order-list">';
        while($data = mysqli_fetch_array($query)){ 
      ?>
        <a href="detail-order.php?no_transaksi=<?= $data['no_transaksi']; ?>" class="order-item">
          <div class="order-icon">
            <i class="fa fa-dropbox"></i>
          </div>
          <div class="order-text">
            <p class="id">ID Pemesanan: <?= $data['no_transaksi']; ?></p>
            <p>
              <strong>Barang:</strong> <?= $data['nama_barang']; ?> | 
              <strong>Pengirim:</strong> <?= $data['nama_pelanggan']; ?>
            </p>
            <p class="order-status">
              Status: 
              <?php 
                if($data['status']=="Belum Terkirim"){ 
                  echo '<span class="label label-warning">'.$data['status'].'</span>'; 
                } elseif($data['status']=="Proses Pengiriman"){ 
                  echo '<span class="label label-info">'.$data['status'].'</span>'; 
                } else { 
                  echo '<span class="label label-success">'.$data['status'].'</span>'; 
                }
              ?>
            </p>
          </div>
          <div class="order-arrow">
            <i class="fa fa-chevron-right"></i>
          </div>
        </a>
      <?php 
        } // while
        echo '</div>';
      } // else
      ?>
    </section>
  </div>
  <?php include "footer.php"; ?>
</div>

<script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/dist/js/app.min.js"></script>
</body>
</html>

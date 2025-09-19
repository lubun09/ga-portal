<?php 
  session_start(); 
  include "login/ceksession.php";
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GA-Messenger</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../assets/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
    <!-- Custom style for card -->
    <style>
      .order-link {
        text-decoration: none;
        color: inherit;
      }
      .order-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        padding: 15px 20px;
        margin-bottom: 15px;
        position: relative;
        transition: background 0.2s ease;
      }
      .order-card:hover {
        background: #f9f9f9;
      }
      .order-card h4 {
        margin: 0;
        font-size: 16px;
        color: #333;
      }
      .order-card p {
        margin: 5px 0;
        color: #555;
      }
      .order-card .status {
        margin-top: 5px;
      }
      .order-card .ubah-btn {
        position: absolute;
        bottom: 10px;
        right: 45px;
      }
      .order-card .arrow {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
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
          <h1>Data Order</h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Pengiriman</li>
          </ol>
        </section>

        <section class="content">
          <div class="row">
            <section class="col-lg-12 connectedSortable">

              <div class="box box-default">
                <div class="box-body">
                  <?php
                    include '../koneksi/koneksi.php';
                    $sql = "SELECT * FROM tb_transaksi WHERE pengirim='".$_SESSION['id']."' AND status NOT LIKE 'Terkirim' ORDER BY no_transaksi ASC";                        
                    $query = mysqli_query($db, $sql);
                    $total = mysqli_num_rows($query);
                    if ($total == 0) {
                      echo "<div class='text-center'><h4 class='text-muted'>Belum Ada Data Pengiriman Anda</h4></div>";
                    } else {
                      while($data = mysqli_fetch_array($query)){ 
                  ?>
                    <a href="detail-order.php?no_transaksi=<?= $data['no_transaksi']; ?>" class="order-link">
                      <div class="order-card">
                        <h4><i class="fa fa-dropbox text-blue"></i> ID Pemesanan: <?= $data['no_transaksi']; ?></h4>
                        <p><b>Barang:</b> <?= $data['nama_barang']; ?> | <b>Pengirim:</b> <?= $data['pengirim']; ?></p>
                        <div class="status">
                          <b>Status:</b>
                          <?php if($data['status']=="Belum Terkirim"){ ?>
                            <span class="label label-warning"><?= $data['status']; ?></span>
                          <?php } else { ?>
                            <span class="label label-success"><?= $data['status']; ?></span>
                          <?php } ?>
                        </div>
                        <?php if ($data['status']=='Belum Terkirim'){ ?>
                          <a class="btn btn-xs btn-warning ubah-btn" href="editorder.php?no_transaksi=<?= $data['no_transaksi']; ?>" onclick="event.stopPropagation();">
                            <i class="fa fa-edit"></i> Ubah
                          </a>
                        <?php } ?>
                        <div class="arrow">
                          <i class="fa fa-angle-right fa-lg"></i>
                        </div>
                      </div>
                    </a>
                  <?php 
                      } 
                    }
                  ?>
                </div>
              </div>

            </section>
          </div>
        </section>
      </div>

      <?php include "footer.php"; ?>
      <div class="control-sidebar-bg"></div>
    </div>

    <!-- JS -->
    <script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="../assets/plugins/fastclick/fastclick.min.js"></script>
    <script src="../assets/dist/js/app.min.js"></script>
    <script src="../assets/dist/js/demo.js"></script>
  </body>
</html>

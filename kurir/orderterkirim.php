<?php 
  session_start(); 
  include "login/ceksession.php";
  include '../koneksi/koneksi.php';

  // Ambil halaman sekarang dari URL (default 1)
  $halaman = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  $limit   = 10; // maksimal 10 data
  $offset  = ($halaman - 1) * $limit;

  // Hitung total data
  $sqlCount = "SELECT COUNT(*) as total FROM tb_transaksi 
               WHERE kurir='".$_SESSION['id']."' AND status='Terkirim'";
  $countRes = mysqli_query($db, $sqlCount);
  $totalRow = mysqli_fetch_assoc($countRes);
  $total    = $totalRow['total'];
  $totalHal = ceil($total / $limit);

  // Query data dengan limit
  $sql1 = "SELECT * FROM tb_transaksi 
           INNER JOIN tb_pelanggan ON tb_transaksi.pengirim = tb_pelanggan.id_pelanggan 
           WHERE kurir='".$_SESSION['id']."' 
             AND status='Terkirim' 
           ORDER BY no_transaksi DESC
           LIMIT $limit OFFSET $offset";                        
  $query1 = mysqli_query($db, $sql1);
?>
<html>
<head>
  <meta charset="utf-8">
  <title>GA-Messenger</title>
  <meta content="width=device-width, initial-scale=1" name="viewport">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">

  <style>
    body { background: #f4f6f9; }
    .search-box { position: relative; margin-bottom: 15px; }
    .search-box input {
      width: 100%; padding: 10px 35px 10px 12px;
      border-radius: 25px; border: 1px solid #ddd; outline: none;
    }
    .search-box i {
      position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
      color: #aaa;
    }
    .order-list { background: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,.1); }
    .order-item { display: flex; align-items: center; justify-content: space-between; padding: 14px 16px; border-bottom: 1px solid #eee; transition: background .2s; text-decoration: none; color: inherit; }
    .order-item:last-child { border-bottom: none; }
    .order-item:hover { background: #f9f9f9; }
    .order-icon { font-size: 22px; margin-right: 12px; color: #27ae60; width: 30px; text-align: center; }
    .order-text { flex: 1; }
    .order-text p { margin: 0; font-size: 14px; }
    .order-text .id { font-weight: 600; font-size: 15px; margin-bottom: 4px; }
    .order-status .label { font-size: 12px; padding: 3px 8px; border-radius: 12px; }
    .order-arrow { font-size: 16px; color: #bbb; }
    .rating { color: #f1c40f; font-size: 13px; }
    .pagination { margin-top: 20px; text-align: center; }
    .pagination a {
      display: inline-block; padding: 6px 12px; margin: 0 2px;
      border: 1px solid #ddd; border-radius: 4px; color: #337ab7;
      text-decoration: none;
    }
    .pagination a.active { background: #337ab7; color: #fff; border-color: #337ab7; }
    .pagination a:hover { background: #eee; }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include "header.php"; ?>
  <?php include "menu.php"; ?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1><i class="fa fa-check-square text-green"></i> Data Order Terkirim</h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Order</li>
      </ol>
    </section>

    <section class="content">
      <div class="search-box">
        <input type="text" id="searchOrder" placeholder="Cari dokumen atau ID pemesanan...">
        <i class="fa fa-search"></i>
      </div>

      <?php 
        if ($total == 0) {
            echo "<div class='text-center'><h4 class='text-muted'>Belum Ada Order Terkirim</h4></div>";
        } else {
          echo '<div class="order-list" id="orderList">';
          while($data = mysqli_fetch_array($query1)){ 
      ?>
        <a href="detail-orderterkirim.php?no_transaksi=<?= $data['no_transaksi']; ?>" class="order-item">
          <div class="order-icon">
            <i class="fa fa-dropbox"></i>
          </div>
          <div class="order-text">
            <p class="id">ID Pemesanan: <?= $data['no_transaksi']; ?></p>
            <p><strong>Barang:</strong> <?= $data['nama_barang']; ?></p>
            <p class="order-status">
              Status: <span class="label label-success">Terkirim</span>
              <?php 
                if($data['penilaian'] == 0){
                  echo '<span class="label label-default">Belum Ada Penilaian</span>';
                } else {
                  echo '<span class="rating"><i class="fa fa-star"></i> '.$data['penilaian'].'</span>';
                }
              ?>
            </p>
          </div>
          <div class="order-arrow">
            <i class="fa fa-chevron-right"></i>
          </div>
        </a>
      <?php 
          }
          echo '</div>';

          // pagination
          if ($totalHal > 1) {
            echo '<div class="pagination">';
            for ($i=1; $i <= $totalHal; $i++) {
              $active = ($i == $halaman) ? 'active' : '';
              echo "<a class='$active' href='?page=$i'>$i</a>";
            }
            echo '</div>';
          }
        }
      ?>
    </section>
  </div>

  <?php include "footer.php"; ?>
  <div class="control-sidebar-bg"></div>
</div>

<!-- Script -->
<script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/dist/js/app.min.js"></script>

<script>
  // Live search
  document.getElementById("searchOrder").addEventListener("keyup", function() {
    var input = this.value.toLowerCase();
    var items = document.querySelectorAll("#orderList .order-item");
    items.forEach(function(item) {
      var text = item.innerText.toLowerCase();
      if (text.indexOf(input) > -1) {
        item.style.display = "";
      } else {
        item.style.display = "none";
      }
    });
  });
</script>
</body>
</html>

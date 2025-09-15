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
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/css/ionicons.min.css">
  <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../assets/plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="../assets/plugins/morris/morris.css">
  <link rel="stylesheet" href="../assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <link rel="stylesheet" href="../assets/plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="../assets/plugins/daterangepicker/daterangepicker-bs3.css">
  <link rel="stylesheet" href="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="../assets/plugins/datatables/dataTables.bootstrap.css"/>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include "header.php"; ?>
  <?php include "menu.php"; ?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>Data Kurir</h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Kurir</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <section class="col-lg-12 connectedSortable">
          <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>
              <h3 class="box-title">Data Kurir</h3>
              <div class="box-tools pull-right">
                <a href="input-kurir.php" class="btn btn-primary btn-sm">
                  <i class="fa fa-plus"></i> Tambah Messenger
                </a>
              </div>
            </div>
            <div class="box-body">
              <div class="table-responsive">
                <?php
                include '../koneksi/koneksi.php';
                $sql1 = "SELECT * FROM tb_kurir order by nama_kurir asc";                        
                $query1 = mysqli_query($db, $sql1);
                $total = mysqli_num_rows($query1);
                if ($total == 0) {
                  echo "<center><h2>Belum Ada Kurir Terdaftar</h2></center>";
                } else { ?>    
                <table id="lookup" class="table table-bordered table-hover">  
                  <thead bgcolor="eeeeee" align="center">
                    <tr>
                      <th>id</th>
                      <th>Nama</th>
                      <th>Username</th>
                      <th>Tanggal Lahir</th>
                      <th>Alamat</th>
                      <th>No Hp</th>
                      <th>Rata-Rata Penilaian</th>
                      <th>Pengiriman</th>
                      <th class="text-center"> Action </th>     
                    </tr>
                  </thead>
                  <?php
                  while($data = mysqli_fetch_array($query1)){
                    $sql5 = "SELECT * FROM tb_transaksi where kurir = '".$data['id_kurir']."' and penilaian <> 0";                        
                    $query5 = mysqli_query($db, $sql5);
                    $bariss = mysqli_num_rows($query5);
                    $total_nilai = 0;
                    if ($bariss <> 0){
                      while($data5 = mysqli_fetch_array($query5)){
                        $total_nilai += $data5['penilaian'];
                      }
                      $nilai = $total_nilai / $bariss;
                    } else {
                      $nilai='Belum Ada Penilaian';
                    }
                    echo '<tr>
                    <td>' . $data['id_kurir'] . '</td>
                    <td>' . $data['nama_kurir'] . '</td>
                    <td>' . $data['username_kurir'] . '</td>
                    <td>' . $data['tanggal_lahir_kurir'] . '</td>
                    <td>' . $data['alamat'] . '</td>
                    <td>' . $data['no_hp_kurir'] . '</td>
                    <td>' . $nilai . '</td>
                    <td style="text-align:center;">
                      <a href="orderankurir.php?id_kurir=' . $data['id_kurir'] . '">Lihat Data</a>
                    </td>
                    <td style="text-align:center;">
                      <a href="detail-kurir.php?id_kurir=' . $data['id_kurir'] . '">Detail &nbsp|</a>
                      <a href="editkurir.php?id_kurir=' . $data['id_kurir'] . '">|&nbsp Ubah</a>
                    </td>
                    </tr>';
                  }
                  ?>
                  <tbody></tbody>
                </table>
                <?php } ?>
              </div>
            </div>
          </div>
        </section>
      </div>
    </section>
  </div>
  
  <?php include "footer.php"; ?>
  <div class="control-sidebar-bg"></div>
</div>

<script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../assets/plugins/fastclick/fastclick.min.js"></script>
<script src="../assets/dist/js/app.min.js"></script>
<script src="../assets/dist/js/demo.js"></script>
<script type="text/javascript"> 
  $(function () {
    $("#lookup").dataTable({"lengthMenu":[25,50,75,100],"pageLength":25});
  });
</script>
</body>
</html>

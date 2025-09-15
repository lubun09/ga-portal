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
          <h1>Data Transaksi</h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Transaksi</li>
          </ol>
        </section>

        <section class="content">
          <div class="row">
            <section class="col-lg-12 connectedSortable">
              <div class="box box-primary">
                <div class="box-header">
                  <i class="ion ion-clipboard"></i>
                  <h3 class="box-title">Data Transaksi Terkirim</h3>
                  <div class="box-tools pull-right"></div> 
                </div>
                <div class="box-body">
                  <div class="table-responsive">

                    <!-- 🔹 Form Download Report -->
                    <form method="GET" action="report.php" target="_blank" class="form-inline" style="margin-bottom:15px;">
                      <label>Pilih Bulan: </label>
                      <select name="bulan" class="form-control" required>
                        <option value="">--Bulan--</option>
                        <?php
                        for($m=1;$m<=12;$m++){
                          $bln = str_pad($m,2,"0",STR_PAD_LEFT);
                          echo "<option value='$bln'>".date("F", mktime(0,0,0,$m,10))."</option>";
                        }
                        ?>
                      </select>

                      <label style="margin-left:10px;">Tahun: </label>
                      <select name="tahun" class="form-control" required>
                        <?php
                        $now = date("Y");
                        for($y=$now;$y>=2020;$y--){
                          echo "<option value='$y'>$y</option>";
                        }
                        ?>
                      </select>

                      <button type="submit" class="btn btn-success" style="margin-left:10px;">
                        <i class="fa fa-download"></i> Download Excel
                      </button>
                    </form>
                    <!-- 🔹 End Form -->

                    <?php
                    include '../koneksi/koneksi.php';
                    $sql1 = "SELECT * FROM tb_pelanggan 
                             INNER JOIN (tb_transaksi INNER JOIN tb_kurir 
                             ON tb_transaksi.kurir = tb_kurir.id_kurir) 
                             ON tb_pelanggan.id_pelanggan = tb_transaksi.pengirim 
                             WHERE status = 'Terkirim' ORDER BY no_transaksi DESC";                        
                    $query1 = mysqli_query($db, $sql1);
                    $total = mysqli_num_rows($query1);
                    if ($total == 0) {
                      echo "<center><h2>Tidak Ada Transaksi Terkirim</h2></center>";
                    } else {
                    ?>  
                    <table id="lookup" class="table table-bordered table-hover">  
                      <thead bgcolor="eeeeee" align="left">
                        <tr>
                          <th>No Transaksi</th>
                          <th>Jenis Barang</th>
                          <th>Alamat Asal</th>
                          <th>Alamat Tujuan</th>
                          <th>Pengirim</th>
                          <th>Penerima</th>
                          <th>Kurir</th>
                          <th>Penilaian</th>
                          <th class="text-center">Action</th>      
                        </tr>
                      </thead>
                      <tbody>  
                        <?php
                        while($data = mysqli_fetch_array($query1)){
                          echo '<tr>
                            <td>'.$data['no_transaksi'].'</td>
                            <td>'.$data['nama_barang'].'</td>
                            <td>'.$data['alamat_asal'].'</td>
                            <td>'.$data['alamat_tujuan'].'</td>
                            <td>'.$data['nama_pelanggan'].'</td>
                            <td>'.$data['penerima'].'</td>
                            <td>'.$data['nama_kurir'].'</td>
                            <td>';
                          echo ($data['penilaian'] == 0) ? 'Belum Ada Penilaian' : $data['penilaian'];
                          echo '</td>
                            <td style="text-align:center;">
                              <a href="detail-transaksiterkirim.php?no_transaksi='.$data['no_transaksi'].'">Detail</a>
                            </td>
                          </tr>';
                        }
                        ?>
                      </tbody>
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
        $("#lookup").dataTable({
          "lengthMenu":[25,50,75,100],
          "pageLength":25
        });
      });
    </script>

    <style>
      .table th, .table td {
        text-align: left;
      }
    </style>
  </body>
</html>

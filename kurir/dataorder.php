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
  <link rel="stylesheet" href="../assets/plugins/datatables/dataTables.bootstrap.css"/>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include "header.php"; ?>
  <?php include "menu.php"; ?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>Data Order</h1>
    </section>

    <section class="content">
      <div class="box box-primary">
        <div class="box-header"><h3 class="box-title">Data Order</h3></div>
        <div class="box-body">
          <div class="table-responsive">
            <?php
            // Ambil semua order Belum Terkirim atau sedang diambil kurir ini (Proses Pengiriman)
            $sql = "SELECT tb_transaksi.*, tb_pelanggan.nama_pelanggan 
                    FROM tb_transaksi 
                    INNER JOIN tb_pelanggan ON tb_transaksi.pengirim = tb_pelanggan.id_pelanggan
                    WHERE status='Belum Terkirim' 
                       OR (status='Proses Pengiriman' AND kurir='".$_SESSION['id']."')
                    ORDER BY no_transaksi ASC";                        
            $query = mysqli_query($db, $sql);
            $total = mysqli_num_rows($query);

            if ($total == 0) {
                echo "<center><h2>Belum Ada Data Pengiriman</h2></center>";
            } else {
            ?>
            <table id="lookup" class="table table-bordered table-hover">
              <thead bgcolor="eeeeee" align="center">
                <tr>
                  <th>ID Pemesanan</th>
                  <th>Jenis Barang</th>
                  <th>Alamat Asal</th>
                  <th>Alamat Tujuan</th>
                  <th>Pengirim</th>
                  <th>Penerima</th>
                  <th>No Hp Penerima</th>
                  <th>Status</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while($data = mysqli_fetch_array($query)){
                  echo '<tr>
                    <td>'.$data['no_transaksi'].'</td>
                    <td>'.$data['nama_barang'].'</td>
                    <td>'.$data['alamat_asal'].'</td>
                    <td>'.$data['alamat_tujuan'].'</td>
                    <td>'.$data['nama_pelanggan'].'</td>
                    <td>'.$data['penerima'].'</td>
                    <td>'.$data['no_hp_penerima'].'</td>
                    <td>'.$data['status'].'</td>
                    <td style="text-align:center;">';

                  // Tombol Detail
                  echo '<a href="detail-order.php?no_transaksi='.$data['no_transaksi'].'">Detail</a> | ';
                  
                  // Tombol Ambil/Antar
                  if($data['status']=='Belum Terkirim' || ($data['status']=='Proses Pengiriman' && $data['kurir']==$_SESSION['id'])){
                      echo '<a onclick="return confirm(\'Lanjutkan proses pengiriman? Pengiriman tidak bisa dibatalkan!\');" href="ambilorder.php?no_transaksi='.$data['no_transaksi'].'">Ambil/Antar</a>';
                  }

                  echo '</td></tr>';
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
  <?php include "footer.php"; ?>
</div>

<script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="../assets/dist/js/app.min.js"></script>
</body>
</html>

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

  <!-- Style untuk View link -->
  <style>
    .view-link {
      color: #007bff;
      text-decoration: underline;
      cursor: pointer;
    }
    .view-link:hover {
      color: #0056b3;
    }
  </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include "header.php"; ?>
  <?php include "menu.php"; ?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>Detail Transaksi</h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Detail Transaksi</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <section class="col-lg-12 connectedSortable">
          <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>
              <h3 class="box-title">Detail Transaksi Belum Terkirim</h3>
            </div>

            <div class="box-body">
              <div class="form-panel">
                <table id="example" class="table table-hover table-bordered">
                  <?php
                  include '../koneksi/koneksi.php';
                  $no_transaksi = $_GET['no_transaksi'];
                  $sql = "SELECT * FROM tb_pelanggan 
                          INNER JOIN (tb_transaksi 
                          INNER JOIN tb_kurir ON tb_transaksi.kurir = tb_kurir.id_kurir) 
                          ON tb_pelanggan.id_pelanggan = tb_transaksi.pengirim 
                          WHERE no_transaksi='$no_transaksi'";
                  $query = mysqli_query($db, $sql);
                  $data = mysqli_fetch_array($query);

                  if ($data) { // Jika ada data dengan kurir
                      ?>
                      <tr><td>ID Pemesanan</td><td><?= $data['no_transaksi'] ?></td></tr>
                      <tr><td>Jenis Barang</td><td><?= $data['nama_barang'] ?></td></tr>
                      <tr><td>Deskripsi</td><td><?= $data1['deskripsi'] ?></td></tr>
                      <tr><td>Alamat Asal</td><td><?= $data['alamat_asal'] ?></td></tr>
                      <tr><td>Alamat Tujuan</td><td><?= $data['alamat_tujuan'] ?></td></tr>
                      <tr><td>Pengirim</td><td><?= $data['nama_pelanggan'] ?></td></tr>
                      <tr><td>Penerima</td><td><?= $data['penerima'] ?></td></tr>
                      <tr><td>No Hp Penerima</td><td><?= $data['no_hp_penerima'] ?></td></tr>

                      <?php
                      if ($data['status'] == 'Penjemputan Barang') {
                          ?>
                          <tr><td>Kurir</td><td><?= $data['nama_kurir'] ?></td></tr>
                          <tr><td>No Hp Kurir</td><td><?= $data['no_hp_kurir'] ?></td></tr>
                          <?php
                      } elseif ($data['status'] == 'Proses Pengiriman' || $data['status'] == 'Terkirim') {
                          if (!empty($data['foto_barang'])) {
                              ?>
                              <tr>
                                <td>Foto Barang</td>
                                <td><span class="view-link" data-img="../pelanggan/images/Kirim/<?= $data['foto_barang'] ?>">View</span></td>
                              </tr>
                              <?php
                          }
                          if (!empty($data['gambar_awal'])) {
                              ?>
                              <tr>
                                <td>Barang Diambil</td>
                                <td><span class="view-link" data-img="../kurir/images/diambil/<?= $data['gambar_awal'] ?>">View</span></td>
                              </tr>
                              <?php
                          }
                          if (!empty($data['gambar_akhir'])) {
                              ?>
                              <tr>
                                <td>Barang Diterima</td>
                                <td><span class="view-link" data-img="../kurir/images/selesai/<?= $data['gambar_akhir'] ?>">View</span></td>
                              </tr>
                              <?php
                          }

                          ?>
                          <tr><td>Kurir</td><td><?= $data['nama_kurir'] ?></td></tr>
                          <tr><td>No Hp Kurir</td><td><?= $data['no_hp_kurir'] ?></td></tr>
                          <?php
                      }
                      ?>
                      <tr><td>Status</td><td><?= $data['status'] ?></td></tr>
                      <tr><td>Waktu</td><td><?= $data['waktu'] ?></td></tr>
                      <?php
                  } else { // Jika tidak ada kurir
                      $sql1 = "SELECT * FROM tb_transaksi 
                               INNER JOIN tb_pelanggan ON tb_transaksi.pengirim = tb_pelanggan.id_pelanggan 
                               WHERE no_transaksi='$no_transaksi'";
                      $query1 = mysqli_query($db, $sql1);
                      $data1 = mysqli_fetch_array($query1);

                      ?>
                      <tr><td>ID Pemesanan</td><td><?= $data1['no_transaksi'] ?></td></tr>
                      <tr><td>Jenis Barang</td><td><?= $data1['nama_barang'] ?></td></tr>
                      <tr><td>Deskripsi</td><td><?= $data1['deskripsi'] ?></td></tr>
                      <tr><td>Alamat Asal</td><td><?= $data1['alamat_asal'] ?></td></tr>
                      <tr><td>Alamat Tujuan</td><td><?= $data1['alamat_tujuan'] ?></td></tr>
                      <tr><td>Pengirim</td><td><?= $data1['nama_pelanggan'] ?></td></tr>
                      <tr><td>Penerima</td><td><?= $data1['penerima'] ?></td></tr>
                      <tr><td>No Hp Penerima</td><td><?= $data1['no_hp_penerima'] ?></td></tr>

                      <?php if (!empty($data1['foto_barang'])) { ?>
                          <tr>
                            <td>Foto Barang</td>
                            <td><span class="view-link" data-img="../pelanggan/images/Kirim/<?= $data1['foto_barang'] ?>">View</span></td>
                          </tr>
                      <?php } ?>

                      <?php if (!empty($data1['gambar_awal'])) { ?>
                          <tr>
                            <td>Barang Dikirim</td>
                            <td><span class="view-link" data-img="../kurir/images/diambil/<?= $data1['gambar_awal'] ?>">View</span></td>
                          </tr>
                      <?php } ?>

                      <?php if (!empty($data1['gambar_akhir'])) { ?>
                          <tr>
                            <td>Barang Diterima</td>
                            <td><span class="view-link" data-img="../kurir/images/selesai/<?= $data1['gambar_akhir'] ?>">View</span></td>
                          </tr>
                      <?php } ?>

                      <tr><td>Status</td><td><?= $data1['status'] ?></td></tr>
                      <tr><td>Waktu</td><td><?= $data1['waktu'] ?></td></tr>
                      <?php
                  }
                  ?>
                </table>

                <div class="text-right">
                  <a href="datatransaksibelumterkirim.php" class="btn btn-sm btn-warning">Kembali <i class="fa fa-arrow-circle-right"></i></a>
                </div>

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

<!-- jQuery -->
<script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>

<!-- Modal Preview Gambar -->
<div class="modal fade" id="modalViewImage" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center">
        <img id="imgPreview" src="" style="max-width:100%;border-radius:5px;">
      </div>
    </div>
  </div>
</div>

<script>
  $(document).on('click', '.view-link', function(){
      var imgSrc = $(this).data('img');
      $('#imgPreview').attr('src', imgSrc);
      $('#modalViewImage').modal('show');
  });
</script>

</body>
</html>

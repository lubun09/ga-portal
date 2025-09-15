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
            <h3 class="box-title">Detail Data Transaksi</h3>
          </div>
          <div class="box-body">
            <div class="form-panel">
              <table id="example" class="table table-hover table-bordered">
              <?php 
              include '../koneksi/koneksi.php';
              $id = $_GET['no_transaksi'];
              $sql = "SELECT * FROM tb_kurir 
                      INNER JOIN (tb_transaksi INNER JOIN tb_pelanggan 
                      ON tb_transaksi.pengirim = tb_pelanggan.id_pelanggan) 
                      ON tb_kurir.id_kurir = tb_transaksi.kurir 
                      WHERE no_transaksi='".$id."'";
              $query = mysqli_query($db, $sql);
              $data = mysqli_fetch_array($query);
              ?>
              
              <tr><td>No Transaksi</td><td><?php echo $data['no_transaksi'];?></td></tr>
              <tr><td>Jenis Barang</td><td><?php echo $data['nama_barang'];?></td></tr>
              <tr><td>Deskripsi</td><td><?php echo $data['deskripsi'];?></td></tr>
              <tr><td>Pengirim</td><td><?php echo $data['nama_pelanggan'];?></td></tr>
              <tr><td>Penerima</td><td><?php echo $data['penerima'];?></td></tr>
              <tr><td>No Hp Penerima</td><td><?php echo $data['no_hp_penerima'];?></td></tr>
              <tr><td>Alamat Asal</td><td><?php echo $data['alamat_asal'];?></td></tr>
              <tr><td>Alamat Tujuan</td><td><?php echo $data['alamat_tujuan'];?></td></tr>

              <!-- Foto Barang Pelanggan -->
              <tr>
                <td>Foto Barang</td>
                <td>
                <?php if(!empty($data['foto_barang'])) { ?>
                  <span class="view-link text-primary" style="cursor:pointer" 
                        data-img="../pelanggan/images/Kirim/<?php echo $data['foto_barang']; ?>">View</span>
                <?php } else { echo "<span class='text-muted'>Tidak ada foto</span>"; } ?>
                </td>
              </tr>

              <!-- Barang Diambil Kurir -->
              <tr>
                <td>Barang Dikirim</td>
                <td>
                <?php if(!empty($data['gambar_awal'])) { ?>
                  <span class="view-link text-primary" style="cursor:pointer" 
                        data-img="../kurir/images/diambil/<?php echo $data['gambar_awal']; ?>">View</span>
                <?php } else { echo "<span class='text-muted'>Tidak ada foto</span>"; } ?>
                </td>
              </tr>

              <!-- Barang Diterima Kurir -->
              <tr>
                <td>Barang Diterima</td>
                <td>
                <?php if(!empty($data['gambar_akhir'])) { ?>
                  <span class="view-link text-primary" style="cursor:pointer" 
                        data-img="../kurir/images/selesai/<?php echo $data['gambar_akhir']; ?>">View</span>
                <?php } else { echo "<span class='text-muted'>Tidak ada foto</span>"; } ?>
                </td>
              </tr>

              <tr><td>Kurir</td><td><?php echo $data['nama_kurir'];?></td></tr>
              <tr><td>No Hp Kurir</td><td><?php echo $data['no_hp_kurir'];?></td></tr>
              <tr><td>Status</td><td><?php echo $data['status'];?></td></tr>
              <tr><td>Waktu</td><td><?php echo $data['waktu'];?></td></tr>
              <?php if ($data['status'] == 'Terkirim'){ ?>
              <tr><td>Penilaian</td><td><?php echo ($data['penilaian']==0)?"Belum Ada Penilaian":$data['penilaian']; ?></td></tr>
              <tr><td>Komentar</td><td><?php echo ($data['komentar']=='')?"Belum Ada Komentar":$data['komentar']; ?></td></tr>
              <?php } ?>
              </table>

              <div class="text-right">
                <a href="datatransaksiterkirim.php" class="btn btn-sm btn-warning">Kembali <i class="fa fa-arrow-circle-right"></i></a>
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

<!-- Modal View Gambar -->
<div class="modal fade" id="modalViewImage" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center">
        <img id="imgPreview" src="" style="max-width:100%;border-radius:5px;">
      </div>
    </div>
  </div>
</div>

<script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script> $.widget.bridge('uibutton', $.ui.button); </script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/dist/js/app.min.js"></script>

<!-- Script View Image -->
<script>
document.addEventListener('click', function(e){
    if(e.target.classList.contains('view-link')){
        var imgSrc = e.target.getAttribute('data-img');
        document.getElementById('imgPreview').src = imgSrc;
        $('#modalViewImage').modal('show');
    }
});
</script>
</body>
</html>

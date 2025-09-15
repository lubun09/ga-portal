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
  <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/css/ionicons.min.css">
  <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
  <style>
    .view-link { color:#007bff; text-decoration:underline; cursor:pointer; }
    .view-link:hover { color:#0056b3; }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include "header.php"; ?>
  <?php include "menu.php"; ?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>Detail Order Terkirim</h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Detail Order Terkirim</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <section class="col-lg-12 connectedSortable">
          <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>
              <h3 class="box-title">Detail Order Terkirim</h3>
            </div>
            <div class="box-body">
              <div class="form-panel">
                <?php 
                  $no_transaksi = $_GET['no_transaksi'];
                  $sql = "SELECT t.*, p.nama_pelanggan, k.nama_kurir, k.no_hp_kurir 
                          FROM tb_transaksi t
                          LEFT JOIN tb_pelanggan p ON t.pengirim = p.id_pelanggan
                          LEFT JOIN tb_kurir k ON t.kurir = k.id_kurir
                          WHERE t.no_transaksi='$no_transaksi'";
                  $query = mysqli_query($db, $sql);
                  $data = mysqli_fetch_array($query);
                ?>
                <table class="table table-bordered table-hover">
                  <tr><td>ID Pemesanan</td><td><?php echo $data['no_transaksi']; ?></td></tr>
                  <tr><td>Jenis Barang</td><td><?php echo $data['nama_barang']; ?></td></tr>
                  <tr><td>Deskripsi</td><td><?php echo $data['deskripsi']; ?></td></tr>
                  <tr><td>Alamat Asal</td><td><?php echo $data['alamat_asal']; ?></td></tr>
                  <tr><td>Alamat Tujuan</td><td><?php echo $data['alamat_tujuan']; ?></td></tr>
                  <tr><td>Pengirim</td><td><?php echo $data['nama_pelanggan']; ?></td></tr>
                  <tr><td>Penerima</td><td><?php echo $data['penerima']; ?></td></tr>
                  <tr><td>No Hp Penerima</td><td><?php echo $data['no_hp_penerima']; ?></td></tr>

                  <!-- Foto Barang -->
                  <tr>
                    <td>Foto Barang</td>
                    <td>
                      <?php if(!empty($data['foto_barang'])) { ?>
                        <span class="view-link" data-img="../pelanggan/images/Kirim/<?php echo $data['foto_barang']; ?>">View</span>
                      <?php } else { echo "<span class='text-muted'>Tidak ada foto</span>"; } ?>
                    </td>
                  </tr>

                  <!-- Barang Diambil -->
                  <tr>
                    <td>Barang Diambil</td>
                    <td>
                      <?php if(!empty($data['gambar_awal'])) { ?>
                        <span class="view-link" data-img="../kurir/images/diambil/<?php echo $data['gambar_awal']; ?>">View</span>
                      <?php } else { echo "<span class='text-muted'>Tidak ada foto</span>"; } ?>
                    </td>
                  </tr>

                  <!-- Barang Diterima -->
                  <tr>
                    <td>Barang Diterima</td>
                    <td>
                      <?php if(!empty($data['gambar_akhir'])) { ?>
                        <span class="view-link" data-img="../kurir/images/selesai/<?php echo $data['gambar_akhir']; ?>">View</span>
                      <?php } else { echo "<span class='text-muted'>Tidak ada foto</span>"; } ?>
                    </td>
                  </tr>

                  <tr><td>Status</td><td><?php echo $data['status']; ?></td></tr>
                  <tr><td>Waktu</td><td><?php echo $data['waktu']; ?></td></tr>
                  <tr><td>Penilaian</td><td><?php echo ($data['penilaian']==0)?"Belum Ada Penilaian":$data['penilaian']; ?></td></tr>
                  <tr><td>Komentar</td><td><?php echo ($data['komentar']=='')?"Belum Ada Komentar":$data['komentar']; ?></td></tr>
                </table>

                <div class="text-right">
                  <a href="orderterkirim.php" class="btn btn-sm btn-warning">Kembali <i class="fa fa-arrow-circle-right"></i></a>
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

<!-- Modal View Image -->
<div class="modal fade" id="modalViewImage" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center">
        <img id="imgPreview" src="" style="max-width:100%; border-radius:5px;">
      </div>
    </div>
  </div>
</div>

<script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script>
  $(document).on('click', '.view-link', function() {
    var imgSrc = $(this).data('img');
    $('#imgPreview').attr('src', imgSrc);
    $('#modalViewImage').modal('show');
  });
</script>
</body>
</html>

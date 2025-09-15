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
</head>
    
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include "header.php"; ?>
  <?php include "menu.php"; ?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>Detail Order</h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Detail Order</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <section class="col-lg-12 connectedSortable">
          <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>
              <h3 class="box-title">Detail Order</h3>
            </div>
            <div class="box-body">
              <div class="form-panel">
                <table id="example" class="table table-hover table-bordered">
                  <?php 
                  include '../koneksi/koneksi.php';
                  $no_transaksi= $_GET['no_transaksi'];
                  $sql = "SELECT * FROM tb_pelanggan 
                          INNER JOIN (tb_transaksi 
                          INNER JOIN tb_kurir ON tb_transaksi.kurir = tb_kurir.id_kurir) 
                          ON tb_pelanggan.id_pelanggan = tb_transaksi.pengirim 
                          WHERE no_transaksi='".$no_transaksi."'";                        
                  $query = mysqli_query($db, $sql);
                  $data  = mysqli_fetch_array($query);
                  ?>
                  <tr>
                    <td>ID Pemesanan</td>
                    <td><?php echo $data['no_transaksi'];?></td>
                  </tr>
                  <tr>
                    <td>Jenis Barang</td>
                    <td><?php echo $data['nama_barang'];?></td>
                  </tr>
                  <tr>
                    <td width="250">Alamat Asal</td>
                    <td width="700"><?php echo $data['alamat_asal'];?></td>
                  </tr>
                  <tr>
                    <td>Alamat Tujuan</td>
                    <td><?php echo $data['alamat_tujuan'];?></td>
                  </tr>
                  <tr>
                    <td>Pengirim</td>
                    <td><?php echo $data['nama_pelanggan'];?></td>
                  </tr>
                  <tr>
                    <td>Penerima</td>
                    <td><?php echo $data['penerima'];?></td>
                  </tr>
                  <tr>
                    <td>No Hp Penerima</td>
                    <td><?php echo $data['no_hp_penerima'];?></td>
                  </tr> 

                  <?php 
                  if ($data['status']== 'Penjemputan Barang'){
                    echo '							
                      <tr>
                        <td>Kurir</td>
                        <td>'.$data['nama_kurir'].'</td>
                      </tr>
                      <tr>
                        <td>No Hp Kurir</td>
                        <td>'.$data['no_hp_kurir'].'</td>
                      </tr>';
                  }
                  else if ($data['status']== 'Proses Pengiriman' or $data['status']== 'Terkirim' ){
                  ?>
                      <tr>
                        <td><strong>Foto Barang</strong></td>
                        <td>
                          <?php if(!empty($data['foto_barang'])) { ?>
                            <a href="#" class="view-link text-primary" data-toggle="modal" data-target="#fotoModal" data-img="<?php echo $data['foto_barang']; ?>">View</a>
                          <?php } else { echo "<span class='text-muted'>Tidak ada foto</span>"; } ?>
                        </td>
                      </tr>

                      <tr>
                        <td><strong>Barang Diambil</strong></td>
                        <td>
                          <?php if(!empty($data['gambar_awal'])) { ?>
                            <a href="#" class="view-link text-primary" data-toggle="modal" data-target="#fotoModal" data-img="<?php echo $data['gambar_awal']; ?>">View</a>
                          <?php } else { echo "<span class='text-muted'>Tidak ada foto</span>"; } ?>
                        </td>
                      </tr>

                      <tr>
                        <td><strong>Barang Diterima</strong></td>
                        <td>
                          <?php if(!empty($data['gambar_akhir'])) { ?>
                            <a href="#" class="view-link text-primary" data-toggle="modal" data-target="#fotoModal" data-img="<?php echo $data['gambar_akhir']; ?>">View</a>
                          <?php } else { echo "<span class='text-muted'>Tidak ada foto</span>"; } ?>
                        </td>
                      </tr>

                      <tr>
                        <td>Kurir</td>
                        <td><?php echo $data['nama_kurir'];?></td>
                      </tr>
                      <tr>
                        <td>No Hp Kurir</td>
                        <td><?php echo $data['no_hp_kurir'];?></td>
                      </tr>
                  <?php
                  }
                  ?> 

                  <tr>
                    <td>Status</td>
                    <td><?php echo $data['status'];?></td>
                  </tr>
                  <tr>
                    <td>Waktu</td>
                    <td><?php echo $data['waktu'];?></td>
                  </tr>

                  <?php
                  if ($data['status']== 'Terkirim'){
                    echo "
                    <tr>
                      <td>Penilaian</td>
                      <td>"; if($data['penilaian'] == 0){echo"Belum Ada Penilaian";} else{ echo $data['penilaian'];} echo "</td>
                    </tr>
                    <tr>
                      <td>Komentar</td>
                      <td>"; if($data['komentar'] == ''){echo"Belum Ada Komentar";} else{ echo $data['komentar'];} echo "</td>
                    </tr>
                    ";
                  }
                  ?>
                </table>

                <div class="text-right">
                  <a href="orderankurir.php?id_kurir=<?php echo $data['id_kurir'];?>" class="btn btn-sm btn-warning">Kembali <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </section>
      </div>
    </section>
  </div>

  <?php include "footer.php"; ?>

  <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->

<!-- Modal Foto -->
<div class="modal fade" id="fotoModal" tabindex="-1" role="dialog" aria-labelledby="fotoModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Preview Foto</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
      </div>
      <div class="modal-body text-center">
        <img src="" id="fotoPreview" class="img-responsive img-thumbnail" style="max-height:500px;">
      </div>
    </div>
  </div>
</div>

<!-- Script -->
<script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script>
$(document).on("click", ".view-link", function(){
  var imgSrc = $(this).data('img');
  $("#fotoPreview").attr("src", imgSrc);
});
</script>
</body>
</html>

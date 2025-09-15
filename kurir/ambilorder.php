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
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <?php include "header.php"; ?>
    <?php include "menu.php"; ?>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>Order Yang Berlangsung</h1>
        </section>

        <section class="content">
            <div class="box box-primary">
                <div class="box-header"><h3 class="box-title">Detail Order</h3></div>
                <div class="box-body">
                <?php
                if (!empty($_GET['no_transaksi'])) {
                    $no_transaksi = $_GET['no_transaksi'];

                    // Cek status Belum Terkirim → update jadi Penjemputan Barang
                    $cek = mysqli_query($db, "SELECT * FROM tb_transaksi WHERE no_transaksi='$no_transaksi' AND status='Belum Terkirim'");
                    if (mysqli_num_rows($cek) == 1) {
                        $dataCek = mysqli_fetch_assoc($cek);
                        date_default_timezone_set('Asia/Jakarta'); 		
                        $date  = date("d-m-Y H:i:s");
                        $waktu = $dataCek['waktu'].'<br>Penjemputan Barang &nbsp;&nbsp;('.$date.')';

                        mysqli_query($db, "UPDATE tb_transaksi SET 
                                            kurir='".$_SESSION['id']."',
                                            status='Penjemputan Barang',
                                            waktu='$waktu'
                                            WHERE no_transaksi='$no_transaksi'");
                        echo "<meta http-equiv='refresh' content='0;url=ambilorder.php?no_transaksi=".$no_transaksi."'>";
                        exit;
                    }

                    // Ambil data transaksi
                    $sql2 = "SELECT * FROM tb_transaksi 
                             INNER JOIN tb_pelanggan 
                             ON tb_transaksi.pengirim = tb_pelanggan.id_pelanggan 
                             WHERE no_transaksi='$no_transaksi'";
                    $query2 = mysqli_query($db, $sql2);
                    $data = mysqli_fetch_array($query2);

                    if ($data['status'] == 'Terkirim') {
                        echo "<meta http-equiv='refresh' content='0;url=orderterkirim.php'>";
                        exit;
                    }

                    if ($data['kurir'] <> $_SESSION['id'] && $data['kurir'] <> '') {
                        echo "<center><h2>Pengiriman ini telah diambil Kurir lain</h2></center>
                              <meta http-equiv='refresh' content='2;url=dataorder.php'>";
                        exit;
                    }
                    ?>
                    <form class="form-horizontal" action="proses/proses_editstatus.php" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">No Transaksi</label>
                            <div class="col-sm-4">
                                <input name="no_transaksi" value="<?php echo $data['no_transaksi']; ?>" type="text" class="form-control" readonly />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jenis Barang</label>
                            <div class="col-sm-4">
                                <input name="nama_barang" value="<?php echo $data['nama_barang']; ?>" type="text" class="form-control" readonly />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Deskripsi</label>
                            <div class="col-sm-4">
                                <input name="deskripsi" value="<?php echo $data['deskripsi']; ?>" type="text" class="form-control" readonly />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Alamat Asal</label>
                            <div class="col-sm-4">
                                <textarea class="form-control" readonly><?php echo $data['alamat_asal']; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Alamat Tujuan</label>
                            <div class="col-sm-4">
                                <textarea class="form-control" readonly><?php echo $data['alamat_tujuan']; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Pengirim</label>
                            <div class="col-sm-4">
                                <input type="text" value="<?php echo $data['nama_pelanggan']; ?>" class="form-control" readonly />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Penerima</label>
                            <div class="col-sm-4">
                                <input type="text" value="<?php echo $data['penerima']; ?>" class="form-control" readonly />
                            </div>
                        </div>                            

                        <div class="form-group">
                            <label class="col-sm-2 control-label">No HP Penerima</label>
                            <div class="col-sm-4">
                                <input type="text" value="<?php echo $data['no_hp_penerima']; ?>" class="form-control" readonly />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kurir</label>
                            <div class="col-sm-4">
                                <input type="text" value="<?php echo $_SESSION['nama']; ?>" class="form-control" readonly />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Barang Diambil</label>
                            <div class="col-sm-4">
                                <input type="file" name="gambar_awal" id="gambar_awal" class="form-control"
                                <?php if($data['status'] != 'Penjemputan Barang'){ echo "disabled"; } ?> />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Barang Diterima</label>
                            <div class="col-sm-4">
                                <input type="file" name="gambar_akhir" id="gambar_akhir" class="form-control"
                                <?php if($data['status'] != 'Proses Pengiriman'){ echo "disabled"; } ?> />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Status Terkini</label>
                            <div class="col-sm-4">
                                <input type="text" value="<?php echo $data['status']; ?>" class="form-control" readonly />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Ubah Status Menjadi</label>
                            <div class="col-sm-4">
                                <select id="status" name="status" class="form-control" required>
                                    <option value="" disabled selected>-- Pilih Status --</option>
                                    <option value="Proses Pengiriman" <?php if($data['status'] != 'Penjemputan Barang'){ echo "disabled"; } ?>>Proses Pengiriman</option>
                                    <option value="Terkirim" <?php if($data['status'] != 'Proses Pengiriman'){ echo "disabled"; } ?>>Terkirim</option>
                                </select>  
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <input type="submit" name="input" value="Save" class="btn btn-primary" />&nbsp;
                                <a href="dataorder.php" class="btn btn-danger">Batal</a>
                            </div> 
                        </div>
                    </form>
                <?php 
                } else {
                    echo "<meta http-equiv='refresh' content='0;url=dataorder.php'>";
                } 
                ?>
                </div>
            </div>
        </section>
    </div>
    <?php include "footer.php"; ?>
</div>

<script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script>
document.getElementById('status').addEventListener('change', function() {
    document.getElementById('gambar_awal').disabled = (this.value != 'Proses Pengiriman');
    document.getElementById('gambar_akhir').disabled = (this.value != 'Terkirim');
});
</script>
</body>
</html>

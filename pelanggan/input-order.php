<?php 
	session_start(); 
	include "login/ceksession.php";
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GA-Messenger | Input Order</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../assets/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../assets/plugins/iCheck/flat/blue.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../assets/plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../assets/plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- WYSIHTML5 -->
  <link rel="stylesheet" href="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <style>
    /* Biar form lebih modern */
    .box {
      border-radius: 10px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }
    .form-control {
      border-radius: 6px;
      box-shadow: none !important;
      transition: all 0.3s ease-in-out;
    }
    .form-control:focus {
      border-color: #3c8dbc;
      box-shadow: 0 0 5px rgba(60,141,188,0.5) !important;
    }
    .btn-lg {
      border-radius: 6px;
      padding: 10px 20px;
    }
    .help-block {
      font-size: 12px;
      color: #666;
    }
  </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include "header.php"; ?>
  <?php include "menu.php"; ?>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Input Order
        <small>Form Pengisian Data Order</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Order</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <section class="col-lg-12 connectedSortable">

          <!-- Card Form Order -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-cube"></i> Input Data Order</h3>
            </div>
            <div class="box-body">
              <form class="form-horizontal" 
                    action="proses/proses_input_order.php" 
                    method="post" 
                    enctype="multipart/form-data" 
                    id="form1">

<!-- Jenis Barang -->
<div class="form-group has-feedback">
  <label class="col-sm-2 control-label">Jenis Barang</label>
  <div class="col-sm-6">
    <select name="nama_barang" class="form-control" required>
      <option value="Paket">Paket</option>
      <option value="Dokumen">Dokumen</option>
    </select>
    <span class="glyphicon glyphicon-gift form-control-feedback"></span>
  </div>
</div>

<!-- Deskripsi -->
<div class="form-group has-feedback">
  <label class="col-sm-2 control-label">Deskripsi</label>
  <div class="col-sm-6">
    <textarea name="deskripsi" 
              class="form-control" 
              placeholder="Dokumen ini tidak boleh dibanting" 
              rows="2" 
              required></textarea>
    <span class="glyphicon glyphicon-pencil form-control-feedback"></span>
  </div>
</div>

<!-- Alamat Asal -->
<div class="form-group has-feedback">
  <label class="col-sm-2 control-label">Alamat Asal</label>
  <div class="col-sm-6">
    <textarea name="alamat_asal" class="form-control" rows="2" readonly>Gama Tower, Daerah Khusus Ibukota Jakarta, Indonesia</textarea>
    <span class="glyphicon glyphicon-map-marker form-control-feedback"></span>
  </div>
</div>

                <!-- Alamat Tujuan -->
                <div class="form-group has-feedback">
                  <label class="col-sm-2 control-label">Alamat Tujuan</label>
                  <div class="col-sm-6">
                    <textarea name="alamat_tujuan" class="form-control" placeholder="Alamat lengkap tujuan" rows="2" required></textarea>
                    <span class="glyphicon glyphicon-send form-control-feedback"></span>
                  </div>
                </div>

                <!-- Penerima -->
                <div class="form-group has-feedback">
                  <label class="col-sm-2 control-label">Penerima</label>
                  <div class="col-sm-6">
                    <input name="penerima" type="text" class="form-control" placeholder="Nama penerima paket" required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  </div>
                </div>

                <!-- No HP -->
                <div class="form-group has-feedback">
                  <label class="col-sm-2 control-label">No HP Penerima</label>
                  <div class="col-sm-6">
                    <input type="text" name="no_hp_penerima" maxlength="20" 
                           class="form-control" placeholder="08xxxxxxxxxxxxx" 
                           onkeypress="return goodchars(event,'+0123456789',this)" required>
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                  </div>
                </div>

                <!-- Foto Barang -->
                <div class="form-group">
                  <label class="col-sm-2 control-label">Foto Barang</label>
                  <div class="col-sm-6">
                    <input type="file" name="foto_barang" class="form-control" accept="image/*" required>
                    <p class="help-block"><i class="fa fa-info-circle text-blue"></i> Format: JPG/PNG | Maks: 2MB</p>
                  </div>
                </div>

                <!-- Tombol -->
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-6">
                    <button type="submit" 
                            onclick="return confirm('Ingin melanjutkan ke proses selanjutnya?')" 
                            class="btn btn-primary btn-lg">
                      <i class="fa fa-paper-plane"></i> Submit
                    </button>
                    <a href="dataorder.php" class="btn btn-danger btn-lg">
                      <i class="fa fa-times"></i> Batal
                    </a>
                  </div>
                </div>

              </form>
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
<script src="../assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="../assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="../assets/dist/js/app.min.js"></script>
</body>
</html>

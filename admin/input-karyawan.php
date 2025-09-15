<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Pendaftaran Pelanggan</title>
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h2>Form Pendaftaran Pelanggan</h2>
  <form class="form-horizontal" method="post" action="proses/proses_daftar_pelanggan.php" enctype="multipart/form-data">
    
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Nama Lengkap</label>
      <div class="col-sm-4">
        <input type="text" name="nama_pelanggan" class="form-control" placeholder="Masukkan Nama Lengkap" required>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Username</label>
      <div class="col-sm-4">
        <input type="text" name="username_pelanggan" class="form-control" placeholder="Masukkan Username" required>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Password</label>
      <div class="col-sm-4">
        <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
      <div class="col-sm-4">
        <input type="date" name="tanggal_lahir" class="form-control" required>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Alamat</label>
      <div class="col-sm-4">
        <textarea name="alamat_pelanggan" class="form-control" rows="3" placeholder="Masukkan Alamat" required></textarea>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">No HP</label>
      <div class="col-sm-4">
        <input type="text" name="no_hp_pelanggan" maxlength="12" class="form-control" placeholder="Masukkan No HP" required>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-4">
        <input type="email" name="email_pelanggan" class="form-control" placeholder="Masukkan Email" required>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Foto</label>
      <div class="col-sm-4">
        <input type="file" name="gambar" class="form-control" accept="image/*" required>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-sm-6 text-center">
        <button type="submit" class="btn btn-success">Daftar</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
      </div>
    </div>

  </form>
</div>
</body>
</html>

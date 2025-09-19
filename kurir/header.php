<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include '../koneksi/koneksi.php';

// Ambil data user kurir
$sql = "SELECT * FROM tb_kurir WHERE id_kurir='" . $_SESSION['id'] . "'";                        
$query = mysqli_query($db, $sql);
$data = mysqli_fetch_array($query);

// Ambil notifikasi unread (sesuaikan kalau di tb_notifikasi sudah ada kolom id_kurir)
$notif_sql = "SELECT * FROM tb_notifikasi 
              WHERE id_pelanggan='" . $_SESSION['id'] . "' 
              AND status='unread' 
              ORDER BY tanggal DESC LIMIT 5";

$notif_q = mysqli_query($db, $notif_sql);
$jumlah_notif = mysqli_num_rows($notif_q);
?>
<header class="main-header" style="background: linear-gradient(90deg, #8B0000, #555555);">
  <!-- Logo -->
  <a href="index.php" class="logo" style="background: rgba(0,0,0,0.2);">
    <span class="logo-mini"><b>GA</b></span>
    <span class="logo-lg"><b>GA</b> Portal</span>
  </a>

  <!-- Navbar -->
  <nav class="navbar navbar-static-top" style="background: transparent; box-shadow: none;">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">

        <!-- Notifikasi -->
        <li class="dropdown notifications-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
            <?php if($jumlah_notif > 0){ ?>
              <span class="label label-warning"><?php echo $jumlah_notif; ?></span>
            <?php } ?>
          </a>
          <ul class="dropdown-menu" style="border-radius:10px; width:300px;">
            <li class="header">Anda punya <?php echo $jumlah_notif; ?> notifikasi</li>
            <li>
              <ul class="menu">
                <?php 
                if ($jumlah_notif > 0) {
                  while($n = mysqli_fetch_array($notif_q)){ ?>
                    <li>
                      <a href="update_notif.php?id=<?php echo $n['id_notif']; ?>&redirect=<?php echo basename($_SERVER['PHP_SELF']); ?>">
                        <i class="fa fa-info-circle text-aqua"></i> <?php echo $n['pesan']; ?>
                        <br><small><i><?php echo date("d-m-Y H:i", strtotime($n['tanggal'])); ?></i></small>
                      </a>
                    </li>
                <?php } 
                } else { ?>
                  <li><a href="#"><i class="fa fa-check text-green"></i> Tidak ada notifikasi baru</a></li>
                <?php } ?>
              </ul>
            </li>
            <li class="footer"><a href="notifikasi.php">Lihat semua</a></li>
          </ul>
        </li>

        <!-- User Menu -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="images/<?php echo $data['gambar']; ?>" class="user-image img-circle" alt="User Image">
            <span class="hidden-xs"><?php echo $_SESSION['nama'];?></span>
          </a>
          <ul class="dropdown-menu" style="border-radius:10px;">
            <!-- User header -->
            <li class="user-header" style="background: linear-gradient(90deg, #8B0000, #555555);">
              <img src="images/<?php echo $data['gambar']; ?>" class="img-circle" alt="User Image">
              <p><?php echo $_SESSION['nama']; ?></p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="detail-kurir.php" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="../koneksi/proses_logout.php" class="btn btn-default btn-flat" onclick="return confirm('Apakah Anda Akan Keluar.?');">Keluar</a>
              </div>
            </li>
          </ul>
        </li>
        <li>
          <a href="#" data-toggle="control-sidebar"><i class="fa fa-cog fa-spin"></i></a>
        </li>
      </ul>
    </div>
  </nav>
</header>

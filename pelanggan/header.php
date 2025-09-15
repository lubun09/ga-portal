<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include '../koneksi/koneksi.php';

// Cek login pelanggan
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit;
}

// Ambil data pelanggan berdasarkan session
$sql    = "SELECT * FROM tb_pelanggan WHERE id_pelanggan='" . $_SESSION['id'] . "'";                        
$query  = mysqli_query($db, $sql);
$data   = mysqli_fetch_array($query);

// Ambil notifikasi terbaru pelanggan
$notif_q = mysqli_query($db, "SELECT * FROM tb_notifikasi 
                              WHERE id_pelanggan='".$_SESSION['id']."' AND status='unread'
                              ORDER BY tanggal DESC LIMIT 5");
$notif_count = mysqli_num_rows($notif_q);
?>

<header class="main-header" style="background: linear-gradient(90deg, #8B0000, #555555);">
  <!-- Logo -->
  <a href="index.php" class="logo" style="background: rgba(0,0,0,0.2);">
    <span class="logo-mini"><b>GA</b></span>
    <span class="logo-lg"><b>GA</b> Portal</span>
  </a>

  <!-- Navbar -->
  <nav class="navbar navbar-static-top" style="background: transparent; box-shadow: none;">
    <!-- Sidebar toggle button -->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <!-- Menu kanan -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">

        <!-- Notifikasi -->
        <li class="dropdown notifications-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-bell-o"></i>
            <?php if($notif_count > 0) { ?>
              <span class="label label-warning"><?php echo $notif_count; ?></span>
            <?php } ?>
          </a>
          <ul class="dropdown-menu" style="width:300px;">
            <li class="header">Anda punya <?php echo $notif_count; ?> notifikasi</li>
            <li>
              <ul class="menu">
                <?php 
                if ($notif_count > 0) {
                    while ($n = mysqli_fetch_array($notif_q)) {
                        echo '
                        <li>
                          <a href="update_notif.php?id='.$n['id_notif'].'&redirect='.basename($_SERVER['PHP_SELF']).'">
                            <i class="fa fa-info-circle text-aqua"></i> '.$n['pesan'].' 
                            <br><small><i>'.date("d-m-Y H:i", strtotime($n['tanggal'])).'</i></small>
                          </a>
                        </li>';
                    }
                } else {
                    echo '<li><a href="#"><i class="fa fa-check text-green"></i> Tidak ada notifikasi baru</a></li>';
                }
                ?>
              </ul>
            </li>
            <li class="footer"><a href="notifikasi.php">Lihat semua</a></li>
          </ul>
        </li>

        <!-- Profil User -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="images/<?php echo $data['gambar']; ?>" class="user-image img-circle" alt="User Image">
            <span class="hidden-xs"><?php echo $_SESSION['nama']; ?></span>
          </a>
          <ul class="dropdown-menu" style="border-radius:10px;">
            <!-- Header user -->
            <li class="user-header" style="background: linear-gradient(90deg, #8B0000, #555555);">
              <img src="images/<?php echo $data['gambar']; ?>" class="img-circle" alt="User Image">
              <p><?php echo $_SESSION['nama']; ?></p>
            </li>
            <!-- Footer user -->
            <li class="user-footer">
              <div class="pull-left">
                <a href="detail-pelanggan.php" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="../koneksi/proses_logout.php" class="btn btn-default btn-flat" onclick="return confirm('Apakah Anda Akan Keluar.?');">Keluar</a>
              </div>
            </li>
          </ul>
        </li>

        <!-- Settings -->
        <li>
          <a href="#" data-toggle="control-sidebar"><i class="fa fa-cog fa-spin"></i></a>
        </li>
      </ul>
    </div>
  </nav>
</header>

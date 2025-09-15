<?php 
  include '../koneksi/koneksi.php';
  $sql    = "SELECT * FROM tb_kurir WHERE id_kurir='".$_SESSION['id']."'";
  $query  = mysqli_query($db, $sql);
  $data   = mysqli_fetch_array($query);
?>
<aside class="main-sidebar" style="background: color: #fff;">
  <section class="sidebar" style="padding-top: 20px;">

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" style="padding-left: 10px; padding-right: 10px;">
      <li class="header" style="color: #bbb; text-align: center; letter-spacing: 1px;">MENU UTAMA</li>

      <li class="active">
        <a href="index.php" style="border-radius: 8px; margin: 4px 0; background: #8B0000; color: #fff;">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>

      <li class="treeview">
        <a href="#" style="border-radius: 8px; margin: 4px 0; color: #fff;">
          <i class="fa fa-user"></i> <span>Informasi</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" style="padding-left: 15px;">
          <li>
            <a href="ambilorder.php?no_transaksi=" style="border-radius: 6px; margin: 3px 0; color: #ccc;">
              <i class="fa fa-circle-o"></i> Ambil
            </a>
          </li>
          <li>
            <a href="orderterkirim.php" style="border-radius: 6px; margin: 3px 0; color: #ccc;">
              <i class="fa fa-circle-o"></i> Selesai
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </section>
</aside>

<!-- Sidebar Hover Effect -->
<style>
  .sidebar-menu li > a:hover {
    background: #8B0000 !important;
    color: #fff !important;
    cursor: pointer;
  }
  .treeview-menu li > a:hover {
    background: rgba(139, 0, 0, 0.2) !important;
    color: #fff !important;
    cursor: pointer;
  }
</style>

<?php 
	 include '../koneksi/koneksi.php';
			$sql  		= "SELECT * FROM tb_kurir where id_kurir='".$_SESSION['id']."'";                        
			$query  	= mysqli_query($db, $sql);
			$data 		= mysqli_fetch_array($query);
?>
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="images/<?php echo $data['gambar'];?>" height="200" width="200" style="border: 2px solid white;" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $_SESSION['nama']; ?></p>
        <a href="index.php"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div><br />
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MENU UTAMA</li>
      <li class="active treeview">
        <a href="index.php">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>

      <li>
        <a href="#">
          <i class="fa fa-user"></i> <span>Informasi</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <!-- <li><a href="dataorder.php"><i class="fa fa-circle-o"></i>Daftar Order</a></li> -->
          <li><a href="ambilorder.php?no_transaksi="><i class="fa fa-circle-o"></i>Lacak</a></li>
          <li><a href="orderterkirim.php"><i class="fa fa-circle-o"></i>Terkirim</a></li>
        </ul>
      </li>
  </section>
          <!-- /.sidebar -->
</aside>
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
  <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">

  <style>
    .notif-card {
      background: #fff;
      border: 1px solid #e0e0e0;
      border-radius: 10px;
      padding: 15px 20px;
      margin-bottom: 15px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      position: relative;
    }
    .notif-card:hover { box-shadow: 0 4px 10px rgba(0,0,0,0.15); }
    .notif-title { font-size: 14px; font-weight: bold; margin-bottom: 6px; }
    .notif-detail { font-size: 13px; color: #555; }
    .stars { color: #f39c12; font-size: 13px; }
    .penilaian-bar {
      display: flex; justify-content: space-between; align-items: center;
      margin-top: 5px; flex-wrap: wrap;
    }
    .notif-status { position: absolute; top: 15px; right: 20px; }
    .notif-footer { text-align: center; margin-top: 10px; }

    .search-box { margin-bottom: 15px; max-width: 300px; }
    .pagination { display: flex; justify-content: center; margin-top: 15px; flex-wrap: wrap; }
    .pagination button { padding: 5px 10px; margin: 2px; border: none; background-color: #337ab7; color: white; border-radius: 4px; cursor: pointer; }
    .pagination button.disabled { background-color: #ccc; cursor: default; }
    .view-link { color: #007bff; text-decoration: underline; cursor: pointer; }
    .view-link:hover { color: #0056b3; }

    /* Tambahan CSS untuk rating */
.rating {
  display: inline-flex;
  flex-direction: row-reverse; /* balikkan urutan DOM */
  justify-content: center;
  gap: 5px;
}
.rating input {
  display: none;
}
.rating label {
  font-size: 24px;
  color: #ccc;
  cursor: pointer;
}
.rating label:hover,
.rating label:hover ~ label {
  color: #f39c12;
}
.rating input:checked ~ label {
  color: #f39c12;
}

  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php include "header.php"; ?>
<?php include "menu.php"; ?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Data Order Terkirim</h1>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12 connectedSortable">
        <div class="box box-primary">
          <div class="box-body">

<input type="text" class="form-control search-box" id="searchInput" placeholder="Cari Jenis Barang atau kurir...">
<div id="notifContainer">

<?php 
include '../koneksi/koneksi.php';
$sql = "SELECT * FROM tb_transaksi 
        INNER JOIN tb_kurir ON tb_transaksi.kurir = tb_kurir.id_kurir 
        WHERE pengirim='".$_SESSION['id']."' AND status='Terkirim' 
        ORDER BY no_transaksi DESC";                        
$query = mysqli_query($db, $sql);
if(mysqli_num_rows($query)==0){
  echo "<center><h4>Belum Ada Pengiriman Terkirim</h4></center>";
} else {
  while($data = mysqli_fetch_array($query)){
    $id_modal = "modalPenilaian".$data['no_transaksi'];
?>
<div class="notif-card">
  <div class="notif-title">
    ID: <?= htmlspecialchars($data['no_transaksi']) ?> - <?= htmlspecialchars($data['nama_barang']) ?>
  </div>
  <div class="notif-status">
    <span class="label label-success">Terkirim</span>
  </div>
  <div class="notif-detail penilaian-bar">
    <span>Messenger: <?= htmlspecialchars($data['nama_kurir']) ?></span>
    <?php if($data['penilaian'] == 0): ?>
      <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#<?= $id_modal ?>">Beri Penilaian</button>
    <?php else: ?>
      <span class="stars">
      <?php for($i=1;$i<=5;$i++): ?>
        <i class="fa <?= $i <= $data['penilaian'] ? 'fa-star' : 'fa-star-o' ?>"></i>
      <?php endfor; ?>
      </span>
    <?php endif; ?>
  </div>
  <div class="notif-footer">
    <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#<?= $id_modal ?>">
      <i class="fa fa-chevron-down"></i> 
    </button>
  </div>
</div>

<!-- MODAL -->
<div class="modal fade" id="<?= $id_modal ?>" tabindex="-1">
  <div class="modal-dialog">
  <form action="proses/proses_penilaian.php" method="post">
    <input type="hidden" name="no_transaksi" value="<?= htmlspecialchars($data['no_transaksi']) ?>">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Pengiriman & Penilaian</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <!-- TABEL DETAIL -->
        <table class="table table-bordered">
          <tr><td><strong>ID Pemesanan</strong></td><td><?= $data['no_transaksi'] ?></td></tr>
          <tr><td><strong>Jenis Barang</strong></td><td><?= $data['nama_barang'] ?></td></tr>
          <tr><td><strong>Deskripsi</strong></td><td><?= $data['deskripsi'] ?></td></tr>
          <tr><td><strong>Alamat Asal</strong></td><td><?= $data['alamat_asal'] ?></td></tr>
          <tr><td><strong>Alamat Tujuan</strong></td><td><?= $data['alamat_tujuan'] ?></td></tr>
          <tr><td><strong>Penerima</strong></td><td><?= $data['penerima'] ?></td></tr>
          <tr><td><strong>No HP Penerima</strong></td><td><?= $data['no_hp_penerima'] ?></td></tr>
          <tr><td><strong>Kurir</strong></td><td><?= $data['nama_kurir'] ?></td></tr>
          <tr><td><strong>No HP Kurir</strong></td><td><?= $data['no_hp_kurir'] ?></td></tr>
          <tr><td><strong>Status</strong></td><td><?= $data['status'] ?></td></tr>
          <tr><td><strong>Waktu Pengiriman</strong></td><td><?= nl2br($data['waktu']) ?></td></tr>
          <tr>
            <td><strong>Foto Barang</strong></td>
            <td>
              <?php if(!empty($data['foto_barang'])) { ?>
                <span class="view-link" data-img="../pelanggan/images/Kirim/<?= $data['foto_barang'] ?>">View</span>
              <?php } else { echo "<span class='text-muted'>Tidak ada foto</span>"; } ?>
            </td>
          </tr>
          <tr>
            <td><strong>Barang Diambil</strong></td>
            <td>
              <?php if(!empty($data['gambar_awal'])) { ?>
                <span class="view-link" data-img="../kurir/images/diambil/<?= $data['gambar_awal'] ?>">View</span>
              <?php } else { echo "<span class='text-muted'>Tidak ada foto</span>"; } ?>
            </td>
          </tr>
          <tr>
            <td><strong>Barang Diterima</strong></td>
            <td>
              <?php if(!empty($data['gambar_akhir'])) { ?>
                <span class="view-link" data-img="../kurir/images/selesai/<?= $data['gambar_akhir'] ?>">View</span>
              <?php } else { echo "<span class='text-muted'>Tidak ada foto</span>"; } ?>
            </td>
          </tr>
        </table>

        <hr>
        <?php if($data['penilaian'] == 0): ?>
<div class="rating">
  <?php for($i=5; $i>=1; $i--): ?> 
    <input type="radio" id="star<?= $i ?>_<?= $data['no_transaksi'] ?>" name="nilai" value="<?= $i ?>" required>
    <label for="star<?= $i ?>_<?= $data['no_transaksi'] ?>"><i class="fa fa-star"></i></label>
  <?php endfor; ?>
</div>


          <br>
          <textarea name="komentar" class="form-control" placeholder="Masukkan Komentar" required></textarea>
        <?php else: ?>
          <p><strong>Penilaian:</strong> 
            <?php for($i=1;$i<=5;$i++): ?>
              <i class="fa <?= $i <= $data['penilaian'] ? 'fa-star' : 'fa-star-o' ?>"></i>
            <?php endfor; ?>
          </p>
          <p><strong>Komentar:</strong> <?= htmlspecialchars($data['komentar']) ?></p>
        <?php endif; ?>
      </div>
      <div class="modal-footer">
        <?php if($data['penilaian'] == 0): ?>
          <button type="submit" class="btn btn-primary btn-sm">Kirim</button>
        <?php endif; ?>
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </form>
  </div>
</div>
<!-- End MODAL -->
<?php }} ?>
</div>
<div id="pagination" class="pagination"></div>

          </div>
        </div>
      </section>
    </div>
  </section>
</div>

<?php include "footer.php"; ?>
<div class="control-sidebar-bg"></div>
</div>

<!-- Modal untuk preview gambar -->
<div class="modal fade" id="modalViewImage" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center">
        <img id="imgPreview" src="" class="img-responsive" style="max-width:100%; border-radius:5px;">
      </div>
    </div>
  </div>
</div>

<script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/dist/js/app.min.js"></script>
<script>
  $(function () {
    $('.sidebar-menu').tree();
  });

  document.addEventListener('DOMContentLoaded', function () {
    const cards = document.querySelectorAll('.notif-card');
    const searchInput = document.getElementById('searchInput');
    const pagination = document.getElementById('pagination');
    const cardsPerPage = 10;
    let currentPage = 1;

    let filtered = Array.from(cards);

    function showCards(page) {
      const start = (page - 1) * cardsPerPage;
      const end = start + cardsPerPage;
      filtered.forEach((card, index) => {
        card.style.display = index >= start && index < end ? '' : 'none';
      });
    }

    function createPagination(totalPages) {
      pagination.innerHTML = '';
      for (let i = 1; i <= totalPages; i++) {
        const btn = document.createElement('button');
        btn.textContent = i;
        if (i === currentPage) btn.classList.add('disabled');
        btn.onclick = () => {
          currentPage = i;
          showCards(currentPage);
          createPagination(Math.ceil(filtered.length / cardsPerPage));
        };
        pagination.appendChild(btn);
      }
    }

    function filterCards() {
      const query = searchInput.value.toLowerCase();
      filtered = Array.from(cards).filter(card => card.textContent.toLowerCase().includes(query));
      currentPage = 1;
      showCards(currentPage);
      createPagination(Math.ceil(filtered.length / cardsPerPage));
    }

    searchInput.addEventListener('input', filterCards);

    showCards(currentPage);
    createPagination(Math.ceil(filtered.length / cardsPerPage));
  });

  // Tampilkan gambar di modalViewImage jika klik View
  document.addEventListener('click', function (e) {
    if (e.target.classList.contains('view-link')) {
      const imgSrc = e.target.getAttribute('data-img');
      document.getElementById('imgPreview').src = imgSrc;
      $('#modalViewImage').modal('show');
    }
  });
</script>
</body>
</html>

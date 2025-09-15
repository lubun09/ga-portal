<?php
session_start();
include "login/ceksession.php";
include "../koneksi/koneksi.php";

// debug error biar kelihatan kalau ada salah
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ambil bulan & tahun dari URL
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

// Query transaksi
$sql = "
    SELECT t.no_transaksi, t.nama_barang, t.alamat_asal, t.alamat_tujuan,
           t.penerima, t.penilaian, t.tanggal_kirim,
           p.nama_pelanggan, k.nama_kurir
    FROM tb_pelanggan p
    INNER JOIN tb_transaksi t ON p.id_pelanggan = t.pengirim
    INNER JOIN tb_kurir k ON t.kurir = k.id_kurir
    WHERE t.status = 'Terkirim'
      AND MONTH(t.created_at) = '$bulan'
      AND YEAR(t.created_at) = '$tahun'
    ORDER BY t.created_at ASC
";
$result = mysqli_query($db, $sql);
if (!$result) {
    die("Query Error: " . mysqli_error($db));
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi Bulan <?= $bulan . "-" . $tahun; ?></title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
</head>
<body class="p-4">
    <div class="container">
        <h2 class="mb-3">Laporan Transaksi Bulan <?= $bulan . "-" . $tahun; ?></h2>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Transaksi</th>
                    <th>Jenis Barang</th>
                    <th>Alamat Asal</th>
                    <th>Alamat Tujuan</th>
                    <th>Nama Pelanggan</th>
                    <th>Penerima</th>
                    <th>Nama Kurir</th>
                    <th>Penilaian</th>
                    <th>Tanggal Kirim</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                while ($data = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data['no_transaksi']; ?></td>
                        <td><?= $data['nama_barang']; ?></td>
                        <td><?= $data['alamat_asal']; ?></td>
                        <td><?= $data['alamat_tujuan']; ?></td>
                        <td><?= $data['nama_pelanggan']; ?></td>
                        <td><?= $data['penerima']; ?></td>
                        <td><?= $data['nama_kurir']; ?></td>
                        <td><?= ($data['penilaian'] == 0) ? 'Belum Ada Penilaian' : $data['penilaian']; ?></td>
                        <td><?= $data['tanggal_kirim']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

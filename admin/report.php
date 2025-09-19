<?php
session_start();
include "login/ceksession.php";
include "../koneksi/koneksi.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

$bulan = mysqli_real_escape_string($db, $_GET['bulan'] ?? date('m'));
$tahun = mysqli_real_escape_string($db, $_GET['tahun'] ?? date('Y'));

$sql = "SELECT t.no_transaksi, t.nama_barang, t.alamat_asal, t.alamat_tujuan,
               p.nama_pelanggan, t.penerima, k.nama_kurir, t.penilaian, t.created_at
        FROM tb_transaksi t
        JOIN tb_pelanggan p ON t.pengirim = p.id_pelanggan
        JOIN tb_kurir k ON t.kurir = k.id_kurir
        WHERE t.status = 'Terkirim'
          AND MONTH(t.created_at) = '$bulan'
          AND YEAR(t.created_at) = '$tahun'
        ORDER BY t.no_transaksi ASC";

$result = mysqli_query($db, $sql);

if (!$result) {
    die("❌ Query Error: " . mysqli_error($db));
}

$filename = "Laporan_Transaksi_{$bulan}_{$tahun}.csv";
header('Content-Type: text/csv; charset=utf-8');
header("Content-Disposition: attachment; filename=\"$filename\"");

$output = fopen('php://output', 'w');

// header kolom
fputcsv($output, [
    'No', 'No Transaksi', 'Jenis Barang', 'Alamat Asal', 'Alamat Tujuan',
    'Pengirim', 'Penerima', 'Kurir', 'Penilaian', 'Created At'
]);

$no = 1;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, [
            $no++,
            $row['no_transaksi'],
            $row['nama_barang'],
            $row['alamat_asal'],
            $row['alamat_tujuan'],
            $row['nama_pelanggan'],
            $row['penerima'],
            $row['nama_kurir'],
            $row['penilaian'] == 0 ? 'Belum Ada' : $row['penilaian'],
            $row['created_at']
        ]);
    }
} else {
    // kalau kosong tetap download file dengan info
    fputcsv($output, ["", "Tidak ada data transaksi untuk bulan $bulan-$tahun", "", "", "", "", "", "", "", ""]);
}

fclose($output);
exit;
?>

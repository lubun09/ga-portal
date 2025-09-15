<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include '../../koneksi/koneksi.php';

// Cek session id pelanggan
if(!isset($_SESSION['id'])){
    die("<h2>Session ID pelanggan tidak ditemukan. Silahkan login kembali.</h2>");
}

// Ambil inputan
$nama_brg       = mysqli_real_escape_string($db, $_POST['nama_barang'] ?? '');
$deskripsi      = mysqli_real_escape_string($db, $_POST['deskripsi'] ?? ''); // 🔥 ambil deskripsi
$alamat_asal    = mysqli_real_escape_string($db, $_POST['alamat_asal'] ?? '');
$alamat_tujuan  = mysqli_real_escape_string($db, $_POST['alamat_tujuan'] ?? '');
$penerima       = mysqli_real_escape_string($db, $_POST['penerima'] ?? '');
$pengirim       = mysqli_real_escape_string($db, $_SESSION['id']);
$no_hp          = mysqli_real_escape_string($db, $_POST['no_hp_penerima'] ?? '');

// Ambil file foto
$foto_barang    = $_FILES['foto_barang']['name'] ?? '';
$tmp_foto       = $_FILES['foto_barang']['tmp_name'] ?? '';
$foto_error     = $_FILES['foto_barang']['error'] ?? 4;

// Validasi input
if ($nama_brg=='' || $deskripsi=='' || $alamat_asal=='' || $alamat_tujuan=='' || $penerima=='' || $pengirim=='' || $no_hp=='') {
    die("<h2>Silahkan isi semua kolom.</h2>");
}

// Validasi upload
if ($foto_error !== 0) die("<h2>Upload Error Code: $foto_error</h2>");
if ($foto_barang == '' || $tmp_foto == '') die("<h2>File foto tidak ditemukan.</h2>");

$allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
$file_type = mime_content_type($tmp_foto);
$file_size = $_FILES['foto_barang']['size'];

if (!in_array($file_type, $allowed_types)) die("<h2>Format file tidak didukung. JPG/PNG saja.</h2>");
if ($file_size > 2*1024*1024) die("<h2>Ukuran file terlalu besar. Maks 2MB.</h2>");

// Tentukan folder penyimpanan
$folder = "../../pelanggan/images/Kirim/";
if (!is_dir($folder)) {
    if(!mkdir($folder, 0777, true)){
        die("<h2>Gagal membuat folder penyimpanan.</h2>");
    }
}

// Jenis Barang unik
$nama_file_baru = time() . "_" . basename($foto_barang);

// Pindahkan file
if (!move_uploaded_file($tmp_foto, $folder.$nama_file_baru)){
    die("<h2>Gagal memindahkan file ke folder $folder.</h2>");
}

// Siapkan waktu
date_default_timezone_set('Asia/Jakarta');
$date = date("d-m-Y H:i:s");
$waktu = "Pengiriman Dibuat &nbsp;&nbsp;&nbsp;($date)";

// 🔥 Insert database dengan tambahan deskripsi
$sql = "INSERT INTO tb_transaksi 
        (alamat_asal, alamat_tujuan, penerima, pengirim, nama_barang, deskripsi, no_hp_penerima, foto_barang, status, waktu, gambar_awal, gambar_akhir, kurir, penilaian, komentar)
        VALUES 
        ('$alamat_asal','$alamat_tujuan','$penerima','$pengirim','$nama_brg','$deskripsi','$no_hp','$nama_file_baru','Belum Terkirim','$waktu','','',0,0,'')";

$execute = mysqli_query($db, $sql);
if(!$execute) die("<h2>Gagal menyimpan transaksi: ".mysqli_error($db)."</h2>");

// Ambil ID transaksi terakhir
$id_transaksi = mysqli_insert_id($db);

// Ambil nama pelanggan
$result_pelanggan = mysqli_query($db, "SELECT nama_pelanggan FROM tb_pelanggan WHERE id_pelanggan='$pengirim'");
$pelanggan_data = mysqli_fetch_assoc($result_pelanggan);
$nama_pelanggan = $pelanggan_data['nama_pelanggan'] ?? 'Unknown';

// Buat notifikasi admin (misal id_admin=6)
$admin_id = 6;
$pesan = "Nomor (#$id_transaksi) Dari $nama_pelanggan.";
mysqli_query($db, "INSERT INTO tb_notifikasi (id_pelanggan, pesan, status) VALUES ('$admin_id','$pesan','unread')");

// Sukses
echo "<center><h2>Pengiriman Anda telah diinput dan akan diantar oleh kurir<br>Terima Kasih</h2></center>
<meta http-equiv='refresh' content='2;url=../dataorder.php'>";
?>

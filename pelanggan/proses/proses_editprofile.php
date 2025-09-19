<?php
session_start();
include '../../koneksi/koneksi.php';

// Debug supaya error terlihat (hilangkan di production jika perlu)
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_SESSION['id']);

    // Ambil dan sanitize input
    $nama     = mysqli_real_escape_string($db, $_POST['nama_pelanggan'] ?? '');
    $username = mysqli_real_escape_string($db, $_POST['username_pelanggan'] ?? '');
    $tanggal  = mysqli_real_escape_string($db, $_POST['tanggal_lahir'] ?? '0000-00-00');
    $alamat   = mysqli_real_escape_string($db, $_POST['alamat_pelanggan'] ?? '');
    $no_hp    = mysqli_real_escape_string($db, $_POST['no_hp_pelanggan'] ?? '');
    $gambar   = $_FILES['gambar']['name'] ?? '';

    // Ambil data lama user
    $query = mysqli_query($db, "SELECT * FROM tb_pelanggan WHERE id_pelanggan = '$id'");
    if (!$query) {
        die("<h2>Error DB: " . mysqli_error($db) . "</h2>");
    }
    $data = mysqli_fetch_assoc($query);
    if (!$data) {
        die("<h2>❌ Data tidak ditemukan</h2>");
    }

    // PASSWORD: jika ada input baru -> hash pakai SHA1, kalau kosong pakai password lama
    if (!empty($_POST['password'])) {
        // Note: menggunakan SHA1 sesuai permintaan (tidak direkomendasikan secara security)
        $password = mysqli_real_escape_string($db, sha1($_POST['password']));
    } else {
        $password = $data['password']; // pakai yang lama
    }

    // Handling gambar
    $nama_b = $data['gambar']; // default nama file gambar lama

    // Jika tidak upload gambar baru: kita rename file lama agar sesuai username baru (opsional)
    if ($gambar == '') {
        if (!empty($data['gambar'])) {
            $ext    = pathinfo($data['gambar'], PATHINFO_EXTENSION);
            $newname = $username . "." . $ext;
            // hanya rename jika nama lama berbeda dan file lama ada
            if ($data['gambar'] !== $newname && file_exists("../images/" . $data['gambar'])) {
                // cek agar tidak menimpa file lain
                if (!file_exists("../images/" . $newname)) {
                    rename("../images/" . $data['gambar'], "../images/" . $newname);
                    $nama_b = $newname;
                } else {
                    // jika sudah ada file dengan nama baru, tetap pakai nama lama
                    $nama_b = $data['gambar'];
                }
            } else {
                $nama_b = $data['gambar'];
            }
        } else {
            $nama_b = ''; // tidak ada gambar
        }
    } else {
        // Upload gambar baru: validasi tipe & ukuran
        $tipe_file   = $_FILES['gambar']['type'];
        $ukuran_file = $_FILES['gambar']['size'];
        $tmp_name    = $_FILES['gambar']['tmp_name'];

        // Valid MIME types
        $allowed = ["image/jpeg", "image/jpg", "image/png"];
        if (in_array($tipe_file, $allowed) && $ukuran_file <= 2100000) {
            // hapus file lama jika ada
            if (!empty($data['gambar']) && file_exists("../images/" . $data['gambar'])) {
                @unlink("../images/" . $data['gambar']);
            }
            $ext_file  = pathinfo($gambar, PATHINFO_EXTENSION);
            $nama_baru = $username . "_" . time() . "." . $ext_file;
            if (move_uploaded_file($tmp_name, "../images/" . $nama_baru)) {
                $nama_b = $nama_baru;
            } else {
                echo "<center><h2><br>⚠️ Gagal mengunggah gambar. Silakan ulangi</h2></center>";
                echo "<meta http-equiv='refresh' content='2;url=../edit-profilepelanggan.php'>";
                exit;
            }
        } else {
            echo "<center><h2><br>⚠️ Gambar tidak sesuai (hanya jpg/png, max 2MB)<br>Silakan ulangi</h2></center>";
            echo "<meta http-equiv='refresh' content='2;url=../edit-profilepelanggan.php'>";
            exit;
        }
    }

    // UPDATE DB
    $sql = "UPDATE tb_pelanggan SET 
                nama_pelanggan       = '". $nama ."',
                username_pelanggan   = '". $username ."',
                password             = '". $password ."',
                tanggal_lahir        = '". $tanggal ."',
                alamat_pelanggan     = '". $alamat ."',
                no_hp_pelanggan      = '". $no_hp ."',
                gambar               = '". $nama_b ."'
            WHERE id_pelanggan = $id";

    if (mysqli_query($db, $sql)) {
        // perbarui session username/nama
        $_SESSION['username'] = $username;
        $_SESSION['nama']     = $nama;

        echo "<center><h2><br>✅ Data anda telah diperbarui</h2></center>";
        echo "<meta http-equiv='refresh' content='2;url=../detail-pelanggan.php'>";
        exit;
    } else {
        echo "<center><h2><br>❌ Gagal update: " . mysqli_error($db) . "</h2></center>";
        echo "<meta http-equiv='refresh' content='3;url=../edit-profilepelanggan.php'>";
        exit;
    }
}
?>

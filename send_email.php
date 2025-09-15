<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/koneksi/koneksi.php';

$SMTP_HOST = "smtp.gmail.com";
$SMTP_PORT = 587;
$SMTP_USER = "kpn.gaportal@gmail.com"; 
$SMTP_PASS = "xpte nhbl whff ggad"; 
$SMTP_FROM = "kpn.gaportal@gmail.com"; 
$SMTP_NAME = "GA-Messenger";

// Ambil transaksi terbaru yang belum dikirim email
$query = "
    SELECT 
        t.no_transaksi, 
        t.status, 
        t.email_sent,
        p.email_pelanggan AS email_pelanggan, 
        k.email_kurir AS email_kurir
    FROM tb_transaksi t
    LEFT JOIN tb_pelanggan p ON t.pengirim = p.id_pelanggan
    LEFT JOIN tb_kurir k ON t.kurir = k.id_kurir
    WHERE t.email_sent = 0
    ORDER BY t.no_transaksi ASC
";

$result = mysqli_query($db, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo date("Y-m-d H:i:s") . " - Tidak ada transaksi baru untuk dikirim.\n";
    exit;
}

while ($data = mysqli_fetch_assoc($result)) {
    $status = $data['status'];
    $emailPelanggan = $data['email_pelanggan'];
    $emailKurir = $data['email_kurir'];
    $emailAdmin = "kpn.gaportal@gmail.com";

    $recipients = [];
    $subject = "";
    $body = "";

    switch ($status) {
        case "Belum Terkirim":
            $recipients = array_filter([$emailKurir, $emailAdmin]);
            $subject = "Pesanan Baru dari Pelanggan";
            $body = "<p>Ada pesanan baru. Silakan dicek di sistem <strong>GA-Messenger</strong>.</p>";
            break;

        case "Penjemputan Barang":
            $recipients = array_filter([$emailPelanggan, $emailAdmin]);
            $subject = "Kurir Sedang Menjemput Barang";
            $body = "<p>Kurir sedang menjemput barang Anda. Mohon ditunggu.</p>";
            break;

        case "Proses Pengiriman":
            $recipients = array_filter([$emailPelanggan, $emailAdmin]);
            $subject = "Barang Sedang Dalam Perjalanan";
            $body = "<p>Kurir sedang mengantar barang Anda. Harap bersiap untuk penerimaan.</p>";
            break;

        case "Terkirim":
            $recipients = array_filter([$emailPelanggan, $emailAdmin]);
            $subject = "Barang Telah Terkirim";
            $body = "<p>Barang sudah sampai tujuan. Terima kasih telah menggunakan <strong>GA-Messenger</strong>.</p>";
            break;
    }

    // Fungsi kirim email
    function sendEmail($to, $subject, $body, $SMTP_HOST, $SMTP_PORT, $SMTP_USER, $SMTP_PASS, $SMTP_FROM, $SMTP_NAME) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = $SMTP_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = $SMTP_USER;
            $mail->Password   = $SMTP_PASS;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = $SMTP_PORT;

            $mail->setFrom($SMTP_FROM, $SMTP_NAME);
            $mail->addAddress($to);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = strip_tags($body);

            $mail->send();
            return true;
        } catch (Exception $e) {
            $log = date("Y-m-d H:i:s") . " - Gagal: {$to} - {$mail->ErrorInfo}\n";
            echo $log;
            file_put_contents(__DIR__ . "/mail_log.txt", $log, FILE_APPEND);
            return false;
        }
    }

    $allSent = true;
    foreach ($recipients as $to) {
        if (!sendEmail($to, $subject, $body, $SMTP_HOST, $SMTP_PORT, $SMTP_USER, $SMTP_PASS, $SMTP_FROM, $SMTP_NAME)) {
            $allSent = false;
        }
    }

    // Jika semua email sukses dikirim, update email_sent
    if ($allSent) {
        mysqli_query($db, "UPDATE tb_transaksi SET email_sent = 1 WHERE no_transaksi = ".$data['no_transaksi']);
    }
}
?>

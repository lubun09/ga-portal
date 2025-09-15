<?php
$server   = "127.0.0.1";
$username = "root";  
$password = "Sudetlin09"; 
$database = "db_kurir";
$port     = 3306;           // default MySQL/MariaDB

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $db = mysqli_connect($server, $username, $password, $database, $port);
    mysqli_set_charset($db, "utf8mb4");
} catch (mysqli_sql_exception $e) {
    die("Koneksi Database Gagal: " . $e->getMessage());
}
?>

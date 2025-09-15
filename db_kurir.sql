-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Agu 2025 pada 08.51
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kurir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(10) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `username_admin` varchar(50) NOT NULL,
  `email_admin` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama_admin`, `username_admin`, `email_admin`, `password`, `gambar`) VALUES
(6, 'Sudetlin', 'Sudetlin', 'kpn.gaportal@gmail.com', 'ffbd25dcd178430842a2aeb4e6228a6dc45b05da', 'Sudetlin.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kurir`
--

CREATE TABLE `tb_kurir` (
  `id_kurir` int(11) NOT NULL,
  `nama_kurir` varchar(70) NOT NULL,
  `username_kurir` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `tanggal_lahir_kurir` date NOT NULL,
  `alamat` text NOT NULL,
  `no_hp_kurir` varchar(12) NOT NULL,
  `email_kurir` varchar(100) NOT NULL,
  `no_plat` varchar(9) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_kurir`
--

INSERT INTO `tb_kurir` (`id_kurir`, `nama_kurir`, `username_kurir`, `password`, `tanggal_lahir_kurir`, `alamat`, `no_hp_kurir`, `email_kurir`, `no_plat`, `gambar`) VALUES
(8, 'Tarmono', 'Tarmono', '255171f442a2cc4a0d1f9b0ac98f85e2fec7a725', '1983-07-13', 'Gama Tower', '087876003933', 'sudetlin.sugito@kpn-corp.com', 'BBBB', 'Tarmono.jpg'),
(9, 'Dody', 'Dody', '652aab9bececf82801871ed4b3fa021edf655bc4', '2025-06-18', 'Gama Tower', '081111111111', 'sudetlin.sugito@kpn-corp.com', 'B1111BBB', 'Dody.jpg'),
(10, 'Pur', 'Pur', 'aa840d55f751649d07cea0fa54114a834d18958f', '2025-06-18', 'Pur', '123456789', 'sudetlin.sugito@kpn-corp.com', 'Pur', 'Pur.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(70) NOT NULL,
  `username_pelanggan` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat_pelanggan` text NOT NULL,
  `no_hp_pelanggan` varchar(12) NOT NULL,
  `email_pelanggan` varchar(100) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `nama_pelanggan`, `username_pelanggan`, `password`, `tanggal_lahir`, `alamat_pelanggan`, `no_hp_pelanggan`, `email_pelanggan`, `gambar`) VALUES
(7, 'Subani', 'Subani', '5afae79806411575f76b86584164b2729d9602df', '2025-06-10', 'Subani', '0811', 'sudetlin.sugito@kpn-corp.com', 'Subani.jpg'),
(10, 'Here', 'Here', 'ecbcb0e424c40d9931c2c7c8b44c33c5f4e12465', '2025-06-18', 'Here', '1234567890', 'sudetlin.sugito@kpn-corp.com', 'Here.png'),
(11, 'Free', 'Free', '75f527181b574f84568f33f67adc3b267a6fef9c', '2025-06-17', 'Free', '1234567890', 'sudetlin.sugito@kpn-corp.com', 'Free.jpg'),
(12, 'Pulpen', 'Pulpen', '28e3e43047eb219daa536f0b40fe9d042b7590fc', '2025-06-18', 'Pulpen', '123456', 'sudetlin.sugito@kpn-corp.com', 'Pulpen.jpg'),
(13, 'BPA', 'BPA', 'caa794d12745f41d228742b15c659a79c1326c20', '2025-06-23', 'BPA', '123', 'sudetlin.sugito@kpn-corp.com', 'BPA.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `no_transaksi` int(5) NOT NULL,
  `alamat_asal` text NOT NULL,
  `alamat_tujuan` text NOT NULL,
  `penerima` varchar(70) NOT NULL,
  `pengirim` varchar(70) NOT NULL,
  `gambar_awal` varchar(255) NOT NULL,
  `gambar_akhir` varchar(255) NOT NULL,
  `kurir` varchar(70) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `no_hp_penerima` varchar(12) NOT NULL,
  `foto_barang` varchar(255) DEFAULT NULL,
  `waktu` text NOT NULL,
  `status` varchar(25) NOT NULL,
  `penilaian` int(3) NOT NULL,
  `komentar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`no_transaksi`, `alamat_asal`, `alamat_tujuan`, `penerima`, `pengirim`, `gambar_awal`, `gambar_akhir`, `kurir`, `nama_barang`, `no_hp_penerima`, `foto_barang`, `waktu`, `status`, `penilaian`, `komentar`) VALUES
(48, 'Card', 'Card', 'Card', '7', 'images/diambil/48_1753862870_531172c4-6694-4865-930e-6c646ac305f3.png', 'images/selesai/48_1753863969_KPN PROPERTI (2).png', '8', 'Card', 'Card', '1753862759_WhatsApp Image 2025-07-30 at 09.16.40_fc71f2aa.jpg', 'Pengiriman Dibuat &nbsp&nbsp&nbsp(30-07-2025 15:05:59)<br>Penjemputan Barang &nbsp;&nbsp;(30-07-2025 15:07:22)<br>Proses Pengiriman &nbsp&nbsp&nbsp(30-07-2025 15:07:50)<br>Terkirim &nbsp&nbsp&nbsp(30-07-2025 15:26:09)', 'Terkirim', 5, 'bintang 5'),
(49, 'K', 'K', 'K', '7', 'images/diambil/49_1753871678_Nastari.png', 'images/selesai/49_1753871737_Official Wallpaper.png', '8', 'K', 'K', '1753871604_1000165047.jpg', 'Pengiriman Dibuat &nbsp&nbsp&nbsp(30-07-2025 17:33:24)<br>Penjemputan Barang &nbsp;&nbsp;(30-07-2025 17:34:13)<br>Proses Pengiriman &nbsp&nbsp&nbsp(30-07-2025 17:34:38)<br>Terkirim &nbsp&nbsp&nbsp(30-07-2025 17:35:37)', 'Terkirim', 4, 'Ok'),
(50, '41', '46', 'Novy', '7', 'images/diambil/50_1754020926_Official Wallpaper.png', 'images/selesai/50_1754021038_Official Wallpaper.png', '8', 'Permen', '081283212121', '1754019091_Picture1.jpg', 'Pengiriman Dibuat &nbsp&nbsp&nbsp(01-08-2025 10:31:31)<br>Penjemputan Barang &nbsp;&nbsp;(01-08-2025 11:01:45)<br>Proses Pengiriman &nbsp&nbsp&nbsp(01-08-2025 11:02:06)<br>Terkirim &nbsp&nbsp&nbsp(01-08-2025 11:03:58)', 'Terkirim', 0, ''),
(51, 'r', 'r', 'r', '7', '', '', '', 'r', 'r', '1754022419_Picture1.jpg', 'Pengiriman Dibuat &nbsp&nbsp&nbsp(01-08-2025 11:26:59)', 'Belum Terkirim', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username_admin` (`username_admin`);

--
-- Indeks untuk tabel `tb_kurir`
--
ALTER TABLE `tb_kurir`
  ADD PRIMARY KEY (`id_kurir`),
  ADD UNIQUE KEY `username_kurir` (`username_kurir`);

--
-- Indeks untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD UNIQUE KEY `username_pelanggan` (`username_pelanggan`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`no_transaksi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_kurir`
--
ALTER TABLE `tb_kurir`
  MODIFY `id_kurir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `no_transaksi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

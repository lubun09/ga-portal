-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 15, 2025 at 07:53 AM
-- Server version: 10.11.13-MariaDB-0ubuntu0.24.04.1
-- PHP Version: 8.3.6

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
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(10) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `username_admin` varchar(50) NOT NULL,
  `email_admin` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama_admin`, `username_admin`, `email_admin`, `password`, `gambar`, `created_at`, `updated_at`) VALUES
(6, 'Sudetlin', 'Sudetlin', 'sudetlin@gmail.com', 'ffbd25dcd178430842a2aeb4e6228a6dc45b05da', 'Sudetlin.jpg', '2025-08-27 10:44:35', '2025-08-27 10:44:35');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kurir`
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
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_kurir`
--

INSERT INTO `tb_kurir` (`id_kurir`, `nama_kurir`, `username_kurir`, `password`, `tanggal_lahir_kurir`, `alamat`, `no_hp_kurir`, `email_kurir`, `no_plat`, `gambar`, `created_at`, `updated_at`) VALUES
(12, 'Mesenger1', 'Mesenger1', '90f380b3994f80057b79f8d01d33c2fb9d1b2da5', '2025-09-01', 'Gama Tower KPN', '0812********', 'Mai@mail.com', 'B 1234 BB', 'Mesenger1.png', '2025-09-08 04:52:18', '2025-09-08 04:52:18'),
(13, 'Tarmono', '01110080002', '255171f442a2cc4a0d1f9b0ac98f85e2fec7a725', '1983-07-13', 'Gama Tower', '087876003933', 'tarmono130783@gmail.com', 'Mono', '01110080002.jpg', '2025-09-09 03:33:06', '2025-09-09 03:33:06'),
(14, 'Dody Firmansyah', '01116030002', 'b71e6db5e4e08ce9153273c845d39f606d073789', '2025-09-01', 'Gama Tower', '088291429151', 'dodyfirmansyah84@gmail.com', 'BB', '01116030002.jpg', '2025-09-11 08:21:05', '2025-09-12 02:16:38');

-- --------------------------------------------------------

--
-- Table structure for table `tb_notifikasi`
--

CREATE TABLE `tb_notifikasi` (
  `id_notif` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `pesan` varchar(255) NOT NULL,
  `status` enum('unread','read') DEFAULT 'unread',
  `tanggal` datetime DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_notifikasi`
--

INSERT INTO `tb_notifikasi` (`id_notif`, `id_pelanggan`, `pesan`, `status`, `tanggal`, `created_at`, `updated_at`) VALUES
(146, 6, 'Nomor (#89) Dari Pelanggan.', 'read', '2025-09-03 12:02:32', '2025-09-03 05:02:32', '2025-09-03 05:03:38'),
(147, 17, 'Barang Diambil', 'read', '2025-09-03 12:03:09', '2025-09-03 05:03:09', '2025-09-03 07:26:18'),
(148, 6, 'Barang Diambil', 'read', '2025-09-03 12:03:09', '2025-09-03 05:03:09', '2025-09-03 05:03:39'),
(149, 17, 'Barang Sampai', 'read', '2025-09-03 12:03:49', '2025-09-03 05:03:49', '2025-09-03 06:22:06'),
(150, 6, 'Barang Sampai', 'read', '2025-09-03 12:03:49', '2025-09-03 05:03:49', '2025-09-03 05:04:04'),
(151, 6, 'Nomor (#90) Dari Pelanggan.', 'read', '2025-09-03 14:27:06', '2025-09-03 07:27:06', '2025-09-08 04:22:37'),
(152, 6, 'Nomor (#91) Dari Karyawan1.', 'read', '2025-09-08 11:50:53', '2025-09-08 04:50:53', '2025-09-09 03:26:01'),
(153, 18, 'Barang Diambil', 'read', '2025-09-08 11:55:23', '2025-09-08 04:55:23', '2025-09-08 11:19:39'),
(154, 6, 'Barang Diambil', 'read', '2025-09-08 11:55:23', '2025-09-08 04:55:23', '2025-09-09 03:25:59'),
(155, 18, 'Barang Sampai', 'read', '2025-09-08 11:55:31', '2025-09-08 04:55:31', '2025-09-08 11:19:38'),
(156, 6, 'Barang Sampai', 'read', '2025-09-08 11:55:31', '2025-09-08 04:55:31', '2025-09-09 03:25:57'),
(157, 6, 'Nomor (#92) Dari Karyawan1.', 'read', '2025-09-08 11:58:16', '2025-09-08 04:58:16', '2025-09-09 03:25:51'),
(158, 18, 'Barang Diambil', 'read', '2025-09-08 11:58:51', '2025-09-08 04:58:51', '2025-09-08 11:19:36'),
(159, 6, 'Barang Diambil', 'read', '2025-09-08 11:58:51', '2025-09-08 04:58:51', '2025-09-09 03:25:56'),
(160, 18, 'Barang Sampai', 'read', '2025-09-08 11:59:06', '2025-09-08 04:59:06', '2025-09-08 11:19:34'),
(161, 6, 'Barang Sampai', 'read', '2025-09-08 11:59:06', '2025-09-08 04:59:06', '2025-09-09 03:25:55'),
(162, 6, 'Nomor (#93) Dari Karyawan2.', 'read', '2025-09-08 13:42:59', '2025-09-08 06:42:59', '2025-09-09 03:25:48'),
(163, 19, 'Barang Diambil', 'unread', '2025-09-08 13:44:24', '2025-09-08 06:44:24', '2025-09-08 06:44:24'),
(164, 6, 'Barang Diambil', 'read', '2025-09-08 13:44:24', '2025-09-08 06:44:24', '2025-09-09 03:25:54'),
(165, 19, 'Barang Sampai', 'unread', '2025-09-08 13:44:41', '2025-09-08 06:44:41', '2025-09-08 06:44:41'),
(166, 6, 'Barang Sampai', 'read', '2025-09-08 13:44:41', '2025-09-08 06:44:41', '2025-09-09 03:25:52'),
(167, 6, 'Nomor (#94) Dari Karyawan1.', 'read', '2025-09-11 15:23:04', '2025-09-11 08:23:04', '2025-09-11 10:47:17'),
(168, 18, 'Barang Diambil', 'read', '2025-09-11 15:28:58', '2025-09-11 08:28:58', '2025-09-11 10:19:46'),
(169, 6, 'Barang Diambil', 'read', '2025-09-11 15:28:58', '2025-09-11 08:28:58', '2025-09-11 10:47:14'),
(170, 6, 'Nomor (#95) Dari Karyawan1.', 'read', '2025-09-11 15:29:38', '2025-09-11 08:29:38', '2025-09-11 10:47:11'),
(171, 18, 'Barang Sampai', 'read', '2025-09-11 15:34:37', '2025-09-11 08:34:37', '2025-09-11 10:19:45'),
(172, 6, 'Barang Sampai', 'read', '2025-09-11 15:34:37', '2025-09-11 08:34:37', '2025-09-11 10:47:22'),
(173, 18, 'Barang Diambil', 'read', '2025-09-11 15:34:57', '2025-09-11 08:34:57', '2025-09-11 10:19:38'),
(174, 6, 'Barang Diambil', 'read', '2025-09-11 15:34:57', '2025-09-11 08:34:57', '2025-09-11 10:47:19'),
(175, 18, 'Barang Sampai', 'read', '2025-09-11 15:36:12', '2025-09-11 08:36:12', '2025-09-11 10:19:44'),
(176, 6, 'Barang Sampai', 'read', '2025-09-11 15:36:12', '2025-09-11 08:36:12', '2025-09-11 10:47:23'),
(177, 6, 'Nomor (#96) Dari Karyawan1.', 'read', '2025-09-11 15:38:37', '2025-09-11 08:38:37', '2025-09-11 09:44:08'),
(178, 18, 'Barang Sampai', 'read', '2025-09-11 15:43:25', '2025-09-11 08:43:25', '2025-09-11 10:19:36'),
(179, 6, 'Barang Sampai', 'read', '2025-09-11 15:43:25', '2025-09-11 08:43:25', '2025-09-11 10:47:20'),
(180, 6, 'Nomor (#97) Dari Novy Leny Dharyanti.', 'unread', '2025-09-12 09:39:23', '2025-09-12 02:39:23', '2025-09-12 02:39:23'),
(181, 6, 'Nomor (#98) Dari Novy Leny Dharyanti.', 'unread', '2025-09-12 09:44:20', '2025-09-12 02:44:20', '2025-09-12 02:44:20'),
(182, 20, 'Barang Diambil', 'unread', '2025-09-12 09:46:24', '2025-09-12 02:46:24', '2025-09-12 02:46:24'),
(183, 6, 'Barang Diambil', 'unread', '2025-09-12 09:46:24', '2025-09-12 02:46:24', '2025-09-12 02:46:24'),
(184, 6, 'Nomor (#99) Dari Novy Leny Dharyanti.', 'unread', '2025-09-12 09:48:26', '2025-09-12 02:48:26', '2025-09-12 02:48:26'),
(185, 6, 'Nomor (#100) Dari Novy Leny Dharyanti.', 'unread', '2025-09-12 09:51:25', '2025-09-12 02:51:25', '2025-09-12 02:51:25'),
(186, 20, 'Barang Diambil', 'unread', '2025-09-12 09:56:32', '2025-09-12 02:56:32', '2025-09-12 02:56:32'),
(187, 6, 'Barang Diambil', 'unread', '2025-09-12 09:56:32', '2025-09-12 02:56:32', '2025-09-12 02:56:32'),
(188, 20, 'Barang Sampai', 'unread', '2025-09-12 09:57:58', '2025-09-12 02:57:58', '2025-09-12 02:57:58'),
(189, 6, 'Barang Sampai', 'unread', '2025-09-12 09:57:58', '2025-09-12 02:57:58', '2025-09-12 02:57:58'),
(190, 20, 'Barang Sampai', 'unread', '2025-09-12 09:58:04', '2025-09-12 02:58:04', '2025-09-12 02:58:04'),
(191, 6, 'Barang Sampai', 'unread', '2025-09-12 09:58:04', '2025-09-12 02:58:04', '2025-09-12 02:58:04'),
(192, 20, 'Barang Sampai', 'unread', '2025-09-12 10:56:26', '2025-09-12 03:56:26', '2025-09-12 03:56:26'),
(193, 6, 'Barang Sampai', 'unread', '2025-09-12 10:56:26', '2025-09-12 03:56:26', '2025-09-12 03:56:26'),
(194, 6, 'Nomor (#101) Dari Novy Leny Dharyanti.', 'unread', '2025-09-12 11:12:11', '2025-09-12 04:12:11', '2025-09-12 04:12:11'),
(195, 20, 'Barang Diambil', 'unread', '2025-09-12 14:09:19', '2025-09-12 07:09:19', '2025-09-12 07:09:19'),
(196, 6, 'Barang Diambil', 'unread', '2025-09-12 14:09:19', '2025-09-12 07:09:19', '2025-09-12 07:09:19'),
(197, 20, 'Barang Sampai', 'unread', '2025-09-12 16:13:33', '2025-09-12 09:13:33', '2025-09-12 09:13:33'),
(198, 6, 'Barang Sampai', 'unread', '2025-09-12 16:13:33', '2025-09-12 09:13:33', '2025-09-12 09:13:33'),
(199, 6, 'Nomor (#102) Dari Karyawan1.', 'unread', '2025-09-12 16:42:22', '2025-09-12 09:42:22', '2025-09-12 09:42:22'),
(200, 6, 'Nomor (#103) Dari Karyawan1.', 'unread', '2025-09-12 18:03:13', '2025-09-12 11:03:13', '2025-09-12 11:03:13'),
(201, 6, 'Nomor (#104) Dari Karyawan1.', 'unread', '2025-09-12 18:10:56', '2025-09-12 11:10:56', '2025-09-12 11:10:56'),
(202, 18, 'Barang Diambil', 'unread', '2025-09-12 18:33:14', '2025-09-12 11:33:14', '2025-09-12 11:33:14'),
(203, 6, 'Barang Diambil', 'unread', '2025-09-12 18:33:14', '2025-09-12 11:33:14', '2025-09-12 11:33:14'),
(204, 18, 'Barang Sampai', 'unread', '2025-09-12 18:34:04', '2025-09-12 11:34:04', '2025-09-12 11:34:04'),
(205, 6, 'Barang Sampai', 'unread', '2025-09-12 18:34:04', '2025-09-12 11:34:04', '2025-09-12 11:34:04'),
(206, 18, 'Barang Diambil', 'unread', '2025-09-12 18:36:37', '2025-09-12 11:36:37', '2025-09-12 11:36:37'),
(207, 6, 'Barang Diambil', 'unread', '2025-09-12 18:36:37', '2025-09-12 11:36:37', '2025-09-12 11:36:37'),
(208, 18, 'Barang Sampai', 'unread', '2025-09-12 18:36:45', '2025-09-12 11:36:45', '2025-09-12 11:36:45'),
(209, 6, 'Barang Sampai', 'unread', '2025-09-12 18:36:45', '2025-09-12 11:36:45', '2025-09-12 11:36:45'),
(210, 6, 'Nomor (#105) Dari Novy Leny Dharyanti.', 'unread', '2025-09-15 09:56:15', '2025-09-15 02:56:15', '2025-09-15 02:56:15'),
(211, 6, 'Nomor (#106) Dari Novy Leny Dharyanti.', 'unread', '2025-09-15 10:28:49', '2025-09-15 03:28:49', '2025-09-15 03:28:49'),
(212, 6, 'Nomor (#107) Dari Novy Leny Dharyanti.', 'unread', '2025-09-15 12:57:08', '2025-09-15 05:57:08', '2025-09-15 05:57:08');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
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
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `nama_pelanggan`, `username_pelanggan`, `password`, `tanggal_lahir`, `alamat_pelanggan`, `no_hp_pelanggan`, `email_pelanggan`, `gambar`, `created_at`, `updated_at`) VALUES
(18, 'Karyawan1', 'Karyawan1', '0a1b75f8b675247ebc25be9de2af55ff5a5860e3', '2025-09-01', 'Karyawan1', '123456', '123@mail.com', 'Karyawan1_1757306700.png', '2025-09-08 04:45:00', '2025-09-08 04:45:00'),
(19, 'Karyawan2', 'Karyawan2', 'c344c8e4a54cb78a3173583cdf1bc67cb49d940c', '2025-09-01', 'Karyawan2', 'Karyawan2', 'Karyawan2@m.com', 'Karyawan2_1757306761.png', '2025-09-08 04:46:01', '2025-09-08 04:46:01'),
(20, 'Novy Leny Dharyanti', '01113080002', '8c1d1d2a80d72066bbeef06bf7102404bb0cf7e6', '1990-11-30', 'Gama Tower', '083804603148', 'novy.leny@kpn-corp.com', '01113080002_1757389032.jpg', '2025-09-09 03:37:12', '2025-09-09 03:37:12');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `no_transaksi` int(5) NOT NULL,
  `alamat_asal` text NOT NULL,
  `alamat_tujuan` text NOT NULL,
  `penerima` varchar(70) NOT NULL,
  `pengirim` varchar(70) NOT NULL,
  `gambar_awal` varchar(255) NOT NULL DEFAULT '',
  `gambar_akhir` varchar(255) NOT NULL DEFAULT '',
  `kurir` int(11) NOT NULL DEFAULT 0,
  `nama_barang` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `no_hp_penerima` varchar(12) NOT NULL,
  `foto_barang` varchar(255) DEFAULT NULL,
  `waktu` text NOT NULL,
  `status` varchar(25) NOT NULL,
  `email_sent` tinyint(1) DEFAULT 0,
  `penilaian` int(11) NOT NULL DEFAULT 0,
  `komentar` text NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`no_transaksi`, `alamat_asal`, `alamat_tujuan`, `penerima`, `pengirim`, `gambar_awal`, `gambar_akhir`, `kurir`, `nama_barang`, `deskripsi`, `no_hp_penerima`, `foto_barang`, `waktu`, `status`, `email_sent`, `penilaian`, `komentar`, `created_at`, `updated_at`) VALUES
(97, 'Gama Tower, Daerah Khusus Ibukota Jakarta, Indonesia	', 'Arandra Residences', 'Mba Bellinda', '20', '97_1757645184_17576450768007563930176385287896.jpg', '97_1757649386_17576493702188729648618548005578.jpg', 14, 'Dokumen ( Invoice Obaja: 0525029263, PT. BSRI & Entertainment: Michael Bank Relation,102.000 PT.BSRI)) ', NULL, '085329310396', '1757644763_WhatsApp Image 2025-09-12 at 09.28.24.jpeg', 'Pengiriman Dibuat &nbsp;&nbsp;&nbsp;(12-09-2025 09:39:23)<br>Penjemputan Barang &nbsp;&nbsp;(12-09-2025 09:44:26)<br>Proses Pengiriman &nbsp;&nbsp;(12-09-2025 09:46:24)<br>Terkirim &nbsp;&nbsp;(12-09-2025 10:56:26)', 'Terkirim', 1, 0, '', '2025-09-12 02:39:23', '2025-09-15 03:14:49'),
(98, 'Gama Tower, Daerah Khusus Ibukota Jakarta, Indonesia	', 'Arandra Residence', 'Ibu Anggelina', '20', 'WhatsApp Image 2025-09-15 at 10.11.37_7fe13992.jpg', 'WhatsApp Image 2025-09-15 at 10.11.37_7fe13992.jpg', 14, 'Dokumen Deklarasi 3931/SPPD-HRD/VIII/2025,3959/SPPD-HRD/VIII/2025,3958/SPPD-HRD/VIII/2025', NULL, '08113559680', '1757645060_WhatsApp Image 2025-09-12 at 09.30.12.jpeg', 'Pengiriman Dibuat &nbsp;&nbsp;&nbsp;(12-09-2025 11:12:11)<br>Penjemputan Barang &nbsp;&nbsp;(12-09-2025 14:08:52)<br>Proses Pengiriman &nbsp;&nbsp;(12-09-2025 14:09:19)<br>Terkirim &nbsp;&nbsp;(12-09-2025 16:13:33)', 'Terkirim', 1, 0, '', '2025-09-12 02:44:20', '2025-09-15 03:18:41'),
(99, 'Atria Edelweis\r\nGama Tower lt 43', 'PT. Hijau Semesta Maju\r\nJL Telepon Kota No 5 RT. 6/ RW.2\r\nKel: Roa Malaka, Kec: Tambora. JAKBAR. DKI Jakarta', 'Ibu Septi', '20', '100_1757645792_IMG20250912094759.jpg', 'WhatsApp Image 2025-09-12 at 16.32.00_237768f4.jpg', 13, 'Dokumen', NULL, '08990789372', '1757645306_WhatsApp Image 2025-09-12 at 09.46.39.jpeg', 'Pengiriman Dibuat &nbsp;&nbsp;&nbsp;(12-09-2025 11:12:11)<br>Penjemputan Barang &nbsp;&nbsp;(12-09-2025 14:08:52)<br>Proses Pengiriman &nbsp;&nbsp;(12-09-2025 14:09:19)<br>Terkirim &nbsp;&nbsp;(12-09-2025 16:13:33)', 'Terkirim', 1, 0, '', '2025-09-12 02:48:26', '2025-09-12 09:32:56'),
(100, 'PT. Energi Unggul Persada\r\nGama Tower Lt. 41\r\n', 'PT. PP London Sumatra Indonesia\r\nSudirman Plaza, Indofood Tower Lt 11\r\nJL. Jenderal Sudirman Kav 76-78. Setiabudi. Jaksel', '-', '20', '100_1757645792_IMG20250912094759.jpg', 'WhatsApp Image 2025-09-12 at 16.32.00_cd05cc2b.jpg', 13, 'Dokumen', NULL, '081391679067', '1757645485_WhatsApp Image 2025-09-12 at 09.48.50.jpeg', 'Pengiriman Dibuat &nbsp;&nbsp;&nbsp;(12-09-2025 11:12:11)<br>Penjemputan Barang &nbsp;&nbsp;(12-09-2025 14:08:52)<br>Proses Pengiriman &nbsp;&nbsp;(12-09-2025 14:09:19)<br>Terkirim &nbsp;&nbsp;(12-09-2025 16:13:33)', 'Terkirim', 1, 5, 'Exelente', '2025-09-12 02:51:25', '2025-09-12 09:52:12'),
(101, 'Nita ERP\r\nGama Tower Lt 46', 'PT. Wilmar Consultancy Services\r\nMultivision Tower Lt. 10\r\nJL Kuningan Mulia Kav 9b', 'Mr. William Teddy', '20', '101_1757660959_17576609376427836104757867254128.jpg', 'WhatsApp Image 2025-09-12 at 16.16.00_283df7cc.jpg', 14, 'Dokumen ( Request For Solution Regarding SAP S4 Hana Version 1809 to SAP 2023', NULL, '-', '1757650331_WhatsApp Image 2025-09-12 at 10.57.01.jpeg', 'Pengiriman Dibuat &nbsp;&nbsp;&nbsp;(12-09-2025 11:12:11)<br>Penjemputan Barang &nbsp;&nbsp;(12-09-2025 14:08:52)<br>Proses Pengiriman &nbsp;&nbsp;(12-09-2025 14:09:19)<br>Terkirim &nbsp;&nbsp;(12-09-2025 16:13:33)', 'Terkirim', 1, 5, 'oke', '2025-09-12 04:12:11', '2025-09-15 06:32:15'),
(105, 'Gama Tower, Daerah Khusus Ibukota Jakarta, Indonesia', 'Apartemen Arandra Residence', 'Mba Bellinda', '20', '', '', 14, 'Dokumen', 'Deklarasi ( 3691/SPPD-HRD/VIII/2025 AN Farhan & 3696/SPPD-HRD/VIII/2025 an Dickson Fernandez)\r\n', '085329310396', '1757904975_WhatsApp Image 2025-09-15 at 09.53.01 (1).jpeg', 'Pengiriman Dibuat &nbsp;&nbsp;&nbsp;(15-09-2025 09:56:15)<br>Penjemputan Barang &nbsp;&nbsp;(15-09-2025 10:00:01)', 'Penjemputan Barang', 1, 0, '', '2025-09-15 02:56:15', '2025-09-15 03:00:05'),
(106, 'Gama Tower, Daerah Khusus Ibukota Jakarta, Indonesia', 'PT. XCMG GROUP INDONESIA\r\nGold Coast Office Tower eiffel lt 8 unit G,H,J,K,L,M\r\nJl Pantai Indah Kapuk, Kamal Muara', 'Ibu Felicia', '20', '', '', 0, 'Dokumen', 'From: Andi Steven', '08998405291', '1757906929_WhatsApp Image 2025-09-15 at 10.23.35.jpeg', 'Pengiriman Dibuat &nbsp;&nbsp;&nbsp;(15-09-2025 10:28:49)', 'Belum Terkirim', 1, 0, '', '2025-09-15 03:28:49', '2025-09-15 03:30:05'),
(107, 'Gama Tower, Daerah Khusus Ibukota Jakarta, Indonesia', 'PT. BANK MAndiri.\r\nPlaza Mandiri GF. JL Jendral Gatot Subroto Kav 36-38', 'Armiyanti Lubis', '20', '', '', 14, 'Dokumen', 'Dokumen perpanjangan Fasilitas Treasury Line', '-', '1757915828_WhatsApp Image 2025-09-15 at 12.53.32.jpeg', 'Pengiriman Dibuat &nbsp;&nbsp;&nbsp;(15-09-2025 12:57:08)<br>Penjemputan Barang &nbsp;&nbsp;(15-09-2025 13:28:12)', 'Penjemputan Barang', 1, 0, '', '2025-09-15 05:57:08', '2025-09-15 06:28:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username_admin` (`username_admin`);

--
-- Indexes for table `tb_kurir`
--
ALTER TABLE `tb_kurir`
  ADD PRIMARY KEY (`id_kurir`),
  ADD UNIQUE KEY `username_kurir` (`username_kurir`);

--
-- Indexes for table `tb_notifikasi`
--
ALTER TABLE `tb_notifikasi`
  ADD PRIMARY KEY (`id_notif`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD UNIQUE KEY `username_pelanggan` (`username_pelanggan`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`no_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_kurir`
--
ALTER TABLE `tb_kurir`
  MODIFY `id_kurir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_notifikasi`
--
ALTER TABLE `tb_notifikasi`
  MODIFY `id_notif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `no_transaksi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

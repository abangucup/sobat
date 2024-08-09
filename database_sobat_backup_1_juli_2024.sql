-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 01, 2024 at 12:56 AM
-- Server version: 10.6.16-MariaDB-cll-lve
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `n1577750_sobat`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun_distributors`
--

CREATE TABLE `akun_distributors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `distributor_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `akun_distributors`
--

INSERT INTO `akun_distributors` (`id`, `distributor_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2024-03-08 22:07:08', '2024-03-08 22:07:08'),
(2, 2, 8, '2024-03-09 07:51:20', '2024-03-09 07:51:20'),
(3, 1, 9, '2024-06-05 21:29:05', '2024-06-05 21:29:05'),
(4, 3, 10, '2024-06-06 01:21:16', '2024-06-06 01:21:16');

-- --------------------------------------------------------

--
-- Table structure for table `biodatas`
--

CREATE TABLE `biodatas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `jenis_kelamin` enum('l','p') DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `biodatas`
--

INSERT INTO `biodatas` (`id`, `nama_lengkap`, `slug`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `no_hp`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'Windy Gudang', 'windy-gudang', 'l', '2024-03-09', 'Batudaa', '6285397916024', NULL, '2024-03-08 22:07:07', '2024-03-08 22:07:07'),
(2, 'Windy Distributor', 'windy-distributor', 'l', '2024-03-09', 'Batudaa', '6285397916024', NULL, '2024-03-08 22:07:07', '2024-03-08 22:07:07'),
(3, 'Windy Pelayanan', 'windy-pelayanan', 'p', '2024-03-09', 'Batudaa', '6285397916024', NULL, '2024-03-08 22:07:07', '2024-03-08 22:07:07'),
(4, 'Windy Depo', 'windy-depo', 'p', '2024-03-09', 'Batudaa', '6285397916024', NULL, '2024-03-08 22:07:07', '2024-03-08 22:07:07'),
(5, 'PPK Windy', 'ppk-windy', 'l', '2024-03-09', 'Batudaa', '6285397916024', NULL, '2024-03-08 22:07:07', '2024-03-08 22:07:07'),
(6, 'Direktur Windy', 'direktur-windy', 'l', '2024-03-09', 'Batudaa', '6285397916024', NULL, '2024-03-08 22:07:07', '2024-03-08 22:07:07'),
(7, 'Windy Poli', 'windy-poli', 'l', '2024-03-09', 'Batudaa', '6285397916024', NULL, '2024-03-08 22:07:07', '2024-03-08 22:07:07'),
(8, 'mances', 'mances', NULL, NULL, NULL, '082154488769', NULL, '2024-03-09 07:51:20', '2024-03-09 07:51:20'),
(13, 'Windy Karim', 'windy-karim', 'p', '2000-01-01', 'Batudaa', '0821423123', NULL, '2024-03-16 05:27:52', '2024-03-16 05:27:52'),
(14, 'bella', 'bella', 'p', '2021-11-20', 'JL. DJ PARABUAT', '082133445566', NULL, '2024-03-19 15:59:10', '2024-03-19 15:59:10'),
(15, 'Risma Aulia', 'risma-aulia', 'p', '2001-01-06', 'jl.jeruk', '08234567819', NULL, '2024-06-05 21:29:05', '2024-06-05 21:29:05'),
(16, 'NIA LUMA', 'nia-luma', NULL, NULL, NULL, '082134217899', NULL, '2024-06-06 01:21:16', '2024-06-06 01:21:16'),
(17, 'Nia Luma', 'nia-luma', 'p', '2002-02-06', 'Jl.Raya Batudaa', '0821987689', NULL, '2024-06-06 02:53:54', '2024-06-06 02:53:54');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanans`
--

CREATE TABLE `detail_pesanans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `obat_id` bigint(20) UNSIGNED NOT NULL,
  `pemesanan_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(10) UNSIGNED NOT NULL,
  `harga_pesanan` double(10,2) NOT NULL,
  `status_pengiriman` enum('dikirim','dibatalkan','ditunda') NOT NULL DEFAULT 'ditunda',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_pesanans`
--

INSERT INTO `detail_pesanans` (`id`, `obat_id`, `pemesanan_id`, `jumlah`, `harga_pesanan`, `status_pengiriman`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 10, 110000.00, 'dikirim', '2024-03-08 22:15:45', '2024-03-10 11:55:09'),
(2, 3, 2, 2, 230000.00, 'dikirim', '2024-03-09 17:34:35', '2024-03-10 22:38:43'),
(3, 2, 2, 10, 110000.00, 'dikirim', '2024-03-09 17:34:35', '2024-03-10 00:01:11'),
(4, 1, 2, 40, 440000.00, 'dikirim', '2024-03-09 17:34:35', '2024-03-10 00:01:26'),
(11, 3, 8, 4, 460000.00, 'dikirim', '2024-03-11 21:57:09', '2024-03-11 22:12:43'),
(12, 2, 8, 10, 310000.00, 'dikirim', '2024-03-11 21:57:09', '2024-03-11 22:05:18'),
(13, 1, 8, 30, 630000.00, 'dikirim', '2024-03-11 21:57:09', '2024-03-11 22:05:57'),
(14, 4, 9, 2, 61000.00, 'dikirim', '2024-03-19 14:50:21', '2024-03-19 15:19:43'),
(15, 6, 10, 4, 122000.00, 'dikirim', '2024-03-19 23:05:26', '2024-03-19 23:11:28'),
(16, 11, 11, 50, 37500.00, 'dikirim', '2024-06-02 21:18:59', '2024-06-02 21:25:51'),
(17, 11, 12, 25, 18750.00, 'dikirim', '2024-06-05 21:10:25', '2024-06-06 02:23:59'),
(18, 12, 13, 15, 11250.00, 'dikirim', '2024-06-06 01:56:12', '2024-06-06 02:19:36'),
(19, 12, 14, 3, 2250.00, 'dikirim', '2024-06-10 00:00:27', '2024-06-10 00:12:15');

-- --------------------------------------------------------

--
-- Table structure for table `distributors`
--

CREATE TABLE `distributors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_perusahaan` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `telepon_perusahaan` varchar(255) DEFAULT NULL,
  `pemilik_perusahaan` varchar(255) DEFAULT NULL,
  `lokasi_perusahaan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `distributors`
--

INSERT INTO `distributors` (`id`, `nama_perusahaan`, `slug`, `telepon_perusahaan`, `pemilik_perusahaan`, `lokasi_perusahaan`, `created_at`, `updated_at`) VALUES
(1, 'PT. KIMIA FARMA', 'pt-kimia-farma', '-', '-', '-', '2024-03-08 22:07:08', '2024-03-08 22:07:08'),
(2, 'PT ALADIN', 'pt-aladin', '1232131232', 'Aladin Jahe Jahe', NULL, '2024-03-09 07:51:20', '2024-03-09 07:51:20'),
(3, 'PT.MILLENIUM', 'ptmillenium', '76843', 'WINDY KARIM', 'JL.PAGUYAMAN KOTA GORONTALO', '2024-06-06 01:21:16', '2024-06-06 01:21:16');

-- --------------------------------------------------------

--
-- Table structure for table `expireds`
--

CREATE TABLE `expireds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stok_obat_id` bigint(20) UNSIGNED NOT NULL,
  `status_pengembalian` enum('pending','disetujui','selesai') NOT NULL DEFAULT 'pending',
  `catatan` text DEFAULT NULL,
  `balasan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expireds`
--

INSERT INTO `expireds` (`id`, `stok_obat_id`, `status_pengembalian`, `catatan`, `balasan`, `created_at`, `updated_at`) VALUES
(1, 8, 'pending', NULL, NULL, '2024-03-14 04:47:59', '2024-03-14 04:47:59'),
(2, 5, 'selesai', NULL, 'Baik petugas akan mengambil barang dan menurkakannya', '2024-03-14 04:58:51', '2024-03-14 19:13:27'),
(3, 7, 'selesai', NULL, NULL, '2024-05-26 03:45:57', '2024-05-26 03:46:13'),
(4, 18, 'pending', NULL, NULL, '2024-06-06 01:44:27', '2024-06-06 01:44:27'),
(5, 26, 'disetujui', 'tukar', 'smo antar', '2024-06-10 00:20:25', '2024-06-10 00:21:31');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(34, '2014_10_12_000000_create_users_table', 1),
(35, '2014_10_12_100000_create_password_resets_table', 1),
(36, '2019_08_19_000000_create_failed_jobs_table', 1),
(37, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(38, '2024_02_04_122313_create_obats_table', 1),
(39, '2024_02_04_122332_create_biodatas_table', 1),
(40, '2024_02_09_181450_create_distributors_table', 1),
(41, '2024_02_10_023220_create_pasiens_table', 1),
(42, '2024_02_10_024020_create_pemeriksaans_table', 1),
(43, '2024_02_10_032250_create_akun_distributors_table', 1),
(44, '2024_02_10_032922_create_stok_obats_table', 1),
(45, '2024_02_10_034221_create_reseps_table', 1),
(46, '2024_02_10_035604_create_pemesanans_table', 1),
(47, '2024_03_02_195958_create_detail_pesanans_table', 1),
(48, '2024_03_06_004415_create_verif_pesanans_table', 1),
(49, '2024_03_08_035102_create_surats_table', 1),
(50, '2024_03_13_153209_create_permintaans_table', 1),
(51, '2024_03_13_235617_create_pemakaian_obats_table', 1),
(52, '2024_03_14_063419_create_expireds_table', 1),
(54, '2024_03_16_191306_create_tebus_obats_table', 2),
(55, '2024_06_30_131444_add_jumlah_stok_isi_to_stok_obats', 3);

-- --------------------------------------------------------

--
-- Table structure for table `obats`
--

CREATE TABLE `obats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_obat` varchar(255) NOT NULL,
  `nama_obat` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `satuan` enum('Kotak (box)','Botol Besar (bottle)','Kemasan (pack)','Karton (carton)','Jerigen (jerry can)','Drum','Bal (bale)') NOT NULL,
  `no_batch` varchar(255) NOT NULL,
  `tanggal_kedaluwarsa` date NOT NULL,
  `kapasitas` varchar(255) DEFAULT NULL,
  `satuan_kapasitas` enum('Tablet (tab)','Kapsul (kap / cps)','Kaplet','Sirup','Krim','Salep','Serbuk','Injeksi','Tetes','Supositoria','Aerosol','Suspensi','Larutan','Ampul','Botol','Tube','Strip','Sachet') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `obats`
--

INSERT INTO `obats` (`id`, `kode_obat`, `nama_obat`, `slug`, `satuan`, `no_batch`, `tanggal_kedaluwarsa`, `kapasitas`, `satuan_kapasitas`, `created_at`, `updated_at`) VALUES
(1, '#BC0727', 'Paracetamol', 'paracetamol', 'Kotak (box)', 'ASD123', '2024-08-09', '5', 'Strip', '2024-03-08 22:15:18', '2024-03-08 22:15:18'),
(2, '#5F5561', 'Betadin', 'betadin', 'Botol Besar (bottle)', 'KDJ123', '2024-08-10', NULL, NULL, '2024-03-09 17:31:36', '2024-03-09 17:31:36'),
(3, '#A4C406', 'AIR RAKSA', 'air-raksa', 'Karton (carton)', '123KSS', '2024-12-10', NULL, NULL, '2024-03-09 17:33:40', '2024-03-10 22:26:18'),
(4, '#E66D03', 'amoxilin', 'amoxilin', 'Kotak (box)', 'am103', '2024-11-30', '500', 'Tablet (tab)', '2024-03-19 14:46:54', '2024-03-19 14:46:54'),
(5, '#698A5E', 'promag', 'promag', 'Kotak (box)', 'po321', '2024-05-21', '2000', 'Tablet (tab)', '2024-03-19 16:12:02', '2024-03-19 16:12:02'),
(6, '#602724', 'mirasic', 'mirasic', 'Kotak (box)', 'm123', '2025-01-20', '100', 'Tablet (tab)', '2024-03-19 16:16:46', '2024-03-19 16:16:46'),
(7, '#E932C2', 'sanmol', 'sanmol', 'Botol Besar (bottle)', 'san123', '2024-03-20', '200', 'Sirup', '2024-03-19 23:00:18', '2024-03-19 23:00:18'),
(8, '#8A1D72', 'bodrex', 'bodrex', 'Kotak (box)', '123bod', '2024-06-30', '20', 'Tablet (tab)', '2024-06-02 20:42:19', '2024-06-02 20:42:19'),
(9, '#897890', 'bodrex', 'bodrex', 'Kotak (box)', '123bod', '2024-06-30', '20', 'Tablet (tab)', '2024-06-02 20:48:26', '2024-06-02 20:48:26'),
(11, '#095F6A', 'carbidu', 'carbidu', 'Kotak (box)', 'car12', '2025-01-03', '1200', 'Tablet (tab)', '2024-06-02 21:15:57', '2024-06-02 21:15:57'),
(12, '#EB4D77', 'Amlodipin 500mg', 'amlodipin-500mg', 'Kotak (box)', '43EA', '2025-07-06', '100', 'Tablet (tab)', '2024-06-06 01:00:17', '2024-06-06 01:00:17');

-- --------------------------------------------------------

--
-- Table structure for table `pasiens`
--

CREATE TABLE `pasiens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_register` varchar(255) NOT NULL,
  `biodata_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pasiens`
--

INSERT INTO `pasiens` (`id`, `no_register`, `biodata_id`, `created_at`, `updated_at`) VALUES
(4, 'rsotanaha-d50f98', 13, '2024-03-16 05:27:52', '2024-03-16 05:27:52'),
(5, 'rsotanaha-9d6d91', 14, '2024-03-19 15:59:10', '2024-03-19 15:59:10'),
(6, 'rsotanaha-809c97', 17, '2024-06-06 02:53:54', '2024-06-06 02:53:54');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemakaian_obats`
--

CREATE TABLE `pemakaian_obats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stok_obat_id` bigint(20) UNSIGNED NOT NULL,
  `banyak` varchar(255) NOT NULL,
  `catatan` text DEFAULT NULL,
  `tanggal_pemakaian` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemakaian_obats`
--

INSERT INTO `pemakaian_obats` (`id`, `stok_obat_id`, `banyak`, `catatan`, `tanggal_pemakaian`, `created_at`, `updated_at`) VALUES
(3, 9, '1', 'Pasien operasi', '2024-03-15', '2024-03-14 22:18:34', '2024-03-14 22:18:34'),
(4, 25, '1', 'kjkj', '2024-06-10', '2024-06-10 00:33:29', '2024-06-10 00:33:29');

-- --------------------------------------------------------

--
-- Table structure for table `pemeriksaans`
--

CREATE TABLE `pemeriksaans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pasien_id` bigint(20) UNSIGNED NOT NULL,
  `diagnosis` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemeriksaans`
--

INSERT INTO `pemeriksaans` (`id`, `pasien_id`, `diagnosis`, `created_at`, `updated_at`) VALUES
(8, 4, 'Infeksi luka bekas kecelakaan', '2024-03-16 11:59:41', '2024-03-16 11:59:41'),
(9, 5, 'flu', '2024-03-19 15:59:58', '2024-03-19 15:59:58'),
(10, 6, 'depresi', '2024-06-06 02:55:20', '2024-06-06 02:55:20');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanans`
--

CREATE TABLE `pemesanans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status_kirim_naskah` enum('terkirim','pending') NOT NULL DEFAULT 'pending',
  `status_verif_ppk` enum('diverifikasi','pending','ditolak') NOT NULL DEFAULT 'pending',
  `status_verif_direktur` enum('diverifikasi','pending','ditolak') NOT NULL DEFAULT 'pending',
  `status_pemesanan` enum('selesai','proses','pending') NOT NULL DEFAULT 'pending',
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemesanans`
--

INSERT INTO `pemesanans` (`id`, `user_id`, `status_kirim_naskah`, `status_verif_ppk`, `status_verif_direktur`, `status_pemesanan`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 'terkirim', 'diverifikasi', 'diverifikasi', 'selesai', NULL, '2024-03-08 22:15:45', '2024-03-11 02:44:51'),
(2, 1, 'terkirim', 'diverifikasi', 'diverifikasi', 'selesai', NULL, '2024-03-09 17:34:35', '2024-03-11 02:44:18'),
(8, 1, 'terkirim', 'diverifikasi', 'diverifikasi', 'selesai', NULL, '2024-03-11 21:57:09', '2024-03-11 22:19:52'),
(9, 1, 'terkirim', 'diverifikasi', 'diverifikasi', 'selesai', NULL, '2024-03-19 14:50:21', '2024-03-19 15:36:34'),
(10, 1, 'terkirim', 'diverifikasi', 'diverifikasi', 'selesai', NULL, '2024-03-19 23:05:26', '2024-03-19 23:13:58'),
(11, 1, 'terkirim', 'diverifikasi', 'diverifikasi', 'selesai', NULL, '2024-06-02 21:18:59', '2024-06-02 21:30:21'),
(12, 1, 'terkirim', 'diverifikasi', 'diverifikasi', 'selesai', NULL, '2024-06-05 21:10:25', '2024-06-06 02:37:13'),
(13, 1, 'terkirim', 'diverifikasi', 'diverifikasi', 'selesai', NULL, '2024-06-06 01:56:12', '2024-06-06 02:36:11'),
(14, 1, 'terkirim', 'diverifikasi', 'diverifikasi', 'selesai', 'Obat Bro', '2024-06-10 00:00:27', '2024-06-10 00:14:11');

-- --------------------------------------------------------

--
-- Table structure for table `permintaans`
--

CREATE TABLE `permintaans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pengaju` bigint(20) UNSIGNED NOT NULL,
  `pemverifikasi` bigint(20) UNSIGNED DEFAULT NULL,
  `stok_obat_id` bigint(20) UNSIGNED NOT NULL,
  `banyak` int(11) NOT NULL,
  `status_permintaan` enum('tunda','ditolak','disetujui','selesai') NOT NULL DEFAULT 'tunda',
  `bidang` enum('pelayanan','depo') NOT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permintaans`
--

INSERT INTO `permintaans` (`id`, `pengaju`, `pemverifikasi`, `stok_obat_id`, `banyak`, `status_permintaan`, `bidang`, `catatan`, `created_at`, `updated_at`) VALUES
(2, 4, 1, 5, 5, 'selesai', 'depo', NULL, '2024-03-13 15:49:13', '2024-03-13 17:39:49'),
(3, 4, 1, 5, 2, 'selesai', 'depo', NULL, '2024-03-13 17:40:42', '2024-03-13 17:41:29'),
(4, 3, 1, 5, 3, 'selesai', 'pelayanan', NULL, '2024-03-13 18:01:47', '2024-03-13 18:02:18'),
(5, 4, 1, 6, 5, 'selesai', 'depo', NULL, '2024-03-14 22:05:06', '2024-03-14 22:05:40'),
(6, 3, 1, 11, 1, 'selesai', 'pelayanan', NULL, '2024-03-19 15:43:19', '2024-03-19 15:45:39'),
(7, 3, 1, 6, 1, 'selesai', 'pelayanan', NULL, '2024-03-19 15:45:06', '2024-06-06 02:47:51'),
(8, 3, 1, 11, 1, 'selesai', 'pelayanan', NULL, '2024-03-19 23:15:10', '2024-03-19 23:16:20'),
(9, 4, 1, 16, 2, 'selesai', 'depo', NULL, '2024-03-19 23:17:05', '2024-06-06 02:47:47'),
(10, 4, 1, 23, 1, 'selesai', 'depo', NULL, '2024-06-06 02:45:11', '2024-06-06 02:47:42');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reseps`
--

CREATE TABLE `reseps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pemeriksaan_id` bigint(20) UNSIGNED NOT NULL,
  `stok_obat_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reseps`
--

INSERT INTO `reseps` (`id`, `pemeriksaan_id`, `stok_obat_id`, `jumlah`, `keterangan`, `created_at`, `updated_at`) VALUES
(5, 8, 8, 1, '2x Sehari dan dibersihkan terlebih dahulu dengan air', '2024-03-16 12:00:04', '2024-03-16 12:00:04'),
(6, 8, 8, 1, '2 Tetes', '2024-03-16 12:39:30', '2024-03-16 12:39:30'),
(7, 9, 12, 1, '2xsehari', '2024-03-19 16:00:41', '2024-03-19 16:00:41'),
(9, 10, 26, 1, '10 x sehari', '2024-06-06 02:57:04', '2024-06-06 02:57:04');

-- --------------------------------------------------------

--
-- Table structure for table `stok_obats`
--

CREATE TABLE `stok_obats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `distributor_id` bigint(20) UNSIGNED NOT NULL,
  `obat_id` bigint(20) UNSIGNED NOT NULL,
  `stok` int(11) NOT NULL,
  `jumlah_stok_isi` int(10) UNSIGNED DEFAULT NULL,
  `harga_beli` double(8,2) NOT NULL,
  `tanggal_beli` date NOT NULL,
  `harga_jual` double(8,2) DEFAULT NULL,
  `lokasi` enum('distributor','gudang','pelayanan','depo') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stok_obats`
--

INSERT INTO `stok_obats` (`id`, `distributor_id`, `obat_id`, `stok`, `jumlah_stok_isi`, `harga_beli`, `tanggal_beli`, `harga_jual`, `lokasi`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 20, NULL, 20000.00, '2024-03-09', 21000.00, 'distributor', '2024-03-08 22:15:18', '2024-03-11 21:57:09'),
(2, 1, 2, 30, NULL, 30000.00, '2024-03-10', 31000.00, 'distributor', '2024-03-09 17:31:36', '2024-03-11 21:57:09'),
(3, 2, 3, 4, NULL, 100000.00, '2024-03-10', 115000.00, 'distributor', '2024-03-09 17:33:40', '2024-03-11 21:57:09'),
(4, 1, 1, 120, NULL, 21000.00, '2024-03-10', 25000.00, 'gudang', '2024-03-10 05:56:48', '2024-03-11 22:15:32'),
(5, 1, 2, 10, NULL, 31000.00, '2024-03-10', 32000.00, 'gudang', '2024-03-10 11:54:26', '2024-03-13 18:01:47'),
(6, 2, 3, 4, NULL, 115000.00, '2024-03-10', NULL, 'gudang', '2024-03-10 22:39:41', '2024-03-19 15:45:06'),
(7, 1, 2, 7, NULL, 31000.00, '2024-03-13', 32000.00, 'depo', '2024-03-13 17:39:49', '2024-03-13 17:41:29'),
(8, 1, 2, 1, NULL, 31000.00, '2024-03-14', 32000.00, 'pelayanan', '2024-03-13 18:02:18', '2024-03-16 19:45:46'),
(9, 2, 3, 4, NULL, 115000.00, '2024-03-15', NULL, 'depo', '2024-03-14 22:05:40', '2024-03-14 22:19:13'),
(10, 1, 4, 3, NULL, 30000.00, '2024-03-20', 30500.00, 'distributor', '2024-03-19 14:46:54', '2024-03-19 14:50:21'),
(11, 1, 4, 0, NULL, 30500.00, '2024-03-19', NULL, 'gudang', '2024-03-19 15:36:34', '2024-03-19 23:15:10'),
(12, 1, 4, 2, NULL, 30500.00, '2024-03-19', NULL, 'pelayanan', '2024-03-19 15:45:39', '2024-06-10 00:35:55'),
(13, 1, 5, 20, NULL, 250000.00, '2023-07-20', 35000.00, 'distributor', '2024-03-19 16:12:02', '2024-03-19 16:12:02'),
(14, 1, 6, 6, NULL, 250000.00, '2024-03-01', 30500.00, 'distributor', '2024-03-19 16:16:46', '2024-03-19 23:05:26'),
(15, 1, 7, 10, NULL, 250000.00, '2024-03-20', 2500.00, 'distributor', '2024-03-19 23:00:18', '2024-03-19 23:00:18'),
(16, 1, 6, 6, NULL, 30500.00, '2024-03-20', NULL, 'gudang', '2024-03-19 23:13:58', '2024-03-19 23:17:05'),
(17, 2, 8, 100, NULL, 750.00, '2024-05-03', 1000.00, 'gudang', '2024-06-02 20:42:19', '2024-06-02 20:42:19'),
(18, 1, 9, 25, NULL, 750.00, '2024-05-03', 1000.00, 'gudang', '2024-06-02 20:48:26', '2024-06-02 20:48:26'),
(20, 1, 11, 25, 30000, 500.00, '2025-02-03', 750.00, 'distributor', '2024-06-02 21:15:57', '2024-06-30 10:47:49'),
(21, 1, 11, 75, NULL, 750.00, '2024-06-03', NULL, 'gudang', '2024-06-02 21:30:21', '2024-06-06 02:37:13'),
(22, 1, 12, 2, 200, 500.00, '2023-10-06', 750.00, 'distributor', '2024-06-06 01:00:17', '2024-06-30 10:48:04'),
(23, 1, 12, 32, NULL, 750.00, '2024-06-06', NULL, 'gudang', '2024-06-06 02:36:11', '2024-06-10 00:14:11'),
(24, 1, 12, 1, NULL, 750.00, '2024-06-06', NULL, 'depo', '2024-06-06 02:47:42', '2024-06-06 02:47:42'),
(25, 1, 6, 1, NULL, 30500.00, '2024-03-20', NULL, 'depo', '2024-06-06 02:47:47', '2024-06-10 00:33:29'),
(26, 2, 3, 0, NULL, 115000.00, '2024-03-19', NULL, 'pelayanan', '2024-06-06 02:47:51', '2024-06-06 02:59:11');

-- --------------------------------------------------------

--
-- Table structure for table `surats`
--

CREATE TABLE `surats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_surat` varchar(255) NOT NULL,
  `pemesanan_id` bigint(20) UNSIGNED NOT NULL,
  `distributor_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surats`
--

INSERT INTO `surats` (`id`, `nomor_surat`, `pemesanan_id`, `distributor_id`, `created_at`, `updated_at`) VALUES
(1, '445/RSUD.O/1/3/2024', 1, 1, '2024-03-08 22:37:50', '2024-03-08 22:37:50'),
(2, '445/RSUD.O/2/3/2024', 2, 2, '2024-03-09 17:35:45', '2024-03-09 17:35:45'),
(3, '445/RSUD.O/3/3/2024', 2, 1, '2024-03-09 17:35:45', '2024-03-09 17:35:45'),
(4, '445/RSUD.O/3/3/2024', 8, 2, '2024-03-11 21:57:20', '2024-03-11 21:57:20'),
(5, '445/RSUD.O/5/3/2024', 8, 1, '2024-03-11 21:57:20', '2024-03-11 21:57:20'),
(6, '445/RSUD.O/5/3/2024', 9, 1, '2024-03-19 15:08:42', '2024-03-19 15:08:42'),
(7, '445/RSUD.O/7/3/2024', 10, 1, '2024-03-19 23:08:40', '2024-03-19 23:08:40'),
(8, '445/RSUD.O/8/6/2024', 11, 1, '2024-06-02 21:22:57', '2024-06-02 21:22:57'),
(9, '445/RSUD.O/9/6/2024', 12, 1, '2024-06-05 21:11:54', '2024-06-05 21:11:54'),
(10, '445/RSUD.O/10/6/2024', 13, 1, '2024-06-06 01:56:33', '2024-06-06 01:56:33'),
(11, '445/RSUD.O/11/6/2024', 14, 1, '2024-06-10 00:01:19', '2024-06-10 00:01:19');

-- --------------------------------------------------------

--
-- Table structure for table `tebus_obats`
--

CREATE TABLE `tebus_obats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pemeriksaan_id` bigint(20) UNSIGNED NOT NULL,
  `status_bayar` enum('lunas','pending') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tebus_obats`
--

INSERT INTO `tebus_obats` (`id`, `pemeriksaan_id`, `status_bayar`, `created_at`, `updated_at`) VALUES
(1, 8, 'lunas', '2024-03-16 11:59:41', '2024-03-16 19:44:41'),
(2, 9, 'lunas', '2024-03-19 15:59:58', '2024-06-10 00:35:55'),
(3, 10, 'lunas', '2024-06-06 02:55:20', '2024-06-06 02:59:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('gudang','distributor','poli','pelayanan','depo','ppk','direktur') NOT NULL,
  `biodata_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `biodata_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'gudang', 'windygudang@gmail.com', '$2y$10$3ydL92lYwFFgEuYiheTQfu76EswyxhorUjldSjx1TCDnTgzAIZmvO', 'gudang', 1, NULL, '2024-03-08 22:07:07', '2024-03-08 22:07:07'),
(2, 'distributor', 'windydistributor@gmail.com', '$2y$10$.X86tyYqKXs7FiUZbG7xfuamfx2Cp93CCA3b9WSIbIbG5edMlPS8G', 'distributor', 2, NULL, '2024-03-08 22:07:07', '2024-03-08 22:07:07'),
(3, 'pelayanan', 'windypelayanan@gmail.com', '$2y$10$QsbNa9E1i4L1SeK/qHSQ3enNyt4tJmLy5SwqtJOS1fogltQaLmnPy', 'pelayanan', 3, NULL, '2024-03-08 22:07:08', '2024-03-08 22:07:08'),
(4, 'depo', 'windydepo@gmail.com', '$2y$10$Lry4q61O.NhJMnsDmWvi3.gijnSCdnkNALlu6a8Q19raCupWs3p3m', 'depo', 4, NULL, '2024-03-08 22:07:08', '2024-03-08 22:07:08'),
(5, 'ppk', 'windyppk@gmail.com', '$2y$10$FbhNb6ryPqEqsGd0em3D4uWMSF8GXs3Wr8eXz.AkyFe5A7/7oVOb6', 'ppk', 5, NULL, '2024-03-08 22:07:08', '2024-03-08 22:07:08'),
(6, 'direktur', 'windydirektur@gmail.com', '$2y$10$ab9ylOHKBBAiw6cN6WHB/.9IkRyaNOzFXV4unxiOIsPg4t.g8qlqy', 'direktur', 6, NULL, '2024-03-08 22:07:08', '2024-03-08 22:07:08'),
(7, 'poli', 'windypoli@gmail.com', '$2y$10$p8qKiwsVzrY74y5WEHwAIuqte8lNWUsfCq2KOxuj4AfWIjrUBAIZG', 'poli', 7, NULL, '2024-03-08 22:07:08', '2024-03-08 22:07:08'),
(8, 'mances', NULL, '$2y$10$dbdDssZfntr7NQVDTVPug.f1hCiQPYK8YqWQwSr8Zdb.40xvdwZCK', 'distributor', 8, NULL, '2024-03-09 07:51:20', '2024-03-09 07:51:20'),
(9, 'risma', NULL, '$2y$10$xRCso6rDlUaBsDxyL5wA3.2E12OX/2iKMXdkVUC5V3V38vfPW7P.e', 'distributor', 15, NULL, '2024-06-05 21:29:05', '2024-06-05 21:29:05'),
(10, 'nia', NULL, '$2y$10$WpPgxNIdPGeqViuZco7qJOoidGkruxrx5WHfrgsf3ubOujlR38H56', 'distributor', 16, NULL, '2024-06-06 01:21:16', '2024-06-06 01:21:16');

-- --------------------------------------------------------

--
-- Table structure for table `verif_pesanans`
--

CREATE TABLE `verif_pesanans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pemverifikasi` bigint(20) UNSIGNED NOT NULL,
  `detail_pesanan_id` bigint(20) UNSIGNED NOT NULL,
  `kondisi_pesanan` enum('sesuai','tidak_sesuai') NOT NULL DEFAULT 'tidak_sesuai',
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `verif_pesanans`
--

INSERT INTO `verif_pesanans` (`id`, `pemverifikasi`, `detail_pesanan_id`, `kondisi_pesanan`, `catatan`, `created_at`, `updated_at`) VALUES
(4, 1, 3, 'sesuai', 'Barang lengkap', '2024-03-10 11:54:26', '2024-03-10 11:54:26'),
(5, 1, 1, 'sesuai', 'Sesuai', '2024-03-10 11:56:20', '2024-03-10 11:56:20'),
(6, 1, 2, 'sesuai', 'Sesuai', '2024-03-10 22:39:41', '2024-03-10 22:39:41'),
(7, 1, 4, 'sesuai', 'Sesuai', '2024-03-11 04:25:59', '2024-03-11 04:25:59'),
(8, 1, 13, 'sesuai', 'Barang sesuai', '2024-03-11 22:15:32', '2024-03-11 22:15:32'),
(9, 1, 12, 'sesuai', 'Barang Sesuai', '2024-03-11 22:16:24', '2024-03-11 22:16:24'),
(11, 1, 11, 'sesuai', 'Barang langkap dan sesuai', '2024-03-11 22:19:52', '2024-03-11 22:19:52'),
(12, 1, 14, 'sesuai', NULL, '2024-03-19 15:36:34', '2024-03-19 15:36:34'),
(13, 1, 15, 'sesuai', NULL, '2024-03-19 23:13:58', '2024-03-19 23:13:58'),
(14, 1, 15, 'sesuai', NULL, '2024-03-19 23:13:58', '2024-03-19 23:13:58'),
(15, 1, 16, 'sesuai', NULL, '2024-06-02 21:30:21', '2024-06-02 21:30:21'),
(16, 1, 18, 'sesuai', NULL, '2024-06-06 02:36:11', '2024-06-06 02:36:11'),
(17, 1, 18, 'sesuai', NULL, '2024-06-06 02:36:12', '2024-06-06 02:36:12'),
(18, 1, 17, 'sesuai', NULL, '2024-06-06 02:37:13', '2024-06-06 02:37:13'),
(19, 1, 19, 'sesuai', 'OKe', '2024-06-10 00:14:11', '2024-06-10 00:14:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun_distributors`
--
ALTER TABLE `akun_distributors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `akun_distributors_distributor_id_foreign` (`distributor_id`),
  ADD KEY `akun_distributors_user_id_foreign` (`user_id`);

--
-- Indexes for table `biodatas`
--
ALTER TABLE `biodatas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_pesanans`
--
ALTER TABLE `detail_pesanans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_pesanans_obat_id_foreign` (`obat_id`),
  ADD KEY `detail_pesanans_pemesanan_id_foreign` (`pemesanan_id`);

--
-- Indexes for table `distributors`
--
ALTER TABLE `distributors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expireds`
--
ALTER TABLE `expireds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expireds_stok_obat_id_foreign` (`stok_obat_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obats`
--
ALTER TABLE `obats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `obats_kode_obat_unique` (`kode_obat`);

--
-- Indexes for table `pasiens`
--
ALTER TABLE `pasiens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pasiens_no_register_unique` (`no_register`),
  ADD KEY `pasiens_biodata_id_foreign` (`biodata_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pemakaian_obats`
--
ALTER TABLE `pemakaian_obats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemakaian_obats_stok_obat_id_foreign` (`stok_obat_id`);

--
-- Indexes for table `pemeriksaans`
--
ALTER TABLE `pemeriksaans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemeriksaans_pasien_id_foreign` (`pasien_id`);

--
-- Indexes for table `pemesanans`
--
ALTER TABLE `pemesanans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemesanans_user_id_foreign` (`user_id`);

--
-- Indexes for table `permintaans`
--
ALTER TABLE `permintaans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permintaans_stok_obat_id_foreign` (`stok_obat_id`),
  ADD KEY `permintaans_pengaju_foreign` (`pengaju`),
  ADD KEY `permintaans_pemverifikasi_foreign` (`pemverifikasi`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `reseps`
--
ALTER TABLE `reseps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reseps_pemeriksaan_id_foreign` (`pemeriksaan_id`),
  ADD KEY `reseps_stok_obat_id_foreign` (`stok_obat_id`);

--
-- Indexes for table `stok_obats`
--
ALTER TABLE `stok_obats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stok_obats_distributor_id_foreign` (`distributor_id`),
  ADD KEY `stok_obats_obat_id_foreign` (`obat_id`);

--
-- Indexes for table `surats`
--
ALTER TABLE `surats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surats_pemesanan_id_foreign` (`pemesanan_id`),
  ADD KEY `surats_distributor_id_foreign` (`distributor_id`);

--
-- Indexes for table `tebus_obats`
--
ALTER TABLE `tebus_obats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tebus_obats_pemeriksaan_id_foreign` (`pemeriksaan_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_biodata_id_foreign` (`biodata_id`);

--
-- Indexes for table `verif_pesanans`
--
ALTER TABLE `verif_pesanans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `verif_pesanans_detail_pesanan_id_foreign` (`detail_pesanan_id`),
  ADD KEY `verif_pesanans_pemverifikasi_foreign` (`pemverifikasi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun_distributors`
--
ALTER TABLE `akun_distributors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `biodatas`
--
ALTER TABLE `biodatas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `detail_pesanans`
--
ALTER TABLE `detail_pesanans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `distributors`
--
ALTER TABLE `distributors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expireds`
--
ALTER TABLE `expireds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `obats`
--
ALTER TABLE `obats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pasiens`
--
ALTER TABLE `pasiens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pemakaian_obats`
--
ALTER TABLE `pemakaian_obats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pemeriksaans`
--
ALTER TABLE `pemeriksaans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pemesanans`
--
ALTER TABLE `pemesanans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `permintaans`
--
ALTER TABLE `permintaans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reseps`
--
ALTER TABLE `reseps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `stok_obats`
--
ALTER TABLE `stok_obats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `surats`
--
ALTER TABLE `surats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tebus_obats`
--
ALTER TABLE `tebus_obats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `verif_pesanans`
--
ALTER TABLE `verif_pesanans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akun_distributors`
--
ALTER TABLE `akun_distributors`
  ADD CONSTRAINT `akun_distributors_distributor_id_foreign` FOREIGN KEY (`distributor_id`) REFERENCES `distributors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `akun_distributors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_pesanans`
--
ALTER TABLE `detail_pesanans`
  ADD CONSTRAINT `detail_pesanans_obat_id_foreign` FOREIGN KEY (`obat_id`) REFERENCES `obats` (`id`),
  ADD CONSTRAINT `detail_pesanans_pemesanan_id_foreign` FOREIGN KEY (`pemesanan_id`) REFERENCES `pemesanans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expireds`
--
ALTER TABLE `expireds`
  ADD CONSTRAINT `expireds_stok_obat_id_foreign` FOREIGN KEY (`stok_obat_id`) REFERENCES `stok_obats` (`id`);

--
-- Constraints for table `pasiens`
--
ALTER TABLE `pasiens`
  ADD CONSTRAINT `pasiens_biodata_id_foreign` FOREIGN KEY (`biodata_id`) REFERENCES `biodatas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pemakaian_obats`
--
ALTER TABLE `pemakaian_obats`
  ADD CONSTRAINT `pemakaian_obats_stok_obat_id_foreign` FOREIGN KEY (`stok_obat_id`) REFERENCES `stok_obats` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pemeriksaans`
--
ALTER TABLE `pemeriksaans`
  ADD CONSTRAINT `pemeriksaans_pasien_id_foreign` FOREIGN KEY (`pasien_id`) REFERENCES `pasiens` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pemesanans`
--
ALTER TABLE `pemesanans`
  ADD CONSTRAINT `pemesanans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `permintaans`
--
ALTER TABLE `permintaans`
  ADD CONSTRAINT `permintaans_pemverifikasi_foreign` FOREIGN KEY (`pemverifikasi`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `permintaans_pengaju_foreign` FOREIGN KEY (`pengaju`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `permintaans_stok_obat_id_foreign` FOREIGN KEY (`stok_obat_id`) REFERENCES `stok_obats` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reseps`
--
ALTER TABLE `reseps`
  ADD CONSTRAINT `reseps_pemeriksaan_id_foreign` FOREIGN KEY (`pemeriksaan_id`) REFERENCES `pemeriksaans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reseps_stok_obat_id_foreign` FOREIGN KEY (`stok_obat_id`) REFERENCES `stok_obats` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stok_obats`
--
ALTER TABLE `stok_obats`
  ADD CONSTRAINT `stok_obats_distributor_id_foreign` FOREIGN KEY (`distributor_id`) REFERENCES `distributors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stok_obats_obat_id_foreign` FOREIGN KEY (`obat_id`) REFERENCES `obats` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `surats`
--
ALTER TABLE `surats`
  ADD CONSTRAINT `surats_distributor_id_foreign` FOREIGN KEY (`distributor_id`) REFERENCES `distributors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `surats_pemesanan_id_foreign` FOREIGN KEY (`pemesanan_id`) REFERENCES `pemesanans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tebus_obats`
--
ALTER TABLE `tebus_obats`
  ADD CONSTRAINT `tebus_obats_pemeriksaan_id_foreign` FOREIGN KEY (`pemeriksaan_id`) REFERENCES `pemeriksaans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_biodata_id_foreign` FOREIGN KEY (`biodata_id`) REFERENCES `biodatas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `verif_pesanans`
--
ALTER TABLE `verif_pesanans`
  ADD CONSTRAINT `verif_pesanans_detail_pesanan_id_foreign` FOREIGN KEY (`detail_pesanan_id`) REFERENCES `detail_pesanans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `verif_pesanans_pemverifikasi_foreign` FOREIGN KEY (`pemverifikasi`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

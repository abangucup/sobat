-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: localhost    Database: sobat
-- ------------------------------------------------------
-- Server version	8.0.36-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `akun_distributors`
--

DROP TABLE IF EXISTS `akun_distributors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `akun_distributors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `distributor_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `akun_distributors_distributor_id_foreign` (`distributor_id`),
  KEY `akun_distributors_user_id_foreign` (`user_id`),
  CONSTRAINT `akun_distributors_distributor_id_foreign` FOREIGN KEY (`distributor_id`) REFERENCES `distributors` (`id`) ON DELETE CASCADE,
  CONSTRAINT `akun_distributors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `akun_distributors`
--

LOCK TABLES `akun_distributors` WRITE;
/*!40000 ALTER TABLE `akun_distributors` DISABLE KEYS */;
INSERT INTO `akun_distributors` VALUES (1,1,2,'2024-03-08 22:07:08','2024-03-08 22:07:08'),(2,2,8,'2024-03-09 07:51:20','2024-03-09 07:51:20');
/*!40000 ALTER TABLE `akun_distributors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `biodatas`
--

DROP TABLE IF EXISTS `biodatas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `biodatas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('l','p') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `no_hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `biodatas`
--

LOCK TABLES `biodatas` WRITE;
/*!40000 ALTER TABLE `biodatas` DISABLE KEYS */;
INSERT INTO `biodatas` VALUES (1,'Windy Gudang','windy-gudang','l','2024-03-09','Batudaa','6285397916024',NULL,'2024-03-08 22:07:07','2024-03-08 22:07:07'),(2,'Windy Distributor','windy-distributor','l','2024-03-09','Batudaa','6285397916024',NULL,'2024-03-08 22:07:07','2024-03-08 22:07:07'),(3,'Windy Pelayanan','windy-pelayanan','p','2024-03-09','Batudaa','6285397916024',NULL,'2024-03-08 22:07:07','2024-03-08 22:07:07'),(4,'Windy Depo','windy-depo','p','2024-03-09','Batudaa','6285397916024',NULL,'2024-03-08 22:07:07','2024-03-08 22:07:07'),(5,'PPK Windy','ppk-windy','l','2024-03-09','Batudaa','6285397916024',NULL,'2024-03-08 22:07:07','2024-03-08 22:07:07'),(6,'Direktur Windy','direktur-windy','l','2024-03-09','Batudaa','6285397916024',NULL,'2024-03-08 22:07:07','2024-03-08 22:07:07'),(7,'Windy Poli','windy-poli','l','2024-03-09','Batudaa','6285397916024',NULL,'2024-03-08 22:07:07','2024-03-08 22:07:07'),(8,'mances','mances',NULL,NULL,NULL,'082154488769',NULL,'2024-03-09 07:51:20','2024-03-09 07:51:20'),(13,'Windy Karim','windy-karim','p','2000-01-01','Batudaa','0821423123',NULL,'2024-03-16 05:27:52','2024-03-16 05:27:52');
/*!40000 ALTER TABLE `biodatas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_pesanans`
--

DROP TABLE IF EXISTS `detail_pesanans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_pesanans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `obat_id` bigint unsigned NOT NULL,
  `pemesanan_id` bigint unsigned NOT NULL,
  `jumlah` int unsigned NOT NULL,
  `harga_pesanan` double(10,2) NOT NULL,
  `status_pengiriman` enum('dikirim','dibatalkan','ditunda') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ditunda',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_pesanans_obat_id_foreign` (`obat_id`),
  KEY `detail_pesanans_pemesanan_id_foreign` (`pemesanan_id`),
  CONSTRAINT `detail_pesanans_obat_id_foreign` FOREIGN KEY (`obat_id`) REFERENCES `obats` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `detail_pesanans_pemesanan_id_foreign` FOREIGN KEY (`pemesanan_id`) REFERENCES `pemesanans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_pesanans`
--

LOCK TABLES `detail_pesanans` WRITE;
/*!40000 ALTER TABLE `detail_pesanans` DISABLE KEYS */;
INSERT INTO `detail_pesanans` VALUES (1,1,1,10,110000.00,'dikirim','2024-03-08 22:15:45','2024-03-10 11:55:09'),(2,3,2,2,230000.00,'dikirim','2024-03-09 17:34:35','2024-03-10 22:38:43'),(3,2,2,10,110000.00,'dikirim','2024-03-09 17:34:35','2024-03-10 00:01:11'),(4,1,2,40,440000.00,'dikirim','2024-03-09 17:34:35','2024-03-10 00:01:26'),(11,3,8,4,460000.00,'dikirim','2024-03-11 21:57:09','2024-03-11 22:12:43'),(12,2,8,10,310000.00,'dikirim','2024-03-11 21:57:09','2024-03-11 22:05:18'),(13,1,8,30,630000.00,'dikirim','2024-03-11 21:57:09','2024-03-11 22:05:57');
/*!40000 ALTER TABLE `detail_pesanans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `distributors`
--

DROP TABLE IF EXISTS `distributors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `distributors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_perusahaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon_perusahaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pemilik_perusahaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi_perusahaan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distributors`
--

LOCK TABLES `distributors` WRITE;
/*!40000 ALTER TABLE `distributors` DISABLE KEYS */;
INSERT INTO `distributors` VALUES (1,'PT. KIMIA FARMA','pt-kimia-farma','-','-','-','2024-03-08 22:07:08','2024-03-08 22:07:08'),(2,'PT ALADIN','pt-aladin','1232131232','Aladin Jahe Jahe',NULL,'2024-03-09 07:51:20','2024-03-09 07:51:20');
/*!40000 ALTER TABLE `distributors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expireds`
--

DROP TABLE IF EXISTS `expireds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expireds` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `stok_obat_id` bigint unsigned NOT NULL,
  `status_pengembalian` enum('pending','disetujui','selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `balasan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expireds_stok_obat_id_foreign` (`stok_obat_id`),
  CONSTRAINT `expireds_stok_obat_id_foreign` FOREIGN KEY (`stok_obat_id`) REFERENCES `stok_obats` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expireds`
--

LOCK TABLES `expireds` WRITE;
/*!40000 ALTER TABLE `expireds` DISABLE KEYS */;
INSERT INTO `expireds` VALUES (1,8,'pending',NULL,NULL,'2024-03-14 04:47:59','2024-03-14 04:47:59'),(2,5,'selesai',NULL,'Baik petugas akan mengambil barang dan menurkakannya','2024-03-14 04:58:51','2024-03-14 19:13:27');
/*!40000 ALTER TABLE `expireds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (34,'2014_10_12_000000_create_users_table',1),(35,'2014_10_12_100000_create_password_resets_table',1),(36,'2019_08_19_000000_create_failed_jobs_table',1),(37,'2019_12_14_000001_create_personal_access_tokens_table',1),(38,'2024_02_04_122313_create_obats_table',1),(39,'2024_02_04_122332_create_biodatas_table',1),(40,'2024_02_09_181450_create_distributors_table',1),(41,'2024_02_10_023220_create_pasiens_table',1),(42,'2024_02_10_024020_create_pemeriksaans_table',1),(43,'2024_02_10_032250_create_akun_distributors_table',1),(44,'2024_02_10_032922_create_stok_obats_table',1),(45,'2024_02_10_034221_create_reseps_table',1),(46,'2024_02_10_035604_create_pemesanans_table',1),(47,'2024_03_02_195958_create_detail_pesanans_table',1),(48,'2024_03_06_004415_create_verif_pesanans_table',1),(49,'2024_03_08_035102_create_surats_table',1),(50,'2024_03_13_153209_create_permintaans_table',1),(51,'2024_03_13_235617_create_pemakaian_obats_table',1),(52,'2024_03_14_063419_create_expireds_table',1),(54,'2024_03_16_191306_create_tebus_obats_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obats`
--

DROP TABLE IF EXISTS `obats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_obat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_obat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan` enum('Kotak (box)','Botol Besar (bottle)','Kemasan (pack)','Karton (carton)','Jerigen (jerry can)','Drum','Bal (bale)') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_batch` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_kedaluwarsa` date NOT NULL,
  `kapasitas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satuan_kapasitas` enum('Tablet (tab)','Kapsul (kap / cps)','Kaplet','Sirup','Krim','Salep','Serbuk','Injeksi','Tetes','Supositoria','Aerosol','Suspensi','Larutan','Ampul','Botol','Tube','Strip','Sachet') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `obats_kode_obat_unique` (`kode_obat`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obats`
--

LOCK TABLES `obats` WRITE;
/*!40000 ALTER TABLE `obats` DISABLE KEYS */;
INSERT INTO `obats` VALUES (1,'#BC0727','Paracetamol','paracetamol','Kotak (box)','ASD123','2024-08-09','5','Strip','2024-03-08 22:15:18','2024-03-08 22:15:18'),(2,'#5F5561','Betadin','betadin','Botol Besar (bottle)','KDJ123','2024-08-10',NULL,NULL,'2024-03-09 17:31:36','2024-03-09 17:31:36'),(3,'#A4C406','AIR RAKSA','air-raksa','Karton (carton)','123KSS','2024-12-10',NULL,NULL,'2024-03-09 17:33:40','2024-03-10 22:26:18');
/*!40000 ALTER TABLE `obats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pasiens`
--

DROP TABLE IF EXISTS `pasiens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pasiens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `no_register` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `biodata_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pasiens_no_register_unique` (`no_register`),
  KEY `pasiens_biodata_id_foreign` (`biodata_id`),
  CONSTRAINT `pasiens_biodata_id_foreign` FOREIGN KEY (`biodata_id`) REFERENCES `biodatas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pasiens`
--

LOCK TABLES `pasiens` WRITE;
/*!40000 ALTER TABLE `pasiens` DISABLE KEYS */;
INSERT INTO `pasiens` VALUES (4,'rsotanaha-d50f98',13,'2024-03-16 05:27:52','2024-03-16 05:27:52');
/*!40000 ALTER TABLE `pasiens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pemakaian_obats`
--

DROP TABLE IF EXISTS `pemakaian_obats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pemakaian_obats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `stok_obat_id` bigint unsigned NOT NULL,
  `banyak` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tanggal_pemakaian` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pemakaian_obats_stok_obat_id_foreign` (`stok_obat_id`),
  CONSTRAINT `pemakaian_obats_stok_obat_id_foreign` FOREIGN KEY (`stok_obat_id`) REFERENCES `stok_obats` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pemakaian_obats`
--

LOCK TABLES `pemakaian_obats` WRITE;
/*!40000 ALTER TABLE `pemakaian_obats` DISABLE KEYS */;
INSERT INTO `pemakaian_obats` VALUES (3,9,'1','Pasien operasi','2024-03-15','2024-03-14 22:18:34','2024-03-14 22:18:34');
/*!40000 ALTER TABLE `pemakaian_obats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pemeriksaans`
--

DROP TABLE IF EXISTS `pemeriksaans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pemeriksaans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pasien_id` bigint unsigned NOT NULL,
  `diagnosis` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pemeriksaans_pasien_id_foreign` (`pasien_id`),
  CONSTRAINT `pemeriksaans_pasien_id_foreign` FOREIGN KEY (`pasien_id`) REFERENCES `pasiens` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pemeriksaans`
--

LOCK TABLES `pemeriksaans` WRITE;
/*!40000 ALTER TABLE `pemeriksaans` DISABLE KEYS */;
INSERT INTO `pemeriksaans` VALUES (8,4,'Infeksi luka bekas kecelakaan','2024-03-16 11:59:41','2024-03-16 11:59:41');
/*!40000 ALTER TABLE `pemeriksaans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pemesanans`
--

DROP TABLE IF EXISTS `pemesanans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pemesanans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `status_kirim_naskah` enum('terkirim','pending') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `status_verif_ppk` enum('diverifikasi','pending','ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `status_verif_direktur` enum('diverifikasi','pending','ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `status_pemesanan` enum('selesai','proses','pending') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pemesanans_user_id_foreign` (`user_id`),
  CONSTRAINT `pemesanans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pemesanans`
--

LOCK TABLES `pemesanans` WRITE;
/*!40000 ALTER TABLE `pemesanans` DISABLE KEYS */;
INSERT INTO `pemesanans` VALUES (1,1,'terkirim','diverifikasi','diverifikasi','selesai',NULL,'2024-03-08 22:15:45','2024-03-11 02:44:51'),(2,1,'terkirim','diverifikasi','diverifikasi','selesai',NULL,'2024-03-09 17:34:35','2024-03-11 02:44:18'),(8,1,'terkirim','diverifikasi','diverifikasi','selesai',NULL,'2024-03-11 21:57:09','2024-03-11 22:19:52');
/*!40000 ALTER TABLE `pemesanans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permintaans`
--

DROP TABLE IF EXISTS `permintaans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permintaans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pengaju` bigint unsigned NOT NULL,
  `pemverifikasi` bigint unsigned DEFAULT NULL,
  `stok_obat_id` bigint unsigned NOT NULL,
  `banyak` int NOT NULL,
  `status_permintaan` enum('tunda','ditolak','disetujui','selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tunda',
  `bidang` enum('pelayanan','depo') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permintaans_stok_obat_id_foreign` (`stok_obat_id`),
  KEY `permintaans_pengaju_foreign` (`pengaju`),
  KEY `permintaans_pemverifikasi_foreign` (`pemverifikasi`),
  CONSTRAINT `permintaans_pemverifikasi_foreign` FOREIGN KEY (`pemverifikasi`) REFERENCES `users` (`id`),
  CONSTRAINT `permintaans_pengaju_foreign` FOREIGN KEY (`pengaju`) REFERENCES `users` (`id`),
  CONSTRAINT `permintaans_stok_obat_id_foreign` FOREIGN KEY (`stok_obat_id`) REFERENCES `stok_obats` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permintaans`
--

LOCK TABLES `permintaans` WRITE;
/*!40000 ALTER TABLE `permintaans` DISABLE KEYS */;
INSERT INTO `permintaans` VALUES (2,4,1,5,5,'selesai','depo',NULL,'2024-03-13 15:49:13','2024-03-13 17:39:49'),(3,4,1,5,2,'selesai','depo',NULL,'2024-03-13 17:40:42','2024-03-13 17:41:29'),(4,3,1,5,3,'selesai','pelayanan',NULL,'2024-03-13 18:01:47','2024-03-13 18:02:18'),(5,4,1,6,5,'selesai','depo',NULL,'2024-03-14 22:05:06','2024-03-14 22:05:40');
/*!40000 ALTER TABLE `permintaans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reseps`
--

DROP TABLE IF EXISTS `reseps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reseps` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pemeriksaan_id` bigint unsigned NOT NULL,
  `stok_obat_id` bigint unsigned NOT NULL,
  `jumlah` int NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reseps_pemeriksaan_id_foreign` (`pemeriksaan_id`),
  KEY `reseps_stok_obat_id_foreign` (`stok_obat_id`),
  CONSTRAINT `reseps_pemeriksaan_id_foreign` FOREIGN KEY (`pemeriksaan_id`) REFERENCES `pemeriksaans` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reseps_stok_obat_id_foreign` FOREIGN KEY (`stok_obat_id`) REFERENCES `stok_obats` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reseps`
--

LOCK TABLES `reseps` WRITE;
/*!40000 ALTER TABLE `reseps` DISABLE KEYS */;
INSERT INTO `reseps` VALUES (5,8,8,1,'2x Sehari dan dibersihkan terlebih dahulu dengan air','2024-03-16 12:00:04','2024-03-16 12:00:04'),(6,8,8,1,'2 Tetes','2024-03-16 12:39:30','2024-03-16 12:39:30');
/*!40000 ALTER TABLE `reseps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stok_obats`
--

DROP TABLE IF EXISTS `stok_obats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stok_obats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `distributor_id` bigint unsigned NOT NULL,
  `obat_id` bigint unsigned NOT NULL,
  `stok` int NOT NULL,
  `harga_beli` double(8,2) NOT NULL,
  `tanggal_beli` date NOT NULL,
  `harga_jual` double(8,2) DEFAULT NULL,
  `lokasi` enum('distributor','gudang','pelayanan','depo') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stok_obats_distributor_id_foreign` (`distributor_id`),
  KEY `stok_obats_obat_id_foreign` (`obat_id`),
  CONSTRAINT `stok_obats_distributor_id_foreign` FOREIGN KEY (`distributor_id`) REFERENCES `distributors` (`id`) ON DELETE CASCADE,
  CONSTRAINT `stok_obats_obat_id_foreign` FOREIGN KEY (`obat_id`) REFERENCES `obats` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stok_obats`
--

LOCK TABLES `stok_obats` WRITE;
/*!40000 ALTER TABLE `stok_obats` DISABLE KEYS */;
INSERT INTO `stok_obats` VALUES (1,1,1,20,20000.00,'2024-03-09',21000.00,'distributor','2024-03-08 22:15:18','2024-03-11 21:57:09'),(2,1,2,30,30000.00,'2024-03-10',31000.00,'distributor','2024-03-09 17:31:36','2024-03-11 21:57:09'),(3,2,3,4,100000.00,'2024-03-10',115000.00,'distributor','2024-03-09 17:33:40','2024-03-11 21:57:09'),(4,1,1,120,21000.00,'2024-03-10',25000.00,'gudang','2024-03-10 05:56:48','2024-03-11 22:15:32'),(5,1,2,10,31000.00,'2024-03-10',32000.00,'gudang','2024-03-10 11:54:26','2024-03-13 18:01:47'),(6,2,3,5,115000.00,'2024-03-10',NULL,'gudang','2024-03-10 22:39:41','2024-03-14 22:05:06'),(7,1,2,7,31000.00,'2024-03-13',32000.00,'depo','2024-03-13 17:39:49','2024-03-13 17:41:29'),(8,1,2,1,31000.00,'2024-03-14',32000.00,'pelayanan','2024-03-13 18:02:18','2024-03-16 19:45:46'),(9,2,3,4,115000.00,'2024-03-15',NULL,'depo','2024-03-14 22:05:40','2024-03-14 22:19:13');
/*!40000 ALTER TABLE `stok_obats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `surats`
--

DROP TABLE IF EXISTS `surats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `surats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nomor_surat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pemesanan_id` bigint unsigned NOT NULL,
  `distributor_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `surats_pemesanan_id_foreign` (`pemesanan_id`),
  KEY `surats_distributor_id_foreign` (`distributor_id`),
  CONSTRAINT `surats_distributor_id_foreign` FOREIGN KEY (`distributor_id`) REFERENCES `distributors` (`id`) ON DELETE CASCADE,
  CONSTRAINT `surats_pemesanan_id_foreign` FOREIGN KEY (`pemesanan_id`) REFERENCES `pemesanans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `surats`
--

LOCK TABLES `surats` WRITE;
/*!40000 ALTER TABLE `surats` DISABLE KEYS */;
INSERT INTO `surats` VALUES (1,'445/RSUD.O/1/3/2024',1,1,'2024-03-08 22:37:50','2024-03-08 22:37:50'),(2,'445/RSUD.O/2/3/2024',2,2,'2024-03-09 17:35:45','2024-03-09 17:35:45'),(3,'445/RSUD.O/3/3/2024',2,1,'2024-03-09 17:35:45','2024-03-09 17:35:45'),(4,'445/RSUD.O/3/3/2024',8,2,'2024-03-11 21:57:20','2024-03-11 21:57:20'),(5,'445/RSUD.O/5/3/2024',8,1,'2024-03-11 21:57:20','2024-03-11 21:57:20');
/*!40000 ALTER TABLE `surats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tebus_obats`
--

DROP TABLE IF EXISTS `tebus_obats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tebus_obats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pemeriksaan_id` bigint unsigned NOT NULL,
  `status_bayar` enum('lunas','pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tebus_obats_pemeriksaan_id_foreign` (`pemeriksaan_id`),
  CONSTRAINT `tebus_obats_pemeriksaan_id_foreign` FOREIGN KEY (`pemeriksaan_id`) REFERENCES `pemeriksaans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tebus_obats`
--

LOCK TABLES `tebus_obats` WRITE;
/*!40000 ALTER TABLE `tebus_obats` DISABLE KEYS */;
INSERT INTO `tebus_obats` VALUES (1,8,'lunas','2024-03-16 11:59:41','2024-03-16 19:44:41');
/*!40000 ALTER TABLE `tebus_obats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('gudang','distributor','poli','pelayanan','depo','ppk','direktur') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `biodata_id` bigint unsigned NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_biodata_id_foreign` (`biodata_id`),
  CONSTRAINT `users_biodata_id_foreign` FOREIGN KEY (`biodata_id`) REFERENCES `biodatas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'gudang','windygudang@gmail.com','$2y$10$3ydL92lYwFFgEuYiheTQfu76EswyxhorUjldSjx1TCDnTgzAIZmvO','gudang',1,NULL,'2024-03-08 22:07:07','2024-03-08 22:07:07'),(2,'distributor','windydistributor@gmail.com','$2y$10$.X86tyYqKXs7FiUZbG7xfuamfx2Cp93CCA3b9WSIbIbG5edMlPS8G','distributor',2,NULL,'2024-03-08 22:07:07','2024-03-08 22:07:07'),(3,'pelayanan','windypelayanan@gmail.com','$2y$10$QsbNa9E1i4L1SeK/qHSQ3enNyt4tJmLy5SwqtJOS1fogltQaLmnPy','pelayanan',3,NULL,'2024-03-08 22:07:08','2024-03-08 22:07:08'),(4,'depo','windydepo@gmail.com','$2y$10$Lry4q61O.NhJMnsDmWvi3.gijnSCdnkNALlu6a8Q19raCupWs3p3m','depo',4,NULL,'2024-03-08 22:07:08','2024-03-08 22:07:08'),(5,'ppk','windyppk@gmail.com','$2y$10$FbhNb6ryPqEqsGd0em3D4uWMSF8GXs3Wr8eXz.AkyFe5A7/7oVOb6','ppk',5,NULL,'2024-03-08 22:07:08','2024-03-08 22:07:08'),(6,'direktur','windydirektur@gmail.com','$2y$10$ab9ylOHKBBAiw6cN6WHB/.9IkRyaNOzFXV4unxiOIsPg4t.g8qlqy','direktur',6,NULL,'2024-03-08 22:07:08','2024-03-08 22:07:08'),(7,'poli','windypoli@gmail.com','$2y$10$p8qKiwsVzrY74y5WEHwAIuqte8lNWUsfCq2KOxuj4AfWIjrUBAIZG','poli',7,NULL,'2024-03-08 22:07:08','2024-03-08 22:07:08'),(8,'mances',NULL,'$2y$10$dbdDssZfntr7NQVDTVPug.f1hCiQPYK8YqWQwSr8Zdb.40xvdwZCK','distributor',8,NULL,'2024-03-09 07:51:20','2024-03-09 07:51:20');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `verif_pesanans`
--

DROP TABLE IF EXISTS `verif_pesanans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `verif_pesanans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pemverifikasi` bigint unsigned NOT NULL,
  `detail_pesanan_id` bigint unsigned NOT NULL,
  `kondisi_pesanan` enum('sesuai','tidak_sesuai') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tidak_sesuai',
  `catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `verif_pesanans_detail_pesanan_id_foreign` (`detail_pesanan_id`),
  KEY `verif_pesanans_pemverifikasi_foreign` (`pemverifikasi`),
  CONSTRAINT `verif_pesanans_detail_pesanan_id_foreign` FOREIGN KEY (`detail_pesanan_id`) REFERENCES `detail_pesanans` (`id`) ON DELETE CASCADE,
  CONSTRAINT `verif_pesanans_pemverifikasi_foreign` FOREIGN KEY (`pemverifikasi`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `verif_pesanans`
--

LOCK TABLES `verif_pesanans` WRITE;
/*!40000 ALTER TABLE `verif_pesanans` DISABLE KEYS */;
INSERT INTO `verif_pesanans` VALUES (4,1,3,'sesuai','Barang lengkap','2024-03-10 11:54:26','2024-03-10 11:54:26'),(5,1,1,'sesuai','Sesuai','2024-03-10 11:56:20','2024-03-10 11:56:20'),(6,1,2,'sesuai','Sesuai','2024-03-10 22:39:41','2024-03-10 22:39:41'),(7,1,4,'sesuai','Sesuai','2024-03-11 04:25:59','2024-03-11 04:25:59'),(8,1,13,'sesuai','Barang sesuai','2024-03-11 22:15:32','2024-03-11 22:15:32'),(9,1,12,'sesuai','Barang Sesuai','2024-03-11 22:16:24','2024-03-11 22:16:24'),(11,1,11,'sesuai','Barang langkap dan sesuai','2024-03-11 22:19:52','2024-03-11 22:19:52');
/*!40000 ALTER TABLE `verif_pesanans` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-17 12:46:13

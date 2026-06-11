/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.8.6-MariaDB, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: dagsap
-- ------------------------------------------------------
-- Server version	11.8.6-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES
('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba','i:2;',1781195954),
('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba:timer','i:1781195954;',1781195954);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `detail_pelamars`
--

DROP TABLE IF EXISTS `detail_pelamars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_pelamars` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pelamar_id` bigint(20) unsigned NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tinggi_badan` varchar(255) DEFAULT NULL,
  `berat_badan` varchar(255) DEFAULT NULL,
  `kewarganegaraan` varchar(255) NOT NULL DEFAULT 'Indonesia',
  `agama` varchar(255) NOT NULL,
  `golongan_darah` varchar(255) DEFAULT NULL,
  `alamat_tinggal` text NOT NULL,
  `rt_rw_tinggal` varchar(255) DEFAULT NULL,
  `kelurahan_tinggal` varchar(255) DEFAULT NULL,
  `kecamatan_tinggal` varchar(255) DEFAULT NULL,
  `kabupaten_tinggal` varchar(255) DEFAULT NULL,
  `kota_tinggal` varchar(255) DEFAULT NULL,
  `provinsi_tinggal` varchar(255) DEFAULT NULL,
  `kode_pos_tinggal` varchar(255) DEFAULT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) NOT NULL,
  `no_wa` varchar(255) DEFAULT NULL,
  `alamat_ktp` text NOT NULL,
  `rt_rw_ktp` varchar(255) DEFAULT NULL,
  `kelurahan_ktp` varchar(255) DEFAULT NULL,
  `kecamatan_ktp` varchar(255) DEFAULT NULL,
  `kabupaten_ktp` varchar(255) DEFAULT NULL,
  `kota_ktp` varchar(255) DEFAULT NULL,
  `provinsi_ktp` varchar(255) DEFAULT NULL,
  `kode_pos_ktp` varchar(255) DEFAULT NULL,
  `no_ktp` varchar(255) NOT NULL,
  `no_npwp` varchar(255) DEFAULT NULL,
  `no_bpjs_ketenagakerjaan` varchar(255) DEFAULT NULL,
  `status_perkawinan` enum('Lajang','Nikah','Bercerai','Pasangan Meninggal') NOT NULL,
  `email` varchar(255) NOT NULL,
  `hobby` varchar(255) DEFAULT NULL,
  `organisasi` text DEFAULT NULL,
  `pendidikan_formal` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`pendidikan_formal`)),
  `pelatihan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`pelatihan`)),
  `keterampilan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`keterampilan`)),
  `bahasa_asing` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`bahasa_asing`)),
  `kekuatan` text DEFAULT NULL,
  `kelemahan` text DEFAULT NULL,
  `pengalaman_kerja` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`pengalaman_kerja`)),
  `bidang_minat` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`bidang_minat`)),
  `referensi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`referensi`)),
  `punya_saudara_di_perusahaan` tinyint(1) NOT NULL DEFAULT 0,
  `saudara_di_perusahaan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`saudara_di_perusahaan`)),
  `pernah_sakit_berat` tinyint(1) NOT NULL DEFAULT 0,
  `sakit_berat_keterangan` text DEFAULT NULL,
  `punya_penyakit_keturunan` tinyint(1) NOT NULL DEFAULT 0,
  `penyakit_keturunan_keterangan` text DEFAULT NULL,
  `pakai_kacamata` tinyint(1) NOT NULL DEFAULT 0,
  `ukuran_kacamata` varchar(255) DEFAULT NULL,
  `punya_alergi` tinyint(1) NOT NULL DEFAULT 0,
  `alergi_keterangan` text DEFAULT NULL,
  `punya_pasangan` tinyint(1) NOT NULL DEFAULT 0,
  `data_pasangan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data_pasangan`)),
  `punya_anak` tinyint(1) NOT NULL DEFAULT 0,
  `data_anak` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data_anak`)),
  `riwayat_penyakit_keluarga` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`riwayat_penyakit_keluarga`)),
  `data_orang_tua` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data_orang_tua`)),
  `kontak_darurat` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`kontak_darurat`)),
  `saudara_kandung` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`saudara_kandung`)),
  `gaji_diharapkan` varchar(255) DEFAULT NULL,
  `waktu_bergabung` varchar(255) DEFAULT NULL,
  `pernyataan_setuju` tinyint(1) NOT NULL DEFAULT 0,
  `tempat_pernyataan` varchar(255) DEFAULT NULL,
  `tanggal_pernyataan` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_pelamars_pelamar_id_index` (`pelamar_id`),
  CONSTRAINT `detail_pelamars_pelamar_id_foreign` FOREIGN KEY (`pelamar_id`) REFERENCES `pelamars` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_pelamars`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `detail_pelamars` WRITE;
/*!40000 ALTER TABLE `detail_pelamars` DISABLE KEYS */;
/*!40000 ALTER TABLE `detail_pelamars` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `divisis`
--

DROP TABLE IF EXISTS `divisis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `divisis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_divisi` varchar(255) NOT NULL,
  `kode_divisi` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `divisis_kode_divisi_unique` (`kode_divisi`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divisis`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `divisis` WRITE;
/*!40000 ALTER TABLE `divisis` DISABLE KEYS */;
INSERT INTO `divisis` VALUES
(1,'FAT','FAT',NULL,'2026-06-11 16:19:30','2026-06-11 16:19:30'),
(2,'HRD&GA','HRDGA',NULL,'2026-06-11 16:19:30','2026-06-11 16:19:30'),
(3,'Internal Audit','IA',NULL,'2026-06-11 16:19:30','2026-06-11 16:19:30'),
(4,'Maintenance','MTN',NULL,'2026-06-11 16:19:30','2026-06-11 16:19:30'),
(5,'PPIC&Purchasing','PPIC',NULL,'2026-06-11 16:19:30','2026-06-11 16:19:30'),
(6,'Produksi','PROD',NULL,'2026-06-11 16:19:30','2026-06-11 16:19:30'),
(7,'QAQC','QAQC',NULL,'2026-06-11 16:19:30','2026-06-11 16:19:30'),
(8,'Sales & Marketing','SALES',NULL,'2026-06-11 16:19:30','2026-06-11 16:19:30');
/*!40000 ALTER TABLE `divisis` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `formulir_jawabans`
--

DROP TABLE IF EXISTS `formulir_jawabans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `formulir_jawabans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pelamar_id` bigint(20) unsigned NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `jawaban` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `formulir_jawabans_pelamar_id_foreign` (`pelamar_id`),
  CONSTRAINT `formulir_jawabans_pelamar_id_foreign` FOREIGN KEY (`pelamar_id`) REFERENCES `pelamars` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formulir_jawabans`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `formulir_jawabans` WRITE;
/*!40000 ALTER TABLE `formulir_jawabans` DISABLE KEYS */;
/*!40000 ALTER TABLE `formulir_jawabans` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `hasil_psikotests`
--

DROP TABLE IF EXISTS `hasil_psikotests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `hasil_psikotests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hasil_psikotests`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `hasil_psikotests` WRITE;
/*!40000 ALTER TABLE `hasil_psikotests` DISABLE KEYS */;
/*!40000 ALTER TABLE `hasil_psikotests` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `lowongans`
--

DROP TABLE IF EXISTS `lowongans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `lowongans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pengajuan_id` bigint(20) unsigned NOT NULL,
  `hrd_id` bigint(20) unsigned NOT NULL,
  `judul` varchar(255) NOT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `deskripsi` text NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status` enum('draft','publikasi','ditutup') NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lowongans_pengajuan_id_index` (`pengajuan_id`),
  KEY `lowongans_hrd_id_index` (`hrd_id`),
  CONSTRAINT `lowongans_hrd_id_foreign` FOREIGN KEY (`hrd_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lowongans_pengajuan_id_foreign` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan_tenaga_kerjas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lowongans`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `lowongans` WRITE;
/*!40000 ALTER TABLE `lowongans` DISABLE KEYS */;
/*!40000 ALTER TABLE `lowongans` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'0001_01_01_000001_create_cache_table',1),
(2,'0001_01_01_000002_create_jobs_table',1),
(3,'2026_05_19_075251_create_divisis_table',1),
(4,'2026_05_20_044615_create_hasil_psikotests_table',1),
(5,'2026_05_21_000000_create_users_table',1),
(6,'2026_05_21_000004_create_pengajuan_tenaga_kerjas_table',1),
(7,'2026_05_21_000012_create_lowongans_table',1),
(8,'2026_05_21_000045_create_pelamars_table',1),
(9,'2026_05_21_000059_create_formulir_jawabans_table',1),
(10,'2026_05_21_044525_add_columns_to_pengajuan_tenaga_kerjas_table',1),
(11,'2026_05_21_044811_add_username_to_users_table',1),
(12,'2026_05_21_045555_add_psikotest_fields_to_pelamars_table',1),
(13,'2026_05_21_071734_add_managed_divisi_id_to_users_table',1),
(14,'2026_05_25_074226_add_approver_fields_to_pengajuan_tenaga_kerjas_table',1),
(15,'2026_05_26_130240_create_detail_pelamars_table',1),
(16,'2026_06_09_085327_add_identitas_pemohon_to_pengajuan_tenaga_kerjas_table',1),
(17,'2026_06_10_110429_add_jabatan_penyetuju_to_pengajuan_tenaga_kerjas_table',1),
(18,'2026_06_11_225000_add_indexes_to_tables',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `pelamars`
--

DROP TABLE IF EXISTS `pelamars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `pelamars` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `lowongan_id` bigint(20) unsigned NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telepon` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `pendidikan_terakhir` varchar(255) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `tahun_lulus` int(11) NOT NULL,
  `ipk` varchar(255) DEFAULT NULL,
  `pengalaman_kerja` text DEFAULT NULL,
  `cv_path` varchar(255) DEFAULT NULL,
  `ijazah_path` varchar(255) DEFAULT NULL,
  `status` enum('pending','lolos_tahap1','psikotest','lolos_psikotest','interview','diterima','ditolak') NOT NULL DEFAULT 'pending',
  `catatan` text DEFAULT NULL,
  `psikotest_link` varchar(255) DEFAULT NULL,
  `psikotest_dikirim_at` timestamp NULL DEFAULT NULL,
  `psikotest_selesai_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pelamars_lowongan_id_index` (`lowongan_id`),
  CONSTRAINT `pelamars_lowongan_id_foreign` FOREIGN KEY (`lowongan_id`) REFERENCES `lowongans` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pelamars`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `pelamars` WRITE;
/*!40000 ALTER TABLE `pelamars` DISABLE KEYS */;
/*!40000 ALTER TABLE `pelamars` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `pengajuan_tenaga_kerjas`
--

DROP TABLE IF EXISTS `pengajuan_tenaga_kerjas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `pengajuan_tenaga_kerjas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `divisi_id` bigint(20) unsigned NOT NULL,
  `departemen_dipilih` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `nama_pemohon` varchar(255) DEFAULT NULL,
  `nip_pemohon` varchar(255) DEFAULT NULL,
  `jabatan_pemohon` varchar(255) DEFAULT NULL,
  `no_hp_pemohon` varchar(255) DEFAULT NULL,
  `diajukan_oleh` varchar(255) DEFAULT NULL,
  `jenis` enum('penambahan','penggantian') NOT NULL,
  `posisi` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal_dibutuhkan` date DEFAULT NULL,
  `kriteria` text NOT NULL,
  `persyaratan` text NOT NULL,
  `deskripsi_pekerjaan` text NOT NULL,
  `tugas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tugas`)),
  `status` enum('pending','disetujui','ditolak') NOT NULL DEFAULT 'pending',
  `alasan_penolakan` text DEFAULT NULL,
  `approved_by` bigint(20) unsigned DEFAULT NULL,
  `disetujui_oleh` varchar(255) DEFAULT NULL,
  `jabatan_penyetuju` varchar(255) DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengajuan_tenaga_kerjas_divisi_id_index` (`divisi_id`),
  KEY `pengajuan_tenaga_kerjas_user_id_index` (`user_id`),
  KEY `pengajuan_tenaga_kerjas_approved_by_index` (`approved_by`),
  KEY `pengajuan_tenaga_kerjas_departemen_dipilih_index` (`departemen_dipilih`),
  KEY `pengajuan_tenaga_kerjas_nip_pemohon_index` (`nip_pemohon`),
  CONSTRAINT `pengajuan_tenaga_kerjas_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`),
  CONSTRAINT `pengajuan_tenaga_kerjas_departemen_dipilih_foreign` FOREIGN KEY (`departemen_dipilih`) REFERENCES `divisis` (`id`) ON DELETE SET NULL,
  CONSTRAINT `pengajuan_tenaga_kerjas_divisi_id_foreign` FOREIGN KEY (`divisi_id`) REFERENCES `divisis` (`id`),
  CONSTRAINT `pengajuan_tenaga_kerjas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengajuan_tenaga_kerjas`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `pengajuan_tenaga_kerjas` WRITE;
/*!40000 ALTER TABLE `pengajuan_tenaga_kerjas` DISABLE KEYS */;
INSERT INTO `pengajuan_tenaga_kerjas` VALUES
(1,2,2,10,'dsasadsasa','3212132132132132','30','31232132131','dsasadsasa','penambahan','31111132333333333',312132,'2026-08-12','{\"pendidikan\":\"S2\",\"jurusan\":\"31321321\",\"pengalaman\":\"3\",\"ipk\":\"3\",\"keahlian\":\"31312xx123x21\"}','[\"x21x3213x213x213x\",\"x321x321x21\"]','x321x321x321','[\"1332\",\"32132\",\"32132132\"]','disetujui',NULL,3,'Management HRD&GA','dsasd','2026-06-11 16:39:44','2026-06-11 16:35:00','2026-06-11 16:39:44');
/*!40000 ALTER TABLE `pengajuan_tenaga_kerjas` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES
('hS4vn1ZGJCRPZ8nDjf0k4cJvl1ZKYI1vudONNuND',3,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:146.0) Gecko/20100101 Firefox/146.0','eyJfdG9rZW4iOiJlT1FaZ1l3MDdHRkpaN0hkTHQwTk9BeGk1bFhlbnNiZDJBUEQxWHo1IiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDFcL2FkbWluXC9tYW5hZ2VtZW50XC9wZW5nYWp1YW5cLzFcL3ByaW50Iiwicm91dGUiOiJtYW5hZ2VtZW50LnBlbmdhanVhbi5wcmludCJ9LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6M30=',1781195988),
('mC2sHb5WBlKRrfkbzOn8o7IDCiVf7eq3UdjYnWQg',NULL,'127.0.0.1','curl/8.20.0','eyJfdG9rZW4iOiJhZUEyUVhheFZlTWpnSnhndzBhbE41WGFyRXl6MEk0TlNEb0RWaThyIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1781194916),
('OLcNojgulG83W2ioXEluJiuifBf4HGnwPxG5vDcX',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:146.0) Gecko/20100101 Firefox/146.0','eyJfdG9rZW4iOiJYMjJKNXZSc3lTaTJVWE9mY0FXb2pNVkFHWnBCRTR2cHd5ZmdlOGdaIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAxXC9hZG1pblwvbWFuYWdlbWVudFwvcGVuZ2FqdWFuXC8xIiwicm91dGUiOiJtYW5hZ2VtZW50LnBlbmdhanVhbi5zaG93In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1781195782),
('z51y6lhHexi9S4bz5lx9ewzK3E7OWRYQNitvjsjS',10,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJvWjVQeGhxVXh6endRYlFMNHZoVzRIZnVXem9IYjdSczZjR1VuZzlNIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAxXC9hZG1pblwvZGl2aXNpXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImRpdmlzaS5kYXNoYm9hcmQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MTB9',1781195708);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('divisi','management','hrd') NOT NULL,
  `divisi_id` bigint(20) unsigned DEFAULT NULL,
  `managed_divisi_id` bigint(20) unsigned DEFAULT NULL,
  `no_telepon` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_divisi_id_foreign` (`divisi_id`),
  KEY `users_managed_divisi_id_foreign` (`managed_divisi_id`),
  CONSTRAINT `users_divisi_id_foreign` FOREIGN KEY (`divisi_id`) REFERENCES `divisis` (`id`) ON DELETE SET NULL,
  CONSTRAINT `users_managed_divisi_id_foreign` FOREIGN KEY (`managed_divisi_id`) REFERENCES `divisis` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'hrd_dagsap','HRD Dagsap','hrd@dagsap.com',NULL,'$2y$12$Il0puyX3SP0oDdkHew4FWup1cmKHe8YveW0YXjlIvb8NQfsdQZIp2','hrd',NULL,NULL,'6281294491075',NULL,'2026-06-11 16:19:30','2026-06-11 16:19:30'),
(2,'fat','Management FAT','fat@dagsap.com',NULL,'$2y$12$MaPQ1sT6UAQUEOEPxJdQ4eK5A.jNpxpzKcmuT2eXxR3iHlM4.kLqC','management',NULL,1,'628123456791',NULL,'2026-06-11 16:19:31','2026-06-11 16:19:31'),
(3,'hrdga','Management HRD&GA','hrd&ga@dagsap.com',NULL,'$2y$12$ZEh5cvrgNfHSsyd9PLvtVeUWTBRDdKJPjy5s8ZB/q9XPJw2wAFkXi','management',NULL,2,'628123456792',NULL,'2026-06-11 16:19:31','2026-06-11 16:19:31'),
(4,'audit','Management Internal Audit','internal.audit@dagsap.com',NULL,'$2y$12$akrtoe4VOvrVjCr7n8WR8uVGF9F7p2zPAm/zmFc2S291s89ndzW.G','management',NULL,3,'628123456793',NULL,'2026-06-11 16:19:31','2026-06-11 16:19:31'),
(5,'maintenance','Management Maintenance','maintenance@dagsap.com',NULL,'$2y$12$lJYZxhoe68guGjhQgzUmA.IBag3rQV8kI58Qg5KFis.etQVvgu4R2','management',NULL,4,'628123456794',NULL,'2026-06-11 16:19:31','2026-06-11 16:19:31'),
(6,'ppic','Management PPIC&Purchasing','ppic&purchasing@dagsap.com',NULL,'$2y$12$EWCRdug/PdGqZ9bKkFo58eIrISgf/GsaKNMBirkDuOcYFJJtzckw6','management',NULL,5,'628123456795',NULL,'2026-06-11 16:19:32','2026-06-11 16:19:32'),
(7,'produksi','Management Produksi','produksi@dagsap.com',NULL,'$2y$12$YKnkct5u113/nvjOk3gfCuFWSQRo02qH.why3fAb75Aa05OYatwHu','management',NULL,6,'628123456796',NULL,'2026-06-11 16:19:32','2026-06-11 16:19:32'),
(8,'qaqc','Management QAQC','qaqc@dagsap.com',NULL,'$2y$12$NxCOiSDrHRuz5/0lfXkTHuiGrIBsohOkfDIE82ld9Z.L5mTgL/kGu','management',NULL,7,'628123456797',NULL,'2026-06-11 16:19:32','2026-06-11 16:19:32'),
(9,'sales','Management Sales & Marketing','sales.&.marketing@dagsap.com',NULL,'$2y$12$.DEtf147HJhlEWdoEcb2N.EDPQCwRHMcJBKtEOTGnm.wO7fG4diiq','management',NULL,8,'628123456798',NULL,'2026-06-11 16:19:32','2026-06-11 16:19:32'),
(10,'user_dagsap','User Divisi','user.divisi@dagsap.com',NULL,'$2y$12$wTsJX3ZhhdOvjuSV1gRm4.VV6Am65lDXOFlOFORQ6UrbIK1lxUc2C','divisi',NULL,NULL,'628123456789',NULL,'2026-06-11 16:19:33','2026-06-11 16:19:33');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-06-11 23:57:58

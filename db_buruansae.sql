-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2024 at 05:07 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_buruansae`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'admindkpp@mail.com', 7, '2024-05-14 14:49:20', 1),
(2, '::1', 'admindkpp@mail.com', 7, '2024-05-14 14:50:51', 1),
(3, '::1', 'admindkpp@mail.com', 7, '2024-05-14 14:51:18', 1),
(4, '::1', 'admindkpp@mail.com', 7, '2024-05-14 14:51:51', 1),
(5, '::1', 'admindkpp@mail.com', 7, '2024-05-14 14:52:23', 1),
(6, '::1', 'admindkpp@mail.com', 7, '2024-05-14 14:54:11', 1),
(7, '::1', 'admindkpp@mail.com', 7, '2024-05-14 14:54:40', 1),
(8, '::1', 'admindkpp@mail.com', 7, '2024-05-14 14:55:58', 1),
(9, '::1', 'admindkpp@mail.com', 7, '2024-05-14 14:56:23', 1),
(10, '::1', 'admindkpp@mail.com', 7, '2024-05-14 15:03:02', 1),
(11, '::1', 'admindkpp@mail.com', 7, '2024-05-14 15:03:03', 1),
(12, '::1', 'admindkpp@mail.com', 7, '2024-05-14 15:03:39', 1),
(13, '::1', 'admindkpp@mail.com', 7, '2024-05-14 15:03:50', 1),
(14, '::1', 'admindkpp@mail.com', 7, '2024-05-14 15:03:59', 1),
(15, '::1', 'dkppadmin', NULL, '2024-05-14 15:04:24', 0),
(16, '::1', 'admindkpp@mail.com', 7, '2024-05-14 15:04:30', 1),
(17, '::1', 'admindkpp@mail.com', 7, '2024-05-14 15:06:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `data_buah`
--

CREATE TABLE `data_buah` (
  `id_buah` int(11) UNSIGNED NOT NULL,
  `id_kelompok` int(11) UNSIGNED NOT NULL,
  `nama_buah` varchar(255) NOT NULL,
  `tanggal_tanam` date NOT NULL,
  `kategori_tumbuhan` varchar(255) DEFAULT NULL,
  `jumlah_tanam` double NOT NULL,
  `jenis_pupuk` varchar(255) DEFAULT NULL,
  `jumlah_pupuk` int(255) DEFAULT NULL,
  `waktu_pupuk` date DEFAULT NULL,
  `waktu_panen` date DEFAULT NULL,
  `jumlah_panen` double DEFAULT NULL,
  `konsumsi_lokal_kg` int(255) DEFAULT NULL,
  `konsumsi_kk` int(255) DEFAULT NULL,
  `konsumsi_orang` int(255) DEFAULT NULL,
  `jumlah_jual` int(255) DEFAULT NULL,
  `harga_jual` bigint(255) DEFAULT NULL,
  `lokasi_pembeli` varchar(255) DEFAULT NULL,
  `dukungan_program_lain` longtext DEFAULT NULL,
  `data_pendukung` longtext DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `data_ikan`
--

CREATE TABLE `data_ikan` (
  `id_ikan` int(11) UNSIGNED NOT NULL,
  `id_kelompok` int(11) UNSIGNED NOT NULL,
  `waktu_pakan` varchar(255) NOT NULL,
  `jenis_ikan` varchar(255) NOT NULL,
  `jumlah_pakan` int(11) NOT NULL,
  `jumlah_ikan` double NOT NULL,
  `waktu_panen` date DEFAULT NULL,
  `jumlah_panen` double DEFAULT NULL,
  `konsumsi_lokal_kg` int(255) DEFAULT NULL,
  `konsumsi_kk` int(255) DEFAULT NULL,
  `konsumsi_orang` int(255) DEFAULT NULL,
  `jumlah_jual` int(255) DEFAULT NULL,
  `harga_jual` bigint(255) DEFAULT NULL,
  `lokasi_pembeli` varchar(255) DEFAULT NULL,
  `dukungan_program_lain` longtext DEFAULT NULL,
  `data_pendukung` longtext DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `data_kelompok`
--

CREATE TABLE `data_kelompok` (
  `id_kelompok` int(11) UNSIGNED NOT NULL,
  `penyuluh` varchar(255) DEFAULT NULL,
  `pendamping` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `kelurahan` varchar(255) DEFAULT NULL,
  `rw` varchar(255) DEFAULT NULL,
  `nama_kelompok` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_kelompok`
--

INSERT INTO `data_kelompok` (`id_kelompok`, `penyuluh`, `pendamping`, `kecamatan`, `kelurahan`, `rw`, `nama_kelompok`) VALUES
(1, 'tes', 'tes', 'tes', 'testu', 'rw 1', 'eeq');

-- --------------------------------------------------------

--
-- Table structure for table `data_komoditi`
--

CREATE TABLE `data_komoditi` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_komoditi` varchar(255) NOT NULL,
  `sektor` varchar(255) NOT NULL,
  `durasi_tanam` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_komoditi`
--

INSERT INTO `data_komoditi` (`id`, `nama_komoditi`, `sektor`, `durasi_tanam`, `start_date`, `end_date`) VALUES
(1, 'mencoba', 'OLAHAN HASIL', '3 Hari', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `data_olahan_hasil`
--

CREATE TABLE `data_olahan_hasil` (
  `id_data_olahan_hasil` int(11) UNSIGNED NOT NULL,
  `id_kelompok` int(11) UNSIGNED NOT NULL,
  `uji_lab` varchar(255) NOT NULL,
  `izin_halal` varchar(255) NOT NULL,
  `izin_pirt` varchar(255) NOT NULL,
  `resep` varchar(255) NOT NULL,
  `tanggal_produksi` date NOT NULL,
  `jenis_olahan` varchar(255) NOT NULL,
  `bahan_dasar` varchar(255) NOT NULL,
  `merk` varchar(255) NOT NULL,
  `waktu_jual` date DEFAULT NULL,
  `konsumsi_lokal_kg` int(255) DEFAULT NULL,
  `konsumsi_kk` int(255) DEFAULT NULL,
  `konsumsi_orang` int(255) DEFAULT NULL,
  `jumlah_jual` double DEFAULT NULL,
  `harga_jual` bigint(255) DEFAULT NULL,
  `lokasi_pembeli` varchar(255) DEFAULT NULL,
  `dukungan_program_lain` longtext DEFAULT NULL,
  `data_pendukung` longtext DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_olahan_hasil`
--

INSERT INTO `data_olahan_hasil` (`id_data_olahan_hasil`, `id_kelompok`, `uji_lab`, `izin_halal`, `izin_pirt`, `resep`, `tanggal_produksi`, `jenis_olahan`, `bahan_dasar`, `merk`, `waktu_jual`, `konsumsi_lokal_kg`, `konsumsi_kk`, `konsumsi_orang`, `jumlah_jual`, `harga_jual`, `lokasi_pembeli`, `dukungan_program_lain`, `data_pendukung`, `gambar`) VALUES
(1, 1, 'tes', 'tes', 'tes', '1231', '2024-05-13', 'mencoba', '123', 'tes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `data_sampah`
--

CREATE TABLE `data_sampah` (
  `id_data_sampah` int(11) UNSIGNED NOT NULL,
  `id_kelompok` int(11) UNSIGNED NOT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `jenis_pengolahan` varchar(255) DEFAULT NULL,
  `jumlah_sampah` double DEFAULT NULL,
  `produk_hasil` varchar(255) DEFAULT NULL,
  `waktu_sebaran` date DEFAULT NULL,
  `penggunaan_lokal` int(255) DEFAULT NULL,
  `jumlah_jual` int(255) DEFAULT NULL,
  `harga_jual` bigint(255) DEFAULT NULL,
  `lokasi_pembeli` varchar(255) DEFAULT NULL,
  `dukungan_program_lain` longtext DEFAULT NULL,
  `data_pendukung` longtext DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `data_sayur`
--

CREATE TABLE `data_sayur` (
  `id_sayur` int(11) UNSIGNED NOT NULL,
  `id_kelompok` int(11) UNSIGNED NOT NULL,
  `nama_sayur` varchar(255) NOT NULL,
  `tanggal_tanam` date NOT NULL,
  `kategori_tumbuhan` varchar(255) NOT NULL,
  `jumlah_tanam` double NOT NULL,
  `waktu_panen` date DEFAULT NULL,
  `jumlah_panen` double DEFAULT NULL,
  `konsumsi_lokal_kg` int(255) DEFAULT NULL,
  `konsumsi_kk` int(255) DEFAULT NULL,
  `konsumsi_orang` int(255) DEFAULT NULL,
  `jumlah_jual` int(255) DEFAULT NULL,
  `harga_jual` bigint(255) DEFAULT NULL,
  `lokasi_pembeli` varchar(255) DEFAULT NULL,
  `dukungan_program_lain` longtext DEFAULT NULL,
  `data_pendukung` longtext DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `data_tanaman_obat`
--

CREATE TABLE `data_tanaman_obat` (
  `id_tanaman_obat` int(11) UNSIGNED NOT NULL,
  `id_kelompok` int(11) UNSIGNED NOT NULL,
  `nama_tanaman_obat` varchar(255) NOT NULL,
  `tanggal_tanam` date NOT NULL,
  `kategori_tumbuhan` varchar(255) NOT NULL,
  `jumlah_tanam` double NOT NULL,
  `waktu_panen` date DEFAULT NULL,
  `jumlah_panen` double DEFAULT NULL,
  `konsumsi_lokal_kg` int(255) DEFAULT NULL,
  `konsumsi_kk` int(255) DEFAULT NULL,
  `konsumsi_orang` int(255) DEFAULT NULL,
  `jumlah_jual` int(255) DEFAULT NULL,
  `harga_jual` bigint(255) DEFAULT NULL,
  `lokasi_pembeli` varchar(255) DEFAULT NULL,
  `dukungan_program_lain` longtext DEFAULT NULL,
  `data_pendukung` longtext DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `data_ternak`
--

CREATE TABLE `data_ternak` (
  `id_ternak` int(11) UNSIGNED NOT NULL,
  `id_kelompok` int(11) UNSIGNED NOT NULL,
  `waktu_pakan` date NOT NULL,
  `jenis_ternak` varchar(255) NOT NULL,
  `jumlah_pakan` int(11) NOT NULL,
  `jumlah_ternak` double NOT NULL,
  `waktu_panen` date DEFAULT NULL,
  `jumlah_panen` double DEFAULT NULL,
  `konsumsi_lokal_kg` int(255) DEFAULT NULL,
  `konsumsi_kk` int(255) DEFAULT NULL,
  `konsumsi_orang` int(255) DEFAULT NULL,
  `jumlah_jual` int(255) DEFAULT NULL,
  `harga_jual` bigint(255) DEFAULT NULL,
  `lokasi_pembeli` varchar(255) DEFAULT NULL,
  `dukungan_program_lain` longtext DEFAULT NULL,
  `data_pendukung` longtext DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(11, '2024-04-04-170000', 'App\\Database\\Migrations\\Datakelompok', 'default', 'App', 1715614142, 1),
(12, '2024-04-04-175240', 'App\\Database\\Migrations\\Datasayur', 'default', 'App', 1715614142, 1),
(13, '2024-04-04-194107', 'App\\Database\\Migrations\\Datatanamanobat', 'default', 'App', 1715614142, 1),
(14, '2024-04-04-194523', 'App\\Database\\Migrations\\Databuah', 'default', 'App', 1715614142, 1),
(15, '2024-04-04-195255', 'App\\Database\\Migrations\\Dataikan', 'default', 'App', 1715614142, 1),
(16, '2024-04-04-205557', 'App\\Database\\Migrations\\Dataolahanhasil', 'default', 'App', 1715614142, 1),
(17, '2024-04-04-211202', 'App\\Database\\Migrations\\Datasampah', 'default', 'App', 1715614143, 1),
(18, '2024-04-04-212031', 'App\\Database\\Migrations\\Dataternak', 'default', 'App', 1715614143, 1),
(19, '2024-04-05-172942', 'App\\Database\\Migrations\\Datakomoditi', 'default', 'App', 1715614143, 1),
(20, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1715614215, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'dkppburuansae@mail.com', 'admindkpp', '$2y$10$WmphmMf6.bZQJR7o48xR8uiPGf7S8J.OHv4KDMHknBM28Wanb4qae', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-05-14 14:48:29', '2024-05-14 14:48:29', NULL),
(7, 'admindkpp@mail.com', 'dkppadmin', '$2y$10$1SBWH16/P0D3kT1U4E76SOeG20ThTGyisNsqtmp2VOQ3yZ5GBXp8C', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-05-14 14:49:08', '2024-05-14 14:49:08', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `data_buah`
--
ALTER TABLE `data_buah`
  ADD PRIMARY KEY (`id_buah`),
  ADD KEY `data_buah_id_kelompok_foreign` (`id_kelompok`);

--
-- Indexes for table `data_ikan`
--
ALTER TABLE `data_ikan`
  ADD PRIMARY KEY (`id_ikan`),
  ADD KEY `data_ikan_id_kelompok_foreign` (`id_kelompok`);

--
-- Indexes for table `data_kelompok`
--
ALTER TABLE `data_kelompok`
  ADD PRIMARY KEY (`id_kelompok`);

--
-- Indexes for table `data_komoditi`
--
ALTER TABLE `data_komoditi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_olahan_hasil`
--
ALTER TABLE `data_olahan_hasil`
  ADD PRIMARY KEY (`id_data_olahan_hasil`),
  ADD KEY `data_olahan_hasil_id_kelompok_foreign` (`id_kelompok`);

--
-- Indexes for table `data_sampah`
--
ALTER TABLE `data_sampah`
  ADD PRIMARY KEY (`id_data_sampah`),
  ADD KEY `data_sampah_id_kelompok_foreign` (`id_kelompok`);

--
-- Indexes for table `data_sayur`
--
ALTER TABLE `data_sayur`
  ADD PRIMARY KEY (`id_sayur`),
  ADD KEY `data_sayur_id_kelompok_foreign` (`id_kelompok`);

--
-- Indexes for table `data_tanaman_obat`
--
ALTER TABLE `data_tanaman_obat`
  ADD PRIMARY KEY (`id_tanaman_obat`),
  ADD KEY `data_tanaman_obat_id_kelompok_foreign` (`id_kelompok`);

--
-- Indexes for table `data_ternak`
--
ALTER TABLE `data_ternak`
  ADD PRIMARY KEY (`id_ternak`),
  ADD KEY `data_ternak_id_kelompok_foreign` (`id_kelompok`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `data_buah`
--
ALTER TABLE `data_buah`
  MODIFY `id_buah` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_ikan`
--
ALTER TABLE `data_ikan`
  MODIFY `id_ikan` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_kelompok`
--
ALTER TABLE `data_kelompok`
  MODIFY `id_kelompok` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_komoditi`
--
ALTER TABLE `data_komoditi`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_olahan_hasil`
--
ALTER TABLE `data_olahan_hasil`
  MODIFY `id_data_olahan_hasil` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_sampah`
--
ALTER TABLE `data_sampah`
  MODIFY `id_data_sampah` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_sayur`
--
ALTER TABLE `data_sayur`
  MODIFY `id_sayur` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_tanaman_obat`
--
ALTER TABLE `data_tanaman_obat`
  MODIFY `id_tanaman_obat` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_ternak`
--
ALTER TABLE `data_ternak`
  MODIFY `id_ternak` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `data_buah`
--
ALTER TABLE `data_buah`
  ADD CONSTRAINT `data_buah_id_kelompok_foreign` FOREIGN KEY (`id_kelompok`) REFERENCES `data_kelompok` (`id_kelompok`);

--
-- Constraints for table `data_ikan`
--
ALTER TABLE `data_ikan`
  ADD CONSTRAINT `data_ikan_id_kelompok_foreign` FOREIGN KEY (`id_kelompok`) REFERENCES `data_kelompok` (`id_kelompok`);

--
-- Constraints for table `data_olahan_hasil`
--
ALTER TABLE `data_olahan_hasil`
  ADD CONSTRAINT `data_olahan_hasil_id_kelompok_foreign` FOREIGN KEY (`id_kelompok`) REFERENCES `data_kelompok` (`id_kelompok`);

--
-- Constraints for table `data_sampah`
--
ALTER TABLE `data_sampah`
  ADD CONSTRAINT `data_sampah_id_kelompok_foreign` FOREIGN KEY (`id_kelompok`) REFERENCES `data_kelompok` (`id_kelompok`);

--
-- Constraints for table `data_sayur`
--
ALTER TABLE `data_sayur`
  ADD CONSTRAINT `data_sayur_id_kelompok_foreign` FOREIGN KEY (`id_kelompok`) REFERENCES `data_kelompok` (`id_kelompok`);

--
-- Constraints for table `data_tanaman_obat`
--
ALTER TABLE `data_tanaman_obat`
  ADD CONSTRAINT `data_tanaman_obat_id_kelompok_foreign` FOREIGN KEY (`id_kelompok`) REFERENCES `data_kelompok` (`id_kelompok`);

--
-- Constraints for table `data_ternak`
--
ALTER TABLE `data_ternak`
  ADD CONSTRAINT `data_ternak_id_kelompok_foreign` FOREIGN KEY (`id_kelompok`) REFERENCES `data_kelompok` (`id_kelompok`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

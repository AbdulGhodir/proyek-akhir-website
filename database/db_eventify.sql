-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 10, 2026 at 05:38 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_eventify`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id_event` int NOT NULL,
  `id_user` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `kategori` enum('Seminar','Webinar','Volunteer','Konser') NOT NULL,
  `waktu_pelaksanaan` datetime NOT NULL,
  `biaya` int DEFAULT '0',
  `lokasi` varchar(255) NOT NULL,
  `kuota` int NOT NULL,
  `deskripsi` text NOT NULL,
  `benefit` text,
  `cover_image` varchar(255) DEFAULT NULL,
  `status_publikasi` enum('pending','dipublikasi','ditolak') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_form`
--

CREATE TABLE `event_form` (
  `id_form` int NOT NULL,
  `id_event` int NOT NULL,
  `pertanyaan` varchar(255) NOT NULL,
  `tipe_input` enum('text','textarea','file') NOT NULL,
  `wajib_diisi` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jawaban_pendaftar`
--

CREATE TABLE `jawaban_pendaftar` (
  `id` int NOT NULL,
  `id_pendaftaran` int NOT NULL,
  `id_form` int NOT NULL,
  `jawaban_teks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id_pendaftaran` int NOT NULL,
  `id_user` int NOT NULL,
  `id_event` int NOT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `status_pendaftaran` enum('menunggu','diterima','ditolak') DEFAULT 'menunggu',
  `tanggal_daftar` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `nama_organisasi` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` enum('Admin','EO','User') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_lengkap`, `nama_organisasi`, `email`, `password`, `role`) VALUES
(12, 'Abdul Ghodir', NULL, 'eo@eventify.id', '$2y$10$7eNw5uZ0go9HMzVsfu07a.FfvOWMYlBBWzdeEfSkGaAbtFy9Ma3RC', 'User'),
(13, 'Rara', NULL, 'rara123@gmail.com', '$2y$10$b0.wFWtGn4omYZrDDYzxS.EC4z80BxO48uN9cXod4.IKU/GYfWVvu', 'User'),
(14, 'Abdul Ghodir Firdiansyah', 'HIMAKOM', 'himakom@eventify.com', '$2y$10$BDWFH8tF3DwpPGlr.cD6i.U/5aFSRB4TYQnSTJROWnmwplTyQKty6', 'EO'),
(15, 'Araa', 'Alala Ala', 'alalala@gmail.com', '$2y$10$IG0zw7jp/AsoubGFomGQlOmXNAZibVHALcc3O/8i7KjT/62z2NOIK', 'EO'),
(16, 'testing', NULL, 'testing@gmail.com', '$2y$10$cDBnwLRsbx3LlJ.JXA3AqumO0K78yIQsbrGCSf3lpgSbdofMiX6Pm', 'User'),
(17, 'admin', NULL, 'admin123@gmail.com', '$2y$10$Q/vAZA.Zp2tLOPewERkLJO/u5McL8swarw4ywGFlBaiv1OyGSl.dG', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id_event`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `event_form`
--
ALTER TABLE `event_form`
  ADD PRIMARY KEY (`id_form`),
  ADD KEY `id_event` (`id_event`);

--
-- Indexes for table `jawaban_pendaftar`
--
ALTER TABLE `jawaban_pendaftar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pendaftaran` (`id_pendaftaran`),
  ADD KEY `id_form` (`id_form`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_event` (`id_event`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id_event` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_form`
--
ALTER TABLE `event_form`
  MODIFY `id_form` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jawaban_pendaftar`
--
ALTER TABLE `jawaban_pendaftar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id_pendaftaran` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_form`
--
ALTER TABLE `event_form`
  ADD CONSTRAINT `event_form_ibfk_1` FOREIGN KEY (`id_event`) REFERENCES `event` (`id_event`) ON DELETE CASCADE;

--
-- Constraints for table `jawaban_pendaftar`
--
ALTER TABLE `jawaban_pendaftar`
  ADD CONSTRAINT `jawaban_pendaftar_ibfk_1` FOREIGN KEY (`id_pendaftaran`) REFERENCES `pendaftaran` (`id_pendaftaran`) ON DELETE CASCADE,
  ADD CONSTRAINT `jawaban_pendaftar_ibfk_2` FOREIGN KEY (`id_form`) REFERENCES `event_form` (`id_form`) ON DELETE CASCADE;

--
-- Constraints for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `pendaftaran_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pendaftaran_ibfk_2` FOREIGN KEY (`id_event`) REFERENCES `event` (`id_event`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 17, 2026 at 04:35 PM
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
  `id_kategori` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `waktu_pelaksanaan` datetime NOT NULL,
  `biaya` int DEFAULT '0',
  `lokasi` varchar(255) NOT NULL,
  `kuota` int NOT NULL,
  `deskripsi` text NOT NULL,
  `benefit` text,
  `cover_image` varchar(255) DEFAULT NULL,
  `status_publikasi` enum('Pending','Dipublikasikan','Ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id_event`, `id_user`, `id_kategori`, `judul`, `waktu_pelaksanaan`, `biaya`, `lokasi`, `kuota`, `deskripsi`, `benefit`, `cover_image`, `status_publikasi`, `created_at`) VALUES
(1, 21, 1, 'Volunteer Malam', '2026-05-18 14:30:00', 200000, 'Selat Sunda', 900, 'blabla blaa bliblibli blublublu, linggang guli guli  guli', NULL, NULL, 'Pending', '2026-05-15 15:32:19'),
(3, 21, 1, 'Volunteer Gerbang Alam', '2026-06-30 10:00:00', 10000000, 'Hutan Amazon', 170, 'Mengajar mata pelajaran dasar (matematika dan bahasa Inggris) kepada anak-anak kurang mampu di komunitas [Nama Daerah] setiap akhir pekan', NULL, NULL, 'Pending', '2026-05-15 16:00:44'),
(101, 102, 2, 'Seminar Nasional Teknologi AI', '2026-08-15 09:00:00', 50000, 'Aula Universitas Lampung', 150, 'Seminar interaktif yang membahas perkembangan AI di industri masa depan dan bagaimana mahasiswa bisa beradaptasi.', 'E-Sertifikat, Snack Box, Relasi Profesional', 'seminar_ai.jpg', 'Dipublikasikan', '2026-05-17 16:34:20'),
(102, 102, 3, 'Webinar UI/UX Design Fundamental', '2026-08-20 19:00:00', 0, 'Zoom Meeting', 300, 'Belajar dasar UI/UX untuk pemula bersama expert dari industri teknologi.', 'Ilmu bermanfaat, Grup Telegram Komunitas', 'webinar_uiux.jpg', 'Dipublikasikan', '2026-05-17 16:34:20'),
(103, 103, 1, 'Volunteer Aksi Bersih Pantai Mutun', '2026-09-01 07:00:00', 0, 'Pantai Mutun, Pesawaran', 50, 'Aksi nyata membersihkan sampah plastik di pesisir pantai bersama pemuda-pemudi peduli lingkungan.', 'Sertifikat Relawan, Makan Siang, Transportasi', 'volunteer_pantai.jpg', 'Pending', '2026-05-17 16:34:20'),
(104, 103, 4, 'Konser Amal Musik Indie', '2026-10-10 18:30:00', 100000, 'Lapangan PKOR Way Halim', 500, 'Konser penggalangan dana untuk korban bencana alam dengan menghadirkan band indie lokal.', 'Tiket Konser Fisik, Donasi', 'konser_amal.jpg', 'Ditolak', '2026-05-17 16:34:20');

-- --------------------------------------------------------

--
-- Table structure for table `event_form`
--

CREATE TABLE `event_form` (
  `id_form` int NOT NULL,
  `id_event` int NOT NULL,
  `pertanyaan` varchar(255) NOT NULL,
  `tipe_input` enum('teks','paragraf','dropdown','tanggal','angka','file') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `opsi_pilihan` text,
  `wajib_diisi` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_form`
--

INSERT INTO `event_form` (`id_form`, `id_event`, `pertanyaan`, `tipe_input`, `opsi_pilihan`, `wajib_diisi`) VALUES
(14, 1, 'Nama', 'teks', NULL, 1),
(15, 1, 'NPM', 'teks', NULL, 1),
(16, 1, 'Kelas', 'dropdown', 'A,B', 1),
(17, 1, 'Motivasi', 'paragraf', NULL, 0),
(18, 1, 'Prestasi', 'paragraf', NULL, 0),
(19, 1, 'Turu AE', 'teks', NULL, 1),
(20, 3, 'Nama', 'teks', NULL, 1),
(21, 3, 'NPM', 'teks', NULL, 1),
(22, 3, 'Kelas', 'dropdown', 'A,B,PSDKU Way Kanan', 1),
(23, 3, 'Prodi', 'dropdown', 'Ilmu Komputer,Sistem Informasi,Manajemen Informatika', 1),
(24, 3, 'Motivasi', 'paragraf', NULL, 0),
(25, 3, 'Potensi Diri', 'paragraf', NULL, 0),
(101, 101, 'Nama Lengkap (Sesuai Sertifikat)', 'teks', NULL, 1),
(102, 101, 'Asal Instansi / Kampus', 'teks', NULL, 1),
(103, 101, 'Status Saat Ini', 'dropdown', 'Mahasiswa,Pelajar,Pekerja IT,Umum', 1),
(104, 101, 'Apa yang ingin Anda pelajari di seminar ini?', 'paragraf', NULL, 0),
(105, 102, 'Nama Panggilan', 'teks', NULL, 1),
(106, 102, 'Akun Instagram / LinkedIn (Opsional)', 'teks', NULL, 0),
(107, 102, 'Apakah pernah belajar desain sebelumnya?', 'dropdown', 'Belum Pernah,Pernah Sedikit,Sudah Mahir', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jawaban_pendaftar`
--

CREATE TABLE `jawaban_pendaftar` (
  `id` int NOT NULL,
  `id_pendaftaran` int NOT NULL,
  `id_form` int NOT NULL,
  `jawaban_teks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jawaban_pendaftar`
--

INSERT INTO `jawaban_pendaftar` (`id`, `id_pendaftaran`, `id_form`, `jawaban_teks`) VALUES
(101, 101, 101, 'Andi Saputra Wijaya'),
(102, 101, 102, 'Universitas Lampung'),
(103, 101, 103, 'Mahasiswa'),
(104, 101, 104, 'Saya ingin tahu cara kerja AI untuk membantu proses pembuatan skripsi.'),
(105, 102, 101, 'Rina Melati'),
(106, 102, 102, 'Politeknik Negeri Lampung'),
(107, 102, 103, 'Mahasiswa'),
(108, 102, 104, 'Ingin menambah wawasan dan mencari relasi.'),
(109, 103, 105, 'Dodi'),
(110, 103, 106, '@dodi_design_keren'),
(111, 103, 107, 'Pernah Sedikit');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
(1, 'Volunteer'),
(2, 'Seminar'),
(3, 'Webinar'),
(4, 'Konser'),
(5, 'Lomba');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id_pendaftaran`, `id_user`, `id_event`, `bukti_pembayaran`, `status_pendaftaran`, `tanggal_daftar`) VALUES
(101, 104, 101, 'bukti_trf_andi.jpg', 'diterima', '2026-05-16 10:00:00'),
(102, 105, 101, 'bukti_trf_rina.jpg', 'menunggu', '2026-05-17 11:30:00'),
(103, 106, 102, NULL, 'diterima', '2026-05-17 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `nama_organisasi` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('Admin','EO','User') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_lengkap`, `nama_organisasi`, `email`, `password`, `role`) VALUES
(14, 'Abdul Ghodir Firdiansyah', 'HIMAKOM', 'himakom@eventify.com', '$2y$10$BDWFH8tF3DwpPGlr.cD6i.U/5aFSRB4TYQnSTJROWnmwplTyQKty6', 'EO'),
(17, 'admin', NULL, 'admin123@gmail.com', '$2y$10$Q/vAZA.Zp2tLOPewERkLJO/u5McL8swarw4ywGFlBaiv1OyGSl.dG', 'Admin'),
(18, 'Scarlet', 'Volunteer Jaya', 'volunjay@gmail.com', '$2y$10$z9dV6C6MJAOrw5vA3vlQF.yiweAx7hkoy/WwYA73bc2wuAwPlf7gC', 'EO'),
(19, 'Abdul Ghodir', NULL, 'user@eventify.id', '$2y$10$VlgFsvAgp3eLOcuMIDC.peCjB1kQV8PntTNgxPJK76z9D7/6ki9rG', 'User'),
(20, 'Abdul', NULL, 'abdul12345@gmail.com', '$2y$10$68zJlqk5x5qnYOAm9o20ReLTaBI8VwjzJuzmX7Dll3gtLfnEs3NUu', 'User'),
(21, 'Admin Event', 'Eventify', 'eo@gmail.com', '$2y$10$8csQK6J/GupWVcyYYaAj5egojPKQzByyixcSnVyeVvKP3a2GIWJQW', 'EO'),
(22, 'Abdul Ghodir', '', 'user@gmail.com', '$2y$10$yxd0bN8a2wcj6Uyx0QIy2.GmxJ8yn8biNllhw3ZGXlR6sGO8VXnX.', 'User'),
(101, 'Super Admin', NULL, 'admin.baru@eventify.com', '$2y$10$8csQK6J/GupWVcyYYaAj5egojPKQzByyixcSnVyeVvKP3a2GIWJQW', 'Admin'),
(102, 'Budi Organizer', 'Budi Events', 'eo.budi@gmail.com', '$2y$10$8csQK6J/GupWVcyYYaAj5egojPKQzByyixcSnVyeVvKP3a2GIWJQW', 'EO'),
(103, 'Siti Planner', 'Siti Kreasi', 'eo.siti@gmail.com', '$2y$10$8csQK6J/GupWVcyYYaAj5egojPKQzByyixcSnVyeVvKP3a2GIWJQW', 'EO'),
(104, 'Andi Peserta', NULL, 'andi@gmail.com', '$2y$10$8csQK6J/GupWVcyYYaAj5egojPKQzByyixcSnVyeVvKP3a2GIWJQW', 'User'),
(105, 'Rina Relawan', NULL, 'rina@gmail.com', '$2y$10$8csQK6J/GupWVcyYYaAj5egojPKQzByyixcSnVyeVvKP3a2GIWJQW', 'User'),
(106, 'Dodi Mahasiswa', NULL, 'dodi@gmail.com', '$2y$10$8csQK6J/GupWVcyYYaAj5egojPKQzByyixcSnVyeVvKP3a2GIWJQW', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id_event`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `event_kategori_fk` (`id_kategori`);

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
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

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
  MODIFY `id_event` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `event_form`
--
ALTER TABLE `event_form`
  MODIFY `id_form` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `jawaban_pendaftar`
--
ALTER TABLE `jawaban_pendaftar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id_pendaftaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_kategori_fk` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE RESTRICT;

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

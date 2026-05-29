-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 29, 2026 at 06:15 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

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
  `cover_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status_publikasi` enum('Pending','Dipublikasikan','Ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id_event`, `id_user`, `id_kategori`, `judul`, `waktu_pelaksanaan`, `biaya`, `lokasi`, `kuota`, `deskripsi`, `benefit`, `cover_image`, `status_publikasi`, `created_at`) VALUES
(101, 21, 3, ' Webinar Nasional Teknologi AI', '2005-10-19 23:56:00', 50000000, 'GSG Unila', 1, 'Seminar interaktif yang membahas perkembangan AI di industri masa depan dan bagaimana mahasiswa bisa beradaptasi.', 'Uang Tunai 1000M', 'tech-seminar.png', 'Dipublikasikan', '2026-05-17 16:34:20'),
(102, 102, 3, 'Webinar UI/UX Design Fundamental', '2026-08-20 19:00:00', 0, 'Zoom Meeting', 300, 'Belajar dasar UI/UX untuk pemula bersama expert dari industri teknologi.', 'Ilmu bermanfaat, Grup Telegram Komunitas', 'ui-ux-webinar.png', 'Dipublikasikan', '2026-05-17 16:34:20'),
(103, 103, 1, 'Volunteer Aksi Bersih Pantai Mutun', '2026-09-01 07:00:00', 0, 'Pantai Mutun, Pesawaran', 50, 'Aksi nyata membersihkan sampah plastik di pesisir pantai bersama pemuda-pemudi peduli lingkungan.', 'Sertifikat Relawan, Makan Siang, Transportasi', 'beach-volunteer.png', 'Dipublikasikan', '2026-05-17 16:34:20'),
(104, 103, 4, 'Konser Amal Musik Indie', '2026-10-10 18:30:00', 100000, 'Lapangan PKOR Way Halim', 500, 'Konser penggalangan dana untuk korban bencana alam dengan menghadirkan band indie lokal.', 'Tiket Konser Fisik, Donasi', 'music-concert.png', 'Dipublikasikan', '2026-05-17 16:34:20'),
(127, 21, 4, 'Lampung Vest', '2006-07-12 20:16:00', 300000, 'Lapangan GSG', 1000, 'Acara menyenangkan dengan banyak kegiatan seru di Lampung dengan tamu Artis terkenal yaitu Hindia dan Yungkai', 'Saliman dengan Yungkai', 'music-concert.png', 'Dipublikasikan', '2026-05-19 13:26:18'),
(130, 21, 2, 'Seminar Nasional Cyber Security 2026', '2026-11-10 08:00:00', 75000, 'Gedung Serba Guna Unila', 200, 'Seminar membahas tren keamanan siber di era digital bersama praktisi industri teknologi terkemuka.', 'Sertifikat, Seminar Kit, Makan Siang, Relasi', 'tech-seminar.png', 'Dipublikasikan', '2026-05-19 14:49:22'),
(131, 21, 5, 'Hackathon Mahasiswa Nasional (HACKNAS)', '2026-12-01 08:00:00', 150000, 'Lab Komputer Universitas Lampung', 50, 'Kompetisi membuat aplikasi inovatif penyelesaian masalah sosial dalam waktu 48 jam non-stop.', 'Uang Tunai Jutaan Rupiah, Sertifikat Nasional, Trofi', 'tech-seminar.png', 'Dipublikasikan', '2026-05-19 14:49:22'),
(132, 21, 3, 'Masterclass React JS untuk Pemula', '2026-09-25 19:00:00', 0, 'Zoom Meeting', 500, 'Belajar membuat website interaktif menggunakan framework React JS dari nol bersama Senior Front-End Developer.', 'Modul Belajar, Recording Kelas, Grup Mentoring', 'tech-seminar.png', 'Dipublikasikan', '2026-05-19 14:49:22'),
(134, 21, 4, 'Festival Musik Akhir Tahun', '2026-12-31 19:00:00', 120000, 'Lapangan Rektorat Unila', 2000, 'Konser perayaan akhir tahun yang meriah dengan penampilan dari band-band lokal indie dan artis ibukota.', 'Tiket Fisik Eksklusif, Merchandise, Doorprize', 'music-concert.png', 'Dipublikasikan', '2026-05-19 14:49:22'),
(136, 21, 1, 'Volunteer', '2026-05-22 21:17:00', 100000, 'Aula GSG', 100, '1234456', NULL, 'volunteer-malam.png', 'Dipublikasikan', '2026-05-22 14:18:55'),
(137, 21, 4, 'Lampung Cihuyy', '2026-05-01 23:14:00', 0, 'Hutan Amazon', 100, 'Event asik seru menyenangkan', '1000M', 'volunteer-gerbang-alam.png', 'Dipublikasikan', '2026-05-24 15:16:35');

-- --------------------------------------------------------

--
-- Table structure for table `event_form`
--

CREATE TABLE `event_form` (
  `id_form` int NOT NULL,
  `id_event` int NOT NULL,
  `pertanyaan` varchar(255) NOT NULL,
  `tipe_input` enum('teks','paragraf','dropdown','tanggal','angka','file') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `opsi_pilihan` text,
  `wajib_diisi` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `event_form`
--

INSERT INTO `event_form` (`id_form`, `id_event`, `pertanyaan`, `tipe_input`, `opsi_pilihan`, `wajib_diisi`) VALUES
(101, 101, 'Nama Lengkap (Sesuai Sertifikat)', 'teks', NULL, 1),
(102, 101, 'Asal Instansi / Kampus', 'teks', NULL, 1),
(103, 101, 'Status Saat Ini', 'dropdown', 'Mahasiswa,Pelajar,Pekerja IT,Umum', 1),
(104, 101, 'Apa yang ingin Anda pelajari di seminar ini?', 'paragraf', NULL, 0),
(105, 102, 'Nama Panggilan', 'teks', NULL, 1),
(106, 102, 'Akun Instagram / LinkedIn (Opsional)', 'teks', NULL, 0),
(107, 102, 'Apakah pernah belajar desain sebelumnya?', 'dropdown', 'Belum Pernah,Pernah Sedikit,Sudah Mahir', 1),
(120, 127, 'Nama', 'teks', NULL, 1),
(121, 127, 'Kursi', 'dropdown', 'Reguler,VIP,VVIP', 1),
(122, 130, 'Nama Lengkap (Untuk Sertifikat)', 'teks', NULL, 1),
(123, 130, 'Asal Instansi / Universitas', 'teks', NULL, 1),
(124, 130, 'Apakah Anda sudah pernah belajar Cyber Security?', 'dropdown', 'Belum Pernah,Pernah Sedikit,Sudah Mahir', 1),
(125, 131, 'Nama Tim', 'teks', NULL, 1),
(126, 131, 'Nama Anggota Tim (Pisahkan dengan koma)', 'paragraf', NULL, 1),
(127, 131, 'Link Portofolio Ketua Tim (Opsional)', 'teks', NULL, 0),
(128, 132, 'Nama Panggilan', 'teks', NULL, 1),
(129, 132, 'Apa yang ingin Anda capai setelah belajar React JS?', 'paragraf', NULL, 1),
(133, 134, 'Nama Sesuai KTP / Kartu Pelajar', 'teks', NULL, 1),
(134, 134, 'Kategori Tiket', 'dropdown', 'Festival,VIP', 1),
(135, 134, 'Upload Foto KTP / Kartu Pelajar', 'file', NULL, 1),
(138, 136, 'Nama', 'teks', NULL, 1),
(139, 136, 'Kelas', 'dropdown', 'A,B,C', 1),
(140, 137, 'Nama Lengkap (Sesuai Sertifikat)', 'teks', NULL, 1),
(141, 137, 'Email', 'teks', NULL, 1),
(142, 137, 'Pilih Fraksi', 'dropdown', 'Api,Angin,Tanah,Air,Petir', 1),
(143, 137, 'Motivasi', 'paragraf', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jawaban_pendaftar`
--

CREATE TABLE `jawaban_pendaftar` (
  `id` int NOT NULL,
  `id_pendaftaran` int NOT NULL,
  `id_form` int NOT NULL,
  `jawaban` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jawaban_pendaftar`
--

INSERT INTO `jawaban_pendaftar` (`id`, `id_pendaftaran`, `id_form`, `jawaban`) VALUES
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
(111, 103, 107, 'Pernah Sedikit'),
(112, 110, 122, 'Abdul Ghodir Firdiansyah'),
(113, 110, 123, 'Universitas Lampung'),
(114, 110, 124, 'Belum Pernah'),
(115, 111, 125, 'Tim CodeCrafters'),
(116, 111, 126, 'Andi, Surya, Fahmi'),
(117, 111, 127, 'https://github.com/andi-peserta'),
(118, 112, 128, 'Rina'),
(119, 112, 129, 'Ingin bisa membuat web interaktif untuk tugas akhir kuliah.'),
(123, 114, 133, 'Abdul Ghodir'),
(124, 114, 134, 'Festival'),
(125, 114, 135, 'foto_ktp_abdul.jpg'),
(126, 115, 120, 'Abdul Ghodir'),
(127, 115, 121, 'VIP'),
(128, 116, 120, 'Abdul'),
(129, 116, 121, 'Reguler'),
(130, 117, 120, 'Andi Jaya'),
(131, 117, 121, 'VVIP'),
(132, 118, 120, 'Rina Melati'),
(133, 118, 121, 'Reguler'),
(134, 119, 120, 'Dodi Setiawan'),
(135, 119, 121, 'VIP'),
(136, 120, 101, 'Abdul Ghodir Firdiansyah'),
(137, 120, 102, 'Universitas Lampung'),
(138, 120, 103, 'Pelajar'),
(139, 120, 104, 'Saya ingin mengetahui lebih lanjut tentang AI, saya ingin memperluas wawasan terkait AI'),
(140, 121, 120, 'Skizoo'),
(141, 121, 121, 'VVIP'),
(142, 122, 138, 'Cembre'),
(143, 122, 139, 'B'),
(144, 123, 140, 'Skizoo'),
(145, 123, 141, 'skizoo@gmail.com'),
(146, 123, 142, 'Petir'),
(147, 123, 143, 'Pengen jadi Avatar');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `status_pendaftaran` enum('menunggu','diterima','ditolak') DEFAULT 'menunggu',
  `tanggal_daftar` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id_pendaftaran`, `id_user`, `id_event`, `status_pendaftaran`, `tanggal_daftar`) VALUES
(101, 104, 101, 'diterima', '2026-05-16 10:00:00'),
(102, 105, 101, 'diterima', '2026-05-17 11:30:00'),
(103, 106, 102, 'diterima', '2026-05-17 12:00:00'),
(110, 19, 130, 'diterima', '2026-05-19 22:16:03'),
(111, 104, 131, 'diterima', '2026-05-19 22:16:03'),
(112, 105, 132, 'diterima', '2026-05-19 22:16:03'),
(114, 108, 134, 'diterima', '2026-05-19 22:16:03'),
(115, 19, 127, 'diterima', '2026-05-19 22:57:11'),
(116, 20, 127, 'diterima', '2026-05-19 22:57:11'),
(117, 104, 127, 'ditolak', '2026-05-19 22:57:11'),
(118, 105, 127, 'diterima', '2026-05-19 22:57:11'),
(119, 106, 127, 'diterima', '2026-05-19 22:57:11'),
(120, 108, 101, 'diterima', '2026-05-28 20:29:10'),
(121, 108, 127, 'ditolak', '2026-05-28 20:50:38'),
(122, 108, 136, 'ditolak', '2026-05-28 20:52:30'),
(123, 108, 137, 'diterima', '2026-05-28 20:53:20');

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
(14, 'Abdul Ghodir Firdiansyah', 'HIMAKOM', 'himakom@eventify.com', '$2y$10$BDWFH8tF3DwpPGlr.cD6i.U/5aFSRB4TYQnSTJROWnmwplTyQKty6', 'EO'),
(17, 'admin', NULL, 'admin123@gmail.com', '$2y$10$Q/vAZA.Zp2tLOPewERkLJO/u5McL8swarw4ywGFlBaiv1OyGSl.dG', 'Admin'),
(18, 'Scarlet', 'Volunteer Jaya', 'volunjay@gmail.com', '$2y$10$z9dV6C6MJAOrw5vA3vlQF.yiweAx7hkoy/WwYA73bc2wuAwPlf7gC', 'EO'),
(19, 'Abdul Ghodir', NULL, 'user@eventify.id', '$2y$10$VlgFsvAgp3eLOcuMIDC.peCjB1kQV8PntTNgxPJK76z9D7/6ki9rG', 'User'),
(20, 'Abdul', NULL, 'abdul12345@gmail.com', '$2y$10$68zJlqk5x5qnYOAm9o20ReLTaBI8VwjzJuzmX7Dll3gtLfnEs3NUu', 'User'),
(21, 'Admin Event', 'Eventify', 'eo@gmail.com', '$2y$10$8csQK6J/GupWVcyYYaAj5egojPKQzByyixcSnVyeVvKP3a2GIWJQW', 'EO'),
(101, 'Super Admin', NULL, 'admin.baru@eventify.com', '$2y$10$8csQK6J/GupWVcyYYaAj5egojPKQzByyixcSnVyeVvKP3a2GIWJQW', 'Admin'),
(102, 'Budi Organizer', 'Budi Events', 'eo.budi@gmail.com', '$2y$10$8csQK6J/GupWVcyYYaAj5egojPKQzByyixcSnVyeVvKP3a2GIWJQW', 'EO'),
(103, 'Siti Planner', 'Siti Kreasi', 'eo.siti@gmail.com', '$2y$10$8csQK6J/GupWVcyYYaAj5egojPKQzByyixcSnVyeVvKP3a2GIWJQW', 'EO'),
(104, 'Andi Peserta', NULL, 'andi@gmail.com', '$2y$10$8csQK6J/GupWVcyYYaAj5egojPKQzByyixcSnVyeVvKP3a2GIWJQW', 'User'),
(105, 'Rina Relawan', NULL, 'rina@gmail.com', '$2y$10$8csQK6J/GupWVcyYYaAj5egojPKQzByyixcSnVyeVvKP3a2GIWJQW', 'User'),
(106, 'Dodi Mahasiswa', NULL, 'dodi@gmail.com', '$2y$10$8csQK6J/GupWVcyYYaAj5egojPKQzByyixcSnVyeVvKP3a2GIWJQW', 'User'),
(108, 'Abdul Ghodir', NULL, 'pengguna@gmail.com', '$2y$10$PaYbXOdesYVFXKVlI8AWc.3fl7A53t6ONLXACo46d5MArLbkct5k2', 'User'),
(109, 'Abdul Ghodir Firdiansyah', 'Volunteer Jaya', 'event@gmail.com', '$2y$10$Geapt/JP/q4Y2wRqZnyQTuA8mMAEcr6c.DFQ8eM2.68vEgP.mGENu', 'EO'),
(110, 'Indriyani Talitha Putri', NULL, 'indritp3@gmail.com', '$2y$10$Sj1q1OkV/ZbRPLYZT0Ke2.7mYpeMem3qX2edLc1VJwD4ZzhdPeNny', 'User');

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
  MODIFY `id_event` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `event_form`
--
ALTER TABLE `event_form`
  MODIFY `id_form` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `jawaban_pendaftar`
--
ALTER TABLE `jawaban_pendaftar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id_pendaftaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

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

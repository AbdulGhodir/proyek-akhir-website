<?php
require_once '../../config/config.php';
require_once '../../../koneksi/koneksi.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'User') {
    header("Location: " . BASEURL . "/app/controllers/auth/login.php");
    exit();
}

$pageTitle = "Riwayat Pendaftaran | Eventify";

$history = [
  [
    'title' => 'Tech Future Summit 2026',
    'type' => 'Seminar',
    'date' => '18 Mei 2026',
    'location' => 'Swiss-Belhotel Lampung',
    'status' => 'Diterima',
    'image' => BASEURL . '/assets/images/image.png'
  ],

  [
    'title' => 'Digital Marketing for Beginner',
    'type' => 'Seminar',
    'date' => '12 Mei 2026',
    'location' => 'Bandar Lampung',
    'status' => 'Menunggu Verifikasi',
    'image' => BASEURL . '/assets/images/image.png'
  ],

  [
    'title' => 'Coastal Cleanup Movement',
    'type' => 'Volunteer',
    'date' => '15 Mei 2026',
    'location' => 'Pantai Mutun',
    'status' => 'Ditolak',
    'reason' => 'Kuota peserta telah penuh',
    'image' => BASEURL . '/assets/images/volunteer.jpeg'
  ],

  [
    'title' => 'AI For Student Career',
    'type' => 'Webinar',
    'date' => '21 Mei 2026',
    'location' => 'Zoom Meeting',
    'status' => 'Diterima',
    'image' => BASEURL . '/assets/images/image.png'
  ],
];

require_once '../../views/user/riwayat-pendaftaran.php';
?>
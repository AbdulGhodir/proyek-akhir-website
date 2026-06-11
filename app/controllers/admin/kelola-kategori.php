<?php
require_once '../../config/config.php';
require_once '../../../koneksi/koneksi.php';
require_once '../../models/KategoriModel.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: ' . BASEURL . '/app/controllers/auth/login.php');
    exit;
}

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$semua_kategori  = getAllKategori($conn);

$kat_selected    = null;
$events_in_kat   = [];
$kat_id_selected = (int)($_GET['kat'] ?? 0);

if ($kat_id_selected > 0) {
    $kat_selected  = getKategoriById($conn, $kat_id_selected);
    $events_in_kat = getEventByKategori($conn, $kat_id_selected);
}

$badge_color = [
    'Volunteer' => 'green',
    'Seminar'   => 'blue',
    'Webinar'   => 'yellow',
    'Konser'    => 'purple',
    'Lomba'     => 'red',
];
$badge_emoji = [
    'Volunteer' => '🤝',
    'Seminar'   => '🎓',
    'Webinar'   => '💻',
    'Konser'    => '🎵',
    'Lomba'     => '🏆',
];
$status_badge = [
    'Dipublikasikan' => 'green',
    'Pending'        => 'yellow',
    'Ditolak'        => 'red',
];

require_once '../../views/admin/kelola-kategori.php';
?>
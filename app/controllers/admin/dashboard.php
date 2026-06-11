<?php
require_once '../../config/config.php';
require_once '../../../koneksi/koneksi.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: ' . BASEURL . '/app/controllers/auth/login.php');
    exit;
}

$checkCol = $conn->query("SHOW COLUMNS FROM `event` LIKE 'alasan_penolakan'");
if (!$checkCol || $checkCol->num_rows == 0) {
    $conn->query("ALTER TABLE `event` ADD `alasan_penolakan` TEXT NULL;");
}
$checkUsers = $conn->query("SHOW COLUMNS FROM `users` LIKE 'status'");
if (!$checkUsers || $checkUsers->num_rows == 0) {
    $conn->query("ALTER TABLE `users` ADD `status` ENUM('aktif','suspended') NOT NULL DEFAULT 'aktif';");
}


$checkCover = $conn->query("SELECT cover_image FROM event WHERE id_event = 1 LIMIT 1");
if ($checkCover) {
    $row = $checkCover->fetch_assoc();
    if ($row && ($row['cover_image'] === NULL || $row['cover_image'] === '')) {
        $conn->query("UPDATE `event` SET `cover_image` = 'volunteer-malam.png'        WHERE `id_event` = 1;");
        $conn->query("UPDATE `event` SET `cover_image` = 'volunteer-gerbang-alam.png' WHERE `id_event` = 3;");
        $conn->query("UPDATE `event` SET `cover_image` = 'tech-seminar.png'           WHERE `id_event` = 101;");
        $conn->query("UPDATE `event` SET `cover_image` = 'ui-ux-webinar.png'          WHERE `id_event` = 102;");
        $conn->query("UPDATE `event` SET `cover_image` = 'beach-volunteer.png'        WHERE `id_event` = 103;");
        $conn->query("UPDATE `event` SET `cover_image` = 'music-concert.png'          WHERE `id_event` = 104;");
        $conn->query("UPDATE `event` SET `status_publikasi` = 'Pending'        WHERE `status_publikasi` = 'pending';");
        $conn->query("UPDATE `event` SET `status_publikasi` = 'Dipublikasikan' WHERE `status_publikasi` IN ('dipublikasikan','dipublikasi');");
        $conn->query("UPDATE `event` SET `status_publikasi` = 'Ditolak'        WHERE `status_publikasi` = 'ditolak';");
    }
}

// ── Statistik ───────────────────────────────────────────────────────────────
$q_users      = $conn->query("SELECT COUNT(*) AS total FROM users WHERE role = 'User'");
$total_users  = $q_users ? $q_users->fetch_assoc()['total'] : 0;

$q_eo         = $conn->query("SELECT COUNT(*) AS total FROM users WHERE role = 'EO'");
$total_eo     = $q_eo    ? $q_eo->fetch_assoc()['total']   : 0;

$q_pend       = $conn->query("SELECT COUNT(*) AS total FROM event WHERE status_publikasi = 'Pending'");
$total_pending = $q_pend ? $q_pend->fetch_assoc()['total'] : 0;

$q_pub        = $conn->query("SELECT COUNT(*) AS total FROM event WHERE status_publikasi = 'Dipublikasikan'");
$total_pub    = $q_pub   ? $q_pub->fetch_assoc()['total']  : 0;

$q_tol        = $conn->query("SELECT COUNT(*) AS total FROM event WHERE status_publikasi = 'Ditolak'");
$total_tol    = $q_tol   ? $q_tol->fetch_assoc()['total']  : 0;


$q_feed = $conn->query("
    SELECT e.id_event, e.judul, k.kategori, e.created_at, e.cover_image,
           u.nama_lengkap, u.nama_organisasi
    FROM   event e
    JOIN   users    u ON e.id_user     = u.id
    JOIN   kategori k ON e.id_kategori = k.id_kategori
    WHERE  e.status_publikasi = 'Pending'
    ORDER  BY e.created_at DESC
    LIMIT  5
");

$q_pulse  = $conn->query("
    SELECT k.kategori, COUNT(e.id_event) AS total
    FROM   kategori k
    LEFT JOIN event e ON e.id_kategori = k.id_kategori
    GROUP  BY k.id_kategori, k.kategori
    ORDER  BY total DESC
");
$pulse_data = [];
$pulse_max  = 1;
if ($q_pulse) {
    while ($row = $q_pulse->fetch_assoc()) {
        $pulse_data[] = $row;
        if ($row['total'] > $pulse_max) $pulse_max = $row['total'];
    }
}


$q_reg = $conn->query("
    SELECT p.tanggal_daftar, u.nama_lengkap, e.judul, e.id_event
    FROM   pendaftaran p
    JOIN   users u ON p.id_user  = u.id
    JOIN   event e ON p.id_event = e.id_event
    ORDER  BY p.tanggal_daftar DESC
    LIMIT  5
");


function relative_time(string $dt): string {
    $diff = time() - strtotime($dt);
    if ($diff < 60)    return 'Baru saja';
    if ($diff < 3600)  return floor($diff / 60)  . ' menit lalu';
    if ($diff < 86400) return floor($diff / 3600) . ' jam lalu';
    return floor($diff / 86400) . ' hari lalu';
}

$cat_color = [
    'Seminar'   => 'cat-seminar',
    'Webinar'   => 'cat-webinar',
    'Volunteer' => 'cat-volunteer',
    'Konser'    => 'cat-konser',
    'Lomba'     => 'cat-lomba',
];
$cat_badge = [
    'Seminar'   => 'blue',
    'Webinar'   => 'yellow',
    'Volunteer' => 'green',
    'Konser'    => 'purple',
    'Lomba'     => 'red',
];
$cat_emoji = [
    'Seminar'   => '🎓',
    'Webinar'   => '💻',
    'Volunteer' => '🤝',
    'Konser'    => '🎵',
    'Lomba'     => '🏆',
];

require_once '../../views/admin/dashboard.php';
<?php
require_once '../../config/config.php';
require_once '../../../koneksi/koneksi.php';

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

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: ' . BASEURL . '/app/views/auth/login.php');
    exit;
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
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin | Eventify</title>
    <meta name="description" content="Command center admin Eventify - pantau pengguna, EO, dan event pending.">
    <link rel="stylesheet" href="<?= BASEURL ?>/assets/css/global.css">
</head>
<body class="admin-page">

<?php include 'sidebar.php'; ?>

<main class="main">

  
    <div class="page-header">
        <h1>Dashboard</h1>
        <p>Selamat datang kembali, <strong><?= htmlspecialchars($_SESSION['nama_lengkap'] ?? 'Admin') ?></strong> 👋</p>
    </div>


    <div class="hero-banner">
        <div class="hero-label">
            <span class="live-dot <?= $total_pending > 0 ? 'yellow' : 'green' ?>"></span>
            ADMINISTRATOR
            <?= $total_pending > 0 ? '— ' . $total_pending . ' Event Menunggu' : '— Semua Bersih' ?>
        </div>
        <h2>Command Center Eventify</h2>
        <p>Pantau aktivitas platform, kelola pengguna &amp; EO, serta validasi event secara real-time.</p>
    </div>

 
    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-icon teal"><i class='bx bxs-user'></i></div>
            <div>
                <div class="stat-val"><?= $total_users ?></div>
                <div class="stat-label">Total Pengguna</div>
                <div class="stat-ctx">Role: User</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon gold"><i class='bx bxs-building-house'></i></div>
            <div>
                <div class="stat-val"><?= $total_eo ?></div>
                <div class="stat-label">Total Event Organizer</div>
                <div class="stat-ctx">Terdaftar aktif</div>
            </div>
        </div>

        <div class="stat-card <?= $total_pending > 0 ? 'urgent' : '' ?>">
            <div class="stat-icon orange"><i class='bx bxs-time-five'></i></div>
            <div>
                <div class="stat-val"><?= $total_pending ?></div>
                <div class="stat-label">Event Menunggu Validasi</div>
                <div class="stat-ctx" style="color:<?= $total_pending > 0 ? '#EF4444' : '#22C55E' ?>">
                    <?= $total_pending > 0 ? 'Perlu ditinjau segera' : 'Tidak ada antrian' ?>
                </div>
            </div>
        </div>
    </div>

 
    <div class="stat-grid" style="margin-top:-12px; margin-bottom:32px;">
        <div class="stat-card">
            <div class="stat-icon" style="background:linear-gradient(135deg,#22C55E,#16A34A)">
                <i class='bx bx-check-circle'></i>
            </div>
            <div>
                <div class="stat-val"><?= $total_pub ?></div>
                <div class="stat-label">Event Dipublikasikan</div>
                <div class="stat-ctx" style="color:#22C55E">Aktif di platform</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background:linear-gradient(135deg,#EF4444,#DC2626)">
                <i class='bx bx-x-circle'></i>
            </div>
            <div>
                <div class="stat-val"><?= $total_tol ?></div>
                <div class="stat-label">Event Ditolak</div>
                <div class="stat-ctx" style="color:#EF4444">Tidak lolos validasi</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background:linear-gradient(135deg,#8B5CF6,#7C3AED)">
                <i class='bx bx-calendar-event'></i>
            </div>
            <div>
                <div class="stat-val"><?= $total_pending + $total_pub + $total_tol ?></div>
                <div class="stat-label">Total Event</div>
                <div class="stat-ctx">Seluruh platform</div>
            </div>
        </div>
    </div>


    <div class="dash-grid">

    
        <div class="card">
            <div class="card-head">
                <h3>
                    <i class='bx bx-time-five' style="color:var(--warning);vertical-align:middle;margin-right:6px;font-size:20px;"></i>
                    Antrian Validasi Terbaru
                </h3>
                <a href="<?= BASEURL ?>/app/views/admin/validasi.php">Lihat semua →</a>
            </div>

            <div class="feed-list">
                <?php if ($q_feed && $q_feed->num_rows > 0): ?>
                    <?php while ($ev = $q_feed->fetch_assoc()): ?>
                        <?php
                            $cls      = $cat_color[$ev['kategori']] ?? '';
                            $bdg      = $cat_badge[$ev['kategori']] ?? 'blue';
                            $ico      = $cat_emoji[$ev['kategori']] ?? '📅';
                            $eo_label = $ev['nama_organisasi'] ?: $ev['nama_lengkap'];
                        ?>
                        <div class="feed-item <?= $cls ?>">
                            <div class="feed-thumb"><?= $ico ?></div>
                            <div class="feed-info">
                                <div class="feed-title"><?= htmlspecialchars($ev['judul']) ?></div>
                                <div class="feed-eo"><?= htmlspecialchars($eo_label) ?></div>
                                <div class="feed-meta">
                                    <span class="badge <?= $bdg ?>"><?= $ev['kategori'] ?></span>
                                    <span class="feed-time"><?= relative_time($ev['created_at']) ?></span>
                                </div>
                            </div>
                            <a href="<?= BASEURL ?>/app/views/admin/validasi.php?tab=Pending" class="feed-review">
                                Tinjau <i class='bx bx-right-arrow-alt'></i>
                            </a>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="empty-state">
                        <i class='bx bx-check-circle'></i>
                        <p>Tidak ada event dalam antrian validasi</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="card">
            <div class="card-head">
                <h3>
                    <i class='bx bx-bar-chart-alt-2' style="color:var(--primary);vertical-align:middle;margin-right:6px;font-size:20px;"></i>
                    Platform Pulse
                </h3>
            </div>

            <div class="pulse-list">
                <?php if (!empty($pulse_data)): ?>
                    <?php foreach ($pulse_data as $p): ?>
                        <?php $pct = $pulse_max > 0 ? round(($p['total'] / $pulse_max) * 100) : 0; ?>
                        <div class="pulse-row">
                            <div class="pulse-header">
                                <span><?= htmlspecialchars($p['kategori']) ?></span>
                                <span><?= $p['total'] ?> event</span>
                            </div>
                            <div class="pulse-track">
                                <div class="pulse-fill" style="width:<?= $pct ?>%"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty-state">
                        <i class='bx bx-bar-chart'></i>
                        <p>Belum ada data event</p>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($q_reg && $q_reg->num_rows > 0): ?>
                <div style="border-top:1px solid var(--line); padding:16px 24px 20px;">
                    <p style="font-size:12px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.08em;margin-bottom:12px;">
                        <i class='bx bx-user-plus' style="vertical-align:middle;margin-right:4px;"></i>
                        Pendaftaran Terbaru
                    </p>
                    <div style="display:flex;flex-direction:column;gap:10px;">
                        <?php while ($r = $q_reg->fetch_assoc()): ?>
                            <div style="display:flex;gap:10px;align-items:flex-start;">
                                <div style="width:32px;height:32px;border-radius:8px;background:linear-gradient(135deg,#1CABE2,#0071BC);display:flex;align-items:center;justify-content:center;color:white;font-size:13px;font-weight:700;flex-shrink:0;">
                                    <?= strtoupper(substr($r['nama_lengkap'], 0, 1)) ?>
                                </div>
                                <div style="min-width:0;">
                                    <div style="font-size:13px;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                        <?= htmlspecialchars($r['nama_lengkap']) ?>
                                    </div>
                                    <div style="font-size:11px;color:var(--muted);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                        <?= htmlspecialchars($r['judul']) ?>
                                    </div>
                                    <div style="font-size:10px;color:var(--primary);margin-top:2px;">
                                        <?= relative_time($r['tanggal_daftar']) ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </div>

</main>

</body>
</html>
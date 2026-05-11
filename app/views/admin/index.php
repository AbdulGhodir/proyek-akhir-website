<?php
require_once '../../config/config.php';
require_once '../../../koneksi/koneksi.php';
session_start();


$q_users = $conn->query("SELECT COUNT(*) AS total FROM users WHERE role = 'User'");
$total_users = $q_users ? $q_users->fetch_assoc()['total'] : 0;

$q_new = $conn->query("SELECT COUNT(*) AS total FROM users WHERE role = 'User' AND created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)");
$new_users = ($q_new && $q_new->num_rows) ? $q_new->fetch_assoc()['total'] : 0;

$q_eo = $conn->query("SELECT COUNT(*) AS total FROM users WHERE role = 'EO'");
$total_eo = $q_eo ? $q_eo->fetch_assoc()['total'] : 0;

$q_pend = $conn->query("SELECT COUNT(*) AS total FROM event WHERE status_publikasi = 'pending'");
$total_pending = $q_pend ? $q_pend->fetch_assoc()['total'] : 0;

$q_feed = $conn->query("
    SELECT e.id_event, e.judul, e.kategori, e.created_at, e.cover_image,
           u.nama_lengkap, u.nama_organisasi
    FROM event e
    JOIN users u ON e.id_user = u.id
    WHERE e.status_publikasi = 'pending'
    ORDER BY e.created_at DESC
    LIMIT 5
");

$q_pulse = $conn->query("SELECT kategori, COUNT(*) AS total FROM event GROUP BY kategori ORDER BY total DESC");
$pulse_data = [];
$pulse_max = 1;
if ($q_pulse) {
    while ($row = $q_pulse->fetch_assoc()) {
        $pulse_data[] = $row;
        if ($row['total'] > $pulse_max)
            $pulse_max = $row['total'];
    }
}

function relative_time($dt)
{
    $diff = time() - strtotime($dt);
    if ($diff < 60)
        return 'Baru saja';
    if ($diff < 3600)
        return floor($diff / 60) . ' menit lalu';
    if ($diff < 86400)
        return floor($diff / 3600) . ' jam lalu';
    return floor($diff / 86400) . ' hari lalu';
}

$cat_color = ['Seminar' => 'cat-seminar', 'Webinar' => 'cat-webinar', 'Volunteer' => 'cat-volunteer', 'Konser' => 'cat-konser'];
$cat_badge = ['Seminar' => 'blue', 'Webinar' => 'yellow', 'Volunteer' => 'green', 'Konser' => 'purple'];
$cat_emoji = ['Seminar' => '🎓', 'Webinar' => '💻', 'Volunteer' => '🤝', 'Konser' => '🎵'];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin | Eventify</title>
    <meta name="description" content="Command center admin Eventify – pantau pengguna, EO, dan event pending.">
    <link rel="stylesheet" href="<?= BASEURL ?>/assets/css/admin/admin-style.css">
</head>

<body>

    <?php include 'sidebar.php'; ?>

    <main class="main">

        <div class="page-header">
            <h1>Dashboard</h1>
            <p>Selamat datang kembali, <?= htmlspecialchars($_SESSION['nama_lengkap'] ?? 'Admin') ?> 👋</p>
        </div>

        <div class="hero-banner">
            <div class="hero-label">
                <span class="live-dot <?= $total_pending > 0 ? 'yellow' : 'green' ?>"></span>
                ADMINISTRATOR
                <?= $total_pending > 0 ? '— ' . $total_pending . ' Event Menunggu' : '— Semua Bersih' ?>
            </div>
            <h2>Command Center Eventify</h2>
            <p>Pantau aktivitas platform, kelola pengguna & EO, serta validasi event secara real-time.</p>
        </div>

        <div class="stat-grid">
            <div class="stat-card">
                <div class="stat-icon teal"><i class='bx bxs-user'></i></div>
                <div>
                    <div class="stat-val"><?= $total_users ?></div>
                    <div class="stat-label">Total Pengguna</div>
                    <div class="stat-ctx">+<?= $new_users ?> minggu ini</div>
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

        <div class="dash-grid">

            <div class="card">
                <div class="card-head">
                    <h3>⏳ Antrian Validasi Terbaru</h3>
                    <a href="<?= BASEURL ?>/app/views/admin/validasi.php">Lihat semua →</a>
                </div>
                <div class="feed-list">
                    <?php if ($q_feed && $q_feed->num_rows > 0): ?>
                        <?php while ($ev = $q_feed->fetch_assoc()): ?>
                            <?php
                            $cls = $cat_color[$ev['kategori']] ?? '';
                            $bdg = $cat_badge[$ev['kategori']] ?? 'blue';
                            $ico = $cat_emoji[$ev['kategori']] ?? '📅';
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
                                <a href="<?= BASEURL ?>/app/views/admin/validasi.php" class="feed-review">
                                    Tinjau <i class='bx bx-right-arrow-alt'></i>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="empty-state">
                            <i class='bx bx-check-circle'></i>
                            <p>Tidak ada event dalam antrian</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card">
                <div class="card-head">
                    <h3>📊 Platform Pulse</h3>
                </div>
                <div class="pulse-list">
                    <?php if (!empty($pulse_data)): ?>
                        <?php foreach ($pulse_data as $p): ?>
                            <?php $pct = round(($p['total'] / $pulse_max) * 100); ?>
                            <div class="pulse-row">
                                <div class="pulse-header">
                                    <span><?= $p['kategori'] ?></span>
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
            </div>

        </div>

    </main>
</body>

</html>
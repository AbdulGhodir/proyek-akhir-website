<?php
    /** @var int $total_users */
    /** @var int $total_eo */
    /** @var int $total_pending */
    /** @var int $total_pub */
    /** @var int $total_tol */
    /** @var object $q_feed */
    /** @var object $q_reg */
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
                <a href="<?= BASEURL ?>/app/controllers/admin/validasi.php">Lihat semua →</a>
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
                            <a href="<?= BASEURL ?>/app/controllers/admin/validasi.php?tab=Pending" class="feed-review">
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
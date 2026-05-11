<?php

$badge_count = 0;
if (isset($conn)) {
    $r = $conn->query("SELECT COUNT(*) AS total FROM event WHERE status_publikasi = 'pending'");
    if ($r)
        $badge_count = $r->fetch_assoc()['total'];
}

$admin_nama = $_SESSION['nama_lengkap'] ?? 'Admin';
$admin_email = $_SESSION['email'] ?? 'admin@eventify.id';
$admin_init = strtoupper(substr($admin_nama, 0, 1));


$current = basename($_SERVER['PHP_SELF']);
?>

<div class="sidebar">

    <div class="sidebar-brand">
        <img src="https://user10230.na.imgto.link/public/20260503/cuplikan-layar-2026-05-03-215226.avif"
            alt="Eventify Logo">
        <span>Eventify</span>
    </div>

    <p class="sidebar-label">Menu Utama</p>

    <nav class="sidebar-nav">
        <a href="<?= BASEURL ?>/app/views/admin/index.php"
            class="nav-item <?= $current === 'index.php' ? 'active' : '' ?>">
            <i class='bx bxs-dashboard'></i>
            Dashboard
        </a>

        <a href="<?= BASEURL ?>/app/views/admin/manajemen-pengguna.php"
            class="nav-item <?= $current === 'manajemen-pengguna.php' ? 'active' : '' ?>">
            <i class='bx bxs-group'></i>
            Manajemen Pengguna
        </a>

        <a href="<?= BASEURL ?>/app/views/admin/validasi.php"
            class="nav-item <?= $current === 'validasi.php' ? 'active' : '' ?>">
            <i class='bx bxs-check-shield'></i>
            Validasi Event
            <?php if ($badge_count > 0): ?>
                <span class="nav-badge"><?= $badge_count ?></span>
            <?php endif; ?>
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="admin-pill">ADMIN</div>
        <div class="admin-card">
            <div class="admin-avatar"><?= $admin_init ?></div>
            <div class="admin-info">
                <h4><?= htmlspecialchars($admin_nama) ?></h4>
                <p><?= htmlspecialchars($admin_email) ?></p>
            </div>
        </div>
        <a href="<?= BASEURL ?>/app/controllers/auth/logout.php" class="logout-btn">
            <i class='bx bx-log-out'></i>
            Keluar
        </a>
    </div>
</div>
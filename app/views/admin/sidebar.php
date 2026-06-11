<?php


$admin_nama = $_SESSION['nama_lengkap'] ?? 'Admin';
$admin_init = strtoupper(substr($admin_nama, 0, 2));


$admin_email = 'admin@eventify.id';
if (isset($conn) && isset($_SESSION['id'])) {
    $re = $conn->query("SELECT email FROM users WHERE id = " . (int)$_SESSION['id']);
    if ($re && $re->num_rows > 0) {
        $admin_email = $re->fetch_assoc()['email'];
    }
}


$sidebar_pending = 0;
if (isset($conn)) {
    $rp = $conn->query("SELECT COUNT(*) AS t FROM event WHERE status_publikasi = 'Pending'");
    if ($rp) $sidebar_pending = (int)$rp->fetch_assoc()['t'];
}

$current = basename($_SERVER['PHP_SELF']);
?>

<div class="mobile-topbar" id="mobileTopbar">
    <a href="<?= BASEURL ?>/app/views/admin/dashboard.php" class="topbar-brand">
        <img src="<?= BASEURL ?>/assets/images/logo.png" alt="Eventify">
        Eventify
    </a>
    <button class="hamburger-btn" id="hamburgerBtn" onclick="toggleSidebar()" aria-label="Buka Menu">
        <i class='bx bx-menu' id="hamburgerIcon"></i>
    </button>
</div>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>


<div class="sidebar" id="adminSidebar">

    <div class="sidebar-brand">
        <?php include '../components/logo.php'; ?>
    </div>

    <p class="sidebar-label">Menu Utama</p>

    <nav class="sidebar-nav">
        <a href="<?= BASEURL ?>/app/views/admin/dashboard.php"
            class="nav-item <?= $current === 'dashboard.php' ? 'active' : '' ?>">
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
            <i class='bx bx-check-shield'></i>
            Validasi Event
            <?php if ($sidebar_pending > 0): ?>
                <span class="nav-badge"><?= $sidebar_pending ?></span>
            <?php endif; ?>
        </a>

        <a href="<?= BASEURL ?>/app/views/admin/kelola-kategori.php"
            class="nav-item <?= $current === 'kelola-kategori.php' ? 'active' : '' ?>">
            <i class='bx bx-category'></i>
            Kelola Kategori
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="admin-pill">ADMINISTRATOR</div>
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

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const icon    = document.getElementById('hamburgerIcon');

        const isOpen = sidebar.classList.contains('mobile-open');

        if (isOpen) {
            closeSidebar();
        } else {
            sidebar.classList.add('mobile-open');
            overlay.classList.add('open');
            document.body.style.overflow = 'hidden';
            icon.className = 'bx bx-x';
        }
    }

    function closeSidebar() {
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const icon    = document.getElementById('hamburgerIcon');

        sidebar.classList.remove('mobile-open');
        overlay.classList.remove('open');
        document.body.style.overflow = '';
        icon.className = 'bx bx-menu';
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeSidebar();
    });

    document.querySelectorAll('.admin-page .nav-item').forEach(function(link) {
        link.addEventListener('click', function() {
            if (window.innerWidth <= 1100) closeSidebar();
        });
    });
</script>
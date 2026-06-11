<header class="eo-mobile-header">
    <div class="logo">
        <?php include '../../views/components/logo.php'; ?>
    </div>
    <button id="btn-hamburger" class="hamburger-menu">
        <i data-lucide="menu" style="width: 2rem; height: 2rem;"></i>
    </button>
</header>

<nav class="eo-navbar">
    <div class="top-navbar">
        <div class="logo">
            <?php include '../../views/components/logo.php'; ?>
        </div>
        
        <div class="menu">
            <div class="menu-utama">
                <span>Menu Utama</span>
                <a href="<?= BASEURL; ?>/app/controllers/eo/dashboard.php" class="menu-item <?php echo ($halamanAktif == 'dashboard') ? 'active' : ''; ?>">
                    <i class="icon-menu" data-lucide="layout-dashboard"></i>
                    Dasboard
                </a>

                <a href="<?= BASEURL; ?>/app/controllers/eo/event.php" class="menu-item <?php echo ($halamanAktif == 'event') ? 'active' : ''; ?>">
                    <i class="icon-menu" data-lucide="calendar-plus"></i>
                    Manajemen Event
                </a>
            </div>
            
            <div class="menu-pendaftar">
                <span>Pendaftaran & Pembayaran</span>
                <a href="<?= BASEURL; ?>/app/controllers/eo/verifikasi.php" class="menu-item <?php echo ($halamanAktif == 'verifikasi') ? 'active' : '' ?>">
                    <i class="icon-menu" data-lucide="badge-check"></i>
                    Verifikasi Pendaftar
                </a>
            </div>
        </div>
    </div>

    <div class="bottom-navbar">
        <div class="akun">
            <span class="profile-akun">A</span>
            <div class="info-akun">
                <span class="nama"><?= $_SESSION['nama_lengkap']; ?></span>
                <span class="email"><?= $_SESSION['nama_organisasi']; ?></span>
            </div>
        </div>

        <div class="logout">
            <a href="<?= BASEURL; ?>/app/controllers/auth/logout.php">
                <i data-lucide="log-out" style="width: 1rem; height: 1rem;"></i>
                <span class="teks">Keluar</span>
            </a>
        </div>
    </div>
</nav>

<script>window.BASEURL = "<?= BASEURL; ?>";</script>
<script src="<?= BASEURL; ?>/assets/js/session_timer.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const btnHamburger = document.getElementById('btn-hamburger');
        const eoNavbar = document.querySelector('.eo-navbar');
        if (btnHamburger && eoNavbar) {
            btnHamburger.addEventListener('click', () => {
                eoNavbar.classList.toggle('active');
            });
        }
    });
</script>
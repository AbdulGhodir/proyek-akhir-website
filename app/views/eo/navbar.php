<nav>
    <div class="top-navbar">
        <div class="logo">
            <img src="<?= BASEURL; ?>/assets/images/logo.png" alt="" style="width: 1.5rem; height: 1.5rem; object-fit: cover;">
            <span>Eventify</span>
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
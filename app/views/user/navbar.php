<?php
require_once __DIR__ . '/../../models/PendaftaranModel.php';

$notifNavbar = [];

if (isset($conn) && isset($_SESSION['id'])) {
    $notifNavbar = getNotifikasiUser($conn, (int)$_SESSION['id'], 3);
}

$jumlahNotif = count($notifNavbar);
?>

<nav class="navbar">
  <div class="container nav-wrap">
    
  <?php include '../../views/components/logo.php'; ?>

    <div class="search-box">
      <i class='bx bx-search'></i>
      <input type="text" id="searchInput" onkeyup="searchEvent()" placeholder="Cari seminar, webinar, volunteer...">
    </div>

    <div class="nav-right">

      <div class="notification-wrapper">
        <button class="icon-btn bell-btn" onclick="toggleNotif(event)">
          <i class='bx bx-bell'></i>
            <?php if ($jumlahNotif > 0): ?>
              <span class="notif-badge"><?= $jumlahNotif; ?></span>
            <?php endif; ?>
        </button>

        <div class="notif-dropdown" id="notifDropdown">
          <div class="notif-header">
            <h4>Notifikasi</h4>
            <a href="#" onclick="tandaiSemuaDibaca(event)">Tandai dibaca</a>
          </div>
          
          <div class="notif-body">
            
            <?php if (empty($notifNavbar)): ?>
              <div class="notif-item">
                <div class="notif-icon">
                  <i class='bx bx-bell'></i>
                </div>
                <div class="notif-text">
                  <p>Belum ada notifikasi baru.</p>
                  <span>Eventify</span>
                </div>
              </div>
              <?php else: ?>

                <?php foreach ($notifNavbar as $notif): ?>
                  <?php
                    $status = $notif['status_pendaftaran'];
                    if ($status == 'diterima') {
                        $icon = "bxs-check-circle";
                        $warna = "#10B981";
                        $pesan = "Hore! Pendaftaran <b>" . $notif['judul'] . "</b> telah <b>Diterima</b>. Cek tiketmu sekarang!";
                        $link = BASEURL . "/app/controllers/user/tiket-detail.php?id=" . $notif['id_pendaftaran'];
                    } elseif ($status == 'ditolak') {
                        $icon = "bxs-x-circle";
                        $warna = "#EF4444";
                        $pesan = "Mohon maaf, pendaftaran <b>" . $notif['judul'] . "</b> telah <b>Ditolak</b>.";
                        $link = BASEURL . "/app/controllers/user/riwayat-pendaftaran.php";
                    } else {
                        $icon = "bxs-time-five";
                        $warna = "#F59E0B";
                        $pesan = "Pendaftaran <b>" . $notif['judul'] . "</b> sedang <b>Menunggu Verifikasi</b> panitia.";
                        $link = BASEURL . "/app/controllers/user/riwayat-pendaftaran.php";
                    }
                  ?>

                  <a href="<?= $link; ?>" class="notif-item unread">
                    <div class="notif-icon">
                      <i class='bx <?= $icon; ?>' style="color: <?= $warna; ?>;"></i>
                    </div>
                    <div class="notif-text">
                      <p><?= $pesan; ?></p>
                      <span><?= formatWaktuRelatif($notif['tanggal_daftar']); ?></span>
                    </div>
                  </a>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>
          
          <div class="notif-footer">
              <a href="<?= BASEURL; ?>/app/controllers/user/notifikasi.php">Lihat Semua Notifikasi</a>
          </div>
        </div>
      </div>

      <div class="profile">
        
      <div class="avatar">
        <span><?= strtoupper(substr($_SESSION['nama_lengkap'], 0, 1)); ?></span>
      </div>
      
      <div class="profile-info">
        <h4><?= $_SESSION['nama_lengkap']; ?></h4>
        <p><?= $_SESSION['role']; ?></p>
      </div>

        <i class='bx bx-chevron-down'></i>

        <div class="profile-menu">
          <a href="<?= BASEURL; ?>/app/controllers/user/profile.php">
            <i class='bx bx-user'></i>
            <span>Profil Saya</span>
          </a>

          <a href="<?= BASEURL; ?>/app/controllers/user/riwayat-pendaftaran.php">
            <i class='bx bx-receipt'></i>
            <span>Riwayat Pendaftaran</span>
          </a>

          <a href="<?= BASEURL; ?>/app/controllers/auth/logout.php">
            <i class='bx bx-log-out'></i>
            <span>Logout</span>
          </a>
        </div>

      </div>

    </div>

  </div>
</nav>

<script>window.BASEURL = "<?= BASEURL; ?>";</script>
<script src="<?= BASEURL; ?>/assets/js/session_timer.js"></script>

<script>
  function toggleNotif(event) {
      event.stopPropagation(); 
      document.getElementById('notifDropdown').classList.toggle('show');
  }

  document.addEventListener('DOMContentLoaded', function() {
      if (sessionStorage.getItem('notif_dibaca') === 'true') {
          eksekusiVisualDibaca();
      }
  });

  function tandaiSemuaDibaca(event) {
      event.preventDefault(); 

      sessionStorage.setItem('notif_dibaca', 'true');

      eksekusiVisualDibaca();
  }

  function eksekusiVisualDibaca() {
      const badge = document.querySelector('.notif-badge');
      if (badge) {
          badge.style.display = 'none';
      }

      const unreadItems = document.querySelectorAll('.notif-item.unread');
      unreadItems.forEach(item => {
          item.classList.remove('unread');
          
          const dot = item.querySelector('.notif-dot');
          if (dot) {
              dot.style.display = 'none';
          }
      });
  }

  window.addEventListener('click', function(e) {
      const dropdown = document.getElementById('notifDropdown');
      const btn = document.querySelector('.bell-btn');
      
      if (dropdown && dropdown.classList.contains('show')) {
          if (!dropdown.contains(e.target) && !btn.contains(e.target)) {
              dropdown.classList.remove('show');
          }
      }
  });
</script>
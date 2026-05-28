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
          <span class="notif-badge">3</span>
        </button>

        <div class="notif-dropdown" id="notifDropdown">
          <div class="notif-header">
            <h4>Notifikasi</h4>
            <a href="#">Tandai dibaca</a>
          </div>
          
          <div class="notif-body">
            
            <a href="<?= BASEURL; ?>/app/controllers/user/riwayat-pendaftaran.php" class="notif-item unread">
              <div class="notif-icon"><i class='bx bxs-check-circle' style="color: #10B981;"></i></div>
              <div class="notif-text">
                <p>Hore! Pendaftaran <b>Tech Future Summit 2026</b> telah <b>Diterima</b>. Cek tiketmu sekarang!</p>
                <span>10 menit yang lalu</span>
              </div>
            </a>

            <a href="<?= BASEURL; ?>/app/controllers/user/riwayat-pendaftaran.php" class="notif-item unread">
              <div class="notif-icon"><i class='bx bxs-time-five' style="color: #F59E0B;"></i></div>
              <div class="notif-text">
                <p>Pendaftaran <b>Digital Marketing for Beginner</b> sedang <b>Menunggu Verifikasi</b> panitia.</p>
                <span>1 jam yang lalu</span>
              </div>
            </a>

            <a href="<?= BASEURL; ?>/app/views/user/profile.php" class="notif-item">
              <div class="notif-icon"><i class='bx bxs-user-check'></i></div>
              <div class="notif-text">
                <p>Perubahan <b>Profil Saya</b> berhasil disimpan.</p>
                <span>Kemarin</span>
              </div>
            </a>

          </div>
          
          <a href="#" class="notif-footer">Lihat Semua Notifikasi</a>
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
          <a href="<?= BASEURL; ?>/app/views/user/profile.php">
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

<script>
  function toggleNotif(event) {
      event.stopPropagation(); 
      document.getElementById('notifDropdown').classList.toggle('show');
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
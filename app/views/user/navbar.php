<nav class="navbar">
  <div class="container nav-wrap">

    <a href="<?= BASEURL; ?>/app/views/user/dashboard.php" class="brand">
      <img src="<?= BASEURL; ?>/assets/images/logo-eventify.png" alt="Eventify Logo">
      <span>Eventify</span>
    </a>

    <div class="search-box">
      <i class='bx bx-search'></i>
      <input type="text" placeholder="Cari seminar, webinar, volunteer...">
    </div>

    <div class="nav-right">

      <button class="icon-btn">
        <i class='bx bx-bell'></i>
      </button>

      <div class="profile">

        <div class="avatar">
          <span>I</span>
        </div>

        <div class="profile-info">
          <h4>Indri</h4>
          <p>Pengguna</p>
        </div>

        <i class='bx bx-chevron-down'></i>

        <div class="profile-menu">
          <a href="#">
            <i class='bx bx-user'></i>
            <span>Profil Saya</span>
          </a>

          <a href="<?= BASEURL; ?>/app/views/user/riwayat-pendaftaran.php">
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
<?php
/** @var string $pageTitle */
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $pageTitle; ?></title>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/user-style/user-style.css">
</head>
<body>
  <?php include 'navbar.php'; ?>

  <section class="hero">
    <div class="container">
      <div class="hero-card">
        <div class="hero-content">
          <div class="hero-badge">
            <i class='bx bxs-badge-check'></i>
            Platform Event Terpusat Bandar Lampung
          </div>
          <h1>Temukan Event Terbaik Untuk Upgrade Dirimu!</h1>
          <p>Ikuti seminar, webinar, dan volunteer yang sudah tervalidasi dan terpercaya hanya di Eventify!</p>
          <div class="hero-chips">
            <button onclick="filterEvent('seminar')">Seminar</button>
            <button onclick="filterEvent('webinar')">Webinar</button>
            <button onclick="filterEvent('volunteer')">Volunteer</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="filters">
    <div class="container">
      <div class="filter-wrap">
        <button class="filter-pill active" onclick="filterEvent('semua')">Semua</button>
        <button class="filter-pill" onclick="filterEvent('seminar')">Seminar</button>
        <button class="filter-pill" onclick="filterEvent('webinar')">Webinar</button>
        <button class="filter-pill" onclick="filterEvent('volunteer')">Volunteer</button>
        <button class="filter-pill" onclick="filterEvent('gratis')">Gratis</button>
        <button class="filter-pill" onclick="filterEvent('berbayar')">Berbayar</button>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="section-head">
        <div>
          <h2>Featured Event</h2>
          <p>Event pilihan minggu ini!</p>
        </div>
      </div>
      
      <div class="featured">
        <div class="feature-card">
          <div class="feature-badge">Featured Event</div>
          <h3 class="feature-title">Tech Future Summit 2026</h3>
          <p class="feature-desc">Seminar teknologi terbesar di Bandar Lampung yang membahas Artificial Intelligence, Cyber Security, dan Future Digital Industry.</p>
          <div class="feature-meta">
            <span><i class='bx bx-calendar'></i> 18 Mei 2026</span>
            <span><i class='bx bx-map'></i> Swiss-Belhotel Lampung</span>
          </div>
          <a href="<?= BASEURL; ?>/app/controllers/user/detail-event.php?id=1" class="feature-btn">Lihat Detail Event</a>
        </div>

        <div class="feature-mini">
          <h3>Event Highlights</h3>
          <div class="highlight-list">
            <div class="highlight-item">
              <h4>Sertifikat Resmi</h4>
              <p>Dapatkan e-certificate resmi.</p>
            </div>
            <div class="highlight-item">
              <h4>Networking</h4>
              <p>Bangun relasi profesional.</p>
            </div>
            <div class="highlight-item">
              <h4>Expert Speaker</h4>
              <p>Materi langsung dari ahlinya.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="section-head">
        <div>
          <h2>Jelajahi Event</h2>
          <p>Pilih event sesuai minatmu</p>
        </div>
      </div>

      <div class="event-grid">
      <?php foreach ($events as $event) : 
          $label_harga = ($event['biaya'] == 0 || strtolower($event['biaya']) == 'gratis') ? 'gratis' : 'berbayar';
          $kategori_filter = strtolower($event['kategori']) . " " . $label_harga;
      ?>
        <div class="event-card" data-kategori="<?= $kategori_filter; ?>">
          <div class="event-thumb" style="background-image: url('<?= BASEURL; ?>/assets/images/uploads/<?= $event['cover_image']; ?>');"></div>
          <div class="event-body">
            <div class="badges">
              <span class="badge blue"><?= $event['kategori']; ?></span>
              <span class="badge yellow"><?= formatRupiah($event['biaya']); ?></span>
            </div>
            <h3 class="event-title"><?= $event['judul']; ?></h3>
            <div class="meta">
              <span><i class='bx bx-calendar'></i> <?= formatTanggalIndo($event['waktu_pelaksanaan']); ?></span>
              <span><i class='bx bx-map'></i> <?= $event['lokasi']; ?></span>
              <span><i class='bx bx-buildings'></i> <?= $event['nama_lengkap']; ?></span>
            </div>
            <a href="<?= BASEURL; ?>/app/controllers/user/detail-event.php?id=<?= $event['id_event']; ?>" class="btn-primary">Lihat Detail</a>
          </div>
        </div>
      <?php endforeach; ?>
      </div>

    </div>
  </section>

  <script>
    function filterEvent(kategori) {
        const cards = document.querySelectorAll('.event-card');
        const pills = document.querySelectorAll('.filter-pill');

        pills.forEach(btn => {
            btn.classList.remove('active');
            if (btn.innerText.toLowerCase() === kategori || (kategori === 'semua' && btn.innerText === 'Semua')) {
                btn.classList.add('active');
            }
        });

        cards.forEach(card => {
            const kategoriCard = card.getAttribute('data-kategori').toLowerCase();

            if (kategori === 'semua') {
                card.style.display = 'block'; 
            } else {
                if (kategoriCard.includes(kategori)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            }
        });
    }
  </script>
</body>
</html>
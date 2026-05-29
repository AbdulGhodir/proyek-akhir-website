<?php
/** @var string $pageTitle */
/** @var array $events */
/** @var array|null $featuredEvent */
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
          <h1>Temukan Event Terbaik Untuk Upgrade Dirimu!</h1>
          <p>Ikuti seminar, webinar, volunteer, maupun konser yang sudah tervalidasi dan terpercaya hanya di Eventify!</p>

          <div class="hero-chips">
            <button onclick="filterEvent('seminar')">Seminar</button>
            <button onclick="filterEvent('webinar')">Webinar</button>
            <button onclick="filterEvent('volunteer')">Volunteer</button>
            <button onclick="filterEvent('konser')">Konser</button>
          </div>
        </div>

        <div class="hero-logo-box">
          <img src="<?= BASEURL; ?>/assets/images/logo.png" alt="Eventify Logo">
        </div>

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
        <?php if ($featuredEvent) : ?>
          <div 
            class="feature-card"
            style="
              background:
                linear-gradient(135deg, rgba(6, 42, 69, 0.92), rgba(11, 116, 185, 0.88)),
                url('<?= BASEURL; ?>/assets/images/uploads/<?= $featuredEvent['cover_image']; ?>');
              background-size: cover;
              background-position: center;
            "
          >

            <div class="feature-badge">Featured Event</div>

            <h3 class="feature-title"><?= $featuredEvent['judul']; ?></h3>

            <p class="feature-desc">
              <?= $featuredEvent['deskripsi']; ?>
            </p>

            <div class="feature-meta">
              <span>
                <i class='bx bx-calendar'></i>
                <?= formatTanggalIndo($featuredEvent['waktu_pelaksanaan']); ?>
              </span>

              <span>
                <i class='bx bx-map'></i>
                <?= $featuredEvent['lokasi']; ?>
              </span>

              <span>
                <i class='bx bx-buildings'></i>
                <?= $featuredEvent['nama_lengkap']; ?>
              </span>
            </div>

            <a 
              href="<?= BASEURL; ?>/app/controllers/user/detail-event.php?id=<?= $featuredEvent['id_event']; ?>" 
              class="feature-btn"
            >
              Lihat Detail Event
            </a>
          </div>
        <?php else : ?>
          <div class="feature-card">
            <div class="feature-badge">Featured Event</div>
            <h3 class="feature-title">Belum Ada Event Terdekat</h3>
            <p class="feature-desc">
              Saat ini belum ada event yang akan datang. Silakan cek kembali nanti.
            </p>
          </div>
        <?php endif; ?>

        <div class="feature-mini">
          <h3>Event Highlights</h3>
          <div class="highlight-list">
            <div class="highlight-item">
              <h4>UI/UX Basics</h4>
              <p>Pahami dasar desain yang nyaman digunakan.</p>
            </div>
            <div class="highlight-item">
              <h4>Beginner Friendly</h4>
              <p>Cocok untuk kamu yang baru mulai belajar UI/UX.</p>
            </div>
            <div class="highlight-item">
              <h4>Practical Insight</h4>
              <p>Dapatkan insight desain yang relevan dan mudah diterapkan.</p>
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

      <div class="filter-wrap-dashboard">
        <button class="filter-pill active" onclick="filterEvent('semua')">Semua</button>
        <button class="filter-pill" onclick="filterEvent('seminar')">Seminar</button>
        <button class="filter-pill" onclick="filterEvent('webinar')">Webinar</button>
        <button class="filter-pill" onclick="filterEvent('volunteer')">Volunteer</button>
        <button class="filter-pill" onclick="filterEvent('konser')">Konser</button>
        <button class="filter-pill" onclick="filterEvent('gratis')">Gratis</button>
        <button class="filter-pill" onclick="filterEvent('berbayar')">Berbayar</button>
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

    function searchEvent() {
        let input = document.getElementById('searchInput');
        let filter = input.value.toLowerCase();
        let cards = document.querySelectorAll('.event-card');

        cards.forEach(card => {
            let cardText = card.innerText.toLowerCase();

            if (cardText.includes(filter)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });

        if (filter.length > 0) {
            document.querySelector('.event-grid').scrollIntoView({ 
                behavior: 'smooth', 
                block: 'center' 
            });
        }
    }
  </script>
</body>
</html>
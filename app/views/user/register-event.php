<?php
/** @var string $pageTitle */
/** @var array $event */
/** @var bool $isPaid */

$isSuccess = (isset($_GET['status']) && $_GET['status'] == 'sukses');
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

<section class="register-event-page">
  <div class="container">

    <?php if($isSuccess): ?>
      <div class="success-page" style="min-height: 60vh; display: flex; align-items: center; justify-content: center; text-align: center; padding: 40px 20px;">
        <div class="success-card card-white" style="padding: 60px 40px; max-width: 500px; width: 100%; margin: 0 auto; border-radius: 28px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
          <i class='bx bxs-check-circle' style="font-size: 100px; color: #10B981; margin-bottom: 24px;"></i>
          <h2 style="font-size: 28px; margin-bottom: 12px; color: #333;">Pendaftaran Berhasil!</h2>
          <p style="color: #64748B; line-height: 1.6; margin-bottom: 32px;">Terima kasih! Data pendaftaranmu sedang kami proses. Silakan tunggu verifikasi dari panitia event maksimal 2x24 jam.</p>
          
          <div style="display: flex; flex-direction: column; gap: 12px;">
            <a href="<?= BASEURL; ?>/app/controllers/user/riwayat-pendaftaran.php" class="btn-primary full-btn" style="text-decoration: none; display: flex; align-items: center; justify-content: center;">Lihat Riwayat Pendaftaran</a>
            <a href="<?= BASEURL; ?>/app/controllers/user/dashboard.php" class="btn-outline" style="display: flex; align-items: center; justify-content: center; height: 52px; border-radius: 16px; font-weight: 600; text-decoration: none; color: var(--primary, #0071BC); border: 2px solid var(--primary, #0071BC);">Kembali ke Beranda</a>
          </div>
        </div>
      </div>

    <?php else: ?>
      <div class="section-head">
        <h2>Pendaftaran Event</h2>
        <p>Lengkapi data diri untuk mengikuti event pilihanmu.</p>
      </div>

      <form action="" method="POST" enctype="multipart/form-data" class="register-event-layout">

        <div class="register-event-form card-white">

          <div class="form-row">
            <div class="form-group">
              <label>Nama Lengkap</label>
              <input type="text" name="nama_lengkap" placeholder="Masukkan nama lengkap" value="<?= isset($_SESSION['nama_lengkap']) ? $_SESSION['nama_lengkap'] : ''; ?>" required>
            </div>

            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" placeholder="Masukkan email aktif" value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label>No. HP</label>
              <input type="text" name="no_hp" placeholder="08xxxxxxxxxx" required>
            </div>

            <div class="form-group">
              <label>Instansi / Kampus</label>
              <input type="text" name="instansi" placeholder="Contoh: Universitas Lampung" required>
            </div>
          </div>

          <div class="form-group">
            <label>Motivasi Mengikuti Event</label>
            <textarea name="motivasi" rows="6" placeholder="Tulis alasan kamu mengikuti event ini..." required></textarea>
          </div>

          <?php if($isPaid): ?>
          <div class="payment-box">
            <h3>Pembayaran</h3>

            <div class="payment-info">
              <span>Bank BCA</span>
              <strong>1234567890</strong>
              <small>a.n Eventify Bandar Lampung</small>
            </div>

            <div class="form-group">
              <label>Upload Bukti Transfer</label>
              <input type="file" name="bukti_transfer" accept="image/*" required>
            </div>
          </div>
          <?php endif; ?>

        </div>

         <aside class="register-event-summary card-white">
          <img src="<?= BASEURL; ?>/assets/images/uploads/<?= $event['cover_image']; ?>" alt="<?= $event['judul']; ?>">

          <div class="summary-content">
            <span class="badge blue"><?= $event['kategori']; ?></span>
            <span class="badge yellow"><?= formatRupiah($event['biaya']); ?></span>
            
            <h3><?= $event['judul']; ?></h3>
            
            <div class="summary-meta">
              <p><i class='bx bx-calendar'></i> <?= date('d M Y', strtotime($event['waktu_pelaksanaan'])); ?></p>
              <p><i class='bx bx-map'></i> <?= $event['lokasi']; ?></p>
              <p><i class='bx bx-check-circle'></i> Menunggu Submit</p>
            </div>
            
            <button type="submit" class="btn-primary full-btn">Submit Pendaftaran</button>
          </div>
        </aside>
      </form>
    <?php endif; ?>

  </div>
</section>

</body>
</html>
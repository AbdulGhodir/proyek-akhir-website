<?php
/** @var string $pageTitle */
/** @var array $event */
/** @var array $listPertanyaan */
/** @var array $tipePertanyaan */
/** @var array $opsiDropdown */
/** @var array $wajibDiisi */
/** @var array $idForm */
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $pageTitle; ?></title>

  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/global.css">
</head>
<body class="user-page">

<?php include 'navbar.php'; ?>

<section class="register-event-page">
  <div class="container">

    <a href="<?= BASEURL; ?>/app/controllers/user/dashboard.php" class="btn-back">
        <i class='bx bx-arrow-back'></i> Kembali ke Beranda
    </a>

    <div class="section-head">
      <h2>Pendaftaran Event</h2>
      <p>Lengkapi data diri untuk mengikuti event pilihanmu.</p>
    </div>

    <form class="register-event-layout" method="POST" enctype="multipart/form-data">
      <div class="register-event-form card-white">
        <?php for($i = 0; $i < count($listPertanyaan); $i++): ?>
          <div class="form-group">
            <label class="<?= $wajibDiisi[$i] == true ? 'wajib' : ''; ?>"><?= $listPertanyaan[$i]; ?></label>
            <input type="hidden" value="<?= $idForm[$i]; ?>" name="id_form[<?= $i; ?>]">
            <?php if($tipePertanyaan[$i] == 'teks'): ?>
              <input type="text" name="jawaban[<?= $i; ?>]" id="<?= $listPertanyaan[$i]; ?>" <?= $wajibDiisi[$i] == true ? 'required' : ''; ?> placeholder="Masukkan Jawaban">
            <?php elseif($tipePertanyaan[$i] == 'paragraf'): ?>
              <textarea rows="4" name="jawaban[<?= $i; ?>]" id="<?= $listPertanyaan[$i]; ?>" <?= $wajibDiisi[$i] == true ? 'required' : ''; ?> placeholder="Masukkan Jawaban"></textarea>
            <?php elseif($tipePertanyaan[$i] == 'angka'): ?>
              <input type="number" name="jawaban[<?= $i; ?>]" id="<?= $listPertanyaan[$i]; ?>" <?= $wajibDiisi[$i] == true ? 'required' : ''; ?> placeholder="Masukkan Jawaban">
            <?php elseif($tipePertanyaan[$i] == 'tanggal'): ?>
              <input type="date" name="jawaban[<?= $i; ?>]" id="<?= $listPertanyaan[$i]; ?>" <?= $wajibDiisi[$i] == true ? 'required' : ''; ?> placeholder="Masukkan Jawaban">
            <?php elseif($tipePertanyaan[$i] == 'file'): ?>
              <input type="file" name="jawaban[<?= $i; ?>]" id="<?= $listPertanyaan[$i]; ?>" <?= $wajibDiisi[$i] == true ? 'required' : ''; ?> accept="image/*">
            <?php elseif($tipePertanyaan[$i] == 'dropdown'): ?>
              <select name="jawaban[<?= $i; ?>]" id="<?= $listPertanyaan[$i]; ?>" <?= $wajibDiisi[$i] == true ? 'required' : ''; ?>>
                <?php foreach($opsiDropdown[$i] as $option): ?>
                  <option value="<?= $option; ?>"><?= $option; ?></option>
                <?php endforeach; ?>
              </select>
            <?php endif; ?>
          </div>
        <?php endfor; ?>
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
          <button class="btn-primary full-btn" name="daftar_event"> Submit Pendaftaran </button>
        </div>
      </aside>
  </div>
</section>

</body>
</html>
<?php
    /** @var array $listEvent */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Event</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/global.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/eo/event.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/eo/navbar.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
    <?php
        $halamanAktif = 'event';
        include 'navbar.php';
    ?>

    <section>
        <div class="header">
            <div class="header-title">
                <span>Manajemen Event</span>
                <span>Kelola seluruh event milik anda</span>
            </div>

            <a href="<?= BASEURL; ?>/app/controllers/eo/form_event.php" class="buat-event">
                <i class="icon" data-lucide="plus"></i>
                Buat Event
            </a>
        </div>

        <div class="event">
            <table class="event-list">
                <thead>
                    <tr>
                        <th>Event</th>
                        <th>Waktu</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listEvent as $event) : ?>
                        <tr>
                            <td>
                                <img src="<?= BASEURL; ?>/assets/images/uploads/<?= $event['cover_image'] ?>" alt="">
                                <div class="event-info">
                                    <a><?= $event['judul'] ?></a>
                                    <span><?= $event['kategori'] ?></span>
                                </div>
                            </td>
                            <td><?= formatTanggalIndo($event['waktu_pelaksanaan']) ?></td>
                            <td><?= formatRupiah($event['biaya']) ?></td>
                            <td>
                                <?php if ($event['status_publikasi'] == "Pending") : ?>
                                    <span class="status pending"><?= $event['status_publikasi'] ?></span>
                                <?php elseif ($event['status_publikasi'] == "Dipublikasikan") : ?>
                                    <span class="status published"><?= $event['status_publikasi'] ?></span>
                                <?php elseif ($event['status_publikasi'] == "Ditolak") : ?>
                                    <span class="status rejected"><?= $event['status_publikasi'] ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="tombol-aksi">
                                    <a href="<?= BASEURL; ?>/app/controllers/eo/form_event.php?id_event=<?= $event['id_event'] ?>" class="btn-edit">
                                        <i class="icon" data-lucide="edit"></i>
                                    </a>
                                    
                                    <button class="btn-delete" data-id="<?= $event['id_event'] ?>" data-nama="<?= $event['judul'] ?>">
                                        <i class="icon" data-lucide="trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </section>

    <div class="overlay" id="modal">
        <div class="konfirmasi-hapus">
            <h2>Hapus Event</h2>
            <span>Apakah anda yakin ingin menghapus event <strong id="namaEvent"></strong>?</span>
            <form action="<?= BASEURL; ?>/app/controllers/eo/event.php" method="POST" class="tombol-konfirmasi">
                <input type="hidden" name="id" id="idEvent">

                <button type="button" class="btn-batal" id="btnBatal">Batal</button>
                <button type="submit" class="btn-hapus" name="hapus_event">Hapus</button>
            </form>
        </div>
    </div>

    <script src="<?= BASEURL; ?>/assets /js/global.js"></script>
    <script src="<?= BASEURL; ?>/assets/js/eo/event.js"></script>
</body>
</html>
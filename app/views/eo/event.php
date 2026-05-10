<?php
    require_once '../../config/config.php';
    require_once '../../../koneksi/koneksi.php';

    session_start();
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

            <a href="<?= BASEURL; ?>/app/views/eo/form_event.php" class="buat-event">
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
                    <tr>
                        <td>
                            <img src="<?= BASEURL; ?>/assets/images/image.png" alt="">
                            <div class="event-info">
                                <a>Webinar Vibe Coding</a>
                                <span>Webinar</span>
                            </div>
                        </td>
                        <td>22 Mei 2026 pukul 09.00</td>
                        <td>Rp 750.000</td>
                        <td>
                            <span class="status published">Dipublikasikan</span>
                        </td>
                        <td>
                            <div class="tombol-aksi">
                                <button class="btn-edit">
                                    <i class="icon" data-lucide="edit"></i>
                                </button>
                                
                                <button class="btn-delete">
                                    <i class="icon" data-lucide="trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="<?= BASEURL; ?>/assets/images/image.png" alt="">
                            <div class="event-info">
                                <a>Webinar Vibe Coding</a>
                                <span>Webinar</span>
                            </div>
                        </td>
                        <td>22 Mei 2026 pukul 09.00</td>
                        <td>Rp 750.000</td>
                        <td>
                            <span class="status published">Dipublikasikan</span>
                        </td>
                        <td>
                            <div class="tombol-aksi">
                                <button class="btn-edit">
                                    <i class="icon" data-lucide="edit"></i>
                                </button>
                                
                                <button class="btn-delete">
                                    <i class="icon" data-lucide="trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="<?= BASEURL; ?>/assets/images/image.png" alt="">
                            <div class="event-info">
                                <a>Webinar Vibe Coding</a>
                                <span>Webinar</span>
                            </div>
                        </td>
                        <td>22 Mei 2026 pukul 09.00</td>
                        <td>Rp 750.000</td>
                        <td>
                            <span class="status published">Dipublikasikan</span>
                        </td>
                        <td>
                            <div class="tombol-aksi">
                                <button class="btn-edit">
                                    <i class="icon" data-lucide="edit"></i>
                                </button>
                                
                                <button class="btn-delete">
                                    <i class="icon" data-lucide="trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <script src="<?= BASEURL; ?>/assets /js/global.js"></script>
</body>
</html>
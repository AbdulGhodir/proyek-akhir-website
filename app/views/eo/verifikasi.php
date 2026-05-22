<?php
    /** @var array $listPendaftaran */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Pendaftar</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/global.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/eo/verifikasi.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/eo/navbar.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
    <?php
        $halamanAktif = 'verifikasi';
        include 'navbar.php';
    ?>

    <section>
        <div class="header">
            <div class="header-title">
                <span>Verifikasi Pendaftar</span>
                <span>Verifikasi pendaftaran dan pembayaran</span>
            </div>

            <select class="filter-event" name="filter-event" id="filter-event">
                <option value="">Semua Event</option>
                <option value="">Webinar Vibe Coding</option>
                <option value="">Seminar Hasil</option>
                <option value="">Konser Naruto Shippuden</option>
            </select>
        </div>

        <div class="daftar-pendaftar">
            <table>
                <thead>
                    <tr>
                        <th>Pendaftar</th>
                        <th>Event</th>
                        <th>Tanggal Daftar</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listPendaftaran as $pendaftaran) : ?>
                        <tr>
                            <td>
                                <span><?= $pendaftaran['nama_lengkap']; ?></span>
                                <span><?= $pendaftaran['email']; ?></span>
                            </td>
                            <td><?= $pendaftaran['nama_event']; ?></td>
                            <td><?= formatTanggalIndo($pendaftaran['tanggal_daftar']); ?></td>
                            <td>
                                <?php 
                                    if ($pendaftaran['status_pendaftaran'] == 'menunggu') {
                                        echo '<span class="status pending">Pending</span>';
                                    } elseif ($pendaftaran['status_pendaftaran'] == 'diterima') {
                                        echo '<span class="status confirmed">Terverifikasi</span>';
                                    } elseif ($pendaftaran['status_pendaftaran'] == 'ditolak') {
                                        echo '<span class="status rejected">Ditolak</span>';
                                    }
                                ?>
                            </td>
                            <td><button class="lihat-jawaban" data-id-pendaftaran="<?= $pendaftaran['id_pendaftaran']; ?>" data-status-pendaftaran="<?= $pendaftaran['status_pendaftaran']; ?>">Lihat Jawaban</button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <div class="overlay">
        <div class="jawaban-overlay">
            <div class="content">
                <div class="header">
                    <div class="title">
                        <span>Detail Jawaban Pendaftar</span>
                        <span>Event: Webinar Coding</span>
                    </div>
                    <i data-lucide="x" class="icon"></i>
                </div>
    
                <div class="list-jawaban"></div>
            </div>

            <div class="button">
                <button class="tolak">Tolak</button>
                <button class="terima">Terima</button>
            </div>
        </div>
    </div>
            
    <script src="<?= BASEURL; ?>/assets/js/global.js"></script>
    <script>const BASEURL = "<?= BASEURL; ?>";</script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const overlay = document.querySelector('.overlay');
            const close = document.querySelector('.jawaban-overlay .icon');
            const lihatJawaban = document.querySelectorAll('.lihat-jawaban');
            const listJawaban = document.querySelector('.list-jawaban');
            const buttonKeputusan = document.querySelector('.jawaban-overlay .button');

            lihatJawaban.forEach(button => {
                button.addEventListener('click', () => {
                    const idPendaftaran = button.getAttribute('data-id-pendaftaran');
                    const statusPendaftaran = button.getAttribute('data-status-pendaftaran');

                    if (statusPendaftaran != 'menunggu') {
                        buttonKeputusan.classList.add('hidden');
                    } else {
                        buttonKeputusan.classList.remove('hidden');
                    }

                    listJawaban.innerHTML = '';

                    let formData = new FormData();
                    formData.append('lihat_jawaban', 'true');
                    formData.append('id_pendaftaran', idPendaftaran);

                    fetch(BASEURL + '/app/controllers/eo/verifikasi.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(jawaban => {
                            listJawaban.innerHTML += `
                                <div class="jawaban-item">
                                    <span class="pertanyaan">${jawaban.pertanyaan}</span>
                                    <span class="jawaban">${jawaban.jawaban}</span>
                                </div>
                            `;
                        });

                        overlay.classList.add('active');
                    })
                    .catch(error => console.error('Error:', error));
                });
            });

            close.addEventListener('click', () => {
                overlay.classList.remove('active');
            });
        })
    </script>
</body>
</html>
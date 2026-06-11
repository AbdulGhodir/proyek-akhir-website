<?php
    /** @var array $listPendaftaran */
    /** @var array $listEvent */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Pendaftar</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/global.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="eo-verifikasi-page">
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

            <form method="GET" id="form-filter">
                <select class="filter-event" name="id_event" id="filter-event" onchange="this.form.submit()">
                    <option value="">Semua Event</option>
                    <?php foreach ($listEvent as $event) : ?>
                        <option value="<?= $event['id_event'] ?>" 
                            <?= (isset($_GET['id_event']) && $_GET['id_event'] == $event['id_event']) ? 'selected' : '' ?>>
                            <?= $event['judul'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
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

            <div class="button" id="button-keputusan">
                <form method="POST">
                    <input type="hidden" name="id_pendaftaran" value="<?= $pendaftaran['id_pendaftaran']; ?>">
                    <button class="tolak" name="tolak">Tolak</button>
                </form>
                <form method="POST" action="verifikasi.php">
                    <input type="hidden" name="id_pendaftaran" value="<?= $pendaftaran['id_pendaftaran']; ?>">
                    <button class="terima" name="terima">Terima</button>
                </form>
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
                    const buttonKeputusan = document.getElementById('button-keputusan');

                    if (statusPendaftaran != 'menunggu') {
                        buttonKeputusan.classList.add('hidden');
                    } else {
                        buttonKeputusan.classList.remove('hidden');
                    }

                    buttonKeputusan.querySelectorAll('input[name="id_pendaftaran"]').forEach(input => {
                        input.value = idPendaftaran;
                    });
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
                            if (jawaban.tipe_input === "file") {
                                listJawaban.innerHTML += `
                                    <div class="jawaban-item">
                                        <span class="pertanyaan">${jawaban.pertanyaan}</span>
                                        <img src="<?= BASEURL; ?>/assets/images/uploads/${jawaban.jawaban}" alt="${jawaban.jawaban}">
                                    </div>
                                `;
                            } else {
                                listJawaban.innerHTML += `
                                    <div class="jawaban-item">
                                        <span class="pertanyaan">${jawaban.pertanyaan}</span>
                                        <span class="jawaban">${jawaban.jawaban}</span>
                                    </div>
                                `;
                            }
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
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
    <title>Tambah Event Baru</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/global.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/eo/form_event.css">
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
                <span>Buat Event Baru</span>
                <span>Lengkapi detail dan rancang form pendaftaran sesuai kebutuhan.</span>
            </div>
        </div>

        <div class="form-event">
            <span>Detail Event</span>

            <div class="detail-form-event">
                <div class="input-group">
                    <label for="nama_event">Nama Event</label>
                    <input type="text" id="nama_event" name="nama_event" placeholder="Contoh: Webinar Cyber Security">
                </div>

                <div class="input-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" placeholder="Jelaskan detail event..."></textarea>
                </div>

                <div class="input-row">
                    <div class="input-group-row">
                        <label for="kategori">Kategori</label>
                        <select name="kategori" id="kategori">
                            <option value="">Seminar</option>
                            <option value="">Webinar</option>
                            <option value="">Volunteer</option>
                            <option value="">Konser</option>
                            <option value="">Pameran</option>
                            <option value="">Lomba</option>
                            <option value="">Workshop</option>
                        </select>
                    </div>

                    <div class="input-group-row">
                        <label for="tanggal">Tanggal & Waktu</label>
                        <input type="datetime-local" id="tanggal" name="tanggal">
                    </div>
                </div>

                <div class="input-row">
                    <div class="input-group-row">
                        <label for="harga">Harga</label>
                        <input type="text" id="harga" name="harga" placeholder="Rp 0 (Gratis) atau Harga">
                    </div>

                    <div class="input-group-row">
                        <label for="lokasi">Lokasi / Link Platform</label>
                        <input type="text" id="lokasi" name="lokasi" placeholder="Contoh: Aula Unila / Link Zoom">
                    </div>
                </div>

                <div class="input-row">
                    <div class="input-group-row">
                        <label for="kuota">Kuota / Kapasitas Peserta</label>
                        <input type="number" id="kuota" name="kuota" placeholder="Contoh: 150">
                    </div>

                    <div class="input-group-row">
                        <label for="gambar">Cover Event</label>
                        <input type="file" id="gambar" accept="image/*">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-pendaftaran">
            <div class="header-pendaftaran">
                <span>Form Pendaftaran</span>
                <span>Buat kolom pertanyaan yang harus diisi peserta saat mendaftar.</span>
            </div>

            <div class="detail-form-pendaftaran">
                <div class="input-group-pendaftaran">
                    <div class="row-pertanyaan">
                        <input type="text" name="" id="" placeholder="Masukkan Pertanyaan">
                        <select>
                            <option value="">Jawaban Singkat</option>
                            <option value="">Paragraf</option>
                            <option value="">Pilihan Ganda</option>
                            <option value="">Dropdown</option>
                            <option value="">Tanggal</option>
                            <option value="">Jam</option>
                            <option value="">Nomor</option>
                            <option value="">File Upload</option>
                        </select>
                    </div>
                    <div class="opsi">
                        <div class="wajib-diisi">
                            <input type="checkbox" name="wajib" id="wajib">
                            <label for="wajib">Wajib Diisi</label>
                        </div>
                        <i class="icon" data-lucide="trash-2" onclick="this.parentElement.parentElement.remove()"></i>
                    </div>
                </div>

                <div class="input-group-pendaftaran">
                    <div class="row-pertanyaan">
                        <input type="text" name="" id="" placeholder="Masukkan Pertanyaan">
                        <select>
                            <option value="">Jawaban Singkat</option>
                            <option value="">Paragraf</option>
                            <option value="">Pilihan Ganda</option>
                            <option value="">Dropdown</option>
                            <option value="">Tanggal</option>
                            <option value="">Jam</option>
                            <option value="">Nomor</option>
                            <option value="">File Upload</option>
                        </select>
                    </div>
                    <div class="opsi">
                        <div class="wajib-diisi">
                            <input type="checkbox" name="wajib" id="wajib">
                            <label for="wajib">Wajib Diisi</label>
                        </div>
                        <i class="icon" data-lucide="trash-2" onclick="this.parentElement.parentElement.remove()"></i>
                    </div>
                </div>

                <button class="tambah-pertanyaan">
                    <i class="icon" data-lucide="plus-circle"></i>
                    <span>Tambah Pertanyaan</span>
                </button>
            </div>
        </div>

        <div class="button-submit">
            <a href="<?= BASEURL; ?>/app/views/eo/event.php">Batal</a>
            <button>Simpan</button>
        </div>
    </section>

    <script src="<?= BASEURL; ?>/assets/js/global.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tambahPertanyaan = document.querySelector('.tambah-pertanyaan')
            
            const htmlPertanyaan = `
            <div class="input-group-pendaftaran">
                    <div class="row-pertanyaan">
                        <input type="text" name="" id="" placeholder="Masukkan Pertanyaan">
                        <select>
                            <option value="">Jawaban Singkat</option>
                            <option value="">Paragraf</option>
                            <option value="">Pilihan Ganda</option>
                            <option value="">Dropdown</option>
                            <option value="">Tanggal</option>
                            <option value="">Jam</option>
                            <option value="">Nomor</option>
                            <option value="">File Upload</option>
                        </select>
                    </div>
                    <div class="opsi">
                        <div class="wajib-diisi">
                            <input type="checkbox" name="wajib" id="wajib">
                            <label for="wajib">Wajib Diisi</label>
                        </div>
                        <i class="icon" data-lucide="trash-2" onclick="this.parentElement.parentElement.remove()"></i>
                    </div>
                </div>
            `;

            tambahPertanyaan.addEventListener('click', () => {
                tambahPertanyaan.insertAdjacentHTML('beforebegin', htmlPertanyaan);
                lucide.createIcons();
            })

        })
    </script>
</body>
</html>
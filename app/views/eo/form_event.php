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

        <form class="form-event-baru" action="<?= BASEURL; ?>/app/controllers/eo/form_event.php" method="POST">
            <div class="form-event">
                <span class="header-form">Detail Event</span>
    
                <div class="detail-form-event">
                    <div class="input-group">
                        <label for="nama_event">Nama Event</label>
                        <input type="text" id="nama_event" name="nama_event" placeholder="Contoh: Webinar Cyber Security" required>
                    </div>
    
                    <div class="input-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" placeholder="Jelaskan detail event..." required></textarea>
                    </div>
    
                    <div class="input-row">
                        <div class="input-group-row">
                            <label for="kategori">Kategori</label>
                            <select name="kategori" id="kategori" required>
                                <option value="1">Volunteer</option>
                                <option value="2">Seminar</option>
                                <option value="3">Webinar</option>
                                <option value="4">Konser</option>
                                <option value="5">Lomba</option>
                            </select>
                        </div>
    
                        <div class="input-group-row">
                            <label for="tanggal">Tanggal & Waktu</label>
                            <input type="datetime-local" id="tanggal" name="tanggal" required>
                        </div>
                    </div>
    
                    <div class="input-row">
                        <div class="input-group-row">
                            <label for="harga">Biaya</label>
                            <input type="text" id="biaya" name="biaya" placeholder="Rp 0 (Gratis) atau Harga" required>
                        </div>
    
                        <div class="input-group-row">
                            <label for="lokasi">Lokasi / Link Platform</label>
                            <input type="text" id="lokasi" name="lokasi" placeholder="Contoh: Aula Unila / Link Zoom" required>
                        </div>
                    </div>
    
                    <div class="input-row">
                        <div class="input-group-row">
                            <label for="kuota">Kuota / Kapasitas Peserta</label>
                            <input type="number" id="kuota" name="kuota" placeholder="Contoh: 150" required>
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
                    <span class="header-form">Form Pendaftaran</span>
                    <span>Buat kolom pertanyaan yang harus diisi peserta saat mendaftar.</span>
                </div>
    
                <div class="detail-form-pendaftaran">
                    <div class="input-group-pendaftaran">
                        <div class="row-pertanyaan">
                            <input type="text" name="pertanyaan[0]" placeholder="Masukkan Pertanyaan">
                            <select name="tipe_pertanyaan[0]" class="dropdown-tipe-pertanyaan" onchange="aktifkanOpsiDropdown(this)">
                                <option value="teks">Jawaban Singkat</option>
                                <option value="paragraf">Paragraf</option>
                                <option value="dropdown">Dropdown</option>
                                <option value="tanggal">Tanggal</option>
                                <option value="angka">Angka</option>
                                <option value="file">File Upload</option>
                            </select>
                        </div>
                        
                        <div class="opsi-dropdown">
                            <span>Masukkan Pilihan:</span>
                            <div class="input-opsi-dropdown-group">
                                <div class="input-opsi-dropdown-item">
                                    <input type="text" name="opsi[0][]" value="Opsi 1">
                                    <i class="icon" data-lucide="trash-2" onclick="this.parentElement.remove()"></i>
                                </div>
                                <div class="input-opsi-dropdown-item">
                                    <input type="text" name="opsi[0][]" value="Opsi 2">
                                    <i class="icon" data-lucide="trash-2" onclick="this.parentElement.remove()"></i>
                                </div>
                            </div>
                            <button type="button" onclick="tambahOpsi(this, 0)" class="tambah-opsi">+ Tambah Opsi</button>
                        </div>
    
                        <div class="bottom-menu-form">
                            <div class="wajib-diisi">
                                <input type="checkbox" name="wajib[0]">
                                <label for="wajib">Wajib Diisi</label>
                            </div>
                            <i class="icon" data-lucide="trash-2" onclick="this.parentElement.parentElement.remove()"></i>
                        </div>
                    </div>
    
                    <button type="button" class="tambah-pertanyaan">
                        <i class="icon" data-lucide="plus-circle"></i>
                        <span>Tambah Pertanyaan</span>
                    </button>
                </div>
            </div>
    
            <div class="button-submit">
                <a href="<?= BASEURL; ?>/app/views/eo/event.php">Batal</a>
                <button type="submit" name="tambah_event_baru">Simpan</button>
            </div>
        </form>
    </section>

    <script src="<?= BASEURL; ?>/assets/js/global.js"></script>
    <script src="<?= BASEURL; ?>/assets/js/eo/form_event.js"></script>
</body>
</html>
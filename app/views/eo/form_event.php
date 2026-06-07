<?php
    /** @var array $listKategori */
    /** @var array $listPertanyaan */
    /** @var array $tipePertanyaan */
    /** @var array $opsiDropdown */
    /** @var array $wajibDiisi */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $isEdit ? 'Edit Event' : 'Tambah Event Baru'; ?></title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/global.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="eo-form-event-page">
    <?php
        $halamanAktif = 'event';
        include 'navbar.php';
    ?>

    <section>
        <div class="header">
            <div class="header-title">
                <span><?= $isEdit ? 'Edit Event' : 'Buat Event Baru'; ?></span>
                <span>Lengkapi detail dan rancang form pendaftaran sesuai kebutuhan.</span>
            </div>
        </div>

        <form class="form-event-baru" method="POST" enctype="multipart/form-data">
            <div class="form-event">
                <span class="header-form">Detail Event</span>
    
                <div class="detail-form-event">
                    <div class="input-group">
                        <label for="nama_event" class="wajib-diisi">Nama Event</label>
                        <input value="<?= $namaEvent; ?>" type="text" id="nama_event" name="nama_event" placeholder="Contoh: Webinar Cyber Security" required>
                    </div>
    
                    <div class="input-group">
                        <label for="deskripsi" class="wajib-diisi">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" placeholder="Jelaskan detail event..." required><?= $deskripsiEvent; ?></textarea>
                    </div>
    
                    <div class="input-row">
                        <div class="input-group-row">
                            <label for="kategori" class="wajib-diisi">Kategori</label>
                            <select  name="kategori" id="kategori" required>
                                <?php foreach ($listKategori as $kategori) : ?>
                                    <option <?= $kategori['id_kategori'] == $kategoriEvent ? 'selected' : ''; ?> value="<?= $kategori['id_kategori'] ?>"><?= $kategori['kategori'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
    
                        <div class="input-group-row">
                            <label for="tanggal" class="wajib-diisi">Tanggal & Waktu</label>
                            <input value="<?= $tanggalEvent; ?>" type="datetime-local" id="tanggal" name="tanggal" required>
                        </div>
                    </div>
    
                    <div class="input-row">
                        <div class="input-group-row">
                            <label for="harga" class="wajib-diisi">Biaya</label>
                            <input value="<?= $biayaEvent; ?>" type="number" id="biaya" name="biaya" placeholder="Rp 0 (Gratis) atau Harga" required>
                        </div>
    
                        <div class="input-group-row">
                            <label for="lokasi" class="wajib-diisi">Lokasi / Link Platform</label>
                            <input value="<?= $lokasiEvent; ?>" type="text" id="lokasi" name="lokasi" placeholder="Contoh: Aula Unila / Link Zoom" required>
                        </div>
                    </div>
    
                    <div class="input-row">
                        <div class="input-group-row">
                            <label for="benefit">Benefit</label>
                            <textarea name="benefit" id="benefit" placeholder="Contoh: E-sertifikat, Doorprize, dll"><?= $benefitEvent; ?></textarea>
                        </div>
                        <div class="input-group-column">
                            <div class="input-group">
                                <label for="kuota" class="wajib-diisi">Kuota / Kapasitas Peserta</label>
                                <input value="<?= $kuotaEvent; ?>" type="number" id="kuota" name="kuota" placeholder="Contoh: 150" required>
                            </div>
        
                            <div class="input-group">
                                <label for="cover_img" class="wajib-diisi">Cover Event</label>
                                <input type="file" name="cover_img" id="cover_img" accept="image/*" required>
                            </div>
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
                    <?php if (!$isEdit) : ?>
                        <div class="input-group-pendaftaran">
                            <div class="row-pertanyaan">
                                <input type="text" name="pertanyaan[0]" placeholder="Masukkan Pertanyaan" required>
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
                                        <input type="text" name="opsi[0][]" value="Opsi 1" required>
                                        <i class="icon" data-lucide="trash-2" onclick="this.parentElement.remove()"></i>
                                    </div>
                                    <div class="input-opsi-dropdown-item">
                                        <input type="text" name="opsi[0][]" value="Opsi 2" required>
                                        <i class="icon" data-lucide="trash-2" onclick="this.parentElement.remove()"></i>
                                    </div>
                                </div>
                                <button type="button" onclick="tambahOpsi(this, 0)" class="tambah-opsi">+ Tambah Opsi</button>
                            </div>
        
                            <div class="bottom-menu-form">
                                <div class="checkbox-wajib">
                                    <input type="checkbox" name="wajib[0]">
                                    <label for="wajib" class="wajib-diisi">Wajib Diisi</label>
                                </div>
                                <i class="icon" data-lucide="trash-2" onclick="this.parentElement.parentElement.remove()"></i>
                            </div>
                        </div>
                    <?php else : ?>
                        <?php for ($i = 0; $i < count($listPertanyaan); $i++) : ?>
                            <div class="input-group-pendaftaran">
                                <div class="row-pertanyaan">
                                    <input type="text" name="pertanyaan[<?= $i ?>]" placeholder="Masukkan Pertanyaan" value="<?= $listPertanyaan[$i] ?>" required>
                                    <select name="tipe_pertanyaan[<?= $i ?>]" class="dropdown-tipe-pertanyaan" onchange="aktifkanOpsiDropdown(this)">
                                        <option <?= $tipePertanyaan[$i] == 'teks' ? 'selected' : '' ?> value="teks">Jawaban Singkat</option>
                                        <option <?= $tipePertanyaan[$i] == 'paragraf' ? 'selected' : '' ?> value="paragraf">Paragraf</option>
                                        <option <?= $tipePertanyaan[$i] == 'dropdown' ? 'selected' : '' ?> value="dropdown">Dropdown</option>
                                        <option <?= $tipePertanyaan[$i] == 'tanggal' ? 'selected' : '' ?> value="tanggal">Tanggal</option>
                                        <option <?= $tipePertanyaan[$i] == 'angka' ? 'selected' : '' ?> value="angka">Angka</option>
                                        <option <?= $tipePertanyaan[$i] == 'file' ? 'selected' : '' ?> value="file">File Upload</option>
                                    </select>
                                </div>

                                <?php if ($tipePertanyaan[$i] == 'dropdown') : ?>
                                    <div class="opsi-dropdown active">
                                        <span>Masukkan Pilihan:</span>
                                        <div class="input-opsi-dropdown-group">
                                            <?php for ($j = 0; $j < count($opsiDropdown[$i]); $j++) : ?>
                                                <div class="input-opsi-dropdown-item">
                                                    <input type="text" name="opsi[<?= $i ?>][<?= $j ?>]" value="<?= $opsiDropdown[$i][$j] ?>" required>
                                                    <i class="icon" data-lucide="trash-2" onclick="this.parentElement.remove()"></i>
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <button type="button" onclick="tambahOpsi(this, <?= $i ?>)" class="tambah-opsi">+ Tambah Opsi</button>
                                    </div>
                                <?php endif; ?>

                                <div class="bottom-menu-form">
                                    <div class="checkbox-wajib">
                                        <input <?= $wajibDiisi[$i] == 1 ? 'checked' : '' ?> type="checkbox" name="wajib[<?= $i ?>]">
                                        <label for="wajib" class="wajib-diisi">Wajib Diisi</label>
                                    </div>
                                    <i class="icon" data-lucide="trash-2" onclick="this.parentElement.parentElement.remove()"></i>
                                </div>
                            </div>
                        <?php endfor; ?>
                    <?php endif; ?>
                    
                    <button type="button" class="tambah-pertanyaan">
                        <i class="icon" data-lucide="plus-circle"></i>
                        <span>Tambah Pertanyaan</span>
                    </button>
                </div>

            </div>
    
            <div class="button-submit">
                <a href="<?= BASEURL; ?>/app/controllers/eo/event.php">Batal</a>
                <button type="submit" name="<?= $isEdit ? 'edit_event' : 'tambah_event_baru'; ?>"><?= $isEdit ? 'Simpan Perubahan' : 'Simpan'; ?></button>
            </div>
        </form>
    </section>

    <script src="<?= BASEURL; ?>/assets/js/global.js"></script>
    <script src="<?= BASEURL; ?>/assets/js/eo/form_event.js"></script>
</body>
</html>
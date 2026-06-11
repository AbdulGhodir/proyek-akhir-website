<?php
require_once '../../config/config.php';
require_once '../../../koneksi/koneksi.php';
require_once '../../models/KategoriModel.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: ' . BASEURL . '/app/views/auth/login.php');
    exit;
}

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$semua_kategori  = getAllKategori($conn);

$kat_selected    = null;
$events_in_kat   = [];
$kat_id_selected = (int)($_GET['kat'] ?? 0);

if ($kat_id_selected > 0) {
    $kat_selected  = getKategoriById($conn, $kat_id_selected);
    $events_in_kat = getEventByKategori($conn, $kat_id_selected);
}

$badge_color = [
    'Volunteer' => 'green',
    'Seminar'   => 'blue',
    'Webinar'   => 'yellow',
    'Konser'    => 'purple',
    'Lomba'     => 'red',
];
$badge_emoji = [
    'Volunteer' => '🤝',
    'Seminar'   => '🎓',
    'Webinar'   => '💻',
    'Konser'    => '🎵',
    'Lomba'     => '🏆',
];
$status_badge = [
    'Dipublikasikan' => 'green',
    'Pending'        => 'yellow',
    'Ditolak'        => 'red',
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Kategori | Eventify Admin</title>
    <meta name="description" content="Kelola event dalam setiap kategori di platform Eventify — tambah, edit, dan hapus event.">
    <link rel="stylesheet" href="<?= BASEURL ?>/assets/css/global.css">

</head>
<body class="admin-page">

<?php include 'sidebar.php'; ?>

<main class="main">

    <?php if ($flash): ?>
        <div class="flash-toast flash-<?= $flash['type'] ?>" id="flashToast">
            <i class='bx <?= $flash['type'] === 'success' ? 'bx-check-circle' : 'bx-error-circle' ?>'></i>
            <?= htmlspecialchars($flash['msg']) ?>
        </div>
    <?php endif; ?>

    <div class="page-header">
        <h1>Kelola Kategori</h1>
        <p>Pilih kategori untuk mengelola event di dalamnya — tambah, edit, atau hapus event.</p>
    </div>

    <!-- ── Daftar Kategori ──────────────────────────────────────────────────── -->
    <div class="card" style="margin-bottom:24px;">
        <div class="card-head">
            <h3>
                <i class='bx bx-category' style="color:var(--primary);vertical-align:middle;margin-right:6px;font-size:20px;"></i>
                Kategori Event
                <span style="background:var(--primary);color:#fff;font-size:11px;font-weight:700;padding:2px 8px;border-radius:20px;margin-left:6px;">
                    <?= count($semua_kategori) ?>
                </span>
            </h3>
            <button type="button" onclick="openModal('katModal')" class="btn btn-primary-grad" style="font-size:13px;padding:7px 14px;">
                <i class='bx bx-plus'></i> Tambah Kategori
            </button>
        </div>

        <?php if (!empty($semua_kategori)): ?>
            <div style="padding:16px 22px 20px;">
                <div class="kat-grid">
                    <?php foreach ($semua_kategori as $kat): ?>
                        <?php
                            $is_sel = $kat_id_selected === (int)$kat['id_kategori'];
                            $emoji  = $badge_emoji[$kat['kategori']] ?? '📁';
                            $jml    = (int)$kat['jumlah_event'];
                        ?>
                        <a href="?kat=<?= $kat['id_kategori'] ?>"
                           class="kat-card <?= $is_sel ? 'selected' : '' ?>">

                            <form method="POST"
                                  action="<?= BASEURL ?>/app/controllers/admin/aksi-kategori.php"
                                  onsubmit="return confirmHapusKat(event,'<?= htmlspecialchars(addslashes($kat['kategori'])) ?>',<?= $jml ?>)"
                                  style="position:absolute;top:9px;right:9px;">
                                <input type="hidden" name="aksi" value="hapus">
                                <input type="hidden" name="id_kategori" value="<?= $kat['id_kategori'] ?>">
                                <button type="submit" class="delete-kat-btn" title="Hapus Kategori">
                                    <i class='bx bx-trash'></i>
                                </button>
                            </form>

                            <div class="kat-emoji"><?= $emoji ?></div>
                            <div class="kat-name"><?= htmlspecialchars($kat['kategori']) ?></div>
                            <div class="kat-count"><strong><?= $jml ?></strong> event</div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="empty-state" style="padding:40px;">
                <i class='bx bx-category'></i>
                <p>Belum ada kategori.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- ── Panel Event per Kategori ────────────────────────────────────────── -->
    <div class="kat-event-panel">
        <div class="panel-head">
            <h3>
                <i class='bx bx-calendar-event' style="color:var(--primary);font-size:18px;"></i>
                <?php if ($kat_selected): ?>
                    Event —
                    <span style="color:var(--primary);"><?= htmlspecialchars($kat_selected['kategori']) ?></span>
                    <span class="badge <?= $badge_color[$kat_selected['kategori']] ?? 'blue' ?>">
                        <?= count($events_in_kat) ?> event
                    </span>
                <?php else: ?>
                    Kelola Event per Kategori
                <?php endif; ?>
            </h3>

            <div style="display:flex;gap:8px;align-items:center;">
                <?php if ($kat_selected): ?>
                    <button type="button" onclick="openModal('addModal')" class="btn btn-primary-grad" style="font-size:13px;padding:8px 15px;">
                        <i class='bx bx-plus'></i> Tambah Event
                    </button>
                    <a href="<?= BASEURL ?>/app/views/admin/kelola-kategori.php"
                       style="font-size:13px;color:var(--muted);text-decoration:none;display:flex;align-items:center;gap:3px;">
                        <i class='bx bx-x'></i> Tutup
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <?php if (!$kat_selected): ?>
            <div class="select-hint">
                <i class='bx bx-pointer'></i>
                <p>Pilih kategori di atas untuk melihat dan mengelola event di dalamnya.</p>
            </div>

        <?php elseif (empty($events_in_kat)): ?>
            <div class="empty-state" style="padding:52px;">
                <i class='bx bx-calendar-x'></i>
                <p>Belum ada event di kategori <strong><?= htmlspecialchars($kat_selected['kategori']) ?></strong>.</p>
                <button type="button" onclick="openModal('addModal')" class="btn btn-primary-grad" style="margin-top:16px;font-size:13px;">
                    <i class='bx bx-plus'></i> Tambah Event Sekarang
                </button>
            </div>

        <?php else: ?>
            <div class="table-wrap">
                <table class="ev-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th colspan="2">Event</th>
                            <th>Penyelenggara</th>
                            <th>Tanggal</th>
                            <th>Biaya</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($events_in_kat as $idx => $ev): ?>
                            <?php
                                $cover_file  = $ev['cover_image'] ?: '';
                                $file_abs    = __DIR__ . '/../../../assets/images/uploads/' . $cover_file;
                                $file_abs2   = __DIR__ . '/../../../assets/images/' . $cover_file;
                                if ($cover_file && file_exists($file_abs)) {
                                    $img_path = BASEURL . '/assets/images/uploads/' . $cover_file;
                                } elseif ($cover_file && file_exists($file_abs2)) {
                                    $img_path = BASEURL . '/assets/images/' . $cover_file;
                                } else {
                                    $img_path = BASEURL . '/assets/images/uploads/tech-seminar.png';
                                }
                                $org_label   = $ev['nama_organisasi'] ?: $ev['nama_lengkap'];
                                $st_badge    = $status_badge[$ev['status_publikasi']] ?? 'blue';
                                $tgl_input   = date('Y-m-d\TH:i', strtotime($ev['waktu_pelaksanaan']));
                            ?>
                            <tr>
                                <td style="color:var(--muted);font-size:12px;"><?= $idx + 1 ?></td>
                                <td style="width:44px;">
                                    <img src="<?= $img_path ?>"
                                         alt="cover" class="ev-cover"
                                         onerror="this.onerror=null;this.src='<?= BASEURL ?>/assets/images/tech-seminar.png'">
                                </td>
                                <td>
                                    <div class="ev-title"><?= htmlspecialchars($ev['judul']) ?></div>
                                    <div class="ev-sub"><i class='bx bx-map-pin'></i> <?= htmlspecialchars($ev['lokasi']) ?></div>
                                </td>
                                <td style="font-size:13px;font-weight:600;"><?= htmlspecialchars($org_label) ?></td>
                                <td style="font-size:13px;color:var(--muted);white-space:nowrap;">
                                    <?= formatTanggalIndo($ev['waktu_pelaksanaan']) ?>
                                </td>
                                <td style="font-size:13px;"><?= formatRupiah($ev['biaya']) ?></td>
                                <td>
                                    <span class="badge <?= $st_badge ?>"><?= htmlspecialchars($ev['status_publikasi']) ?></span>
                                </td>
                                <td>
                                    <div class="act-group">
                                        <!-- Edit -->
                                        <button type="button" class="btn-xs edit"
                                            onclick='openEditModal(<?= json_encode([
                                                "id"        => $ev["id_event"],
                                                "judul"     => $ev["judul"],
                                                "tanggal"   => $tgl_input,
                                                "biaya"     => $ev["biaya"],
                                                "lokasi"    => $ev["lokasi"],
                                                "kuota"     => $ev["kuota"],
                                                "deskripsi" => $ev["deskripsi"],
                                                "benefit"   => $ev["benefit"] ?? "",
                                                "gambar"    => $ev["cover_image"],
                                                "status"    => $ev["status_publikasi"],
                                            ]) ?>)'>
                                            <i class='bx bx-edit'></i> Edit
                                        </button>

                                        <!-- Hapus -->
                                        <form method="POST"
                                              action="<?= BASEURL ?>/app/controllers/admin/aksi-kategori.php"
                                              onsubmit="return confirm('Hapus event \'<?= htmlspecialchars(addslashes($ev['judul'])) ?>\' secara permanen?')">
                                            <input type="hidden" name="aksi" value="hapus-event">
                                            <input type="hidden" name="id_event" value="<?= $ev['id_event'] ?>">
                                            <input type="hidden" name="id_kategori" value="<?= $kat_id_selected ?>">
                                            <button type="submit" class="btn-xs danger">
                                                <i class='bx bx-trash'></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

</main>


<div class="modal-overlay" id="katModal">
    <div class="modal-box" style="max-width:420px;">
        <form method="POST" action="<?= BASEURL ?>/app/controllers/admin/aksi-kategori.php">
            <input type="hidden" name="aksi" value="tambah-kat">

            <div class="m-head">
                <h3>
                    <i class='bx bx-category' style="color:var(--primary);"></i>
                    Tambah Kategori Baru
                </h3>
                <button type="button" class="m-close" onclick="closeModal('katModal')">
                    <i class='bx bx-x'></i>
                </button>
            </div>

            <div class="m-body">
                <div class="f-group">
                    <label>Nama Kategori <span class="req">*</span></label>
                    <input type="text" name="nama_kategori" id="kat_nama"
                           placeholder="Contoh: Workshop, Festival, Olahraga…"
                           maxlength="50" required autocomplete="off">
                    <span class="f-hint">Maksimal 50 karakter, nama harus unik.</span>
                </div>
            </div>

            <div class="m-foot">
                <button type="button" onclick="closeModal('katModal')"
                    class="btn" style="background:var(--bg);color:var(--muted);border:1.5px solid var(--line);">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary-grad">
                    <i class='bx bx-plus'></i> Tambah Kategori
                </button>
            </div>
        </form>
    </div>
</div>


<div class="modal-overlay" id="addModal">
    <div class="modal-box">
        <form method="POST" action="<?= BASEURL ?>/app/controllers/admin/aksi-kategori.php" enctype="multipart/form-data">
            <input type="hidden" name="aksi" value="tambah-event">
            <input type="hidden" name="id_kategori" value="<?= $kat_id_selected ?>">

            <div class="m-head">
                <h3>
                    <i class='bx bx-plus-circle' style="color:var(--primary);"></i>
                    Tambah Event<?= $kat_selected ? ' — ' . htmlspecialchars($kat_selected['kategori']) : '' ?>
                </h3>
                <button type="button" class="m-close" onclick="closeModal('addModal')">
                    <i class='bx bx-x'></i>
                </button>
            </div>

            <div class="m-body">
                <div class="f-group">
                    <label>Judul Event <span class="req">*</span></label>
                    <input type="text" name="judul" placeholder="Masukkan judul event..." required>
                </div>

                <div class="f-row">
                    <div class="f-group">
                        <label>Tanggal & Waktu <span class="req">*</span></label>
                        <input type="datetime-local" name="tanggal" required>
                    </div>
                    <div class="f-group">
                        <label>Lokasi <span class="req">*</span></label>
                        <input type="text" name="lokasi" placeholder="Contoh: Zoom / Aula GSG" required>
                    </div>
                </div>

                <div class="f-row">
                    <div class="f-group">
                        <label>Biaya (Rp)</label>
                        <input type="number" name="biaya" value="0" min="0" placeholder="0">
                        <span class="f-hint">Isi 0 untuk gratis</span>
                    </div>
                    <div class="f-group">
                        <label>Kuota <span class="req">*</span></label>
                        <input type="number" name="kuota" min="1" placeholder="100" required>
                    </div>
                </div>

                <div class="f-group">
                    <label>Deskripsi <span class="req">*</span></label>
                    <textarea name="deskripsi" placeholder="Deskripsi singkat event..." required></textarea>
                </div>

                <div class="f-group">
                    <label>Benefit (Opsional)</label>
                    <textarea name="benefit" placeholder="Apa yang peserta dapatkan..." style="min-height:60px;"></textarea>
                </div>

                <div class="f-row">
                    <div class="f-group">
                        <label>Cover Image</label>
                        <input type="file" name="cover_image" accept="image/*">
                        <span class="f-hint">Kosongkan untuk pakai gambar default</span>
                    </div>
                    <div class="f-group">
                        <label>Status Publikasi</label>
                        <select name="status">
                            <option value="Dipublikasikan">Dipublikasikan</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="m-foot">
                <button type="button" onclick="closeModal('addModal')"
                    class="btn" style="background:var(--bg);color:var(--muted);border:1.5px solid var(--line);">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary-grad">
                    <i class='bx bx-plus'></i> Tambah Event
                </button>
            </div>
        </form>
    </div>
</div>


<div class="modal-overlay" id="editModal">
    <div class="modal-box">
        <form method="POST" action="<?= BASEURL ?>/app/controllers/admin/aksi-kategori.php" enctype="multipart/form-data">
            <input type="hidden" name="aksi" value="edit-event">
            <input type="hidden" name="id_kategori" value="<?= $kat_id_selected ?>">
            <input type="hidden" name="id_event"     id="edit_id_event">
            <input type="hidden" name="current_gambar" id="edit_current_gambar">

            <div class="m-head">
                <h3>
                    <i class='bx bx-edit' style="color:var(--primary);"></i>
                    Edit Event
                </h3>
                <button type="button" class="m-close" onclick="closeModal('editModal')">
                    <i class='bx bx-x'></i>
                </button>
            </div>

            <div class="m-body">
                <div class="f-group">
                    <label>Judul Event <span class="req">*</span></label>
                    <input type="text" name="judul" id="edit_judul" required>
                </div>

                <div class="f-row">
                    <div class="f-group">
                        <label>Tanggal & Waktu <span class="req">*</span></label>
                        <input type="datetime-local" name="tanggal" id="edit_tanggal" required>
                    </div>
                    <div class="f-group">
                        <label>Lokasi <span class="req">*</span></label>
                        <input type="text" name="lokasi" id="edit_lokasi" required>
                    </div>
                </div>

                <div class="f-row">
                    <div class="f-group">
                        <label>Biaya (Rp)</label>
                        <input type="number" name="biaya" id="edit_biaya" min="0">
                    </div>
                    <div class="f-group">
                        <label>Kuota <span class="req">*</span></label>
                        <input type="number" name="kuota" id="edit_kuota" min="1" required>
                    </div>
                </div>

                <div class="f-group">
                    <label>Deskripsi <span class="req">*</span></label>
                    <textarea name="deskripsi" id="edit_deskripsi" required></textarea>
                </div>

                <div class="f-group">
                    <label>Benefit (Opsional)</label>
                    <textarea name="benefit" id="edit_benefit" style="min-height:60px;"></textarea>
                </div>

                <div class="f-row">
                    <div class="f-group">
                        <label>Ganti Cover Image</label>
                        <input type="file" name="cover_image" accept="image/*">
                        <span class="f-hint" id="edit_gambar_hint">—</span>
                    </div>
                    <div class="f-group">
                        <label>Status Publikasi</label>
                        <select name="status" id="edit_status">
                            <option value="Dipublikasikan">Dipublikasikan</option>
                            <option value="Pending">Pending</option>
                            <option value="Ditolak">Ditolak</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="m-foot">
                <button type="button" onclick="closeModal('editModal')"
                    class="btn" style="background:var(--bg);color:var(--muted);border:1.5px solid var(--line);">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary-grad">
                    <i class='bx bx-save'></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>

    const toast = document.getElementById('flashToast');
    if (toast) setTimeout(() => toast.style.opacity = '0', 3500);

   
    function openModal(id) {
        document.getElementById(id).classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function closeModal(id) {
        document.getElementById(id).classList.remove('open');
        document.body.style.overflow = '';
    }


    document.querySelectorAll('.modal-overlay').forEach(el => {
        el.addEventListener('click', function(e) {
            if (e.target === this) closeModal(this.id);
        });
    });

    
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape')
            document.querySelectorAll('.modal-overlay.open').forEach(el => closeModal(el.id));
    });

    // ── Populate edit modal ──────────────────────────────────────
    function openEditModal(d) {
        document.getElementById('edit_id_event').value        = d.id;
        document.getElementById('edit_judul').value           = d.judul;
        document.getElementById('edit_tanggal').value         = d.tanggal;
        document.getElementById('edit_biaya').value           = d.biaya;
        document.getElementById('edit_lokasi').value          = d.lokasi;
        document.getElementById('edit_kuota').value           = d.kuota;
        document.getElementById('edit_deskripsi').value       = d.deskripsi;
        document.getElementById('edit_benefit').value         = d.benefit || '';
        document.getElementById('edit_current_gambar').value  = d.gambar;
        document.getElementById('edit_gambar_hint').textContent = 'Cover saat ini: ' + d.gambar;

        const sel = document.getElementById('edit_status');
        for (const opt of sel.options) opt.selected = opt.value === d.status;

        openModal('editModal');
    }

    // ── Konfirmasi hapus kategori ────────────────────────────────
    function confirmHapusKat(e, nama, jml) {
        e.preventDefault();
        e.stopPropagation();
        if (jml > 0) {
            alert(`Kategori "${nama}" tidak dapat dihapus karena masih punya ${jml} event.\nHapus semua event-nya terlebih dahulu.`);
            return false;
        }
        if (!confirm(`Hapus kategori "${nama}" secara permanen?`)) return false;
        e.target.closest('form').submit();
        return false;
    }
</script>
</body>
</html>

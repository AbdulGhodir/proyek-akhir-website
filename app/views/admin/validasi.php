<?php
require_once '../../config/config.php';
require_once '../../../koneksi/koneksi.php';

$tab = $_GET['tab'] ?? 'pending';
$allowed = ['pending', 'dipublikasi', 'ditolak'];
if (!in_array($tab, $allowed))
    $tab = 'pending';


function count_status($conn, $s)
{
    $r = $conn->query("SELECT COUNT(*) AS t FROM event WHERE status_publikasi = '$s'");
    return $r ? $r->fetch_assoc()['t'] : 0;
}
$c_pend = count_status($conn, 'pending');
$c_pub = count_status($conn, 'dipublikasi');
$c_tol = count_status($conn, 'ditolak');


$q = $conn->query("
    SELECT e.*, u.nama_lengkap, u.nama_organisasi,
           (SELECT COUNT(*) FROM pendaftaran p WHERE p.id_event = e.id_event) AS terisi
    FROM event e
    JOIN users u ON e.id_user = u.id
    WHERE e.status_publikasi = '$tab'
    ORDER BY e.created_at DESC
");

$cat_badge = ['Seminar' => 'blue', 'Webinar' => 'yellow', 'Volunteer' => 'green', 'Konser' => 'purple'];

function rupiah($n)
{
    return $n == 0 ? 'Gratis' : 'Rp ' . number_format($n, 0, ',', '.');
}
function rel_time($dt)
{
    $diff = time() - strtotime($dt);
    if ($diff < 60)
        return 'Baru saja';
    if ($diff < 3600)
        return floor($diff / 60) . ' menit lalu';
    if ($diff < 86400)
        return floor($diff / 3600) . ' jam lalu';
    return floor($diff / 86400) . ' hari lalu';
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Validasi Event | Eventify Admin</title>
    <meta name="description" content="Tinjau dan validasi event yang diajukan EO di platform Eventify.">
    <link rel="stylesheet" href="<?= BASEURL ?>/assets/css/admin/admin-style.css">
</head>

<body>

    <?php include 'sidebar.php'; ?>

    <main class="main">

        <div class="page-header">
            <h1>Validasi Event</h1>
            <p>Tinjau dan setujui atau tolak event yang diajukan oleh Event Organizer.</p>
        </div>

        <div class="toolbar" style="margin-bottom:24px;">
            <div class="filter-bar">
                <a href="?tab=pending" class="filter-pill <?= $tab === 'pending' ? 'active' : '' ?>">
                    Menunggu <span style="opacity:.7">(<?= $c_pend ?>)</span>
                </a>
                <a href="?tab=dipublikasi" class="filter-pill <?= $tab === 'dipublikasi' ? 'active' : '' ?>">
                    Disetujui <span style="opacity:.7">(<?= $c_pub ?>)</span>
                </a>
                <a href="?tab=ditolak" class="filter-pill <?= $tab === 'ditolak' ? 'active' : '' ?>">
                    Ditolak <span style="opacity:.7">(<?= $c_tol ?>)</span>
                </a>
            </div>
        </div>

        <?php if ($q && $q->num_rows > 0): ?>
            <div class="event-grid-admin">
                <?php while ($ev = $q->fetch_assoc()):
                    $bdg = $cat_badge[$ev['kategori']] ?? 'blue';
                    $eo_label = $ev['nama_organisasi'] ?: $ev['nama_lengkap'];
                    $pct = $ev['kuota'] > 0 ? round(($ev['terisi'] / $ev['kuota']) * 100) : 0;
                    $cover_style = $ev['cover_image']
                        ? 'background-image:url(' . BASEURL . 'assets/images/' . $ev['cover_image'] . ')'
                        : 'background:linear-gradient(135deg,#062A45,#0B74B9)';
                    ?>
                    <div class="ev-card">
                        <div class="ev-thumb" style="<?= $cover_style ?>">
                            <div class="ev-thumb-badges">
                                <span class="badge <?= $bdg ?>"><?= $ev['kategori'] ?></span>
                                <span class="badge <?= $ev['biaya'] == 0 ? 'green' : 'yellow' ?>">
                                    <?= rupiah($ev['biaya']) ?>
                                </span>
                            </div>
                        </div>

                        <div class="ev-body">
                            <div class="ev-title"><?= htmlspecialchars($ev['judul']) ?></div>
                            <div class="ev-eo">
                                <i class='bx bxs-building-house'></i>
                                <?= htmlspecialchars($eo_label) ?>
                            </div>
                            <div
                                style="font-size:12px;color:var(--muted);display:flex;gap:12px;flex-wrap:wrap;margin-bottom:4px;">
                                <span><i class='bx bx-calendar' style="color:var(--primary)"></i>
                                    <?= date('d M Y, H:i', strtotime($ev['waktu_pelaksanaan'])) ?>
                                </span>
                                <span><i class='bx bx-map' style="color:var(--primary)"></i>
                                    <?= htmlspecialchars($ev['lokasi']) ?>
                                </span>
                            </div>
                            <div style="font-size:11px;color:var(--muted);margin-top:4px;">
                                Disubmit <?= rel_time($ev['created_at']) ?>
                            </div>

                            <div class="cap-bar-wrap">
                                <div class="cap-bar-label">
                                    <span>Kuota terisi</span>
                                    <span><?= $ev['terisi'] ?> / <?= $ev['kuota'] ?></span>
                                </div>
                                <div class="cap-track">
                                    <div class="cap-fill" style="width:<?= $pct ?>%"></div>
                                </div>
                            </div>
                        </div>

                        <div class="ev-footer">

                            <button class="btn btn-ghost" onclick="openDrawer(<?= $ev['id_event'] ?>)">
                                <i class='bx bx-search-alt-2'></i> Tinjau
                            </button>

                            <?php if ($tab === 'pending'): ?>

                                <form method="POST" action="<?= BASEURL ?>/app/controllers/admin/aksi-validasi.php"
                                    onsubmit="return confirm('Setujui dan publikasikan event ini?')">
                                    <input type="hidden" name="id" value="<?= $ev['id_event'] ?>">
                                    <input type="hidden" name="aksi" value="setujui">
                                    <input type="hidden" name="redirect"
                                        value="<?= BASEURL ?>/app/views/admin/validasi.php?tab=pending">
                                    <button type="submit" class="btn btn-approve">
                                        <i class='bx bx-check'></i> Setujui
                                    </button>
                                </form>

                                <button class="btn btn-reject" onclick="openDrawerReject(<?= $ev['id_event'] ?>)">
                                    <i class='bx bx-x'></i> Tolak
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

        <?php else: ?>
            <div class="card" style="padding:40px;">
                <div class="empty-state">
                    <i class='bx bx-calendar-x'></i>
                    <p>Tidak ada event dengan status <strong><?= $tab ?></strong>.</p>
                </div>
            </div>
        <?php endif; ?>

    </main>

    <div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawer()"></div>

    <div class="drawer" id="drawer">
        <button class="drawer-close" onclick="closeDrawer()">
            <i class='bx bx-x'></i>
        </button>
        <div class="drawer-body" id="drawerBody">
            <div style="padding:60px;text-align:center;color:var(--muted);">
                <i class='bx bx-loader-alt'
                    style="font-size:40px;animation:spin 1s linear infinite;display:block;margin-bottom:12px;"></i>
                Memuat detail event…
            </div>
        </div>
        <div class="drawer-actions" id="drawerActions" style="display:none;">
            <button class="btn drawer-actions btn-approve-full" id="btnSetujui" onclick="submitAksi('setujui')">
                <i class='bx bx-check-circle'></i> Setujui &amp; Publish
            </button>
            <button class="btn drawer-actions btn-reject-full" id="btnTolak" onclick="submitReject()">
                <i class='bx bx-x-circle'></i> Tolak
            </button>
        </div>
    </div>


    <form method="POST" action="<?= BASEURL ?>/app/controllers/admin/aksi-validasi.php" id="formAksi">
        <input type="hidden" name="id" id="formAksiId">
        <input type="hidden" name="aksi" id="formAksiType">
        <input type="hidden" name="alasan" id="formAksiAlasan">
        <input type="hidden" name="redirect" value="<?= BASEURL ?>/app/views/admin/validasi.php?tab=<?= $tab ?>">
    </form>

    <script>

        <?php
        $q_all = $conn->query("
    SELECT e.*, u.nama_lengkap, u.nama_organisasi,
           (SELECT COUNT(*) FROM pendaftaran p WHERE p.id_event = e.id_event) AS terisi
    FROM event e JOIN users u ON e.id_user = u.id
    WHERE e.status_publikasi = '$tab'
");
        $events_js = [];
        if ($q_all) {
            while ($r = $q_all->fetch_assoc()) {
                $fq = $conn->query("SELECT pertanyaan, tipe_input FROM event_form WHERE id_event = " . (int) $r['id_event']);
                $fields = [];
                if ($fq)
                    while ($f = $fq->fetch_assoc())
                        $fields[] = $f;
                $r['form_fields'] = $fields;
                $events_js[$r['id_event']] = $r;
            }
        }
        echo 'const EVENTS = ' . json_encode($events_js) . ';';
        ?>

        const tab = '<?= $tab ?>';
        let currentId = null;

        function rupiah(n) {
            return n == 0 ? 'Gratis' : 'Rp ' + parseInt(n).toLocaleString('id-ID');
        }

        function openDrawer(id) {
            currentId = id;
            const ev = EVENTS[id];
            if (!ev) return;

            const pct = ev.kuota > 0 ? Math.round((ev.terisi / ev.kuota) * 100) : 0;
            const badgeMap = { Seminar: 'blue', Webinar: 'yellow', Volunteer: 'green', Konser: 'purple' };
            const bdg = badgeMap[ev.kategori] || 'blue';
            const eo = ev.nama_organisasi || ev.nama_lengkap;
            const coverStyle = ev.cover_image
                ? `background-image:url('<?= BASEURL ?>assets/images/${ev.cover_image}')`
                : 'background:linear-gradient(135deg,#062A45,#0B74B9)';

            const fieldsHtml = ev.form_fields.length
                ? ev.form_fields.map(f =>
                    `<span class="form-field-chip"><i class='bx bx-list-ul'></i>${f.pertanyaan} <span style="opacity:.5">(${f.tipe_input})</span></span>`
                ).join('')
                : '<span style="font-size:13px;color:var(--muted)">Tidak ada form pendaftaran</span>';

            const rejectArea = tab === 'pending' ? `
        <div class="reject-area" id="rejectAreaDrawer" style="display:none;">
            <label>Alasan Penolakan</label>
            <textarea id="alasanInput" placeholder="Tuliskan alasan penolakan…" rows="3"></textarea>
        </div>` : '';

            document.getElementById('drawerBody').innerHTML = `
        <div class="drawer-cover" style="${coverStyle};background-size:cover;background-position:center;"></div>
        <div class="drawer-content">
            <div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:12px;">
                <span class="badge ${bdg}">${ev.kategori}</span>
                <span class="badge ${ev.biaya == 0 ? 'green' : 'yellow'}">${rupiah(ev.biaya)}</span>
            </div>
            <h2>${ev.judul}</h2>
            <div class="eo-name"><i class='bx bxs-building-house'></i> ${eo}</div>

            <div class="drawer-section">
                <h4>Detail Event</h4>
                <div class="detail-row"><i class='bx bx-calendar'></i><strong>Tanggal</strong>${ev.waktu_pelaksanaan}</div>
                <div class="detail-row"><i class='bx bx-map'></i><strong>Lokasi</strong>${ev.lokasi}</div>
                <div class="detail-row"><i class='bx bx-group'></i><strong>Kuota</strong>${ev.terisi} / ${ev.kuota} terisi (${pct}%)</div>
                <div class="detail-row"><i class='bx bx-money'></i><strong>Biaya</strong>${rupiah(ev.biaya)}</div>
            </div>

            <div class="drawer-section">
                <h4>Deskripsi</h4>
                <p style="font-size:14px;line-height:1.8;color:#4B5563;">${ev.deskripsi}</p>
            </div>

            <div class="drawer-section">
                <h4>Form Pendaftaran</h4>
                <div>${fieldsHtml}</div>
            </div>

            ${rejectArea}
        </div>
    `;

            document.getElementById('drawerActions').style.display = tab === 'pending' ? 'flex' : 'none';

            document.getElementById('drawer').classList.add('open');
            document.getElementById('drawerOverlay').classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function openDrawerReject(id) {
            openDrawer(id);
            setTimeout(() => {
                const area = document.getElementById('rejectAreaDrawer');
                if (area) area.style.display = 'block';
            }, 100);
        }

        function closeDrawer() {
            document.getElementById('drawer').classList.remove('open');
            document.getElementById('drawerOverlay').classList.remove('open');
            document.body.style.overflow = '';
            currentId = null;
        }

        function submitAksi(aksi) {
            if (!currentId) return;
            document.getElementById('formAksiId').value = currentId;
            document.getElementById('formAksiType').value = aksi;
            document.getElementById('formAksiAlasan').value = '';
            if (confirm('Setujui dan publikasikan event ini?')) {
                document.getElementById('formAksi').submit();
            }
        }

        function submitReject() {
            if (!currentId) return;
            const area = document.getElementById('rejectAreaDrawer');
            if (area) area.style.display = 'block';

            const alasan = document.getElementById('alasanInput');
            const val = alasan ? alasan.value.trim() : '';
            if (!val) {
                alert('Mohon isi alasan penolakan terlebih dahulu.');
                if (alasan) alasan.focus();
                return;
            }
            document.getElementById('formAksiId').value = currentId;
            document.getElementById('formAksiType').value = 'tolak';
            document.getElementById('formAksiAlasan').value = val;
            if (confirm('Tolak event ini dengan alasan yang diberikan?')) {
                document.getElementById('formAksi').submit();
            }
        }
    </script>

</body>

</html>
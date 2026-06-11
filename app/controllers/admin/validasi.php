<?php
require_once '../../config/config.php';
require_once '../../../koneksi/koneksi.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: ' . BASEURL . '/app/controllers/auth/login.php');
    exit;
}

$tab_raw = $_GET['tab'] ?? 'Pending';
$allowed = ['Pending', 'Dipublikasikan', 'Ditolak'];
if (!in_array($tab_raw, $allowed)) $tab_raw = 'Pending';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

function count_ev($conn, $s)
{
    $s = $conn->real_escape_string($s);
    $r = $conn->query("SELECT COUNT(*) AS t FROM event WHERE status_publikasi = '$s'");
    return $r ? $r->fetch_assoc()['t'] : 0;
}
$c_pend = count_ev($conn, 'Pending');
$c_pub  = count_ev($conn, 'Dipublikasikan');
$c_tol  = count_ev($conn, 'Ditolak');

$tab_esc = $conn->real_escape_string($tab_raw);
$q = $conn->query("
    SELECT e.*, k.kategori,
           u.nama_lengkap, u.nama_organisasi,
           (SELECT COUNT(*) FROM pendaftaran p WHERE p.id_event = e.id_event) AS terisi
    FROM event e
    JOIN users u ON e.id_user = u.id
    JOIN kategori k ON e.id_kategori = k.id_kategori
    WHERE e.status_publikasi = '$tab_esc'
    ORDER BY e.created_at DESC
");

$cat_badge = ['Seminar' => 'blue', 'Webinar' => 'yellow', 'Volunteer' => 'green', 'Konser' => 'purple', 'Lomba' => 'red'];

function rupiah($n)
{
    return $n == 0 ? 'Gratis' : 'Rp ' . number_format($n, 0, ',', '.');
}
function rel_time($dt)
{
    $diff = time() - strtotime($dt);
    if ($diff < 60)    return 'Baru saja';
    if ($diff < 3600)  return floor($diff / 60) . ' menit lalu';
    if ($diff < 86400) return floor($diff / 3600) . ' jam lalu';
    return floor($diff / 86400) . ' hari lalu';
}


$q_all = $conn->query("
    SELECT e.*, k.kategori,
           u.nama_lengkap, u.nama_organisasi,
           (SELECT COUNT(*) FROM pendaftaran p WHERE p.id_event = e.id_event) AS terisi
    FROM event e
    JOIN users u ON e.id_user = u.id
    JOIN kategori k ON e.id_kategori = k.id_kategori
    WHERE e.status_publikasi = '$tab_esc'
");
$events_js = [];
if ($q_all) {
    while ($r = $q_all->fetch_assoc()) {
        $fq = $conn->query("SELECT pertanyaan, tipe_input FROM event_form WHERE id_event = " . (int)$r['id_event']);
        $fields = [];
        if ($fq) while ($f = $fq->fetch_assoc()) $fields[] = $f;
        $r['form_fields'] = $fields;
        $events_js[$r['id_event']] = $r;
    }
}


require_once '../../views/admin/validasi.php';
?>
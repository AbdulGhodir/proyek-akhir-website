<?php
require_once '../../config/config.php';
require_once '../../../koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASEURL . 'app/views/admin/validasi.php');
    exit;
}

$id = (int) ($_POST['id'] ?? 0);
$aksi = $_POST['aksi'] ?? '';          // 'setujui' | 'tolak'
$alasan = trim($_POST['alasan'] ?? '');
$redirect = $_POST['redirect'] ?? BASEURL . 'app/views/admin/validasi.php';

if ($id <= 0 || !in_array($aksi, ['setujui', 'tolak'])) {
    header('Location: ' . $redirect);
    exit;
}

if ($aksi === 'setujui') {
    $stmt = $conn->prepare("UPDATE event SET status_publikasi = 'dipublikasi' WHERE id_event = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
} else {
    $check = $conn->query("SHOW COLUMNS FROM event LIKE 'alasan_penolakan'");
    if ($check && $check->num_rows > 0) {
        $stmt = $conn->prepare("UPDATE event SET status_publikasi = 'ditolak', alasan_penolakan = ? WHERE id_event = ?");
        $stmt->bind_param('si', $alasan, $id);
    } else {
        $stmt = $conn->prepare("UPDATE event SET status_publikasi = 'ditolak' WHERE id_event = ?");
        $stmt->bind_param('i', $id);
    }
    $stmt->execute();
    $stmt->close();
}

header('Location: ' . $redirect);
exit;

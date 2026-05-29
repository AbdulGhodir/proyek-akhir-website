<?php
require_once '../../config/config.php';
require_once '../../../koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASEURL . '/app/views/admin/validasi.php');
    exit;
}

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: ' . BASEURL . '/app/views/auth/login.php');
    exit;
}

$id     = (int)($_POST['id'] ?? 0);
$aksi   = $_POST['aksi'] ?? '';          
$alasan = trim($_POST['alasan'] ?? '');
$redirect = $_POST['redirect'] ?? BASEURL . '/app/views/admin/validasi.php';

//if ($id <= 0 || !in_array($aksi, ['setujui', 'tolak', 'pending', 'suspend'])) {
//   header('Location: ' . $redirect);
//    exit;
//}

if ($aksi === 'setujui') {
    
    $stmt = $conn->prepare("UPDATE event SET status_publikasi = 'Dipublikasikan', alasan_penolakan = NULL WHERE id_event = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();

    $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Event berhasil disetujui dan dipublikasikan!'];

} elseif ($aksi === 'tolak') {
    
    $check = $conn->query("SHOW COLUMNS FROM event LIKE 'alasan_penolakan'");
    if ($check && $check->num_rows > 0) {
        $stmt = $conn->prepare("UPDATE event SET status_publikasi = 'Ditolak', alasan_penolakan = ? WHERE id_event = ?");
        $stmt->bind_param('si', $alasan, $id);
    } else {
        $stmt = $conn->prepare("UPDATE event SET status_publikasi = 'Ditolak' WHERE id_event = ?");
        $stmt->bind_param('i', $id);
    }
    $stmt->execute();
    $stmt->close();

    $_SESSION['flash'] = ['type' => 'error', 'msg' => 'Event telah ditolak' . ($alasan ? ': ' . $alasan : '.') ];

} elseif ($aksi === 'pending') {
    
    $stmt = $conn->prepare("UPDATE event SET status_publikasi = 'Pending', alasan_penolakan = NULL WHERE id_event = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();

    $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Event dikembalikan ke antrian Pending.'];

} elseif ($aksi === 'suspend') {
    $status = $_POST['status'] ?? 'aktif';
    $new_status = ($status === 'aktif') ? 'suspended' : 'aktif';

    $stmt = $conn->prepare("UPDATE users SET status = ? WHERE id = ? AND role != 'Admin'");
    $stmt->bind_param('si', $new_status, $id);
    $stmt->execute();
    $stmt->close();

    $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Status pengguna berhasil diperbarui menjadi ' . $new_status . '.'];
}

header('Location: ' . $redirect);
exit;

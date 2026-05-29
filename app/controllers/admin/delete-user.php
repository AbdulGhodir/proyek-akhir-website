<?php
require_once '../../config/config.php';
require_once '../../../koneksi/koneksi.php';


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASEURL . '/app/views/admin/manajemen-pengguna.php');
    exit;
}


if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: ' . BASEURL . '/app/views/auth/login.php');
    exit;
}

$id       = (int)($_POST['id'] ?? 0);
$redirect = $_POST['redirect'] ?? BASEURL . '/app/views/admin/manajemen-pengguna.php';

if ($id <= 0) {
    header('Location: ' . $redirect);
    exit;
}

$qn = $conn->prepare("SELECT nama_lengkap FROM users WHERE id = ? AND role != 'Admin'");
$qn->bind_param('i', $id);
$qn->execute();
$qr = $qn->get_result()->fetch_assoc();
$qn->close();

if (!$qr) {
    $_SESSION['flash'] = ['type' => 'error', 'msg' => 'Pengguna tidak ditemukan atau tidak dapat dihapus.'];
    header('Location: ' . $redirect);
    exit;
}

$stmt = $conn->prepare("DELETE FROM users WHERE id = ? AND role != 'Admin'");
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->close();

$_SESSION['flash'] = ['type' => 'success', 'msg' => 'Pengguna "' . htmlspecialchars($qr['nama_lengkap']) . '" berhasil dihapus.'];

header('Location: ' . $redirect);
exit;

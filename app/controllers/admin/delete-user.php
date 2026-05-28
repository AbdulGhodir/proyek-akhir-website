<?php
require_once '../../config/config.php';
require_once '../../../koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASEURL . 'app/views/admin/manajemen-pengguna.php');
    exit;
}

$id = (int) ($_POST['id'] ?? 0);
$redirect = $_POST['redirect'] ?? BASEURL . 'app/views/admin/manajemen-pengguna.php';

if ($id <= 0) {
    header('Location: ' . $redirect);
    exit;
}

$stmt = $conn->prepare("DELETE FROM users WHERE id = ? AND role != 'Admin'");
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->close();

header('Location: ' . $redirect);
exit;

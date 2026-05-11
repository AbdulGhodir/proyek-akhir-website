<?php
require_once '../../config/config.php';
require_once '../../../koneksi/koneksi.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASEURL . 'app/views/admin/manajemen-pengguna.php');
    exit;
}

$id = (int) ($_POST['id'] ?? 0);
$status = $_POST['status'] ?? 'aktif';
$redirect = $_POST['redirect'] ?? BASEURL . 'app/views/admin/manajemen-pengguna.php';

if ($id <= 0) {
    header('Location: ' . $redirect);
    exit;
}

$new_status = ($status === 'aktif') ? 'suspended' : 'aktif';

$stmt = $conn->prepare("UPDATE users SET status = ? WHERE id = ? AND role != 'Admin'");
$stmt->bind_param('si', $new_status, $id);
$stmt->execute();
$stmt->close();

header('Location: ' . $redirect);
exit;

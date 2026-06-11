<?php
require_once '../../config/config.php';
require_once '../../../koneksi/koneksi.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: ' . BASEURL . '/app/controllers/auth/login.php');
    exit;
}

$search = trim($_GET['q'] ?? '');
$filter = $_GET['filter'] ?? 'semua';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$where = "WHERE role != 'Admin'";
if ($filter === 'user') $where .= " AND role = 'User'";
if ($filter === 'eo')   $where .= " AND role = 'EO'";
if ($search !== '') {
    $s = $conn->real_escape_string($search);
    $where .= " AND (nama_lengkap LIKE '%$s%' OR email LIKE '%$s%' OR nama_organisasi LIKE '%$s%')";
}

$q_users = $conn->query("SELECT * FROM users $where ORDER BY id DESC");

$c_all  = $conn->query("SELECT COUNT(*) AS t FROM users WHERE role != 'Admin'")->fetch_assoc()['t'];
$c_user = $conn->query("SELECT COUNT(*) AS t FROM users WHERE role = 'User'")->fetch_assoc()['t'];
$c_eo   = $conn->query("SELECT COUNT(*) AS t FROM users WHERE role = 'EO'")->fetch_assoc()['t'];

require_once '../../views/admin/manajemen-pengguna.php';
?>
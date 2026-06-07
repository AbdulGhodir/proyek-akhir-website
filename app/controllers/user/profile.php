<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require '../../config/config.php';
require '../../../koneksi/koneksi.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'User') {
    header("Location: " . BASEURL . "/app/controllers/auth/login.php");
    exit();
}

$sukses_update = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['nama_lengkap'] = $_POST['nama'] ?? $_SESSION['nama_lengkap'];
    $_SESSION['instansi'] = $_POST['instansi'] ?? '';
    $_SESSION['gender'] = $_POST['gender'] ?? '';
    $_SESSION['interest'] = $_POST['interest'] ?? [];
    $_SESSION['linkedin'] = $_POST['linkedin'] ?? '';
    
    $sukses_update = true;
}

$nama = $_SESSION['nama_lengkap'] ?? 'User';
$inisial = strtoupper(substr($nama, 0, 1));
$instansi = $_SESSION['instansi'] ?? '';
$gender = $_SESSION['gender'] ?? '';
$interest = $_SESSION['interest'] ?? [];
$linkedin = $_SESSION['linkedin'] ?? '';

require_once '../../views/user/profile.php';
?>
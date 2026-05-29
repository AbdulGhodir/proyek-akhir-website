<?php
require_once '../../config/config.php';
require_once '../../../koneksi/koneksi.php';
require_once '../../models/PendaftaranModel.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'User') {
    header("Location: " . BASEURL . "/app/controllers/auth/login.php");
    exit();
}

$pageTitle = "Notifikasi Saya | Eventify";

$idUser = $_SESSION['id'];
$notifikasi = getNotifikasiUser($conn, $idUser, 50);

require_once '../../views/user/notifikasi.php';
?>
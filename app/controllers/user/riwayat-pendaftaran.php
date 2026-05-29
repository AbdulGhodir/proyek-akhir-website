<?php
require_once '../../config/config.php';
require_once '../../../koneksi/koneksi.php';
require_once '../../models/PendaftaranModel.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'User') {
    header("Location: " . BASEURL . "/app/controllers/auth/login.php");
    exit();
}

$pageTitle = "Riwayat Pendaftaran | Eventify";

$idUser = $_SESSION['id'];
$history = getRiwayatPendaftaranByUser($conn, $idUser);

require_once '../../views/user/riwayat-pendaftaran.php';
?>
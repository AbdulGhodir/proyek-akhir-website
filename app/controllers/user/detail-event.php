<?php
require_once '../../config/config.php';
require_once '../../../koneksi/koneksi.php';
require_once '../../models/EventModel.php';
require_once '../../models/PendaftaranModel.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'User') {
    header("Location: " . BASEURL . "/app/controllers/auth/login.php");
    exit();
}

$id = $_GET['id'] ?? 0;

$event = getEventById($conn, (int)$id);

if (!$event) {
    echo "Event tidak ditemukan.";
    exit;
}

$statusPendaftaran = cekStatusPendaftaran($conn, $_SESSION['id'], $event['id_event']);
$terdaftar = "";

if ($statusPendaftaran != NULL) {
    $terdaftar = $statusPendaftaran['status_pendaftaran'];
} else {
    $terdaftar = "belum terdaftar";
}

$pageTitle = $event['judul'] . " | Eventify";

require_once '../../views/user/detail-event.php';
?>
<?php
require_once '../../config/config.php';
require_once '../../../koneksi/koneksi.php';
require_once '../../models/EventModel.php';

$id = $_GET['id'] ?? 0;

$event = getEventById($conn, (int)$id);

if (!$event) {
    echo "Event tidak ditemukan.";
    exit;
}

$isPaid = $event['biaya'] > 0;
$pageTitle = "Pendaftaran Event | Eventify";

require_once '../../views/user/register-event.php';
?>
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

$pageTitle = $event['judul'] . " | Eventify";

require_once '../../views/user/detail-event.php';
?>
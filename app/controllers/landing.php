<?php
    require_once 'app/config/config.php';
    require_once 'koneksi/koneksi.php';
    require_once 'app/models/EventModel.php';

    $eventTerbaru = getEventTerbaru($conn);
?>
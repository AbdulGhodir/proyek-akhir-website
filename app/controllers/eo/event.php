<?php
    require_once '../../config/config.php';
    require_once '../../../koneksi/koneksi.php';
    require_once '../../models/EventModel.php';

    if (!isset($_SESSION['id']) || $_SESSION['role'] != 'EO') {
        header("Location: " . BASEURL . "/app/controllers/auth/login.php");
        exit();
    }

    if (isset($_POST['hapus_event'])) {
        $id = $_POST['id'];
        deleteDataEvent($conn, $id);
        header("Location: " . BASEURL . "/app/controllers/eo/event.php");
        exit();
    }

    $listEvent = getAllDataEventByEO($conn, $_SESSION['id']);

    require_once '../../views/eo/event.php';
?>
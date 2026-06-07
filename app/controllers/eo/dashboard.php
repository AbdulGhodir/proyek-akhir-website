<?php
    require_once '../../config/config.php';
    require_once '../../../koneksi/koneksi.php';
    require_once '../../models/EventModel.php';
    require_once '../../models/PendaftaranModel.php';

    if (!isset($_SESSION['id']) || $_SESSION['role'] != 'EO') {
        header("Location: " . BASEURL . "/app/controllers/auth/login.php");
        exit();
    }
    
    $totalEventAktif = getTotalEvent($conn, $_SESSION['id'], "Dipublikasikan");
    $totalEventPending = getTotalEvent($conn, $_SESSION['id'], "Pending");
    
    $totalPendaftar = getTotalPendaftar($conn, $_SESSION['id']);
    
    $listEvent = getAllDataEventByEO($conn, $_SESSION['id']);
    
    require_once '../../views/eo/dashboard.php';
?>
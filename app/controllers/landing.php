<?php
    require_once 'app/config/config.php';
    require_once 'koneksi/koneksi.php';
    require_once 'app/models/EventModel.php';

    if (isset($_SESSION['id'])) {
        if ($_SESSION['role'] == "Admin") {
            header("Location: " . BASEURL . "/app/controllers/admin/dashboard.php");
            exit();
        }
        
        if ($_SESSION['role'] == "EO") {
            header("Location: " . BASEURL . "/app/controllers/eo/dashboard.php");
            exit();
        }

        if ($_SESSION['role'] == "User") {
            header("Location: " .   BASEURL . "/app/controllers/user/dashboard.php");
            exit();
        }
    }

    $eventTerbaru = getEventTerbaru($conn);
?>
<?php
    require_once 'app/config/config.php';
    require_once 'koneksi/koneksi.php';
    require_once 'app/models/EventModel.php';

    if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
        switch ($_SESSION['role']) {
            case 'Admin':
                header('Location: ' . BASEURL . '/app/views/admin/dashboard.php');
                exit();
            case 'EO':
                header('Location: ' . BASEURL . '/app/controllers/eo/dashboard.php');
                exit();
            case 'User':
                header('Location: ' . BASEURL . '/app/controllers/user/dashboard.php');
                exit();
        }
    }

    $eventTerbaru = getEventTerbaru($conn);
?>
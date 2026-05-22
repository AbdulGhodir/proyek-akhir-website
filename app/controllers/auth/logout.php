<?php
    require_once '../../config/config.php';
    require_once '../../../koneksi/koneksi.php';

    session_unset();

    session_destroy();

    header("Location: " . BASEURL . "/app/controllers/auth/login.php");
    exit();
?>
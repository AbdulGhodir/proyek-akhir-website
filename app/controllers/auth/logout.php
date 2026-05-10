<?php
    require_once '../../config/config.php';
    require_once '../../../koneksi/koneksi.php';

    session_start();

    session_unset();

    session_destroy();

    header("Location: " . BASEURL . "/app/views/auth/login_register.php");
    exit();
?>
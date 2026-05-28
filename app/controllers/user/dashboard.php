<?php
require_once '../../config/config.php';
require_once '../../../koneksi/koneksi.php';
require_once '../../models/EventModel.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'User') {
    header("Location: " . BASEURL . "/app/controllers/auth/login.php");
    exit();
}

$pageTitle = "Jelajahi Event | Eventify";

$events = getAllEvent($conn);

require_once '../../views/user/dashboard.php';
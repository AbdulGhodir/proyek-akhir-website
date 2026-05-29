<?php
require_once '../../config/config.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: ' . BASEURL . '/app/views/auth/login.php');
    exit;
}

header('Location: ' . BASEURL . '/app/views/admin/dashboard.php');
exit;

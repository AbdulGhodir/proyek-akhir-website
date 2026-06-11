<?php
    require_once '../../config/config.php';
    require_once '../../../koneksi/koneksi.php';
    require_once '../../models/UserModel.php';

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

    if (isset($_POST['lupa_password'])) {
        $email = $_POST['email'];

        $user = getDataUserByEmail($conn, $email);

        if ($user != null) {
            header('Location: ' . BASEURL . '/app/controllers/auth/password_baru.php?email=' . $email);
            exit();
        } else {
            echo "<script>alert('Email tidak ditemukan!'); window.location.href='" . BASEURL . "/app/controllers/auth/lupa_password.php';</script>";
            exit();
        }
    }

    require_once '../../views/auth/lupa_password.php';
?>

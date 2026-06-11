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

    if (!isset($_GET['email'])) {
        header("Location: " . BASEURL . "/app/controllers/auth/lupa_password.php");
        exit();
    }

    if(isset($_POST['password_baru'])) {
        $email = $_GET['email'];
        $password = $_POST['password'];
        $konfirmasi_password = $_POST['konfirmasi_password'];

        $user = getDataUserByEmail($conn, $email);
        
        if ($password != $konfirmasi_password) {
            echo "<script>alert('Password tidak cocok!'); window.location.href='" . BASEURL . "/app/controllers/auth/password_baru.php?email=" . $email . "';</script>";
            exit();
        } else if (strlen($password) < 6) {
            echo "<script>alert('Password harus minimal 6 karakter!'); window.location.href='" . BASEURL . "/app/controllers/auth/password_baru.php?email=" . $email . "';</script>";
            exit();
        }

        $hash_password = password_hash($password, PASSWORD_BCRYPT);
        updatePasswordUser($conn, $email, $hash_password);

        echo "<script>alert('Password berhasil diubah!'); window.location.href='" . BASEURL . "/app/controllers/auth/login.php';</script>";
        exit();
    }

    require_once '../../views/auth/password_baru.php';
?>
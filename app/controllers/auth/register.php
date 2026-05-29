<?php
    require_once '../../config/config.php';
    require_once '../../../koneksi/koneksi.php';
    require_once '../../models/UserModel.php';

    if (isset($_SESSION['id'])) {
        if ($_SESSION['role'] == "Admin") {
            header("Location: " . BASEURL . "/app/views/admin/index.php");
            exit();
        }
        
        if ($_SESSION['role'] == "EO") {
            header("Location: " . BASEURL . "/app/controllers/eo/dashboard.php");
            exit();
        }

        if ($_SESSION['role'] == "User") {
            header("Location: " . BASEURL . "/app/controllers/user/dashboard.php");
            exit();
        }
    }

    if (isset($_POST['daftar'])) {
        $nama = trim($_POST['nama']);
        $namaOrganisasi = trim($_POST['nama_organisasi']) == '' ? NULL : trim($_POST['nama_organisasi']);
        $email = trim($_POST['email']);
        $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);
        $konfirmasiPassword = trim($_POST['konfirmasi_password']);
        $role = $_POST['role'];
        
        $cekUser = getDataUserByEmail($conn, $email);

        if ($cekUser) {
            echo "email_terdaftar";
            exit();
        } else {
            insertDataUser($conn, $nama, $namaOrganisasi, $email, $password, $role);
            echo "sukses";
            exit();
        }
    }

    $mode = "register";
    require_once '../../views/auth/login_register.php';
?> 
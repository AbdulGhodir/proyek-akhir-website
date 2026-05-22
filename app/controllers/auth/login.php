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
            header("Location: " .   BASEURL . "/app/controllers/user/dashboard.php");
            exit();
        }
    }
    
    if (isset($_POST['masuk'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = getDataUserByEmail($conn, $email);

        if ($user) {
            $id = $user['id'];
            $nama_lengkap = $user['nama_lengkap'];
            $nama_organisasi = $user['nama_organisasi'];
            $hashed_password = $user['password'];
            $role = $user['role'];
                        
            if (password_verify($password, $hashed_password)) {
                $_SESSION['id'] = $id;
                $_SESSION['nama_lengkap'] = $nama_lengkap;
                $_SESSION['role'] = $role;
                
                if ($role == "Admin") {
                    echo 'login_berhasil_admin';
                }

                if ($role == "EO") {
                    $_SESSION['nama_organisasi'] = $nama_organisasi;
                    echo 'login_berhasil_eo';
                }

                if ($role == "User") {
                    echo 'login_berhasil_user';
                }        
            } else {
                echo 'login_gagal';
            }
        } else {
            echo 'login_gagal';
        }

        exit();
    }

    $mode = "login";
    require_once '../../views/auth/login_register.php';
?>
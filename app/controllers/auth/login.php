<?php
    require_once '../../config/config.php';
    require_once '../../../koneksi/koneksi.php';
    
    session_start();
    
    if (isset($_POST['masuk'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT id, nama_lengkap, nama_organisasi, password, role FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $id = "";
            $nama_lengkap = "";
            $nama_organisasi = "";
            $hashed_password = "";
            $role = "";
            
            $stmt->bind_result($id, $nama_lengkap, $nama_organisasi, $hashed_password, $role);
            $stmt->fetch();

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

                $stmt->close();
                exit();
                
            } else {
                echo 'login_gagal';
                $stmt->close();
                exit();
            }
        } else {
            echo 'login_gagal';
            $stmt->close();
            exit();
        }
    }
?>
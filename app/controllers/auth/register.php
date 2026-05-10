<?php
    require_once '../../config/config.php';
    require_once '../../../koneksi/koneksi.php';

    if (isset($_POST['daftar'])) {
        $nama = trim($_POST['nama']);
        $namaOrganisasi = trim($_POST['nama_organisasi']);
        $email = trim($_POST['email']);
        $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);
        $konfirmasiPassword = trim($_POST['konfirmasi_password']);
        $role = $_POST['role'];
        
        $stmt_check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            echo "email_terdaftar";
            $stmt_check->close();
            exit();
        } else {
            if ($role == "user") {
                $stmt = $conn->prepare("INSERT INTO users (nama_lengkap, email, password, role) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $nama, $email, $password, $role);
            } else {
                $stmt = $conn->prepare("INSERT INTO users (nama_lengkap, nama_organisasi, email, password, role) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $nama, $namaOrganisasi, $email, $password, $role);
            }

            $stmt->execute();
            echo "sukses";
            
            $stmt_check->close();
            $stmt->close();
            exit();
        }
    }
?> 
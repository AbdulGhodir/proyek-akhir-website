<?php
    function getAllDataUsers(mysqli $conn) {
        $query = $conn->prepare("SELECT * FROM users");
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        
        return $data;
    }

    function getDataUserByEmail(mysqli $conn, string $email) {
        $query = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $query->bind_param("s", $email);
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_assoc();
        
        return $data;
    }

    function insertDataUser(mysqli $conn, string $nama_lengkap, string|null $nama_organisasi, string $email, string $hashed_password, string $role) {
        $query = $conn->prepare("INSERT INTO users (nama_lengkap, nama_organisasi, email, password, role) VALUES (?, ?, ?, ?, ?)");
        $query->bind_param("sssss", $nama_lengkap, $nama_organisasi, $email, $hashed_password, $role);
        $query->execute();
    }

    function updatePasswordUser(mysqli $conn, string $email, string $hashed_password) {
        $query = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        $query->bind_param("ss", $hashed_password, $email);
        $query->execute();
    }
?>
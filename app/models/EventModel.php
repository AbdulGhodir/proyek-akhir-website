<?php
    function getTotalEvent($conn, $idUser, $status = '%') {
        $query = $conn->prepare("
            SELECT COUNT(id_event) AS total_event
            FROM `event`
            WHERE id_user = ? AND status_publikasi LIKE ?
        ");
        $query->bind_param("is", $idUser, $status);
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_assoc();
        
        return $data['total_event'];
    }

    function getAllDataEvent($conn, $idUser) {
        $query = $conn->prepare("
            SELECT event.*, users.nama_lengkap, kategori.kategori
            FROM `event`
            JOIN users ON event.id_user = users.id
            JOIN kategori ON event.id_kategori = kategori.id_kategori
            WHERE id_user = ?
        ");
        $query->bind_param("i", $idUser);
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        
        return $data;
    }
?>
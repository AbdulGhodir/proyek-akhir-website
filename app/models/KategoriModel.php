<?php
    function getAllKategori(mysqli $conn) {
        $query = $conn->prepare("
            SELECT kategori.*, COUNT(event.id_event) AS jumlah_event
            FROM `kategori`
            LEFT JOIN `event` ON event.id_kategori = kategori.id_kategori
            GROUP BY kategori.id_kategori
            ORDER BY kategori.id_kategori ASC
        ");
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        
        return $data;
    }

    function getKategoriById(mysqli $conn, int $id) {
        $query = $conn->prepare("
            SELECT * FROM `kategori` WHERE id_kategori = ?
        ");
        $query->bind_param("i", $id);
        $query->execute();
        $result = $query->get_result();
        return $result->fetch_assoc();
    }

    function getEventByKategori(mysqli $conn, int $idKategori) {
        $query = $conn->prepare("
            SELECT event.*, users.nama_lengkap, users.nama_organisasi
            FROM `event`
            JOIN users ON event.id_user = users.id
            WHERE event.id_kategori = ?
            ORDER BY event.created_at DESC
        ");
        $query->bind_param("i", $idKategori);
        $query->execute();
        $result = $query->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function insertKategori(mysqli $conn, string $namaKategori) {
        $query = $conn->prepare("
            INSERT INTO `kategori`(`kategori`) VALUES (?)
        ");
        $query->bind_param("s", $namaKategori);
        $query->execute();
        return $conn->insert_id;
    }

    function deleteKategori(mysqli $conn, int $id) {
        $query = $conn->prepare("
            DELETE FROM `kategori` WHERE id_kategori = ?
        ");
        $query->bind_param("i", $id);
        $query->execute();
        return $query->affected_rows;
    }

    function kategoriNameExists(mysqli $conn, string $namaKategori) {
        $query = $conn->prepare("
            SELECT COUNT(*) AS total FROM `kategori` WHERE LOWER(kategori) = LOWER(?)
        ");
        $query->bind_param("s", $namaKategori);
        $query->execute();
        $result = $query->get_result()->fetch_assoc();
        return $result['total'] > 0;
    }
?>
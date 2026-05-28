<?php
    function getAllPendaftaranByEO(mysqli $conn, int $id_eo) {
        $query = $conn->prepare("
            SELECT
                pendaftaran.*,
                event.judul AS nama_event,
                users.nama_lengkap AS nama_lengkap,
                users.email AS email
            FROM
                pendaftaran
            JOIN
                event ON pendaftaran.id_event = event.id_event
            JOIN
                users ON pendaftaran.id_user = users.id
            WHERE
                event.id_user = ?
            ORDER BY
                pendaftaran.tanggal_daftar DESC;
        ");
        $query->bind_param("i", $id_eo);
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        
        return $data;
    }

    function getAllPendaftaranByEvent(mysqli $conn, int $idEvent) {
        $query = $conn->prepare("
            SELECT
                pendaftaran.*,
                event.judul AS nama_event,
                users.nama_lengkap AS nama_lengkap,
                users.email AS email
            FROM
                pendaftaran
            JOIN
                event ON pendaftaran.id_event = event.id_event
            JOIN
                users ON pendaftaran.id_user = users.id
            WHERE
                pendaftaran.id_event = ?
            ORDER BY
                pendaftaran.tanggal_daftar DESC;
        ");
        $query->bind_param("i", $idEvent);
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        
        return $data;
    }

    function updateStatusPendaftaran(mysqli $conn, int $idPendaftaran, string $status) {
        $query = $conn->prepare("
            UPDATE `pendaftaran`
            SET `status_pendaftaran` = ?
            WHERE id_pendaftaran = ?
        ");
        $query->bind_param("si", $status, $idPendaftaran);
        $query->execute();
    }

    function insertDataPendaftar(mysqli $conn, int $idUser, int $idEvent, string $status) {
        $query = $conn->prepare("
            INSERT INTO pendaftaran (id_user, id_event, status_pendaftaran)
            VALUES (?, ?, ?)
        ");
        $query->bind_param("iis", $idUser, $idEvent, $status);
        $query->execute();
    }

    function cekStatusPendaftaran(mysqli $conn, int $idUser, int $idEvent) {
        $query = $conn->prepare("
            SELECT
                status_pendaftaran
            FROM
                pendaftaran
            WHERE
                id_user = ? AND id_event = ?
        ");
        $query->bind_param("ii", $idUser, $idEvent);
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_assoc();
        
        return $data;
    }
?>
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

?>
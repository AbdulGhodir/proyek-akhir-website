<?php
    function getAllEvent(mysqli $conn) {
        $query = $conn->prepare("
            SELECT event.*, users.nama_lengkap, kategori.kategori
            FROM `event`
            JOIN users ON event.id_user = users.id
            JOIN kategori ON event.id_kategori = kategori.id_kategori
            ORDER BY event.waktu_pelaksanaan ASC
        ");
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        
        return $data;
    }

    function getAllEventPublis(mysqli $conn) {
        $query = $conn->prepare("
            SELECT event.*, users.nama_lengkap, kategori.kategori
            FROM `event`
            JOIN users ON event.id_user = users.id
            JOIN kategori ON event.id_kategori = kategori.id_kategori
            WHERE event.status_publikasi = 'Dipublikasikan'
            ORDER BY event.waktu_pelaksanaan ASC
        ");
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        
        return $data;
    }

    function getDataEventByID(mysqli $conn, int $idEvent) {
        $query = $conn->prepare("
            SELECT *
            FROM `event`
            WHERE id_event = ?
        ");
        $query->bind_param("i", $idEvent);
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_assoc();
        
        return $data;
    }

    function getTotalEvent(mysqli $conn, int $idUser, string $status = '%') {
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

    function getAllDataEventByEO(mysqli $conn, int $idUser) {
        $query = $conn->prepare("
            SELECT event.*, users.nama_lengkap, kategori.kategori
            FROM `event`
            JOIN users ON event.id_user = users.id
            JOIN kategori ON event.id_kategori = kategori.id_kategori
            WHERE event.id_user = ?
        ");
        $query->bind_param("i", $idUser);
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        
        return $data;
    }

    function getAllDataEventDipublikasikanByEO(mysqli $conn, int $idUser) {
        $query = $conn->prepare("
            SELECT event.*, users.nama_lengkap, kategori.kategori
            FROM `event`
            JOIN users ON event.id_user = users.id
            JOIN kategori ON event.id_kategori = kategori.id_kategori
            WHERE event.id_user = ? AND event.status_publikasi = 'Dipublikasikan'
        ");
        $query->bind_param("i", $idUser);
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        
        return $data;
    }

    function insertDataEvent(mysqli $conn, int $eventOrganizerID, int $kategori, string $namaEvent, string $tanggal, int $biaya, string $lokasi, int $kuota, string $deskripsi, string $benefit=NULL, string $gambar, string $status) {
        $query = $conn->prepare("
            INSERT INTO `event`(`id_user`, `id_kategori`, `judul`, `waktu_pelaksanaan`, `biaya`, `lokasi`, `kuota`, `deskripsi`, `benefit`, `cover_image`, `status_publikasi`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $query->bind_param("iissisissss", $eventOrganizerID, $kategori, $namaEvent, $tanggal, $biaya, $lokasi, $kuota, $deskripsi, $benefit, $gambar, $status);
        $query->execute();
    }



    function deleteDataEvent(mysqli $conn, int $id) {
        $query = $conn->prepare("
            DELETE FROM `event`
            WHERE id_event = ?
        ");
        $query->bind_param("i", $id);
        $query->execute();
    }


    function updateDataEvantByID(mysqli $conn, int $idEvent, int $kategori, string $namaEvent, string $tanggal, int $biaya, string $lokasi, int $kuota, string $deskripsi, string $benefit=NULL, string $gambar) {
        $query = $conn->prepare("
            UPDATE `event`
            SET `id_kategori`= ?,`judul`= ?,`waktu_pelaksanaan`= ?,`biaya`= ?,`lokasi`= ?,`kuota`= ?,`deskripsi`= ?,`benefit`= ?,`cover_image`= ?
            WHERE id_event = ?
        ");
        $query->bind_param("issisisssi", $kategori, $namaEvent, $tanggal, $biaya, $lokasi, $kuota, $deskripsi, $benefit, $gambar, $idEvent);
        $query->execute();
    }

    function getEventById(mysqli $conn, int $idEvent) {
        $query = $conn->prepare("
            SELECT event.*, users.nama_lengkap, kategori.kategori
            FROM `event`
            JOIN users ON event.id_user = users.id
            JOIN kategori ON event.id_kategori = kategori.id_kategori
            WHERE event.id_event = ?
        ");

        $query->bind_param("i", $idEvent);
        $query->execute();

        $result = $query->get_result();
        return $result->fetch_assoc();
    }

    function getEventTerbaru(mysqli $conn) {
        $query = $conn->prepare("
            SELECT event.*, users.nama_lengkap, kategori.kategori
            FROM `event`
            JOIN users ON event.id_user = users.id
            JOIN kategori ON event.id_kategori = kategori.id_kategori
            WHERE event.status_publikasi = 'Dipublikasikan'
            ORDER BY event.created_at DESC
            LIMIT 3
        ");
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        
        return $data;
    }

    function getFeaturedEvent(mysqli $conn) {
        $query = $conn->prepare("
            SELECT event.*, users.nama_lengkap, kategori.kategori
            FROM `event`
            JOIN users ON event.id_user = users.id
            JOIN kategori ON event.id_kategori = kategori.id_kategori
            WHERE event.status_publikasi = 'Dipublikasikan'
            AND event.waktu_pelaksanaan >= NOW()
            ORDER BY event.waktu_pelaksanaan ASC
            LIMIT 1
        ");

        $query->execute();
        $result = $query->get_result();

        return $result->fetch_assoc();
    }
?>
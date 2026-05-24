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
            WHERE id_user = ?
        ");
        $query->bind_param("i", $idUser);
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        
        return $data;
    }

    function insertDataEvent(mysqli $conn, int $eventOrganizerID, int $kategori, string $namaEvent, string $tanggal, int $biaya, string $lokasi, int $kuota, string $deskripsi, string $benefit=NULL, string $gambar=NULL, string $status) {
        $query = $conn->prepare("
            INSERT INTO `event`(`id_user`, `id_kategori`, `judul`, `waktu_pelaksanaan`, `biaya`, `lokasi`, `kuota`, `deskripsi`, `benefit`, `cover_image`, `status_publikasi`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $query->bind_param("iissisissss", $eventOrganizerID, $kategori, $namaEvent, $tanggal, $biaya, $lokasi, $kuota, $deskripsi, $benefit, $gambar, $status);
        $query->execute();
    }

    function insertDataForm(mysqli $conn, int $idEvent, string $pertanyaan, string $tipePertanyaan, string|null $opsiDropdown, string $statusPertanyaan) {
        $query = $conn->prepare("
            INSERT INTO `event_form`(`id_event`, `pertanyaan`, `tipe_input`, `opsi_pilihan`, `wajib_diisi`)
            VALUES (?, ?, ?, ?, ?)
        ");
        $query->bind_param("isssi", $idEvent, $pertanyaan, $tipePertanyaan, $opsiDropdown, $statusPertanyaan);
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
?>
<?php
    function getAllJawabanByPendaftaran(mysqli $conn, int $id_pendaftaran) {
        $query = $conn->prepare("
            SELECT jawaban_pendaftar.*, event_form.tipe_input, event_form.pertanyaan
            FROM jawaban_pendaftar
            JOIN pendaftaran ON jawaban_pendaftar.id_pendaftaran = pendaftaran.id_pendaftaran
            JOIN event_form ON jawaban_pendaftar.id_form = event_form.id_form 
            WHERE pendaftaran.id_pendaftaran = ?;
        ");
        $query->bind_param("i", $id_pendaftaran);
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        
        return $data;
    }

    function insertJawabanPendaftar(mysqli $conn, int $id_pendaftaran, int $id_form, string $jawaban) {
        $query = $conn->prepare("
            INSERT INTO jawaban_pendaftar (id_pendaftaran, id_form, jawaban)
            VALUES (?, ?, ?);
        ");
        $query->bind_param("iis", $id_pendaftaran, $id_form, $jawaban);
        $query->execute();
    }
?>
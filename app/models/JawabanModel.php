<?php
    function getAllJawabanByPendaftaran(mysqli $conn, int $id_pendaftaran) {
        $query = $conn->prepare("
            SELECT jawaban_pendaftar.*, event_form.pertanyaan
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
?>
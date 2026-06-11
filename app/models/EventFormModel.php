<?php
    function getDataFormByEvent(mysqli $conn, int $idEvent) {
        $query = $conn->prepare("
            SELECT *
            FROM `event_form`
            WHERE id_event = ?
        ");
        $query->bind_param("i", $idEvent);
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        
        return $data;
    }

    function insertDataForm(mysqli $conn, int $idEvent, string $pertanyaan, string $tipePertanyaan, string|null $opsiDropdown, string $statusPertanyaan) {
        $query = $conn->prepare("
            INSERT INTO `event_form`(`id_event`, `pertanyaan`, `tipe_input`, `opsi_pilihan`, `wajib_diisi`)
            VALUES (?, ?, ?, ?, ?)
        ");
        $query->bind_param("isssi", $idEvent, $pertanyaan, $tipePertanyaan, $opsiDropdown, $statusPertanyaan);
        $query->execute();
    }

    function deleteDataForm(mysqli $conn, int $idEvent) {
        $query = $conn->prepare("
            DELETE FROM `event_form`
            WHERE id_event = ?
        ");
        $query->bind_param("i", $idEvent);
        $query->execute();
    }
?>
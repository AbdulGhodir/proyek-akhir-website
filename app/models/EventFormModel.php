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
?>
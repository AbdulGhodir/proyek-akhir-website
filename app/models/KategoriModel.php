<?php
    function getAllKategori(mysqli $conn) {
        $query = $conn->prepare("
            SELECT *
            FROM `kategori`
        ");
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        
        return $data;
    }
?>
<?php
    require_once '../../config/config.php';
    require_once '../../../koneksi/koneksi.php';
    require_once '../../models/PendaftaranModel.php';
    require_once '../../models/JawabanModel.php';

    if (!isset($_SESSION['id']) || $_SESSION['role'] != 'EO') {
        header("Location: " . BASEURL . "/app/controllers/auth/login.php");
        exit();
    }

    if (isset($_POST['lihat_jawaban'])) {
        $idPendaftaran = $_POST['id_pendaftaran'];
        
        $listJawaban = getAllJawabanByPendaftaran($conn, $idPendaftaran);

        echo json_encode($listJawaban);
        exit();
    }

    $listPendaftaran = getAllPendaftaranByEO($conn, $_SESSION['id']);

    require_once '../../views/eo/verifikasi.php';  
?>
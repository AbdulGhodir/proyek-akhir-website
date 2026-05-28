<?php
    require_once '../../config/config.php';
    require_once '../../../koneksi/koneksi.php';
    require_once '../../models/PendaftaranModel.php';
    require_once '../../models/JawabanModel.php';
    require_once '../../models/EventModel.php';

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

    if (isset($_POST['tolak'])) {
        $idPendaftaran = $_POST['id_pendaftaran'];
        updateStatusPendaftaran($conn, $idPendaftaran, 'ditolak');
        
        $URL = BASEURL . "/app/controllers/eo/verifikasi.php";
        if (isset($_GET['id_event']) && $_GET['id_event']) {
            $URL .= "?id_event=" . $_GET['id_event'];
        }
        header("Location: " . $URL);
        exit();
    }

    if (isset($_POST['terima'])) {
        $idPendaftaran = $_POST['id_pendaftaran'];
        updateStatusPendaftaran($conn, $idPendaftaran, 'diterima');
        
        $URL = BASEURL . "/app/controllers/eo/verifikasi.php";
        if (isset($_GET['id_event']) && $_GET['id_event']) {
            $URL .= "?id_event=" . $_GET['id_event'];
        }
        header("Location: " . $URL);
        exit();
    }
    
    $listPendaftaran = getAllPendaftaranByEO($conn, $_SESSION['id']);
    
    if (isset($_GET['id_event'])) {
        $idEvent = $_GET['id_event'];

        if ($idEvent) {
            $listPendaftaran = getAllPendaftaranByEvent($conn, $idEvent);
        } else {
            $listPendaftaran = getAllPendaftaranByEO($conn, $_SESSION['id']);
        }
        
    }

    $listEvent = getAllDataEventDipublikasikanByEO($conn, $_SESSION['id']);

    require_once '../../views/eo/verifikasi.php';  
?>
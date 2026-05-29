<?php
require_once '../../config/config.php';
require_once '../../../koneksi/koneksi.php';
require_once '../../models/EventModel.php';
require_once '../../models/EventFormModel.php';
require_once '../../models/PendaftaranModel.php';
require_once '../../models/JawabanModel.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'User') {
    header("Location: " . BASEURL . "/app/controllers/auth/login.php");
    exit();
}

$id = $_GET['id'] ?? 0;

$event = getEventById($conn, (int)$id);

if (!$event) {
    echo "Event tidak ditemukan.";
    exit;
}

if (isset($_POST['daftar_event'])) {
    $idUser = $_SESSION['id'];
    $status = "menunggu";

    $idFormDijawab = $_POST['id_form'];
    $jawaban = $_POST['jawaban'];

    insertDataPendaftar($conn, $idUser, $event['id_event'], $status);
    $idPendaftaran = $conn->insert_id;

    for ($i=0; $i < count($idFormDijawab); $i++) {
        insertJawabanPendaftar($conn, $idPendaftaran, $idFormDijawab[$i], $jawaban[$i]);
    }

    header("Location: " . BASEURL . "/app/controllers/user/detail-event.php?id=" . $event['id_event']);
    exit();
}

$pageTitle = "Pendaftaran Event | Eventify";
$formEvent = getDataFormByEvent($conn, $event['id_event']);

$idForm = [];
$listPertanyaan = [];
$tipePertanyaan = [];
$opsiDropdown = [];
$wajibDiisi = [];

foreach ($formEvent as $row) {
    $idForm[] = $row['id_form'];
    $listPertanyaan[] = $row['pertanyaan'];
    $tipePertanyaan[] = $row['tipe_input'];

    if ($row['tipe_input'] == 'dropdown') {
        $opsiDropdown[] = explode(',', $row['opsi_pilihan']);
    } else {
        $opsiDropdown[] = $row['opsi_pilihan'];
    }
    $wajibDiisi[] = $row['wajib_diisi'];
}

require_once '../../views/user/register-event.php';
?>
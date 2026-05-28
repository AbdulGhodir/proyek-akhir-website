<?php
require_once '../../config/config.php';
require_once '../../../koneksi/koneksi.php';
require_once '../../models/EventModel.php';
require_once '../../models/EventFormModel.php';

if (isset($_POST['daftar_event'])) {
    $idFormDijawab = $_POST['id_form'];
    $jawaban = $_POST['jawaban'];

    for ($i=0; $i < count($idFormDijawab); $i++) {
        echo "ID Form: " . $idFormDijawab[$i] . "<br>";
        echo "Jawaban: " . $jawaban[$i] . "<br>";
    }
}

$id = $_GET['id'] ?? 0;

$event = getEventById($conn, (int)$id);

if (!$event) {
    echo "Event tidak ditemukan.";
    exit;
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
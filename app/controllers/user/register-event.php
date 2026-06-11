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

    insertDataPendaftar($conn, $idUser, $event['id_event'], $status);
    $idPendaftaran = $conn->insert_id;

    for ($i=0; $i < count($idFormDijawab); $i++) {
        $jawaban_user = "";

        if (isset($_POST['jawaban'][$i])) {
            $jawaban_user = $_POST['jawaban'][$i];
        } else if (isset($_FILES['jawaban']['name'][$i])) {
            $nama_img = $_FILES['jawaban']['name'][$i];
            $ukuran_img = $_FILES['jawaban']['size'][$i];
            $tmp_img = $_FILES['jawaban']['tmp_name'][$i];
            $error_img = $_FILES['jawaban']['error'][$i];

            if ($error_img === 0) {
                $ekstensi_file = pathinfo($nama_img, PATHINFO_EXTENSION);
                $nama_file_baru = uniqid() . '_' . time() . '.' . $ekstensi_file;

                $folder_tujuan = '../../../assets/images/uploads/' . $nama_file_baru;

                if (move_uploaded_file($tmp_img, $folder_tujuan)) {
                    $jawaban_user = $nama_file_baru;
                }
            }
        }

        insertJawabanPendaftar($conn, $idPendaftaran, $idFormDijawab[$i], $jawaban_user);
    }

    echo "<script>alert('Pendaftaran event berhasil!')</script>";
    echo "<script>window.location.href = '" . BASEURL . "/app/controllers/user/detail-event.php?id=". $event['id_event'] . "';</script>";
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
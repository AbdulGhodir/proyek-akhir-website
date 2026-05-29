<?php
require_once '../../config/config.php';
require_once '../../../koneksi/koneksi.php';
require_once '../../models/PendaftaranModel.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'User') {
    header("Location: " . BASEURL . "/app/controllers/auth/login.php");
    exit();
}

$idPendaftaran = $_GET['id'] ?? 0;
$idUser = $_SESSION['id'];

$dataTiket = getTiketByPendaftaranId($conn, (int)$idPendaftaran, (int)$idUser);

if (!$dataTiket) {
    echo "Tiket tidak ditemukan atau pendaftaran belum diterima.";
    exit();
}

$tiket = [
    'nama' => $dataTiket['nama_lengkap'],
    'acara' => $dataTiket['judul'],
    'tanggal' => formatTanggalIndo($dataTiket['waktu_pelaksanaan']),
    'lokasi' => $dataTiket['lokasi'],
    'kode' => 'EVT-' . str_pad($dataTiket['id_pendaftaran'], 4, '0', STR_PAD_LEFT)
];

$pageTitle = "Tiket Event | Eventify";

require_once '../../views/user/tiket_detail.php';
?>
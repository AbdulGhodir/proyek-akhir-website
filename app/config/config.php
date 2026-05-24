<?php
    // define('BASEURL', 'http://proyek-akhir-website.test');
    define('BASEURL', 'http://localhost/proyek-akhir-website');

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    function formatTanggalIndo(string $datetime) {
        $bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

        $timestamp = strtotime($datetime);

        $hari = date('d', $timestamp);
        $bulan_angka = (int)date('m', $timestamp);
        $tahun = date('Y', $timestamp);
        $jam_menit = date('H:i', $timestamp);

        return $hari . ' ' . $bulan[$bulan_angka] . ' ' . $tahun . ' pukul ' . $jam_menit;
    }

    function formatRupiah($angka) {
    if ($angka == 0) {
        return "Gratis";
    }
    
    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
?>
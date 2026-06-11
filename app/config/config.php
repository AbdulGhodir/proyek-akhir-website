<?php
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

        return $hari . ' ' . $bulan[$bulan_angka] . ' ' . $tahun;
    }

    function formatRupiah($angka) {
        if ($angka == 0) {
            return "Gratis";
        }
        
        $hasil_rupiah = "Rp" . number_format($angka, 0, ',', '.') . ",-";
        return $hasil_rupiah;
    }

    function formatWaktuRelatif(string $datetime) {
        $timestamp = strtotime($datetime);
        $selisih = time() - $timestamp;

        if ($selisih < 60) {
            return "Baru saja";
        } elseif ($selisih < 3600) {
            return floor($selisih / 60) . " menit yang lalu";
        } elseif ($selisih < 86400) {
            return floor($selisih / 3600) . " jam yang lalu";
        } elseif ($selisih < 172800) {
            return "Kemarin";
        } else {
            return formatTanggalIndo($datetime);
        }
    }
?>
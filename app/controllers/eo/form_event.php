<?php
    require_once '../../config/config.php';
    require_once '../../../koneksi/koneksi.php';
    require_once '../../models/EventModel.php';
    require_once '../../models/KategoriModel.php';
    require_once '../../models/EventFormModel.php';
    
    if (!isset($_SESSION['id']) || $_SESSION['role'] != 'EO') {
        header("Location: " . BASEURL . "/app/controllers/auth/login.php");
        exit();
    }

    $isEdit = false;
    $namaEvent = "";
    $deskripsiEvent = "";
    $kategoriEvent = "";
    $tanggalEvent = "";
    $biayaEvent = "";
    $lokasiEvent = "";
    $kuotaEvent = "";
    $benefitEvent = "";
    $statusEvent = "";

    $listPertanyaan = [];
    $tipePertanyaan = [];
    $opsiDropdown = [];
    $wajibDiisi = [];
    
    if (isset($_GET['id_event'])) {
        $isEdit = true;

        $dataEvent = getDataEventByID($conn, $_GET['id_event']);   

        $namaEvent = $dataEvent['judul'];
        $deskripsiEvent = $dataEvent['deskripsi'];
        $kategoriEvent = $dataEvent['id_kategori'];
        $tanggalEvent = $dataEvent['waktu_pelaksanaan'];
        $biayaEvent = $dataEvent['biaya'];
        $lokasiEvent = $dataEvent['lokasi'];
        $kuotaEvent = $dataEvent['kuota'];
        $benefitEvent = $dataEvent['benefit'];
        $statusEvent = $dataEvent['status_publikasi'];

        $dataPertanyaan = getDataFormByEvent($conn, $_GET['id_event']);

        foreach ($dataPertanyaan as $row) {
            $listPertanyaan[] = $row['pertanyaan'];
            $tipePertanyaan[] = $row['tipe_input'];

            if ($row['tipe_input'] == 'dropdown') {
                $opsiDropdown[] = explode(',', $row['opsi_pilihan']);
            } else {
                $opsiDropdown[] = $row['opsi_pilihan'];
            }
            $wajibDiisi[] = $row['wajib_diisi'];
        }
    }
    
    if (isset($_POST['tambah_event_baru'])) {
        $eventOrganizerID = $_SESSION['id'];
        $nama_event = $_POST['nama_event'];
        $deskripsi = $_POST['deskripsi'];
        $kategori = $_POST['kategori'];
        $tanggal = str_replace('T', ' ', $_POST['tanggal']);
        $biaya = $_POST['biaya'];
        $lokasi = $_POST['lokasi'];
        $kuota = $_POST['kuota'];
        $benefit = $_POST['benefit'] == NULL ? NULL : $_POST['benefit'];
        $status = 'pending';

        $nama_img = $_FILES['cover_img']['name'];
        $ukuran_img = $_FILES['cover_img']['size'];
        $tmp_img = $_FILES['cover_img']['tmp_name'];
        $error_img = $_FILES['cover_img']['error'];

        if ($error_img === 0) {
            $ekstensi_file = pathinfo($nama_img, PATHINFO_EXTENSION);
            $nama_file_baru = uniqid() . '_' . time() . '.' . $ekstensi_file;

            $folder_tujuan = '../../../assets/images/uploads/' . $nama_file_baru;

            if (move_uploaded_file($tmp_img, $folder_tujuan)) {
                insertDataEvent($conn, $eventOrganizerID, $kategori, $nama_event, $tanggal, $biaya, $lokasi, $kuota, $deskripsi, $benefit, $nama_file_baru, $status);
            } else {
                echo "<script>alert('Maaf, terjadi kesalahan saat mengunggah file Anda.')</script>";
            }
        }

        $idEvent = $conn->insert_id;        

        $listPertanyaan = [];
        $tipePertanyaan = [];
        $opsiDropdown = [[]];
        
        $listPertanyaan = $_POST['pertanyaan'];
        $tipePertanyaan = $_POST['tipe_pertanyaan'];
        $opsiDropdown = $_POST['opsi'];

        for ($i = 0; $i < count($listPertanyaan); $i++) {
            $statusPertanyaan = isset($_POST['wajib'][$i]) ? 1 : 0;
            $dropdownValue = NULL;
            if ($tipePertanyaan[$i] == 'dropdown') {
                $dropdownValue = implode(",", $opsiDropdown[$i]);                
            }

            insertDataForm($conn, $idEvent, $listPertanyaan[$i], $tipePertanyaan[$i], $dropdownValue, $statusPertanyaan);
        }

        echo "<script>alert('Event berhasil ditambahkan!'); window.location.href = '" . BASEURL . "/app/controllers/eo/event.php';</script>";
        exit();
    }

    if (isset($_POST['edit_event'])) {
        $idEvent = $_GET['id_event'];
        $nama_event = $_POST['nama_event'];
        $deskripsi = $_POST['deskripsi'];
        $kategori = $_POST['kategori'];
        $tanggal = str_replace('T', ' ', $_POST['tanggal']);
        $biaya = $_POST['biaya'];
        $lokasi = $_POST['lokasi'];
        $kuota = $_POST['kuota'];
        $benefit = $_POST['benefit'] == NULL ? NULL : $_POST['benefit'];

        $nama_img = $_FILES['cover_img']['name'];
        $ukuran_img = $_FILES['cover_img']['size'];
        $tmp_img = $_FILES['cover_img']['tmp_name'];
        $error_img = $_FILES['cover_img']['error'];

        if ($error_img === 0) {
            $ekstensi_file = pathinfo($nama_img, PATHINFO_EXTENSION);
            $nama_file_baru = uniqid() . '_' . time() . '.' . $ekstensi_file;

            $folder_tujuan = '../../../assets/images/uploads/' . $nama_file_baru;

            if (move_uploaded_file($tmp_img, $folder_tujuan)) {
                updateDataEvantByID($conn, $idEvent, $kategori, $nama_event, $tanggal, $biaya, $lokasi, $kuota, $deskripsi, $benefit, $nama_file_baru);
            } else {
                echo "<script>alert('Maaf, terjadi kesalahan saat mengunggah file Anda.')</script>";
            }
        }

        echo "<script>alert('Event berhasil diedit!'); window.location.href = '" . BASEURL . "/app/controllers/eo/event.php';</script>";
        exit();
    }

    $listKategori = getAllKategori($conn);
    require_once '../../views/eo/form_event.php';
?>
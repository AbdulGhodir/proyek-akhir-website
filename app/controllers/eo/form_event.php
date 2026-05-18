<?php
    require_once '../../config/config.php';
    require_once '../../../koneksi/koneksi.php';
    
    session_start();
    
    if (isset($_POST['tambah_event_baru'])) {
        $eventOrganizerID = $_SESSION['id'];
        $nama_event = $_POST['nama_event'];
        $deskripsi = $_POST['deskripsi'];
        $kategori = $_POST['kategori'];
        $tanggal = str_replace('T', ' ', $_POST['tanggal']);
        $biaya = $_POST['biaya'];
        $lokasi = $_POST['lokasi'];
        $kuota = $_POST['kuota'];
        $status = 'pending';

        $query = $conn->prepare("
            INSERT INTO `event`(`id_user`, `id_kategori`, `judul`, `waktu_pelaksanaan`, `biaya`, `lokasi`, `kuota`, `deskripsi`, `status_publikasi`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $query->bind_param("iissisiss", $eventOrganizerID, $kategori, $nama_event, $tanggal, $biaya, $lokasi, $kuota, $deskripsi, $status);
        $query->execute();

        $idEvent = $conn->insert_id;
        $query->close();
        

        $listPertanyaan = [];
        $tipePertanyaan = [];
        $opsiDropdown = [[]];
        
        $listPertanyaan = $_POST['pertanyaan'];
        $tipePertanyaan = $_POST['tipe_pertanyaan'];
        $opsiDropdown = $_POST['opsi'];

        $query_form = $conn->prepare("INSERT INTO `event_form`(`id_event`, `pertanyaan`, `tipe_input`, `opsi_pilihan`, `wajib_diisi`) VALUES (?, ?, ?, ?, ?)");

        for ($i = 0; $i < count($listPertanyaan); $i++) {
            $statusPertanyaan = isset($_POST['wajib'][$i]) ? 1 : 0;
            $dropdownValue = NULL;
            if ($tipePertanyaan[$i] == 'dropdown') {
                $dropdownValue = implode(",", $opsiDropdown[$i]);                
            }

            $query_form->bind_param("isssi", $idEvent, $listPertanyaan[$i], $tipePertanyaan[$i], $dropdownValue, $statusPertanyaan);
            $query_form->execute();
        }

        $query_form->close();

        echo "sukses";
    }

?>
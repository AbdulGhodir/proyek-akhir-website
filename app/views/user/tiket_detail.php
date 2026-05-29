<?php
session_start(); 

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!defined('BASEURL')) {
    define('BASEURL', 'http://localhost/proyek-akhir-website'); 
}

$host = "localhost";
$username = "root";
$password = "";
$database = "db_eventify";
$conn = new mysqli($host, $username, $password, $database);

$id_pendaftaran = isset($_GET['id']) ? intval($_GET['id']) : 0;
$tiket = null;

if ($id_pendaftaran > 0 && !$conn->connect_error) {
    $query = "SELECT p.id_pendaftaran, u.nama_lengkap, e.judul AS acara, e.waktu_pelaksanaan AS tanggal, e.lokasi 
              FROM pendaftaran p
              JOIN event e ON p.id_event = e.id_event
              JOIN users u ON p.id_user = u.id
              WHERE p.id_pendaftaran = $id_pendaftaran AND p.status_pendaftaran = 'diterima'";
              
    $result = mysqli_query($conn, $query); 

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        $tiket = [
            'nama' => $row['nama_lengkap'],
            'acara' => $row['acara'],
            'tanggal' => date('d F Y, H:i', strtotime($row['tanggal'])) . ' WIB',
            'lokasi' => $row['lokasi'],
            'kode' => 'EVT-' . str_pad($row['id_pendaftaran'], 4, '0', STR_PAD_LEFT)
        ];
    }
}

if (!$tiket) {
    $tiket = [
        'nama' => isset($_SESSION['user']['nama_lengkap']) ? $_SESSION['user']['nama_lengkap'] : 'Peserta Eventify',
        'acara' => 'Tech Future Summit 2026',
        'tanggal' => '18 Mei 2026, 09:00 WIB',
        'lokasi' => 'Swiss-Belhotel Lampung',
        'kode' => 'EVT-0101'
    ];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ticket | Eventify</title>
    
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/user-style/user-style.css?v=<?= time(); ?>">
</head>
<body>

<?php @include 'navbar.php'; ?>

<section class="ticket-page">
    <div class="ticket-container">
        <a href="<?= BASEURL; ?>/app/controllers/user/riwayat-pendaftaran.php" class="btn-back" style="margin-bottom: 24px;">
            <i class='bx bx-arrow-back'></i> Kembali
        </a>

        <?php if ($tiket): ?>
            <div class="ticket-card">
                <div class="ticket-info">
                    <h2><?= $tiket['acara'] ?></h2>
                    <p><strong>Nama</strong> <?= $tiket['nama'] ?></p>
                    <p><strong>Tanggal</strong> <?= $tiket['tanggal'] ?></p>
                    <p><strong>Lokasi</strong> <?= $tiket['lokasi'] ?></p>
                </div>
                
                <div class="ticket-qr-section">
                    <div class="ticket-qr-box" style="padding: 12px; display: flex; justify-content: center; align-items: center;">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?= urlencode($tiket['kode']) ?>" alt="QR Code Tiket" style="width: 100px; height: 100px; border-radius: 4px;">
                    </div>
                    <p class="ticket-code-text"><?= $tiket['kode'] ?></p>
                </div>
            </div>
        <?php else: ?>
            <div class="ticket-card ticket-error">
                <h3>Tiket Tidak Ditemukan</h3>
                <p>ID tiket tidak valid, belum diterima, atau tidak tersedia.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

</body>
</html>
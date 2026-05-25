<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require '../../config/config.php';
require '../../../koneksi/koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>

    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/user-style/user-style.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/components/logo.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

<?php include 'navbar.php'; ?>

<div class="profile-page">

    <div class="profile-card">

        <div class="profile-header">

            <div class="profile-avatar">
                <?= strtoupper(substr($_SESSION['nama_lengkap'], 0, 1)); ?>
            </div>

            <div>
                <h2><?= $_SESSION['nama_lengkap']; ?></h2>
                <p><?= $_SESSION['email']; ?></p>
            </div>

        </div>

        <div class="profile-info-box">

            <div class="info-item">
                <span>Role</span>
                <h4><?= $_SESSION['role']; ?></h4>
            </div>

            <div class="info-item">
                <span>Status Akun</span>
                <h4>Aktif</h4>
            </div>

        </div>

        <div class="profile-action">
            <button>Edit Profil</button>
            <button class="secondary">Ganti Password</button>
        </div>

    </div>

</div>

</body>
</html>
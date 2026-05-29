<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require '../../config/config.php';
require '../../../koneksi/koneksi.php';

$sukses_update = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['nama_lengkap'] = $_POST['nama'] ?? $_SESSION['nama_lengkap'];
    $_SESSION['instansi'] = $_POST['instansi'] ?? '';
    $_SESSION['gender'] = $_POST['gender'] ?? '';
    $_SESSION['interest'] = $_POST['interest'] ?? [];
    $_SESSION['linkedin'] = $_POST['linkedin'] ?? '';
    
    $sukses_update = true;
}

$nama = $_SESSION['nama_lengkap'] ?? 'User';
$inisial = strtoupper(substr($nama, 0, 1));
$instansi = $_SESSION['instansi'] ?? '';
$gender = $_SESSION['gender'] ?? '';
$interest = $_SESSION['interest'] ?? [];
$linkedin = $_SESSION['linkedin'] ?? '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya | Eventify</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/components/logo.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/user-style/user-style.css?v=<?= time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<?php include 'navbar.php'; ?>

<section class="profile-page">
    <div class="container profile-container">
        
        <a href="<?= BASEURL; ?>/app/controllers/user/dashboard.php" class="btn-back">
            <i class='bx bx-arrow-back'></i> Kembali ke Beranda
        </a>

        <div class="profile-card shopee-style">
            
            <div class="profile-header-text">
                <h2>Profil Saya</h2>
                <p>Kelola informasi profil Anda untuk mengontrol dan mengamankan akun</p>
                <hr>
            </div>

            <form action="" method="POST" class="profile-form-container">
                <div class="profile-form-left">
                    
                    <div class="form-group-inline">
                        <label>Nama</label>
                        <input type="text" name="nama" value="<?= $nama; ?>" class="form-input">
                    </div>

                    <div class="form-group-inline">
                        <label>Email</label>
                        <div class="email-display">
                            <span><?= $_SESSION['email'] ?? 'email@domain.com'; ?></span>
                            <a href="#">Ubah</a>
                        </div>
                    </div>

                    <div class="form-group-inline">
                        <label>Instansi</label>
                        <input type="text" name="instansi" value="<?= $instansi; ?>" placeholder="Contoh: Universitas Lampung" class="form-input">
                    </div>

                    <div class="form-group-inline">
                        <label>Jenis Kelamin</label>
                        <div class="radio-group">
                            <label><input type="radio" name="gender" value="Laki-laki" <?= ($gender == 'Laki-laki') ? 'checked' : ''; ?>> Laki-laki</label>
                            <label><input type="radio" name="gender" value="Perempuan" <?= ($gender == 'Perempuan') ? 'checked' : ''; ?>> Perempuan</label>
                        </div>
                    </div>

                    <div class="form-group-inline" style="align-items: flex-start;">
                        <label style="margin-top: 8px;">Minat Event</label>
                        <div class="interest-chips">
                            <label class="chip"><input type="checkbox" name="interest[]" value="Tech" <?= in_array('Tech', $interest) ? 'checked' : ''; ?>> <span>Teknologi</span></label>
                            <label class="chip"><input type="checkbox" name="interest[]" value="Business" <?= in_array('Business', $interest) ? 'checked' : ''; ?>> <span>Bisnis</span></label>
                            <label class="chip"><input type="checkbox" name="interest[]" value="Social" <?= in_array('Social', $interest) ? 'checked' : ''; ?>> <span>Sosial</span></label>
                            <label class="chip"><input type="checkbox" name="interest[]" value="Sport" <?= in_array('Sport', $interest) ? 'checked' : ''; ?>> <span>Olahraga</span></label>
                        </div>
                    </div>

                    <div class="form-group-inline">
                        <label><i class='bx bxl-linkedin-square'></i> LinkedIn</label>
                        <input type="text" name="linkedin" value="<?= $linkedin; ?>" placeholder="url profil linkedin" class="form-input">
                    </div>

                    <button type="submit" class="btn-primary btn-simpan">Simpan Perubahan</button>
                </div>

                <div class="profile-form-right">
                    <div class="avatar-preview"><?= $inisial; ?></div>
                    <button type="button" class="btn-outline">Pilih Gambar</button>
                    <p class="avatar-hint">Ukuran gambar: maks. 1 MB<br>Format gambar: .JPEG, .PNG</p>
                </div>
            </form>

        </div>
    </div>
</section>

<div id="toast-success" class="toast-notification">
    <i class='bx bx-check-circle'></i>
    <span>Perubahan profil berhasil disimpan!</span>
</div>

<script>
    <?php if ($sukses_update): ?>
        document.addEventListener('DOMContentLoaded', function() {
            const toast = document.getElementById('toast-success');
            if (toast) {
                toast.classList.add('show');
                setTimeout(() => {
                    toast.classList.remove('show');
                }, 3000);
            }
        });
    <?php endif; ?>
</script>

</body>
</html>
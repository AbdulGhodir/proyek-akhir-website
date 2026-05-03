<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin - Voluntix</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include('sidebar.php'); ?>

<div class="container">
    <div class="header-biru">
        <h2>Halo, Admin Budi!</h2>
        <p>Hari ini ada beberapa program volunteer yang harus dicek.</p>
    </div>

    <div class="kartu-stats">
        <div class="box">
            <h3>150</h3>
            <p>Total Relawan</p>
        </div>
        <div class="box">
            <h3>12</h3>
            <p>Program Aktif</p>
        </div>
        <div class="box">
            <h3 style="color: red;">5</h3>
            <p>Perlu Validasi</p>
        </div>
    </div>

    <div class="box">
        <h3>Antrian Validasi Terbaru</h3>
        <table style="margin-top: 15px;">
            <tr>
                <td><b>Program Mengajar Anak Jalanan</b></td>
                <td>Pendidikan</td>
                <td><a href="cek_program.php" class="btn-aksi bg-kuning">Cek Detail</a></td>
            </tr>
            <tr>
                <td><b>Donasi Buku Pelosok</b></td>
                <td>Sosial</td>
                <td><a href="cek_program.php" class="btn-aksi bg-kuning">Cek Detail</a></td>
            </tr>
        </table>
    </div>
</div>

</body>
</html>
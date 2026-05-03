<!DOCTYPE html>
<html>
<head>
    <title>Data Relawan - Voluntix</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include('sidebar.php'); ?>

<div class="container">
    <h2 style="margin-bottom: 20px;">Daftar Relawan Terdaftar</h2>
    
    <div class="box">
        <div style="margin-bottom: 15px;">
            <input type="text" placeholder="Cari nama relawan..." style="padding: 8px; width: 250px; border-radius: 5px; border: 1px solid #ccc;">
            <button class="btn-aksi bg-hijau" style="padding: 8px 15px;">Cari</button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>NAMA</th>
                    <th>EMAIL</th>
                    <th>STATUS</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><b>Rina Septiani</b></td>
                    <td>rina@student.univ.ac.id</td>
                    <td><span class="btn-aksi bg-hijau">Aktif</span></td>
                    <td><a href="#" style="color: red;"><i class="fa-solid fa-trash"></i></a></td>
                </tr>
                <tr>
                    <td><b>Agus Kotak</b></td>
                    <td>agus@gmail.com</td>
                    <td><span class="btn-aksi bg-hijau">Aktif</span></td>
                    <td><a href="#" style="color: red;"><i class="fa-solid fa-trash"></i></a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
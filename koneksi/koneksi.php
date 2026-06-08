<?php
$host = "localhost";
$user = "root";
$password = "Informatika_1991";
$database = "db_eventify";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_ecommerce";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);
$mysqli = new mysqli($servername, $username, $password, $database);
// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

?>

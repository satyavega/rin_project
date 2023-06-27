<?php
// Koneksi ke database
$conn = mysqli_connect("localhost","root","","db_ecommerce");

if(isset($_GET['id'])){
    $id = $_GET['id'];

    // Query untuk menghapus data
    $query = "DELETE FROM products WHERE id = $id";
    mysqli_query($conn, $query);

    // Redirect ke halaman sebelumnya
    header("Location: newadmin.php");
}
?>
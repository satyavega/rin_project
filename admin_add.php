<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $product_code = $_POST['product_code'];
    $product_price = $_POST['price'];
    $product_desc = $_POST['product_desc'];
    $qty = $_POST['qty'];

    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["product_img_name"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["product_img_name"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["product_img_name"]["tmp_name"], $target_file)) {
            // Gambar berhasil diupload, lakukan insert ke tabel products
            $sql = "INSERT INTO products (product_name, product_code, price, product_desc, qty, product_img_name) VALUES ('$product_name', '$product_code', '$product_price', '$product_desc', '$qty', '$target_file')";
            if ($mysqli->query($sql)) {
                echo '<script>alert("Produk berhasil ditambahkan.");</script>';
                header("Location: newadmin.php");
                exit;
            } else {
                // Gagal menyimpan data produk ke tabel products
                $error_message = "Failed to insert product into the database.";
            }
        } else {
            // Gagal mengupload gambar
            $error_message = "Failed to upload the image.";
        }
    } else {
        // File yang diupload bukan gambar
        $error_message = "Invalid image file.";
    }
}
?>

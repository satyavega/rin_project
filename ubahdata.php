<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
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
            // Gambar berhasil diupload, lakukan update ke tabel products
            $sql = "UPDATE products SET product_name = '$product_name', product_code = '$product_code', price = '$product_price', product_desc = '$product_desc', qty = '$qty', product_img_name = '$target_file' WHERE id = $id";
            if ($mysqli->query($sql)) {
                echo '<script>alert("Produk berhasil diubah.");</script>';
                header("Location: admin.php");
                exit;
            } else {
                // Gagal mengupdate data produk
                $error_message = "Failed to update product in the database.";
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

// Mendapatkan data produk yang akan diubah berdasarkan ID yang diterima melalui GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $mysqli->query("SELECT * FROM products WHERE id = '$id'");

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_object();
    } else {
        echo "Product not found.";
    }
} else {
    echo "Product not found.";
}
?>

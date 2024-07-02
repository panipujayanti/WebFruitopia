<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    $query = "DELETE FROM produk WHERE id = $id";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header('Location: kelola_produk.php');
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

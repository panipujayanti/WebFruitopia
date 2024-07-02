<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_buah = $_POST['nama_buah'];
    $harga = $_POST['harga'];
    $img = $_POST['img'];

    $query = "INSERT INTO produk (nama_buah, harga, img) VALUES ('$nama_buah', '$harga', '$img')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header('Location: kelola_produk.php');
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

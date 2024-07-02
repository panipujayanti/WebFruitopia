<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nama_buah = $_POST['nama_buah'];
    $harga = $_POST['harga'];
    $img = $_POST['img'];

    $query = "UPDATE produk SET nama_buah = '$nama_buah', harga = '$harga', img = '$img' WHERE id = $id";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header('Location: kelola_produk.php');
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

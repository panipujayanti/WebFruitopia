<?php
include 'koneksi.php';
$sql = "SELECT id, nama_buah, harga, img FROM produk";
$result = $koneksi->query($sql);
$barang = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $produk[] = $row;
    }
}
header('Content-Type: application/json');
echo json_encode($produk);
$koneksi->close();
?>

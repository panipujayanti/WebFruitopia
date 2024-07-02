<?php
require 'koneksi.php';

$data = json_decode(file_get_contents('php://input'), true);

$nama_buah = $data['nama_buah'];
$harga = $data['harga'];
$jumlah_barang = $data['jumlah_barang'];
$nama_penerima = $data['nama_penerima'];
$alamat = $data['alamat'];
$tanggal = $data['tanggal'];
$price_per_item = $data['price_per_item']; 

$query = "INSERT INTO transaksi (nama_buah, harga, jumlah_barang, nama_penerima, alamat, tanggal, price_per_item) 
          VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $koneksi->prepare($query);
$stmt->bind_param("ssisssi", $nama_buah, $harga, $jumlah_barang, $nama_penerima, $alamat, $tanggal, $price_per_item);

if ($stmt->execute()) {
    http_response_code(201); 
    echo json_encode(array("message" => "Order berhasil disimpan."));
} else {
    http_response_code(500); 
    echo json_encode(array("message" => "Gagal menyimpan order: " . $stmt->error));
}

$stmt->close();
mysqli_close($koneksi);

?>

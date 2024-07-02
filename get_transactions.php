<?php
require 'koneksi.php';

$query = "SELECT * FROM transaksi";
$result = mysqli_query($koneksi, $query);

$transactions = array();
while ($row = mysqli_fetch_assoc($result)) {
    $transactions[] = $row;
}

header('Content-Type: application/json');
echo json_encode($transactions);

mysqli_close($koneksi);
?>

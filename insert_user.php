<?php
header("Content-Type: application/json");
include 'koneksi.php';

$data = json_decode(file_get_contents("php://input"));

if (
    !isset($data->email) || !isset($data->nama) || !isset($data->password)) {
    die(json_encode(["error" => "Invalid input"]));
}

$email = $koneksi->real_escape_string($data->email);
$nama = $koneksi->real_escape_string($data->nama);
$password = $koneksi->real_escape_string($data->password);

$sql = "INSERT INTO users (email, nama, password) VALUES ('$email','$nama', '$password')";

if ($koneksi->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => $koneksi->error]);
}

$koneksi->close();
?>

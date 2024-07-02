<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json'); 

include "koneksi.php"; 

$id = $_POST['id']; 
$email = $_POST['email'];
$nama = $_POST['nama']; 
$password = $_POST['password'];

$query = "UPDATE users SET email = ?, nama = ?, password = ? WHERE id = ?";

$stmt = $koneksi->prepare($query);
if (!$stmt) {
    echo json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $koneksi->error]);
    exit();
}

$stmt->bind_param("sssi", $email, $nama, $password, $id);

$response = array(); 

if ($stmt->execute()) {
    $response['status'] = 'success';
    $response['message'] = 'User updated successfully';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Failed to update user';
}

echo json_encode($response); 

$stmt->close();
$koneksi->close();
?>

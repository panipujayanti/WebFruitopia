<?php
header("Content-Type: application/json; charset=UTF-8");
require 'koneksi.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($id > 0) {
        $stmt = $koneksi->prepare("DELETE FROM transaksi WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'Transaction deleted successfully.';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Failed to delete transaction.';
        }

        $stmt->close();
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Invalid transaction ID.';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
$koneksi->close();
?>

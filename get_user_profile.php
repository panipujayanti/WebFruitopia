<?php
header("Content-Type: application/json");
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $user_id = intval($_POST['user_id']);

    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $koneksi->prepare($query);
    
    if ($stmt) {
        $stmt->bind_param('i', $user_id);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                echo json_encode(['status' => 'succes', 'result_code' => '1', 'user' => $user]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'User not found']);
            }
        } else {
            error_log("Query execution failed: " . $stmt->error);
            echo json_encode(['status' => 'error', 'message' => 'Query execution failed']);
        }
        $stmt->close();
    } else {
        error_log("Failed to prepare statement: " . $koneksi->error);
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement']);
    }
} else {
    error_log("Invalid request");
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}

$koneksi->close();
?>

<?php
include 'koneksi.php';

if ($koneksi->connect_error) {
    http_response_code(500);
    die("Connection failed: " . $koneksi->connect_error);
}

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$email = $koneksi->real_escape_string($email);
$password = $koneksi->real_escape_string($password);

if ($koneksi) {
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($koneksi, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $status = "ok";
        $result_code = 1;
        $user = array(
            'id' => $row['id'],
            'email' => $row['email'],
            'nama' => $row['nama'],
            'password' => $row['password']
        );
        echo json_encode(array('status' => $status, 'result_code' => $result_code, 'user' => $user));
    } else {
        $status = "gagal";
        $result_code = 0;
        echo json_encode(array('status' => $status, 'result_code' => $result_code));
    }
} else {
    $status = "failed";
    echo json_encode(array('status' => $status), JSON_FORCE_OBJECT);
}

mysqli_close($koneksi);
?>

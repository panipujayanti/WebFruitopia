<?php
require 'koneksi.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->id) && isset($data->nama_penerima) && isset($data->alamat)) {

    $id = $data->id;
    $nama_penerima = $data->nama_penerima;
    $alamat = $data->alamat;

    $sql = "UPDATE transaksi SET nama_penerima=?, alamat=? WHERE id=?"; 

    $stmt = $koneksi->prepare($sql);

    $stmt->bind_param("ssi", $nama_penerima, $alamat, $id);

    if ($stmt->execute()) {
        $response["status"] = "success";
        $response["message"] = "Order berhasil diupdate";

        $query = "SELECT * FROM transaksi WHERE id=?"; 
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $transactions = array();
        
        while ($row = $result->fetch_assoc()) {
            $transactions[] = $row;
        }

        $stmt->close();

        $response["transactions"] = $transactions;
        echo json_encode($response);
    } else {
        $response["status"] = "error";
        $response["message"] = "Gagal melakukan update order";
        echo json_encode($response);
    }
    
} else {
    $response["status"] = "error";
    $response["message"] = "Data tidak valid";
    echo json_encode($response);
}

mysqli_close($koneksi);
?>

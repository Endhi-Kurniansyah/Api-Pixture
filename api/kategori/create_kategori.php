<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include "../../koneksi/koneksi.php";

$data = json_decode(file_get_contents("php://input"));

$response = array();
$response["error"] = true;
$response["message"] = "error";

if (isset($data->nama_kategori)) {
    $insert_sql = "INSERT INTO Kategori (nama_kategori) VALUES ('" . $mysqli->real_escape_string($data->nama_kategori) . "')";
    $result = mysqli_query($mysqli, $insert_sql);

    if ($result) {
        $response["error"] = false;
        $response["message"] = "Berhasil simpan data";
    }
}

echo json_encode($response);
?>

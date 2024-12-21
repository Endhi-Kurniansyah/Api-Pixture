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

if (isset($data->id_kategori) && isset($data->nama_kategori)) {
    $update_sql = "UPDATE Kategori SET nama_kategori = '" . $mysqli->real_escape_string($data->nama_kategori) . "' WHERE id_kategori = " . intval($data->id_kategori);
    $result = mysqli_query($mysqli, $update_sql);

    if ($result) {
        $response["error"] = false;
        $response["message"] = "Berhasil update data";
    }
}

echo json_encode($response);
?>

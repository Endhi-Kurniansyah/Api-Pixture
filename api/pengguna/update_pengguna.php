<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include "../../koneksi/koneksi.php";

$data = json_decode(file_get_contents("php://input"));

$response = array();
$response["error"] = true;
$response["message"] = "error";

if (isset($data->id_pengguna) && isset($data->nama_pengguna) && isset($data->email)) {
    $update_sql = "UPDATE Pengguna SET 
        nama_pengguna = '" . $mysqli->real_escape_string($data->nama_pengguna) . "',
        email = '" . $mysqli->real_escape_string($data->email) . "',
        foto_profil = '" . $mysqli->real_escape_string($data->foto_profil) . "'
        WHERE id_pengguna = " . intval($data->id_pengguna);
    $result = mysqli_query($mysqli, $update_sql);

    if ($result) {
        $response["error"] = false;
        $response["message"] = "Berhasil update data";
    }
}

echo json_encode($response);
?>

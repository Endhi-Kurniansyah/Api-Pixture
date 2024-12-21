<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include "../../koneksi/koneksi.php";

$data = json_decode(file_get_contents("php://input"));

$response = array();
$response["error"] = true;
$response["message"] = "error";

if (isset($data->nama_pengguna) && isset($data->email) && isset($data->kata_sandi)) {
    $insert_sql = "INSERT INTO Pengguna (nama_pengguna, email, kata_sandi, foto_profil) VALUES (
        '" . $mysqli->real_escape_string($data->nama_pengguna) . "',
        '" . $mysqli->real_escape_string($data->email) . "',
        '" . $mysqli->real_escape_string($data->kata_sandi) . "',
        '" . $mysqli->real_escape_string($data->foto_profil) . "'
    )";
    $result = mysqli_query($mysqli, $insert_sql);

    if ($result) {
        $response["error"] = false;
        $response["message"] = "Berhasil simpan data";
    }
}

echo json_encode($response);
?>

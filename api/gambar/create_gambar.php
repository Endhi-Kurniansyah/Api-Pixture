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

if (isset($data->id_pengguna) && isset($data->judul) && isset($data->url_gambar)) {
    $insert_sql = "INSERT INTO Gambar (id_pengguna, judul, deskripsi, url_gambar, id_kategori) VALUES (
        '" . intval($data->id_pengguna) . "',
        '" . $mysqli->real_escape_string($data->judul) . "',
        '" . $mysqli->real_escape_string($data->deskripsi) . "',
        '" . $mysqli->real_escape_string($data->url_gambar) . "',
        " . (isset($data->id_kategori) ? intval($data->id_kategori) : "NULL") . "
    )";
    $result = mysqli_query($mysqli, $insert_sql);

    if ($result) {
        $response["error"] = false;
        $response["message"] = "Berhasil simpan data";
    }
}

echo json_encode($response);
?>

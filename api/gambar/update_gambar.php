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

if (isset($data->id_gambar) && isset($data->judul) && isset($data->id_pengguna) && isset($data->url_gambar)) {
    $update_sql = "UPDATE Gambar SET 
        judul = '" . $mysqli->real_escape_string($data->judul) . "',
        deskripsi = '" . $mysqli->real_escape_string($data->deskripsi) . "',
        url_gambar = '" . $mysqli->real_escape_string($data->url_gambar) . "',
        id_kategori = " . (isset($data->id_kategori) ? intval($data->id_kategori) : "NULL") . "
        WHERE id_gambar = " . intval($data->id_gambar);
    $result = mysqli_query($mysqli, $update_sql);

    if ($result) {
        $response["error"] = false;
        $response["message"] = "Berhasil update data";
    }
}

echo json_encode($response);
?>

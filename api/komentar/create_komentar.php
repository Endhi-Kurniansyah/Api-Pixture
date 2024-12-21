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

if (isset($data->id_pengguna) && isset($data->id_gambar) && isset($data->isi_komentar)) {
    $insert_sql = "INSERT INTO Komentar (id_pengguna, id_gambar, isi_komentar) VALUES (
        '" . intval($data->id_pengguna) . "',
        '" . intval($data->id_gambar) . "',
        '" . $mysqli->real_escape_string($data->isi_komentar) . "'
    )";
    $result = mysqli_query($mysqli, $insert_sql);

    if ($result) {
        $response["error"] = false;
        $response["message"] = "Berhasil menambahkan komentar";
    }
}

echo json_encode($response);
?>

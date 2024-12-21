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

if (isset($data->id_komentar) && isset($data->isi_komentar)) {
    $update_sql = "UPDATE Komentar SET 
        isi_komentar = '" . $mysqli->real_escape_string($data->isi_komentar) . "'
        WHERE id_komentar = " . intval($data->id_komentar);
    $result = mysqli_query($mysqli, $update_sql);

    if ($result) {
        $response["error"] = false;
        $response["message"] = "Berhasil memperbarui komentar";
    }
}

echo json_encode($response);
?>

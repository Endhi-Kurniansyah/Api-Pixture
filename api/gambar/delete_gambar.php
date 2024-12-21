<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include "../../koneksi/koneksi.php";

$data = json_decode(file_get_contents("php://input"));

$response = array();
$response["error"] = true;
$response["message"] = "error";

if (isset($data->id_gambar)) {
    $delete_sql = "DELETE FROM Gambar WHERE id_gambar = " . intval($data->id_gambar);
    $result = mysqli_query($mysqli, $delete_sql);

    if ($result) {
        $response["error"] = false;
        $response["message"] = "Berhasil hapus data";
    }
}

echo json_encode($response);
?>

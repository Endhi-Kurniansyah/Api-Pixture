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

if (isset($data->id_suka)) {
    $delete_sql = "DELETE FROM Suka WHERE id_suka = " . intval($data->id_suka);
    $result = mysqli_query($mysqli, $delete_sql);

    if ($result) {
        $response["error"] = false;
        $response["message"] = "Berhasil menghapus data suka";
    }
}

echo json_encode($response);
?>

<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");

include "../../koneksi/koneksi.php";

$data = json_decode(file_get_contents("php://input"));

$response = array();
$response["error"] = true;
$response["message"] = "error";

if (isset($data->id_pengguna)) {
    $delete_sql = "DELETE FROM Pengguna WHERE id_pengguna = " . intval($data->id_pengguna);
    $result = mysqli_query($mysqli, $delete_sql);

    if ($result) {
        $response["error"] = false;
        $response["message"] = "Berhasil hapus data";
    }
}

echo json_encode($response);
?>

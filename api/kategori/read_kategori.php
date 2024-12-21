<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

include "../../koneksi/koneksi.php";

$read_sql = "SELECT * FROM Kategori";
$result = mysqli_query($mysqli, $read_sql);

$kategori = array();
$kategori["error"] = true;
$kategori["message"] = "error";
$kategori["count"] = 0;
$kategori["kategori"] = array();

if ($result) {
    $kategori["error"] = false;
    $kategori["message"] = "Berhasil ambil data";
    
    while ($row = mysqli_fetch_assoc($result)) {
        $kategori_item = array(
            "id_kategori" => $row['id_kategori'],
            "nama_kategori" => $row['nama_kategori']
        );
        array_push($kategori["kategori"], $kategori_item);
    }
    $kategori["count"] = mysqli_num_rows($result);
}

echo json_encode($kategori);
?>

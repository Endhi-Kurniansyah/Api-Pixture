<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

include "../../koneksi/koneksi.php";

$read_sql = "SELECT * FROM Pengguna";
$result = mysqli_query($mysqli, $read_sql);

$pengguna = array();
$pengguna["error"] = true;
$pengguna["message"] = "error";
$pengguna["count"] = 0;
$pengguna["pengguna"] = array();

if ($result) {
    $pengguna["error"] = false;
    $pengguna["message"] = "Berhasil ambil data";
    while ($row = mysqli_fetch_assoc($result)) {
        $pengguna_item = array(
            "id_pengguna" => $row['id_pengguna'],
            "nama_pengguna" => $row['nama_pengguna'],
            "email" => $row['email'],
            "foto_profil" => $row['foto_profil'],
            "tanggal_dibuat" => $row['tanggal_dibuat']
        );
        array_push($pengguna["pengguna"], $pengguna_item);
    }
    $pengguna["count"] = mysqli_num_rows($result);
}

echo json_encode($pengguna);
?>

<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

include "../../koneksi/koneksi.php";

$read_sql = "SELECT Suka.id_suka, Suka.id_pengguna, Suka.id_gambar, Pengguna.nama_pengguna, Gambar.judul
             FROM Suka
             LEFT JOIN Pengguna ON Suka.id_pengguna = Pengguna.id_pengguna
             LEFT JOIN Gambar ON Suka.id_gambar = Gambar.id_gambar";
$result = mysqli_query($mysqli, $read_sql);

$suka = array();
$suka["error"] = true;
$suka["message"] = "error";
$suka["count"] = 0;
$suka["suka"] = array();

if ($result) {
    $suka["error"] = false;
    $suka["message"] = "Berhasil ambil data suka";
    
    while ($row = mysqli_fetch_assoc($result)) {
        $suka_item = array(
            "id_suka" => $row['id_suka'],
            "id_pengguna" => $row['id_pengguna'],
            "nama_pengguna" => $row['nama_pengguna'],
            "id_gambar" => $row['id_gambar'],
            "judul_gambar" => $row['judul']
        );
        array_push($suka["suka"], $suka_item);
    }
    $suka["count"] = mysqli_num_rows($result);
}

echo json_encode($suka);
?>

<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

include "../../koneksi/koneksi.php";

$read_sql = "SELECT Pengikut.id_pengikut, Pengikut.id_pengguna, Pengikut.id_diikuti, 
             Pengguna.nama_pengguna AS nama_pengikut, Diikuti.nama_pengguna AS nama_diikuti
             FROM Pengikut
             LEFT JOIN Pengguna AS Pengguna ON Pengikut.id_pengguna = Pengguna.id_pengguna
             LEFT JOIN Pengguna AS Diikuti ON Pengikut.id_diikuti = Diikuti.id_pengguna";
$result = mysqli_query($mysqli, $read_sql);

$pengikut = array();
$pengikut["error"] = true;
$pengikut["message"] = "error";
$pengikut["count"] = 0;
$pengikut["pengikut"] = array();

if ($result) {
    $pengikut["error"] = false;
    $pengikut["message"] = "Berhasil ambil data pengikut";
    
    while ($row = mysqli_fetch_assoc($result)) {
        $pengikut_item = array(
            "id_pengikut" => $row['id_pengikut'],
            "id_pengguna" => $row['id_pengguna'],
            "nama_pengikut" => $row['nama_pengikut'],
            "id_diikuti" => $row['id_diikuti'],
            "nama_diikuti" => $row['nama_diikuti']
        );
        array_push($pengikut["pengikut"], $pengikut_item);
    }
    $pengikut["count"] = mysqli_num_rows($result);
}

echo json_encode($pengikut);
?>

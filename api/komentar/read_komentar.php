<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

include "../../koneksi/koneksi.php";

$read_sql = "SELECT Komentar.id_komentar, Komentar.id_pengguna, Komentar.id_gambar, Komentar.isi_komentar, Komentar.tanggal_komentar, 
             Pengguna.nama_pengguna, Gambar.judul AS judul_gambar
             FROM Komentar
             LEFT JOIN Pengguna ON Komentar.id_pengguna = Pengguna.id_pengguna
             LEFT JOIN Gambar ON Komentar.id_gambar = Gambar.id_gambar";
$result = mysqli_query($mysqli, $read_sql);

$komentar = array();
$komentar["error"] = true;
$komentar["message"] = "error";
$komentar["count"] = 0;
$komentar["komentar"] = array();

if ($result) {
    $komentar["error"] = false;
    $komentar["message"] = "Berhasil ambil data komentar";
    
    while ($row = mysqli_fetch_assoc($result)) {
        $komentar_item = array(
            "id_komentar" => $row['id_komentar'],
            "id_pengguna" => $row['id_pengguna'],
            "nama_pengguna" => $row['nama_pengguna'],
            "id_gambar" => $row['id_gambar'],
            "judul_gambar" => $row['judul_gambar'],
            "isi_komentar" => $row['isi_komentar'],
            "tanggal_komentar" => $row['tanggal_komentar']
        );
        array_push($komentar["komentar"], $komentar_item);
    }
    $komentar["count"] = mysqli_num_rows($result);
}

echo json_encode($komentar);
?>

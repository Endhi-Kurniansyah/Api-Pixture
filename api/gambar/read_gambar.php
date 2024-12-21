<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

include "../../koneksi/koneksi.php";

$read_sql = "SELECT Gambar.id_gambar, Gambar.id_pengguna, Gambar.judul, Gambar.deskripsi, Gambar.url_gambar, Gambar.id_kategori, Gambar.tanggal_dibuat, Pengguna.nama_pengguna, Kategori.nama_kategori
             FROM Gambar
             LEFT JOIN Pengguna ON Gambar.id_pengguna = Pengguna.id_pengguna
             LEFT JOIN Kategori ON Gambar.id_kategori = Kategori.id_kategori";
$result = mysqli_query($mysqli, $read_sql);

$gambar = array();
$gambar["error"] = true;
$gambar["message"] = "error";
$gambar["count"] = 0;
$gambar["gambar"] = array();

if ($result) {
    $gambar["error"] = false;
    $gambar["message"] = "Berhasil ambil data";
    
    while ($row = mysqli_fetch_assoc($result)) {
        $gambar_item = array(
            "id_gambar" => $row['id_gambar'],
            "id_pengguna" => $row['id_pengguna'],
            "nama_pengguna" => $row['nama_pengguna'],
            "judul" => $row['judul'],
            "deskripsi" => $row['deskripsi'],
            "url_gambar" => $row['url_gambar'],
            "id_kategori" => $row['id_kategori'],
            "nama_kategori" => $row['nama_kategori'],
            "tanggal_dibuat" => $row['tanggal_dibuat']
        );
        array_push($gambar["gambar"], $gambar_item);
    }
    $gambar["count"] = mysqli_num_rows($result);
}

echo json_encode($gambar);
?>

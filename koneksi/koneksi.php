<?php
$mysqli = new mysqli("localhost", "root", "", "pixture");

if ($mysqli->connect_errno) {
    echo "Gagal terhubung ke MySQL: " . $mysqli->connect_error;
    exit();
}
?>

<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_masalahit"; 

$koneksi = mysqli_connect($host, $user, $pass, $db);
$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM tabel_gangguan WHERE id = '$id'");

header("Location: index.php");
?>
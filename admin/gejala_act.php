<?php 

include '../koneksi.php';
$nama = $_POST['nama'];
$inisial = $_POST['inisial'];

$img_gejala = uploadImageGejala();

mysqli_query($koneksi, "insert into gejala values(null,'$inisial','$nama','$img_gejala')");
header("location:gejala.php");
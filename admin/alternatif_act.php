<?php 

include '../koneksi.php';
$nama = $_POST['nama'];
$inisial = $_POST['inisial'];
$penyebab = $_POST['penyebab'];
$solusi = $_POST['solusi'];

$img_penyakit = uploadImagePenyakit();

mysqli_query($koneksi, "insert into alternatif values(null,'$inisial','$nama','$penyebab','$solusi','$img_penyakit')");
header("location:alternatif.php");
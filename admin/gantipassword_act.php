<?php 

include '../koneksi.php';
$pass = md5($_POST['pass']);

mysqli_query($koneksi, "update admin set password='$pass'");
header("location:index.php");
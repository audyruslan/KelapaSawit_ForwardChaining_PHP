<?php 
$koneksi = mysqli_connect("localhost","root","","kelapasawit");

// Upload File Gambar Penyakit
function uploadImagePenyakit()
{
    $namaFile = $_FILES['img_penyakit']['name'];
    $tmpName = $_FILES['img_penyakit']['tmp_name'];

    move_uploaded_file($tmpName, '../images/penyakit/' . $namaFile);

    return $namaFile;
}

// Upload File Gambar Gejala
function uploadImageGejala()
{
    $namaFile = $_FILES['img_gejala']['name'];
    $tmpName = $_FILES['img_gejala']['tmp_name'];

    move_uploaded_file($tmpName, '../images/gejala/' . $namaFile);

    return $namaFile;
}
?>
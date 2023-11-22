<?php

include '../koneksi.php';
$id = $_POST['id'];
$inisial = $_POST['inisial'];
$nama = $_POST['nama'];
$penyebab = $_POST['penyebab'];
$solusi = $_POST['solusi'];

// Update Image Lama jika ada
$imgLama = $_POST['imgLama'];
$img_penyakit = updateImagePenyakit($imgLama);

function updateImagePenyakit($imgLama)
{
    // Cek apakah ada file gambar yang diunggah
    if (!empty($_FILES['img_penyakit']['name'])) {
        $namaFile = $_FILES['img_penyakit']['name'];
        $tmpName = $_FILES['img_penyakit']['tmp_name'];

        // Hapus gambar lama jika ada
        $pathGambarLama = '../images/penyakit/' . $imgLama;
        if (file_exists($pathGambarLama) && !empty($imgLama)) {
            unlink($pathGambarLama);
        }

        move_uploaded_file($tmpName, '../images/penyakit/' . $namaFile);

        return $namaFile;
    } else {
        // Jika tidak ada gambar yang diunggah, kembalikan nama gambar lama
        return $imgLama;
    }
}

mysqli_query($koneksi, "UPDATE alternatif SET 
                alt_nama='$nama', 
                alt_inisial='$inisial', 
                alt_penyebab='$penyebab', 
                alt_solusi='$solusi',
                img_penyakit='$img_penyakit' 
                WHERE alt_id='$id'");
header("location:alternatif.php");

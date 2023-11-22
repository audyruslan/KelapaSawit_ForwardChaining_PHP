<?php 

include '../koneksi.php';
$id = $_POST['id'];
$nama = $_POST['nama'];
$inisial = $_POST['inisial'];

// Update Image Lama jika ada
$imgLama = $_POST['imgLama'];
$img_gejala = updateImageGejala($imgLama);

function updateImageGejala($imgLama)
{
    // Cek apakah ada file gambar yang diunggah
    if (!empty($_FILES['img_gejala']['name'])) {
        $namaFile = $_FILES['img_gejala']['name'];
        $tmpName = $_FILES['img_gejala']['tmp_name'];

        // Hapus gambar lama jika ada
        $pathGambarLama = '../images/gejala/' . $imgLama;
        if (file_exists($pathGambarLama) && !empty($imgLama)) {
            unlink($pathGambarLama);
        }

        move_uploaded_file($tmpName, '../images/gejala/' . $namaFile);

        return $namaFile;
    } else {
        // Jika tidak ada gambar yang diunggah, kembalikan nama gambar lama
        return $imgLama;
    }
}


mysqli_query($koneksi, "UPDATE gejala SET 
            gej_nama='$nama', 
            gej_inisial='$inisial',
            img_gejala='$img_gejala'
            WHERE gej_id='$id'");
header("location:gejala.php");
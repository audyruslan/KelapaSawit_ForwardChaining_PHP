<?php

include '../koneksi.php';
$id = $_GET['id'];

// Ambil nama gambar sebelum menghapus data
$result = mysqli_query($koneksi, "SELECT img_penyakit FROM alternatif WHERE alt_id='$id'");
$row = mysqli_fetch_assoc($result);
$imgToDelete = $row['img_penyakit'];

// Hapus gambar jika ada
if (!empty($imgToDelete)) {
    $pathGambar = '../images/penyakit/' . $imgToDelete;
    if (file_exists($pathGambar)) {
        unlink($pathGambar);
    }
}

// Hapus data dari tabel kecocokan
mysqli_query($koneksi, "DELETE FROM kecocokan WHERE kec_alternatif='$id'");

// Hapus data dari tabel alternatif
mysqli_query($koneksi, "DELETE FROM alternatif WHERE alt_id='$id'");

header("location:alternatif.php");
?>

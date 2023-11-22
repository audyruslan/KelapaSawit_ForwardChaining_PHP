<?php 

include '../koneksi.php';
$id = $_GET['id'];

// Ambil nama gambar sebelum menghapus data
$result = mysqli_query($koneksi, "SELECT img_gejala FROM gejala WHERE gej_id='$id'");
$row = mysqli_fetch_assoc($result);
$imgToDelete = $row['img_gejala'];

// Hapus gambar jika ada
if (!empty($imgToDelete)) {
    $pathGambar = '../images/gejala/' . $imgToDelete;
    if (file_exists($pathGambar)) {
        unlink($pathGambar);
    }
}

// Hapus data dari tabel kecocokan
mysqli_query($koneksi, "DELETE FROM kecocokan WHERE kec_gejala='$id'");

// Hapus data dari tabel alternatif
mysqli_query($koneksi, "DELETE FROM gejala WHERE gej_id='$id'");

header("location:gejala.php");
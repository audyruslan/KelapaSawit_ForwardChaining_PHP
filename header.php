<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Diagnosa Penyakit pada tanaman kelapa Sawit dengan Menggunakan Metode Forward Chaining</title>
  <meta content="Diagnosa Penyakit pada tanaman kelapa Sawit dengan Menggunakan Metode Forward Chaining" name="description">
  <meta content="Diagnosa Penyakit pada tanaman kelapa Sawit dengan Menggunakan Metode Forward Chaining" name="keywords">

  <!-- Favicons -->
  <link href="assets_depan/img/favicon.png" rel="icon">
  <link href="assets_depan/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <!-- <link href="assets_depan/vendor/aos/aos.css" rel="stylesheet"> -->
  <link href="assets_depan/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets_depan/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets_depan/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets_depan/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets_depan/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets_depan/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets_depan/DataTables/DataTables-1.13.6/css/dataTables.bootstrap5.min.css" />

  <!-- Template Main CSS File -->
  <link href="assets_depan/css/style.css" rel="stylesheet">
  <link rel="icon" href="assets_depan/sawit1.jpg">
  <!-- =======================================================
  * Template Name: Arsha
  * Updated: Jul 27 2023 with Bootstrap v5.3.1
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<?php
error_reporting(0);
session_start();
include 'koneksi.php';
?>

<body>

  <!-- ======= Header =======  -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.html">Kelapa Sawit</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets_depan/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="index.php">Home</a></li>
          <li class="dropdown"><a href="#"><span>Penyakit & Gejala</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="penyakit.php">Penyakit</a></li>
              <li><a href="gejala.php">Gejala</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="riwayat.php">Riwayat</a></li>
          <li><a class="nav-link scrollto" href="data.php">Data</a></li>
          <li><a class="nav-link scrollto" href="diagnosa.php">Diagnosa</a></li>
          <li><a class="getstarted scrollto" href="login.php">Login Admin</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
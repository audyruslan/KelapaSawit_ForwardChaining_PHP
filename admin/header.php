<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Dashboard - Sistem Pakar Diagnosa Penyakit pada tanaman kelapa Sawit dengan Menggunakan Metode Forward Chaining</title>

  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../assets/awesome/css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/dashboard.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="../assets/DataTables/datatables.min.css" />
  <link rel="stylesheet" href="../assets/css/summernote.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    td {
      vertical-align: middle !important;
    }
  </style>


  <?php
  // mengaktifkan sessionn
  error_reporting(0);
  session_start();

  // periksa session (jika belum login alihkan halaman kembali ke halaman login)
  if ($_SESSION['status'] != "login") {
    header("location:../login.php");
  }

  // koneksi database
  include '../koneksi.php';
  ?>
</head>

<body>
  <nav class="navbar navbar-light sticky-top bg-info flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3 text-center font-weight-bold" href="index.php">FORWARD CHAINING</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <h6 class="text-white font-weight-bold text-uppercase mt-1 d-none d-lg-block">Sistem Pakar Diagnosa Penyakit pada tanaman kelapa Sawit dengan Menggunakan Metode Forward Chaining</h6>

    <ul class="navbar-nav px-4">
      <li class="nav-item text-nowrap">
        <a class="nav-link text-light" href="logout.php"><i data-feather="power"></i> SIGN OUT</a>
      </li>
    </ul>
  </nav>

  <div class="container-fluid">
    <div class="row">

      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="sidebar-sticky pt-4">
          <ul class="nav flex-column">

            <li class="nav-item">
              <a class="nav-link my-1 active" href="index.php">
                <span class="mr-2" data-feather="home"></span>
                Dashboard <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link my-1" href="gejala.php">
                <span class="mr-2" data-feather="file"></span>
                Data Gejala
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link my-1" href="alternatif.php">
                <span class="mr-2" data-feather="file"></span>
                Data Penyakit
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link my-1" href="kecocokan.php">
                <span class="mr-2" data-feather="link-2"></span>
                Relasi Penyakit
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link my-1" href="gantipassword.php">
                <span class="mr-2" data-feather="lock"></span>
                Ganti Password
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link my-1" href="logout.php">
                <span class="mr-2" data-feather="power"></span>
                Logout
              </a>
            </li>

          </ul>
        </div>
      </nav>
<?php include 'header.php'; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">Data Gejala</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <a href="gejala.php" class="btn btn-sm btn-info pull-right pull-right"><i class="fa fa-arrow-left"></i> Kembali</a>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <span class="font-weight-bold">Tambah Gejala Baru</span>
        </div>
        <div class="card-body">
          <form action="gejala_act.php" method="post" enctype="multipart/form-data">

            <div class="form-group">
              <label>Kode</label>
              <input type="text" class="form-control" name="inisial">
            </div>

            <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control" name="nama">
            </div>
            <div class="form-group">
              <label>Gambar Gejala</label>
              <input type="file" name="img_gejala" class="form-control">
            </div>

            <div class="form-group">
              <input type="submit" value="Simpan" class="btn btn-info btn-sm">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>



</main>

<?php include 'footer.php'; ?>
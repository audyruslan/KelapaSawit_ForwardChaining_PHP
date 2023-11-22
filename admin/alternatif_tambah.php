<?php include 'header.php'; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">Data Alternatif</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <a href="alternatif.php" class="btn btn-sm btn-info pull-right"><i class="fa fa-arrow-left"></i> KEMBALI</a>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <span class="font-weight-bold">Tambah Alternatif Baru</span>
        </div>
        <div class="card-body">
          <form action="alternatif_act.php" method="post">

            <div class="form-group">
              <label>Kode</label>
              <input class="form-control" type="text" name="inisial">
            </div>
            <div class="form-group">
              <label>Nama</label>
              <input class="form-control" type="text" name="nama">
            </div>

            <div class="form-group">
              <label>Penyebab</label>
              <textarea class="form-control" id="penyebab" name="penyebab"></textarea>
            </div>

            <div class="form-group">
              <label>Solusi Perbaikan</label>
              <textarea class="form-control" id="solusi" name="solusi"></textarea>
            </div>

            <div class="form-group">
              <input type="submit" value="Simpan" class="btn btn-sm btn-info">
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <h5 class="text-center mb-3"><strong>Unggah Gambar Penyakit</strong></h5>
      <div class="drop-zone">
        <span class="drop-zone__prompt">Drop file here or
          click to upload</span>
        <input type="file" name="image" class="drop-zone__input">
      </div>
      <p class="text-danger mt-2">
        <small><i>*Unggah Gambar Penyakit</i></small>
      </p>
    </div>
  </div>

</main>

<?php include 'footer.php'; ?>
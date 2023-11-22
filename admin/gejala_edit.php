<?php include 'header.php'; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">Data Gejala</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <a href="gejala.php" class="btn btn-sm btn-primary pull-right pull-right"><i class="fa fa-arrow-left"></i> Kembali</a>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <form action="gejala_update.php" method="post" enctype="multipart/form-data">
        <?php
        $id = $_GET['id'];
        $data = mysqli_query($koneksi, "select * from gejala where gej_id='$id'");
        while ($d = mysqli_fetch_array($data)) {
        ?>
          <div class="card">
            <div class="card-header">
              <span class="font-weight-bold">Edit Gejala Baru</span>
            </div>
            <div class="card-body">

              <div class="form-group">
                <label>Kode</label>
                <input type="hidden" name="id" value="<?php echo $d['gej_id']; ?>">
                <input type="hidden" name="imgLama" value="<?php echo $d['img_gejala']; ?>">
                <input type="text" class="form-control" name="inisial" value="<?php echo $d['gej_inisial']; ?>">
              </div>

              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" value="<?php echo $d['gej_nama']; ?>">
              </div>

              <div class="form-group">
                <input type="submit" value="Simpan" class="btn btn-primary btn-sm">
              </div>
            </div>
          </div>
    </div>

    <div class="col-md-6">
      <div class="card w-75">
        <div class="text-center">
          <?php
          if (!empty($d["img_gejala"])) {
          ?>
            <img class="card-img-top" src="../images/gejala/<?= $d["img_gejala"]; ?>" alt="Gambar Gejala">
          <?php } else { ?>
            <img class="card-img-top" src="../images/image.png" alt="Gambar Gejala">
          <?php } ?>
          <input type="file" class="form-control" id="img_gejala" name="img_gejala">
        </div>
      </div>
    <?php } ?>
    </form>
    </div>
  </div>

</main>

<?php include 'footer.php'; ?>
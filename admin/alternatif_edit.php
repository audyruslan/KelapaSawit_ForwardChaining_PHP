<?php include 'header.php'; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">Data Alternatif</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <a href="alternatif.php" class="btn btn-sm btn-info pull-right"><i class="fa fa-arrow-left"></i> KEMBALI</a>
    </div>
  </div>

  <div class="row">
    <?php
    $id = $_GET['id'];
    $data = mysqli_query($koneksi, "SELECT * FROM alternatif WHERE alt_id='$id'");
    while ($d = mysqli_fetch_array($data)) {
    ?>
      <div class="col-md-6">
        <form action="alternatif_update.php" method="post" enctype="multipart/form-data">
          <div class="card">
            <div class="card-header">
              <span class="font-weight-bold">Edit Alternatif</span>
            </div>
            <div class="card-body">

              <div class="form-group">
                <label>Kode</label>
                <input type="hidden" name="id" value="<?php echo $d['alt_id']; ?>">
                <input type="hidden" name="imgLama" value="<?php echo $d['img_penyakit']; ?>">
                <input type="text" class="form-control" name="inisial" value="<?php echo $d['alt_inisial']; ?>">
              </div>
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" value="<?php echo $d['alt_nama']; ?>">
              </div>
              <div class="form-group">
                <label>Penyebab</label>
                <textarea class="form-control" name="penyebab"><?php echo $d['alt_penyebab']; ?></textarea>
              </div>
              <div class="form-group">
                <label>Perbaikan</label>
                <textarea class="form-control" name="solusi"><?php echo $d['alt_solusi']; ?></textarea>
              </div>
              <div class="form-group">
                <input type="submit" value="Simpan" class="btn btn-sm btn-info">
              </div>

            </div>
          </div>
      </div>
      <div class="col-md-6">
        <h5 class="text-center mb-3"><strong>Edit Gambar Penyakit</strong></h5>
        <div class="card w-75">
          <div class="text-center">
            <?php 
              if(!empty($d["img_penyakit"])){
            ?>
            <img class="card-img-top" src="../images/penyakit/<?= $d["img_penyakit"]; ?>" alt="Gambar Penyakit">
            <?php }else{ ?>
              <img class="card-img-top" src="../images/image.png" alt="Gambar Penyakit">
              <?php } ?>
            <input type="file" class="form-control" id="img_penyakit" name="img_penyakit">
          </div>
        </div>
        <p class="text-danger mt-2">
          <small><i>*Edit Gambar Penyakit</i></small>
        </p>
      </div>
    <?php } ?>
    </form>
  </div>

</main>

<?php include 'footer.php'; ?>
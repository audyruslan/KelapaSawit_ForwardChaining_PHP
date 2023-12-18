<?php include 'header.php'; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">Data Gejala / Kriteria</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <a href="gejala_tambah.php" class="btn btn-sm btn-info btn-fill pull-right"><i class="fa fa-plus"></i> Tambah Gejala</a>
    </div>
  </div>


  <div class="row mt-4">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <span class="font-weight-bold">Data Gejala</span>
        </div>
        <div class="card-body">

          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="myTable">
              <thead>
                <tr>
                  <th class="text-center" width="1%">No</th>
                  <th class="text-center" width="10%">Kode</th>
                  <th class="text-center" width="40%">Nama Gejala</th>
                  <th class="text-center">Gambar Gejala</th>
                  <th class="text-center" width="12%">OPSI</th>
                </tr>
              </thead>

              <?php
              $no = 1;
              $data = mysqli_query($koneksi, "SELECT * FROM gejala");
              while ($d = mysqli_fetch_array($data)) {
              ?>
                <tr>
                  <td class="text-center"><?php echo $no++; ?></td>
                  <td class="text-center"><?php echo $d['gej_inisial'] ?></td>
                  <td><?php echo $d['gej_nama'] ?></td>
                  <td class="text-center"><img class="img-fluid rounded w-50" src="../images/gejala/<?= $d["img_gejala"] ?>" alt="Gambar Gejala"></td>
                  <td class="text-center">
                    <a class="btn btn-sm btn-primary" title="change" href="gejala_edit.php?id=<?php echo $d['gej_id']; ?>"><i class="fa fa-wrench"></i></a>
                    <a class="btn btn-sm btn-info" title="delete" href="gejala_hapus.php?id=<?php echo $d['gej_id']; ?>"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
              <?php
              }
              ?>

            </table>
          </div>

        </div>
      </div>
    </div>
  </div>



</main>



<?php include 'footer.php'; ?>
<?php include 'header.php'; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">Data Penyakit</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <a href="alternatif_tambah.php" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Tambah</a>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <span class="font-weight-bold">Data Penyakit</span>
        </div>
        <div class="card-body">

          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="myTable">
              <thead>
                <tr>
                  <th width="1%">No</th>
                  <th width="1%">Kode</th>
                  <th width="20%">Nama</th>
                  <th width="30%">Penyebab</th>
                  <th width="30%">Solusi</th>
                  <th width="30%">Gambar</th>
                  <th width="15%">OPSI</th>
                </tr>
              </thead>
              <?php
              $no = 1;
              $data = mysqli_query($koneksi, "SELECT * FROM alternatif");
              while ($d = mysqli_fetch_array($data)) {
              ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $d['alt_inisial'] ?></td>
                  <td><?php echo $d['alt_nama'] ?></td>
                  <td><?php echo $d['alt_penyebab'] ?></td>
                  <td><?php echo nl2br($d['alt_solusi']) ?></td>
                  <td>
                    <img class="card-img-top" src="../images/penyakit/<?= $d["img_penyakit"] ?>" alt="Gambar Penyakit">
                  </td>
                  <td class="text-center">
                    <a class="btn btn-sm btn-primary mb-1" title="change" href="alternatif_edit.php?id=<?php echo $d['alt_id']; ?>"><i class="fa fa-wrench"></i></a>
                    <a class="btn btn-sm btn-info" title="delete" href="alternatif_hapus.php?id=<?php echo $d['alt_id']; ?>"><i class="fa fa-trash"></i></a>
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
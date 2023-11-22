<?php include 'header.php'; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">Data Alternatif</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
     
    </div>
  </div>



  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <span class="font-weight-bold">Ganti Password</span>
        </div>
        <div class="card-body">
          <form action="gantipassword_act.php" method="post">

            <div class="form-group"> 
              <label>Masukkan Password Baru</label>
              <input type="password" class="form-control" name="pass" required="required">
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

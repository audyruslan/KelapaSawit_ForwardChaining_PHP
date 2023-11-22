<?php include 'header.php'; ?>

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center" style="height: 90vh;">
  <div class="container">

   <div class="row justify-content-center">
    <div class="col-lg-4">
      <?php
      if(isset($_GET['alert'])){
        ?>
        <div class="alert alert-danger text-center fw-semibold">Username dan Password salah</div>
        <?php
      }
      ?>
      <h1>Log In</h1>

      <div class="form-container">
        <form action="login_act.php" method="post">
          <div class="form-group mb-2">
            <label class="form-label text-light fw-semibold" for="lemail">Username</label>
            <input type="text" class="form-control" placeholder="username" id="lemail" autocomplete="off" name="username" required="required">
            <div class="help-block with-errors"></div>
          </div>
          <div class="form-group mb-4">
            <label class="form-label text-light fw-semibold" for="lpassword">Password</label>
            <input type="password" class="form-control" placeholder="password" id="lpassword" name="password" required="required">
            <div class="help-block with-errors"></div>
          </div>
          <div class="form-group mb-3 d-grid">
            <button type="submit" class="btn btn-info fw-semibold">LOG IN</button>
          </div>
          <div class="form-message">
            <div id="lmsgSubmit" class="h3 text-center hidden"></div>
          </div>
        </form>
      </div> 
    </div>
  </div>

</div>
</section><!-- End Hero -->

<main id="main">


</main><!-- End #main -->

<?php include 'footer.php'; ?>
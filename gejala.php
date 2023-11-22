<?php include 'header.php'; ?>
<?php mysqli_query($koneksi, "delete from tmp_kecocokan"); ?>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="index.php">Home</a></li>
                <li>Data Gejala</li>
            </ol>
            <h2>Data Gejala</h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <section id="portfolio" class="portfolio">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Data Gejala</h2>
                <p>Kumpulan Data Gambar Gejala pada Tanaman Kelapa Sawit</p>
            </div>

            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
                <?php
                $data = mysqli_query($koneksi, "select * from gejala");
                while ($d = mysqli_fetch_array($data)) {
                ?>
                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <div class="portfolio-img">
                            <a href="images/gejala/<?= $d["img_gejala"]; ?>" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link">
                                <img src="images/gejala/<?= $d["img_gejala"]; ?>" class="img-fluid" alt="Gambar Gejala">
                            </a>
                        </div>
                        <div class="portfolio-info">
                            <h4><?= $d["gej_inisial"]; ?> - <?= $d["gej_nama"]; ?></h4>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>
    </section><!-- End Portfolio Section -->

</main><!-- End #main -->

<?php include 'footer.php'; ?>
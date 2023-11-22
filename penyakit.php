<?php include 'header.php'; ?>
<?php mysqli_query($koneksi, "delete from tmp_kecocokan"); ?>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="index.php">Home</a></li>
                <li>Data Penyakit</li>
            </ol>
            <h2>Data Penyakit</h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <section id="portfolio" class="portfolio">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Data Penyakit</h2>
                <p>Kumpulan Data Gambar Penyakit pada Tanaman Kelapa Sawit</p>
            </div>

            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
                <?php
                $data = mysqli_query($koneksi, "select * from alternatif");
                while ($d = mysqli_fetch_array($data)) {
                ?>
                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <div class="portfolio-img">
                            <a href="images/penyakit/<?= $d["img_penyakit"]; ?>" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link">
                                <img src="images/penyakit/<?= $d["img_penyakit"]; ?>" class="img-fluid" alt="Gambar Penyakit">
                            </a>
                        </div>
                        <div class="portfolio-info">
                            <h4><?= $d["alt_inisial"]; ?> - <?= $d["alt_nama"]; ?></h4>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>
    </section><!-- End Portfolio Section -->

</main><!-- End #main -->

<?php include 'footer.php'; ?>
<?php include 'header.php'; ?>
<?php mysqli_query($koneksi,"delete from tmp_kecocokan"); ?>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="index.php">Home</a></li>
                <li>Riwayat Diagnosa</li>
            </ol>
            <h2>Riwayat Diagnosa</h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
        <div class="container">


            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">             
                        <table class="table table-bordered tabel-striped" id="myTable">
                            <thead>
                                <tr>
                                    <th width="1%">No</th>
                                    <th>Nama</th>
                                    <th>No.HP</th>
                                    <th width="1%">Detail</th>
                                </tr>
                            </thead>
                                <?php 
                                $no=1;
                                $data = mysqli_query($koneksi,"select * from user where user_hasil != '' and user_hasil != '0' order by user.user_id desc");
                                while($d=mysqli_fetch_array($data)){
                                    ?>            
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $d['user_nama']; ?></td>
                                        <td><?php echo $d['user_hp']; ?></td>
                                        <td><a class="btn btn-primary" href="diagnosa_hasil.php?id=<?php echo $d['user_id']; ?>"> Detail</a></td>
                                    </tr>
                                <?php } ?>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </section>

</main><!-- End #main -->

<?php include 'footer.php'; ?>
<?php include 'header.php'; ?>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="index.php">Home</a></li>
                <li>Diagnosa</li>
            </ol>
            <h2>Diagnosa</h2>
            <p class="text-dark">Jawab pertanyaan berikut sesuai dengan yang terjadi pada tanaman kelapa sawit anda.</p>
        </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
        <div class="container">

           <?php 
                                    // cek jika pertanyaan pertama
           if(isset($_GET['gejala'])){
            $gejala = $_GET['gejala'];
            ?>

            <!-- tampilkan pertanyaan pertama -->

            <form action="diagnosa_mulai5.php" method="post" class="m-0">
                <?php 
                                            // mengambil data gejala yang pertama
                $inisial_pertanyaan_selanjutnya = $gejala;                                            
                $pertanyaan_pertama = mysqli_query($koneksi,"select * from gejala where gej_inisial='$inisial_pertanyaan_selanjutnya'");
                $pp = mysqli_fetch_array($pertanyaan_pertama);
                ?>

                <div class="row justify-item-center">

                    <div class="col-12 text-center">

                        <input type="hidden" name="id_user" value="<?php echo $_GET['id']; ?>">
                        <input type="hidden" name="inisial" value="<?php echo $pp['gej_inisial']; ?>">
                        <h1 class="mb-5 text-dark"> <?php echo $pp['gej_inisial']; ?> - <?php echo $pp['gej_nama']; ?> ? </h1>

                        <br>

                    </div>

                    <div class="col-md-6 text-center">
                        <button class="btn btn-success btn-lg fw-bold text-white mt-5 w-50" name="jawaban" value="1">YA</button>
                    </div>

                    <div class="col-md-6 text-center">
                        <button class="btn btn-danger btn-lg fw-bold text-white mt-5 w-50" name="jawaban" value="0">TIDAK</button>
                    </div>

                    <div class="col-md-12">

                        <center>
                            <br>            
                            <br>            
                            <br>
                            <a href="diagnosa_hasil2.php?id_user=<?php echo $_GET['id']; ?>" class="btn btn-info btn-lg px-5" style="text-decoration: none;font-size: 12pt;font-weight: bold;padding: 15px 30px">SELESAIKAN JAWABAN</a>
                        </center>

                    </div>

                </div>
            </form> 

            <?php
        }else{
            ?>

            <?php
            $no = 0;
                                        // membuat array rule
            $rule = array();
                                        // mengambil data alternatif
            $alternatif = mysqli_query($koneksi,"select * from alternatif");        
            while($ker=mysqli_fetch_array($alternatif)){
                ?>

                <?php 
                $xx = 0;
                                            // id alternatif
                $id_ker = $ker['alt_id'];
                $rule2 = array();
                                            // ambil data relasi untuk membuat array 
                $kecocokan2 = mysqli_query($koneksi,"select * from kecocokan,gejala where kec_gejala=gej_id and kec_alternatif='$id_ker' and kec_nilai=1");        
                while($kec2=mysqli_fetch_array($kecocokan2)){
                    $xxx = $xx++;
                                                // memasukkan data inisial ke array rule2. array rule2 ini aarray sementara
                    array_push($rule2, $kec2['gej_inisial']);
                }          
                                            // memasukkan data array ke array rule                                    
                array_push($rule, $rule2);
                ?>

                <?php 
                                            // membuat array alternatif
                $_SESSION['alternatif'][$no] = $ker['alt_id'];
                $no++;

            }

                                        // membuat session rule
            $_SESSION['rule'] = $rule;

                                        // membuat session urutan untuk inputan jaawaban
            $_SESSION['urutan'] = 0;

                                        // buat session untuk key gejala yg di ambil
            $_SESSION['pertama'] = 0;
            $_SESSION['kedua'] = 0;
            ?>

            <!-- tampilkan pertanyaan pertama -->

            <form action="diagnosa_mulai5.php" method="post" class="m-0">
                <?php 
                $inisial_pertanyaan_pertama = $rule[0][0];                                            
                $pertanyaan_pertama = mysqli_query($koneksi,"select * from gejala where gej_inisial='$inisial_pertanyaan_pertama'");
                $pp = mysqli_fetch_array($pertanyaan_pertama);
                ?>

                <div class="row justify-item-center">

                    <div class="col-12 text-center">

                        <input type="hidden" name="id_user" value="<?php echo $_GET['id']; ?>">
                        <input type="hidden" name="inisial" value="<?php echo $pp['gej_inisial']; ?>">
                        <h1 class="mb-5 text-dark"><?php echo $pp['gej_inisial']; ?> - <?php echo $pp['gej_nama']; ?> ?</h1>
                        <br>

                    </div>

                    <div class="col-md-6 text-center">
                        <button class="btn btn-success btn-lg fw-bold text-white mt-5 w-50" name="jawaban" value="1">YA</button>
                    </div>

                    <div class="col-md-6 text-center">
                        <button class="btn btn-danger btn-lg fw-bold text-white mt-5 w-50" name="jawaban" value="0">TIDAK</button>
                    </div>

                </div>
            </form>  

            <?php
        }

        ?>

        <br>
        <br>
        <br>
    </div>
</section>

</main><!-- End #main -->


<?php include 'footer.php'; ?>
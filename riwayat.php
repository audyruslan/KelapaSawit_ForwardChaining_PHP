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
                        <table class="table table-bordered tabel-striped" id="tableku">
                            <thead>
                                <tr>
                                    <th width="1%">No</th>
                                    <th>Nama</th>
                                    <th>No.HP</th>
                                    <th>Hama dan Penyakit</th>
                                    <th width="1%">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no=1;
                                $data = mysqli_query($koneksi,"select * from user where user_hasil != '' and user_hasil != '0' order by user.user_id desc");
                                while($d=mysqli_fetch_array($data)){
                                    ?>            
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $d['user_nama']; ?></td>
                                        <td><?php echo $d['user_hp']; ?></td>
                                        <td>

                                            <?php 
                                            $id_user = $d['user_id'];
                                            $arr_inputan = array();
                                            $user_input = mysqli_query($koneksi,"select * from user_input,gejala where user_input.gejala=gejala.gej_inisial and user_input.user='$id_user' and user_input.nilai='1'");
                                            while($i=mysqli_fetch_array($user_input)){
                                                $ii = $i['gejala'];
                                                array_push($arr_inputan, $ii);  
                                            }


                                            $hasil = $d['user_hasil'];
                                            $h = explode(",", $hasil);



                                            $arr_hasil = array();

                                            for($a = 0; $a < count($h); $a++){
                                                $p = 0; 

                                                for($i = 0; $i < count($arr_inputan); $i++){
                                                    $inputan = $arr_inputan[$i];
                                                    $id_alternatif = $h[$a];
                                                    $kecocokan = mysqli_query($koneksi, "select * from kecocokan,gejala where kec_alternatif='$id_alternatif' and kec_gejala=gej_id and kec_nilai='1'");
                                                    while($k = mysqli_fetch_array($kecocokan)){
// echo $k['gej_inisial'];

                                                        if($k['gej_inisial'] == $inputan){
                                                            $p++;
                                                        }

                                                    }

                                                }
                                                $jk = mysqli_num_rows($kecocokan);
                                                $x = array(
                                                    "alternatif" => $id_alternatif,
                                                    "ada" => $p,
                                                    "jumlah" => mysqli_num_rows($kecocokan),
                                                    "persen" => $p/$jk*100,
                                                );


                                                if(!in_array($x, $arr_hasil)){
                                                    array_push($arr_hasil, $x);
                                                }

                                            }

                                            ?>


                                            <?php 
// urutkan persen terbesar
                                            usort($arr_hasil, function($a, $b) {
                                                return $b['persen'] <=> $a['persen'];
                                            });

                                            $arr_hasil2 = array();
                                            for($a = 0; $a < count($arr_hasil); $a++){
                                                $p = $arr_hasil[0]['persen'];
                                                if($arr_hasil[$a]['persen'] > $p){

                                                    $x = array(
                                                        "alternatif" => $arr_hasil[$a]['alternatif'],
                                                        "ada" => $arr_hasil[$a]['ada'],
                                                        "jumlah" => $arr_hasil[$a]['jumlah'],
                                                        "persen" => $arr_hasil[$a]['persen'],
                                                    );

                                                    $arr_hasil[0] = $x;

                                                }else if($arr_hasil[$a]['persen'] == $p){
                                                    $x = array(
                                                        "alternatif" => $arr_hasil[$a]['alternatif'],
                                                        "ada" => $arr_hasil[$a]['ada'],
                                                        "jumlah" => $arr_hasil[$a]['jumlah'],
                                                        "persen" => $arr_hasil[$a]['persen'],
                                                    );

                                                    array_push($arr_hasil2, $x);
                                                }


                                            }

                                            $arr_hasil = $arr_hasil2;
                                            ?>



                                            <?php 
                                            $h = explode(",", $hasil);
// print_r($h);
                                            for($a = 0; $a < count($arr_hasil); $a++){
                                                $x = $arr_hasil[$a]['alternatif'];
                                                $alternatif = mysqli_query($koneksi,"select * from alternatif where alternatif.alt_id='$x'");
                                                while($k=mysqli_fetch_array($alternatif)){
                                                    ?>
                                                    <?php 
                                                    $ada = $arr_hasil[$a]['ada'];
                                                    $jumlah = $arr_hasil[$a]['jumlah'];

                                                    $persen = $ada/$jumlah*100;
                                                    ?>
                                                    <b><?php echo $k['alt_inisial']; ?> - <?php echo $k['alt_nama']; ?></b> <span class="text-primary">(<?php echo $persen."%"; ?>)</span>                
                                                    <br>
                                                    <?php 
                                                }
                                            }
                                            ?>

                                        </td>
                                        <td><a class="btn btn-primary" href="diagnosa_hasil.php?id=<?php echo $d['user_id']; ?>"> Detail</a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </section>

</main><!-- End #main -->

<?php include 'footer.php'; ?>
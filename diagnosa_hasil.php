<?php include 'header.php'; ?>
<?php mysqli_query($koneksi, "delete from tmp_kecocokan"); ?>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="index.php">Home</a></li>
                <li>Hasil Diagnosa</li>
            </ol>
            <h2>Hasil Diagnosa</h2>
            <p class="text-dark">Hasil diagnosa penyakit pada tanaman sawit dengan metode forward chaining.</p>

        </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
        <div class="container">

            <?php
            // cek apakah ada parameter id user
            if (isset($_GET['id']) && $_GET['id'] != "") {
            ?>
                <?php
                $id_user = $_GET['id'];
                // ambil data user
                $data = mysqli_query($koneksi, "select * from user where user.user_id='$id_user'");
                $cek = mysqli_num_rows($data);
                if ($cek > 0) {
                    // tampilkan data user
                    while ($d = mysqli_fetch_array($data)) {
                ?>

                        <div class="table-responsive">
                            <table class="table table-bordered text-left">
                                <tr>
                                    <th width="30%">NAMA PENGGUNA</th>
                                    <td class="text-uppercase"><?php echo $d['user_nama']; ?></td>
                                </tr>
                                <tr>
                                    <th width="30%">NO. HP</th>
                                    <td><?php echo $d['user_hp']; ?></td>
                                </tr>
                                <tr>
                                    <th width="30%">JAWABAN PENGGUNA</th>
                                    <td>
                                        <ul>
                                            <?php
                                            // menampilkan data jawaban/inputan yang diisi oleh user   
                                            $user_input = mysqli_query($koneksi, "select * from user_input,gejala where user_input.gejala=gejala.gej_inisial and 
                                        user_input.user='$id_user'");
                                            while ($i = mysqli_fetch_array($user_input)) {
                                            ?>
                                                <li>
                                                    <?php echo $i['gej_inisial'] . " - " . $i['gej_nama']; ?>

                                                    <?php
                                                    // cek nilai yang diisi adalah ya atau tidak
                                                    if ($i['nilai'] == "0") {
                                                        echo "( Salah - tidak )";
                                                    } else {
                                                        echo "( Benar - ya )";
                                                    }
                                                    ?>
                                                </li>

                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                        </div>



                        <?php
                        // array inputan user
                        $arr_inputan = array();
                        // ambil data inputan user
                        $user_input = mysqli_query($koneksi, "select * from user_input,gejala where user_input.gejala=gejala.gej_inisial and 
                    user_input.user='$id_user' and user_input.nilai='1'");
                        while ($i = mysqli_fetch_array($user_input)) {
                            $ii = $i['gejala'];
                            array_push($arr_inputan, $ii);
                        }

                        // ambil data alternatif si user
                        $hasil = $d['user_hasil'];

                        // pisahkan berdasarkan tanda koma(multi alternatif)
                        $h = explode(",", $hasil);

                        $arr_hasil = array();

                        // tampilkan dalam bentuk perulangan
                        for ($a = 0; $a < count($h); $a++) {
                            $p = 0;

                            // tampilkan data inputan dalam bentuk perulangan
                            for ($i = 0; $i < count($arr_inputan); $i++) {
                                $inputan = $arr_inputan[$i];
                                $id_alternatif = $h[$a];

                                // ambil data kecocokan/relasi
                                $kecocokan = mysqli_query($koneksi, "select * from kecocokan,gejala where kec_alternatif='$id_alternatif' and 
                            kec_gejala=gej_id and kec_nilai='1'");
                                while ($k = mysqli_fetch_array($kecocokan)) {
                                    // echo $k['gej_inisial'];

                                    if ($k['gej_inisial'] == $inputan) {
                                        $p++;
                                    }
                                }
                            }
                            // jumlah kecocokan antara relasi dan inputan user
                            $jk = mysqli_num_rows($kecocokan);

                            // simpan dalam bentuk array
                            $x = array(
                                "alternatif" => $id_alternatif,
                                "ada" => $p,
                                "jumlah" => mysqli_num_rows($kecocokan),
                                "persen" => $p / $jk * 100,
                            );

                            // masukkan ke array arr_hasil
                            if (!in_array($x, $arr_hasil)) {
                                array_push($arr_hasil, $x);
                            }
                        }
                        ?>


                        <?php
                        // urutkan persen terbesar
                        usort($arr_hasil, function ($a, $b) {
                            return $b['persen'] <=> $a['persen'];
                        });

                        $arr_hasil2 = array();
                        for ($a = 0; $a < count($arr_hasil); $a++) {
                            $p = $arr_hasil[0]['persen'];

                            // cek jika persen alternatif  lebih besar dari alternatif lainnya
                            if ($arr_hasil[$a]['persen'] > $p) {

                                $x = array(
                                    "alternatif" => $arr_hasil[$a]['alternatif'],
                                    "ada" => $arr_hasil[$a]['ada'],
                                    "jumlah" => $arr_hasil[$a]['jumlah'],
                                    "persen" => $arr_hasil[$a]['persen'],
                                );

                                $arr_hasil[0] = $x;

                                // cek jika persen sama dengan alternatif lainnya
                            } else if ($arr_hasil[$a]['persen'] == $p) {
                                // buat jadi array
                                $x = array(
                                    "alternatif" => $arr_hasil[$a]['alternatif'],
                                    "ada" => $arr_hasil[$a]['ada'],
                                    "jumlah" => $arr_hasil[$a]['jumlah'],
                                    "persen" => $arr_hasil[$a]['persen'],
                                );

                                // masukkan ke array arr_hasil2
                                array_push($arr_hasil2, $x);
                            }
                        }

                        // pindahkan arr_hasil2 ke arr_hasil
                        $arr_hasil = $arr_hasil2;
                        ?>

                        <div class="table-responsive">

                            <table class="table table-bordered text-left">
                                <?php
                                $hasil = $d['user_hasil'];

                                // cek jika jawaban/hasil ada
                                if ($hasil != "0") {

                                    // pecahkan jawaban berdasarkan tanda koma (multi alternatif)
                                    $h = explode(",", $hasil);

                                    for ($a = 0; $a < count($arr_hasil); $a++) {

                                        $x = $arr_hasil[$a]['alternatif'];

                                        // ambil data alternatif si user
                                        $alternatif = mysqli_query($koneksi, "select * from alternatif where alternatif.alt_id='$x'");
                                        while ($k = mysqli_fetch_array($alternatif)) {
                                ?>
                                            <tr>
                                                <th width="30%">HASIL <br /> <small>Forward Chaining</small></th>
                                                <td>
                                                    <?php
                                                    // hitung persentase nya
                                                    $ada = $arr_hasil[$a]['ada'];
                                                    $jumlah = $arr_hasil[$a]['jumlah'];

                                                    $persen = $ada / $jumlah * 100;

                                                    // Tampilkan P , Penyakit, Persen
                                                    ?>
                                                    <b><?php echo $k['alt_inisial']; ?> - <?php echo $k['alt_nama']; ?></b>
                                                    <span class="text-primary">(<?php echo round($persen, 2) . "%"; ?>)</span>
                                                    <img class="img-fluid rounded mt-2 w-75" src="images/penyakit/<?php echo $k['img_penyakit']; ?>" alt="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th width="30%">PENYEBAB</th>
                                                <td><?php echo $k['alt_penyebab']; ?></td>
                                            </tr>
                                            <tr>
                                                <th width="30%">SOLUSI</th>
                                                <td><?php echo nl2br($k['alt_solusi']); ?> </td>
                                            </tr>

                                    <?php
                                        }
                                    }
                                } else {
                                    // jika tidak ada, maka tampilkan sebagai berikut
                                    ?>
                                    <tr>
                                        <th width="30%">HASIL <br /> <small>Forward Chaining</small></th>
                                        <td><b><i>Penyakit tidak ditemukan.</i></b></td>
                                    </tr>
                                    <tr>
                                        <th width="30%">PENYEBAB</th>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">SOLUSI</th>
                                        <td>-</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
            <?php
                    }
                } else {
                    // jika tidak maka alihkan halaman ke halaman diagnosa
                    header("location:diagnosa.php");
                }
            }
            ?>

            <br>

            <center>
                <a class="btn btn-info mt-5 w-50" href="diagnosa.php">DIAGNOSA LAGI</a>
            </center>


        </div>
    </section>

</main><!-- End #main -->

<?php include 'footer.php'; ?>
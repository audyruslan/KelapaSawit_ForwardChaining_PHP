<?php include 'header.php'; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">Dashboard</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <a href="index.php" class="btn btn-sm btn-info"><i class="fa fa-arrow-left"></i> Kembali</a>
  </div>
</div>

<div class="row">

    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
          <h6 class="title class m-0">Detail Riwayat Diagnosa</h6>
      </div>
      <div class="card-body">

          <div class="table-responsive">              
              <?php 
              if(isset($_GET['id']) && $_GET['id'] != ""){
                ?>
                <?php 
                $id_user = $_GET['id'];
                $data = mysqli_query($koneksi,"select * from user where user.user_id='$id_user'");
                $cek = mysqli_num_rows($data);
                if($cek>0){
                    while($d = mysqli_fetch_array($data)){
                        ?>
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
                                        $user_input = mysqli_query($koneksi,"select * from user_input,gejala where user_input.gejala=gejala.gej_inisial and user_input.user='$id_user'");
                                        while($i=mysqli_fetch_array($user_input)){
                                            ?>
                                            <li>
                                                <?php echo $i['gej_inisial']." - ".$i['gej_nama']; ?>

                                                <?php 
                                                if($i['nilai'] == "0"){
                                                    echo "( Salah - tidak )";
                                                }else{
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



                        <?php 

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








                        <table class="table table-bordered text-left">   
                            <?php 
                            $hasil = $d['user_hasil'];

                            if($hasil != "0"){

                                $h = explode(",", $hasil);
                                                    // print_r($h);
                                for($a = 0; $a < count($arr_hasil); $a++){
                                    $x = $arr_hasil[$a]['alternatif'];
                                    $alternatif = mysqli_query($koneksi,"select * from alternatif where alternatif.alt_id='$x'");
                                    while($k=mysqli_fetch_array($alternatif)){
                                        ?>
                                        <tr>
                                            <th width="30%">HASIL <br/> <small>Forward Chaining</small></th>
                                            <td>
                                                <?php 
                                                $ada = $arr_hasil[$a]['ada'];
                                                $jumlah = $arr_hasil[$a]['jumlah'];

                                                $persen = $ada/$jumlah*100;
                                                ?>
                                                <b><?php echo $k['alt_inisial']; ?> - <?php echo $k['alt_nama']; ?></b> <span class="text-primary">(<?php echo $persen."%"; ?>)</span>
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

                            }else{
                                ?>
                                <tr>
                                    <th width="30%">HASIL <br/> <small>Forward Chaining</small></th>
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
                        <?php             
                    }
                }else{
                    header("location:diagnosa.php");
                }
            }
            ?>
        </div>

    </div>
</div>

</div>  

</div>

</main>

<?php include 'footer.php'; ?>
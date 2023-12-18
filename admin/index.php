<?php include 'header.php'; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">Dashboard</h1>
    <div class="btn-toolbar mb-2 mb-md-0">

    </div>
  </div>

  <div class="row mb-3">

    <div class="col-md-3">
      <div class="card bg-info">
        <div class="card-body text-center">
          <?php 
          $kriteria = mysqli_query($koneksi,"select * from gejala");
          $jumlah_kriteria = mysqli_num_rows($kriteria);
          ?>
          <h2><?php echo $jumlah_kriteria ?></h2>
          <h6 class="">Jumlah Gejala</h6>
        </div>
      </div>
    </div>    

    <div class="col-md-3">
      <div class="card bg-info">
        <div class="card-body text-center">
          <?php 
          $alternatif = mysqli_query($koneksi,"select * from alternatif");
          $jumlah_alternatif = mysqli_num_rows($alternatif);
          ?>
          <h2><?php echo $jumlah_alternatif ?></h2>
          <h6 class="">Jumlah Penyakit</h6>
        </div>
      </div>
    </div>  

    <div class="col-md-3">
      <div class="card bg-info text-light">
        <div class="card-body text-center">
          <?php 
          $user = mysqli_query($koneksi,"select * from user");
          $jumlah_user = mysqli_num_rows($user);
          ?>
          <h2><?php echo $jumlah_user ?></h2>
          <h6 class="">Jumlah Pengguna</h6>
        </div>
      </div>
    </div>   

    <div class="col-md-3">
      <div class="card bg-info">
        <div class="card-body text-center">
          <?php 
          $admin = mysqli_query($koneksi,"select * from admin");
          $jumlah_admin = mysqli_num_rows($admin);
          ?>
          <h2><?php echo $jumlah_admin ?></h2>
          <h6 class="">Jumlah Admin</h6>
        </div>
      </div>
    </div>   


  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h6 class="title class m-0">Data Riwayat Diagnosa</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">                          

            <table class="table table-bordered" id="tableku">
              <thead>
                <tr>
                  <th width="1%">No</th>
                  <th>Nama</th>
                  <th>No.HP</th>
                  <th>Penyakit</th>
                  <th width="6%">Detail</th>
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
                  <td>
                    <a class="btn btn-sm btn-primary" title="detail" href="index_detail.php?id=<?php echo $d['user_id']; ?>"> <i class="fa fa-info"></i></a>
                    <a class="btn btn-sm btn-info" title="delete" href="index_hapus.php?id=<?php echo $d['user_id']; ?>"> <i class="fa fa-trash"></i></a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>  
</div>

</main>

<?php include 'footer.php'; ?>
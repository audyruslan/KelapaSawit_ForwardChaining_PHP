<?php 
include 'koneksi.php';
session_start();

$id_user = $_REQUEST['id_user'];

// buat array hasil untuk menyimpan alternatif yang mendekati
$hasil = array();

// ambil data inputan user
$inputan = mysqli_query($koneksi,"select * from user_input where user='$id_user' and nilai='1'");
while($i = mysqli_fetch_array($inputan)){
    $gejala = $i['gejala'];

    // data kecocokan dan inputan user
    $g = mysqli_query($koneksi,"select * from kecocokan,gejala where gej_id=kecocokan.kec_gejala and
    kec_nilai='1' and gej_inisial='$gejala'");
    while($gg = mysqli_fetch_array($g)){

        // simpan ke variabel array hasil
        if(!in_array($gg['kec_alternatif'], $hasil)){
            array_push($hasil, $gg['kec_alternatif']);
        }
    }
}

// pisahkan alternatif ke dalam bentuk text dan menggunakan tanda koma jika lebih dari 1 alternatif
$alt = "";
for($a = 0; $a < count($hasil); $a++){
    $b = $hasil[$a];

    if($alt == ""){
        $alt .= $b;
    }else{
        $alt .= ",".$b;
    }
}

if($alt == ""){
    $alt = 0;
}

// update data hasil alternatif pada data user
mysqli_query($koneksi,"update user set user_hasil='$alt' where user_id='$id_user'");

// alihkan halaman ke hasil diagnosa
header("location:diagnosa_hasil.php?id=$id_user");
?>
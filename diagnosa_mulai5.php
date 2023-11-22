<?php 
include 'koneksi.php';
session_start();

// menangkap data yang dikirim dari form
$id_user = $_REQUEST['id_user'];
$inisial = $_POST['inisial'];
$jawaban = $_POST['jawaban'];

// cek apakah user ini sudah pernah menginput jawaban 
$cek = mysqli_query($koneksi,"select * from user_input where user='$id_user' and gejala='$inisial' and nilai='$jawaban'");
if(mysqli_num_rows($cek) == "0"){	
	// jika belum maka simpan jawaaban yang di pilih user ke table user_input
	mysqli_query($koneksi,"insert into user_input values(null,'$id_user','$inisial','$jawaban')");
}

// deklarasi data session ke variabel
$urutan = $_SESSION['urutan'];

$pertama = $_SESSION['pertama'];
$kedua = $_SESSION['kedua'];

// cek jika jawaban yang dipilih IYA
if($jawaban == "1"){

	// simpan data inputan user ke variabel inputan
	$inputan[$urutan] = $inisial;

	// tentukan batas jumlah rule forward chaining
	$batas = count($_SESSION['rule'][$pertama]);
	
	// batas kurang 1, untuk menyesuaikan dengan nilai key array
	$batas -=1;

	// aturan untuk menentukan gejala selanjutnya
	if($kedua < $batas){
		$kedua+=1;
	}else{
		$pertama+=1;
		$kedua = 0;
	}

	// simpan data gejala selanjutnya
	$gejala_selanjutnya = $_SESSION['rule'][$pertama][$kedua];
	
	// update session rule gejala 
	$_SESSION['pertama'] = $pertama;
	$_SESSION['kedua'] = $kedua;

	// cek jika gejala selaanjutnyaa ditemukaan,
	if(isset($gejala_selanjutnya)){
		// alihkan ke form pertaanyaan, dengan mengirim dataa gejala yang aakan di tanyakan
		header("location:diagnosa_mulai.php?id=$id_user&gejala=$gejala_selanjutnya");
	}else{
		// jika gejala selanjutnya tidak ditemukaan, maka cari alternatif nyaa

		// buat arrah hasil untuk menyimpan alternatif yang mendekati
		$hasil = array();

		// ambil semua data inputan user untuk di cocokkan dengan rule alternatif
		$inputan = mysqli_query($koneksi,"select * from user_input where user='$id_user' and nilai='1'");
		while($i = mysqli_fetch_array($inputan)){
			$gejala = $i['gejala'];
    		
			// simpan alternatif jika sesuai dengan rule dari inputan
$g = mysqli_query($koneksi,"select * from kecocokan,gejala where gej_id=kecocokan.kec_gejala and kec_nilai='1' 
and gej_inisial='$gejala'");
			while($gg = mysqli_fetch_array($g)){
				// echo $gg['kec_alternatif']."<br>";

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

		// update data hasil alternatif pada data si user
		mysqli_query($koneksi,"update user set user_hasil='$alt' where user_id='$id_user'");

		// alihkan halaman ke halaman hasil diagnosa
		header("location:diagnosa_hasil.php?id=$id_user");
	}

// cek jika jawaban yang dipilih TIDAK
}elseif($jawaban == "0"){

	// simpan data inputan user ke variabel inputan
	$inputan[$urutan] = $inisial;

	// aturan untuk menentukan gejala selanjutnya
	if($kedua == 0){
		$pertama+=1;
		$kedua = 0;
	}else{
		$kedua+=1;
		if(!isset($_SESSION['rule'][$pertama][$kedua])){
			$pertama+=1;
			$kedua = 0;
		}
	}

	// data gejala selanjutnya
	$gejala_selanjutnya = $_SESSION['rule'][$pertama][$kedua];
	
	// update session rule gejala 
	$_SESSION['pertama'] = $pertama;
	$_SESSION['kedua'] = $kedua;

	// periksa apakah ada gejala selanjutnya
	if(isset($gejala_selanjutnya)){
		// jika ada, maka alihkan ke pertanyaan selanjutnya
		header("location:diagnosa_mulai.php?id=$id_user&gejala=$gejala_selanjutnya");
	}else{
		// jika tidak ada, maka cari alternatif yaang mendekati

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
	}

}

?>
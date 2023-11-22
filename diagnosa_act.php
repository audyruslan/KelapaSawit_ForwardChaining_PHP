<?php
include 'koneksi.php';

$stt=0; $id_terakhir=''; $sql='';
if (!empty($_POST['nama'])) {
	// delete tmp_kecocokan
	$delete = mysqli_query($koneksi, "DELETE FROM tmp_kecocokan");
	if ($delete) {
		// data user
		$nama = $_POST['nama'];
		$hp   = $_POST['hp'];

		$insert_user = mysqli_query($koneksi, "INSERT INTO user VALUES (null,'$nama','$hp',null)");
		if ($insert_user) {
			$id_terakhir = mysqli_insert_id($koneksi);
			$a = mysqli_query($koneksi, "SELECT alternatif.alt_inisial, gejala.gej_inisial, kecocokan.kec_nilai FROM kecocokan,gejala,alternatif WHERE kecocokan.kec_gejala=gejala.gej_id AND kecocokan.kec_alternatif=alternatif.alt_id ORDER BY
				CASE WHEN alternatif.alt_inisial REGEXP '^[A-Z]{2}'
            THEN 1
            ELSE 0
        END ASC,
        CASE WHEN alternatif.alt_inisial REGEXP '^[A-Z]{2}'
            THEN LEFT(alternatif.alt_inisial, 2)
            ELSE LEFT(alternatif.alt_inisial, 1)
        END ASC,
        CASE WHEN alternatif.alt_inisial REGEXP '^[A-Z]{2}'
            THEN CAST(RIGHT(alternatif.alt_inisial, LENGTH(alternatif.alt_inisial) - 2) AS SIGNED)
            ELSE CAST(RIGHT(alternatif.alt_inisial, LENGTH(alternatif.alt_inisial) - 1) AS SIGNED)
        END ASC");
			while($aa=mysqli_fetch_array($a)){
				$alternatif = $aa['alt_inisial'];
				$gejala     = $aa['gej_inisial'];
				$nilai      = $aa['kec_nilai'];
				$sql       .= "INSERT INTO tmp_kecocokan VALUES ('$alternatif','$gejala','$nilai');";
			}
			if ($sql!='') {
				if (mysqli_multi_query($koneksi, $sql)) {
					$stt=1;
				}else{
					$delete = mysqli_query($koneksi, "DELETE FROM user WHERE user_id='$id_terakhir'");
				}
			}
		}

	}
}

echo json_encode(array('stt'=>$stt ,'id'=>$id_terakhir));
// header("location:diagnosa_mulai.php?id=$id_terakhir");
?>

<?php
include 'koneksi.php';
session_start();

// Menangkap data yang dikirim dari form
$id_user = $_REQUEST['id_user'];
$inisial = $_POST['inisial'];
$jawaban = $_POST['jawaban'];

// Cek apakah user ini sudah pernah menginput jawaban
$cek = mysqli_query($koneksi, "SELECT * FROM user_input WHERE user='$id_user' AND gejala='$inisial'");
$num_rows = mysqli_num_rows($cek);

// Deklarasi data session ke variabel
$urutan = $_SESSION['urutan'];
$pertama = $_SESSION['pertama'];
$kedua = $_SESSION['kedua'];

// Inisialisasi array untuk menyimpan data gejala dan nilai yang dipilih
$data_gejala_nilai = isset($_SESSION['data_gejala_nilai']) ? $_SESSION['data_gejala_nilai'] : [];

// Jika belum, simpan jawaban yang dipilih user ke tabel user_input
if ($num_rows == 0) {
    mysqli_query($koneksi, "INSERT INTO user_input VALUES(null,'$id_user','$inisial','$jawaban')");
} else {
    // Jika jawaban yang dipilih adalah "Tidak" dan data gejala sebelumnya sudah ada, hapus data sebelumnya
    if ($jawaban == "0") {
        // Hapus elemen terakhir dari array inputan
        array_pop($_SESSION['inputan']);
        // Hapus elemen terakhir dari array data_gejala_nilai
        array_pop($data_gejala_nilai);

        // Jika tombol "Kembali" ditekan setelah mengganti jawaban dari "Ya" menjadi "Tidak",
        // kita harus mengupdate pertama dan kedua kembali ke aturan sebelumnya.
        if ($_SESSION['data_gejala_nilai']) {
            $data_sebelumnya = end($data_gejala_nilai);
            $inisial_sebelumnya = $data_sebelumnya['gejala'];
            $jawaban_sebelumnya = $data_sebelumnya['nilai'];

            // Cek apakah gejala sebelumnya sama dengan gejala saat ini
            if ($inisial_sebelumnya == $inisial) {
                // Jika jawaban sebelumnya adalah "Ya" dan jawaban saat ini "Tidak",
                // maka kita perlu mengembalikan aturan ke sebelumnya
                if ($jawaban_sebelumnya == "1" && $jawaban == "0") {
                    $pertama_sebelumnya = $_SESSION['pertama'];
                    $kedua_sebelumnya = $_SESSION['kedua'];

                    // Update session rule gejala
                    $_SESSION['pertama'] = $pertama_sebelumnya;
                    $_SESSION['kedua'] = $kedua_sebelumnya;

                    // Alihkan ke form pertanyaan, dengan mengirim data gejala yang akan ditanyakan
                    header("location:diagnosa_mulai.php?id=$id_user&gejala=$inisial_sebelumnya");
                    exit(); // Penting: Menghentikan eksekusi script setelah melakukan redirect
                }
            }
        }
    }
}

// Tambahkan data gejala dan nilai yang dipilih ke dalam array
$data_gejala_nilai[] = [
    'gejala' => $inisial,
    'nilai' => $jawaban
];

// Tambahkan data gejala dan nilai yang dipilih ke dalam session
$_SESSION['data_gejala_nilai'] = $data_gejala_nilai;

// Aturan untuk menentukan gejala selanjutnya
if ($jawaban == "1") {
    // Simpan data inputan user ke variabel inputan
    $_SESSION['inputan'][$urutan] = $inisial;

    // Hapus elemen terakhir dari array inputan
    array_pop($_SESSION['inputan']);

    // Tentukan batas jumlah rule forward chaining
    $batas = count($_SESSION['rule'][$pertama]) - 1;

    // Aturan untuk menentukan gejala selanjutnya
    if ($kedua < $batas) {
        $kedua += 1;
    } else {
        $pertama += 1;
        $kedua = 0;
    }

    // Simpan data gejala selanjutnya
    $gejala_selanjutnya = $_SESSION['rule'][$pertama][$kedua];

    // Update session rule gejala
    $_SESSION['pertama'] = $pertama;
    $_SESSION['kedua'] = $kedua;

    // Cek jika gejala selanjutnya ditemukan
    if (isset($gejala_selanjutnya)) {
        // Alihkan ke form pertanyaan, dengan mengirim data gejala yang akan ditanyakan
        header("location:diagnosa_mulai.php?id=$id_user&gejala=$gejala_selanjutnya");
    } else {
        // Jika tidak ada gejala selanjutnya, alihkan ke halaman hasil diagnosa
        header("location:diagnosa_hasil.php?id=$id_user");
    }
} elseif ($jawaban == "0") {
    // Simpan data inputan user ke variabel inputan
    $inputan = $_SESSION['inputan'];

    // Hapus elemen terakhir dari array inputan
    array_pop($inputan);

    // Aturan untuk menentukan gejala selanjutnya
    if ($kedua > 0) {
        $kedua -= 1;
    } else {
        if ($pertama > 0) {
            $pertama -= 1;
            $kedua = count($_SESSION['rule'][$pertama]) - 1;
        }
    }

    // Data gejala selanjutnya
    $gejala_selanjutnya = $_SESSION['rule'][$pertama][$kedua];

    // Update session rule gejala
    $_SESSION['pertama'] = $pertama;
    $_SESSION['kedua'] = $kedua;

    // Cek jika gejala selanjutnya ditemukan
    if (isset($gejala_selanjutnya)) {
        // Alihkan ke form pertanyaan, dengan mengirim data gejala yang akan ditanyakan
        header("location:diagnosa_mulai.php?id=$id_user&gejala=$gejala_selanjutnya");
    } else {
        // Jika tidak ada gejala selanjutnya, alihkan ke halaman hasil diagnosa
        header("location:diagnosa_hasil.php?id=$id_user");
    }
}
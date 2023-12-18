<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Diagnosa Gejala</title>
</head>

<body>
    <div class="container">
        <a href="#" class="btn btn-primary float-end" onclick="kembali()">Kembali</a>
        <div class="row text-center mt-5">
            <h3 class="mb-5" id="gejalaTitle">Gejala 1</h3>
            <div class="col-md-6">
                <button class="btn btn-success" onclick="handleButtonClick(1)">Ya</button>
            </div>
            <div class="col-md-6">
                <button class="btn btn-danger" onclick="handleButtonClick(0)">Tidak</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script>
    var gejalaArray = [];
    var pilihGejalaIndex = 0;

    // Data gejala
    var gejalaData = [
        "Gejala 1",
        "Gejala 2",
        "Gejala 3",
        "Gejala 4",
        "Gejala 5",
        "Gejala 6",
        "Gejala 7",
        "Gejala 8",
        "Gejala 9",
        "Gejala 10"
    ];

    function handleButtonClick(nilai) {
        var indexAda = cekIndex(gejalaData[pilihGejalaIndex]);

        //jika datanya sudah ada ubah nilai sebelumnya 
        if (indexAda !== -1) {
            gejalaArray[indexAda].nilai = nilai;
        } else {
            // Jika datanya belum ada, tambahkan ke dalam array
            gejalaArray.push({
                "kode_gejala": gejalaData[pilihGejalaIndex],
                "nilai": nilai
            });
        }

        console.log(gejalaArray);

        // Pindah ke data berikutnya jika masih ada
        if (pilihGejalaIndex < gejalaData.length - 1) {
            pilihGejalaIndex++;
            updateGejala();
        } else {
            console.log("Diagnosa selesai");
        }
    }

    function cekIndex(kodeGejala) {
        for (var i = 0; i < gejalaArray.length; i++) {
            if (gejalaArray[i].kode_gejala === kodeGejala) {
                return i;
            }
        }
        return -1;
    }

    function kembali() {
        if (pilihGejalaIndex > 0) {
            pilihGejalaIndex--;
            updateGejala();
        }
    }

    function updateGejala() {
        document.getElementById("gejalaTitle").innerText = gejalaData[pilihGejalaIndex];
    }
    </script>
</body>

</html>
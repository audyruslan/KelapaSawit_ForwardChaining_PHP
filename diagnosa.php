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

        </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-4">

                    <h2 class="mb-4">Isi data berikut</h2>

                    <form action="javascript:simpan_data()" method="post" data-toggle="validator" data-focus="false">

                        <div class="form-group mb-3">
                            <label class="label-control fw-semibold mb-2" for="nemail">Nama Lengkap</label>
                            <input class="form-control" placeholder="Nama lengkap" autocomplete="off" type="text" name="nama" id="nama" required>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="label-control fw-semibold mb-2" for="nemail">Nomor HP</label>
                            <input class="form-control" placeholder="Nomor HP" autocomplete="off" type="number" name="hp" id="hp" required>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group mb-3 d-grid">
                            <button type="submit" class="btn btn-info btn-block" id="btnsimpan">SIMPAN</button>
                        </div>

                    </form>
                </div>
            </div>

            <br>
            <br>
        </div>
    </section>

</main><!-- End #main -->



<script type="text/javascript">
    function simpan_data(){
        nama = $('#nama');
        hp   = $('#hp');
        btnsimpan = $('#btnsimpan');
        btnsimpan.html('Proses Simpan . . .');
        nama.attr('readonly', true);
        hp.attr('readonly', true);
        btnsimpan.attr('disabled', true);
        $.ajax({
            type: "POST",
            url : "diagnosa_act.php",
            data: "nama="+nama.val()+'&hp='+hp.val(),
            dataType: "json",
            beforeSend: function(){ },
            success: function( data ) {
                if (data.stt==1){
                    window.location.href = "diagnosa_mulai.php?id="+data.id;
                }else {
                    btnsimpan.html('SIMPAN');
                    nama.removeAttr('readonly');
                    hp.removeAttr('readonly');
                    btnsimpan.removeAttr('disabled');
                    alert("Gagal, Silahkan coba lagi!");
                }
            },
            error: function(){
                btnsimpan.html('SIMPAN');
                nama.removeAttr('readonly');
                hp.removeAttr('readonly');
                btnsimpan.removeAttr('disabled');
                alert("Ada kesalahan, silahkan coba lagi!");
            }
        });
    }
</script>

<?php include 'footer.php'; ?>
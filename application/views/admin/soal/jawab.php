<!-- Begin Page Content -->
<div class="container-fluid">
    <?php
    if ($this->session->flashdata('sukses')) {
        echo '<div class="alert alert-success">';
        echo $this->session->flashdata('sukses');
        echo '</div>';
    }
    //error validasi
    echo validation_errors('<div class="alert alert-warning">', '</div>'); ?>

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?php echo $title; ?></h1>

    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                </div>
                <div class="card-body">
                    <p style="text-align: right; font-weight: bold;" id="demo"></p>
                    <?php echo form_open(base_url('soal/nilai'));
                    $nomor_soal = 0; ?>
                    <?php $x = 1;
                    foreach ($soal as $row) { ?>
                        <?php $ans_array = array($row->jawaban, $row->pilihan1, $row->pilihan2, $row->pilihan3);
                        shuffle($ans_array); ?>
                        <p><?php echo $nomor_soal = $nomor_soal + 1; ?>. <?php echo $row->pertanyaan ?></p>
                        <input type="hidden" name="id_soal<?php echo $nomor_soal ?>" value="<?php echo $row->id_soal ?>">
                        <input type="hidden" name="id_materi" value="<?php echo $row->id_materi ?>">
                        <input class="flat-red" type="radio" name="jawaban<?php echo $nomor_soal ?>" value="<?php echo $ans_array[0] ?>"> <?php echo $ans_array[0] ?><br>
                        <input class="flat-red" type="radio" name="jawaban<?php echo $nomor_soal ?>" value="<?php echo $ans_array[1] ?>"> <?php echo $ans_array[1] ?><br>
                        <input class="flat-red" type="radio" name="jawaban<?php echo $nomor_soal ?>" value="<?php echo $ans_array[2] ?>"> <?php echo $ans_array[2] ?><br>
                        <input class="flat-red" type="radio" name="jawaban<?php echo $nomor_soal ?>" value="<?php echo $ans_array[3] ?>"> <?php echo $ans_array[3] ?><br><br>
                    <?php $x = $x + 1;
                    } ?>
                    <input type="submit" name="submit" class="btn btn-success btn-sm" value="Selesai" id="btnSignIn" />
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<script>
    // Set the date we're counting down to
    var countDownDate = new Date("<?php echo $materi->waktu_selesai ?>").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get todays date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"
        document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
            minutes + "m " + seconds + "s ";

        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById('btnSignIn').click();
        }
    }, 1000);
</script>
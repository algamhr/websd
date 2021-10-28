<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?php echo $title; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 col-md-6">
        <div class="card-header py-3">
            <a href="<?php echo base_url('countdown/show'); ?>" class="btn btn-primary btn-sm" style="text-align: left;"><i class="fa fa-calendar-times"></i> Go</a>
        </div>
        <div class="card-body">
            <?php
            echo form_open(base_url('countdown'));
            ?>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date">Tanggal (mm/dd/yyyy)</label>
                            <input type="text" class="form-control form-control-sm" name="date" id="date" value="<?php echo date('m/d/Y', strtotime($countdown->waktu)); ?>" placeholder="dd/mm/yyyy" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="time">Waktu (H:i:s)</label>
                            <input type="text" class="form-control form-control-sm" placeholder="H:i:s" name="time" id="time" value="<?php echo date('H:i:s', strtotime($countdown->waktu)); ?>" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-block btn-sm">Simpan</button>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
    <div class="card shadow mb-4 col-md-6" style="max-height: 200px;">
        <div class="card-body">
            <h1 style="text-align: center; font-weight: bold;" id="demo"></h1>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<script>
    // Set the date we're counting down to
    var countDownDate = new Date("<?php echo $countdown->waktu ?>").getTime();

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
            // window.location = ""; //kondisi pindah halaman otomatis
            // document.getElementById('btnSignIn').click(); //kondisi tombol ditekan otomatis
        }
    }, 1000);
</script>
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
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
            <?php echo form_open(base_url('lokasi')); ?>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="3" autofocus required><?php echo $lokasi->alamat; ?></textarea>
            </div>
            <br>
            <button type="reset" class="btn btn-secondary btn-sm">Reset</button>
            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            <?php echo form_close(); ?>
        </div>
    </div>
    <?php echo $lokasi->alamat; ?>

</div>
<!-- /.container-fluid -->
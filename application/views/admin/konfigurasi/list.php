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
    <div class="card shadow mb-4 col-md-6">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
            <?php
            echo form_open(base_url('konfigurasi'));
            ?>
            <input type="hidden" name="id" value="<?php echo $konfig->id; ?>">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" class="form-control" name="author" id="author" value="<?php echo $konfig->author; ?>" readonly required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_web">Nama WEB</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                <input type="text" class="form-control" id="nama_web" name="nama_web" placeholder="Nama WEB" aria-label="Username" value="<?php echo $konfig->nama_web; ?>" aria-describedby="basic-addon1" required autofocus>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
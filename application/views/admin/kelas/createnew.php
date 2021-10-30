<script src="<?php echo base_url('asset/tinymce/js/tinymce/tinymce.min.js') ?>" type="text/javascript"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        height: 100,
        theme: 'modern',
        plugins: 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
        toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
        image_advtab: true,
        templates: [{
                title: 'Test template 1',
                content: 'Test 1'
            },
            {
                title: 'Test template 2',
                content: 'Test 2'
            }
        ],
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css'
        ]
    });
</script>
<!-- Begin Page Content -->
<div class="container-fluid">
    <?php echo validation_errors('<div class="alert alert-warning">', '</div>'); ?>


    <?php if (isset($error)) {
        echo '<div class="alert alert-warning">';
        echo $error;
        echo '</div>';
    }
    ?>

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?php echo $title; ?></h1>

    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a href="<?php echo base_url('kelas'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <?php echo form_open_multipart(base_url('materi/tambah')); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_kelas">Nama Kelas</label>
                                <input type="text" class="form-control form-control-sm" name="nama_kelas" id="nama_kelas" value="<?php echo set_value('nama_kelas'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_kelas">Jumlah Pelajar</label>
                                <input type="number" class="form-control form-control-sm" name="jumlah_kelas" id="jumlah_kelas" value="<?php echo set_value('jumlah_kelas'); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="nk-int-st cmp-int-in cmp-email-over">
                                    <label>Daftar Guru</label>

                                    <select class="form-control" id="daftar_guru" name="daftar_guru" multiple>
                                        <?php foreach ($user as $user) { ?>
                                            <option value="<?php echo $user->id; ?>"><?php echo $user->name; ?></option>
                                        <?php } ?>
                                        <!-- <option value="draft">Draft</option>
                                        <option value="publish">Publish</option> -->
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
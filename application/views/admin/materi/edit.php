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
                    <a href="<?php echo base_url('materi'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <?php echo form_open_multipart(base_url('materi/edit/' . $materi->id_materi)); ?>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <div class="nk-int-st cmp-int-in cmp-email-over">
                                    <label>Judul Materi</label>
                                    <input type="text" class="form-control" placeholder="Judul Materi" name="nama_materi" value="<?php echo $materi->nama_materi; ?>" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="nk-int-st cmp-int-in cmp-email-over">
                                    <label>Status Materi</label>
                                    <select class="form-control" id="status_materi" name="status_materi">
                                        <option value="draft">Draft</option>
                                        <option value="publish" <?php if ($materi->status_materi == "publish") {
                                                                    echo "selected";
                                                                } ?>>Publish</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="nk-int-st cmp-int-in cmp-email-over">
                                    <label>Kelas</label>
                                    <select class="form-control form-control-sm" id="id_kelas" name="id_kelas">
                                        <?php foreach ($kelas as $kelas) { ?>
                                            <option value="<?php echo $kelas->id; ?>" <?php if ($kelas->id == $materi->id_kelas) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $kelas->nama_kelas; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="nk-int-st cmp-int-in cmp-email-over">
                                    <label>Pelajaran</label>
                                    <select class="form-control form-control-sm" id="id_pelajaran" name="id_pelajaran">
                                        <?php foreach ($pelajaran as $pelajaran) { ?>
                                            <option value="<?php echo $pelajaran->id; ?>" <?php if ($pelajaran->id == $materi->id_pelajaran) {
                                                                                                echo "selected";
                                                                                            } ?>><?php echo $pelajaran->nama_pelajaran; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="nk-int-st cmp-int-in cmp-email-over">
                                    <label>Upload Materi</label>
                                    <input type="file" name="gambar" id="file" multiple>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group">
                                <div class="nk-int-st cmp-int-in cmp-email-over">
                                    <label>Waktu Mulai</label>
                                    <input type="datetime" class="form-control" name="waktu_mulai" placeholder="yyyy-mm-dd 00:00:00" value="<?php echo $materi->waktu_mulai; ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group">
                                <div class="nk-int-st cmp-int-in cmp-email-over">
                                    <label>Waktu Selesai</label>
                                    <input type="datetime" class="form-control" name="waktu_selesai" placeholder="yyyy-mm-dd 00:00:00" value="<?php echo $materi->waktu_selesai; ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group">
                                <div class="nk-int-st cmp-int-in cmp-email-over">
                                    <label>Nilai / Soal Materi</label>
                                    <input type="number" class="form-control" name="nilai_soal" placeholder="Nilai Soal" value="<?php echo $materi->nilai_soal; ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <label>Link Youtube</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">https://www.youtube.com/embed/</span>
                                </div>
                                <input type="text" name="video_materi" value="<?php echo $materi->video_materi; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-11 col-md-10 col-sm-10 col-xs-12">
                            <div class="form-group cmp-em-mg">
                                <div class="nk-int-st cmp-int-in cmp-email-over">
                                    <label>Keterangan Materi</label>
                                    <textarea class="form-control" name="keterangan_materi"><?php echo $materi->keterangan_materi; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-11 col-md-10 col-sm-10 col-xs-12">
                            <div class="form-group">
                                <div class="nk-int-st cmp-int-in cmp-email-over">
                                    <input type="submit" value="Simpan" class="btn btn-primary btn-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
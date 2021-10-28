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
                    <a href="<?php echo base_url('materi'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <?php if (($materi->waktu_mulai != "0000-00-00 00:00:00" || $materi->waktu_selesai != "0000-00-00 00:00:00") && $this->session->userdata('akses_level') == 1) { ?>
                        <a style="color: white;" href="<?php echo base_url('soal/countdown_soal/' . $materi->id_materi); ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Jawab Soal</a>
                    <?php } ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td>Judul Materi</td>
                                    <td><?php echo $materi->nama_materi; ?></td>
                                </tr>
                                <tr>
                                    <td>Kelas</td>
                                    <td><?php echo $materi->nama_kelas; ?></td>
                                </tr>
                                <tr>
                                    <td>Pelajaran</td>
                                    <td><?php echo $materi->nama_pelajaran; ?></td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td><?php echo $materi->keterangan_materi; ?></td>
                                </tr>
                                <tr>
                                    <td>Waktu Mulai Ujian</td>
                                    <td><?php echo date("d M Y, H:i:s", strtotime($materi->waktu_mulai)); ?></td>
                                </tr>
                                <?php if ($materi->video_materi != NULL) { ?>
                                    <tr>
                                        <td colspan="2">Video Materi</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align:center">
                                            <iframe width="853" height="480" src="https://www.youtube.com/embed/<?php echo $materi->video_materi ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?php echo base_url('materi/download/' . $materi->id_materi); ?>" class="btn btn-dark btn-sm"><i class="fa fa-download"></i> Download Materi</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
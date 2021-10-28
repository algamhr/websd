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
                    <a href="<?php echo base_url('soal'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <?php echo form_open_multipart(base_url('soal/edit/' . $soal->id_soal)); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="nk-int-st cmp-int-in cmp-email-over">
                                    <label>Pertanyaan</label>
                                    <textarea class="form-control" name="pertanyaan" required><?php echo $soal->pertanyaan; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="nk-int-st cmp-int-in cmp-email-over">
                                    <label>Kelas</label>
                                    <select class="form-control" name="id_kelas">
                                        <?php foreach ($kelas as $kelas) { ?>
                                            <option value="<?php echo $kelas->id ?>" <?php if ($soal->id_kelas == $kelas->id) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $kelas->nama_kelas; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <div class="nk-int-st cmp-int-in cmp-email-over">
                                    <label>Judul Materi</label>
                                    <select class="form-control" name="id_materi">
                                        <?php foreach ($materi as $materi) { ?>
                                            <option value="<?php echo $materi->id_materi ?>" <?php if ($soal->id_materi == $materi->id_materi) {
                                                                                                    echo "selected";
                                                                                                } ?>><?php echo $materi->nama_materi ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="nk-int-st cmp-int-in cmp-email-over">
                                    <label>Jawaban Benar</label>
                                    <input type="tex" class="form-control" placeholder="Jawaban Benar" name="jawaban" value="<?php echo $soal->jawaban; ?>" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="nk-int-st cmp-int-in cmp-email-over">
                                    <label>Jawaban Salah</label>
                                    <input type="tex" class="form-control" placeholder="Jawaban Salah" name="pilihan1" value="<?php echo $soal->pilihan1; ?>" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="nk-int-st cmp-int-in cmp-email-over">
                                    <label>Jawaban Salah</label>
                                    <input type="tex" class="form-control" placeholder="Jawaban Salah" name="pilihan2" value="<?php echo $soal->pilihan2; ?>" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="nk-int-st cmp-int-in cmp-email-over">
                                    <label>Jawaban Salah</label>
                                    <input type="tex" class="form-control" placeholder="Jawaban Salah" name="pilihan3" value="<?php echo $soal->pilihan3; ?>" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="nk-int-st cmp-int-in cmp-email-over">
                                    <label>Upload Penjelasan Jawaban</label>
                                    <input type="file" name="gambar" id="file" multiple>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="nk-int-st cmp-int-in cmp-email-over">
                                    <input type="submit" class="btn btn-primary btn-sm" value="Simpan">
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
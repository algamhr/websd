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
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td style="font-weight: bold; width: 200px;">Nama</td>
                            <td><?php echo $nilai->name; ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Kelas</td>
                            <td><?php echo $nilai->nama_kelas; ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Pelajaran</td>
                            <td><?php echo $nilai->nama_pelajaran; ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Subject Materi</td>
                            <td><b><a href="<?php echo base_url('materi/baca/' . $nilai->slug_materi); ?>"><?php echo $nilai->nama_materi; ?></a></b></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Tanggal</td>
                            <td><?php echo date("d F Y"); ?></td>
                        </tr>
                        <tr>
                            <td>Jumlah Soal</td>
                            <td><?php echo $nilai->jumlah_soal; ?></td>
                        </tr>
                        <tr>
                            <td>Jawaban Benar</td>
                            <td><?php echo $nilai->jawaban_benar ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Nilai Akhir</td>
                            <td>
                                <p style="font-size: 50px; padding-top: 20px; color: #3F51B5;"><?php echo $nilai->nilai_akhir ?></p>
                            </td>
                        </tr>
                    </table>
                    <br>
                    <hr>
                    <h2>Kunci Jawaban</h2>
                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Pertanyaan</th>
                                    <th>Jawaban Benar</th>
                                    <th>Penjelasan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nomor_soal = 0;
                                foreach ($soal as $soal) {
                                    $nomor_soal = $nomor_soal + 1; ?>
                                    <tr>
                                        <td><?php echo $nomor_soal; ?></td>
                                        <td><?php echo $soal->pertanyaan; ?></td>
                                        <td><?php echo $soal->jawaban; ?></td>
                                        <td>
                                            <?php if ($soal->gambar != NULL || $soal->gambar != "") { ?>
                                                <a href="<?php echo base_url('soal/download/' . $soal->id_soal); ?>" class="btn btn-dark btn-sm"><i class="fa fa-download"></i>
                                                <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
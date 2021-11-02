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
        <?php if ($this->session->userdata('id') == $profile_edit->id) { ?>
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <?php include('update_password.php'); ?>
                    </div>
                    <div class="card-body">
                        <?php echo form_open_multipart(base_url('profile/detail/' . $profile_edit->id)); ?>
                        <div class="form-group">
                            <label for="name">Profil User</label><br>
                            <?php if ($profile_edit->gambar != null) { ?>
                                <img height="100px" width="100px" class="gambar mb-2" name="gambar" src="<?php echo base_url(); ?>asset/upload/image/<?php echo $profile_edit->gambar; ?>">
                            <?php } else { ?>
                                <img height="100px" width="100px" class="gambar mb-2" name="gambar" src="<?php echo base_url(); ?>asset/upload/image/user.png">
                            <?php } ?>
                            <input type="file" class="form-control form-control-sm" name="gambar" id="gambar" value="">
                        </div>

                        <?php if ($this->session->userdata('akses_level') == '1') { ?>
                            <div class="form-group">
                                <label for="id_kelas">Kelas</label>
                                <input type="text" class="form-control form-control-sm" name="id_kelas" id="id_kelas" value="<?php echo $profile_edit->nama_kelas; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nisn">NISN</label>
                                <input type="text" class="form-control form-control-sm" name="nisn" id="nisn" value="<?php echo $profile_edit->nisn ?>" required>
                            </div>
                        <?php } ?>

                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control form-control-sm" name="name" id="name" value="<?php echo $profile_edit->name ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control form-control-sm" name="username" id="username" value="<?php echo $profile_edit->username ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="draft">Laki-laki</option>
                                <option value="publish">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="agama">Agama</label>
                            <select class="form-control" id="agama" name="agama">
                                <option value="draft">Islam</option>
                                <option value="publish">Budha</option>
                                <option value="publish">Kristen</option>
                                <option value="publish">Katholik</option>
                                <option value="publish">Hindu</option>
                            </select>
                        </div>
                        <br>
                        <button type="reset" class="btn btn-secondary btn-sm">Reset</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <a href="<?php echo base_url('kelas'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                    <div class="card-body">
                        <?php echo form_open(base_url('profile/detail/' . $profile->id)); ?>
                        <div class="form-group">
                            <label for="name">Profil User</label><br>
                            <img height="100px" width="100px" class="gambar mb-2" name="gambar" src="<?php echo base_url(); ?>asset/upload/image/user.png">
                        </div>
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control form-control-sm" name="name" id="name" value="<?php echo $profile->name ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control form-control-sm" name="username" id="username" value="<?php echo $profile->username ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="id_kelas">Kelas</label>
                            <input type="text" class="form-control form-control-sm" name="id_kelas" id="id_kelas" value="<?php echo $profile->nama_kelas ?>" readonly>
                        </div>
                        <br>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            Nilai Pelajaran (Rata-rata Nilai Materi Per Pelajaran)
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Pelajaran</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pelajaran as $pelajaran) { ?>
                                            <tr>
                                                <td><?php echo $pelajaran->nama_pelajaran; ?></td>
                                                <td><?php echo $pelajaran->nilai_pelajaran; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        Detail Nilai Pelajaran
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Materi</th>
                                        <th>Pelajaran</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($nilai as $nilai) { ?>
                                        <tr>
                                            <td><?php echo $nilai->nama_materi; ?></td>
                                            <td><?php echo $nilai->nama_pelajaran; ?></td>
                                            <td><?php echo $nilai->nilai_akhir; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>


</div>
<!-- /.container-fluid -->
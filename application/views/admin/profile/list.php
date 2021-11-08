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
                        <?php if ($this->session->userdata('akses_level') == '1') { ?>
                            <div class="form-group">
                                <label for="id_kelas">Kelas</label>
                                <input type="text" class="form-control form-control-sm" name="id_kelas" id="id_kelas" value="<?php echo $profile_edit->nama_kelas; ?>" readonly>
                            </div>
                        <?php } elseif ($this->session->userdata('akses_level') == '2') { ?>
                            <div class="form-group">
                                <label for="id_kelas">Kelas</label>
                                <?php if ($profile->akses_level == 2) { ?>
                                    <select class="form-control bootstrap-select" id="kelas" name="kelas[]" multiple disabled>
                                        <option value="kelas1a" <?php if ($profile->kelas1a == "kelas1a") {
                                                                    echo "selected";
                                                                } ?>>Kelas 1 A</option>
                                        <option value="kelas1b" <?php if ($profile->kelas1b == "kelas1b") {
                                                                    echo "selected";
                                                                } ?>>Kelas 1 B</option>
                                        <option value="kelas1c" <?php if ($profile->kelas1c == "kelas1c") {
                                                                    echo "selected";
                                                                } ?>>Kelas 1 C</option>
                                        <option value="kelas2a" <?php if ($profile->kelas2a == "kelas2a") {
                                                                    echo "selected";
                                                                } ?>>Kelas 2 A</option>
                                        <option value="kelas2b" <?php if ($profile->kelas2b == "kelas2b") {
                                                                    echo "selected";
                                                                } ?>>Kelas 2 B</option>
                                        <option value="kelas2c" <?php if ($profile->kelas2c == "kelas2c") {
                                                                    echo "selected";
                                                                } ?>>Kelas 2 C</option>
                                        <option value="kelas3a" <?php if ($profile->kelas3a == "kelas3a") {
                                                                    echo "selected";
                                                                } ?>>Kelas 3 A</option>
                                        <option value="kelas3b" <?php if ($profile->kelas3b == "kelas3b") {
                                                                    echo "selected";
                                                                } ?>>Kelas 3 B</option>
                                        <option value="kelas3c" <?php if ($profile->kelas3c == "kelas3c") {
                                                                    echo "selected";
                                                                } ?>>Kelas 3 C</option>
                                        <option value="kelas4a" <?php if ($profile->kelas4a == "kelas4a") {
                                                                    echo "selected";
                                                                } ?>>Kelas 4 A</option>
                                        <option value="kelas4b" <?php if ($profile->kelas4b == "kelas4b") {
                                                                    echo "selected";
                                                                } ?>>Kelas 4 B</option>
                                        <option value="kelas4c" <?php if ($profile->kelas4c == "kelas4c") {
                                                                    echo "selected";
                                                                } ?>>Kelas 4 C</option>
                                        <option value="kelas5a" <?php if ($profile->kelas5a == "kelas5a") {
                                                                    echo "selected";
                                                                } ?>>Kelas 5 A</option>
                                        <option value="kelas5b" <?php if ($profile->kelas5b == "kelas5b") {
                                                                    echo "selected";
                                                                } ?>>Kelas 5 B</option>
                                        <option value="kelas5c" <?php if ($profile->kelas5c == "kelas5c") {
                                                                    echo "selected";
                                                                } ?>>Kelas 5 C</option>
                                        <option value="kelas6a" <?php if ($profile->kelas6a == "kelas6a") {
                                                                    echo "selected";
                                                                } ?>>Kelas 6 A</option>
                                        <option value="kelas6b" <?php if ($profile->kelas6b == "kelas6b") {
                                                                    echo "selected";
                                                                } ?>>Kelas 6 B</option>
                                        <option value="kelas6c" <?php if ($profile->kelas6c == "kelas6c") {
                                                                    echo "selected";
                                                                } ?>>Kelas 6 C</option>
                                    </select>
                                <?php } else { ?>
                                    <input type="text" class="form-control form-control-sm" name="id_kelas" id="id_kelas" value="<?php echo $profile->nama_kelas ?>" readonly>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="L">Laki-laki</option>
                                <option value="P" <?php if ($profile_edit->jenis_kelamin == "P") {
                                                        echo "selected";
                                                    } ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="agama">Agama</label>
                            <select class="form-control" id="agama" name="agama">
                                <option value="islam">Islam</option>
                                <option value="budha" <?php if ($profile_edit->agama == "budha") {
                                                            echo "selected";
                                                        } ?>>Budha</option>
                                <option value="kristen" <?php if ($profile_edit->agama == "kristen") {
                                                            echo "selected";
                                                        } ?>>Kristen</option>
                                <option value="katholik" <?php if ($profile_edit->agama == "katholik") {
                                                                echo "selected";
                                                            } ?>>Katholik</option>
                                <option value="hindu" <?php if ($profile_edit->agama == "hindu") {
                                                            echo "selected";
                                                        } ?>>Hindu</option>
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
                            <?php if ($profile->akses_level == 2) { ?>
                                <select class="form-control bootstrap-select" id="kelas" name="kelas[]" multiple disabled>
                                    <option value="kelas1a" <?php if ($profile->kelas1a == "kelas1a") {
                                                                echo "selected";
                                                            } ?>>Kelas 1 A</option>
                                    <option value="kelas1b" <?php if ($profile->kelas1b == "kelas1b") {
                                                                echo "selected";
                                                            } ?>>Kelas 1 B</option>
                                    <option value="kelas1c" <?php if ($profile->kelas1c == "kelas1c") {
                                                                echo "selected";
                                                            } ?>>Kelas 1 C</option>
                                    <option value="kelas2a" <?php if ($profile->kelas2a == "kelas2a") {
                                                                echo "selected";
                                                            } ?>>Kelas 2 A</option>
                                    <option value="kelas2b" <?php if ($profile->kelas2b == "kelas2b") {
                                                                echo "selected";
                                                            } ?>>Kelas 2 B</option>
                                    <option value="kelas2c" <?php if ($profile->kelas2c == "kelas2c") {
                                                                echo "selected";
                                                            } ?>>Kelas 2 C</option>
                                    <option value="kelas3a" <?php if ($profile->kelas3a == "kelas3a") {
                                                                echo "selected";
                                                            } ?>>Kelas 3 A</option>
                                    <option value="kelas3b" <?php if ($profile->kelas3b == "kelas3b") {
                                                                echo "selected";
                                                            } ?>>Kelas 3 B</option>
                                    <option value="kelas3c" <?php if ($profile->kelas3c == "kelas3c") {
                                                                echo "selected";
                                                            } ?>>Kelas 3 C</option>
                                    <option value="kelas4a" <?php if ($profile->kelas4a == "kelas4a") {
                                                                echo "selected";
                                                            } ?>>Kelas 4 A</option>
                                    <option value="kelas4b" <?php if ($profile->kelas4b == "kelas4b") {
                                                                echo "selected";
                                                            } ?>>Kelas 4 B</option>
                                    <option value="kelas4c" <?php if ($profile->kelas4c == "kelas4c") {
                                                                echo "selected";
                                                            } ?>>Kelas 4 C</option>
                                    <option value="kelas5a" <?php if ($profile->kelas5a == "kelas5a") {
                                                                echo "selected";
                                                            } ?>>Kelas 5 A</option>
                                    <option value="kelas5b" <?php if ($profile->kelas5b == "kelas5b") {
                                                                echo "selected";
                                                            } ?>>Kelas 5 B</option>
                                    <option value="kelas5c" <?php if ($profile->kelas5c == "kelas5c") {
                                                                echo "selected";
                                                            } ?>>Kelas 5 C</option>
                                    <option value="kelas6a" <?php if ($profile->kelas6a == "kelas6a") {
                                                                echo "selected";
                                                            } ?>>Kelas 6 A</option>
                                    <option value="kelas6b" <?php if ($profile->kelas6b == "kelas6b") {
                                                                echo "selected";
                                                            } ?>>Kelas 6 B</option>
                                    <option value="kelas6c" <?php if ($profile->kelas6c == "kelas6c") {
                                                                echo "selected";
                                                            } ?>>Kelas 6 C</option>
                                </select>
                            <?php } else { ?>
                                <input type="text" class="form-control form-control-sm" name="id_kelas" id="id_kelas" value="<?php echo $profile->nama_kelas ?>" readonly>
                            <?php } ?>
                        </div>
                        <br>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <?php if ($profile->akses_level != 2) { ?>
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
        <?php } ?>
    </div>


</div>
<!-- /.container-fluid -->
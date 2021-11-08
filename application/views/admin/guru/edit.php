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
                    <a href="<?php echo base_url('guru'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <?php $attribut = 'class="form-horizontal"';
                    echo form_open(base_url('guru/edit/' . $user->id), $attribut);
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" class="form-control form-control-sm" name="name" id="name" value="<?php echo $user->name; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control form-control-sm" name="username" id="username" value="<?php echo $user->username; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Daftar Guru</label>
                                <select class="form-control bootstrap-select" id="kelas" name="kelas[]" multiple>
                                    <option value="kelas1a" <?php if ($user->kelas1a == "kelas1a") {
                                                                echo "selected";
                                                            } ?>>Kelas 1 A</option>
                                    <option value="kelas1b" <?php if ($user->kelas1b == "kelas1b") {
                                                                echo "selected";
                                                            } ?>>Kelas 1 B</option>
                                    <option value="kelas1c" <?php if ($user->kelas1c == "kelas1c") {
                                                                echo "selected";
                                                            } ?>>Kelas 1 C</option>
                                    <option value="kelas2a" <?php if ($user->kelas2a == "kelas2a") {
                                                                echo "selected";
                                                            } ?>>Kelas 2 A</option>
                                    <option value="kelas2b" <?php if ($user->kelas2b == "kelas2b") {
                                                                echo "selected";
                                                            } ?>>Kelas 2 B</option>
                                    <option value="kelas2c" <?php if ($user->kelas2c == "kelas2c") {
                                                                echo "selected";
                                                            } ?>>Kelas 2 C</option>
                                    <option value="kelas3a" <?php if ($user->kelas3a == "kelas3a") {
                                                                echo "selected";
                                                            } ?>>Kelas 3 A</option>
                                    <option value="kelas3b" <?php if ($user->kelas3b == "kelas3b") {
                                                                echo "selected";
                                                            } ?>>Kelas 3 B</option>
                                    <option value="kelas3c" <?php if ($user->kelas3c == "kelas3c") {
                                                                echo "selected";
                                                            } ?>>Kelas 3 C</option>
                                    <option value="kelas4a" <?php if ($user->kelas4a == "kelas4a") {
                                                                echo "selected";
                                                            } ?>>Kelas 4 A</option>
                                    <option value="kelas4b" <?php if ($user->kelas4b == "kelas4b") {
                                                                echo "selected";
                                                            } ?>>Kelas 4 B</option>
                                    <option value="kelas4c" <?php if ($user->kelas4c == "kelas4c") {
                                                                echo "selected";
                                                            } ?>>Kelas 4 C</option>
                                    <option value="kelas5a" <?php if ($user->kelas5a == "kelas5a") {
                                                                echo "selected";
                                                            } ?>>Kelas 5 A</option>
                                    <option value="kelas5b" <?php if ($user->kelas5b == "kelas5b") {
                                                                echo "selected";
                                                            } ?>>Kelas 5 B</option>
                                    <option value="kelas5c" <?php if ($user->kelas5c == "kelas5c") {
                                                                echo "selected";
                                                            } ?>>Kelas 5 C</option>
                                    <option value="kelas6a" <?php if ($user->kelas6a == "kelas6a") {
                                                                echo "selected";
                                                            } ?>>Kelas 6 A</option>
                                    <option value="kelas6b" <?php if ($user->kelas6b == "kelas6b") {
                                                                echo "selected";
                                                            } ?>>Kelas 6 B</option>
                                    <option value="kelas6c" <?php if ($user->kelas6c == "kelas6c") {
                                                                echo "selected";
                                                            } ?>>Kelas 6 C</option>
                                </select>
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
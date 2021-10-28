<a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#editModal<?php echo $user->id; ?>">
    <i class="fa fa-edit"></i>
    Edit
</a>
<!-- Tambah Modal-->
<div class="modal fade" id="editModal<?php echo $user->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <?php $attribut = 'class="form-horizontal"';
            echo form_open(base_url('user/update/' . $user->id), $attribut);
            ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" class="form-control form-control-sm" name="name" id="name" placeholder="Nama Lengkap" value="<?php echo $user->name; ?>" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control form-control-sm" name="username" id="username" placeholder="Username" value="<?php echo $user->username ?>" required>
                </div>
                <div class="form-group">
                    <label for="akses_level">Akses Level</label>
                    <select class="form-control form-control-sm" id="akses_level" name="akses_level">
                        <option value="21">Pengelola</option>
                        <option value="1" <?php if ($user->akses_level == 1) {
                                                echo "selected";
                                            } ?>>Pengguna</option>
                    </select>
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
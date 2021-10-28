<a class="btn btn-warning btn-sm" href="#" data-toggle="modal" data-target="#updatePassword<?php echo $profile_edit->id; ?>">
    <i class="fa fa-key"></i>
    Ubah Password
</a>
<!-- Tambah Modal-->
<div class="modal fade" id="updatePassword<?php echo $profile_edit->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <?php $attribut = 'class="form-horizontal"';
            echo form_open(base_url('profile/ubah_password/' . $profile_edit->id), $attribut);
            ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="password">Password Baru</label>
                    <input type="password" class="form-control form-control-sm" name="password" id="password" value="" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control form-control-sm" name="confirm_password" id="confirm_password" value="" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-warning btn-sm">Simpan</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
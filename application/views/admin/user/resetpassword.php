<a class="btn btn-warning btn-sm" href="#" data-toggle="modal" data-target="#resetpasswordModal<?php echo $user->id; ?>">
    <i class="fa fa-key"></i>
    Password
</a>
<!-- Tambah Modal-->
<div class="modal fade" id="resetpasswordModal<?php echo $user->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Yakin ingin reset password data <b><?php echo $user->name; ?></b> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                <a href="<?php echo base_url('user/reset_password/' . $user->id); ?>" class="btn btn-warning btn-sm">Reset</a>
            </div>
        </div>
    </div>
</div>
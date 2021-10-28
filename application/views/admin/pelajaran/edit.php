<a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#editModal<?php echo $pelajaran->id; ?>">
    <i class="fa fa-edit"></i>
    Edit
</a>
<!-- Tambah Modal-->
<div class="modal fade" id="editModal<?php echo $pelajaran->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Pelajaran</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <?php $attribut = 'class="form-horizontal"';
            echo form_open(base_url('pelajaran/update/' . $pelajaran->id), $attribut);
            ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama_pelajaran">Nama Pelajaran</label>
                    <input type="text" class="form-control form-control-sm" name="nama_pelajaran" id="nama_pelajaran" value="<?php echo $pelajaran->nama_pelajaran; ?>" required>
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
<a class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#tambahModal">
    <i class="fa fa-upload"></i>
    Import Murid
</a>
<!-- Tambah Modal-->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Murid</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <?php $attribut = 'class="form-horizontal"';
            echo form_open(base_url('users_kelas'), $attribut);
            ?>
            <form method="POST" action="<?php echo base_url('users_kelas/excel') ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kelas">Import Data Murid (.excel) </label>
                        <input id="import_murid" name="import_murid" type="file" class="form-control form-control-sm" data-browse-on-zone-click="true" accept=".xls, .xlsx" required>
                        <br>
                        <span class="text-secondary">File yang harus diupload : .xls, xlsx</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" name="import" class="btn btn-primary btn-sm">Simpan</button>
                </div>
                <?php echo form_close(); ?>
            </form>
        </div>
    </div>
</div>
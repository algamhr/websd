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
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <?php if ($this->session->userdata('akses_level') == '21') { ?>
                 <?php include('create.php'); ?>
                 <!-- <a href="<?php echo base_url('kelas/createnew'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah</a> -->
             <?php } ?>
         </div>
         <div class="card-body">
             <div class="table-responsive">
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th>Nama Kelas</th>
                             <th>Aksi</th>
                         </tr>
                     </thead>
                     <?php if($this->session->userdata('akses_level')==21) { ?>
                        <tbody>
                         <?php foreach ($kelas as $kelas) { ?>
                             <tr>
                                 <td><?php echo $kelas->nama_kelas; ?></td>
                                 <td>
                                     <a href="<?php echo base_url('users_kelas/pengguna/' . $kelas->id); ?>" class="btn btn-success btn-sm"><i class="fa fa-users"></i> Murid</a>
                                     <?php if ($this->session->userdata('akses_level') == '21') { ?>
                                         <?php include('edit.php'); ?>
                                         <?php include('delete.php'); ?>
                                     <?php } ?>
                                 </td>
                             </tr>
                         <?php } ?>
                     </tbody>
                    <?php } else { ?>
                        <tbody>
                         <?php foreach ($kelas as $kelas) { ?>
                            <?php if(
                                $kelas->slug_kelas==$user->kelas1a || 
                                $kelas->slug_kelas==$user->kelas2a ||
                                $kelas->slug_kelas==$user->kelas3a 
                                ){ ?>
                             <tr>
                                 <td><?php echo $kelas->nama_kelas; ?></td>
                                 <td>
                                     <a href="<?php echo base_url('users_kelas/pengguna/' . $kelas->id); ?>" class="btn btn-success btn-sm"><i class="fa fa-users"></i> Murid</a>
                                     <?php if ($this->session->userdata('akses_level') == '21') { ?>
                                         <?php include('edit.php'); ?>
                                         <?php include('delete.php'); ?>
                                     <?php } ?>
                                 </td>
                             </tr>
                             <?php } ?>
                         <?php } ?>
                     </tbody>
                    <?php } ?>
                 </table>
             </div>
         </div>
     </div>

 </div>
 <!-- /.container-fluid -->
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
             <a href="<?php echo base_url('kelas'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
             <?php if ($status == "draft") { ?>
                 <a href="<?php echo base_url('users_kelas/publish_nilai/' . $id_kelas); ?>" class="btn btn-primary btn-sm"><i class="fa fa-bullhorn"></i> Publish</a>
             <?php } elseif ($status == "publish") { ?>
                 <a href="<?php echo base_url('users_kelas/draft_nilai/' . $id_kelas); ?>" class="btn btn-dark btn-sm"><i class="fa fa-bullhorn"></i> Draft</a>
             <?php } ?>
             <?php if ($count_user < $jumlah_kelas) {
                    include('create.php');
                } else { ?>
                 <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-exclamation"></i> Kelas Penuh</button>
             <?php } ?>
         </div>
         <div class="card-body">
             <div class="table-responsive">
                 <table class="table table-bordered" width="100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th>Ranking</th>
                             <th>Nama</th>
                             <th>Username</th>
                             <th>Nilai Akhir</th>
                             <th>Aksi</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php $i = 1;
                            foreach ($user as $user) { ?>
                             <tr>
                                 <td><?php echo $i; ?></td>
                                 <td><?php echo $user->name; ?></td>
                                 <td><?php echo $user->username; ?></td>
                                 <td><?php echo $user->nilai_akhir; ?></td>
                                 <td>
                                     <a href="<?php echo base_url('profile/detail/' . $user->id); ?>" class="btn btn-success btn-sm"><i class="fa fa-user"></i> Profile</a>
                                     <?php if ($this->session->userdata('akses_level') == '21') { ?>
                                         <?php include('resetpassword.php'); ?>
                                         <?php include('delete.php'); ?>
                                     <?php } ?>
                                 </td>
                             </tr>
                         <?php $i++;
                            } ?>
                     </tbody>
                 </table>
             </div>
         </div>
     </div>

 </div>
 <!-- /.container-fluid -->
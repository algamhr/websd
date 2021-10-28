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
         <div class="card-body">
             <?php if ($status == "draft") { ?>
                 <h5>Nilai belum di-publish, harap tenang...</h5>
             <?php } elseif ($status == "publish") { ?>
                 <div class="table-responsive">
                     <table class="table table-bordered" width="100%" cellspacing="0">
                         <thead>
                             <tr>
                                 <th>Ranking</th>
                                 <th>Nama</th>
                                 <th>Username</th>
                                 <th>Nilai Akhir</th>
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
                                 </tr>
                             <?php $i++;
                                } ?>
                         </tbody>
                     </table>
                 </div>
             <?php } ?>
         </div>
     </div>

 </div>
 <!-- /.container-fluid -->
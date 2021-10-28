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

     <?php if ($this->session->userdata('akses_level') == 21) { ?>
         <div class="row">
             <!-- Earnings (Monthly) Card Example -->
             <div class="col-xl-3 col-md-6 mb-4">
                 <div class="card border-left-primary shadow h-100 py-2">
                     <div class="card-body">
                         <div class="row no-gutters align-items-center">
                             <div class="col mr-2">
                                 <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pelajar</div>
                                 <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $user_count; ?></div>
                             </div>
                             <div class="col-auto">
                                 <i class="fas fa-users fa-2x text-gray-300"></i>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

             <!-- Earnings (Monthly) Card Example -->
             <div class="col-xl-3 col-md-6 mb-4">
                 <div class="card border-left-success shadow h-100 py-2">
                     <div class="card-body">
                         <div class="row no-gutters align-items-center">
                             <div class="col mr-2">
                                 <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Kelas</div>
                                 <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $kelas_count; ?></div>
                             </div>
                             <div class="col-auto">
                                 <i class="fas fa-building fa-2x text-gray-300"></i>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

             <!-- Earnings (Monthly) Card Example -->
             <div class="col-xl-3 col-md-6 mb-4">
                 <div class="card border-left-info shadow h-100 py-2">
                     <div class="card-body">
                         <div class="row no-gutters align-items-center">
                             <div class="col mr-2">
                                 <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pelajaran</div>
                                 <div class="row no-gutters align-items-center">
                                     <div class="col-auto">
                                         <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $pelajaran_count; ?></div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-auto">
                                 <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

             <!-- Pending Requests Card Example -->
             <div class="col-xl-3 col-md-6 mb-4">
                 <div class="card border-left-warning shadow h-100 py-2">
                     <div class="card-body">
                         <div class="row no-gutters align-items-center">
                             <div class="col mr-2">
                                 <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Materi</div>
                                 <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $materi_count; ?></div>
                             </div>
                             <div class="col-auto">
                                 <i class="fas fa-book fa-2x text-gray-300"></i>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     <?php } ?>

     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <a href="<?php echo base_url('materi'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-book"></i> Lihat Selengkapnya...</a>
         </div>
         <div class="card-body">
             <div class="table-responsive">
                 <table class="table table-bordered" width="100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th>Judul Materi</th>
                             <th>Kelas</th>
                             <th>Tanggal Upload</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                            foreach ($materi as $materi) { ?>
                             <tr>
                                 <td><a href="<?php echo base_url('materi/baca/' . $materi->slug_materi); ?>"><b style="font-size: 20px;"><?php echo $materi->nama_materi ?></b></a><br><small>Oleh: <?php echo $materi->username ?></small>
                                 </td>
                                 <td><?php echo $materi->nama_kelas; ?><br>Pelajaran: <?php echo $materi->nama_pelajaran; ?></td>
                                 <td>
                                     <?php echo date("d F Y", strtotime($materi->tanggal_materi)); ?>
                                 </td>
                             </tr>
                         <?php } ?>
                     </tbody>
                 </table>
             </div>
         </div>
     </div>

 </div>
 <!-- /.container-fluid -->
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
             <?php if ($this->session->userdata('akses_level') == '21' || $this->session->userdata('akses_level') == '2') { ?>
                 <a href="<?php echo base_url('materi/tambah'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah</a>
             <?php } ?>
         </div>
         <div class="card-body">
             <div class="table-responsive">
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th>Judul Materi</th>
                             <th>Kelas</th>
                             <th>Tanggal Upload</th>
                             <th>Status</th>
                             <th>Aksi</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                            foreach ($materi as $materi) { ?>
                             <tr>
                                 <td><a href="<?php echo base_url('materi/baca/' . $materi->slug_materi); ?>"><b style="font-size: 20px;"><?php echo $materi->nama_materi ?></b></a><br><small>Oleh: <?php echo $materi->user_username ?></small>
                                 </td>
                                 <td><?php echo $materi->nama_kelas; ?><br>Pelajaran: <?php echo $materi->nama_pelajaran; ?></td>
                                 <td>
                                     <?php echo date("d F Y", strtotime($materi->tanggal_materi)); ?>
                                 </td>
                                 <td><?php echo $materi->status_materi; ?></td>
                                 <td>
                                     <a href="<?php echo base_url('materi/baca/' . $materi->slug_materi); ?>" class="btn btn-success btn-sm"><i class="fa fa-book"></i></a>
                                     <?php if ($this->session->userdata('akses_level') == 21 || $this->session->userdata('akses_level') == 2) { ?>
                                         <a href="<?php echo base_url('materi/edit/' . $materi->id_materi); ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                         <?php include('delete.php'); ?>
                                     <?php } ?>
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
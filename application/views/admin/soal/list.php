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
             <a href="<?php echo base_url('soal/tambah'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah</a>
         </div>
         <div class="card-body">
             <div class="table-responsive">
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th>Kelas</th>
                             <th>Pelajaran</th>
                             <th>Materi</th>
                             <th>Pertanyaan</th>
                             <th>Jawaban Benar</th>
                             <th>Aksi</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php foreach ($soal as $soal) { ?>
                             <tr>
                                 <td><?php echo $soal->nama_kelas ?></td>
                                 <td><?php echo $soal->nama_pelajaran ?></td>
                                 <td><?php echo $soal->nama_materi ?></td>
                                 <td><?php echo character_limiter($soal->pertanyaan, 20); ?></td>
                                 <td><?php echo $soal->jawaban ?></td>
                                 <td>
                                     <a href="<?php echo base_url('soal/edit/' . $soal->id_soal); ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                     <?php include('hapus.php'); ?>
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
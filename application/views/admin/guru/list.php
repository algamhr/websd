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
             <?php include('create.php'); ?>
         </div>
         <div class="card-body">
             <div class="table-responsive">
                 <table class="table table-bordered">
                     <thead>
                         <tr>
                             <th>#</th>
                             <th>Nama Guru</th>
                             <th>Kelas</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                            $count = 0;
                            foreach ($guru as $key => $row) :
                                $count++;
                            ?>
                             <tr>
                                 <td><?php echo $key + 1; ?></td>
                                 <td><?php echo $row->name; ?></td>
                                 <td>
                                     <?php
                                        if ($row->kelas1a == "kelas1a") {
                                            echo "Kelas 1 A, ";
                                        }
                                        if ($row->kelas1b == "kelas1b") {
                                            echo "Kelas 1 B, ";
                                        }
                                        if ($row->kelas1c == "kelas1c") {
                                            echo "Kelas 1 C, ";
                                        }
                                        if ($row->kelas2a == "kelas2a") {
                                            echo "Kelas 2 A, ";
                                        }
                                        if ($row->kelas2b == "kelas2b") {
                                            echo "Kelas 2 B, ";
                                        }
                                        if ($row->kelas2c == "kelas2c") {
                                            echo "Kelas 2 C, ";
                                        }
                                        if ($row->kelas3a == "kelas3a") {
                                            echo "Kelas 3 A, ";
                                        }
                                        if ($row->kelas3b == "kelas3b") {
                                            echo "Kelas 3 B, ";
                                        }
                                        if ($row->kelas3c == "kelas3c") {
                                            echo "Kelas 3 C, ";
                                        }
                                        if ($row->kelas4a == "kelas4a") {
                                            echo "Kelas 4 A, ";
                                        }
                                        if ($row->kelas4b == "kelas4b") {
                                            echo "Kelas 4 B, ";
                                        }
                                        if ($row->kelas4c == "kelas4c") {
                                            echo "Kelas 4 C, ";
                                        }
                                        if ($row->kelas5a == "kelas5a") {
                                            echo "Kelas 5 A, ";
                                        }
                                        if ($row->kelas5b == "kelas5b") {
                                            echo "Kelas 5 B, ";
                                        }
                                        if ($row->kelas5c == "kelas5c") {
                                            echo "Kelas 5 C, ";
                                        }
                                        if ($row->kelas6a == "kelas6a") {
                                            echo "Kelas 6 A, ";
                                        }
                                        if ($row->kelas6b == "kelas6b") {
                                            echo "Kelas 6 B, ";
                                        }
                                        if ($row->kelas6c == "kelas6c") {
                                            echo "Kelas 6 C, ";
                                        }
                                        ?>
                                 </td>
                                 <td>
                                     <a href="<?php echo base_url('profile/detail/' . $row->id); ?>" class="btn btn-success btn-sm"><i class="fa fa-user"></i> Profile</a>
                                     <a href="<?php echo base_url('guru/edit/' . $row->id); ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>

                                     <?php include('delete.php'); ?>
                                 </td>
                             </tr>
                         <?php endforeach; ?>
                     </tbody>
                 </table>
             </div>
         </div>
     </div>

 </div>

 <!-- /.container-fluid -->
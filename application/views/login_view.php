<?php
$konfig = $this->konfigurasi_model->listing(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="<?php echo $konfig->author; ?>">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('assets/admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url(); ?>asset/admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center" style="margin-top: 150px;">

            <div class="col-lg-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><?php echo $konfig->nama_web; ?></h1>
                                    </div>

                                    <?php echo validation_errors('<div class="alert alert-warning">', '</div>'); ?>
                                    <?php
                                    //di atas list.php
                                    if ($this->session->flashdata('sukses')) {
                                        echo '<div class="alert alert-success">';
                                        echo $this->session->flashdata('sukses');
                                        echo '</div>';
                                    }
                                    ?>

                                    <form action="<?php echo base_url() ?>login" method="post">
                                        <div class="form-group">
                                            <input id="username" type="text" class="form-control form-control-user" name="username" value="" required placeholder="Username" autofocus>
                                        </div>
                                        <div class="form-group">
                                            <input id="password" type="password" class="form-control form-control-user" name="password" required autocomplete="current-password" placeholder="Password">
                                        </div>
                                        <hr>

                                        <input type="submit" name="submit" value="Login" class="btn btn-primary btn-user btn-block">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url(); ?>asset/admin/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url(); ?>asset/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url(); ?>asset/admin/js/sb-admin-2.min.js"></script>

</body>

</html>s
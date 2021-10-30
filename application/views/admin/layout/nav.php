<?php
$konfig = $this->konfigurasi_model->listing(); ?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url(); ?>">
        <div class="sidebar-brand-icon">
            <i class="fas fa-school"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><?php echo $konfig->nama_web; ?></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>dashboard">
            <i class="fa fa-coffee"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('profile/detail/' . $this->session->userdata('id')); ?>">
            <i class="fa fa-user"></i>
            <span>Profile</span></a>
    </li>
    <?php if ($this->session->userdata('akses_level') == '21') { ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url(); ?>user">
                <i class="fa fa-users"></i>
                <span>Pengelola</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url(); ?>guru">
                <i class="fa fa-users"></i>
                <span>Guru</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url(); ?>kelas">
                <i class="fa fa-building"></i>
                <span>Kelas</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url(); ?>pelajaran">
                <i class="fas fa-clipboard-list"></i>
                <span>Pelajaran</span></a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url(); ?>konfigurasi">
                <i class="fas fa-clipboard-list"></i>
                <span>Konfigurasi</span></a>
        </li> -->
    <?php } ?>

    <?php if ($this->session->userdata('akses_level') == '2') { ?>

        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url(); ?>kelas">
                <i class="fa fa-home"></i>
                <span>Kelas</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url(); ?>soal">
                <i class="fa fa-question"></i>
                <span>Kuis</span></a>
        </li>

    <?php } ?>

    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>materi">
            <i class="fa fa-book"></i>
            <span>Materi</span></a>
    </li>

    <?php if ($this->session->userdata('akses_level') == '1') { ?>

        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('nilai_pengguna/pengguna/' . $this->session->userdata('id_kelas')); ?>">
                <i class="fa fa-desktop"></i>
                <span>Nilai Pengguna</span></a>
        </li>
    <?php } ?>

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fa fa-sign-out"></i>
            <span>Logout</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Alerts -->
                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="<?php echo base_url('profile/detail/' . $this->session->userdata('id')); ?>">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $this->session->userdata('name'); ?></span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End of Topbar -->
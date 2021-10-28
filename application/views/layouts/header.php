<?php
$konfig = $this->konfigurasi_model->listing(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title><?php echo $konfig->nama_web; ?></title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta content="" name="keywords">
	<meta content="" name="description">
	<meta content="<?php echo $konfig->author; ?>" name="author">

	<!-- Favicons -->
	<link href="img/favicon.png" rel="icon">
	<link href="img/apple-touch-icon.png" rel="apple-touch-icon">

	<link href="https://fonts.googleapis.com/css?family=Rubik:300,400,700|Oswald:400,700" rel="stylesheet">

	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/welcome/fonts/icomoon/style.css">

	<link rel="stylesheet" href="http://127.0.0.1:8080/asset/welcome/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/welcome/css/jquery.fancybox.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/welcome/css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/welcome/css/owl.theme.default.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/welcome/fonts/flaticon/font/flaticon.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/welcome/css/aos.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/welcome/css/style.css">
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

	<div id="overlayer"></div>
	<div class="loader">
		<div class="spinner-border text-primary" role="status">
			<span class="sr-only">Loading...</span>
		</div>
	</div>

	<div class="site-wrap" id="home-section">

		<div class="site-mobile-menu site-navbar-target">
			<div class="site-mobile-menu-header">
				<div class="site-mobile-menu-close mt-3">
					<span class="icon-close2 js-menu-toggle"></span>
				</div>
			</div>
			<div class="site-mobile-menu-body"></div>
		</div>


		<div class="top-bar">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<a href="#" class=""><span class="mr-2  icon-envelope-open-o"></span> <span class="d-none d-md-inline-block">hotparulian97@gmail.com</span></a>
						<span class="mx-md-2 d-inline-block"></span>
						<a href="#" class=""><span class="mr-2  icon-phone"></span> <span class="d-none d-md-inline-block">082166571147</span></a>


						<div class="float-right">

						</div>

					</div>

				</div>

			</div>
		</div>

		<header class="site-navbar js-sticky-header site-navbar-target" role="banner">

			<div class="container">
				<div class="row align-items-center position-relative">


					<div class="site-logo">
						<a href="<?php echo base_url('beranda'); ?>" class="text-black"><span class="text-primary"><?php echo $konfig->nama_web; ?></a>
					</div>

					<div class="col-12">
						<nav class="site-navigation text-right ml-auto " role="navigation">

							<ul class="site-menu main-menu js-clone-nav ml-auto d-none d-lg-block">
								<ul class="site-menu main-menu js-clone-nav ml-auto d-none d-lg-block">
									<li><a href="<?php echo base_url('beranda'); ?>" class="nav-link">Beranda</a></li>
									<li><a href="<?php echo base_url('tentang'); ?>" class="nav-link">Tentang</a></li>
									<li><a href="<?php echo base_url(); ?>login">Login</a></li>
								</ul>
						</nav>

					</div>

					<div class="toggle-button d-inline-block d-lg-none"><a href="#" class="site-menu-toggle py-5 js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

				</div>
			</div>

		</header>
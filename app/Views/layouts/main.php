<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="Gheav">
	<meta name="keywords" content="Gheav, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<title><?php echo $title ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link href="<?= base_url('assets/css/app.css') ?>" rel="stylesheet">
	<!--CSS to make multistep form-->	
    <link href="<?= base_url('assets/css/multistep.css') ?>" rel="stylesheet"/>

	<!--DataTables CSS-->
	<link href="<?= base_url('assets/css/datatables.min.css') ?>" rel="stylesheet"/>
	<link href="<?= base_url('assets/css/dataTables.bootstrap5.min.css') ?>" rel="stylesheet"/>
	<style>
		.st-closed{
			background-color: #d53b2c;
			/* border-color: #f7b52f; */
			/* color : #17171d; */
			/* color : #141414; */
		}		
		.st-primary{
			background-color: #f7b52f;
			border-color: #f7b52f;
			/* color : #17171d; */
			color : #141414;
		}

		.st-suspend{
			background-color: #eb5f48;
			/* border-color: #f7b52f; */
			/* color : #17171d; */
			color : #141414;
		}
		.bg-danger,
		.bg-primary,
		.bg-success {
			color: #141414;
		}
		
		.btn-primary,
		.btn-primary:active,
		.btn-primary:visited{
			background-color: #f7b52f;
			border-color: #f7b52f;
            color : #141414
		}
		.btn-primary:focus,
		.btn-primary:hover{
			background-color: #eb5f48;
			border-color: #f7b52f;   
            color : #141414         
		}
		.btn-primary:disabled{
			background-color: #f7b52f;
			border-color: #f7b52f;
			color : #141414;
		}
		.btn-outline-primary,
		.btn-outline-primary:active,
		.btn-outline-primary:visited {
			background-color: #fff;
			color: #f7b52f;
			border-color: #f7b52f;
		}
		.btn-outline-primary:hover,
		.btn-outline-primary:focus {
			background-color: #f7b52f;
			color: #000/* #fff */;
			border-color: #f7b52f;
		}

		.btn-danger:disabled{
			background-color: #eb5f48;
			border-color: #eb5f48;
		}

		.btn-outline-danger,
		.btn-outline-danger:active,
		.btn-outline-danger:visited {
			background-color: #fff;
			color: #eb5f48;
			border-color: #eb5f48;
		}
		.btn-outline-danger:hover,
		.btn-outline-danger:focus {
			background-color: #eb5f48;
			color: #fff;
			border-color: #eb5f48;
		}
		input[type=checkbox]{accent-color:#fff;}
		input[type=checkbox]:checked{accent-color:#fff;background-color: #f7b52f;}
		input::-webkit-outer-spin-button,
		input::-webkit-inner-spin-button {
			-webkit-appearance: none;
			margin: 0;
		}
		input[type="number"] {
			-moz-appearance: textfield;
		}
		
	</style>
	<?php if (!empty($user) AND ($user['role_name'] === 'Client') ): ?>
		<?php if (!empty($segment) AND ($segment === 'home') ): ?>
			<style>
				.main {
					background-image: url('<?= base_url('assets/img/visuelform.jpg') ?>');
					background-size: 60%;
					background-repeat: no-repeat;
					background-attachment: fixed;
					background-position: center;
				}
			</style>
		<?php else :?>
			<style>
				.main {
					background-image: url('<?= base_url('assets/img/fondecran.jpg') ?>');
					background-size: cover;
					background-repeat: no-repeat;
					background-attachment: fixed;
					background-position: center;
				}
			</style>	
		<?php endif; ?>
			
	<?php endif; ?>

	<!--Another CSS according the page-->
	<?= $this->renderSection('style'); ?>
	<!--JS Zone -->
	
	<script src="<?= base_url('assets/js/app.js')?>"></script>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
	<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
	
	<!--DataTables JS-->	
	<script src="<?= base_url('assets/js/datatables.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/dataTables.bootstrap5.min.js') ?>"></script>
	
	<!--Other JS according the page-->
	<?= $this->renderSection('javascript'); ?>
</head>

<body>
	<div class="wrapper">
		<?php if(!empty($user) AND ($user['role_name'] === 'Administrateur') ): ?>
			<?= $this->include('layouts/sidebar'); ?>
		<?php endif ?>
		<div class="main">
			<!-- HEADER: MENU + HEROE SECTION -->
			<?= $this->include('layouts/header'); ?>
			<!-- CONTENT -->
			<main class="content">
				<div class="container-fluid p-0">
					<?= $this->include('common/alerts'); ?>
					<?= $this->renderSection('content'); ?>
				</div>
			</main>
			<!-- FOOTER: DEBUG INFO + COPYRIGHTS -->
			<?= $this->include('layouts/footer'); ?>
		</div>
	</div>
</body>

</html>
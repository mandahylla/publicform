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
		<div class="main">
			<main class="content">
				<div class="container-fluid p-0">
					<?= $this->renderSection('content'); ?>
				</div>
			</main>
		</div>
	</div>
</body>

</html>
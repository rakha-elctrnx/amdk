<?php
$uri = new \CodeIgniter\HTTP\URI();
$uri = current_url(true);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= config("Custom")->appName ?> | <?= $this->renderSection("tab_title") ?></title>

	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="<?= base_url('adminlte') ?>/plugins/fontawesome-free/css/all.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?= base_url('adminlte') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url('adminlte') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url('adminlte') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
	<!-- Toastr -->
	<link rel="stylesheet" href="<?= base_url('adminlte') ?>/plugins/toastr/toastr.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url('adminlte') ?>/dist/css/adminlte.min.css">

	<style>
		html {
			scroll-behavior: smooth;
		}

		.main-header {
			border-bottom: none;
		}

		.content-header {
			margin-top: -1px;
			padding-bottom: 125px;
			opacity: 0.75;
		}

		.content {
			margin-top: -110px;
		}
	</style>
</head>

<body class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed control-sidebar-slide-open">
	<div class="wrapper">
		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-dark bg-lightblue">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
			</ul>
			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url('logout') ?>" role="button" title="Keluar">
						<i class="fas fa-sign-out-alt"></i>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-widget="fullscreen" href="#" role="button" title="Layar Penuh">
						<i class="fas fa-expand-arrows-alt"></i>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->
		<!-- Main Sidebar Container -->
		<aside class="main-sidebar elevation-4 sidebar-light-lightblue">
			<!-- Brand Logo -->
			<a href="<?= base_url("dashboard") ?>" class="brand-link bg-lightblue">
				<span class="brand-text font-weight-dark"><?= config("custom")->appName ?></span>
			</a>
			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user panel (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="info">
						<a href="<?= base_url('profile') ?>" class="d-block">
							<?= config("login")->adminName ?>
							&nbsp;
							<i class='fa fa-edit'></i>
						</a>
					</div>
				</div>
				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<li class="nav-item">
							<a href="<?= base_url('dashboard') ?>" class="nav-link <?= ($uri->getSegment(1) === "dashboard") ? "active" : "" ?>">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>
									Dashboard
								</p>
							</a>
						</li>
						<li class='nav-header'>
							DATA
						</li>
						<li class="nav-item">
							<a href="<?= base_url('product') ?>" class="nav-link <?= ($uri->getSegment(1) === "product") ? "active" : "" ?>">
								<i class="nav-icon fas fa-boxes"></i>
								<p>
									Produk
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('material') ?>" class="nav-link <?= ($uri->getSegment(1) === "material") ? "active" : "" ?>">
								<i class="nav-icon fas fa-th-large"></i>
								<p>
									Bahan
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('supplier') ?>" class="nav-link <?= ($uri->getSegment(1) === "supplier") ? "active" : "" ?>">
								<i class="nav-icon fas fa-truck"></i>
								<p>
									Pemasok
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('customer') ?>" class="nav-link <?= ($uri->getSegment(1) === "customer") ? "active" : "" ?>">
								<i class="nav-icon fas fa-users"></i>
								<p>
									Pelanggan
								</p>
							</a>
						</li>
						<li class='nav-header'>
							TRANSAKSI
						</li>
						<li class="nav-item">
							<a href="<?= base_url('buy') ?>" class="nav-link <?= ($uri->getSegment(1) === "buy") ? "active" : "" ?>">
								<i class="nav-icon fas fa-cart-arrow-down"></i>
								<p>
									Pembelian
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('sale') ?>" class="nav-link <?= ($uri->getSegment(1) === "sale") ? "active" : "" ?>">
								<i class="nav-icon fas fa-shopping-cart"></i>
								<p>
									Penjualan
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('transaction') ?>" class="nav-link <?= ($uri->getSegment(1) === "transaction") ? "active" : "" ?>">
								<i class="nav-icon fas fa-exchange-alt"></i>
								<p>
									Arus Kas
								</p>
							</a>
						</li>
						<li class='nav-header'>
							PRODUKSI
						</li>
						<li class="nav-item">
							<a href="<?= base_url('production') ?>" class="nav-link <?= ($uri->getSegment(1) === "production") ? "active" : "" ?>">
								<i class="nav-icon fas fa-cogs"></i>
								<p>
									Produksi
								</p>
							</a>
						</li>
						<li class='nav-header'>
							LAPORAN
						</li>
						<li class="nav-item">
							<a href="<?= base_url('report') ?>" class="nav-link <?= ($uri->getSegment(1) === "report") ? "active" : "" ?>">
								<i class="nav-icon fas fa-file"></i>
								<p>
									Laporan
								</p>
							</a>
						</li>
						<li class='nav-header'>
							PENGGUNA
						</li>
						<li class="nav-item">
							<a href="<?= base_url('user') ?>" class="nav-link <?= ($uri->getSegment(1) === "user") ? "active" : "" ?>">
								<i class="nav-icon fas fa-user"></i>
								<p>
									Pengguna
								</p>
							</a>
						</li>
					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header bg-lightblue">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0"><?= $this->renderSection("title") ?></h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right bg-light px-2">
								<?= $this->renderSection("breadcrumb") ?>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<div class="content">
				<div class="container-fluid">
					<?= $this->renderSection('content') ?>
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		<!-- Main Footer -->
		<footer class="main-footer">
			<!-- Default to the left -->
			<strong>
				Copyright
				&copy;
				<?= (date("Y") > config("custom")->yearMade) ? config("custom")->yearMade . " - " . date("Y") : config("custom")->yearMade ?>
				<a href="#"><?= config("custom")->appName ?></a>.</strong> All rights reserved.
			</strong>
		</footer>
	</div>
	<!-- ./wrapper -->

	<!-- REQUIRED SCRIPTS -->

	<!-- jQuery -->
	<script src="<?= base_url('adminlte') ?>/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="<?= base_url('adminlte') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- DataTables  & Plugins -->
	<script src="<?= base_url('adminlte') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('adminlte') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?= base_url('adminlte') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="<?= base_url('adminlte') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
	<script src="<?= base_url('adminlte') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
	<script src="<?= base_url('adminlte') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
	<script src="<?= base_url('adminlte') ?>/plugins/jszip/jszip.min.js"></script>
	<script src="<?= base_url('adminlte') ?>/plugins/pdfmake/pdfmake.min.js"></script>
	<script src="<?= base_url('adminlte') ?>/plugins/pdfmake/vfs_fonts.js"></script>
	<script src="<?= base_url('adminlte') ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
	<script src="<?= base_url('adminlte') ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
	<script src="<?= base_url('adminlte') ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
	<!-- Toastr -->
	<script src="<?= base_url('adminlte') ?>/plugins/toastr/toastr.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?= base_url('adminlte') ?>/dist/js/adminlte.min.js"></script>

	<script>
		$(function() {
			$("#datatable1").DataTable({
				"responsive": true,
				"lengthChange": true,
				"autoWidth": false,
				"buttons": ["excel", "pdf", "print"]
			}).buttons().container().appendTo('#datatable1_wrapper .col-md-6:eq(0)');
		});
	</script>

	<?php
	if (isset($_SESSION['msg'])) {
	?>
		<script>
			$(document).ready(function() {
				toastr.<?= $_SESSION['msg_type'] ?>('<?= $_SESSION['msg'] ?>')
			});
		</script>
	<?php
	}
	?>

	<?= $this->renderSection("script") ?>
</body>

</html>
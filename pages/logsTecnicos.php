<?php
	// Chamados o arquivo com Menu
	include ('../_headerMenu.php');
	require ('../server/funcoesMaterias.php');
?>
	<head>
		<script src="../resources/dist/js/functionsDisplay.js"></script>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.5 -->
		<link rel="stylesheet" href="../resources/bootstrap/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<!-- daterange picker -->
		<link rel="stylesheet" href="../resources/plugins/daterangepicker/daterangepicker-bs3.css">
		<!-- iCheck for checkboxes and radio inputs -->
		<link rel="stylesheet" href="../resources/plugins/iCheck/all.css">
		<!-- Bootstrap Color Picker -->
		<link rel="stylesheet" href="../resources/plugins/colorpicker/bootstrap-colorpicker.min.css">
		<!-- Bootstrap time Picker -->
		<link rel="stylesheet" href="../resources/plugins/timepicker/bootstrap-timepicker.min.css">
		<!-- Select2 -->
		<link rel="stylesheet" href="../resources/plugins/select2/select2.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="../resources/dist/css/AdminLTE.min.css">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
		folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="../resources/dist/css/skins/_all-skins.min.css">
		<link href="../resources/dist/css/jquery.gritter.css" rel="stylesheet">
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>Logs<small>Técnicos</small></h1>
					<ol class="breadcrumb">
						<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
						<li><a href="#">Logs</a></li>
						<li class="active">Logs Técnicos</li>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content">

					      <div class="row">
							<div class="col-xs-12">
								<div class="box box-default">
									<div class="box-header">
										<h3 class="box-title">Lista de Saídas</h3>
									</div><!-- /.box-header -->
									<div class="box-body">
									<?php 
									 mostrarSaidasLogsTecnico(); 
									?>
									</div><!-- /.box-body -->
								</div><!-- /.box -->
							</div><!-- /.col-xs-12 -->
						</div><!-- /.row -->
						</div>
					</div> <!-- se der pau tire isso -->
				</section><!-- /.content -->
			</div><!-- /.content-wrapper -->
			<footer class="main-footer">
				<div class="pull-right hidden-xs">
					<b>Versão</b> 1.3.0
				</div>
				<strong>Copyright © 2016 <a href="http://www.brisanet.com.br">SAS - Brisanet Telecomunicações</a>.</strong>
			</footer>
		</div><!-- ./resources/wrapper -->
		<!-- AdminLTE App -->
		<!-- jQuery UI 1.11.4 -->
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
		<!-- InputMask -->
		<script src="../resources/plugins/input-mask/jquery.inputmask.js"></script>
		<!-- InputMask -->
		<script src="../resources/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
		<!-- InputMask -->
		<script src="../resources/plugins/input-mask/jquery.inputmask.extensions.js"></script>
		<script src="../resources/plugins/fastclick/fastclick.min.js"></script>
		<script src="../resources/plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<script src="../resources/dist/js/function_salvar_saida.js"></script>
		<!-- jQuery 2.1.4 -->
		<script src="../resources/plugins/jQuery/jQuery-2.1.4.min.js"></script>
		<!-- Bootstrap 3.3.5 -->
		<script src="../resources/bootstrap/js/bootstrap.min.js"></script>
		<!-- Select2 -->
		<script src="../resources/plugins/select2/select2.full.min.js"></script>
		<script src="../resources/dist/js/app.min.js"></script>
		<script src="../resources/dist/js/jquery.gritter.min.js"></script>
	    <script src="../resources/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="../resources/plugins/datatables/dataTables.bootstrap.min.js"></script>
		<!-- Page script -->
		<script>
			$(function () {
				$("#tabelasaida").DataTable();
			});
		</script>
		<script>
			$(function () {
				//Initialize Select2 Elements
				$(".select2").select2();

			});
		</script>

	</body>
</html>
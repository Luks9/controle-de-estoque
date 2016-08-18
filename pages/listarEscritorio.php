<?php
	// Chamados o arquivo com Menu
	include ('../_headerMenu.php');
	require ('../server/FuncoesDinamicas.php');
?>
<head>
	
</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>Listar Escritório<small>Geral</small></h1>
					<ol class="breadcrumb">
						<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
						<li><a href="#">Listar</a></li>
						<li class="active">Estoque Escritório</li>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content">
					<div class="col-md-13">
						<table id="example1" class="table table-bordered table-hover">
							<tbody>
								<!-- Mostra TECNICOS POR USUARIO cadastrados -->
								<?php listarEstoqueEscritorios(); ?>
							</tbody>
						</table>
					</div>
				</section><!-- /.content -->
			</div><!-- /.content-wrapper -->
			<footer class="main-footer">
				<div class="pull-right hidden-xs">
					<b>Versão</b> 1.3.0
				</div>
				<strong>Copyright © 2016 <a href="http://www.brisanet.com.br">SAS - Brisanet Telecomunicações</a>.</strong>
			</footer>
		</div><!-- ./resources/wrapper -->
		<!-- jQuery 2.1.4 -->
		<script src="../resources/plugins/datatables/jquery.dataTables.min.js"></script>
		<!-- AdminLTE App -->
		<script src="../resources/dist/js/app.min.js"></script>
		<!-- jQuery UI 1.11.4 -->
		<script src="../resources/plugins/fastclick/fastclick.min.js"></script>
		<script src="../resources/plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<script src="../resources/plugins/bootstrap-datepicker-1.5.1/js/bootstrap-datepicker.js"></script>
		<script src="../resources/plugins/bootstrap-datepicker-1.5.1/locales/bootstrap-datepicker.pt-BR.min.js"></script>

	</body>
</html>

<?php
	// Chamados o arquivo com Menu
	include ('../_headerMenu.php');
	require ('../server/FuncoesDinamicas.php');
?>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>Listar Estoque<small>Individual</small></h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
						<li><a href="listarEstoque.php">Listar</a></li>
						<li class="active">Estoque Individual</li>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content">
					<div class="col-md-13">
						<tbody>
							<!-- Mostra TECNICOS POR USUARIO cadastrados -->
							<?php openEstoque(); ?>
						</tbody>
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
		<script src="../resources/plugins/datatables/dataTables.bootstrap.min.js"></script>
		<!-- AdminLTE App -->
		<script src="../resources/dist/js/app.min.js"></script>
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
		<!-- page script -->
		<script type="text/javascript">
			$("#teste").DataTable();
		</script>
	</body>
</html>

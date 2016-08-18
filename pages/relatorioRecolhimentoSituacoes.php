<?php
	// Chamados o arquivo com Menu
	include ('../_headerMenu.php');
	require ('../server/FuncoesDinamicas.php');
?>
<head>
<script src="../resources/plugins/jQuery/timer.jquery.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content">
					<div class="box box-primary box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">Relatório Técnico por Status</h3>
							<div class="box-tools pull-right">
								<button class="btn btn-box-tool">
							</div><!-- /.box-tools -->
						</div><!-- /.box-header -->
						<div class="box-body">
						<form action='?go=buscar' method="post">
							<div class="form-group has-feedback">
								<input type="date" id="tempo1" name="tempo1">
								<input type="date" id="tempo2" name="tempo2">
								<button type="submit">Ok</button>
							</div>

						</form>

							<table id="tabelaFTTH" class="table table-bordered table-hover">
								<!-- Cabeçalho da tabela -->
								<thead>
									<tr>
										<th>Técnicos</th>
										<th>Estoque Técnico</th>
										<th>Estoque Local</th>
										<th>Migrado Estoque</th>
										<th>Reutilizado</th>
										<th>Retornado a Central</th>
									</tr>
								</thead>
								<!-- Itens da tabela -->
								<tbody>
									<?php listarRelatorioRecholimento(); ?>
								</tbody>
							</table>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
					
			</section><!-- /.content -->
		</div><!-- ./resources/wrapper -->
	</div>
	<!-- =================== Formulário para auxiliar no serialaze de apagar registros ==================== -->
<script type="text/javascript">
		function chamarPhpAjax() {
	   $.ajax({
	      url:'meuajax.php',
	      complete: function (response) {
	         alert(response.responseText);
	      },
	      error: function () {
	          alert('Erro');
	      }
	  });  

	  return false;
}
</script>
	<script src="../resources/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="../resources/plugins/datatables/dataTables.bootstrap.min.js"></script>
	<script src="../resources/dist/js/app.min.js"></script>
	<script src="../resources/dist/js/jquery.gritter.min.js"></script>
	<!-- InputMask -->
	<script src="../resources/plugins/input-mask/jquery.inputmask.js"></script>
	<!-- InputMask -->
	<script src="../resources/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
	<!-- InputMask -->
	<script src="../resources/plugins/input-mask/jquery.inputmask.extensions.js"></script>
	<script src="../resources/plugins/fastclick/fastclick.min.js"></script>
	<script src="../resources/plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<script src="../resources/plugins/bootstrap-datepicker-1.5.1/js/bootstrap-datepicker.js"></script>
	<script src="../resources/plugins/bootstrap-datepicker-1.5.1/locales/bootstrap-datepicker.pt-BR.min.js"></script>
    <!-- InputMask -->

	</body>
</html>

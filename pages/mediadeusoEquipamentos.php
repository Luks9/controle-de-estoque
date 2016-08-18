<?php
	// Chamados o arquivo com Menu
	include ('../_headerMenu.php');
	require ('../server/funcoesRelatorios.php');
?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>Relátorio<small>Instalações</small></h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
						<li><a href="http://localhost/Luke/pages/cadastrarUser.php">Registros</a></li>
						<li class="active">Relátorio de Instalações</li>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content">
					<div class="col-md-13">
						<div class="box box-danger box-solid">
							<div class="box-header with-border" data-widget="collapse">
								<h3 class="box-title">Média por Instalações</h3>
								<div class="box-tools pull-right">
									<button class="btn btn-box-tool" ><i class="fa fa-plus"></i></button>
								</div><!-- /.box-tools -->
							</div><!-- /.box-header -->
							<div class="box-body" >
								<form action="?go=BuscarMedia" method="POST">
									<div class="box-body">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group has-feedback">
													<label>Nome do Técnico</label>
													<select name="id_tecnico" id="id_tecnico" class="form-control" required >
														<option value="" disabled selected>Nome do Técnico</option>
														<?php listarNomes();  ?>
													</select>
												</div>
												<label>Data Inicial</label>
												<div class="form-group has-feedback">
													<input type="text" class="form-control" autofocus placeholder="Data Inicial" name="data_inicial" id="data_inicial" required oninvalid="setCustomValidity('Informe seu nome neste campo ')" onchange="try{setCustomValidity('')}catch(e){}">
													<span class="glyphicon glyphicon-home form-control-feedback"></span>
												</div>
											</div>
											<div class="col-md-6">
												<label>Tipo de Média</label>
												<div class="form-group has-feedback">
													<select name="tipo" id="tipo" class="form-control" required="">
														<option value="" disabled selected>Média</option>
														<option value="FTTH">FTTH</option>
														<option value="TV">TV</option>
													</select>
												</div>
												<label>Data Final</label>
												<div class="form-group has-feedback">
													<input type="text" class="form-control" placeholder="Data Final" id="data_final" name="data_final" required >
													<span class="glyphicon glyphicon-phone form-control-feedback"></span>
												</div>
											</div>
										</div><!-- /.row -->
									</div><!-- /.box-body -->
									<div class="box-footer">
										<div class="btn-group pull-right">
											<button type="submit" class="btn btn-defult"><i class="fa fa-edit"></i> Buscar</button>
										</div>
									</div><!-- /.box-footer -->
								</form><!-- /#form_cadastro -->
							</div><!-- /.box-body -->
						</div><!-- /.box -->
						<div class="row">
							<div class="col-xs-12">
								<div class="box box-danger">
									<div class="box-body">
										<?php  mediaItens(); ?>
									</div><!-- /.box-body -->
								</div><!-- /.box -->
							</div><!-- /.col -->
						</div><!-- /.row -->
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
		<script type="text/javascript">
			$(function() {
				$( "#data_inicial" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
				$( "#data_final" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
			});
		</script>
		<script src="../resources/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="../resources/plugins/datatables/dataTables.bootstrap.min.js"></script>
		<!-- AdminLTE App -->
		<script src=" ../resources/dist/js/app.min.js"></script>
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
		<script>
		</script>
	</body>
</html>

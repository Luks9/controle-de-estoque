<?php
	// Chamados o arquivo com Menu
	include ('../_headerMenu.php');
	require ('../server/FuncoesDinamicas.php');
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
		<script src="../resources/plugins/jQuery/jQuery-2.1.4.min.js"></script>
		<!-- Bootstrap 3.3.5 -->
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>Solicitação de<small>Equipamentos</small></h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
						<li><a href="#">Solicitação de Materiais</a></li>
						<li class="active">Lista para Técnico</li>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content">
					<div class="col-md-13">
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Material Para Técnico</h3>
							</div><!-- /.box-header -->
							<div class="box-body">
								<form method="post"  id="salvarSolicitacao">
									<div class="box-body">
										<div class="row">
											<div class="col-md-6">
												<!--DE ACORDO COM O SELECT MOSTRA OS INPUTS-->
												<div class="form-group">
													<label>Solicitar Material</label>
													<select class="form-control select2" name="funcao" id="funcao"  onchange="exibirCampo()" style="width: 100%;">
														<option value="" disabled selected>Lista</option>
														<option value="Material">Materiais / Quantidade</option>
													</select>
												</div><!-- /.form-group -->

												<div class="form-group">
													<label>Solicita ao Estoquista:</label>
													<select class="form-control select2" name="estoquista_solicitado" id="estoquista_solicitado"  onchange="exibirCampo()" style="width: 100%;">
														<option value="" disabled selected>Estoquista</option>
														<option value="Francisco Claudio da Silva">Sobral - Francisco Claudio da Silva</option>
														<option value="Francisco Wermeson Dantas de Lima">Quixadá - Francisco Wermeson Dantas de Lima</option>
														<option value="Felipe Freires Maia">Limoeiro - Felipe Freires Maia</option>
														<option value="Alex Araújo Silva">Iguatu - Alex Araújo Silva</option>
														<option value="Alessanderson Evangelista Teixeira">Taua - Alessanderson Evangelista Teixeira</option>
														<option value="Leonardo Rosa Alexandre">Crateus - Leonardo Rosa Alexandre</option>
														<option value="Jose Eryck Silva Pereira">Juazeiro - Jose Eryck Silva Pereira</option>
														<option value="Alex Júnior de Souza Arraes">Brejo Santo - Alex Júnior de Souza Arraes</option>
														<option value="Bruno Cesar de Castro Carlos"> Pau dos Ferros - Bruno Cesar de Castro Carlos</option>
														<option value="Augusto Mendes Gomes da Silva Júnior">Mossoro - Augusto Mendes Gomes da Silva Júnior</option>
													</select>
												</div><!-- /.form-group -->

												<!--ADICIONAR ESTOQUE AO TECNICO SELECIONADO-->
												<label>Selecione o Técnico</label>
												<div class="form-group">
													<select name="tecnico" id="tecnico" class="form-control select2" onchange="exibirCampo()" style="width: 100%;"  required >
														<option value="" disabled selected>Nome do Técnico</option>
														<?php listarTecnicosAllSemID(); ?>
													</select>
													<input type="hidden" value="validarGerador" name="gerarPDF"/>
												</div>
												<div class="form-group has-feedback" id="div_cabo_optico" style="display:none">
													<label>Quantidade Cabo Óptico <small>(Metros)</small></label>
												<input type="number" class="form-control" value="0" name="total_cabo_optico" id="total_cabo_optico"  >
												</div>
												<div class="form-group has-feedback" id="div_cabo_rede" style="display:none">
													<label>Quantidade Cabo Rede <small>(Metros)</small></label>
													<input type="number" class="form-control" value="0" name="total_cabo_rede" id="total_cabo_rede"  >
												</div>
												<div class="form-group has-feedback" style="display:none" id="div_conectores">
													<label>Quantidade Conectores SC ACP </label>
													<input type="number" class="form-control" value="0" name="total_conector_scapc" id="total_conector_SCAPC" >
												</div>
												<div class="form-group has-feedback" style="display:none" id="div_conectores2">
													<label>Quantidade Conectores SC PC </label>
													<input type="number" class="form-control" value="0" name="total_conector_scpc" id="total_conector_SCPC" >
												</div>
												<div class="form-group has-feedback" style="display:none" id="div_conectores_rj45">
													<label>Quantidade Conectores RJ45 </label>
													<input type="number" class="form-control" value="0" name="total_conector_rj45" id="total_conector_rj45">
												</div>
												<div class="form-group has-feedback" style="display:none" id="div_bap">
													<label>Quantidade BAP </label>
													<input type="number" class="form-control" value="0" name="total_bap" id="total_bap">
												</div>
											</div><!-- /.col-md-6 -->
											<div class="col-md-6">
												<div class="form-group has-feedback" style="display:none" id="div_onu">
													<label>Quantidade ONU</label>
													<input type="number" class="form-control" value="0" name="total_onu" id="total_onu"  >
													<div id="macs_onu">
													</div>
												</div>
												<div class="form-group has-feedback" style="display:none" id="div_stb">
													<label>Quantidade SetupBox </label>
													<input type="number" class="form-control" value="0" name="total_stb" id="total_stb">
													<div id="macs_stb">
													</div>
												</div>
												<div class="form-group has-feedback" style="display:none" id="div_radios">
													<label>Quantidade Rádios </label>
													<input type="number" class="form-control" value="0" name="total_radio" id="total_radio">
													<div id="macs_radio">
													</div>
												</div>
												<div class="form-group">
								                   <label>Observação ao Estoque</label>
								                      <textarea class="form-control" id="observacao" name="observacao" rows="3" placeholder="Enter ..."></textarea>
								                    </div>
												<div class="form-group has-feedback" style="display:none" id="div_telefones">
													<label>Quantidade Telefones </label>
													<input type="number" class="form-control" value="0" name="telefones" id="telefones">
													<div id="macs_telefones">
													</div>
												</div>
											</div><!-- /.col-md-6 -->
										</div><!-- /.row -->
									</div><!-- /.box-body -->
									<div class="box-footer">
										<div class="btn-group pull-right">
											<button type="submit" class="btn btn-default">
												<i class="fa fa-edit"></i> Cadastrar Solicitação
											</button>
										</div>
									</div><!-- /.box-footer -->
								</form><!-- /#form_cadastro -->
							</div><!-- /.box-body -->
						</div><!-- /.box -->
						<br>
							<br>
							<br>
					      <div class="row">
							<div class="col-xs-12">
								<div class="box box-primary">
									<div class="box-header">
										<h3 class="box-title">Lista de Saídas</h3>
									</div><!-- /.box-header -->
									<div class="box-body">
										<table id="tabelasaida" class="table table-bordered table-hover">
											<!-- Cabeçalho da tabela -->
											<thead>
												<tr>
													<th>Cód</th>
													<th>Supervisor</th>
													<th>Técnico</th>
													<th>Data</th>
													<th>Categoria</th>
													<th>Status</th>
													<th>Estoquista</th>
													<th>Visualizar</th>
												</tr>
											</thead>
											<tbody>
												<?php
												mostrarSolicitacoes();
												?>
											</tbody>
										</table>
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


		<script src="../resources/dist/js/salvarSolicitarMaterial.js"></script>
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
		<script src="../resources/plugins/fastclick/fastclick.min.js"></script>
		<script src="../resources/plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<script src="../resources/plugins/select2/select2.full.min.js"></script>
		<script src="../resources/dist/js/app.min.js"></script>
		<script src="../resources/dist/js/jquery.gritter.min.js"></script>
	    <script src="../resources/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="../resources/plugins/datatables/dataTables.bootstrap.min.js"></script>
		<!-- Page script -->
		<script>
			$(function () {
				$("#tabelasaida").DataTable({
				  "paging": true,
		          "lengthChange": false,
		          "searching": true,
		          "autoWidth": false,
		          "ordering": false,
				})
			});
		</script>
		<script>
			$(function () {
				//Initialize Select2 Elements
				$(".select2").select2();

			});
		</script>
		<?php
		require ('../server/gerarPDF.php');
		?>
	</body>
</html>
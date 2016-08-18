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
					<h1>Saida<small>Equipamentos</small></h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
						<li><a href="#">Saida Materiais</a></li>
						<li class="active">Estoque Técnico</li>
					</ol>
				</section>


				<!-- Main content -->
				<section class="content">
					<div class="col-md-13">
						<div class="box box-default box-solid collapsed-box">
							<div class="box-header with-border">
								<h3 class="box-title">Material Para Técnico</h3>
								<div class="box-tools pull-right">
									<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
								</div><!-- /.box-tools -->
							</div><!-- /.box-header -->
							<div class="box-body" style="display: none;">
								<form method="post"  id="form_salvar_saida">
									<div class="box-body">
										<div class="row">
											<div class="col-md-6">
												<!--DE ACORDO COM O SELECT MOSTRA OS INPUTS-->
												<div class="form-group">
													<label>Função</label>
													<select class="form-control select2" name="funcao" id="funcao"  onchange="exibirCampo()" style="width: 100%;">
														<option value="" disabled selected>Função do Técnico</option>
														<option value="Instalador Combo">Instalador Combo</option>
														<option value="Instalador FTTH">Instalador FTTH</option>
														<option value="Instalador TV">Instalador TV</option>
														<option value="Instalador Rádio">Instalador Rádio</option>
														<option value="Instalador Telefonia">Instalador Telefonia</option>
														<option value="Suporte Rapido Rádio">Suporte Rapido Rádio</option>
														<option value="Suporte Fisico Rádio">Suporte Fisico Rádio</option>
														<option value="Suporte Rapido FTTH">Suporte Rapido FTTH</option>
														<option value="Suporte Fisico FTTH">Suporte Fisico FTTH</option>
													</select>
												</div><!-- /.form-group -->
												<!--ADICIONAR ESTOQUE AO TECNICO SELECIONADO-->
												<label>Selecione o Técnico</label>
												<div class="form-group">
													<select name="id_tecnico" id="id_tecnico" class="form-control select2" onchange="exibirCampo()" style="width: 100%;"  required >
														<option value="" disabled selected>Nome do Técnico</option>
														<?php listarTecnicosAll(); ?>
													</select>
													<input type="hidden" value="validarGerador" name="gerarPDF"/>
												</div>

												<label>Número da OS Intranet</label>
												<div class="form-group">
												<input type="number" class="form-control" value="0" min="0" name="os" id="os" >
												</div>
												<label>Selecione o estoque</label>
												<div class="form-group has-feedback">
													<select  name="estoque_escritorio" id="estoque_escritorio" style="width: 100%;"  class="form-control select2" required >
														<option value="0" selected>Estoque Base</option>
														<?php listarEscritorios(); ?>
													</select>
												</div>
												<div class="form-group has-feedback" id="div_cabo_optico" style="display:none">
													<label>Quantidade Cabo Óptico <small>(Metros)</small></label>
													<input type="number" class="form-control" value="0" min="0"  name="qnt_cabo_optico" id="qnt_cabo_optico"  >
												</div>
												<div class="form-group has-feedback" id="div_cabo_rede" style="display:none">
													<label>Quantidade Cabo Rede <small>(Metros)</small></label>
													<input type="number" class="form-control" value="0" min="0" name="qnt_cabo_rede" id="qnt_cabo_rede"  >
												</div>
												<div class="form-group has-feedback" style="display:none" id="div_conectores">
													<label>Quantidade Conectores SC ACP </label>
													<input type="number" class="form-control" value="0" min="0" name="qnt_conectores" id="qnt_conectores" >
												</div>
												<div class="form-group has-feedback" style="display:none" id="div_conectores2">
													<label>Quantidade Conectores SC PC </label>
													<input type="number" class="form-control" value="0" min="0" name="qnt_conectores2" id="qnt_conectores2" >
												</div>
												<div class="form-group has-feedback" style="display:none" id="div_conectores_rj45">
													<label>Quantidade Conectores RJ45 </label>
													<input type="number" class="form-control" value="0" min="0" name="qnt_conectores_rj45" id="qnt_conectores_rj45">
												</div>
												<div class="form-group has-feedback" style="display:none" id="div_bap">
													<label>Quantidade BAP </label>
													<input type="number" class="form-control" value="0" min="0" name="qnt_bap" id="qnt_bap">
												</div>
											</div><!-- /.col-md-6 -->
											<div class="col-md-6">
												<div class="form-group has-feedback" style="display:none" id="div_onu">
													<label>Quantidade ONU</label>
													<input type="number" class="form-control" onKeyDown="if(event.keyCode==13) event.keyCode=9;"  value="0" min="0" name="onu" id="onu"  >
													<div id="macs_onu">
													</div>
												</div>
												<div class="form-group has-feedback" style="display:none" id="div_stb">
													<label>Quantidade SetupBox </label>
													<input type="number" class="form-control" value="0" min="0" name="stb" id="stb">
													<div id="macs_stb">
													</div>
												</div>
												<div class="form-group has-feedback" style="display:none" id="div_radios">
													<label>Quantidade Rádios </label>
													<input type="number" class="form-control" value="0" min="0" name="radio" id="radio">
													<div id="macs_radio">
													</div>
												</div>
												<div class="form-group has-feedback" style="display:none" id="div_telefones">
													<label>Quantidade Telefones </label>
													<input type="number" class="form-control" value="0" min="0" name="telefones" id="telefones">
													<div id="macs_telefones">
													</div>
												</div>
											</div><!-- /.col-md-6 -->
										</div><!-- /.row -->
									</div><!-- /.box-body -->
									<div class="box-footer">
										<div class="btn-group pull-right">
											<button type="submit" class="btn btn-success">
												<i class="fa fa-edit"></i> Cadastrar Material
											</button>
										</div>
									</div><!-- /.box-footer -->
								</form><!-- /#form_cadastro -->
							</div><!-- /.box-body -->
						</div><!-- /.box -->
						<div class="col-md-13">
							<div class="box box-default box-solid collapsed-box">
								<div class="box-header with-border">
									<h3 class="box-title">Material Escritório</h3>
									<div class="box-tools pull-right">
										<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
									</div><!-- /.box-tools -->
								</div><!-- /.box-header -->
								<div class="box-body" style="display: none;">
									<form method="post"  id="form_salvar_saida_e">
										<div class="box-body">
											<div class="row">
												<div class="col-md-6">
													<!--ADICIONAR ESTOQUE AO TECNICO SELECIONADO-->
													<label>Selecione o Escritório</label>
													<div class="form-group">
														<select name="id_escritorio"  id="id_escritorio" class="form-control select2" style="width: 100%;" onchange="exibirCampo()" required >
															<option value="" disabled selected>Escritórios</option>
															<?php listarEscritorios(); ?>
														</select>
													</div>
												<label>Número da OS Intranet</label>
												<div class="form-group">
												<input type="number" class="form-control" value="0" min="0" name="os" id="os" >
												</div>
													<div class="box box-default box-solid collapsed-box">
														<div class="box-header with-border">
															<h3 class="box-title">Quantitativos</h3>
															<div class="box-tools pull-right">
																<button class="btn btn-box-tool" data-widget="collapse">
																	<i class="fa fa-plus"></i>
																</button>
															</div><!-- /.box-tools -->
														</div><!-- /.box-header -->
														<div class="box-body" style="display: none;">
															<div class="form-group has-feedback" id="div_cabo_optico" >
																<label>Quantidade Cabo Óptico <small>(Metros)</small></label>
																<input type="number" class="form-control" value="0" min="0" name="qnt_cabo_optico_e" id="qnt_cabo_optico_e"  >
															</div>
															<div class="form-group has-feedback" id="div_cabo_rede" >
																<label>Quantidade Cabo Rede <small>(Metros)</small></label>
																<input type="number" class="form-control" value="0" min="0" name="qnt_cabo_rede_e" id="qnt_cabo_rede_e"  >
															</div>
															<div class="form-group has-feedback"  id="div_conectores">
																<label>Quantidade Conectores SC ACP </label>
																<input type="number" class="form-control" value="0" min="0" name="qnt_conectores_e" id="qnt_conectores_e" >
															</div>
															<div class="form-group has-feedback"  id="div_conectores2">
																<label>Quantidade Conectores SC PC </label>
																<input type="number" class="form-control" value="0" min="0" name="qnt_conectores2_e" id="qnt_conectores2_e" >
															</div>
															<div class="form-group has-feedback"  id="div_conectores_rj45">
																<label>Quantidade Conectores RJ45 </label>
																<input type="number" class="form-control" value="0" min="0" name="qnt_conectores_rj45_e" id="qnt_conectores_rj45_e">
															</div>
															<div class="form-group has-feedback"  id="div_bap">
																<label>Quantidade BAP </label>
																<input type="number" class="form-control" value="0" min="0" name="qnt_bap_e" id="qnt_bap_e">
															</div>
														</div><!-- /.col-md-6 -->
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group has-feedback"  id="div_onu">
														<label>Quantidade de ONU</label>
														<input type="number" class="form-control"   value="0" min="0" name="onu_e" id="onu_e"  >
														<div id="macs_onu_e">
														</div>
													</div>
													<div class="form-group has-feedback"  id="div_stb">
														<label>Quantidade de SetupBox </label>
														<input type="number" class="form-control" value="0" min="0" name="stb_e" id="stb_e">
														<div id="macs_stb_e">
														</div>
													</div>
													<div class="form-group has-feedback"  id="div_radios">
														<label>Quantidade de Rádios </label>
														<input type="number" class="form-control" value="0" min="0" name="radio_e" id="radio_e">
														<div id="macs_radio_e">
														</div>
													</div>
													<div class="form-group has-feedback"  id="div_telefones">
														<label>Quantidade de Telefones </label>
														<input type="number" class="form-control" value="0" min="0" name="telefones_e" id="telefones_e">
														<div id="macs_telefones_e">
														</div>
													</div>
												</div><!-- /.col-md-6 -->
											</div><!-- /.row -->
										</div><!-- /.box-body -->
										<div class="box-footer">
											<div class="btn-group pull-right">
												<button type="submit" class="btn btn-success">
													<i class="fa fa-edit"></i> Cadastrar Materiais
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
								<div class="box box-default">
									<div class="box-header">
										<h3 class="box-title">Lista de Saídas</h3>
									</div><!-- /.box-header -->
									<div class="box-body">
										<table id="tabelasaida" class="table table-bordered table-hover">
											<!-- Cabeçalho da tabela -->
											<thead>
												<tr>
													<th>OS Intranet</th>
													<th>OS Sistema</th>
													<th>Data da Saída</th>
													<th>Horário</th>
													<th>Ação</th>
													<th>Usuário</th>
													<th>Base</th>
													<th>Gerar PDF</th>
												</tr>
											</thead>
											<tbody>
												<?php
												mostrarSaidasLogs();
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


		<script type="text/javascript">
			$(function(){
			$('#id_escritorio').change(function(){
				if( $(this).val() ) {
					$.getJSON('solicitacoes.ajax.php?search=',{
						id: $(this).val(),
						estoque: "estoque", 
						ajax: 'info_estoque'}, 
						function(j){
							var valor = [j[0].qnt_bap, j[0].qnt_cabo_optico, j[0].qnt_cabo_rede, j[0].qnt_conectores, j[0].qnt_conectores2, j[0].qnt_conectores_rj45];

							var inputs = ["qnt_bap_e", "qnt_cabo_optico_e", "qnt_cabo_rede_e", "qnt_conectores_e", "qnt_conectores2_e",  "qnt_conectores_rj45_e"];	
							
							for (var i = 0; i< inputs.length; i++) {
								$('#'+inputs[i]).attr({"max" : valor[i]});
							}
					});
				} else {
					$('#cidade').html('<option value="">Escolha um estado</option>');
				}
			});
		});
		</script>
		<!-- AdminLTE App -->
		<!-- jQuery UI 1.11.4 -->


		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
		<script src="../resources/plugins/fastclick/fastclick.min.js"></script>
		<script src="../resources/plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<script src="../resources/dist/js/function_salvar_saida.js"></script>
		<!-- jQuery 2.1.4 -->
		<!-- Select2 -->
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
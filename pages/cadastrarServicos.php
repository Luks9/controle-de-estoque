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
				<h1>Saidas<small>Instalações</small></h1>
				<ol class="breadcrumb">
					<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
					<li><a href="#">Saidas</a></li>
					<li class="active">Cadastrar Serviços</li>
				</ol>
			</section>
			<section class="content">
				<div class="col-md-13">
					<div class="box box-primary">
						<div class="box-header with-border" id="div_header">
							<h3 class="box-title">Cadastrar Serviço</h3>
						</div><!-- /.box-header -->
						<div class="box-body">
							<form method="post" id="formCadastrarInstalacao">
								<div class="box-body">
									<div class="row">
										<div class="col-md-6">
										 <div class="form-group has-feedback">
												<label>Técnico Externo</label>
												<select name="id_tecnico" id="id_tecnico"  class="form-control" required="" >
													<option value="" disabled selected>Técnico</option>
													<?php listarTecnicos(); ?>
												</select>
											</div><!--- /.form-group -->
											<!--Nome do Cliente-->
											<div class="form-group has-feedback">
												<label>Nome do Cliente</label>
												<input type="text" name="nome_cliente" id="nome_cliente" class="form-control" required placeholder="Nome" oninvalid="setCustomValidity('Informe seu nome neste campo ')" onchange="try{setCustomValidity('')}catch(e){}">
												<span class="glyphicon glyphicon-user form-control-feedback"></span>
											</div><!--- /.form-group -->
											<div class="form-group has-feedback">
												<label>Estado</label>
													<select name="estado" id="estado" class="form-control" required >
														<option value="" disabled selected>Estado</option>
														<?php listarEstados(); ?>
													</select>
												</div>
												<!-- Cidade -->
											<div class="form-group has-feedback">
												<label>Cidade</label>
												<select name="cidade" id="cidade" class="form-control" required >
													<option value="">Escolha um estado</option>
												</select>
											</div>
											<!--Data instalação-->
											<div class="form-group has-feedback">
												<label>Data da Instalação</label>
												<input id="data_instalacao" name="data_instalacao" placeholder="Data de Instalação" type="text" class="form-control">
												<span class="glyphicon fa fa-list-alt form-control-feedback"></span>
											</div><!--- /.form-group -->
											<!-- Código SIGEM -->
											<div class="form-group has-feedback">
												<label>Código Instalação SIGEM </label>
												<input type="number" id="cod_instalacao_sigem" name="cod_instalacao_sigem" required="" class="form-control" placeholder="Código Instalação SIGEM">
												<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
											</div><!--- /.form-group -->
											<div class="form-group has-feedback">
												<label>Tipo da Saída</label>
												<select name="tipo" id="tipo"  class="form-control" required >
													<option value="" disabled selected>Tipo</option>
													<option value="nova instalacao">Nova Instalação</option>
													<option value="suporte">Suporte</option>
													<option value="troca tecnologia">Troca de Tecnologia</option>
													<option value="cancelamnto">Cancelamento</option>
												</select>
											</div>
											<!-- Técnico -->
										</div><!-- /.col-md-6 -->
										<div class="col-md-6">
											<!-- Tecnologia -->
											<div class="form-group has-feedback">
												<label>Tecnologia</label>
												<select name="tecnologia" id="tecnologia"  class="form-control" required >
													<option value="" disabled selected>Tipo</option>
													<option value="FTTH">FTTH</option>
													<option value="TV">TV</option>
													<option value="telefonia">Telefonia</option>
													<option value="radio">Wireless</option>
													<option value="combo">Combo</option>
												</select>
											</div><!--- /.form-group -->
											<!--Cabo Optico-->
											<div class="form-group has-feedback" id="div_cabo_optico" style="display:none">
												<label>Quantidade de Cabo Optico <small>(em metros)</small></label>
												<input type="number" class="form-control" min="0" value="0" placeholder="Quantidade de Cabo Optico" id="qnt_cabo_optico" name="qnt_cabo_optico">
												<input type="hidden"   class="form-control" value="<?php echo $usuarioLogado; ?>" id="nome_supervisor" name="nome_supervisor">
											</div><!--- /.form-group -->
											<!--Conectores SC APC-->
											<div class="form-group has-feedback" id="div_conectores" style="display:none" >
												<label>Quantidade de Conectores SC APC </label>
												<input type="number"  class="form-control" min="0" value="0" placeholder="Quantidade de Conectores" id="qnt_conectores" name="qnt_conectores">
											</div><!--- /.form-group -->
											<!--Conectores SC PC-->
											<div class="form-group has-feedback" id="div_conectores2" style="display:none" >
												<label>Quantidade de Conectores SC PC</label>
												<input type="number"  class="form-control" min="0" value="0" placeholder="Quantidade de Conectores" id="qnt_conectores2" name="qnt_conectores2">
											</div><!--- /.form-group -->
											<!--ONUs-->
											<div class="form-group has-feedback" id="div_onu" style="display:none">
												<label>Quantidade de ONU</label>
												<input type="text"  class="form-control"   value="0"  placeholder="Quantidade de ONU" id="onu" name="onu">
												<div id="select_onu">
												</div>
											</div><!--- /.form-group -->
											<!--Cabo de Rede-->
											<div class="form-group has-feedback" id="div_rede" style="display:none">
												<label>Quantidade de Cabo Rede <small>(em metros)</small></label>
												<input type="number"  class="form-control" min="0" value="0" placeholder="Quantidade de Cabo Rede" id="qnt_cabo_rede" name="qnt_cabo_rede">
											</div><!--- /.form-group -->
											<!--RJ45-->
											<div class="form-group has-feedback" id="div_rj45" style="display:none">
												<label>Quantidade de Conector RJ45</label>
												<input type="number"  class="form-control" min="0" value="0" placeholder="Quantidade de RJ45" id="qnt_conectores_rj45" name="qnt_conectores_rj45">
											</div><!--- /.form-group -->
											<!--SetupBox-->
											<div class="form-group has-feedback" id="div_stb" style="display:none">
												<label>Quantidade de SetupBox</label>
												<input type="text"  class="form-control" value="0" id="stb" name="stb">
												<div id="select_stb">
												</div>
											</div><!--- /.form-group -->
											<!--BAP-->
											<div class="form-group has-feedback" id="div_bap" style="display:none">
												<label>Quantidade de BAP</label>
												<input type="number"  class="form-control" min="0" value="0"  id="qnt_bap" name="qnt_bap">
											</div><!--- /.form-group -->
											<!--Radio-->
											<div class="form-group has-feedback" id="div_radio" style="display:none">
												<label>Quantidade de Rádio</label>
												<input type="text"  class="form-control" value="0" id="radio" name="radio">
												<div id="select_radio">
												</div>
											</div><!--- /.form-group -->
											<!--Telefone-->
											<div class="form-group has-feedback" id="div_tel" style="display:none">
												<label>Quantidade de Telefone</label>
												<input type="text"  class="form-control" value="0" id="telefones" name="telefones">
												<div id="select_telefones">
												</div>
											</div><!--- /.form-group -->
										<!-- </div> -->
										</div><!-- /.col-md-6 -->
									</div><!-- /.row -->
								</div><!-- /.box-body -->
								<div class="box-footer">
									<div class="btn-group pull-right">
										<button type="submit" class="btn btn-defult"><i class="fa fa-edit"></i> Cadastrar</button>
									</div>
								</div><!-- /.box-footer -->
							</form><!-- /#form_cadastro -->
						</div><!-- /.box-body -->
					</div><!-- /.box -->	
				</div>
			</section><!-- /.content -->
		</div><!-- ./resources/wrapper -->
	</div>

	<script type="text/javascript">
		$(function(){
			$('#estado').change(function(){
				if( $(this).val() ) {
					$('#cidade').hide();
					$('.carregando').show();
					var uf = $(this).val();
					uf = uf.split('/');
					$.getJSON('solicitacoes.ajax.php?search=',{
						cod_estados: uf[0], 
						ajax: 'cidades'}, 
						function(j){
						var options = '<option value=""></option>';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].nome +'/'+uf[1]+ '">'  + j[i].nome + '</option>';
						}	
						$('#cidade').html(options).show();
						$('.carregando').hide();
					});
				} else {
					$('#cidade').html('<option value="">Escolha um estado</option>');
				}
			});
		});
	</script>

	<script type="text/javascript">
	$(function(){
			$('#id_tecnico').change(function(){
				if( $(this).val() ) {
					$.getJSON('solicitacoes.ajax.php?search=',{
						id: $(this).val(), 
						ajax: 'info_estoque'}, 
						function(j){
							var valor = [j[0].qnt_bap, j[0].qnt_cabo_optico, j[0].qnt_cabo_rede, j[0].qnt_conectores, j[0].qnt_conectores2, j[0].qnt_conectores_rj45];
							var inputs = ["qnt_bap", "qnt_cabo_optico", "qnt_cabo_rede", "qnt_conectores", "qnt_conectores2",  "qnt_conectores_rj45"];				
							for (var i = 0; i< inputs.length; i++) {
								$('#'+inputs[i]).attr({"max" : valor[i]});
							}
					});
				}
			});
		});
		
	</script>
	<!-- ======================================================FIM================================================================== -->
	
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
	<script src="../resources/dist/js/scriptpage.js"></script>
    <!-- InputMask -->

	</body>
</html>

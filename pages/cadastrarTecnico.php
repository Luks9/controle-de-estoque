<?php
	// Chamados o arquivo com Menu
	include ('../_headerMenu.php');
	require ('../server/FuncoesDinamicas.php');
?>
<head>
		<script src="../resources/dist/js/functionsDisplay.js"></script>

		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.5 -->
		<link rel="stylesheet" href="../resources/bootstrap/css/bootstrap.min.css">
		<!-- daterange picker -->
		<link rel="stylesheet" href="../resources/plugins/daterangepicker/daterangepicker-bs3.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="../resources/dist/css/AdminLTE.min.css">
		<!-- GRITTER CSS -->
		<link rel="stylesheet" href="../resources/dist/css/skins/_all-skins.min.css">

		<link href="../resources/dist/css/jquery.gritter.css" rel="stylesheet">
</head>

	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>Registros<small>Usuários</small></h1>
					<ol class="breadcrumb">
						<li><a href="http://localhost/sasInstalacoes/pages/index.php"><i class="fa fa-home"></i> Home</a></li>
						<li><a>Registros</a></li>
						<li class="active">Cadastrar Técnico</li>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content">
					<div class="col-md-13">
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Cadastrar Técnico</h3>
							</div><!-- /.box-header -->
							<div class="box-body">
								<form method="post" id="formCadastrarTecnico">
									<div class="box-body">
										<div class="row">
											<div class="col-md-6">
												<!-- Nome -->
												<div class="form-group has-feedback">
													<input type="text" class="form-control" autofocus placeholder="Nome" name="nome" id="nome" required oninvalid="setCustomValidity('Informe seu nome neste campo ')" onchange="try{setCustomValidity('')}catch(e){}">
													<span class="glyphicon glyphicon-user form-control-feedback"></span>
												</div>
												<!-- Estado -->
												<div class="form-group has-feedback">
													<select name="estado" id="estado" class="form-control" required >
														<option value="" disabled selected>Estado</option>
														<?php listarEstados(); ?>
													</select>
												</div>
												<!-- Cidade -->
												<div class="form-group has-feedback">
													<select name="cidade" id="cidade" class="form-control" required >
														<option value="">Escolha um estado</option>
												
													</select>
												</div>
												<!--Email-->
												<div class="form-group has-feedback">
													<input type="email" id="email" name="email" required="" class="form-control" placeholder="Email">
													<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
												</div>
												<!-- Qualificação -->
												<div class="form-group has-feedback">
													<select name="qualificacao" id="qualificacao" class="form-control" required >
														<option value="" disabled selected>Qualificação</option>
														<option value="Ótimo">Ótimo</option>
														<option value="Bom">Bom</option>
														<option value="Regular">Regular</option>
														<option value="Ruim">Ruim</option>
													</select>
												</div>
											</div><!-- /.col-md-6 -->
											<div class="col-md-6">
												<div class="form-group has-feedback">
													<select name="funcao" id="funcao" class="form-control" required >
														<option value="" disabled selected>Função</option>
														<option value="Instalador FTTH">Instalador FTTH</option>
														<option value="Instalador TV">Instalador TV</option>
														<option value="Instalador FTTH/TV">Instalador FTTH/TV</option>
														<option value="Instalador Rádio">Instalador Rádio</option>
														<option value="Instalador Combo">Instalador Combo</option>
														<option value="Suporte Fisico">Suporte Fisico</option>
														<option value="Suporte Rápido">Suporte Rápido</option>
													</select>
												</div>
												<!-- Telefone -->
												<div class="form-group has-feedback">
													<input type="text" class="form-control" placeholder="telefone" id="telefone" name="telefone" required >
													<span class="glyphicon glyphicon-phone form-control-feedback"></span>
												</div>
												<div class="form-group has-feedback">
													<input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" minlength="6">
													<i class="glyphicon glyphicon-lock form-control-feedback" id="olho"></i>
												</div>
												<div cclass="form-group has-feedback">
													<input type="password" class="form-control" name="confirme" id="confirme" placeholder="Confirme Senha">
												</div>
												<!-- Observação -->
												<div class="form-group">
													<label>Observação</label>
													<textarea class="form-control" id="observacao" name="observacao" rows="3" required="" placeholder="Enter ..."></textarea>
												</div>
											</div><!-- /.col-md-6 -->
										</div><!-- /.row -->
									</div><!-- /.box-body -->
									<div class="box-footer">
										<div class="btn-group pull-right">
											<button type="submit" class="btn btn-defult">
												<i class="fa fa-edit"></i> Cadastrar
											</button>
										</div>
									</div><!-- /.box-footer -->
								</form><!-- /#form_cadastro -->
							</div><!-- /.box-body -->
						</div><!-- /.box -->
						<div class="row">
							<div class="col-xs-12">
								<div class="box box-primary">
									<div class="box-header">
										<h3 class="box-title">Lista de Técnicos</h3>
									</div><!-- /.box-header -->
									<div class="box-body">
										<table id="example1" class="table table-bordered table-hover">
											<!-- Cabeçalho da tabela -->
											<thead>
												<tr>
													<th>Nome</th>
													<th>Cidade/UF</th>
													<th>E-mail</th>
													<th>Função</th>
													<th>Supervisor</th>
													<th>Editar</th>
													<th>Foto</th>
												</tr>
											</thead>
											<!-- Itens da tabela -->
											<tbody>
												<?php
													require ('../server/conectarBD.php');
													$stmt = $conexao_pdo->prepare("SELECT * FROM t_tecnicos WHERE ativo = true");
													$stmt->execute();
													$result = array();
													while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
														if ($r['situacao'] == 'Ativo') {
															$label = "<span class='label label-success' style='font-size:13px;'>";
														}elseif ($r['situacao'] == 'Bloqueado') {
															$label = "<span class='label label-danger' style='font-size:13px;'>";
														}
														$result[] = $r;
														echo "<tr>";
														echo "<td >" .$r['nome'] . "</td>";
														echo "<td>" . $r['cidade'] . "</td>";
														echo "<td>" . $r['email'] . "</td>";
														echo "<td>" . $label . $r['funcao'] . "</span" . "</td>";
														echo "<td>" . $r['supervisor'] . "</td>";
														echo "<td><i class='fa fa-fw fa-pencil' data-toggle=\"modal\"  data-target=\"#editTecnicos\" onclick='idfunctionTecnicos(" . $r['id'] . ", \"" . $r['nome'] . "\", \"" . $r['cidade'] . "\", \"" . $r['supervisor'] ."\", \"" . $r['funcao'] . "\", \"" . $r['email'] . "\", \"" . $r['telefone'] . "\", \"" . $r['observacao'] . "\")'></i></td>";
														echo "<td><a href='#'><i class='fa fa-fw fa-camera' data-toggle=\"modal\"  data-target=\"#edit\" onclick='idfunction(".$r['id'].")'</i></a></td>";
														echo "</tr>";
													}
												?>
											</tbody>
										</table>
									</div><!-- /.box-body -->
								</div><!-- /.box -->
							</div><!-- /.col-xs-12 -->
						</div><!-- /.row -->
					</div><!-- /.col-md-13 -->
				</section><!-- /.content -->
			</div><!-- /.content-wrapper -->
			<footer class="main-footer">
				<div class="pull-right hidden-xs">
					<b>Versão</b> 1.3.0
				</div>
				<strong>Copyright © 2016 <a href="http://www.brisanet.com.br">SAS - Brisanet Telecomunicações</a>.</strong>
			</footer>
		</div><!-- ./resources/wrapper -->
		<div class="container">
			<!-- Modal -->
			<div class="modal fade" id="edit" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<form method="POST" id="upload">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Alterar foto do Técnico</h4>
							</div>
							<div class="btn btn-default btn-file" style="margin-left:10px;">
								<i class="fa fa-camera"></i> Selectione a foto
								<input type="file" id="foto" name="foto">
								<input type="hidden" id="idtecnico" name="idtecnico">
							</div>
							<div class="modal-footer">
								<!-- <input type="submit" class="btn btn-default" value="Definir foto"> -->
								<button type="submit" class="btn btn-default">Definir foto</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</form>
					</div>
				</div>
			</div>
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
		<!-- MODAL PARA EDIÇÃO DE TECNICOS-->
		<div class="modal fade" id="editTecnicos" role="dialog">
			<div class="modal-dialog modal-lg">
				<form method="POST" id="form_editar_tecnico">
					<div class="box box-primary">
						<div class="modal-content">
							<div class="box-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h3 class="box-title">Editar Técnico</h3>
							</div>
							<div class="modal-body">
								<div class="box-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Nome</label>
												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-edit"></i>
													</div>
													<input id="t_nome" name="t_nome" type="text" class="form-control" required autofocus>
												</div>
											</div><!-- /.form-group -->
											<div class="form-group" id="div_gerad">
												<label>Cidade</label>
												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-bolt"></i>
													</div>
													<input id="t_cidade" name="t_cidade" type="text" required class="form-control">
												</div>
											</div><!-- /.form-group -->
											<div class="form-group" id="div_cons">
												<label id="pot">Email</label>
												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-bolt"></i>
													</div>
													<input id="t_email" name="t_email" type="text" required class="form-control">
												</div>
											</div><!-- /.form-group -->
										</div><!-- /.col -->
										<div class="col-md-6">
											<div class="form-group">
												<label>Supervisor</label>
												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-edit"></i>
													</div>
													<select name="t_supervisor" id="t_supervisor" class="form-control"  required >
														<?php listarSupervisores() ?>
													</select>
												</div>
											</div><!-- /.form-group -->
											<div class="form-group">
												<label>Função</label>
												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-warning"></i>
													</div>
													<select name="t_funcao" id="t_funcao" class="form-control" required >
														<option value="" disabled selected>Função</option>
														<option value="Instalador FTTH">Instalador FTTH</option>
														<option value="Instalador TV">Instalador TV</option>
														<option value="Instalador FTTH/TV">Instalador FTTH/TV</option>
														<option value="Instalador Rádio">Instalador Rádio</option>
														<option value="Instalador Combo">Instalador Combo</option>
														<option value="Suporte Fisico">Suporte Fisico</option>
														<option value="Suporte Rápido">Suporte Rápido</option>
													</select>
												</div>
											</div><!-- /.form-group -->
											<div class="form-group">
												<label>Telefone</label>
												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-edit"></i>
													</div>
													<input type="hidden" id="t_id" name="t_id"  type="text" class="form-control" >
													<input id="t_telefone" name="t_telefone" type="text" required class="form-control">
												</div>
											</div><!-- /.col -->
											<div class="form-group">
												<label>Obervação</label>
												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-edit"></i>
													</div>
													<textarea class="form-control" id="t_obs" name="t_obs" rows="3"></textarea>
												</div>
											</div><!-- /.col -->
										</div><!-- /.row -->
									</div><!-- /.box-body -->
								</div><!-- /.box -->
							</div>
							<div class="modal-footer">
								<button type="button" id="rm" onclick="apagar('true','tecnico')" class="btn btn-danger"><b>Remover Tecnico</b></button>
								<button type="submit" class="btn btn-primary">Salvar</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script>
			function idfunctionTecnicos(a, b, c, d, e, f, g, h) {
				$("#t_id").val(a);
				$("#t_nome").val(b);
				$("#t_cidade").val(c);
				$("#t_supervisor").val(d);
				$("#t_funcao").val(e);
				$("#t_email").val(f);
				$("#t_telefone").val(g);
				$("#t_obs").text(h);
			}
		</script>
		<script>
			function idfunction(a) {
				$("#idtecnico").val(a);
			}
		</script>
		<script src="../resources/dist/js/delete_registro.js"></script>
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
		<script src=" ../resources/dist/js/functionUpload2.js"></script>
		<!-- page script -->
		<script>
			$(function () {
				$("#example1").DataTable();
				$("#cpf").inputmask("###.###.###-##");
				$("#telefone").inputmask("(###) ####-#####");
				$("#s_telefone").inputmask("(###) ####-#####");
			});
		</script>
		<script type="text/javascript">
			$('#formCadastrarTecnico').submit(function() {
				// Convertemos os dados do formulário para Objeto
				var dados = {};
				$('#formCadastrarTecnico').serializeArray().map(function(x){dados[x.name] = x.value;}); 
				console.log(dados.senha);
				if (dados.senha != dados.confirme) {
					alert("Senhas não coincidem");
				}else{
				// Configurações para a requisição Ajax
					$.ajax({
						type: "POST",
						url: "/sasInstalacoes/server/cadastrarTecnico.php",
						data: dados,
						success: function( data ) {
							console.log(data);
							if (data == false) {
								jQuery.gritter.add({
									title: 'Técnico Cadastrado com Sucesso!',
									text: 'Você será redirecionado',
									class_name: 'growl-success',
									image: '/sasInstalacoes/resources/images/shield-ok-icon.png',
									sticky: false,
									time: '2000',
								});
								window.setTimeout("location.href=''",1000);
							}else if(data == true) {
								jQuery.gritter.add({
									title: 'E-mail já Cadastrado !',
									text: 'Você será redirecionado',
									class_name: 'growl-warning',
									image: '/sasInstalacoes/resources/images/shield-warning-icon.png',
									sticky: false,
									time: '1000',
								});
								window.setTimeout("location.href=''",1000);
							}
						}
					});
				}
				return false;
			})
		</script>
		<script type="text/javascript">
			$('#form_editar_tecnico').submit(function() {
				// Convertemos os dados do formulário para Objeto
				var dados = {};
				$('#form_editar_tecnico').serializeArray().map(function(x){dados[x.name] = x.value;});
				// Configurações para a requisição Ajax
				console.log(dados);
				$.ajax({
					type: "POST",
					url: "/sasInstalacoes/server/edit_tecnico.php",
					data: dados,
					success: function( data ) {
						console.log (data);
						if (data == true) {
							jQuery.gritter.add({
								title: 'Técnico Atualizando!',
								text: 'Atualizando...',
								class_name: 'growl-success',
								image: 'http://localhost/Luke/images/shield-ok-icon.png',
								sticky: false,
								time: '1000',
							});
							window.setTimeout("location.href=''",1300);
						}else if(data == false) {
							jQuery.gritter.add({
								title: 'Existem erros no formulario',
								text: 'Existem Campos em Branco',
								class_name: 'growl-danger',
								image: 'http://localhost/Luke/images/shield-error-icon.png',
								sticky: false,
								time: '1000',
							});
							window.setTimeout("location.href=''",1300);
						}
					}
				});
				return false;
			});
		</script>
	</body>
</html>

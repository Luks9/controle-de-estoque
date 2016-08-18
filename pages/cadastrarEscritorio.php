<?php
	// Chamados o arquivo com Menu
	include ('../_headerMenu.php');
?>
		
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>Registros<small>Escritórios</small></h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
						<li><a href="#">Registros</a></li>
						<li class="active">Cadastrar Escritórios</li>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content">
					<div class="col-md-13">
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Cadastrar Escritórios</h3>
							</div><!-- /.box-header -->
							<div class="box-body">
								<form method="post" id="formCadastrarEscritorio">
									<div class="box-body">
										<div class="row">
											<div class="col-md-6">
												<!-- Nome -->
												<div class="form-group has-feedback">
													<input type="text" class="form-control" autofocus placeholder="Ex: Pereiro/CE" name="nome_escritorio" id="nome_escritorio" required oninvalid="setCustomValidity('Informe seu nome neste campo ')" onchange="try{setCustomValidity('')}catch(e){}">
													<span class="glyphicon glyphicon-user form-control-feedback"></span>
												</div>
												<!-- Estado -->
												<div class="form-group has-feedback">
													<select name="estado" id="estado" class="form-control" required >
														<option value="" disabled selected>Estado</option>
														<?php
															require ('../server/conectarBD.php');
															$stmt = $conexao_pdo->prepare("SELECT cod_estados, sigla FROM estados ORDER BY sigla");
															$stmt->execute();
															$result = array();
															while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
																$result[] = $r;
																echo "<option value=".$r['cod_estados'].'/'.$r['sigla'].">".$r['sigla']."</option>";
															} 
														?>
													</select>
												</div>
												<!-- Cidade -->
												<div class="form-group has-feedback">
													<select name="cidade" id="cidade" class="form-control" required >
														<option value="">Escolha um estado</option>
														
													</select>
												</div>
												<!-- Email -->
												<div class="form-group has-feedback">
													<input type="email" id="email" name="email" required="" class="form-control" placeholder="Email">
													<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
												</div>
											</div><!-- /.col-md-6 -->
											<div class="col-md-6">
												<!-- Ramal -->
												<div class="form-group has-feedback">
													<input type="text" class="form-control" placeholder="Ramal" id="ramal" name="ramal" required >
													<span class="glyphicon glyphicon-phone form-control-feedback"></span>
												</div>
												<!-- Observação -->
												<div class="form-group">
													<label>Observação</label>
													<textarea class="form-control" id="observacao" name="observacao" rows="3" placeholder="Observação" required></textarea>
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
										<h3 class="box-title">Lista de Escritórios</h3>
									</div><!-- /.box-header -->
									<div class="box-body">
										<table id="example1" class="table table-bordered table-hover">
											<!-- Cabeçalho da tabela -->
											<thead>
												<tr>
													<th>Nome</th>
													<th>Cidade/UF</th>
													<th>E-mail</th>
													<th>Ramal</th>
												</tr>
											</thead>
											<!-- Itens da tabela -->
											<tbody>
												<?php
													require ('../server/conectarBD.php');
													include('modals.php');
													$stmt = $conexao_pdo->prepare("SELECT * FROM t_escritorios");
													$stmt->execute();
													$result = array();
													while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
														if ($r['situacao'] == 'Ativo') {
															$label = "<span class='label label-success' style='font-size:13px;'>";
														}elseif ($r['situacao'] == 'Bloqueado') {
															$label = "<span class='label label-danger' style='font-size:13px;'>";
														}
														$result[] = $r;
														echo "<tr data-toggle=\"modal\"  data-target=\"#editSuper\" onclick='idfunctionSuper(" . $r['id'] . ", \"" . $r['nome_escritorio'] . "\", \"" . $r['cidade'] . "\", \"" . $r['email'] ."\", \"" . $r['telefone'] . "\", \"" . $r['observacao'] . "\")'>";
														echo "<td >" .$r['nome_escritorio'] . "</td>";
														echo "<td>" . $r['cidade'] . "</td>";
														echo "<td>" . $r['email'] . "</td>";
														echo "<td>" . $label . $r['ramal'] . "</span" . "</td>";
														echo "</tr>";
													}
												?>
											</tbody>
										</table>
									</div><!-- /.box-body -->
								</div><!-- /.box -->
							</div><!-- /.col -->
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
								//console.log(j);
								var options = '<option value=""></option>';	
								for (var i = 0; i < j.length; i++) {
									options += '<option value="' + j[i].nome +'/'+uf[1]+ '">'  + j[i].nome + '</option>';
								}	
								$('#cidade').html(options).show();
								$('.carregando').hide();
							});
						} else {
							$('#cidade').html('<option value="">-- Escolha um estado --</option>');
						}
					});
				});
		</script>
		<script>
			function idfunctionSuper(a, b, c, d, e, f) {
				$("#s_id").val(a);
				$("#s_nome_escritorio").val(b);
				$("#s_cidade").val(c);
				$("#s_email").val(d);
				$("#s_ramal").val(e);
				$("#s_obs").text(f);
			}
		</script>
		<script src="../resources/plugins/datatables/jquery.dataTables.min.js"></script>

		<script src="../resources/plugins/datatables/dataTables.bootstrap.min.js"></script>
		<!-- AdminLTE App -->
		<script src="../resources/dist/js/app.min.js"></script>
		<!-- jQuery UI 1.11.4 -->
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
		<!-- InputMask -->
		<script src="../resources/plugins/input-mask/jquery.inputmask.js"></script>

		<!-- page script -->
		<script>
			$(function () {
				$("#example1").DataTable();
				$("#cpf").inputmask("###.###.###-##");
				$("#ramal").inputmask("####");
			});
		</script>
		<script type="text/javascript">
			$('#formCadastrarEscritorio').submit(function() {
				// Convertemos os dados do formulário para Objeto
				var dados = {};
				$('#formCadastrarEscritorio').serializeArray().map(function(x){dados[x.name] = x.value;}); 
				// Configurações para a requisição Ajax
				$.ajax({
					type: "POST",
					url: "/sasInstalacoes/server/cadastrarEscritorio.php",
					data: dados,
					success: function( data ) {
						if (data == false) {
							jQuery.gritter.add({
								title: 'Escritório Cadastrado com Sucesso!',
								text: 'Você será redirecionado',
								class_name: 'growl-success',
								image: '/sasInstalacoes/resources/images/shield-ok-icon.png',
								sticky: false,
								time: '2000',
							});
							window.setTimeout("location.href=''",1000); 
						}else if(data == true) {
							jQuery.gritter.add({
								title: 'Escritório já Cadastrado !',
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
				return false;
			})
		</script>
	</body>
</html>

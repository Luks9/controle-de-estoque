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
					<h1>Registros<small>Usuários</small></h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
						<li><a href="#">Registros</a></li>
						<li class="active">Cadastrar Supervisor</li>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content">
					<div class="col-md-13">
						<div class="box box-primary box-solid collapsed-box">
							<div class="box-header with-border">
								<h3 class="box-title">Cadastrar Supervisor</h3>
								<div class="box-tools pull-right">
									<button class="btn btn-box-tool" data-widget="collapse">
										<i class="fa fa-plus"></i>
									</button>
								</div><!-- /.box-tools -->
							</div><!-- /.box-header -->
							<div class="box-body" style="display: none;">
								<form method="post" id="formCadastrarSupervisor">
									<div class="box-body">
										<div class="row">
											<div class="col-md-6">
												<!-- Nome -->
												<div class="form-group has-feedback">
													<input type="text" class="form-control" autofocus placeholder="Nome" name="nome" id="nome" required oninvalid="setCustomValidity('Informe seu nome neste campo ')" onchange="try{setCustomValidity('')}catch(e){}">
													<span class="glyphicon glyphicon-user form-control-feedback"></span>
												</div>
												<!-- Cidade -->
												<div class="form-group has-feedback">
													<input type="text" class="form-control" autofocus placeholder="Cidade" name="cidade" id="cidade" required oninvalid="setCustomValidity('Informe seu nome neste campo ')" onchange="try{setCustomValidity('')}catch(e){}">
													<span class="glyphicon glyphicon-home form-control-feedback"></span>
												</div>
												<!-- Email -->
												<div class="form-group has-feedback">
													<input type="email" id="email" name="email" required="" class="form-control" placeholder="Email">
													<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
												</div>
											</div><!-- /.col-md-6 -->
											<div class="col-md-6">
												<!-- Telefone -->
												<div class="form-group has-feedback">
													<input type="text" class="form-control" placeholder="Telefone" id="telefone" name="telefone" required >
													<span class="glyphicon glyphicon-phone form-control-feedback"></span>
												</div>
												<!-- Observação -->
												<div class="form-group">
													<label>Observação</label>
													<textarea class="form-control" id="observacao" name="observacao" rows="3" placeholder="Enter ..."></textarea>
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
										<h3 class="box-title">Lista de Supervisores</h3>
									</div><!-- /.box-header -->
									<div class="box-body">
										<table id="example1" class="table table-bordered table-hover">
											<!-- Cabeçalho da tabela -->
											<thead>
												<tr>
													<th>Nome</th>
													<th>Cidade/UF</th>
													<th>E-mail</th>
													<th>Telefone</th>
												</tr>
											</thead>
											<!-- Itens da tabela -->
											<tbody>
												<?php
													require ('../server/conectarBD.php');
													include('modals.php');
													$stmt = $conexao_pdo->prepare("SELECT * FROM t_supervisores");
													$stmt->execute();
													$result = array();
													while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
														if ($r['situacao'] == 'Ativo') {
															$label = "<span class='label label-success' style='font-size:13px;'>";
														}elseif ($r['situacao'] == 'Bloqueado') {
															$label = "<span class='label label-danger' style='font-size:13px;'>";
														}
														$result[] = $r;
														echo "<tr data-toggle=\"modal\"  data-target=\"#editSuper\" onclick='idfunctionSuper(" . $r['id'] . ", \"" . $r['nome'] . "\", \"" . $r['cidade'] . "\", \"" . $r['email'] ."\", \"" . $r['telefone'] . "\", \"" . $r['observacao'] . "\")'>";
														echo "<td >" .$r['nome'] . "</td>";
														echo "<td>" . $r['cidade'] . "</td>";
														echo "<td>" . $r['email'] . "</td>";
														echo "<td>" . $label . $r['telefone'] . "</span" . "</td>";
														echo "</tr>";
													}
												?>
											</tbody>
										</table>
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
		<script>
			function idfunctionSuper(a, b, c, d, e, f) {
				$("#s_id").val(a);
				$("#s_nome").val(b);
				$("#s_cidade").val(c);
				$("#s_email").val(d);
				$("#s_telefone").val(e);
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
		<!-- InputMask -->
		<script src="../resources/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
		<!-- InputMask -->
		<script src="../resources/plugins/input-mask/jquery.inputmask.extensions.js"></script>
		<script src="../resources/plugins/fastclick/fastclick.min.js"></script>
		<script src="../resources/plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<!-- page script -->
		<script>
			$(function () {
				$("#example1").DataTable();
				$("#cpf").inputmask("###.###.###-##");
				$("#telefone").inputmask("(###) ####-#####");
			});
		</script>
		<script type="text/javascript">
			$('#formCadastrarSupervisor').submit(function() {
				// Convertemos os dados do formulário para Objeto
				var dados = {};
				$('#formCadastrarSupervisor').serializeArray().map(function(x){dados[x.name] = x.value;}); 
				console.log(dados);
				// Configurações para a requisição Ajax
				$.ajax({
					type: "POST",
					url: "/sasInstalacoes/server/cadastrarSupervisor.php",
					data: dados,
					success: function( data ) {
						if (data == false) {
							jQuery.gritter.add({
								title: 'Supervisor Cadastrado com Sucesso!',
								text: 'Você será redirecionado',
								class_name: 'growl-success',
								image: '/sasInstalacoes/resources/images/shield-ok-icon.png',
								sticky: false,
								time: '2000',
							});
							window.setTimeout("location.href=''",1000);
						}
						else if(data == true) {
							jQuery.gritter.add({
								title: 'Supervisor já Cadastrado !',
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

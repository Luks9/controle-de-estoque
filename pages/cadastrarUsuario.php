<?php
	// Chamados o arquivo com Menu
	include ('../_headerMenu.php');
?>
		<link href="../resources/dist/css/jquery.gritter.css" rel="stylesheet">
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>Registros<small>Usuários</small></h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
						<li><a href="http://localhost/Luke/pages/cadastrarUser.php">Registros</a></li>
						<li class="active">Cadastrar Usuário</li>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content">
					<div class="col-md-13">
						<div class="box box-warning box-solid collapsed-box">
							<div class="box-header with-border">
								<h3 class="box-title">Cadastrar Usuário</h3>
								<div class="box-tools pull-right">
									<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
								</div><!-- /.box-tools -->
							</div><!-- /.box-header -->
							<div class="box-body" style="display: none;">
								<form method="post" id="formularioCadastro">
									<div class="box-body">
										<div class="row">
											<div class="col-md-6">
												<!-- Nome -->
												<div class="form-group has-feedback">
													<input type="text" class="form-control" autofocus placeholder="Nome" name="nome" id="nome" required oninvalid="setCustomValidity('Informe seu nome neste campo ')" onchange="try{setCustomValidity('')}catch(e){}">
													<span class="glyphicon glyphicon-user form-control-feedback"></span>
												</div>
												<!-- CPF -->
												<div class="form-group has-feedback">
													<input type="text" class="form-control" placeholder="CPF" name="cpf" id="cpf" required data-inputmask='"mask": "999.999.999-99"' data-mask>
													<span class="glyphicon fa fa-list-alt form-control-feedback"></span>
												</div>
												<!-- Email -->
												<div class="form-group has-feedback">
													<input type="email" id="email" name="email" required="" class="form-control" placeholder="Email">
													<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
												</div>
												<!-- Telefone -->
												<div class="form-group has-feedback">
													<input type="text" class="form-control" placeholder="Telefone" name="telefone" id="telefone" required data-inputmask='"mask": "(99) 99999-9999"' data-mask>
													<span class="glyphicon glyphicon-earphone form-control-feedback"></span>
												</div>
											</div><!-- /.col-md-6 -->
											<div class="col-md-6">
												<!-- Setor -->
												<div class="form-group has-feedback">
													<select name="setor" id="setor" class="form-control" required >
														<option value="" disabled selected>Setor</option>
														<option value="instalacoes">Instalações</option>
														<option value="estoquista">Estoquista</option>
														<option value="adm">ADM</option>
													</select>
												</div>
												<!-- User name -->
												<div class="form-group has-feedback">
													<input type="text" class="form-control" placeholder="Usuario" id="usuario" name="usuario" required >
													<span class="glyphicon glyphicon-user form-control-feedback"></span>
												</div>
												<!-- Senha -->
												<div class="form-group has-feedback">
													<input type="password" class="form-control" placeholder="Senha" minlength="5" name="senha" id="senha" onchange="form.senha_c.pattern = this.value;" required >
													<span class="glyphicon glyphicon-lock form-control-feedback"></span>
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
								<div class="box box-warning">
									<div class="box-header">
									<h3 class="box-title">Lista de Usuários</h3>
									</div><!-- /.box-header -->
									<div class="box-body">
										<table id="example1" class="table table-bordered table-hover">
											<!-- Cabeçalho da tabela -->
											<thead>
												<tr>
													<th>Nome</th>
													<th>Usuário</th>
													<th>E-mail</th>
													<th>Situação</th>
													<th>Data Cadastro</th>
													<th>Setor</th>
												</tr>
											</thead>
											<!-- Itens da tabela -->
											<tbody>
												<?php
													require ('../server/conectarBD.php');
													include('modals.php');
													$stmt = $conexao_pdo->prepare("SELECT * FROM t_usuarios");
													$stmt->execute();
													$result = array();
													while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
														if ($r['situacao'] == 'Ativo') {
															$label = "<span class='label label-success' style='font-size:13px;'>";
														}
														elseif ($r['situacao'] == 'Bloqueado') {
															$label = "<span class='label label-danger' style='font-size:13px;'>";
														}
														$result[] = $r;
														echo "<tr data-toggle=\"modal\"  data-target=\"#editUser\" onclick='idfunction(\"" . $r['nome'] . "\",\"" . $r['cpf'] . "\",\"" . $r['email'] . "\",\"" . $r['usuario'] . "\",\"" . $r['setor'] . "\",\"" . $r['telefone'] . "\",\"" . $r['user_id'] . "\");'>";
														echo "<td >" .$r['nome'] . "</td>";
														echo "<td>" . $r['usuario'] . "</td>";
														echo "<td>" . $r['email'] . "</td>";
														echo "<td>" . $label . $r['situacao'] . "</span>" . "</td>";
														echo "<td>" . $r['datacadastro'] . "</td>";
														echo "<td>" . $r['setor'] . "</td>";
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
			function idfunction(a, b, c, d, e, f, g) {
				$("#m_nome").val(a);
				$("#m_cpf").val(b);
				$("#m_email").val(c);
				$("#m_usuario").val(d);
				$("#m_setor").val(e);
				$("#m_telefone").val(f);
				$("#m_id").val(g);
			}
		</script>
		<script src="../resources/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="../resources/plugins/datatables/dataTables.bootstrap.min.js"></script>
		<!-- AdminLTE App -->
		<script src="../resources/dist/js/app.min.js"></script>
		<!-- jQuery UI 1.11.4 -->
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
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
		<script>
			$('#formularioCadastro').submit(function() {
			// Convertemos os dados do formulário para Objeto
			var dados = {};
			$('#formularioCadastro').serializeArray().map(function(x){dados[x.name] = x.value;});
				console.log(dados);
				// Configurações para a requisição Ajax
				$.ajax({
					type: "POST",
					url: "/sasInstalacoes/server/cadastrarUsuario.php",
					data: dados,
					success: function( data ) {
						if (data == false) {
							jQuery.gritter.add({
								title: 'Usuário Cadastrado com Sucesso!',
								text: 'Você será redirecionado',
								class_name: 'growl-success',
								image: '/sasInstalacoes/resources/images/shield-ok-icon.png',
								sticky: false,
								time: '2000',
							});
							window.setTimeout("location.href=''",1000);
						}else if(data == true) {
							jQuery.gritter.add({
								title: 'Usuário já Cadastrado !',
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
			});
		</script>
	</body>
</html>

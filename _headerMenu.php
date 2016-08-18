<?php
	session_start();
	if ($_SESSION['logado'] === true) {
		// Armazenamos alguns valores da sessão a variaveis para serem utilizados no código.
		$usuarioLogado = $_SESSION['nome_usuario'];
		$setorUsuario = $_SESSION['setor'];
		$nomeUsuario = $_SESSION['usuario'];
		$dataCadastro = $_SESSION['datacadastro'];
		$email        = $_SESSION['email'];
		// Chamando o arquivo para realizar o lockscreen
		include ('_validarSession.php');
?>
<!DOCTYPE html>
<html lang="pt">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Controle - Estoque</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.5 -->
		<link rel="stylesheet" href="../resources/bootstrap/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<!-- DataTables -->
		<link rel="stylesheet" href="../resources/plugins/datatables/dataTables.bootstrap.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="../resources/dist/css/AdminLTE.min.css">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
		folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="../resources/dist/css/skins/_all-skins.min.css">
		<link rel="stylesheet" href="../resources/plugins/fullcalendar/fullcalendar.min.css">
		<link rel="stylesheet" href="../resources/plugins/fullcalendar/fullcalendar.print.css" media="print">
		<link rel="stylesheet" href="../resources/plugins/iCheck/flat/blue.css">
		<link href="../resources/dist/css/jquery.gritter.css" rel="stylesheet">
		<link rel="stylesheet" href="../resources/plugins/bootstrap-datepicker-1.5.1/css/bootstrap-datepicker.css">
		<link rel="stylesheet" href="../resources/plugins/select2/select2.min.css">
		<script src="../resources/plugins/jQuery/jQuery-2.1.4.min.js"></script>
		<script src="../resources/dist/js/funcoesHeadMenu.js"></script>

	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<header class="main-header">
				<!-- Logo -->
				<a href="#" class="logo">
					<!-- mini logo for sidebar mini 50x50 pixels -->
					<span class="logo-mini"><b>SCE</b></span>
					<!-- logo for regular state and mobile devices -->
					<span class="logo-lg"><b><img src="../resources/dist/img/logoBrisanet.png" width="155px;" height="30px;" style="padding-top: 5px;"></b></span>
				</a>
				<!-- Header Navbar: style can be found in header.less -->
				<nav class="navbar navbar-static-top" role="navigation" id="navbar">
					<!-- Sidebar toggle button-->
					<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<!-- Notifications: CONFIRMAÇÕES DO ESTOQUE -->
							<li class="dropdown notifications-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="fa fa-check"></i>
									<span class="label label-success" id="alerta"></span>
								</a>
								<ul class="dropdown-menu" id="notificacao">						
								</ul>
							</li>
							<!-- Notifications: SOLICITAR MATERIAL-->
			              <li class="dropdown messages-menu">
			                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
			                  <i class="fa fa-envelope-o"></i>
			                  <span class="label label-default">Material</span>
			                </a>
			                <ul class="dropdown-menu">
			                  <li class="header"></li>
			                  <li>
			                    <!-- inner menu: contains the actual data -->
			                    <ul class="menu">
			                      <li><!-- start message -->
			                        <a href="solicitarMaterial.php">
			                          <div class="pull-left">
			                            <img src="../resources/dist/images/shield-ok-icon.png" class="img-circle" alt="User Image">
			                          </div>
			                          <h4>
			                            Solicitar Material
			                            <small><i class="fa fa-clock-o"></i></small>
			                          </h4>
			                          <p>Solicite material com o Estoque</p>
			                        </a>
			                      </li><!-- end message -->
			                    </ul>
			                  </li>
			                </ul>
			              </li>
							<!-- Usuário Logado no Sistema e Menu Lateral -->
							<li class="dropdown user user-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<span class="hidden-xs" style="font-family:ubuntu;"><i class="fafa-circle-o-notch"></i> Opções do Sistema</span>
								</a>
								<ul class="dropdown-menu">
									<!-- User image -->
									<li class="user-header" action="javascript:perfil();">
										<!-- <img src="../resources/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->
										<p><p> <!--??????-->
										<p>
										<?php
											include ('../server/functionFoto.php');
											function fotoPerfil($foto) {
												echo  "<img src=\"$foto\"class=\"img-circle\"height=\"125px\"width=\"125px\"\/><br>";
											}
											fotoPerfil($image);
											echo $usuarioLogado
										?>
										</p>
									</li>
									<!-- Menu Footer-->
									<li class="user-footer">
										<div class="pull-left">
											<button type="button" class="btn btn-default btn-flat" data-toggle="modal" data-target="#myModal">Alterar Foto</button>
										</div>
										<div class="pull-right">
											<a href="../_deslogarUser.php" class="btn btn-default btn-flat">Deslogar</a>
										</div>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</nav>
			</header>
			<!-- Left side column. contains the logo and sidebar -->
			<aside class="main-sidebar">
				<!-- sidebar: style can be found in sidebar.less -->
				<section class="sidebar">
					<!-- Sidebar user panel -->
					<div class="user-panel">
						<div class="pull-left image">
							<?php
								include ('../server/functionFoto.php');
								function fotoPerfilMenor($foto) {
									echo  "<img src=\"$foto\"class=\"img-circle\"height=\"45px\"width=\"45px\"\/><br><br>";
								}
								fotoPerfilMenor($image);
							?>
						</div>
						<div class="pull-left info">
							<p><?php echo $usuarioLogado; ?></p>
							<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
						</div>
					</div>
					
								<!-- search form -->
					<form action="#" method="get" class="sidebar-form">
						<div class="input-group">
							<input type="text" name="search" id="search" class="form-control" placeholder="Pesquisar por Serial">
							<span class="input-group-btn">
								<button type="button" name="search" id="search-btn" class="btn btn-flat" data-toggle="modal" data-target="#modalSearch" onclick="json()"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</form>
				
					<ul class="sidebar-menu">
						<li class="header">Menu de Navegação</li>
 						<li class="treeview">
							<a href="index.php">
								<i class="fa fa-home"></i> <span>Dashboard</span>
							</a>
						</li>
						<!--
						<li class="treeview">
							<a href="cadastrarServicos.php">
								<i class="fa fa-wrench"></i> <span>Cadastrar Serviço</span>
							</a>
						</li>-->
						<li class="treeview">
							<a href="#">
								<i class="fa fa-plus-square"></i> <span>Cadastro Usuarios</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="cadastrarTecnico.php"><i class="fa fa-circle-o"></i>Cadastrar Técnico</a></li>
						 		<li><a href="cadastrarUsuario.php"><i class="fa fa-circle-o"></i>Cadastrar Usuário</a></li>
								<li><a href="cadastrarEscritorio.php"><i class="fa fa-circle-o"></i>Cadastrar Escritórios</a></li>
							</ul>
						</li>
								
						<li class="treeview">
							<a href="#">
								<i class="fa fa-folder-open-o"></i><span> Estoques</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="listarEstoque.php"><i class="fa fa-user"></i>Técnicos</a></li>
							
								<li><a href="listarEscritorio.php"><i class="fa fa-building-o"></i>Escritórios</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-folder-o"></i><span> Cadastrar Estoque</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="cadastrarSaida.php"><i class="fa fa-circle-o"></i>Cadastrar Material</a></li>
							
								<li><a href="confirmacaoMaterial.php"><i class="fa fa-check"></i>Confirmar Material</a></li>
							</ul>
						</li>
						<!--<li class="treeview">
							<a href="#">
								<i class="fa fa-cube"></i><span> Recolhimento</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="cadastrarRecolhimentoKit.php"><i class="fa fa-exchange"></i>Cadastrar</a></li>
								<li><a href="tecnicosRecolhimento.php"><i class="fa fa-user-plus"></i>Técnicos Recolhimento</a></li>
								<li><a href="relatorioRecolhimentoCidade.php"><i class="fa fa fa-bar-chart"></i>Relatório Recolhidos Por Cidade</a></li>
								<li><a href="relatorioRecolhimentoSituacoes.php"><i class="fa fa fa-bar-chart"></i>Relatório Técnicos Recolhimento</a></li>
								<li><a href="gerarGraficosRecolhimento.php"><i class="fa fa-bar-chart-o"></i>Gráficos</a></li>
							</ul>
						</li>-->
						<!--<li class="treeview">
							<a href="#">
								<i class="fa fa-gear"></i><span> Ferramentas</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="cadastrarFerramentas.php"><i class="fa fa-gears"></i>Ferramentas</a></li>
							</ul>
						</li>-->
						<li class="treeview">
							<a href="#">
								<i class="fa fa-th-large"></i><span> Relatórios</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="mediadeusoEquipamentos.php"><i class="fa fa-pie-chart"></i>Média Material por Data</a></li>
								<li><a href="mediaInstalacaoGeral.php"><i class="fa fa-bar-chart"></i>Média de Material por Data</a></li>
								<!--<li><a href="mediaInstalacao.php"><i class="fa fa-line-chart"></i>Total de Instalação por Técnico</a></li>
								<li><a href="mediaInstalacaoSupervisor.php"><i class="fa fa-bar-chart"></i>Total de Instalação Supervisor</a></li>
								<li><a href="mediaUsoItens.php"><i class="fa fa-area-chart"></i>Total de Material por Data</a></li>-->
							</ul>
						</li>';

					 <!-- cade o fechamento ul??? -->
			
				</section>
			</aside><!-- /.sidebar -->
			<div class="container">
				<!-- Modal -->
				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content">
							<form method="POST" id="uploadPicture">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Alterar foto do perfil</h4>
								</div>
								<div class="btn btn-default btn-file" style="margin-left:10px;">
									<i class="fa fa-camera"></i> Selectione a foto
									<input type="file" id="foto" name="foto">
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
			<!-- MODAL PARA EDIÇÃO DE TECNICOS-->
		
		<div class="modal" id="modalSearch" role="dialog">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
                    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    	<h4 class="modal-title">Procurar Equipamento</h4>
                  	</div>

                  	<div class="modal-body">
                   		 <h4>Serial: <input type="text" lass="form-control" id="serialIn" name="serialIn"></input></h4>
                   		 

	               		 <div class="box">
			                <div class="box-header">
			                </div><!-- /.box-header -->
			                <div class="box-body no-padding">
			                  	<div class="overlay" id="loading" >
      								<i class="fa fa-refresh fa-spin"></i>
			                 		 
			                 		 <pre> Carregando... </pre>
			                  	</div>
			                  		<pre id="pre_info" style="display:none"></pre>
			                  
			                </div><!-- /.box-body -->
			             </div><!-- /.box -->
                  	</div>

                  	<div class="modal-footer">
	                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
	                    <button type="button" class="btn btn-primary" id="btn_procurar" onclick="buscarSerial()">Procurar</button>
                 	 </div>
				</div>
			</div>
		</div>
		
		<!-- jQuery 2.1.4 -->
		<script src="../resources/plugins/jQueryUI/jquery-ui.min.js"></script>
		<script src="../resources/plugins/jQueryUI/jquery-ui.js"></script>
		<!-- Bootstrap 3.3.5 -->
		<script src="../resources/dist/js/jquery.gritter.min.js"></script>
		<script src="../resources/dist/js/functionUpload.js"></script>
		<script src="../resources/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="../resources/plugins/datatables/dataTables.bootstrap.min.js"></script>
		<!-- InputMask -->
		<script src="../resources/plugins/input-mask/jquery.inputmask.js"></script>
		<script src="../resources/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
		<script src="../resources/plugins/input-mask/jquery.inputmask.extensions.js"></script>
		<script src="../resources/plugins/fastclick/fastclick.min.js"></script>
		<script src="../resources/plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<script src="../resources/dist/js/jquery.validate.min.js"></script>
		<script src="../resources/dist/js/modernizr.min.js"></script>
		<script src="../resources/dist/js/pace.min.js"></script>
		<script src="../resources/dist/js/jquery.cookies.js"></script>
		<script src="../resources/dist/js/bootstrap-wizard.min.js"></script>
		<script src="../resources/dist/js/select2.min.js"></script>
		<script src="../resources/dist/js/jquery.maskedinput.min.js"></script>
		<!-- Page script -->
		<script>
			$(function () {
				//Initialize Select2 Elements
				$(".select2").select2();
			});
		</script>
		<!-- Bootstrap 3.3.5 -->
		<script src="../resources/bootstrap/js/bootstrap.min.js"></script>
		<!-- Select2 -->
		<script src="../resources/plugins/select2/select2.full.min.js"></script>
<?php
	} else {
		header('location: /sasInstalacoes');
	}
?>
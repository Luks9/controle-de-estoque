<?php
	// Chamados o arquivo com Menu
	include ('../_headerMenu.php');
	require ('../server/funcoesMaterias.php');
?>
	<head>
		<script src="../resources/dist/js/functionsDisplay.js"></script>

		<link href="../resources/dist/css/jquery.gritter.css" rel="stylesheet">
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Main content -->
				<section class="content">
					<div class="col-md-13">
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Material Solicitado:</h3>
							</div><!-- /.box-header -->
							<div class="box-body">
							<?php

							if($_GET['metodo'] == 'mostrarMaterial')  {
							$id = $_GET['id'];	

							require ('../server/conectarBD.php');
							$consultarSeriais = $conexao_pdo->prepare("SELECT * FROM t_solicitacao_material WHERE id = $id");
							$consultarSeriais->execute();
							$result = array();
							$TotalRegistros = $consultarSeriais->rowCount();
							while($v = $consultarSeriais->fetch(PDO::FETCH_ASSOC))  {
								$result[] = $v;								
								echo '<pre>Data da Solicitação: '.$v['data'].' Realizada por <u>'.$v['supervisor'].'</u> (<b>Situação:</b> '.$v['status'].')

<b>Materiais Solicitados:</b>

Total de Onu:  '.$v['total_onu'].'
Total de SetupBox: '.$v['total_stb'].'
Total de Rádio: '.$v['total_radio'].'
Total de Conector SC ACP: '.$v['total_conector_scapc'].' 
Total de Conector SC PC: '.$v['total_conector_scpc'].' 
Total de Conector RJ 45: '.$v['total_conector_rj45'].'
Total de Cabo de Rede (M): '.$v['total_cabo_rede'].'
Total de Cabo Óptico (M): '.$v['total_cabo_optico'].'
Total de Baps: '.$v['total_bap'].'


Observação Por '.$v['supervisor'].': '.$v['observacao'].'

<b>Alterar Status:</b><a href="/sasInstalacoes/server/funcoesMaterias.php?metodo=alterarStatus&valor=Verificando&id='.$id.'" class="btn btn-app"><i class="fa fa-edit"></i>Verificando</a><a href="/sasInstalacoes/server/funcoesMaterias.php?metodo=alterarStatus&valor=Material Separado&id='.$id.'"  class="btn btn-app"><i class="fa fa-check-square"></i>Separado</a><a href="/sasInstalacoes/server/funcoesMaterias.php?metodo=alterarStatus&valor=Adiado&id='.$id.'" class="btn btn-app"><i class="fa fa-hourglass-half"></i>Adiado</a><a href="/sasInstalacoes/server/funcoesMaterias.php?metodo=alterarStatus&valor=Finalizado&id='.$id.'" class="btn btn-app"><i class="fa fa-check-circle"></i>Finalizar</a>
	
Voltar Pagina: <a href="/sasInstalacoes/pages/solicitarMaterial.php" class="btn btn-app"><i class="fa fa-repeat"></i>voltar</a>
								</pre>';
								}
							}

							?>
							</div><!-- /.box-body -->
						</div><!-- /.box -->
						</div>
					</div> <!-- se der pau tire isso -->
				</section><!-- /.content -->
		<script src="../resources/dist/js/salvarSolicitarMaterial.js"></script>
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
		<script src="../resources/dist/js/jquery.gritter.min.js"></script>
	</body>
</html>
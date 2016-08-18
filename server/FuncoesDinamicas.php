<?php
	function listarTecnicos() {
		/* Listamos os tecnicos referentes ao supervisor em questão */
		require ('conectarBD.php');
		$usuarioLogado = $_SESSION['nome_usuario'];
		$stmt = $conexao_pdo->prepare("SELECT * FROM t_tecnicos WHERE supervisor = '$usuarioLogado' ");
		$stmt->execute();
		$result = array();
		while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $r;
			echo "<option value=".$r['id'].">".$r['nome']."</option>";
		}
	}
	function listarTecnicosAll() {
		require ('conectarBD.php');
		$stmt = $conexao_pdo->prepare("SELECT * FROM t_tecnicos");
		$stmt->execute();
		$result = array();
		while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $r;
			echo "<option value=".$r['id'].">".$r['nome']."</option>";
			//echo "<input type='text' name='nome_tecnico' id='nome_tecnico' value=".$r['nome']." class='form-control'>";
		}
	}

	function listarTecnicosAllSemID() {
		require ('conectarBD.php');
		$stmt = $conexao_pdo->prepare("SELECT * FROM t_tecnicos");
		$stmt->execute();
		$result = array();
		while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $r;
			echo "<option value=".$r['nome'].">".$r['nome']."</option>";
			//echo "<input type='text' name='nome_tecnico' id='nome_tecnico' value=".$r['nome']." class='form-control'>";
		}
	}

	function listarSupervisores() {
		require ('conectarBD.php');
		$stmt = $conexao_pdo->prepare("SELECT * FROM t_usuarios");
		$stmt->execute();
		$result = array();
		while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $r;
			echo "<option>".$r['nome']."</option>";
			//echo "<input type='text' name='nome_tecnico' id='nome_tecnico' value=".$r['nome']." class='form-control'>";
		}
	}
	function listarEquipamentosSerial() {
		require ('conectarBD.php');
		$stmt = $conexao_pdo->prepare("SELECT * FROM t_estoque WHERE (situacao = 'disponivel') AND (tipo = 'mac' or tipo = 'serial') ");
		$stmt->execute();
		$result = array();
		while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $r;
			echo "<option value=".$r['id'].">".$r['nome']."</option>";
		}
	}

	function listarEstados() {
		require ('conectarBD.php');
		$stmt = $conexao_pdo->prepare("SELECT cod_estados, sigla FROM estados ORDER BY sigla");
		$stmt->execute();
		$result = array();
		while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $r;
			echo "<option value=".$r['cod_estados'].'/'.$r['sigla'].">".$r['sigla']."</option>";
		}
	}

	function listarEquipamentosQnt() {
		require ('conectarBD.php');
		$stmt = $conexao_pdo->prepare("SELECT * FROM t_estoque WHERE (tipo = 'qnt') AND (situacao = 'disponivel')");
		$stmt->execute();
		$result = array();
		while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $r;
			echo "<option value=".$r['id'].">".$r['nome']."</option>";
		}
	}
	function listarEscritorios() {
		require ('conectarBD.php');
		$stmt = $conexao_pdo->prepare("SELECT id, nome_escritorio FROM t_escritorios");
		$stmt->execute();
		$result = array();
		while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $r;
			echo "<option value=".$r['id'].">".$r['nome_escritorio']."</option>";
		}
	}
	function listarTabelaInstalacoes() {
		$usuarioLogado = $_SESSION['nome_usuario'];
		$id_tecnico = $_GET['id'];
		require ('conectarBD.php');
		$stmt = $conexao_pdo->prepare("SELECT * FROM t_instalacoes WHERE id_tecnico = '$id_tecnico'");
		$stmt->execute();
		$result = array();
		while($r = $stmt->fetch(PDO::FETCH_ASSOC))   {
			$result[] = $r;
			$m = " Metro(s)";
			echo "<td >" .$r['id_instalacao'] . "</td>";
			echo "<td >" .$r['nome_cliente'] . "</td>";
			echo "<td>" . $r['tecnologia']. "</span>" ."</td>";
			echo "<td>" . $r['data_instalacao'] . "</td>";
			echo "<td>" . $r['cod_instalacao_sigem'] . "</td>";
			echo "<td>" . $r['qnt_cabo_optico'] . $m .  "</span>" . "</td>";
			echo "<td>" . $r['qnt_conectores' ] . /*'<img src="../resources/images/apc.png" width="25px;" height="25px;">' .*/"</td>";
			echo "<td>" . $r['qnt_conectores2'] . "</td>";
			echo "<td>" . $r['tipo'] . "</td>";
			echo "<td> <button type='button' class='btn btn-success' id='form' onclick='passValue(\"". $r['tecnologia']."\",". $r['id_instalacao'].", ". $r['id_tecnico'].", \"" . $r['nome_cliente'] . "\", \"" . $r['qnt_cabo_optico'] . "\", \"" . $r['qnt_conectores'] . "\", \"" . $r['qnt_conectores2'] . "\", \"" . $r['onu'] . "\", \"" . $r['qnt_bap'] . "\", \"" . $r['nome_tecnico'] . "\")' > DEL </button> </td>";
			echo "</tr>";
		}
	}



	function listarTabelaInstalacoesSuporte() {
		$usuarioLogado = $_SESSION['nome_usuario'];
		require ('conectarBD.php');
		$stmt = $conexao_pdo->prepare("SELECT * FROM t_instalacoes, t_tecnicos WHERE t_instalacoes.id_tecnico = t_tecnicos.id 
			AND supervisor  = '$usuarioLogado' AND tipo = 'suporte' ORDER BY id");
		$stmt->execute();
		$result = array();
		while($r = $stmt->fetch(PDO::FETCH_ASSOC))   {
			$result[] = $r;
			$m = " Metro(s)";
			echo "<td >" .$r['nome_cliente'] . "</td>";
			echo "<td>" . $r['data_instalacao'] . "</td>";
			echo "<td>" . $r['tecnologia']. "</span>" ."</td>";
			echo "<td>" . $r['qnt_cabo_optico'] . $m .  "</span>" . "</td>";
			echo "<td>" . $r['qnt_conectores' ] . /*'<img src="../resources/images/apc.png" width="25px;" height="25px;">' .*/"</td>";
			echo "<td>" . $r['qnt_conectores2'] . "</td>";
			echo "<td>" .  $r['nome'] . "</td>";
			echo "<td>" . '<b>' .  $r['supervisor'] . '</b>' . "</td>";
			if ($usuarioLogado == $r['supervisor']) {
				echo "<td> <button type='button' class='btn btn-success' id='form' onclick='passValue(". $r['tecnologia'].",". $r['id_instalacao'].", ". $r['id_tecnico'].", \"" . $r['nome_cliente'] . "\", \"" . $r['qnt_cabo_optico'] . "\", \"" . $r['qnt_conectores'] . "\", \"" . $r['qnt_conectores2'] . "\", \"" . $r['onu'] . "\", \"" . $r['qnt_bap'] . "\")' > DEL </button> </td>";
			} else{
				echo "<td> <button type='button' class='btn btn-danger' id='btn_2' onclick='alerta( \"" . $r['supervisor'] . "\")'> DEL </button> </td>";
			}
			echo "</tr>";
		}
	}





	function listarTotalEstoque() {
		require ('conectarBD.php');
		$stmt = $conexao_pdo->prepare("SELECT SUM(onu) as total_onu, SUM(stb) as total_stb, SUM(radio) as total_radios,
		SUM(telefones) as total_telefones, SUM(qnt_cabo_rede) as total_caborede, SUM(qnt_cabo_optico) as total_cabooptico,
		SUM(qnt_conectores) as total_conectores, SUM(qnt_conectores2) as total_conectores2, SUM(qnt_conectores_rj45) as total_conectores_rj45, SUM(qnt_bap) as total_bap FROM t_estoque_tecnico");
		$stmt->execute();
		$result = array();
		while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $r;
			echo  '<div class="col-md-13">
			<div class="box box-widget widget-user-2">
			<div class="widget-user-header bg-blue">
			<div class="widget-user-image">
			<img class="img-circle" src="../resources/images/ico-sasestoque.png" alt="User Avatar">
			<h3 class="widget-user-username">Estoque Geral do Sistema</h3>
			<h5 class="widget-user-desc">Itens Cadastrados</h5>
			</div>
			<div class="box-footer no-padding">
			<ul class="nav nav-stacked">
			<li><a href="#">Total de ONU <span class="pull-right badge bg-blue">'.$r['total_onu'].'</span></a></li>
			<li><a href="#">Total de SetupBox <span class="pull-right badge bg-red">'.$r['total_stb'].'</span></a></li>
			<li><a href="#">Total de Rádios <span class="pull-right badge bg-green">'.$r['total_radios'].'</span></a></li>
			<li><a href="#">Total de Telefones <span class="pull-right badge bg-aqua">'.$r['total_telefones'].'</span></a></li>
			<li><a href="#">Metros de Cabo de rede <span class="pull-right badge bg-yellow">'.$r['total_caborede'].'</span></a></li>
			<li><a href="#">Metros de Cabo Óptico <span class="pull-right badge bg-blue">'.$r['total_cabooptico'].'</span></a></li>
			<li><a href="#">Total de Conectores SC APC <span class="pull-right badge bg-blue">'.$r['total_conectores'].'</span></a></li>
			<li><a href="#">Total de Conectores SC PC <span class="pull-right badge bg-blue">'.$r['total_conectores2'].'</span></a></li>
			<li><a href="#">Total de Conectores RJ45 <span class="pull-right badge bg-red">'.$r['total_conectores_rj45'].'</span></a></li>
			<li><a href="#">Total de Baps <span class="pull-right badge bg-red">'.$r['total_bap'].'</span></a></li>
			</ul>
			</div>
			</div>
			</div>';
		}
	}
	function listarEstoqueIndividual() {
		require ('conectarBD.php');
		$usuarioLogado = $_SESSION['nome_usuario'];
		$stmt = $conexao_pdo->prepare("SELECT * FROM t_tecnicos WHERE supervisor = '$usuarioLogado'");
		$stmt->execute();
		$result = array();
		while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $r;
			if ($r['qualificacao'] == 'Ótimo') {
				$label = "<span class='label label-success' style='font-size:13px;'>Ótimo</span>";
			}
			elseif ($r['qualificacao'] == 'Bom') {
				$label = "<span class='label label-warning' style='font-size:13px;'>Regular</span>";
			}
			elseif ($r['qualificacao'] == 'Regular') {
				$label = "<span class='label label-warning' style='font-size:13px;'>Regular</span>";
			}
			elseif ($r['qualificacao'] == 'Ruim') {
				$label = "<span class='label label-danger' style='font-size:13px;'>Ruim</span>";
			}
			$image = '../server/Fotos/' . $r['foto'];
			echo '<div class="col-md-4">
			<div class="box box-widget widget-user">
			<div class="widget-user-header bg-aqua-active">
			<h3 class="widget-user-username">'.$r['nome'].'</h3>
			<h5 class="widget-user-desc">'.$r['funcao'].'</h5>
			<a href="./estatisticasIndividual.php?id='.$r['id'].'&nome='.$r['nome'].'"><span class="label label-primary">Perfil</span></a>
			<a href="./estoqueTecnico.php?id='.$r['id'].'"><span class="label label-danger">Estoque</span></a>
			</div>
			<div class="widget-user-image">
			<img src="'.$image.'"   class="img-circle" height="125px" width="125px">
			</div>
			<div class="box-footer">
			<div class="row">
			<div class="col-sm-13">
			<div class="description-block">
			<h5 class="description-header">Qualificação</h5><br>
			<span class="description-text">'.$label.'</span>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>';
		}
	}
	function openEstoque() {
		require ('conectarBD.php');
		$iduser = $_GET['id'];
		$stmt = $conexao_pdo->prepare("SELECT * FROM t_tecnicos WHERE id = '$iduser'");
		$stmt->execute();
		$result = array();
		while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $r;
			$nome = $r['nome'];
			$image = '../server/Fotos/' . $r['foto'];
			echo '<div class="col-md-4">
			<div class="box box-widget widget-user">
			<div class="widget-user-header bg-aqua-active">
			<h3 class="widget-user-username">'.$r['nome'].'</h3>
			<div class="box-tools pull-right">
		      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		    </div>
			<h5 class="widget-user-desc">'.$r['funcao'].'</h5>
			<a href="?open=estoque&id='.$r['id'].'"><span class="label label-danger">Estoque</span></a>
			</div>
			<div class="widget-user-image">
			<img src="'.$image.'"   class="img-circle" height="125px" width="125px">
			</div>
			<div class="box-footer">
			<div class="row">
			<div class="col-sm-13">
			<div class="description-block">
			<h5 class="description-header">Informações Extras</h5><br>
			<span class="description-text">'.$r['telefone'].'</span><br>
			<span class="description-text">'.$r['email'].'</span><br>
			<span class="description-text">'.$r['cidade'].'</span>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>';
		}
		$stmt = $conexao_pdo->prepare("SELECT * FROM t_estoque_tecnico WHERE id_tecnico = '$iduser'");
		$stmt->execute();
		$result = array();
		while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $r;
			echo  '<div class="col-md-8">
			<div class="box box-widget widget-user-2">
			<div class="widget-user-header bg-aqua-active">
			<div class="widget-user-image">
			<img class="img-circle" src="../resources/images/ico-sasestoque.png" alt="User Avatar">
			<h3 class="widget-user-username">Estoque Escritório</h3>
			<h5 class="widget-user-desc">Material</h5>
			</div>
			<div class="box-footer no-padding">
			<ul class="nav nav-stacked">
			<li><a href="/sasInstalacoes/pages/estoque_serializado.php?Mostrar=onus&id='.$iduser.'&nome='.$nome.'&acao=tecnico">ONU<span class="pull-right badge bg-blue">'.$r['onu'].'</span></a></li>
			<li><a href="/sasInstalacoes/pages/estoque_serializado.php?Mostrar=setupbox&id='.$iduser.'&nome='.$nome.'&acao=tecnico">SetupBox<span class="pull-right badge bg-blue">'.$r['stb'].'</span></a></li>
			<li><a href="/sasInstalacoes/pages/estoque_serializado.php?Mostrar=telefone&id='.$iduser.'&nome='.$nome.'&acao=tecnico">Rádios <span class="pull-right badge bg-blue">'.$r['radio'].'</span></a></li>
			<li><a href="/sasInstalacoes/pages/estoque_serializado.php?Mostrar=radio&id='.$iduser.'&nome='.$nome.'&acao=tecnico">Telefones <span class="pull-right badge bg-blue">'.$r['telefones'].'</span></a></li>
			<li><a href="#">Metros de Cabo de rede <span class="pull-right badge bg-aqua">'.$r['qnt_cabo_rede'].'</span></a></li>
			<li><a href="#">Metros de Cabo Óptico <span class="pull-right badge bg-aqua">'.$r['qnt_cabo_optico'].'</span></a></li>
			<li><a href="#">Baps<span class="pull-right badge bg-aqua">'.$r['qnt_bap'].'</span></a></li>
			<li><a href="#">Conectores SC APC<span class="pull-right badge bg-red">'.$r['qnt_conectores'].'</span></a></li>
			<li><a href="#">Conectores SC PC<span class="pull-right badge bg-red">'.$r['qnt_conectores2'].'</span></a></li>
			<li><a href="#">Conectores RJ45<span class="pull-right badge bg-red">'.$r['qnt_conectores_rj45'].'</span></a></li>
			</ul>
			</div>
			</div>
			</div>';
		}
	}

	function mostrarSeriais() {
		require ('conectarBD.php');
		//recebo o ID e nome do Técnico
		$id = $_GET['id'];
		$acao = $_GET['acao'];
		$nome_Tecnico = $_GET['nome'];
		// verifico qual metodo foi solicitado e mudo as variaveis
		if ($_GET['Mostrar'] == 'onus') {
			$iten = 'ONU';
			$nome = 'Onus Cadastradas';
		}elseif($_GET['Mostrar'] == 'setupbox') {
			$iten = 'setupBox';
			$nome = 'SetupBox Cadastradas';
		}elseif($_GET['Mostrar'] == 'telefone') {
			$iten = 'telefone';
			$nome = 'Telefones Cadastradas';
		}elseif($_GET['Mostrar'] == 'radio') {
			$iten = 'radio';
			$nome = 'Rádios Cadastradas';
		}
		$consultarSeriais = $conexao_pdo->prepare("SELECT * FROM t_estoque_serializados, t_estoque_tecnico
		WHERE t_estoque_serializados.id_estoque_quantidade = t_estoque_tecnico.id AND (id_tecnico = '$id') AND (nome = '$iten') AND (status = true) ");
		$consultarSeriais->execute();
		$result = array();
		$TotalRegistros = $consultarSeriais->rowCount();
		while($v = $consultarSeriais->fetch(PDO::FETCH_ASSOC))  {
			$result[] = $v;
			echo "<td>" .$v['nome'] . "</td>";
			echo "<td>" .$v['serial'] . "</td>";
			echo "</tr>";
		}
		if ($acao == 'tecnico') {
	      echo '<a class="btn btn-app" href="/sasInstalacoes/pages/estoqueTecnico.php?id='.$id.'">
			<i class="fa fa-repeat"></i> Voltar ao Estoque
			</a>
			<a class="btn btn-app">
			<span class="badge bg-green">'.$TotalRegistros.'</span>
			<i class="fa fa-barcode"></i> Seriais
		  </a>';
		}
		else {
			$acao = NULL;
		}
	}

	function listarEstoqueEscritorios() {
		require ('conectarBD.php');
		$usuarioLogado = $_SESSION['nome_usuario'];
		$stmt = $conexao_pdo->prepare("SELECT * FROM t_escritorios ");
		$stmt->execute();
		$result = array();
		while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $r;
			echo '<div class="col-md-4">
			<div class="box box-widget widget-user">
			<div class="widget-user-header bg-blue-active">
			<h3 class="widget-user-username">'.$r['nome_escritorio'].'</h3>
			<h5 class="widget-user-desc">'.'Ramal: '.$r['ramal'].'</h5>
			<a href="./estoqueEscritorio.php?id='.$r['id'].'"><span class="label label-warning" style="font-size:12px;">LISTAR MATERIAL</span></a>
			</div>
			<div class="box-footer">
			<div class="row">
			<div class="col-sm-13">
			</div>
			</div>
			</div>
			</div>
			</div>';
		}
	}


	function openEstoqueEscritorio() {
		require ('conectarBD.php');
		$iduser = $_GET['id'];
		$stmt = $conexao_pdo->prepare("SELECT * FROM t_escritorios WHERE id = '$iduser'");
		$stmt->execute();
		$result = array();
		while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $r;
			$nome = $r['nome_escritorio'];
			echo '<div class="col-md-4">
			<div class="box box-widget widget-user">
			<div class="widget-user-header bg-aqua-active">
			<h3 class="widget-user-username">'.$r['nome_escritorio'].'</h3>
			<h5 class="widget-user-desc">'.$r['funcao'].'</h5>
			<a href="#"><span class="label label-primary">Informações do Escritório</span></a>
			<a href="#"><span class="label label-warning">Estoque Base</span></a>
			</div>
			<div class="widget-user-image">
			</div>
			</div>
			</div>';
		}
		$stmt = $conexao_pdo->prepare("SELECT * FROM t_escritorios WHERE id = '$iduser'");
		$stmt->execute();
		$result = array();
		while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $r;
			echo  '<div class="col-md-8">
			<div class="box box-widget widget-user-2">
			<div class="widget-user-header bg-aqua-active">
			<div class="widget-user-image">
			<img class="img-circle" src="../resources/images/ico-sasestoque.png" alt="User Avatar">
			<h3 class="widget-user-username">Estoque Escritório</h3>
			<h5 class="widget-user-desc">Material</h5>
			</div>
			<div class="box-footer no-padding">
			<ul class="nav nav-stacked">
			<li><a href="/sasInstalacoes/pages/estoque_serializado_es.php?Mostrar=onus&id='.$iduser.'&nome='.$nome.'&acao=escritorio">ONU<span class="pull-right badge bg-blue">'.$r['onu'].'</span></a></li>
			<li><a href="/sasInstalacoes/pages/estoque_serializado_es.php?Mostrar=setupbox&id='.$iduser.'&nome='.$nome.'&acao=escritorio">SetupBox<span class="pull-right badge bg-blue">'.$r['stb'].'</span></a></li>
			<li><a href="/sasInstalacoes/pages/estoque_serializado_es.php?Mostrar=telefone&id='.$iduser.'&nome='.$nome.'&acao=escritorio">Rádios <span class="pull-right badge bg-blue">'.$r['radio'].'</span></a></li>
			<li><a href="/sasInstalacoes/pages/estoque_serializado_es.php?Mostrar=radio&id='.$iduser.'&nome='.$nome.'&acao=escritorio">Telefones <span class="pull-right badge bg-blue">'.$r['telefones'].'</span></a></li>
			<li><a href="#">Metros de Cabo de rede <span class="pull-right badge bg-aqua">'.$r['qnt_cabo_rede'].'</span></a></li>
			<li><a href="#">Metros de Cabo Óptico <span class="pull-right badge bg-aqua">'.$r['qnt_cabo_optico'].'</span></a></li>
			<li><a href="#">Baps<span class="pull-right badge bg-aqua">'.$r['qnt_bap'].'</span></a></li>
			<li><a href="#">Conectores SC APC<span class="pull-right badge bg-red">'.$r['qnt_conectores'].'</span></a></li>
			<li><a href="#">Conectores SC PC<span class="pull-right badge bg-red">'.$r['qnt_conectores2'].'</span></a></li>
			<li><a href="#">Conectores RJ45<span class="pull-right badge bg-red">'.$r['qnt_conectores_rj45'].'</span></a></li>
			</ul>
			</div>
			</div>
			</div>';
		}
	}


	function mostrarSeriaisEscritorio() {
		require ('conectarBD.php');
		//recebo o ID e nome do Técnico
		$id = $_GET['id'];
		$acao = $_GET['acao'];
		$nome_Tecnico = $_GET['nome'];
		// verifico qual metodo foi solicitado e mudo as variaveis
		if ($_GET['Mostrar'] == 'onus') {
			$iten = 'ONU';
			$nome = 'Onus Cadastradas';
		}elseif($_GET['Mostrar'] == 'setupbox') {
			$iten = 'setupbox';
			$nome = 'SetupBox Cadastradas';
		}elseif($_GET['Mostrar'] == 'telefone') {
			$iten = 'telefone';
			$nome = 'Telefones Cadastradas';
		}elseif($_GET['Mostrar'] == 'radio') {
			$iten = 'radio';
			$nome = 'Rádios Cadastradas';
		}
		$consultarSeriais = $conexao_pdo->prepare("SELECT * FROM t_estoque_serializados, t_escritorios
		WHERE t_estoque_serializados.id_estoque_quantidade = t_escritorios.id  AND (nome = '$iten') AND (id_estoque_quantidade = '$id')");
		$consultarSeriais->execute();
		$result = array();
		$TotalRegistros = $consultarSeriais->rowCount();
		while($v = $consultarSeriais->fetch(PDO::FETCH_ASSOC))  {
			$result[] = $v;
			echo "<td>" .$v['nome'] . "</td>";
			echo "<td>" .$v['serial'] . "</td>";
			echo "<td>".'Escritório'."</td>";
			echo "<td>".$v['data_cadastro_material']."</td>";
			echo "</tr>";
		}
		if ($acao == 'escritorio') {
	      echo '<a class="btn btn-app" href="/sasInstalacoes/pages/estoqueEscritorio.php?id='.$id.'">
			<i class="fa fa-repeat"></i> Voltar ao Estoque
			</a>
			<a class="btn btn-app">
			<span class="badge bg-green">'.$TotalRegistros.'</span>
			<i class="fa fa-barcode"></i> Seriais
		  </a>';
		}
		else {
			$acao = NULL;
		}

	}


/* TECNICOS COM ESTOQUE MINIMO */ 


	function listarItensFTTH() {
		require ('conectarBD.php');
		$usuarioLogado = $_SESSION['nome_usuario'];
		$stmt = $conexao_pdo->prepare("SELECT * FROM t_estoque_tecnico , t_tecnicos WHERE (onu < 5)
		AND t_estoque_tecnico.id_tecnico = t_tecnicos.id AND funcao = 'Instalador FTTH' AND supervisor = '$usuarioLogado'");
		$stmt->execute();
		$total = $stmt->rowCount();
		$result = array();
		while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $r;
			$idtec = $r['id_tecnico'];
			$image = '../server/Fotos/' . $r['foto'];
			echo '
	         <li>
              <img src="'.$image.'" height="75px;" width="75px;" alt="User Image">
              <a class="users-list-name" href="./estoqueTecnico.php?id='.$r['id'].'">'.$r['nome'].'</a>
              <span class="users-list-date">'.$r['funcao'].'</span>
            </li>';
		}
	}


		function listarItensFTTHTV() {
		require ('conectarBD.php');
		$usuarioLogado = $_SESSION['nome_usuario'];
		$stmt = $conexao_pdo->prepare("SELECT * FROM t_estoque_tecnico , t_tecnicos WHERE (onu < 5) AND (stb < 5)
		AND t_estoque_tecnico.id_tecnico = t_tecnicos.id AND funcao = 'Instalador FTTH/TV' AND supervisor = '$usuarioLogado'");
		$stmt->execute();
		$total = $stmt->rowCount();
		$result = array();
		while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $r;
			$idtec = $r['id_tecnico'];
			$image = '../server/Fotos/' . $r['foto'];
			echo '
	         <li>
              <img src="'.$image.'" height="75px;" width="75px;" alt="User Image">
              <a class="users-list-name" href="./estoqueTecnico.php?id='.$r['id'].'">'.$r['nome'].'</a>
              <span class="users-list-date">'.$r['funcao'].'</span>
            </li>';
		}
	}


	function listarItensSetupBOX() {
		require ('conectarBD.php');
		$usuarioLogado = $_SESSION['nome_usuario'];
		$stmt = $conexao_pdo->prepare("SELECT * FROM t_estoque_tecnico , t_tecnicos WHERE (stb < 5)
		AND t_estoque_tecnico.id_tecnico = t_tecnicos.id AND funcao = 'Instalador TV' AND supervisor = '$usuarioLogado'");
		$stmt->execute();
		$total = $stmt->rowCount();
		$result = array();
		while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $r;
			$idtec = $r['id_tecnico'];
			$image = '../server/Fotos/' . $r['foto'];
			echo 
			'<li>
              <img src="'.$image.'" height="75px;" width="75px;" alt="User Image">
              <a class="users-list-name" href="./estoqueTecnico.php?id='.$r['id'].'">'.$r['nome'].'</a>
              <span class="users-list-date">'.$r['funcao'].'</span>
            </li>';
		}
	}
	function listarItensRadio() {
		require ('conectarBD.php');
		$usuarioLogado = $_SESSION['nome_usuario'];
		$stmt = $conexao_pdo->prepare("SELECT * FROM t_estoque_tecnico , t_tecnicos WHERE (radio < 5)
		AND t_estoque_tecnico.id_tecnico = t_tecnicos.id AND funcao = 'Instalador Rádio' AND supervisor = '$usuarioLogado'");
		$stmt->execute();
		$total = $stmt->rowCount();
		$result = array();
		while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $r;
			$idtec = $r['id_tecnico'];
			$image = '../server/Fotos/' . $r['foto'];
			echo 
			'<li>
              <img src="'.$image.'" height="75px;" width="75px;" alt="User Image">
              <a class="users-list-name" href="./estoqueTecnico.php?id='.$r['id'].'">'.$r['nome'].'</a>
              <span class="users-list-date">'.$r['funcao'].'</span>
            </li>';
		}
	}
	function listarItensCombo() {
		require ('conectarBD.php');
		$usuarioLogado = $_SESSION['nome_usuario'];
		$stmt = $conexao_pdo->prepare("SELECT * FROM t_estoque_tecnico , t_tecnicos WHERE (stb < 5)
		AND t_estoque_tecnico.id_tecnico = t_tecnicos.id AND funcao = 'Instalador Combo' AND supervisor = '$usuarioLogado'");
		$stmt->execute();
		$total = $stmt->rowCount();
		$result = array();
		while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $r;
			$idtec = $r['id_tecnico'];
			$image = '../server/Fotos/' . $r['foto'];
			echo 
			'<li>
              <img src="'.$image.'" height="75px;" width="75px;" alt="User Image">
              <a class="users-list-name" href="./estoqueTecnico.php?id='.$r['id'].'">'.$r['nome'].'</a>
              <span class="users-list-date">'.$r['funcao'].'</span>
            </li>';
		}
	}



	function listarRelatorioRecholimento() {
		if($_GET['go']=='buscar'){
				$tempo = $_POST['tempo1'];
				$tempo2 = $_POST['tempo2'];

			$usuarioLogado = $_SESSION['nome_usuario'];
			require ('conectarBD.php');
			$stmt = $conexao_pdo->prepare("SELECT DISTINCT tecnico_selecionado FROM t_recolhimento");
			$stmt->execute();
			$total = $stmt->rowCount();
			$result = array();
			while($r = $stmt->fetch(PDO::FETCH_ASSOC))   {
				$result[] = $r['tecnico_selecionado'];
			}

			$status_equipamento = array();
			for ($i=0; $i < $total; $i++) {
				for ($j=0; $j < 5; $j++) { 
					$status_equipamento[$j]=0;
				}
			 	$stmt = $conexao_pdo->prepare("SELECT status_equipamento FROM t_recolhimento WHERE (tecnico_selecionado = '$result[$i]') AND (data BETWEEN '$tempo' AND '$tempo2')");
				$stmt->execute();

				while($r = $stmt->fetch(PDO::FETCH_ASSOC))   {
					if ($r['status_equipamento']=='Estoque do Técnico') { $status_equipamento[0]++; }
					elseif ($r['status_equipamento']=='Estoque Local') { $status_equipamento[1]++; }	
					elseif ($r['status_equipamento']=='Migrado Estoque') { $status_equipamento[2]++; }	
					elseif ($r['status_equipamento']=='Reutilizado') { $status_equipamento[3]++; }
					elseif ($r['status_equipamento']=='Retornado a Central') { $status_equipamento[4]++; }	
				}
				echo "<td>" .$result[$i] . "</td>";
				echo "<td>" .$status_equipamento[0]. "</td>";
				echo "<td>" .$status_equipamento[1]. "</td>";
				echo "<td>" .$status_equipamento[2]. "</td>";
				echo "<td>" .$status_equipamento[3]. "</td>";
				echo "<td>" .$status_equipamento[4]. "</td>";
				echo "</tr>";
			
			}

		}
	}
?>

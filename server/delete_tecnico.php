<?php
	require('conectarBD.php');
	$erro = false;
	//$supervisor = $_SESSION['nome_usuario'];
	$id =  $_POST['t_id'];
	$stmt3 = $conexao_pdo->prepare("SELECT id, id_tecnico FROM t_estoque_tecnico WHERE id_tecnico = '$id';");
	$stmt3->execute();
	$result3 = array();
	$totalRow = $stmt3-> rowCount();
	while($r3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
		$id_estoque = $r3['id'];
		$id_tecnico = $r3['id_tecnico'];
	}
	if($id_estoque){
		$stmt2 = $conexao_pdo->prepare("SELECT id FROM t_estoque_tecnico WHERE  id_tecnico='$id_tecnico' AND (qnt_cabo_optico <> 0 OR qnt_conectores <> 0 OR qnt_cabo_rede <> 0 OR qnt_conectores_rj45 <> 0 OR qnt_bap <> 0 OR stb <> 0 OR telefones <> 0 OR radio <> 0 OR onu <> 0 OR qnt_conectores2 <> 0 )");
	    $stmt2->execute();
	    $result2 = array();
	    while($r2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
	        $result2[] = $r2;
	        $dependencia = $r2['id'];
	    }
		if ($dependencia) {
			$erro=true;
			echo $erro;
		}else{
		    $pdo_delete = $conexao_pdo->prepare("UPDATE t_tecnicos SET ativo = false WHERE id = '$id';");
			$pdo_delete->execute();
			$erro = false;
			echo $erro;
	    }
	}else{
		$pdo_delete = $conexao_pdo->prepare("UPDATE t_tecnicos SET ativo = false WHERE id = '$id';");
		$pdo_delete->execute();
		$erro = false;
		echo $erro;
	}
?>
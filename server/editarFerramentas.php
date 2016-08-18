<?php
	require('conectarBD.php');
	$erro = true;
	$id = $_POST['id'];
	
	//Verifica se algo foi postado para publicar ou editar
	if ( isset( $_POST ) && ! empty( $_POST ) ) {
		// Cria as variáveis
		foreach ( $_POST as $chave => $valor ) {
			$$chave = $valor;
			// Verifica se existe algum campo em branco
			if ( empty ( $valor ) ) {
				// Preenche o erro
				$erro = false;
			}
		}
		if ( $erro == true ) {
			// Se o usuário não existir, return false pro ajax
			//} else {
			$sql = $conexao_pdo->prepare("UPDATE t_ferramentas_cadastradas SET nome = '$nome', setor = '$setor', tipo = '$tipo' WHERE id_fer = '$id'");
			$sql->execute();
		}
		echo $erro;
	}
?>
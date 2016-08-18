<?php
	require('conectarBD.php');
	$erro = true;
	
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

		$id = $_POST['id'];
		if ( $erro == true ) {
			// Se o usuário não existir, return false pro ajax
			//} else {
			$pdo_insere = $conexao_pdo->prepare("UPDATE t_tecnicos_recolhimento SET nome = ?, setor = ? WHERE id ='$id';");
			$pdo_insere->execute( array($nome, $setor ));

			echo false;
		}

		else {

			echo true;
		}
		
	}
?>
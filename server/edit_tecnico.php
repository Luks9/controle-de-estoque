<?php
	require('conectarBD.php');
	$erro = true;
	$id = $_POST['t_id'];
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
			$pdo_insere = $conexao_pdo->prepare("UPDATE t_tecnicos SET nome = ?, cidade = ?, email = ?, supervisor = ?, funcao = ?, telefone = ?, observacao = ? WHERE id ='$t_id';");
			$pdo_insere->execute( array($t_nome, $t_cidade, $t_email, $t_supervisor, $t_funcao, $t_telefone, $t_obs) );
		}
		echo $erro;
	}
?>
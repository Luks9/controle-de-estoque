<?php
	require('conectarBD.php');
	$erro = true;
	$id = $_POST['id_recolhimento_edit'];
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
			$sql = $conexao_pdo->prepare("UPDATE t_recolhimento SET status_equipamento = '$status_edit', tecnico_selecionado = '$tecnico_edit', cliente = '$cliente_edit', motivo = '$motivo_edit', observacao = '$observacao_edit' WHERE id_recolhimento = '$id'");
			$sql->execute();
		}
		echo $erro;
	}
?>
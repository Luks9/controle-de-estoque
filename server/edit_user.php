<?php
	require('conectarBD.php');
	$erro = true;
	$id = $_POST['m_id'];
	$situacao = 'Ativo';
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
			$pdo_insere = $conexao_pdo->prepare("UPDATE t_usuarios SET nome = ?, cpf = ?, email = ?, setor = ?, usuario = ?, telefone = ?, situacao = ? WHERE user_id ='$m_id';");
			$pdo_insere->execute( array($m_nome, $m_cpf, $m_email, $m_setor, $m_usuario, $m_telefone,$situacao) );
		}
		echo $erro;
	}
?>
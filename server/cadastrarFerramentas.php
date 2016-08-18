<?php
	require('conectarBD.php');

	// Verifica se algo foi postado para publicar ou editar
	if ( isset( $_POST ) && ! empty( $_POST ) ) {
		// Cria as variáveis
		foreach ( $_POST as $chave => $valor ) {
			$$chave = $valor;
			// Verifica se existe algum campo em branco
			if ( empty ( $valor ) ) {
				// Preenche o erro
				$erro = 'Existem campos em branco.';
			}
		}
		// Verifica se as variáveis foram configuradas
		// if ( empty( $nome ) || empty( $cidade ) || empty( $email ) ) {
		// 	$erro = 'Existem campos em branco.';
		// }
		// Verifica se o usuário existe
		$pdo_verifica = $conexao_pdo->prepare('SELECT * FROM t_ferramentas_cadastradas WHERE nome = ?');
		$pdo_verifica->execute( array( $_POST['nome'] ) );
		// Captura os dados da linha
		$user = $pdo_verifica->fetch();
		$user = $user['nome'];
		// Verifica se tem algum erro
			// Se o usuário existir, return true pro ajax
			if ( ! empty( $user ) ) {
				$confirm = true;
				echo $confirm;
				// Se o usuário não existir, return false pro ajax
			} else {
				$pdo_insere = $conexao_pdo->prepare('INSERT INTO t_ferramentas_cadastradas (nome, tipo, serializada,setor) VALUES (?, ?, ?, ?)');
				$pdo_insere->execute( array($nome, $tipo,  $serializada, $setor) );
				$return = false;
				echo $return;
			}
		
	}
?>
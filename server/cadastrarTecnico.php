<?php
	require('conectarBD.php');
	$erro = false;
	$foto = "tecnico.png";
	$supervisor = $_SESSION['nome_usuario'];
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
		$pdo_verifica = $conexao_pdo->prepare('SELECT email FROM t_tecnicos WHERE email = ?');
		$pdo_verifica->execute( array( $email ) );
		// Captura os dados da linha
		$user = $pdo_verifica->fetch();
		$user = $user['email'];
		// Verifica se tem algum erro
		if ( !$erro ) {
			// Se o usuário existir, return true pro ajax
			if ( ! empty( $user ) ) {
				$confirm = true;
				echo $confirm;
				// Se o usuário não existir, return false pro ajax
			} else {
				$pdo_insere = $conexao_pdo->prepare('INSERT INTO t_tecnicos (nome, cidade, email, funcao, supervisor, telefone, foto, observacao, qualificacao, ativo, senha) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
				$pdo_insere->execute( array($nome, $cidade, $email, $funcao, $supervisor, $telefone, $foto, $observacao,$qualificacao, true, md5($senha)) );
				$return = $user;
				echo $return;
			}
		}
	}
?>
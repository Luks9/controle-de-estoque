<?php
	require('conectarBD.php');
	$erro = false;
	$qnt_conectores = 0;
	$qnt_conectores2 = 0;
	$qnt_bap = 0;
	$qnt_cabo_optico = 0;
	$qnt_cabo_rede = 0;
	$qnt_conectores_rj45 = 0;
	$onu = 0;
	$radio = 0;
	$stb = 0;
	$telefones = 0;
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
		if ( empty( $nome_escritorio ) || empty( $cidade ) || empty( $email ) ) {
			$erro = 'Existem campos em branco.';
		}
		// Verifica se o usuário existe
		$pdo_verifica = $conexao_pdo->prepare('SELECT * FROM t_escritorios WHERE nome_escritorio = ?');
		$pdo_verifica->execute( array( $nome_escritorio ) );
		// Captura os dados da linha
	    $user = $pdo_verifica->fetch();
		$user = $user['nome_escritorio'];
		// Verifica se tem algum erro
		if ( ! $erro ) {
			// Se o usuário existir, return true pro ajax
			if ( ! empty( $user ) ) {
					$confirm = true;
					echo $confirm;
			// Se o usuário não existir, return false pro ajax
			} else {
				$pdo_insere = $conexao_pdo->prepare('INSERT INTO t_escritorios (nome_escritorio, cidade, email, ramal, observacao,qnt_cabo_optico,qnt_cabo_rede,
					qnt_conectores,qnt_conectores2,qnt_conectores_rj45,qnt_bap,stb,telefones,radio,onu) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
				$pdo_insere->execute( array($nome_escritorio, $cidade, $email, $ramal, $observacao,
				$qnt_cabo_optico,$qnt_cabo_rede,$qnt_conectores,$qnt_conectores2,$qnt_conectores_rj45,$qnt_bap,$stb,$telefones,$radio,$onu ) );
				$return = false;
				echo $return;
			}
		}
	}
?>
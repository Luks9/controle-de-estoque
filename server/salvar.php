<?php
// mateus e caio
require('conectarBD.php');

$erro = false;

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

	$nomefoto = $username;
	$foto = $_FILES['foto']['tmp_name'];
	move_uploaded_file($foto, '/tmp/' . $nomefoto);

	
	// Verifica se as variáveis foram configuradas
	if ( empty( $name ) || empty( $username ) || empty( $password ) ) {
		$erro = 'Existem campos em branco.';
	}
	
	// Verifica se o usuário existe
	$pdo_verifica = $conexao_pdo->prepare('SELECT * FROM usuarios WHERE nome = ?');
	$pdo_verifica->execute( array( $name ) );
	
	// Captura os dados da linha
    $user = $pdo_verifica->fetch();
	$user = $user['name'];
	// Verifica se tem algum erro
	if ( ! $erro ) {
		// Se o usuário existir, return true pro ajax
		if ( ! empty( $user ) ) {
				$confirm = true;
				echo $confirm;
			
		// Se o usuário não existir, return false pro ajax
		} else {
			$pdo_insere = $conexao_pdo->prepare('INSERT INTO usuarios (name, username, password, foto) VALUES (?, ?, ?, ?)');
			$pdo_insere->execute( array($name, $username, $password, $nomefoto ) );
			$return = false;
			echo $return;
		}
	}
}

?>

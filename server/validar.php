<?php

// mateus e
require('conectarBD.php');
// Une $_SESSION e $POST para verificação
if ( isset( $_POST ) && ! empty( $_POST ) ) {
	$dados_usuario = $_POST;
} 
// Verifica se os campos de usuário e senha existem e se não estão em branco

if (
	isset ( $dados_usuario['username'] ) &&
	isset ( $dados_usuario['password'] )   &&
  ! empty ( $dados_usuario['username'] ) &&
  ! empty ( $dados_usuario['password'] )
) {
	// Faz a consulta do nome de usuário na base de dados
	$pdo_checa_user = $conexao_pdo->prepare('SELECT * FROM usuarios WHERE username = ? LIMIT 1');
	$verifica_pdo = $pdo_checa_user->execute( array( $dados_usuario['username'] ) );

	// Verifica se a consulta foi realizada com sucesso
	if ( ! $verifica_pdo ) {
		$erro = $pdo_checa_user->errorInfo();
		exit( $erro[2] );
	}

		// Busca os dados da linha encontrada
		$fetch_usuario = $pdo_checa_user->fetch();

	// Verifica se a senha do usuário está correta
	if ( $dados_usuario['password'] === $fetch_usuario['password'] ) {

		$success = $fetch_usuario['id'];
		echo $success;

	} else {
		$error = false;
		echo $error;
	}
}

?>
<?php

require('conectarBD.php');
// Une $_SESSION e $POST para verificação
if ( isset( $_POST ) && ! empty( $_POST ) ) {
	$dados_usuario = $_POST;
} else {
	$dados_usuario = $_SESSION;
}
// Verifica se os campos de usuário e senha existem e se não estão em branco

if (
	isset ( $dados_usuario['usuario'] ) &&
	isset ( $dados_usuario['senha'] )   &&
  ! empty ( $dados_usuario['usuario'] ) &&
  ! empty ( $dados_usuario['senha'] )
) {
	// Faz a consulta do nome de usuário na base de dados
	$pdo_checa_user = $conexao_pdo->prepare('SELECT * FROM t_usuarios WHERE usuario = ? LIMIT 1');
	$verifica_pdo = $pdo_checa_user->execute( array( $dados_usuario['usuario'] ) );

	// Verifica se a consulta foi realizada com sucesso
	if ( ! $verifica_pdo ) {
		$erro = $pdo_checa_user->errorInfo();
		exit( $erro[2] );
	}

		// Busca os dados da linha encontrada
		$fetch_usuario = $pdo_checa_user->fetch();

	// Verifica se a senha do usuário está correta
	if ( md5( $dados_usuario['senha']) === $fetch_usuario['senha'] ) {

		// O usuário está logado, alerto e recebo o valor no jquery com ajax
		$_SESSION['logado'] = true;
		$success = $_SESSION['logado'];
		echo $success;
		$_SESSION["timeSession"]  = time() + 20;
		$_SESSION['nome_usuario'] = $fetch_usuario['nome'];
		$_SESSION['usuario']      = $fetch_usuario['usuario'];
		$_SESSION['user_id']      = $fetch_usuario['id'];
		$_SESSION["sessiontime"] = time() + 1920;
		$_SESSION['setor']        = $fetch_usuario['setor'];
		$_SESSION['email']        = $fetch_usuario['email'];
		$_SESSION['datacadastro'] = $fetch_usuario['datacadastro'];
 
		

	} else {
		// Continuar deslogado, alerto e recebo o valor no jquery com ajax
		$_SESSION['logado'] = false;
		$error = $_SESSION['logado'];
		echo $error;
		// Preenche o erro para o usuário
		$_SESSION['login_erro'] = 'Usuário ou senha inválidos';
	}
}

?>
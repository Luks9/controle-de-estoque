<?php
require('conectarBD.php');
session_start();

	// Verifica se o usuário existe
	$pdo_verifica = $conexao_pdo->prepare('SELECT * FROM app_usuarios WHERE usuario = "admin"');


		// Se o usuário existir, return true pro ajax
		if ( ! empty( $user ) ) {
				$confirm = true;
				echo $confirm;
			
		// Se o usuário não existir, return false pro ajax
		} else {

		}
	

?>
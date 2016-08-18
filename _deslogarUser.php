<?php
	// Inicia a sessão
	session_start();
	// Destrói a sessão
	$_SESSION = array();
	session_destroy();
	// Redireciona para a index inicial
	header('location: ./ ');
?>
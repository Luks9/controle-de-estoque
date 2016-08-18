<?php
	session_start();
	if ( isset( $_SESSION["timeSession"] ) ) {
		if ($_SESSION["timeSession"] < time() ) {
			header('location: /sasInstalacoes/server/lockscreen.php');
		} else {
			//Seta mais tempo 60 segundos
			$_SESSION["timeSession"] = time() + 1920;
		}
	} else {
		session_destroy();
		header('location: /sasInstalacoes');
	}
?>

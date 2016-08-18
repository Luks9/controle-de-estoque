<?php
	session_start();
	$usuario = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>SAS Monitor</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.5 -->
		<link rel="stylesheet" href="../resources/bootstrap/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="../resources/dist/css/AdminLTE.min.css">
		<link href="../resources/dist/css/jquery.gritter.css" rel="stylesheet">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="hold-transition lockscreen">
		<!-- Automatic element centering -->
		<div class="lockscreen-wrapper">
			<div class="lockscreen-logo">
				<a href="index2.html"><b>Lock</b>Screen</a>
			</div>
			<!-- User name -->
			<div class="lockscreen-name" style="font-family:ubuntu; color:white;"><?php echo $_SESSION['nome_usuario'];?></div>
			<!-- START LOCK SCREEN ITEM -->
			<div class="lockscreen-item">
				<!-- lockscreen image -->
				<div class="lockscreen-image">
					<?php
						include ('../server/functionFoto.php');
						function fotoPerfil($foto) {
							echo  "<img src=\"$foto\"class=\"img-circle\"height=\"128px\"width=\"128px\"\/><br>";
						}
						fotoPerfil($image);
					?>
				</div>
				<!-- /.lockscreen-image -->
				<!-- lockscreen credentials (contains the form) -->
				<form class="lockscreen-credentials" id="validarLogin" method="post">
					<div class="input-group">
						<input type="hidden" id="usuario" name="usuario" value="<?php echo $usuario;?>"  class="form-control" placeholder="Usuario">
						<input type="password" class="form-control" id="senha" name="senha" placeholder="password">
						<div class="input-group-btn">
							<button class="btn" type="submit"><i class="fa fa-arrow-right text-muted"></i></button>
						</div>
					</div>
				</form><!-- /.lockscreen credentials -->
			</div><br><!-- /.lockscreen-item -->
			<div class="help-block text-center" style="font-family:ubuntu; color:white;">
				Digite sua senha para recuperar a sua sessão
			</div>
			<div class="text-center">
				<a href="http://localhost/sistemasBrisanet/Estoque/">Ou entre com um usuário diferente</a>
			</div>
		</div><!-- /.center -->
		<!-- jQuery 2.1.4 -->
		<script src="../resources/plugins/jQuery/jQuery-2.1.4.min.js"></script>
		<!-- Bootstrap 3.3.5 -->
		<script src="../resources/bootstrap/js/bootstrap.min.js"></script>
		<script src="../resources/dist/js/app.functions.js"></script>
		<script src="../resources/dist/js/jquery-1.11.1.min.js"></script>
		<script src="../resources/dist/js/jquery-migrate-1.2.1.min.js"></script>
		<script src="../resources/dist/js/jquery-ui-1.10.3.min.js"></script>
		<script src="../resources/dist/js/bootstrap.min.js"></script>
		<script src="../resources/dist/js/modernizr.min.js"></script>
		<script src="../resources/dist/js/pace.min.js"></script>
		<script src="../resources/dist/js/retina.min.js"></script>
		<script src="../resources/dist/js/jquery.cookies.js"></script>
		<script src="../resources/dist/js/bootstrap-wizard.min.js"></script>
		<script src="../resources/dist/js/jquery.validate.min.js"></script>
		<script src="../resources/dist/js/select2.min.js"></script>
		<script src="../resources/dist/js/custom.js"></script>
		<script src="../resources/dist/js/jquery.maskedinput.min.js"></script>
		<script src="../resources/dist/js/jquery.gritter.min.js"></script>
		<script src="../resources/dist/js/morris.min.js"></script>
	</body>
</html>

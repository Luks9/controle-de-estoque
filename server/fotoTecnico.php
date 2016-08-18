<?php
	require ('conectarBD.php');
	$usuario = $_SESSION['nome_usuario'];
	$stmt = $conexao_pdo->prepare("SELECT foto FROM t_tecnicos WHERE supervisor = :name LIMIT 1;");
	$stmt->bindParam(':name', $usuario, PDO::PARAM_STR);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$image = '../server/Fotos/' . "" . implode("", $result[0]) . "";
?>

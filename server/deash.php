<?php
	require('conectarBD.php');
	$data1 = $_POST['data1'];
	$data2 = $_POST['data2'];

	$cidade = $_POST['cidade'];
	if ($cidade != "geral") {
		$sql = $conexao_pdo->prepare("SELECT * FROM t_instalacoes WHERE data_instalacao BETWEEN '$data1' AND '$data2' AND cidade ='$cidade'");
		$sql->execute();
		$result = array();
				while($r = $sql->fetch(PDO::FETCH_ASSOC)) {
					$result[] = $r;
				}
		echo (json_encode($result));
	}else{
		$sql = $conexao_pdo->prepare("SELECT * FROM t_instalacoes WHERE data_instalacao BETWEEN '$data1' AND '$data2'");
		$sql->execute();
		$result = array();
				while($r = $sql->fetch(PDO::FETCH_ASSOC)) {
					$result[] = $r;
				}
		echo (json_encode($result));
	}
?>
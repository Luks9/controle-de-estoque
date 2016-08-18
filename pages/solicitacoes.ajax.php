<?php
header( 'Cache-Control: no-cache' );
header( 'Content-type: application/xml; charset="utf-8"', true );
header('Access-Control-Allow-Origin: *'); header('Access-Control-Allow-Methods: GET, POST, PUT');
require ('../server/conectarBD.php');

$cod = $_GET['ajax'];

if ($cod =="info_estoque") {
		$id =$_GET['id'];

		$sql = $conexao_pdo->prepare("SELECT qnt_cabo_optico, qnt_conectores, qnt_conectores2, qnt_cabo_rede, qnt_conectores_rj45, qnt_bap FROM t_estoque_tecnico WHERE id_tecnico = $id");
		$sql->execute();
		$result = array();
				while($r = $sql->fetch(PDO::FETCH_ASSOC)) {
					$result[] = $r;
				}
		echo (json_encode($result));


}elseif($cod =="serial"){
	$serial =  $_GET['valor'];

	$sql = $conexao_pdo->prepare("SELECT nome, localidade, nome_cliente, status, data_cadastro_material FROM t_estoque_serializados WHERE serial = '$serial'");
	$sql->execute();
	$result = array();
			while($r = $sql->fetch(PDO::FETCH_ASSOC)) {
				$result[] = $r;
			}
	echo (json_encode($result));

}elseif ($cod=="cidades") {
	$cod_estados =  $_GET['cod_estados'] ;

	$sql = $conexao_pdo->prepare("SELECT nome FROM cidades WHERE estados_cod_estados = $cod_estados ORDER BY nome");
	$sql->execute();
	$result = array();
		while($r = $sql->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $r;
			
		}
	echo (json_encode($result));

}elseif ($cod=="status") {

	$sql = $conexao_pdo->prepare("SELECT status FROM t_instalacoes, t_tecnicos WHERE status <>'Ok' and t_instalacoes.id_tecnico = t_tecnicos.id");
	$sql->execute();
	$result = array();
	$TotalRegistros = $sql->rowCount();
		while($r = $sql->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $r;
		}
		echo (json_encode($result));

}elseif ($cod=="confirmeMaterial") {

	$id_instalacao =  $_GET['valor'] ;
	$sql = $conexao_pdo->prepare("SELECT serial, nome FROM t_estoque_serializados WHERE id_instalacao = $id_instalacao");
	$sql->execute();
	$result = array();
		while($r = $sql->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $r;
		}
	echo (json_encode($result));

}elseif ($_POST['ajax']=="alterarConfirmacao") {
	$id = $_POST['id_instalacao'];
	$status =  $_POST['id_status'] ;
	
	$sql = $conexao_pdo->prepare("UPDATE t_instalacoes SET status = '$status' WHERE id_instalacao = '$id'");
	$sql->execute();
	
	echo (json_encode($status));
}elseif ($cod=="grafico") {
	$dataAtual = date('Y/m/d');
	$date1 = new DateTime();
	$date2 = new DateTime();
	$date3 = new DateTime();

	$date1->sub(new DateInterval("P1W"));
	$date1 = date_format($date1, 'Y/m/d');
	
	$date2->sub(new DateInterval("P2W"));
	$date2 = date_format($date2, 'Y/m/d');

	$date3->sub(new DateInterval("P3W"));
	$date3 = date_format($date3, 'Y/m/d');

	$sql = $conexao_pdo->prepare("SELECT data_instalacao, tecnologia FROM t_instalacoes WHERE data_instalacao BETWEEN '$date3' and '$dataAtual' and tipo ='nova instalacao'");
	$sql->execute();
	$result = array();
	$TotalRegistros = $sql->rowCount();
		while($r = $sql->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $r;
		}
		$result[] = $dataAtual;
		$result[] = $date1;
		$result[] = $date2;
		$result[] = $date3;
	echo (json_encode($result));

}elseif ($cod=="confirmeRecolhimento") {
	$equip = $_GET['valor2'];
	$id_recolhimento = $_GET['id2'];

	if ($equip == '1'){

		$sql = $conexao_pdo->prepare("SELECT * FROM t_radio_recolhimento WHERE id_recolhimento_fk = '$id_recolhimento'");
		$sql->execute();
		$result = array();
		$TotalRegistros = $sql->rowCount();
			while($r = $sql->fetch(PDO::FETCH_ASSOC)) {
				$result[] = $r;
			}
		echo (json_encode($result));
	}
	if ($equip == '2'){

		$sql = $conexao_pdo->prepare("SELECT * FROM t_onu_recolhimento WHERE id_recolhimento_fk = '$id_recolhimento'");
		$sql->execute();
		$result = array();
		$TotalRegistros = $sql->rowCount();
			while($r = $sql->fetch(PDO::FETCH_ASSOC)) {
				$result[] = $r;
			}
		echo (json_encode($result));
	}
	if ($equip == '3'){

		$sql = $conexao_pdo->prepare("SELECT * FROM t_setupbox_recolhimento WHERE id_recolhimento_fk = '$id_recolhimento'");
		$sql->execute();
		$result = array();
		$TotalRegistros = $sql->rowCount();
			while($r = $sql->fetch(PDO::FETCH_ASSOC)) {
				$result[] = $r;
			}
		echo (json_encode($result));
	}
}elseif ($_POST['ajax']=="alterarRecolhimento") {
		$id = $_POST['id_recolhimento'];
		$status = $_POST['status_recolhimento'];
		$sql = $conexao_pdo->prepare("UPDATE t_recolhimento SET status = '$status' WHERE id_recolhimento = '$id'");
		$sql->execute();
		//echo (json_encode("845"));
}elseif ($_POST['ajax']=="tecnicos") {
	$data1 = $_POST['data1'];
	$data2 = $_POST['data2'];
	$sql = $conexao_pdo->prepare("SELECT t_recolhimento SET status = '$status' WHERE id_recolhimento = '$id'");
	$sql->execute();
	//echo (json_encode("845"));
}elseif ($cod=="estados") {
$sql = $conexao_pdo->prepare("SELECT cod_estados, sigla FROM estados ORDER BY sigla");
$sql->execute();
$result = array();
while($r = $sql->fetch(PDO::FETCH_ASSOC)) {
$result[] = $r;

}
echo (json_encode($result));

}
elseif ($cod =="listarInstalacoesOkMobile") {
		$data = date("Y-m-d");   
		$id =$_GET['id'];
		$sql = $conexao_pdo->prepare("SELECT id_instalacao,tecnologia,data_instalacao,nome_cliente FROM t_instalacoes WHERE tipo = 'nova instalacao' AND data_instalacao = '$data' AND status = 'Ok' AND id_tecnico = $id");
		$sql->execute();
		$result = array();
				while($r = $sql->fetch(PDO::FETCH_ASSOC)) {
					$result[] = $r;
				}
		echo (json_encode($result));
}

elseif ($cod =="listarRecolhimentoOkMobile") {
		$data = date("Y-m-d");   
		$id =$_GET['id'];
		$sql = $conexao_pdo->prepare("SELECT id_instalacao,tecnologia,data_instalacao,nome_cliente FROM t_instalacoes WHERE tipo = 'recolhimento' AND data_instalacao = '$data' AND status = 'Ok' AND id_tecnico = $id");
		$sql->execute();
		$result = array();
				while($r = $sql->fetch(PDO::FETCH_ASSOC)) {
					$result[] = $r;
				}
		echo (json_encode($result));
}
?>

<?php
header( 'Cache-Control: no-cache' );
header( 'Content-type: application/xml; charset="utf-8"', true );
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

	$date1->sub(new DateInterval("P1M"));
	$date1 = date_format($date1, 'Y/m')."/01";
	
	$date2->sub(new DateInterval("P2M"));
	$date2 = date_format($date2, 'Y/m')."/01";

	$date3->sub(new DateInterval("P3M"));
	$date3 = date_format($date3, 'Y/m')."/01";

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

}

// LISTANDO DADOS VIA JSOM PARA GRAFICO JAVASCRIPT POR MÊS
elseif ($cod=="listarRecolhimento") {
$meses = array(
    '01'=>'Janeiro',
    '02'=>'Fevereiro',
    '03'=>'Março',
    '04'=>'Abril',
    '05'=>'Maio',
    '06'=>'Junho',
    '07'=>'Julho',
    '08'=>'Agosto',
    '09'=>'Setembro',
    '10'=>'Outubro',
    '11'=>'Novembro',
    '12'=>'Dezembro'
);
   $mes = $meses[date('m')];


	$sql = $conexao_pdo->prepare("SELECT motivo, COUNT(motivo) totalCOunt FROM t_recolhimento WHERE tipo = 'interno' AND mes = '$mes' GROUP BY motivo ");
	$sql->execute();
	$result = array();
	$TotalAlteracao = $sql->rowCount();
	while($r = $sql->fetch(PDO::FETCH_ASSOC)) {
				$result[] = $r;
			}
	echo (json_encode($result));
}

elseif ($cod=="listarEquipamentosRecolhidos") {
	$sql = $conexao_pdo->prepare("SELECT cidade, COUNT(cidade) totalCount FROM t_recolhimento WHERE tipo = 'interno' AND mes = 'Maio' GROUP BY cidade
");
	$sql->execute();
	$result = array();
	$TotalDevedor = $sql->rowCount();
		while($r = $sql->fetch(PDO::FETCH_ASSOC)) {
				$result[] = $r;
			}
	echo (json_encode($result));
}

elseif ($cod=="confirmeRecolhimento") {
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

	if ($equip == '4'){

		$sql = $conexao_pdo->prepare("SELECT * FROM t_combo_recolhimento WHERE id_recolhimento_fk = '$id_recolhimento'");
		$sql->execute();
		$result = array();
		$TotalRegistros = $sql->rowCount();
			while($r = $sql->fetch(PDO::FETCH_ASSOC)) {
				$result[] = $r;
			}
		echo (json_encode($result));
	}

	if ($equip == '5'){

		$sql = $conexao_pdo->prepare("SELECT * FROM t_celular_recolhimento WHERE id_recolhimento_fk = '$id_recolhimento'");
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
	}
?>
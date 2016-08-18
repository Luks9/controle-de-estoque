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

	$sql = $conexao_pdo->prepare("SELECT status FROM t_instalacoes WHERE status <>'Ok'");
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
}
?>
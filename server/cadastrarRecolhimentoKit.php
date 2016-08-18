<?php

header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: GET, POST, PUT');
	require('conectarBD.php');
	$erro = false;
	if ( isset( $_POST ) && ! empty( $_POST ) ) {
		// Cria as variáveis
		foreach ( $_POST as $chave => $valor ) {
			$$chave = $valor;
			if (empty($valor)) {
				//$erro =true;
			}
		}

		$id_usado = $_POST['id_tecnico'];
		$up1 = $_POST['qnt_cabo_optico'];
		$up2 = $_POST['qnt_conectores'];
		$up3 = $_POST['qnt_cabo_rede'];
		$up4 = $_POST['qnt_conectores_rj45'];
		$up5 = $_POST['qnt_bap'];
		$up6 = $_POST['onu'];
		$up7 = $_POST['radio'];
		$up8 = $_POST['stb'];
		$up9 = $_POST['telefones'];
		$up10 = $_POST['qnt_conectores2'];
		$pConector = 0;
		$pConector2 = 0;
		$nomet ="";
		 $stmt = $conexao_pdo->prepare("SELECT nome FROM t_tecnicos WHERE id='$id_usado'");
    	$stmt->execute();
    	$result2 = array();
     	while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
           $nomet = $r['nome'];
               }

		if($_POST['qnt_conectores']>1){
			$pConector = $qnt_conectores - 1;
			$qnt_conectores = 1;
		}
		if($_POST['qnt_conectores2']>1){
			$pConector2 = $qnt_conectores2 - 1;	
			$qnt_conectores2 =1;
		}
		if ( $erro == false ) {
			$pdo_insere = $conexao_pdo->prepare("INSERT INTO t_instalacoes (nome_cliente, data_instalacao, cod_instalacao_sigem, id_tecnico, tecnologia, qnt_cabo_optico, nome_supervisor, qnt_conectores,qnt_conectores2, onu, qnt_cabo_rede, qnt_conectores_rj45, stb, qnt_bap, radio, telefone, status, tipo, cidade, nome_tecnico) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
			$pdo_insere->execute( array($nome_cliente, $data_instalacao, $cod_instalacao_sigem, $id_tecnico, $tecnologia, $qnt_cabo_optico, $nome_supervisor, $qnt_conectores,$qnt_conectores2, $onu, $qnt_cabo_rede, $qnt_conectores_rj45, $stb, $qnt_bap, $radio, $telefone, 'false', $tipo, $cidade, $nomet) );

			$pdo_insere = $conexao_pdo->prepare("UPDATE t_estoque_tecnico SET qnt_cabo_optico = qnt_cabo_optico + :up1, qnt_conectores = qnt_conectores + :up2 ,qnt_conectores2 = qnt_conectores2 + :up10,
			qnt_cabo_rede = qnt_cabo_rede + :up3, qnt_conectores_rj45 = qnt_conectores_rj45 + :up4, qnt_bap = qnt_bap + :up5, onu = onu + :up6, radio = radio + :up7, stb = stb + :up8, telefones = telefones + :up9
			WHERE id_tecnico = :idPOST");
			
			$pdo_insere->bindParam(':idPOST', $id_usado);
			$pdo_insere->bindParam(':up1', $up1);
			$pdo_insere->bindParam(':up2', $up2);
			$pdo_insere->bindParam(':up3', $up3);
			$pdo_insere->bindParam(':up4', $up4);
			$pdo_insere->bindParam(':up5', $up5);
			$pdo_insere->bindParam(':up6', $up6);
			$pdo_insere->bindParam(':up7', $up7);
			$pdo_insere->bindParam(':up8', $up8);
			$pdo_insere->bindParam(':up9', $up9);
			$pdo_insere->bindParam(':up10', $up10);
			$pdo_insere->execute();
			$stmt = $conexao_pdo->prepare("SELECT id_instalacao FROM t_instalacoes WHERE cod_instalacao_sigem = '$cod_instalacao_sigem' LIMIT 1");
			$stmt->execute();
			$result = array();
			while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$result = $r;
				$id_instalacao = $r['id_instalacao'];
			}


			if ($_POST['onu'] > 0) {
				for ($i=0; $i < $_POST['onu']; $i++) {
					$vlo ='onu_select' . $i;
					$pdo_insere = $conexao_pdo->prepare("UPDATE t_estoque_serializados SET status = true, id_instalacao = '$id_instalacao' ,nome_cliente = '" . $nome_cliente . "' WHERE serial = '" . $_POST[$vlo] . "';");
					$pdo_insere->execute();

				}
			}
			if ($_POST['stb'] > 0) {
				for ($i=0; $i < $_POST['stb']; $i++) {
					$vls ='stb_select' . $i;
					$pdo_insere = $conexao_pdo->prepare("UPDATE t_estoque_serializados SET status = true, id_instalacao = '$id_instalacao' , nome_cliente = '" . $nome_cliente . "' WHERE serial = '" . $_POST[$vls] . "';");
					$pdo_insere->execute();
				}
			}
			if ($_POST['telefones'] > 0) {
				for ($i=0; $i < $_POST['telefones']; $i++) {
					$vlt ='telefone_select' . $i;
					$pdo_insere = $conexao_pdo->prepare("UPDATE t_estoque_serializados SET status = true, id_instalacao = '$id_instalacao' , nome_cliente = '" . $nome_cliente . "' WHERE serial = '" . $_POST[$vlt] . "';");
					$pdo_insere->execute();
				}
			}
			if ($_POST['radio'] > 0) {
				for ($i=0; $i < $_POST['radio']; $i++) {
					$vlr ='radio_select' . $i;
					$pdo_insere = $conexao_pdo->prepare("UPDATE t_estoque_serializados SET status = true, id_instalacao = '$id_instalacao', nome_cliente = '" . $nome_cliente . "' WHERE serial = '" . $_POST[$vlr] . "';");
					$pdo_insere->execute();
				}
			}
		}
		echo $erro;
	}
?>


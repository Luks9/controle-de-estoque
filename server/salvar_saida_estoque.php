<?php
    // chamamos a conexão PDO
	require('conectarBD.php');
    // checamos se todos os dados estão preenchidos
	if ( isset( $_POST ) && ! empty( $_POST ) ) {
		$usuarioLog = $_SESSION['nome_usuario'];
		$data = date('Y-m-d H:i:s');
		$str = "AaBbCcDdEeFf1234567890ghijlm/*)(+&$#@!";
        $gera = str_shuffle($str);
		// Cria as variáveis
		foreach ( $_POST as $chave => $valor ) {
			$$chave = $valor;

		}
		$os = $_POST['os'];
		$generica = $_POST['onu0'];
		$generica2 = $_POST['stb0'];
		$generica3 = $_POST['radio0'];

		 $stmt = $conexao_pdo->prepare("SELECT * FROM t_estoque_serializados");
		 $stmt->execute();
		 $result = array();
		 while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
		 	  $result = $r;
		 	  $total = $r['serial'];
		 	  
		 	if ($generica == $total) {
		 		$valor = 'existi';
		 		echo $valor;
		 		exit;
		 	}
		 	elseif ($generica2 == $total) {
		 		$valor = 'existi';
		 		echo $valor;
		 		exit;
		 	}
		 	elseif ($generica3 == $total) {
		 		$valor = 'existi';
		 		echo $valor;
		 		exit;
		 	}
		 	else {

		 	}
		 }

		$id_usado = $_POST['id_tecnico'];
		$stmt = $conexao_pdo->prepare("SELECT * FROM t_estoque_tecnico WHERE id_tecnico = '$id_usado' LIMIT 1");
		$stmt->execute();
		$result = array();
		while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$variavel = $r['id_tecnico'];
		}
		if ($variavel == $id_usado) {
			$pdo_insere = $conexao_pdo->prepare("UPDATE t_estoque_tecnico SET qnt_cabo_optico = qnt_cabo_optico + :up1, qnt_conectores = qnt_conectores + :up2 ,
			qnt_conectores2 = qnt_conectores2 + :up22, qnt_cabo_rede = qnt_cabo_rede + :up3, qnt_conectores_rj45 = qnt_conectores_rj45 + :up4, qnt_bap = qnt_bap + :up5, onu = onu + :up6, radio = radio + :up7, stb = stb + :up8, telefones = telefones + :up9 	
			WHERE id_tecnico = :idPOST");
			$pdo_insere->bindParam(':idPOST', $id_tecnico);
			$pdo_insere->bindParam(':up1', $qnt_cabo_optico);
			$pdo_insere->bindParam(':up2', $qnt_conectores);
			$pdo_insere->bindParam(':up22', $qnt_conectores2);
			$pdo_insere->bindParam(':up3', $qnt_cabo_rede);
			$pdo_insere->bindParam(':up4', $qnt_conectores_rj45);
			$pdo_insere->bindParam(':up5', $qnt_bap);
			$pdo_insere->bindParam(':up6', $onu);
			$pdo_insere->bindParam(':up7', $radio);
			$pdo_insere->bindParam(':up8', $stb);
			$pdo_insere->bindParam(':up9', $telefones);
			$pdo_insere->execute();
			echo true;
		}else {

			// Caso não prenchido adicionamos o material ao técnico selecionado
			$pdo_insere = $conexao_pdo->prepare("INSERT INTO t_estoque_tecnico (id_tecnico,qnt_cabo_optico,qnt_conectores,qnt_conectores2,qnt_cabo_rede,qnt_conectores_rj45,qnt_bap, onu, radio, stb, telefones) VALUES (?, ? , ?,  ?,  ?, ?, ?, ?, ?, ?, ?);");
			$pdo_insere->execute( array($id_tecnico, $qnt_cabo_optico, $qnt_conectores,$qnt_conectores2, $qnt_cabo_rede, $qnt_conectores_rj45,$qnt_bap, $onu, $radio, $stb, $telefones));
			echo true;
		}	


	    $stmt = $conexao_pdo->prepare("SELECT id, nome, email FROM t_tecnicos WHERE id = '$id_usado' LIMIT 1");
		$stmt->execute();
		$result = array();
		while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result2 = $r['email'];
			$var2 = $result2;
		}

			$var3 = $var2;

		$stmt = $conexao_pdo->prepare("SELECT * FROM t_estoque_tecnico WHERE id_tecnico = '$id_usado' LIMIT 1");
		$stmt->execute();
		$result = array();
		while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result = $r['id'];
			$var = $result;
		}

         $var2 = $var;
		
		if ($estoque_escritorio != 0) {
			//$estoque = $_POST['estoque_escritorio'];
			$pdo_insere = $conexao_pdo->prepare("UPDATE t_escritorios SET qnt_cabo_optico = qnt_cabo_optico - '$qnt_cabo_optico', qnt_conectores = qnt_conectores - '$qnt_conectores' ,
			qnt_conectores2 = qnt_conectores2 - '$qnt_conectores2', qnt_cabo_rede = qnt_cabo_rede - '$qnt_cabo_rede', qnt_conectores_rj45 = qnt_conectores_rj45 - '$qnt_conectores_rj45', qnt_bap = qnt_bap - '$qnt_bap', onu = onu - '$onu', radio = radio - '$radio', stb = stb - '$stb', telefones = telefones - '$telefones'
			WHERE id = '$estoque_escritorio'");
			$pdo_insere->execute();

			if ($_POST['onu'] > 0) {
				/* Salvando seriais do total de ONU selecionado */
				$sql = array();
				for ($i=0; $i < $_POST['onu']; $i++) {
					$vl ='onu_select' . $i;
				   	$sql[] = 'serial = \'' . $_POST[$vl].'\' ';
				}
				//echo "UPDATE t_estoque_serializados SET id_estoque_quantidade = '$result', localidade = 'tecnico' WHERE ".implode('OR ', $sql).";";
				$pdo_insere = $conexao_pdo->prepare("UPDATE t_estoque_serializados SET id_estoque_quantidade = '$result' WHERE ".implode(' OR ', $sql).";");
				$pdo_insere->execute();
			}
			if ($_POST['stb'] > 0) {
				/* Salvando seriais do total de stb selecionado */
				$sql = array();
				for ($i=0; $i < $_POST['stb']; $i++) {
					$vl ='stb_select' . $i;
				   	$sql[] = 'serial = \'' . $_POST[$vl].'\' ';
				}
				$pdo_insere = $conexao_pdo->prepare("UPDATE t_estoque_serializados SET id_estoque_quantidade = '$result' WHERE ".implode(' OR ', $sql).";");
				$pdo_insere->execute();
			}
			if ($_POST['telefones'] > 0) {
				/* Salvando seriais do total de telefones selecionado */
				$sql = array();
				for ($i=0; $i < $_POST['telefones']; $i++) {
					$vl ='telefones_select' . $i;
				   	$sql[] = 'serial = \'' . $_POST[$vl].'\' ';
				}
				$pdo_insere = $conexao_pdo->prepare("UPDATE t_estoque_serializados SET id_estoque_quantidade = '$result' WHERE ".implode(' OR ', $sql).";");
				$pdo_insere->execute();
			}
			if ($_POST['radio'] > 0) {
				/* Salvando seriais do total de radio selecionado */
				$sql = array();
				for ($i=0; $i < $_POST['radio']; $i++) {
					$vl ='radio_select' . $i;
				   	$sql[] = 'serial = \'' . $_POST[$vl].'\' ';
				}
				$pdo_insere = $conexao_pdo->prepare("UPDATE t_estoque_serializados SET id_estoque_quantidade = '$result' WHERE ".implode(' OR ', $sql).";");
				$pdo_insere->execute();
			}
		} else {
			if ($_POST['onu'] > 0) {
				/* Salvando seriais do total de ONU selecionado */
				$sql = array();
				for ($i=0; $i < $_POST['onu']; $i++) {
					$vl ='onu' . $i;
				   	$sql[] = '('.$result.', \'' . $_POST[$vl] . '\', true, ' . '0' . ', \'ONU\'' . ', 0, \'' . $var3 . '\', \'' . $gera . '\')';
				}
				$pdo_insere = $conexao_pdo->prepare('INSERT INTO t_estoque_serializados (id_estoque_quantidade, serial, status, nome_cliente, nome, id_instalacao, localidade,codigo_serial) VALUES '.implode(', ', $sql));
				$pdo_insere->execute();
			}
			if ($_POST['stb'] > 0) {
				/* Salvando seriais do total de stb selecionado */
				$sql = array();
				for ($i=0; $i < $_POST['stb']; $i++) {
					$vl ='stb' . $i;
				   	$sql[] = '('.$result.', \'' . $_POST[$vl] . '\', true, ' . '0' . ', \'setupBox\'' . ', 0,\'' . $var3 . '\', \'' . $gera . '\')';
				}
				$pdo_insere = $conexao_pdo->prepare('INSERT INTO t_estoque_serializados (id_estoque_quantidade, serial, status, nome_cliente, nome, id_instalacao, localidade,codigo_serial) VALUES '.implode(', ', $sql));
				$pdo_insere->execute();
			}
			if ($_POST['telefones'] > 0) {
				/* Salvando seriais do total de telefones selecionado */
				$sql = array();
				for ($i=0; $i < $_POST['telefones']; $i++) {
					$vl ='telefones' . $i;
				   	$sql[] = '('.$result.', \'' . $_POST[$vl] . '\', true, ' . '0' . ', \'Telefone\'' . ', 0,\'' . $var3 . '\', \'' . $gera . '\')';
				}
				$pdo_insere = $conexao_pdo->prepare('INSERT INTO t_estoque_serializados (id_estoque_quantidade, serial, status, nome_cliente, nome, id_instalacao, localidade,codigo_serial) VALUES '.implode(', ', $sql));
				$pdo_insere->execute();
			}
			if ($_POST['radio'] > 0) {
				/* Salvando seriais do total de radio selecionado */
				$sql = array();
				for ($i=0; $i < $_POST['radio']; $i++) {
					$vl ='radio' . $i;
				   	$sql[] = '('.$result.', \'' . $_POST[$vl] . '\', true, ' . '0' . ', \'Rádio\'' . ', 0,\'' . $var3 . '\', \'' . $gera . '\')';
				}
				$pdo_insere = $conexao_pdo->prepare('INSERT INTO t_estoque_serializados (id_estoque_quantidade, serial, status, nome_cliente, nome, id_instalacao, localidade,codigo_serial) VALUES '.implode(', ', $sql));
				$pdo_insere->execute();
			}
		}
			//PEGANDO E GERANDO A OS
			
			$pdo_insere = $conexao_pdo->prepare("INSERT INTO t_saidas_os (id_tecnico,id_estoque_quantidade,qnt_cabo_optico,qnt_conectores,qnt_conectores2,qnt_cabo_rede,qnt_conectores_rj45,qnt_bap, onu, radio, stb, telefones,data,codigo) VALUES ( ? , ?,  ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
			$pdo_insere->execute( array($id_tecnico,$var2,$qnt_cabo_optico, $qnt_conectores,$qnt_conectores2, $qnt_cabo_rede, $qnt_conectores_rj45,$qnt_bap, $onu, $radio, $stb, $telefones,$data,$gera));

			$stmt = $conexao_pdo->prepare("SELECT id_numero_os FROM t_saidas_os order by id_numero_os desc LIMIT 1");
			$stmt->execute();
			$result = array();
			while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$result = $r['id_numero_os'];
			}
	     		
			//PEGANDO QUALQUER SAIDA DE MATERIAL E ARMAZENANDO NO BANCO COMO LOGS
		    $pdo_inseres = $conexao_pdo->prepare("INSERT INTO t_saida_material_logs (id_tecnico, acao, usuario,id_os_gerada, base, os) VALUES (?, ?, ?, ?, ?, ?);");
			$pdo_inseres->execute( array($id_tecnico,'Saída de Material',$usuarioLog, $result, 'Técnicos', $os));




	}
?>

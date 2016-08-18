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
		// apenas teste 3x depois mudar isso //
		$os = $_POST['os'];
		$generica = $_POST['onu_e0'];
		$generica2 = $_POST['stb_e0'];
		$generica3 = $_POST['radio_0e'];
		//var_dump($generica);
         /* LOOP para não cadastrar itens duplicados */
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
		$id_usado = $_POST['id'];
		$pdo_insere = $conexao_pdo->prepare("UPDATE t_escritorios SET qnt_cabo_optico = qnt_cabo_optico + :up1,
			qnt_conectores = qnt_conectores + :up2 ,
			qnt_conectores2 = qnt_conectores2 + :up3,
			qnt_cabo_rede = qnt_cabo_rede + :up4,
			qnt_conectores_rj45 = qnt_conectores_rj45 + :up5,
			qnt_bap = qnt_bap + :up6,
			onu = onu + :up7,
			radio = radio + :up8,
			stb = stb + :up9,
			telefones = telefones + :up10
		WHERE id = :id_e");
		$pdo_insere->bindParam(':id_e', $id_escritorio);
		$pdo_insere->bindParam(':up1', $qnt_cabo_optico_e);
		$pdo_insere->bindParam(':up2', $qnt_conectores_e);
		$pdo_insere->bindParam(':up3', $qnt_conectores2_e);
		$pdo_insere->bindParam(':up4', $qnt_cabo_rede_e);
		$pdo_insere->bindParam(':up5', $qnt_conectores_rj45_e);
		$pdo_insere->bindParam(':up6', $qnt_bap_e);
		$pdo_insere->bindParam(':up7', $onu_e);
		$pdo_insere->bindParam(':up8', $radio_e);
		$pdo_insere->bindParam(':up9', $stb_e);
		$pdo_insere->bindParam(':up10', $telefones_e);
		$pdo_insere->execute();
		echo true;
		


		$stmt = $conexao_pdo->prepare("SELECT id, nome_escritorio FROM t_escritorios WHERE id = '$id_escritorio' LIMIT 1");
		$stmt->execute();
		$result = array();
		while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result2 = $r['nome_escritorio'];
			$var2 = $result2;
		}

			$var3 = $var2;

		if ($_POST['onu_e'] > 0) {
			/* Salvando seriais do total de ONU selecionado */
			$sql = array();
			for ($i=0; $i < $_POST['onu_e']; $i++) {
				$vl ='onu_e' . $i;
			   	$sql[] = '('.$id_escritorio.', \'' . $_POST[$vl] . '\', true, ' . '0' . ', \'onu\',' . ' 0' . ', \''. $var3 .' \'' . ', \'' . $gera . '\')';
			}
			//echo 'INSERT INTO t_estoque_serializados (id_estoque_quantidade, serial, status, nome_cliente, nome, id_instalacao, localidade) VALUES '.implode(', ', $sql);
			$pdo_insere = $conexao_pdo->prepare('INSERT INTO t_estoque_serializados (id_estoque_quantidade, serial, status, nome_cliente, nome, id_instalacao, localidade, codigo_serial) VALUES '.implode(', ', $sql));
			$pdo_insere->execute();
		}
		if ($_POST['stb_e'] > 0) {
			/* Salvando seriais do total de stb selecionado */
			$sql = array();
			for ($i=0; $i < $_POST['stb_e']; $i++) {
				$vl ='stb_e' . $i;
			   	$sql[] = '('.$id_escritorio.', \'' . $_POST[$vl] . '\', true, ' . '0' . ', \'stb\',' . ' 0' . ', \''. $var3 .' \'' . ', \'' . $gera . '\')';
			}
			$pdo_insere = $conexao_pdo->prepare('INSERT INTO t_estoque_serializados (id_estoque_quantidade, serial, status, nome_cliente, nome, id_instalacao, localidade, codigo_serial) VALUES '.implode(', ', $sql));
			$pdo_insere->execute();
		}
		if ($_POST['telefones_e'] > 0) {
			/* Salvando seriais do total de telefones selecionado */
			$sql = array();
			for ($i=0; $i < $_POST['telefones_e']; $i++) {
				$vl ='telefones_e' . $i;
			   	$sql[] = '('.$id_escritorio.', \'' . $_POST[$vl] . '\', true, ' . '0' . ', \'telefones\',' . ' 0' . ', \''. $var3 .' \'' . ', \'' . $gera . '\')';
			}
			$pdo_insere = $conexao_pdo->prepare('INSERT INTO t_estoque_serializados (id_estoque_quantidade, serial, status, nome_cliente, nome, id_instalacao, localidade, codigo_serial) VALUES '.implode(', ', $sql));
			$pdo_insere->execute();
		}
		if ($_POST['radio_e'] > 0) {
			/* Salvando seriais do total de radio selecionado */
			$sql = array();
			for ($i=0; $i < $_POST['radio_e']; $i++) {
				$vl ='radio_e' . $i;
			   	$sql[] = '('.$id_escritorio.', \'' . $_POST[$vl] . '\', true, ' . '0' . ', \'radio\',' . ' 0' . ', \''. $var3 .' \'' . ', \'' . $gera . '\')';
			}
			$pdo_insere = $conexao_pdo->prepare('INSERT INTO t_estoque_serializados (id_estoque_quantidade, serial, status, nome_cliente, nome, id_instalacao, localidade, codigo_serial) VALUES '.implode(', ', $sql));
			$pdo_insere->execute();
		}

			$pdo_insere = $conexao_pdo->prepare("INSERT INTO t_saidas_os (id_tecnico,id_estoque_quantidade,qnt_cabo_optico,qnt_conectores,qnt_conectores2,qnt_cabo_rede,qnt_conectores_rj45,qnt_bap, onu, radio, stb, telefones,data,codigo) VALUES ( ? , ?,  ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
			$pdo_insere->execute( array($id_escritorio,$id_escritorio,$qnt_cabo_optico_e, $qnt_conectores_e,$qnt_conectores2_e, $qnt_cabo_rede_e, $qnt_conectores_rj45_e,$qnt_bap_e, $onu_e, $radio_e, $stb_e, $telefones_e,$data,$gera));

			$stmt = $conexao_pdo->prepare("SELECT id_numero_os FROM t_saidas_os order by id_numero_os desc LIMIT 1");
			$stmt->execute();
			$result = array();
			while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$result = $r['id_numero_os'];
			}

			//PEGANDO QUALQUER SAIDA DE MATERIAL É ARMAZENANDO  NO BANCO COMO LOGS
			
		    $pdo_inseres = $conexao_pdo->prepare("INSERT INTO t_saida_material_logs (id_tecnico, acao, usuario, id_os_gerada, base, os) VALUES (?, ?, ?, ?, ?, ?);");
			$pdo_inseres->execute( array($id_escritorio,'Saída de Material',$usuarioLog, $result, 'Escritórios',$os));
		 	}
		
	
?>

<?php
	require('conectarBD.php');
	$erro = false;
	$tecnico = $_SESSION['nome_usuario'];

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
   $extraviado = "";

	// Verifica se algo foi postado para publicar ou editar
	if ( isset( $_POST ) && ! empty( $_POST ) ) {
		// Cria as variáveis
		foreach ( $_POST as $chave => $valor ) {
			$$chave = $valor;
			// Verifica se existe algum campo em branco
			if ( empty ( $valor ) ) {
				// Preenche o erro
				$erro = false;
			}
		}
		// Verifica se as variáveis foram configuradas
		if ( empty( $cidade ) || empty( $motivo ) ) {
			$erro = 'Existem campos em branco.';
		} else {
			$pdo_insere = $conexao_pdo->prepare('INSERT INTO t_recolhimento (tecnico, cidade, motivo, cliente,equipamento, observacao, contrato, status,tipo,status_equipamento, tecnico_selecionado, tecnico_id_select, mes, encaminhado_financeiro,extraviado,data_recolhimento) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) RETURNING id_recolhimento');
			$pdo_insere->execute( array($tecnico, $cidade, $motivo, $cliente, $equipamento, $observacao, $contrato, "Aguardando" ,$tipo, $status_equipamento, $tecnico_selecionado,$tecnico_id_select, $mes, $encaminhado_financeiro, $extraviado,$data_recolhimento) );
			while($r = $pdo_insere->fetch(PDO::FETCH_ASSOC)) {
				$result[] = $r;
				$id = $r['id_recolhimento'];
			}
				if ($equipamento == 1) {
					$pdo_insere_radio = $conexao_pdo->prepare('INSERT INTO t_radio_recolhimento (id_recolhimento_fk, serial_radio, radio, fonte,cabo_rj45, antena, cano) VALUES (?, ?, ?, ?, ?, ?, ?)');
					$pdo_insere_radio->execute( array($id, $serial_radio, $radio, $poe, $radio_rj45, $antena, $cano) );

				}elseif($equipamento == 2){

					$pdo_insere_onu = $conexao_pdo->prepare('INSERT INTO t_onu_recolhimento (id_recolhimento_fk, serial_onu, fonte, onu_rj45, conector_spc, conector_pc) VALUES (?, ?, ?, ?, ?, ?)');
					$pdo_insere_onu->execute( array($id, $serial_onu, $onu_fonte, $onu_rj45, $conector_spc, $conector_pc) );
					
				}elseif($equipamento == 3){

					$pdo_insere_con = $conexao_pdo->prepare('INSERT INTO t_setupbox_recolhimento (id_recolhimento_fk, serial_stb, fonte,cabo_av,cabo_hdmi, controle, stb_rj45) VALUES (?, ?, ?, ?, ?, ?, ?)');
					$pdo_insere_con->execute( array($id, $serial_stb, $stb_fonte,$cabo_av,$cabo_hdmi, $controle, $stb_rj45s) );
					
				}
				elseif($equipamento == 4){
					$pdo_insere_stb = $conexao_pdo->prepare('INSERT INTO t_combo_recolhimento (id_recolhimento_fk,serial_onu,conector_spc, serial_stb,stb_fonte, stb_rj45, controle, cabo_av, cabo_hdmi) VALUES (?, ?, ?, ?, ?, ?, ?, ? ,?)');
					$pdo_insere_stb->execute( array($id, $serial_onu2, $conector_spc, $serial_stb2, $stb_fonte, $stb_rj45, $controle, $cabo_av, $cabo_hdmi) );
					
				}
				elseif($equipamento == 5){
					$pdo_insere_stb = $conexao_pdo->prepare('INSERT INTO t_celular_recolhimento (id_recolhimento_fk,serial) VALUES (?, ?)');
					$pdo_insere_stb->execute( array($id, $serial) );
					
				}

				$erro = true;
				
			//echo $id;
			
		}
		echo $erro;
	}
?>
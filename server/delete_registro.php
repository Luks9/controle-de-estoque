<?php
	require('conectarBD.php');
	$erro = false;
	//$supervisor = $_SESSION['nome_usuario'];
	if ( isset( $_POST ) && ! empty( $_POST ) ) {
		// Cria as variáveis
		foreach ( $_POST as $chave => $valor ) {
			$$chave = $valor;
		}
		$id_instalacao = $_POST['id_instalacao_aux'];
		$tipo = $_POST['tipo_aux'];
		$id_tecnico = $_POST['id_tecnico_aux'];
		$nome = $_POST['nome_aux'];
		$up1 = $_POST['qnt_cabo_optico_aux'];
		$up2 = $_POST['qnt_conectores_aux'];
		$up22 = $_POST['qnt_conectores2_aux'];
		$up3 = $_POST['qnt_cabo_rede_aux'];
		$up4 = $_POST['qnt_conectores_rj45_aux'];
		$up5 = $_POST['qnt_bap_aux'];
		$up6 = $_POST['onu_aux'];
		$up7 = $_POST['radio_aux'];
		$up8 = $_POST['stb_aux'];
		$up9 = $_POST['telefones_aux'];
		// Volta o equipamento da instalacao para o estoque do tecnico
		$pdo_insere = $conexao_pdo->prepare("UPDATE t_estoque_tecnico SET qnt_cabo_optico = qnt_cabo_optico + :up1, qnt_conectores = qnt_conectores + :up2,	qnt_conectores2 = qnt_conectores2 + :up22, qnt_cabo_rede = qnt_cabo_rede + :up3, qnt_conectores_rj45 = qnt_conectores_rj45 + :up4, qnt_bap = qnt_bap + :up5, onu = onu + :up6, radio = radio + :up7, stb = stb + :up8, telefones = telefones + :up9 WHERE id_tecnico = :idPOST");
		$pdo_insere->bindParam(':idPOST', $id_tecnico);
		$pdo_insere->bindParam(':up1', $up1);
		$pdo_insere->bindParam(':up2', $up2);
		$pdo_insere->bindParam(':up22', $up22);
		$pdo_insere->bindParam(':up3', $up3);
		$pdo_insere->bindParam(':up4', $up4);
		$pdo_insere->bindParam(':up5', $up5);
		$pdo_insere->bindParam(':up6', $up6);
		$pdo_insere->bindParam(':up7', $up7);
		$pdo_insere->bindParam(':up8', $up8);
		$pdo_insere->bindParam(':up9', $up9);
		$pdo_insere->execute();
		// Atualiza o estoque serializado
		$pdo_update = $conexao_pdo->prepare("UPDATE t_estoque_serializados SET status = true, id_instalacao = 0 WHERE id_instalacao = '$id_instalacao';");
		$pdo_update->execute();
		// Apaga a instalação
		$pdo_delete = $conexao_pdo->prepare("DELETE FROM t_instalacoes WHERE id_instalacao = '$id_instalacao';");
		$pdo_delete->execute();
		$erro = false;
	}
	echo $erro;
?>
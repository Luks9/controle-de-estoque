<?php
require ('conectarBD.php');

if ($_GET['valor'] == 'ok') {
	$id = $_GET['id'];
}

$gerandoPDF = $conexao_pdo->prepare("SELECT * FROM t_saidas_os,t_escritorios WHERE t_saidas_os.id_tecnico = t_escritorios.id AND id_numero_os = $id");
$gerandoPDF->execute();
$valor = array();
  while($v = $gerandoPDF->fetch(PDO::FETCH_ASSOC))  {
      $valor[] = $v;
      $numero_OS = $v['id_numero_os'];
      $estoquista = 'Paulo Cesar';
      $funcionario = $v['nome_escritorio'];
 	  $qnt_cabo_optico = $v['qnt_cabo_optico'];
 	  $qnt_conectores = $v['qnt_conectores'];
 	  $qnt_conectores2 = $v['qnt_conectores2'];
 	  $qnt_cabo_rede = $v['qnt_cabo_rede'];
 	  $qnt_bap = $v['qnt_bap'];
 	  $qnt_conectores_rj45 = $v['qnt_conectores_rj45'];
 	  $v['stb'];
 	  $v['telefones'];
 	  $v['radio'];
 	  $v['onu'];
 	  //Gato suave
 	  $data_saida = $v['data'];
 	  $data_saida2 = $data_saida[0].
 	  $data_saida[1].$data_saida[2].
 	  $data_saida[3].$data_saida[4].
 	  $data_saida[5].$data_saida[6].
 	  $data_saida[7].$data_saida[8].
 	  $data_saida[9].$data_saida[10].
 	  $data_saida[11].$data_saida[12].
 	  $data_saida[13].$data_saida[14].
 	  $data_saida[15].$data_saida[16].
 	  $data_saida[17].$data_saida[18];
 	  //depois arrumar
}



$consultarSeriais = $conexao_pdo->prepare("SELECT * FROM t_saidas_os,t_estoque_serializados WHERE t_saidas_os.codigo = t_estoque_serializados.codigo_serial AND id_numero_os = $id");
$consultarSeriais->execute();
$TotalRegistros = $consultarSeriais->rowCount();
$result = array();
$variavel = array();
  while($r = $consultarSeriais->fetch(PDO::FETCH_ASSOC))  {
      $result[] = $r;
      $nome = $r['nome'];
 	  $serialONU = $r['serial'];
      
 	   $variavel[] = '<tr>
 	   <td class="tg-b7b8">'.$nome.'</td>
		    <td class="tg-b7b8">'.$serialONU.'</td>
		    <td class="tg-b7b8">1 (    )  2 (    )  3 (    ) 4 (    ) 5 (    )</td></tr>';
		}


ob_start();

$html = ob_get_clean();
$html = utf8_encode($html);
$html .= 

'<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
.tg .tg-aito{font-size:13px;background-color:#c0c0c0;vertical-align:top}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 1028px">
<colgroup>
<col style="width: 253px">
<col style="width: 64px">
<col style="width: 292px">
<col style="width: 258px">
<col style="width: 161px">
</colgroup>
  <tr>
    <th class="tg-aito">Ordem de Serviço - Saida de Matérial<br></th>
    <th class="tg-aito">Estoque</th>
    <th class="tg-aito">Funcionário:<b> '.$funcionario.'</b><br></th>
    <th class="tg-aito">Data de Sáida: <b> '.$data_saida2.'</b><br></th>
    <th class="tg-aito">Número OS: <b>'.$numero_OS.'</b><br></th>
  </tr>

</table>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;}
.tg td{font-family:Arial, sans-serif;font-size:13px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
.tg th{font-family:Arial, sans-serif;font-size:13px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
.tg .tg-aito{font-size:13px;background-color:#c0c0c0;vertical-align:top}
.tg .tg-y0pk{font-size:13px;background-color:#c0c0c0;color:#000000;vertical-align:top}
.tg .tg-b7b8{background-color:#f9f9f9;vertical-align:top}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 1201px">
<colgroup>
<col style="width: 147px">
<col style="width: 289px">
<col style="width: 229px">
<col style="width: 208px">
<col style="width: 92px">
<col style="width: 236px">
</colgroup>
  <tr>
    <th class="tg-y0pk">Nome Material Quantitativo<br></th>
    <th class="tg-y0pk">Quantidade</th>
    <th class="tg-y0pk">Conferência por Processo<br></th>
  </tr>

  <tr>
    <td class="tg-b7b8"><b>Quantidade Cabo Óptico (Metros)</td>
    <td class="tg-b7b8"><b>'.$qnt_cabo_optico.'</b></td>
    <td class="tg-b7b8">1 (   ) 2 (    ) 3 (    ) 4 (   ) 5 (   )</td>
  </tr>
  <tr>

   <tr>
    <td class="tg-b7b8"><b>Quantidade Cabo de Rede (Metros)</td>
    <td class="tg-b7b8"><b>'.$qnt_cabo_rede.'</b></b></td>
    <td class="tg-b7b8">1 (   ) 2 (    ) 3 (    ) 4 (   ) 5 (   )</td>
   </tr>

   <!--testetete-->

    <tr>
    <td class="tg-b7b8"><b>Quantidade Conectores SC APC</td>
    <td class="tg-b7b8"><b>'.$qnt_conectores.'</b></td>
    <td class="tg-b7b8">1 (   ) 2 (    ) 3 (    ) 4 (   ) 5 (   )</td>
   </tr>
    <tr>
    <td class="tg-b7b8"><b>Quantidade Conectores SC PC</td>
    <td class="tg-b7b8"><b>'.$qnt_conectores2.'</b></td>
    <td class="tg-b7b8">1 (   ) 2 (    ) 3 (    ) 4 (   ) 5 (   )</td>
   </tr>
    <tr>
    <td class="tg-b7b8"><b>Quantidade Conector RJ45</td>
    <td class="tg-b7b8"><b>'.$qnt_conectores_rj45.'</b></td>
    <td class="tg-b7b8">1 (   ) 2 (    ) 3 (    ) 4 (   ) 5 (   )</td>
   </tr>
      <tr>
    <td class="tg-b7b8"><b>Quantidade Bap</td>
    <td class="tg-b7b8"><b>'.$qnt_bap.'</b></td>
    <td class="tg-b7b8">1 (   ) 2 (    ) 3 (    ) 4 (   ) 5 (   )</td>
   </tr> 
   <tr>
</table>

<table class="tg" style="undefined;table-layout: fixed; width: 1201px">
<colgroup>
<col style="width: 147px">
<col style="width: 289px">
<col style="width: 229px">
<col style="width: 208px">
<col style="width: 92px">
<col style="width: 236px">
</colgroup>
  <tr>
    <th class="tg-y0pk">Nome Material Serializado<br></th>
    <th class="tg-y0pk">Serializado</th>
    <th class="tg-y0pk">Conferência por Processo<br></th>
  </tr>
	'.implode('',$variavel).'
   <tr>
</table>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
.tg .tg-xlu3{font-size:12px;background-color:#c0c0c0;vertical-align:top}
.tg .tg-5yhl{font-size:12px;background-color:#c0c0c0;color:#000000;vertical-align:top}
.tg .tg-clu8{background-color:#f9f9f9;font-size:12px;vertical-align:top}
.tg .tg-dx8v{font-size:12px;vertical-align:top}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 1043px">
<colgroup>
<col style="width: 68px">
<col style="width: 133px">
<col style="width: 110px">
<col style="width: 208px">
<col style="width: 524px">
</colgroup>
  <tr>
    <th class="tg-xlu3">Processo<br></th>
    <th class="tg-xlu3">Nome do Processo<br></th>
    <th class="tg-xlu3">Data<br></th>
    <th class="tg-5yhl">Nome do Responsável</th>
    <th class="tg-5yhl">Assinatura do Responsável</th>
  </tr>
  <tr>
    <td class="tg-clu8">01<br></td>
    <td class="tg-clu8">Saída do Estoque<br></td>
    <td class="tg-clu8"><br></td>
    <td class="tg-clu8"></td>
    <td class="tg-clu8"><br></td>
  </tr>
  <tr>
    <td class="tg-dx8v">02</td>
    <td class="tg-dx8v">Empacotamento<br></td>
    <td class="tg-dx8v"></td>
    <td class="tg-dx8v"></td>
    <td class="tg-dx8v"></td>
  </tr>
  <tr>
    <td class="tg-clu8">03</td>
    <td class="tg-clu8">Escritório</td>
    <td class="tg-clu8"></td>
    <td class="tg-clu8"></td>
    <td class="tg-clu8"></td>
  </tr>
  <tr>
    <td class="tg-dx8v">04</td>
    <td class="tg-dx8v">Transportador<br></td>
    <td class="tg-dx8v"></td>
    <td class="tg-dx8v"></td>
    <td class="tg-dx8v"></td>
  </tr>
  <tr>
    <td class="tg-clu8">05</td>
    <td class="tg-clu8">Funcionário</td>
    <td class="tg-clu8"></td>
    <td class="tg-clu8"><b>'.$funcionario.'</b></td>
    <td class="tg-clu8"></td>
  </tr>
</table>

'
;


//classe

include("mpdf60/mpdf.php");

$mpdf= new mPDF('utf-8', 'A4-L'); 
$mpdf->allow_charset_conversion = true;
$mpdf->charset_in = 'UTF-8';
$mpdf->WriteHTML($html);

$mpdf->Output($funcionario.'OS.pdf','D');


exit();


?>
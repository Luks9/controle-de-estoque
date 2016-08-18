<?php

  function listarNomes() {
	require ('conectarBD.php');
	$usuarioLogado = $_SESSION['nome_usuario'];
	$stmt = $conexao_pdo->prepare("SELECT * FROM t_tecnicos WHERE supervisor = '$usuarioLogado'");
    $stmt->execute();
    $result = array();
     while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
           $result[] = $r;
           echo "<option value=".$r['id'].">".$r['nome']."</option>";
           //echo "<input type='text' name='nome_tecnico' id='nome_tecnico' value=".$r['nome']." class='form-control'>";

           
           }
	} 

// PASSO O METODO VIA POST E USO O GET
  function listarRecolhidosporCidade() {
  if($_GET['go'] == 'listarRecolhidosporCidade')    {
  require ('conectarBD.php');
  $mes = $_POST['mes'];
  $stmt = $conexao_pdo->prepare("SELECT cidade, COUNT(cidade) totalCount FROM t_recolhimento WHERE tipo = 'interno' AND mes = '$mes' GROUP BY cidade");
    $stmt->execute();
    $result = array();
     while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
           $result[] = $r;
          echo "<td>" .$r['cidade'] . "</td>";
          echo "<td>" .$r['totalcount'] . "</td>";
          echo "</tr>";         
           
               }
       
       } 

}


	function listarNomesSupervisor() {
	require ('conectarBD.php');
	$stmt = $conexao_pdo->prepare("SELECT * FROM t_usuarios");
    $stmt->execute();
    $result = array();
     while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
           $result[] = $r;
           //echo '<option value='.$r["nome"].'>'.$r["nome"].'</option>';
           echo '<option>'.$r["nome"].'</option>';


           //echo '<option value='.$['nome'].'>'.$r['nome'].'</option>';
           //echo "<input type='text' name='nome_tecnico' id='nome_tecnico' value=".$r['nome']." class='form-control'>";

           
           }
	} 




/* MEDIA DE INSTALAÇÃO POR DATA E TÉCNICO */


function relatorioInstalacaoData () {
    if($_GET['go'] == 'Buscar')    {
    require ('conectarBD.php');
    $id = $_POST['id_tecnico'];
    $data1 = $_POST['data_inicial'];
    $data2 = $_POST['data_final'];
	$stmt = $conexao_pdo->prepare("SELECT * FROM t_instalacoes WHERE data_instalacao BETWEEN '$data1' AND '$data2' AND id_tecnico = '$id' ORDER BY data_instalacao");
    $stmt->execute();
    $total = $stmt->rowCount();
    $result = array();
     while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
           $result[] = $r;
              echo "<td>" .$r['id_tecnico'] . "</td>";
              echo "<td>" .$r['cod_instalacao_sigem'] . "</td>";
              echo "<td>" . $r['nome_cliente'] . "</td>";
              echo "<td>" . $r['tecnologia'] . "</td>";
              echo "<td>" . $r['data_instalacao'] . "</td>";
              echo "</tr>";         
           }
              echo '<p style="font-size:17px; font-family:">'. 'Total de Instalações Realizadas: ' . '<b>' . $total . '</p>';  

    }
 

}
 


/*MEDIA DE INSTALAÇÃO POR SUPERVISOR / DATA */

function relatorioInstalcaoSupervisor () {
    if($_GET['go'] == 'BuscarRelatorioSupervisor')    {
    require ('conectarBD.php');
    $nome = $_POST['supervisor'];
    echo $nome;
    $data1 = $_POST['data_inicial'];
    $data2 = $_POST['data_final'];
	  $stmt = $conexao_pdo->prepare("SELECT * FROM t_instalacoes WHERE data_instalacao BETWEEN '$data1' AND '$data2' AND nome_supervisor = '$nome'");
    $stmt->execute();
    $total = $stmt->rowCount();
    $result = array();
     while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
           $result[] = $r;
              echo "<td>" .$r['id_tecnico'] . "</td>";
              echo "<td>" .$r['cod_instalacao_sigem'] . "</td>";
              echo "<td>" . $r['nome_cliente'] . "</td>";
              echo "<td>" . $r['tecnologia'] . "</td>";
              echo "<td>" . $r['data_instalacao'] . "</td>";
              echo "</tr>";         
           }
              echo '<p style="font-size:17px; font-family:">'. 'Total de Instalações Realizadas: ' . '<b>' . $total . '</p>';  

    }
 

}

/*MEDIA DE INSTALAÇÃO INDIVIDUAL */

function mediaItens () {
    if($_GET['go'] == 'BuscarMedia')    {
    require ('conectarBD.php');
    $id = $_POST['id_tecnico'];
    $tipo = $_POST['tipo'];
    $data1 = $_POST['data_inicial'];
    $data2 = $_POST['data_final'];
    $stmt2 = $conexao_pdo->prepare("SELECT SUM(qnt_conectores) as sc_apc , SUM(qnt_conectores2) as sc_pc,
    SUM(qnt_conectores_rj45) as rj45, SUM(qnt_cabo_optico) as cabo_optico, SUM(qnt_bap) as bap, SUM(qnt_cabo_rede) as cabo_rede
    FROM t_instalacoes WHERE data_instalacao BETWEEN '$data1' AND '$data2' AND id_tecnico = '$id'");
	$stmt2->execute();
	$result2 = array();
	while($r2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
    $result2[] = $r2;
    
    $totalConector1 = $r2['sc_apc'];
    $totalConector2 = $r2['sc_pc'];
    $totalConectorRJ45 = $r2['rj45'];
    $totalCaboOptico = $r2['cabo_optico'];
    $totalBap = $r2['bap'];
    $totalCaboRede = $r2['cabo_rede'];
}

	$stmt = $conexao_pdo->prepare("SELECT nome_tecnico FROM t_instalacoes WHERE data_instalacao BETWEEN '$data1' AND '$data2' AND id_tecnico = '$id' AND tecnologia = '$tipo' ORDER BY data_instalacao");
    $stmt->execute();
    $totalInstalacao = $stmt->rowCount();
    $result = array();
          while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $nome_tecnico = $r['nome_tecnico'];
          	  $media_SC_APC = ($totalConector1 / $totalInstalacao);
          	  $media_SC_PC =  ($totalConector2 / $totalInstalacao);
          	  $media_rj45 =   ($totalConectorRJ45 / $totalInstalacao);
          	  $media_cabo_optico =   ($totalCaboOptico / $totalInstalacao);
          	  $media_bap =   ($totalBap / $totalInstalacao);
          	  $media_cabo_rede =   ($totalCaboRede / $totalInstalacao);
          	  
          	  $result[] = $r;    
           }
           	if ($tipo == 'FTTH') {
           	
           	 echo '<div class="col-md-13">
              <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-green">
                  <div class="widget-user-image">
                    <img class="img-circle" src="../resources/images/ico-sasestoque.png" alt="User Avatar">
                  </div><!-- /.widget-user-image -->
                  <h3 class="widget-user-username">Média de Uso de Equipamentos</h3>
                  <h4 class="widget-user-desc" >Média realizada com '.$totalInstalacao.' Instalações do técnico '.$nome_tecnico.'</h5>
                  <h4 class="widget-user-desc">'.$tipo.'</h4>
                </div>
                <div class="box-footer no-padding">
                  <ul class="nav nav-stacked">
                    <li><a >Média Conectores SC APC <span class="pull-right badge bg-blue">'.  $media_SC_APC .'</span></a></li>
                    <li><a >Média Conectores SC PC<span class="pull-right badge bg-aqua">'.  $media_SC_PC .'</span></a></li>
                    <li><a >Média Cabo Óptico / Instalação <span class="pull-right badge bg-red">'.  $media_cabo_optico .'</span></a></li>
                    <li><a >Média Bap / Instalação <span class="pull-right badge bg-black">'.  $media_bap .'</span></a></li>
                  </ul>
                </div>
              </div>
            </div>';	
		   }
		   elseif ($tipo == 'TV') {
		   	
		   	 echo '<div class="col-md-13">
              <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-green">
                  <div class="widget-user-image">
                    <img class="img-circle" src="../resources/images/ico-sasestoque.png" alt="User Avatar">
                  </div><!-- /.widget-user-image -->
                  <h3 class="widget-user-username">Média de Uso de Equipamentos</h3>
                  <h4 class="widget-user-desc" >Média realizada com '.$totalInstalacao.' Instalações </h5>
                  <h4 class="widget-user-desc">'.$tipo.'</h4>
                </div>
                <div class="box-footer no-padding">
                  <ul class="nav nav-stacked">
                    <li><a href="#">Média Cabo de Rede <span class="pull-right badge bg-blue">'.  $media_cabo_rede .'</span></a></li>
                    <li><a href="#">Média Conectores RJ45 / Instalação<span class="pull-right badge bg-aqua">'.  $media_rj45 .'</span></a></li>
                    <li><a href="#">Média Bap / Instalação <span class="pull-right badge bg-black">'.  $media_bap .'</span></a></li>
                  </ul>
                </div>
              </div>
            </div>';	

		   }
   	}

}





/* MEDIA DE INSTALAÇÃO GERAL */

function mediaItensGerais () {
    if($_GET['go'] == 'BuscarMediaGeral')    {
    require ('conectarBD.php');
    $nome = $_POST['nome_supervisor'];
    $tipo = $_POST['tipo'];
    $data1 = $_POST['data_inicial'];
    $data2 = $_POST['data_final'];

    $stmt3 = $conexao_pdo->prepare("SELECT distinct id_tecnico FROM t_instalacoes WHERE nome_supervisor = '$nome' AND tecnologia = '$tipo';");
    $stmt3->execute();
    $result3 = array();
    $totalRow = $stmt3-> rowCount();
    while($r3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
         $result3[] = $r3['id_tecnico'];
    }

    for ($i=0; $i <$totalRow; $i++) { 
        $stmt2 = $conexao_pdo->prepare("SELECT SUM(qnt_conectores) as sc_apc , SUM(qnt_conectores2) as sc_pc,
        SUM(qnt_conectores_rj45) as rj45, SUM(qnt_cabo_optico) as cabo_optico, SUM(qnt_bap) as bap, SUM(qnt_cabo_rede) as cabo_rede
        FROM t_instalacoes WHERE (data_instalacao BETWEEN '$data1' AND '$data2') AND (id_tecnico = '$result3[$i]') AND tecnologia = '$tipo'");
      	$stmt2->execute();
      	$result2 = array();
      	while($r2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
          $result2[] = $r2;
        
          $totalConector1[$i]     = $r2['sc_apc'];
          $totalConector2[$i]     = $r2['sc_pc'];
          $totalConectorRJ45[$i]  = $r2['rj45'];
          $totalCaboOptico[$i]    = $r2['cabo_optico'];
          $totalBap[$i]           = $r2['bap'];
          $totalCaboRede[$i]      = $r2['cabo_rede'];
    }

    	$stmt = $conexao_pdo->prepare("SELECT * FROM t_instalacoes,t_tecnicos WHERE t_instalacoes.id_tecnico = t_tecnicos.id AND (data_instalacao BETWEEN '$data1' AND '$data2') AND nome_supervisor = '$nome' AND tecnologia = '$tipo' AND id_tecnico = '$result3[$i]' ORDER BY data_instalacao");
        $stmt->execute();
        $totalInstalacao = $stmt->rowCount();
        $result = array();
              while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {

              	  $media_SC_APC[$i] = ($totalConector1[$i] / $totalInstalacao);
              	  $media_SC_PC[$i] =  ($totalConector2[$i] / $totalInstalacao);
              	  $media_rj45[$i] =   ($totalConectorRJ45[$i] / $totalInstalacao);
              	  $media_cabo_optico[$i] =   ($totalCaboOptico[$i] / $totalInstalacao);
              	  $media_bap[$i] =   ($totalBap[$i] / $totalInstalacao);
              	  $media_cabo_rede[$i] =   ($totalCaboRede[$i]/ $totalInstalacao);    
              	  $nome_tecnico[$i] = $r['nome'];

     
               }
   			}
   			if ($tipo == 'FTTH') {
  			 
  			    echo '<table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Técnico</th>
                        <th>Média Conector SC APC</th>
                        <th>Média Conector SC PC</th>
                        <th>Média Uso de Cabo FTTH</th>
                        <th>Média Uso Baps</th>
                      </tr>
                    </thead>
                    <!-- Itens da tabela -->
                    <tbody>';
          for ($q=0;$q<$totalRow; $q++) {     
              echo '<tr>
              <td>'.$nome_tecnico[$q].'</td>
	     				<td>'.number_format($media_SC_APC[$q],2).'</td>
	     				<td>'.number_format($media_SC_PC[$q],2).'</td>
	     				<td>'.number_format($media_cabo_optico[$q],2).'</td>
	     				<td>'.number_format($media_bap[$q],2).'</td>
                </tr>';
          }

               echo' </tbody>
                  </table>';
				
          	}

			elseif ($tipo == 'TV') {

			      echo '<table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Técnico</th>
                        <th>Média Conector RJ45</th>
                        <th>Média Uso de Cabo Rede</th>
                        <th>Média Uso Baps</th>
                      </tr>
                    </thead>
                    <!-- Itens da tabela -->
                    <tbody>';
            for ($q=0;$q<$totalRow; $q++) {             
                    echo '<tr>
                    	<td>'.$nome_tecnico[$q].'</td>
        	     				<td>'.$media_rj45[$q].'</td>
        	     				<td>'.$media_cabo_rede[$q].'</td>
        	     				<td>'.$media_bap[$q].'</td>
                      </tr>';
            }
                      echo ' </tbody>
                           </table>';	

			}

            elseif ($tipo == 'Combo') {

            echo '<table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Técnico</th>
                        <th>Média Uso de Cabo Rede</th>
                        <th>Média Uso de Cabo FTTH</th>
                        <th>Média Conector RJ45</th>
                        <th>Média Conector SC APC</th>
                        <th>Média Conector SC PC</th>
                        <th>Média Uso Baps</th>
                      </tr>
                    </thead>
                    <!-- Itens da tabela -->
                    <tbody>';
            for ($q=0;$q<$totalRow; $q++) {             
                    echo '<tr>
                      <td>'.$nome_tecnico[$q].'</td>
                      <td>'.number_format($media_cabo_rede[$q],2).'</td>
                      <td>'.number_format($media_cabo_optico[$q],2).'</td>
                      <td>'.number_format($media_rj45[$q],2).'</td>
                      <td>'.number_format($media_SC_APC[$q],2).'</td>
                      <td>'.number_format($media_SC_PC[$q],2).'</td>
                      <td>'.number_format($media_bap[$q],2).'</td>
                      </tr>';
            }
                      echo ' </tbody>
                           </table>'; 

      }



   	}

}


/* MEDIA DE INSTALAÇÃO GERAL */

function relatorioSomatorioItens () {
    if($_GET['go'] == 'BuscarItensUsados')    {
        require ('conectarBD.php');
        $nome = $_POST['nome_supervisor'];
        $data1 = $_POST['data_inicial'];
        $data2 = $_POST['data_final'];


        $stmt3 = $conexao_pdo->prepare("SELECT distinct id_tecnico FROM t_instalacoes WHERE nome_supervisor = '$nome';");
        $stmt3->execute();
        $result3 = array();
        $totalRow = $stmt3-> rowCount();
        while($r3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
             $result3[] = $r3['id_tecnico'];
        }

      for ($i=0; $i <$totalRow; $i++) { 

        $stmt2 = $conexao_pdo->prepare("SELECT SUM(onu) as onus,SUM(stb) as stbs, SUM(qnt_conectores) as sc_apc , SUM(qnt_conectores2) as sc_pc,
        SUM(qnt_conectores_rj45) as rj45, SUM(qnt_cabo_optico) as cabo_optico, SUM(qnt_bap) as bap, SUM(qnt_cabo_rede) as cabo_rede
        FROM t_instalacoes WHERE (data_instalacao BETWEEN '$data1' AND '$data2') AND id_tecnico = '$result3[$i]'");
        $stmt2->execute();
        $result2 = array();
        while($r2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            $result2[] = $r2;
            
            $totalConector1[$i] = $r2['sc_apc'];
            $totalConector2[$i] = $r2['sc_pc'];
            $totalConectorRJ45[$i] = $r2['rj45'];
            $totalCaboOptico[$i] = $r2['cabo_optico'];
            $totalBap[$i] = $r2['bap'];
            $totalCaboRede[$i] = $r2['cabo_rede'];
            $totalOnu[$i] = $r2['onus'];
            $totalStb[$i] = $r2['stbs'];
      }
    
   $stmt = $conexao_pdo->prepare("SELECT * FROM t_instalacoes,t_tecnicos WHERE t_instalacoes.id_tecnico = t_tecnicos.id AND (data_instalacao BETWEEN '$data1' AND '$data2') AND nome_supervisor = '$nome' AND id_tecnico = '$result3[$i]'  ORDER BY data_instalacao");
    $stmt->execute();
    $totalInstalacao = $stmt->rowCount();
    $result = array();
          while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {

              $result[] = $r;    
              $nome_tecnico[$i] = $r['nome'];
              $teste[$i] = $totalConector1[$i];
              $teste2[$i] = $totalConector2[$i];
              $teste3[$i] = $totalConectorRJ45[$i];
              $teste4[$i]= $totalCaboOptico[$i];
              $teste5[$i] = $totalBap[$i];
              $teste6[$i] = $totalCaboRede[$i];
              $teste8[$i] = $totalOnu[$i];
              $teste9[$i] = $totalStb[$i];
              $teste7[$i] = $totalInstalacao;

 
           }
}          
          $m = ' Metros'; 
          for ($q=0;$q<$totalRow; $q++) {
            echo    '<tr>
                       <td>'.$nome_tecnico[$q].'</td>
                        <td>'.$teste[$q].'</td> 
                        <td>'.$teste2[$q].'</td> 
                        <td>'.$teste3[$q].'</td> 
                        <td>'.$teste4[$q]. $m .'</td> 
                        <td>'.$teste6[$q]. $m .'</td>
                        <td>'.$teste5[$q].'</td> 
                        <td>'.$teste8[$q].'</td> 
                        <td>'.$teste9[$q].'</td> 
                        <td>'.$teste7[$q].'</td>
                     </tr>';   
          }
      
        
    }

}

?>
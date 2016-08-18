			$(function(){
				$.getJSON('solicitacoes.ajax.php?search=',{
						valor: 0, 
						ajax: 'status'}, 
					function(j){
						var tam = j.length;
						$("#alerta").text(tam);
						var falso=0;
						var obs=0;
						for (var i = 0; i < j.length; i++) {
								if (j[i].status == "false"){falso +=1;}
								else if(j[i].status == "Observação"){obs +=1; }
							}
						var notificacao = "<li class='header'>Você tem "+tam+" Alertas</li><li><ul class='menu'><li>";
						notificacao += "<a href='http://localhost/sasInstalacoes/pages/confirmacaoMaterial.php'><i class='fa fa-check-circle text-aqua'></i>Visualizar Instalações Pendentes</a></li>";
							notificacao += "<li><a href='#'><i class='fa fa-warning text-yellow'></i> Material em Observação: "+obs+"</a></li>";
							notificacao +="<li><a href='#'><i class='fa fa-history text-red'></i> Material não Confirmado: "+falso+"</a></li></ul></li>";
							$('#notificacao').html(notificacao);
					});
			});

			function json(){
				$('#pre_info').html('');
				$('#serialIn').text('');
				var a = $('#search').val(); 
				$('#serialIn').val(a);
				buscarSerial();
			}
			

			function buscarSerial(){
				$('#loading').show('block');
				$('#pre_info').hide();
				//console.log($('#serialIn').val());
				if( $('#serialIn').val()) {
					$.getJSON('solicitacoes.ajax.php?search=',{
						valor: $('#serialIn').val(), 
						ajax: 'serial'}, 
					function(j){
						if (j != "") {
							//console.log(j);
							var data =	j[0].data_cadastro_material;
							data = data.split('.');
							var disp = "Com o cliente " + j[0].nome_cliente;
							if (j[0].status) {
								disp = "Disponivel para uso";
							}
							var options = '<b>Nome:</b>' +j[0].nome + ' <b>Responsavel:</b> '+ j[0].localidade + ' <b>Disponibilidade: </b>'+disp+ ' <b>Cadastrado em: </b>' +data[0];	
							
							//$('#pre_info').html(options).show();
							setTimeout(function(){ $('#loading').hide();},1500);
							setTimeout(function(){ $('#pre_info').html(options).show();},1500);
						}else{
							setTimeout(function(){ $('#loading').hide();},1500);
							setTimeout(function(){ $('#pre_info').html('Serial não encontrado.').show();},1500);
							//$('#pre_info').html('Serial não encontrado.').show;
						}
					});
					
				} else {
					$('#pre_info').html('Digite um Serial').show;
				}
			}
		
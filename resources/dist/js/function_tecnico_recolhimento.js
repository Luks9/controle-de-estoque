$('#formTecnicoRecolhimento').submit(function() {
	// Convertemos os dados do formulário para Objeto
	var dados = {};
	$('#formTecnicoRecolhimento').serializeArray().map(function(x){dados[x.name] = x.value;});
	// Configurações para a requisição Ajax
	console.log(dados);
	$.ajax({
		type: "POST",
		url: "/sasInstalacoes/server/cadastrarRecolhimento.php",
		data: dados,
		success: function( data ) {
			console.log (data);
			if (data == true) {
				jQuery.gritter.add({
					title: 'Recolhimento feito com sucesso!',
					text: 'Atualizando...',
					class_name: 'growl-success',
					image: '/sasInstalacoes/resources/images/shield-ok-icon.png',
					sticky: false,
					time: '1200',
				});
				window.setTimeout("location.href=''",1300);
			}
			else if(data == false) {
				jQuery.gritter.add({
					title: 'Existem erros no formulario',
					text: 'Existem Campos em Branco',
					class_name: 'growl-danger',
					image: '/sasInstalacoes/resources/images/shield-error-icon.png',
					sticky: false,
					time: '1200',
				});
				window.setTimeout("location.href=''",1300);
			}
		}
	});
	return false;
});

$('#equipamento').change(function(){
	if( $(this).val() ==1){
		$('#div_radio').show('block');

		$('#div_onu').hide();
		$('#div_stb').hide();
	}else if($(this).val() ==2){
		$('#div_onu').show('block');

		$('#div_radio').hide();
		$('#div_stb').hide();
	}else {
		$('#div_stb').show('block');

		$('#div_onu').hide();
		$('#div_radio').hide();
	}


});

	$(function(){
		$('#estado').change(function(){
			if( $(this).val() ) {
				$('#cidade').hide();
				$('.carregando').show();
				var uf = $(this).val();
				uf = uf.split('/');
				$.getJSON('solicitacoes.ajax.php?search=',{
					cod_estados: uf[0], 
					ajax: 'cidades'}, 
					function(j){
					//console.log(j);
					var options = '<option value=""></option>';	
					for (var i = 0; i < j.length; i++) {
						options += '<option value="' + j[i].nome +'/'+uf[1]+ '">'  + j[i].nome + '</option>';
					}	
					$('#cidade').html(options).show();
					$('.carregando').hide();
				});
			} else {
				$('#cidade').html('<option value="">-- Escolha um estado --</option>');
			}
		});
	});
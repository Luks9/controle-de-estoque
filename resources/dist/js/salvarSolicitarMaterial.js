$('#salvarSolicitacao').submit(function() {
	// Convertemos os dados do formulário para Objeto
	var dados = {};
	$('#salvarSolicitacao').serializeArray().map(function(x){dados[x.name] = x.value;});
	var cadastrar = confirm('Deseja realmente cadastrar este(s) equipamento(s)?');
	// Configurações para a requisição Ajax
	if (cadastrar) {
		console.log(dados);
		$.ajax({
			type: "POST",
			url: "/sasInstalacoes/server/salvarSolicitacao.php",
			data: dados,
			success: function( data ) {
				console.log (data);
				if (data == true) {
					jQuery.gritter.add({
						title: 'Solicitação de Material Realizada',
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
	}
});
$('#form_editar_super').submit(function() {
	// Convertemos os dados do formulário para Objeto
	var dados = {};
	$('#form_editar_super').serializeArray().map(function(x){dados[x.name] = x.value;});
	// Configurações para a requisição Ajax
	console.log(dados);
	$.ajax({
		type: "POST",
		url: "/sasInstalacoes/server/edit_super.php",
		data: dados,
		success: function( data ) {
			console.log (data);
			if (data == true) {
				jQuery.gritter.add({
					title: 'Supervisor editado com sucesso!',
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
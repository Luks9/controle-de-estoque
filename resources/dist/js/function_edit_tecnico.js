$('#form_editar_tecnico').submit(function() {
	// Convertemos os dados do formulário para Objeto
	var dados = {};
	$('#form_editar_tecnico').serializeArray().map(function(x){dados[x.name] = x.value;});
	// Configurações para a requisição Ajax
	console.log(dados);
	$.ajax({
		type: "POST",
		url: "/sasInstalacoes/server/edit_tecnico.php",
		data: dados,
		success: function( data ) {
			console.log (data);
			if (data == true) {
				jQuery.gritter.add({
					title: 'Técnico Atualizando!',
					text: 'Atualizando...',
					class_name: 'growl-success',
					image: 'http://localhost/Luke/images/shield-ok-icon.png',
					sticky: false,
					time: '1000',
				});
				window.setTimeout("location.href=''",1300);
			}
			else if(data == false) {
				jQuery.gritter.add({
					title: 'Existem erros no formulario',
					text: 'Existem Campos em Branco',
					class_name: 'growl-danger',
					image: 'http://localhost/Luke/images/shield-error-icon.png',
					sticky: false,
					time: '1000',
				});
				window.setTimeout("location.href=''",1300);
			}
		}
	});
	return false;
});
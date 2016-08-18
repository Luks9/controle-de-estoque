function apagar(b, a) {
	// Convertemos os dados do formulário para Objeto

		var dados = {};
		$('#form_editar_tecnico').serializeArray().map(function(x){dados[x.name] = x.value;});
		// Configurações para a requisição Ajax
		var apagar = confirm('Deseja realmente excluir este Tecnico?');
		if (apagar) {
			$.ajax({
				type: "POST",
				url: "/sasInstalacoes/server/delete_tecnico.php",
				data: dados,
				success: function( data ) {
					if (data == false) {
						jQuery.gritter.add({
							title: 'Registro Apagado',
							text: 'Tecnico apagado com sucesso.',
							class_name: 'growl-success',
							image: 'http://localhost/Luke/images/shield-ok-icon.png',
							sticky: false,
							time: '2000',
						});
						window.setTimeout("location.href='/sasInstalacoes/pages/cadastrarTecnico.php'",1300);
					}else if (data == true) {
						jQuery.gritter.add({
							title: 'Usuário com material no estoque!',
							text: 'Não é possivel apagar o tecnico, existe material no estoque em seu nome.',
							class_name: 'growl-danger',
							image: '/sasInstalacoes/resources/images/shield-error-icon.png',
							sticky: false,
							time: '3400',
						});
						window.setTimeout("location.href=''",1300);
					}
				}
			});
		}
	}
}

//Scripts de validação JQUERY
jQuery(document).ready(function () {
	//Script para logar via ajax
	$('#validarLogin').validate({
		submitHandler: function( form ){
			var dados = $( form ).serialize();
			$.ajax({
				type: "POST",
				url: "/sasInstalacoes/server/validarUser.php",
				data: dados,
				success: function( data ) {
					if (data == true) {
						jQuery.gritter.add({
							title: 'Conexão Estabelecida !',
							text: 'Redirecionando pagina..',
							class_name: 'growl-success',
							image: '/sasInstalacoes/resources/images/shield-ok-icon.png',
							sticky: false,
							time: '2000',
						});
						window.setTimeout("location.href='/sasInstalacoes/pages/index.php'",1000);
					}else if(data == false) {
						jQuery.gritter.add({
							title: 'Usuário ou Senha Incorretos',
							text: 'Acesso Negado !',
							class_name: 'growl-danger',
							image: '/sasInstalacoes/resources/images/shield-error-icon.png',
							sticky: false,
							time: '2000',
						});
						window.setTimeout("location.href='/sasInstalacoes/'",1000);
					}
				}
			});
			return false;
		}
	});



		$('#validarUsuarioExtranet').validate({
		submitHandler: function( form ){
			var dados = $( form ).serialize();
			$.ajax({
				type: "POST",
				url: "/sasInstalacoes/server/validarUserExtranet.php",
				data: dados,
				success: function( data ) {
					if (data == true) {
						jQuery.gritter.add({
							title: 'Conexão Estabelecida !',
							text: 'Redirecionando pagina..',
							class_name: 'growl-success',
							image: '/sasInstalacoes/resources/images/shield-ok-icon.png',
							sticky: false,
							time: '2000',
						});
						window.setTimeout("location.href='/sasInstalacoes/extranet/index.php'",1000);
					}else if(data == false) {
						jQuery.gritter.add({
							title: 'Usuário ou Senha Incorretos',
							text: 'Acesso Negado !',
							class_name: 'growl-danger',
							image: '/sasInstalacoes/resources/images/shield-error-icon.png',
							sticky: false,
							time: '2000',
						});
						window.setTimeout("location.href='/sasInstalacoes/extranet'",1000);
					}
				}
			});
			return false;
		}
	});
});
$('#form_salvar_saida').submit(function() {
	var flag = false;

	var inputsid = ['onu', 'stb', 'radio', 'telefones'];
	for (var x=0; x<inputsid.length; x++){
		var qnt_inputs = $('input#'+inputsid[x]).val();
		if (qnt_inputs!=0){
			for(var i =0; i<qnt_inputs; i++){
				var valor = $('#'+inputsid[x]+i).val();
				for(var j=i+1; j<qnt_inputs;j++){
					var valor2 = $('#'+inputsid[x]+j).val();
					if(valor == valor2){
						flag = true;
					}
				}
			}
		}
	}
	if (!flag){
		// Convertemos os dados do formulário para Objeto
		var dados = {};
		$('#form_salvar_saida').serializeArray().map(function(x){dados[x.name] = x.value;});
		var cadastrar = confirm('Deseja realmente cadastrar este(s) equipamento(s)?');
		// Configurações para a requisição Ajax
		if (cadastrar) {
			console.log(dados);
			$.ajax({
				type: "POST",
				url: "/sasInstalacoes/server/salvar_saida_estoque.php",
				data: dados,
				success: function( data ) {
					console.log (data);
					if (data == true) {
						jQuery.gritter.add({
							title: 'Cadastro de Material Realizada',
							text: 'Atualizando...',
							class_name: 'growl-success',
							image: '/sasInstalacoes/resources/images/shield-ok-icon.png',
							sticky: false,
							time: '1200',
						});
						window.setTimeout("location.href=''",1300);
					}
					else if(data == 'existi') {
						jQuery.gritter.add({
							title: 'Atenção, Itens Já Cadastrado',
							text: 'Erro: Itens já cadastrados no sistema',
							class_name: 'growl-warning',
							image: '/sasInstalacoes/resources/images/shield-warning-icon.png',
							sticky: false,
							time: '5000',
						});
						window.setTimeout("location.href=''",3000);
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
	}else{
		jQuery.gritter.add({
							title: 'Existem Seriais ou MAC repetidos!',
							text: 'Não sera dado a saída.',
							class_name: 'growl-warning',
							image: '/sasInstalacoes/resources/images/shield-error-icon.png',
							sticky: false,
							time: '5700',
						});
						window.setTimeout("location.href=''",5300);

	}
});
$('#form_salvar_saida_e').submit(function() {
	// Convertemos os dados do formulário para Objeto
	var flag = false;

	var inputsid = ['onu', 'stb', 'radio', 'telefones'];
	for (var x=0; x<inputsid.length; x++){
		var qnt_inputs = $('input#'+inputsid[x]).val();
		if (qnt_inputs!=0){
			for(var i =0; i<qnt_inputs; i++){
				var valor = $('#'+inputsid[x]+i).val();
				for(var j=i+1; j<qnt_inputs;j++){
					var valor2 = $('#'+inputsid[x]+j).val();
					if(valor == valor2){
						flag = true;
					}
				}
			}
		}
	}
	if (!flag){
		var dados = {};
		$('#form_salvar_saida_e').serializeArray().map(function(x){dados[x.name] = x.value;});
		// Configurações para a requisição Ajax
		var cadastrar = confirm('Deseja realmente cadastrar este(s) equipamento(s)?');
		// Configurações para a requisição Ajax
		if (cadastrar) {
			$.ajax({
				type: "POST",
				url: "/sasInstalacoes/server/salvar_saida_estoque_e.php",
				data: dados,
				success: function( data ) {
					console.log (data);
					if (data == true) {
						jQuery.gritter.add({
							title: 'Cadastro de Material Realizada',
							text: 'Atualizando...',
							class_name: 'growl-success',
							image: '/sasInstalacoes/resources/images/shield-ok-icon.png',
							sticky: false,
							time: '1200',
						});
						window.setTimeout("location.href=''",1300);
					}
					else if(data == 'existi') {
						jQuery.gritter.add({
							title: 'Atenção, Itens Já Cadastrado',
							text: 'Erro: Itens já cadastrados no sistema',
							class_name: 'growl-warning',
							image: '/sasInstalacoes/resources/images/shield-warning-icon.png',
							sticky: false,
							time: '5000',
						});
						window.setTimeout("location.href=''",3000);
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
	}else{
		jQuery.gritter.add({
					title: 'Existem Seriais ou MAC repetidos!',
					text: 'Não sera dado a saída.',
					class_name: 'growl-warning',
					image: '/sasInstalacoes/resources/images/shield-error-icon.png',
					sticky: false,
					time: '5700',
				});
				window.setTimeout("location.href=''",5300);

	}
});
function pular(){
	$('.pula').keypress(function(e){
		var tecla = (e.keyCode?e.keyCode:e.which);
		if(tecla == 13){
			campo = $('.pula');
			indice = campo.index(this);
			if(campo[indice+1] != null){
				proximo = campo[indice + 1];
				proximo.focus();
			}
			e.preventDefault(e);
		}
		return true;
	});
}
function printmacs () {
	$('#macs_onu').empty();
	var numero_inputs = $('input#onu').val();
	var estoque_id = $('#estoque_escritorio').val();
	var dados = {id_estoque: estoque_id, equipamento: "onu"};
	if (estoque_id != 0) {
		$.ajax({
			type: "POST",
			url: "/sasInstalacoes/server/printserial.php",
			data: dados,
			success: function( data ){
				for (var i = 0; i < numero_inputs; i++) {
					$('#macs_onu').append("<label>Serial ONU " + (i + 1) +"</label>" +
					"<select name='onu_select" + i + "' id='onu_select" + i + "' style='width: 100%;' class='form-control select2 pula' required><option value='' selected disabled></option>" + data + "</select>");
				};
				valmaconu();
				pular();
			}
		});
	} else{
		for (var i = 0; i < numero_inputs; i++) {
			$('#macs_onu').append("<label>Serial ONU " + (i + 1) +"</label>" +
			"<input type='text' class='form-control pula'  value='' name='onu" + i + "' id='onu" + i + "'>");
		};
		pular();
	};
}
function valmaconu () {
	$('select').change( function () {
		var numero_inputs = $('input#onu').val();
		var sele = [];
		var opti = [];
		for (var y = 0; y < numero_inputs; y++) {
			var valdavez = $('#onu_select' + y).val();
			if ( valdavez != null ) {
				for (var x = 0; x < numero_inputs; x++) {
					if (x != y) {
						var sel = '#onu_select' + x;
						var tamanho = $(sel + ' option').length;
						for (var i = 1; i < (tamanho + 1); i++) {
							if ($(sel + ' option:eq(' + i + ')').val() == valdavez) {
								sele [sele.length] = x;
								opti [opti.length] = i;
								$(sel + ' option:eq(' + i + ')').attr('disabled', true);
							}else{
								for (var t = 0; t < sele.length; t++) {
									if ( sele[t] == x && opti[t] == i) {
										$(sel + ' option:eq(' + i + ')').attr('disabled', true);
										break;
									}else {
										$(sel + ' option:eq(' + i + ')').attr('disabled', false);
									};
								};
							};
						};
					};
				};
			};
		};
	});
}
$( "input#onu" ).change( printmacs );
printmacs();
$( "#estoque_escritorio" ).change( printmacs );
printmacs();
function printmacsstb () {
	$('#macs_stb').empty();
	var numero_inputs = $('input#stb').val();
	var estoque_id = $('#estoque_escritorio').val();
	var dados = {id_estoque: estoque_id, equipamento: "stb"};
	if (estoque_id != 0) {
		$.ajax({
			type: "POST",
			url: "/sasInstalacoes/server/printserial.php",
			data: dados,
			success: function( data ){
				for (var i = 0; i < numero_inputs; i++) {
					$('#macs_stb').append("<label>Serial SetupBox " + (i + 1) +"</label>" +
					"<select name='stb_select" + i + "' id='stb_select" + i + "' style='width: 100%;' class='form-control select2 pula' required><option value='' selected disabled></option>" + data + "</select>");
				};
				valmacstb();
				pular();
			}
		});
	} else{
		for (var i = 0; i < numero_inputs; i++) {
			$('#macs_stb').append("<label>Serial SetupBox " + (i + 1) +"</label>" +
			"<input type='text' class='form-control pula'  value='' name='stb" + i + "' id='stb" + i + "'>");
		};
		pular();
	};
}
function valmacstb () {
	$('select').change( function () {
		var numero_inputs = $('input#stb').val();
		var sele = [];
		var opti = [];
		for (var y = 0; y < numero_inputs; y++) {
			var valdavez = $('#stb_select' + y).val();
			if ( valdavez != null ) {
				for (var x = 0; x < numero_inputs; x++) {
					if (x != y) {
						var sel = '#stb_select' + x;
						var tamanho = $(sel + ' option').length;
						for (var i = 1; i < (tamanho + 1); i++) {
							if ($(sel + ' option:eq(' + i + ')').val() == valdavez) {
								sele [sele.length] = x;
								opti [opti.length] = i;
								$(sel + ' option:eq(' + i + ')').attr('disabled', true);
							}else{
								for (var t = 0; t < sele.length; t++) {
									if ( sele[t] == x && opti[t] == i) {
										$(sel + ' option:eq(' + i + ')').attr('disabled', true);
										break;
									}else {
										$(sel + ' option:eq(' + i + ')').attr('disabled', false);
									};
								};
							};
						};
					};
				};
			};
		};
	});
}
$( "input#stb" ).change( printmacsstb );
printmacsstb();
$( "#estoque_escritorio" ).change( printmacsstb );
printmacsstb();
function printmacsradio () {
	$('#macs_radio').empty();
	var numero_inputs = $('input#radio').val();
	var estoque_id = $('#estoque_escritorio').val();
	var dados = {id_estoque: estoque_id, equipamento: "radio"};
	if (estoque_id != 0) {
		$.ajax({
			type: "POST",
			url: "/sasInstalacoes/server/printserial.php",
			data: dados,
			success: function( data ){
				for (var i = 0; i < numero_inputs; i++) {
					$('#macs_radio').append("<label>Serial Rádio " + (i + 1) +"</label>" +
					"<select name='radio_select" + i + "' id='radio_select" + i + "' style='width: 100%;' class='form-control select2 pula' required><option value='' selected disabled></option>" + data + "</select>");
				};
				valmacradio();
				pular();
			}
		});
	} else{
		for (var i = 0; i < numero_inputs; i++) {
			$('#macs_radio').append("<label>Serial Rádio " + (i + 1) +"</label>" +
			"<input type='text' class='form-control pula'  value='' name='radio" + i + "' id='radio" + i + "'>");
		};
		pular();
	};
}
function valmacradio () {
	$('select').change( function () {
		var numero_inputs = $('input#radio').val();
		var sele = [];
		var opti = [];
		for (var y = 0; y < numero_inputs; y++) {
			var valdavez = $('#radio_select' + y).val();
			if ( valdavez != null ) {
				for (var x = 0; x < numero_inputs; x++) {
					if (x != y) {
						var sel = '#radio_select' + x;
						var tamanho = $(sel + ' option').length;
						for (var i = 1; i < (tamanho + 1); i++) {
							if ($(sel + ' option:eq(' + i + ')').val() == valdavez) {
								sele [sele.length] = x;
								opti [opti.length] = i;
								$(sel + ' option:eq(' + i + ')').attr('disabled', true);
							}else{
								for (var t = 0; t < sele.length; t++) {
									if ( sele[t] == x && opti[t] == i) {
										$(sel + ' option:eq(' + i + ')').attr('disabled', true);
										break;
									}else {
										$(sel + ' option:eq(' + i + ')').attr('disabled', false);
									};
								};
							};
						};
					};
				};
			};
		};
	});
}
$( "input#radio" ).change( printmacsradio );
printmacsradio();
$( "#estoque_escritorio" ).change( printmacsradio );
printmacsradio();
function printmacstelefones () {
	$('#macs_telefones').empty();
	var numero_inputs = $('input#telefones').val();
	var estoque_id = $('#estoque_escritorio').val();
	var dados = {id_estoque: estoque_id, equipamento: "telefones"};
	if (estoque_id != 0) {
		$.ajax({
			type: "POST",
			url: "/sasInstalacoes/server/printserial.php",
			data: dados,
			success: function( data ){
				for (var i = 0; i < numero_inputs; i++) {
					$('#macs_telefones').append("<label>Serial Telefone " + (i + 1) +"</label>" +
					"<select name='telefones_select" + i + "' id='telefones_select" + i + "' style='width: 100%;' class='form-control select2 pula' required><option value='' selected disabled></option>" + data + "</select>");
				};
				valmactelefones();
				pular();
			}
		});
	} else{
		for (var i = 0; i < numero_inputs; i++) {
			$('#macs_telefones').append("<label>Serial Telefone " + (i + 1) +"</label>" +
			"<input type='text' class='form-control pula'  value='' name='telefones" + i + "' id='telefones" + i + "'>");
		};
		pular();
	};
}
function valmactelefones () {
	$('select').change( function () {
		var numero_inputs = $('input#telefones').val();
		var sele = [];
		var opti = [];
		for (var y = 0; y < numero_inputs; y++) {
			var valdavez = $('#telefones_select' + y).val();
			if ( valdavez != null ) {
				for (var x = 0; x < numero_inputs; x++) {
					if (x != y) {
						var sel = '#telefones_select' + x;
						var tamanho = $(sel + ' option').length;
						for (var i = 1; i < (tamanho + 1); i++) {
							if ($(sel + ' option:eq(' + i + ')').val() == valdavez) {
								sele [sele.length] = x;
								opti [opti.length] = i;
								$(sel + ' option:eq(' + i + ')').attr('disabled', true);
							}else{
								for (var t = 0; t < sele.length; t++) {
									if ( sele[t] == x && opti[t] == i) {
										$(sel + ' option:eq(' + i + ')').attr('disabled', true);
										break;
									}else {
										$(sel + ' option:eq(' + i + ')').attr('disabled', false);
									};
								};
							};
						};
					};
				};
			};
		};
	});
}
$( "input#telefones" ).change( printmacstelefones );
printmacstelefones();
$( "#estoque_escritorio" ).change( printmacstelefones );
printmacstelefones();

function printmacs_e () {
	$('#macs_onu_e').empty();
	var numero_inputs = $('input#onu_e').val();
	for (var i = 0; i < numero_inputs; i++) {
		$('#macs_onu_e').append("<label>Serial ONU " + (i + 1) +"</label>" +
		"<input type='text' class='form-control pula'  value='' name='onu_e" + i + "' id='onu_e" + i + "'>");
	};
	pular();
}

function stb_e () {
	$('#macs_stb_e').empty();
	var numero_inputs = $('input#stb_e').val();
	for (var i = 0; i < numero_inputs; i++) {
		$('#macs_stb_e').append("<label>Serial SetupBox" + (i + 1) +"</label>" +
		"<input type='text' class='form-control pula'  value='' name='stb_e" + i + "' id='stb_e" + i + "'>");
	};
	pular();
}

function telefones_e () {
	$('#macs_telefones_e').empty();
	var numero_inputs = $('input#telefones_e').val();
	for (var i = 0; i < numero_inputs; i++) {
		$('#macs_telefones_e').append("<label>Serial Telefone " + (i + 1) +"</label>" +
		"<input type='text' class='form-control pula'  value='' name='telefones_e" + i + "' id='telefones_e" + i + "'>");
	};
	pular();
}

function radio_e () {
	$('#macs_radio_e').empty();
	var numero_inputs = $('input#radio_e').val();
	for (var i = 0; i < numero_inputs; i++) {
		$('#macs_radio_e').append("<label>Serial Rádio " + (i + 1) +"</label>" +
		"<input type='text' class='form-control pula'  value='' name='radio_e" + i + "' id='radio_e" + i + "'>");
	};
	pular();
}

$( "input#onu_e" ).change( printmacs_e );
printmacs_e();
$( "input#stb_e" ).change( stb_e );
stb_e();
$( "input#telefones_e" ).change( telefones_e );
telefones_e();
$( "input#radio_e" ).change( radio_e );
radio_e();
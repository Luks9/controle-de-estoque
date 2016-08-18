$(function() {
	$( "#data_instalacao" ).datepicker({
		language: 'pt-BR',
		autoclose: 'true',
	});
	$("#tabelaFTTH").DataTable({
		 "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": false,
          "info": true,
          "autoWidth": false,
          "iDisplayLength": 5, // Mostrar Apenas 5 registros
	});

	$("#tabelaTV").DataTable();
	$("#tabelaTELEFONIA").DataTable();
	$("#tabelaRADIO").DataTable();
	$("#tabelaCombo").DataTable();
	$("#cpf").inputmask("###.###.###-##");
	$("#onu").inputmask("#");
	$("#radio").inputmask("#");
	$("#stb").inputmask("#");
	$("#telefones").inputmask("#");
});
function printmacs () {
	$('#select_onu').empty();
	var numero_inputs = $('input#onu').val();
	var tecnico_id = $('#id_tecnico').val();
	var dados = {id_tecnico: tecnico_id, equipamento: "onu"};
	$.ajax({
		type: "POST",
		url: "/sasInstalacoes/server/printserial.php",
		data: dados,
		success: function( data ){
			console.log(data);
			for (var i = 0; i < numero_inputs; i++) {
				$('#select_onu').append("<label>Serial ONU " + (i + 1) +"</label>" +
				"<select name='onu_select" + i + "' id='onu_select" + i + "' style='width: 100%;' class='form-control select2 pula' required><option value='' selected disabled></option>" + data + "</select>");
				//$('select').select2();
			};
			teste();
			pular();
		}
	});
}
$( "input#onu" ).change( printmacs );
printmacs();

function teste () {
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
function pular(){
	/* ao pressionar uma tecla em um campo que seja de class="pula" */
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

$( "input#radio" ).change( printradio );
printradio();
function idfunctionftth(a, b, c, d, e, f, g){
	$("#ftth_id").val(a);
	$("#ftth_nome").val(b);
	$("#ftth_data").val(c);
	$("#ftth_cabo").val(d);
	$("#ftth_apc").val(e);
	$("#ftth_pc").val(f);
	$("#ftth_onu").val(g);
}

$('#formCadastrarInstalacao').submit(function() {
	// Convertemos os dados do formulário para Objeto
	var dados = {};
	$('#formCadastrarInstalacao').serializeArray().map(function(x){dados[x.name] = x.value;}); 
	// Configurações para a requisição Ajax
	$.ajax({
		type: "POST",
		url: "/sasInstalacoes/server/cadastrarInstalacao.php",
		data: dados,
		success: function( data ){
			console.log(data);
			if (data == false) {
				jQuery.gritter.add({
					title: 'Instalação Realizada com Sucesso!',
					text: 'Você será redirecionado',
					class_name: 'growl-success',
					image: '/sasInstalacoes/resources/images/shield-ok-icon.png',
					sticky: false,
					time: '2000',
				});
			window.setTimeout("location.href='/sasInstalacoes/pages/index.php'",2000); 
			}else if(data == true) {
				jQuery.gritter.add({
					title: 'Instalação cadastrada!',
					text: 'Você será redirecionado',
					class_name: 'growl-warning',
					image: '/sasInstalacoes/resources/images/shield-warning-icon.png',
					sticky: false,
					time: '2000',
				});
				window.setTimeout("location.href='/sasInstalacoes/pages/index.php'",2000);
			}
		}
	});
	return false;
});
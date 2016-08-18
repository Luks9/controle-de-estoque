var map;
var idInfoBoxAberto;
var infoBox = [];
var markers = [];
var localizacao = [];
var markerPonto;
var contador = 0;
var l = 0;
var contentString;
var infowindow = new google.maps.InfoWindow({
    maxWidth: 300
});
var Nivel = [];

/*Método que inicia configurações iniciados do mapa*/
function initialize() {
    var latlng = new google.maps.LatLng(-7.074146, -39.288829);

    var options = {
        zoom: 5,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("mapa"), options);

    /*Novo parte - adiciona ponteiro geolocalizador(de acordo com as coordenadas informadas em 'latlng'*/
    geocoder = new google.maps.Geocoder();

    marker = new google.maps.Marker({
        map: map,
        draggable: true,
    });

    var dados = new Array();
    $.ajax({
        url : 'returnJson.json',
        data: dados,
        success : function(data){
            for (i in data){
              MostrarCPDs(data[i]);
           }         
        },
        error:function (xhr, ajaxOptions, thrownError) {
            alert("Erro no Processamento dos Dados. Entre em contato com o setor de Tecnologia e informe a mensagem abaixo:\n"+xhr.responseText);
        }

    });

}

function MostrarCPDs(value) {
    // Aqui eu organizo as string a serem mostradas no infowindow.SetContent
    contentString = "<b>Cidade/UF: " + "</b>" +  value['cidadecpd']  +  "<br>" +
    "<b> Responśavel: " + "</b>" +  value['nome'] + "<br>" +
    "<b> E-mail: " + "</b>" +  value['email'] + "<br>" +
    "<b> Telefone: " + "</b>" +  value['telefone'] + "<br>" +
    "<b> Ramal: " + "</b>" +  value['ramal'] + "<br>" +
    "<b> Última Manutenção: " + "</b>" +  value['data_manutencaocpd'] + "<br>" +
    "<b> Nível de Atenção: " + "</b>" +  value['nivelatencaocpd'] + "<br>";

    localizacao.push({
        nome: value['nomecpd'],
        latlng: new google.maps.LatLng(value['latitude'],value['longitude']),



    });
    // Aqui definimos algumas configurações do marcador
    var markerPonto = new google.maps.Marker({
        position: localizacao[l].latlng,
        icon: '../images/cpds-icon.png',
        map: map,
        title: value['nomecpd'],

     });

   
  /* Verificamos o nivel de acesso do CPD para mostramos na Market */
 (function(contentString) {
    google.maps.event.addListener(markerPonto, 'click', function() {

     if ( value['nivelAtencao'] == 'Extrema') { 
          Nivel = "<div class='box box-danger box-solid'>";
          }
      else if (value['nivelAtencao'] == 'Máxima') {
          Nivel = "<div class='box box-warning box-solid'>";
      }
      else if (value['nivelAtencao'] == 'Intermediária') {
          Nivel = "<div class='box box-success box-solid'>";
      }
      else {
          Nivel = "<div class='box box-primary box-solid'>";
      }    

      infowindow.setContent(

         "<div class='col-md-16' style='margin-left:20px;  margin: -0.9px -2px 12px -0.9px; font-family:ubuntu; font-size:14px;'>" +
                 Nivel +
                "<div class='box-header'>" +
                  "<h3 class='box-title' style='font-weight:bold'>" + value['nomecpd'] + "</h3>" +
                "</div>" +
                "<div class='box-body'>" +
                contentString +
                "</div>" +
              "</div>" +
            "</div>"

        );         
    infowindow.open(map, markerPonto);
    });
  })(contentString);

     ++l;
  }


initialize();

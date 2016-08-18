function exibirCampo() {
      var dados = $('#funcao').val();

      if (dados == 'Instalador FTTH'){

       document.getElementById('div_cabo_optico').style.display = 'block';
       document.getElementById('div_onu').style.display = 'block';
       document.getElementById('div_conectores').style.display = 'block';
       document.getElementById('div_conectores2').style.display = 'block';
       document.getElementById('div_bap').style.display = 'block';

       //NÃO APARECE

       document.getElementById('div_conectores_rj45').style.display = 'none';
       document.getElementById('div_stb').style.display = 'none';
       document.getElementById('div_cabo_rede').style.display = 'none';
       document.getElementById('div_radios').style.display = 'none';
       document.getElementById('div_telefones').style.display = 'none';
      }

      else if (dados == 'Instalador TV'){

       document.getElementById('div_stb').style.display = 'block';
       document.getElementById('div_cabo_rede').style.display = 'block';
       document.getElementById('div_conectores_rj45').style.display = 'block';
       document.getElementById('div_bap').style.display = 'block';

       //NÃO APARECE

       document.getElementById('div_conectores').style.display = 'none';
       document.getElementById('div_conectores2').style.display = 'none';
       document.getElementById('div_onu').style.display = 'none';
       document.getElementById('div_cabo_optico').style.display = 'none';
       document.getElementById('div_radios').style.display = 'none';
       document.getElementById('div_telefones').style.display = 'none';

        
      }

      else if (dados == 'Instalador Combo'){

       document.getElementById('div_stb').style.display = 'block';
       document.getElementById('div_cabo_rede').style.display = 'block';
       document.getElementById('div_conectores_rj45').style.display = 'block';
       document.getElementById('div_bap').style.display = 'block';
       document.getElementById('div_conectores').style.display = 'block';
       document.getElementById('div_conectores2').style.display = 'block';
       document.getElementById('div_onu').style.display = 'block';
       document.getElementById('div_cabo_optico').style.display = 'block';

       //NÃO APARECE

       document.getElementById('div_radios').style.display = 'none';
       document.getElementById('div_telefones').style.display = 'none';

        
      }

      else if (dados == 'Material'){

       document.getElementById('div_stb').style.display = 'block';
       document.getElementById('div_cabo_rede').style.display = 'block';
       document.getElementById('div_conectores_rj45').style.display = 'block';
       document.getElementById('div_bap').style.display = 'block';
       document.getElementById('div_conectores').style.display = 'block';
       document.getElementById('div_conectores2').style.display = 'block';
       document.getElementById('div_onu').style.display = 'block';
       document.getElementById('div_cabo_optico').style.display = 'block';
       document.getElementById('div_radios').style.display = 'block'; 

       //NÃO APARECE

       document.getElementById('div_telefones').style.display = 'none';

        
      }


      else if (dados == 'Instalador Rádio'){

       document.getElementById('div_radios').style.display = 'block';
       document.getElementById('div_cabo_rede').style.display = 'block';
       document.getElementById('div_conectores_rj45').style.display = 'block';

       //NÃO APARECE

       document.getElementById('div_conectores').style.display = 'none';
       document.getElementById('div_conectores2').style.display = 'none';
       document.getElementById('div_onu').style.display = 'none';
       document.getElementById('div_cabo_optico').style.display = 'none'; 
       document.getElementById('div_bap').style.display = 'none';  
       document.getElementById('div_stb').style.display = 'none';
       document.getElementById('div_telefones').style.display = 'none';

        
      }
      else if (dados == 'Instalador Telefonia'){
      document.getElementById('div_telefones').style.display = 'block';
      document.getElementById('div_cabo_optico').style.display = 'block';
      document.getElementById('div_conectores_rj45').style.display = 'block';

      //NAO APARECE

       document.getElementById('div_conectores').style.display = 'none';
       document.getElementById('div_conectores2').style.display = 'none';
       document.getElementById('div_onu').style.display = 'none';
       document.getElementById('div_bap').style.display = 'none';  
       document.getElementById('div_stb').style.display = 'none';
       document.getElementById('div_radios').style.display = 'none';

        
      }

      else if (dados == 'Suporte Rapido Rádio'){
       document.getElementById('div_radios').style.display = 'block';
       document.getElementById('div_cabo_rede').style.display = 'block';
       document.getElementById('div_conectores_rj45').style.display = 'block';

       //NÃO APARECE

       document.getElementById('div_conectores').style.display = 'none';
       document.getElementById('div_conectores2').style.display = 'none';
       document.getElementById('div_onu').style.display = 'none';
       document.getElementById('div_cabo_optico').style.display = 'none'; 
       document.getElementById('div_bap').style.display = 'none';  
       document.getElementById('div_stb').style.display = 'none';
       document.getElementById('div_telefones').style.display = 'none';

        
      }

      else if (dados == 'Suporte Fisico Rádio'){

       document.getElementById('div_radios').style.display = 'block';
       document.getElementById('div_cabo_rede').style.display = 'block';
       document.getElementById('div_conectores_rj45').style.display = 'block';
       //NÃO APARECE
       document.getElementById('div_conectores').style.display = 'none';
       document.getElementById('div_conectores2').style.display = 'none';
       document.getElementById('div_onu').style.display = 'none';
       document.getElementById('div_cabo_optico').style.display = 'none'; 
       document.getElementById('div_bap').style.display = 'none';  
       document.getElementById('div_stb').style.display = 'none';
       document.getElementById('div_telefones').style.display = 'none';

        
      }
      
      else if (dados == 'Suporte Rapido FTTH'){

       document.getElementById('div_onu').style.display = 'block';
       document.getElementById('div_conectores').style.display = 'block';
       document.getElementById('div_conectores2').style.display = 'block';
       document.getElementById('div_cabo_optico').style.display = 'block';

       //NÃO APARECE

       document.getElementById('div_conectores_rj45').style.display = 'none';
       document.getElementById('div_radios').style.display = 'none';
       document.getElementById('div_cabo_rede').style.display = 'none'; 
       document.getElementById('div_stb').style.display = 'none';
       document.getElementById('div_telefones').style.display = 'none';
       document.getElementById('div_bap').style.display = 'none';

        
      }

      else if (dados == 'Suporte Fisico FTTH'){

      document.getElementById('div_onu').style.display = 'block';
      document.getElementById('div_conectores').style.display = 'block';
      document.getElementById('div_conectores2').style.display = 'block';
      document.getElementById('div_bap').style.display = 'block';
      document.getElementById('div_cabo_optico').style.display = 'block'; 

       //NÃO APARECE

      document.getElementById('div_conectores_rj45').style.display = 'none';
      document.getElementById('div_radios').style.display = 'none';
      document.getElementById('div_cabo_rede').style.display = 'none'; 
      document.getElementById('div_stb').style.display = 'none';
      document.getElementById('div_telefones').style.display = 'none';

        
      }

}

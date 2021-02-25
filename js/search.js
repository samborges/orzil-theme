$content = $("#resultado");
$('#botao').on('input', function() {
  var title_page , input;
  input = $(this);
  title_page = input.val();

  var datasend = {action: 'load_input_post', title:title_page};
  $.ajax({
    type: "GET",
    data: datasend,
    dataType: "json", //Esse retorno pode ser em HTML tbm
    url: ajaxLoad_ajaxurl, /*Isso daqui é a variavel que passamos pelo 
    localize_script dentro do functions*/
    beforeSend: function() {
           /* geralmente onde se coloca o loader */
    },     
        success: function(data) {
         if(typeof data != "undefined" && typeof data !== null) { 
           if(typeof data.conteudo1 != "undefined" && typeof data.conteudo1 !== null) {       
            $content.html(data.conteudo1);
        }
       }
      } else {
           /* remover loader */
    }
});
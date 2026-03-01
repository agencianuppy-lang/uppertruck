var host = location.host;
var server = "";
if (host == 'localhost'){
  server = host+'/'+pasta;
}else{
  server = host;
}

$('#btLogin').click(function(){
    var form = $('#formL').serialize();

    $.ajax({
      type: "POST",
      url: 'https://'+server+'/admin/auth/auth.php',
      data: form,      

      success: function(response) {
        if (response.trim() == 'error'){
          $('.errorL').fadeIn();
         }else{
          $('#successL').fadeIn();
            $('.formL').submit();
            window.location.href="https://"+server+"/painel";
         }
      }
  });
});

$('#btLoginTR').click(function(){
    var form = $('#formTR').serialize();

    $.ajax({
      type: "POST",
      url: 'https://'+server+'/admin/auth/auth_tr.php',
      data: form,      

      success: function(response) {
        if (response.trim() == 'error'){
          $('.errorL').fadeIn();
         }else{
          $('#successL').fadeIn();
            $('.formL').submit();
            window.location.href="https://"+server+"/configuracoes";
         }
      }
  });
});



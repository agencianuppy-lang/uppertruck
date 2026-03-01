var host = location.host;
var server = "";
if (host == 'localhost'){
  server = host+'/'+pasta;
}else{
  server = host;
}


$('#btnSalvar').click(function(){

  var ferramentas = $('.check_ferr:checkbox:checked').length;

  if (ferramentas == 0){
    swal({
      title: 'Ooops!',
      text: 'Selecione ao menos uma ferramenta :)',
      icon: 'warning',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Ok'
    })
  }else{

    swal("Atualizando Ferramentas...!", {
      closeOnClickOutside: false,
      buttons: false
    });

    var formulario = document.getElementById('formFerramentas');
    var dataForm = new FormData(formulario);

    $.ajax({
      url: 'https://'+server+'/atualiza-ferramentas',
      type: "POST",
      data:  dataForm,
      contentType: false,
      cache: false,
      processData:false,
      success: function(data){
        if (data.trim() == 'ok'){
          swal({
              title: 'Ferramentas Atualizadas',
              icon: 'success',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Ok'
            }).then((value) => {
              window.location.reload();
            });
        }else{
          swal({
              title: 'Ooops! tente novamente.',
              icon: 'warning',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Ok'
            }).then((value) => {
              window.location.reload();
            });
        }
      }         
    });
  }
});

$('#btnSalvarCl').click(function(){

  var nome = $('#nome_cl').val();
  var logo = $('.contIMG input[type=file]').get(0).files.length;

  if (nome == ''){
    swal({
      title: 'Ooops!',
      text: 'Preencha o nome do cliente',
      icon: 'warning',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Ok'
    })
  }else if(logo == 0){
    swal({
      title: 'Atualizar apenas o nome ?',
      icon: 'warning',
      buttons: ["Cancelar e selecionar", "Sim, continuar"]
    }).then((willDelete) => {
      if (willDelete) {
        // Loading
        swal("Atualizando informações...!", {
          closeOnClickOutside: false,
          buttons: false
        });


        var formulario = document.getElementById('formFerramentas');
        var dataForm = new FormData(formulario);

        $.ajax({
          url: 'https://'+server+'/atualiza-cliente',
          type: "POST",
          data:  dataForm,
          contentType: false,
          cache: false,
          processData:false,
          success: function(data){
            if (data.trim() == 'ok'){
              swal({
                  title: 'Cliente Atualizado',
                  icon: 'success',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'Ok'
                }).then((value) => {
                  window.location.reload();
                });
            }else{
              swal({
                  title: 'Ooops! tente novamente.',
                  icon: 'warning',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'Ok'
                }).then((value) => {
                  window.location.reload();
                });
            }
          }         
        });


      }
    });
  }else{
    // Loading
        swal("Atualizando informações...!", {
          closeOnClickOutside: false,
          buttons: false
        });


        var formulario = document.getElementById('formFerramentas');
        var dataForm = new FormData(formulario);

        $.ajax({
          url: 'https://'+server+'/atualiza-cliente',
          type: "POST",
          data:  dataForm,
          contentType: false,
          cache: false,
          processData:false,
          success: function(data){
            if (data.trim() == 'ok'){
              swal({
                  title: 'Cliente Atualizado',
                  icon: 'success',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'Ok'
                }).then((value) => {
                  window.location.reload();
                });
            }else{
              swal({
                  title: 'Ooops! tente novamente.',
                  icon: 'warning',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'Ok'
                }).then((value) => {
                  window.location.reload();
                });
            }
          }         
        });
  }
});



$('#btnProject').click(function(){

  var pasta = $('#nome_proj').val();


  if (pasta == ''){
    swal({
      title: 'Ooops!',
      text: 'Preencha o nome da pasta',
      icon: 'warning',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Ok'
    });
  }else{

    swal("Criando Projeto, aguarde...!", {
      closeOnClickOutside: false,
      buttons: false
    });

    var formulario = document.getElementById('formProjeto');
    var dataForm = new FormData(formulario);

  $.ajax({
    url: 'https://'+server+'/novo-projeto',
    type: "POST",
    data:  dataForm,
    contentType: false,
    cache: false,
    processData:false,
    success: function(data){
      if (data.trim() == 'ok'){
        swal({
            title: 'Projeto Criado',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
          }).then((value) => {
            window.location.reload();
          });
      }else if (data.trim() == 'ja_existe'){
        swal({
            title: 'Já existe uma pasta com o mesmo nome',
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
          })
      }else{
        swal({
            title: 'Ooops! verifique as informações.',
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
          }).then((value) => {
            window.location.reload();
          });
      }
    }         
  });
  }
});


function mudaMobile(){
  if ($('#someSwitchOptionSuccess').prop('checked')) {
    var status = '1';
  }else{
    var status = '0';
  }


  $.ajax({
    url: 'https://'+server+'/atualiza-painel',
    type: "POST",
    data:  {statusMob: status},
    success: function(data){
      if (data.trim() == 'ok'){
        swal({
            title: 'Atualizado',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
          }).then((value) => {
            window.location.reload();
          });
      }else{
        swal({
            title: 'Ooops! tente novamente.',
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
          }).then((value) => {
            window.location.reload();
          });
      }
    }         
  });
}


var host = location.host;
var server = "";
if (host == 'localhost'){
  server = host+'/'+pasta;
}else{
  server = host;
}

// Cadastro de album
$('#cadAlb').click(function(){
    var tituloAlb = $('#nomeAlb').val();
    var dataAlb = $('#dataAlb').val();

    if (tituloAlb == '' || dataAlb == ''){
      swal({
        title: 'Preencha os campos corretamente!',
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok'
      })
    }else{


    var form = $('#FormA').serialize();

    $.ajax({
      type: "POST",
      url: 'https://'+server+'/cadastra-album',
      data: form,      

      success: function(response) {
        if (response.trim() == 'ok'){
            $('.inpAlbum').val('');

            swal({
              title: 'Álbum Criado',
              icon: 'success',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Ok'
            }).then((value) => {
              window.location.reload();
            });

         }else{
          swal({
              title: 'Tente Novamente!',
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


// Botao atualizar
$('#btAtt').click(function(){

  var tituloAlb = $('#attNome').val();
  var dataAlb = $('#attData').val();

  if (tituloAlb == '' || dataAlb == ''){
    swal({
      title: 'Preencha os campos corretamente!',
      icon: 'warning',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Ok'
    })
  }else{

  var form = $('#editAlb').serialize();

    $.ajax({
      type: "POST",
      url: 'https://'+server+'/admin/_galeria/class/editar-album.class.php',
      data: form,      

      success: function(response) {
        if (response.trim() == 'ok'){

            swal({
              title: 'Álbum Editado',
              icon: 'success',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Ok'
            }).then((value) => {
              window.location.reload();
            });
         }else{
            swal({
              title: 'Tente Novamente',
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



function Upload(){
  $('.carregamento').show();
  var formulario = document.getElementById('uploadFT');

    $.ajax({
      url: 'https://'+server+'/upload',
      type: "POST",
      data:  new FormData(formulario),
      xhr: function() {
              var myXhr = $.ajaxSettings.xhr();
              if(myXhr.upload){
                  myXhr.upload.addEventListener('progress',uploadProgress, false);
              }
              return myXhr;
      }, 
      contentType: false,
      cache: false,
      processData:false,
      success: function(data){
        swal({
              title: 'Fotos Carregadas',
              icon: 'success',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Ok'
            }).then((value) => {
              window.location.reload();
            });
      }         
    });
}

function uploadProgress(event) {
  if (event.lengthComputable) {
    var percent = Math.round(event.loaded * 100 / event.total); //cálculo simples de porcentagem.
    document.getElementById('progressbar').value = percent; //atualiza o valor da progress bar.
    var porcentagem = percent + '%';

    $('#progressB').html(porcentagem);
  } else {
    //não é possível computar o progresso =/
  }
}



function deletaFoto(id){
  $.ajax({
    url: 'https://'+server+'/deletaFoto',
    type: "POST",
    data:  {idFoto: id}, 
    success: function(data){
      $('#myModal'+id).hide();
      if (data.trim() == 'ok'){
        swal({
            title: 'Foto Deletada',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((value) => {
          window.location.reload();
        });
      }else{
          swal({
            title: 'Tente Novamente',
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

function deletaAlbum(id){
    swal({
      title: "Deletar Álbum?",
      text: "Ao deletar o álbum, as fotos contidas dentro do mesmo, serão deletadas!",
      icon: "warning",
      buttons: ["Cancelar", "Sim, Deletar"],
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        // Loading
        swal("Aguarde...!", {
          closeOnClickOutside: false,
          buttons: false
        });


        // Ajax
        $.ajax({
          url: 'https://'+server+'/deleta-album',
          type: "POST",
          data:  {idAlbum: id}, 
          success: function(data){
            if (data.trim() == 'ok'){
              swal({
                title: 'Álbum Deletado',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
              }).then((value) => {
                window.location.href='https://'+server+'/galeria_adm';
              });
            }else{
              swal({
                title: 'Tente Novamente',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
              }).then((value) => {
                window.location.reload();
              });
           }
            
          }         
        });
      } else {
        closeModal: true
      }
    });
}
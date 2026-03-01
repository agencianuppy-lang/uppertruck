var host = location.host;
var server = "";
if (host == 'localhost'){
  server = host+'/'+pasta;
}else{
  server = host;
}



function UploadPC(form){
  swal({
    title: "Aguarde!",
    text: "Sua foto está sendo carregada",
    closeOnClickOutside: false,
    buttons: false,
    icon: "warning"
  });

  var formulario = document.getElementById('pc'+form);
  var formE = new FormData(formulario);
  formE.append('pos', form);

  $.ajax({
    url: 'https://'+server+'/upload-banner',
    type: "POST",
    data:  formE,
    contentType: false,
    cache: false,
    processData:false,
    success: function(data){
      if (data.trim() == 'ok'){
          swal({
              title: 'Banner Carregado',
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

function UploadMB(form){
  swal({
    title: "Aguarde!",
    text: "Sua foto está sendo carregada",
    closeOnClickOutside: false,
    buttons: false,
    icon: "warning"
  });

  var formulario = document.getElementById('mb'+form);
  var formE = new FormData(formulario);
  formE.append('pos', form);

  $.ajax({
    url: 'https://'+server+'/upload-banner-mobile',
    type: "POST",
    data:  formE,
    contentType: false,
    cache: false,
    processData:false,
    success: function(data){
      if (data.trim() == 'ok'){
          swal({
              title: 'Banner Carregado',
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


function deletaFotoB(id){
  $.ajax({
    url: 'https://'+server+'/deleta-banner',
    type: "POST",
    data:  {idFotoBanner: id}, 
    success: function(data){
      $('#myModalPc'+id).hide();
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

function deletaFotoMB(id){
  $.ajax({
    url: 'https://'+server+'/deleta-banner',
    type: "POST",
    data:  {idFotoBanner: id}, 
    success: function(data){
      $('#myModalMob'+id).hide();
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
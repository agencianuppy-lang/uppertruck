var host = location.host;
var server = "";
if (host == 'localhost'){
  server = host+'/'+pasta;
}else{
  server = host;
}



$('#btnDown').click(function(){

  var tituloDown = $('#tituloDown').val();
  var imgNot = $('.arquivoDown input[type=file]').get(0).files.length;


  if (tituloDown == '' || imgNot == 0){
    swal({
      title: 'Preencha os campos corretamente!',
      text: 'Preencha o título e selecione um arquivo.',
      icon: 'warning',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Ok'
    })
  }else{

  swal({
    title: "Aguarde!",
    text: "Seu arquivo está sendo carregado",
    closeOnClickOutside: false,
    buttons: false,
    icon: "warning"
  });

  var formulario = document.getElementById('formDow');
  var formE = new FormData(formulario);

  $.ajax({
    url: 'https://'+server+'/upload-arquivo',
    type: "POST",
    data:  formE,
    contentType: false,
    cache: false,
    processData:false,
    success: function(data){
      if (data.trim() == 'ok'){
          swal({
              title: 'Arquivo Carregado!',
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

function deletaDown(id){
    swal({
      title: "Deletar Download?",
      icon: "warning",
      buttons: ["Cancelar", "Sim, Deletar"],
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        // Loading
        swal("Aguarde...!", {
          closeOnClickOutside: false,
          buttons: false
        });


        // Ajax
        $.ajax({
          url: 'https://'+server+'/deleta-arquivo',
          type: "POST",
          data:  {idDownload: id}, 
          success: function(data){
            if (data.trim() == 'ok'){
              swal({
                  title: 'Download Deletado!',
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
        
      } else {
        closeModal: true
      }
    });
}
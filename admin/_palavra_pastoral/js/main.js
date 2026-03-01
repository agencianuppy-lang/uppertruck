var host = location.host;
var server = "";
if (host == 'localhost'){
  server = host+'/'+pasta;
}else{
  server = host;
}


$('#btnPal').click(function(){

  var tituloNot = $('#titulo').val();
  var nome = $('#pastor').val();
  var imgNot = $('.contIMG input[type=file]').get(0).files.length;
  var descricaoNot = (CKEDITOR.instances.editor1.getData());


  if (tituloNot == '' || descricaoNot == '' || imgNot == 0 || nome == ''){
    swal({
      title: 'Ooops!',
      text: 'Preencha todos os campos (título, pastor, imagem e  descrição)',
      icon: 'warning',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Ok'
    })
  }else{

    var formulario = document.getElementById('formPal');
    var dataForm = new FormData(formulario);

  
    dataForm.append('pal-descricao', descricaoNot);

    $.ajax({
      url: 'https://'+server+'/nova-palavra',
      type: "POST",
      data:  dataForm,
      contentType: false,
      cache: false,
      processData:false,
      success: function(data){
        if (data.trim() == 'ok'){
          swal({
              title: 'Palavra Publicada',
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


// Botao atualizar
$('#btnAttPal').click(function(){

  var tituloNot = $('#titulo').val();
  var nome = $('#pastor').val();
  var descricaoNot = (CKEDITOR.instances.editor1.getData());

  if (tituloNot == '' || descricaoNot == '' || nome == ''){
    swal({
      title: 'Ooops!',
      text: 'Preencha todos os campos (título, nome e  descrição)',
      icon: 'warning',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Ok'
    })
  }else{

    var formulario = document.getElementById('attPalavra');
    var dataForm = new FormData(formulario);

    // text area
    var textNotice = (CKEDITOR.instances.editor1.getData());
    
    dataForm.append('att-descricao', textNotice);

    $.ajax({
      url: 'https://'+server+'/edita-palavra',
      type: "POST",
      data:  dataForm,
      contentType: false,
      cache: false,
      processData:false,
      success: function(data){
        if (data.trim() == 'ok'){
          swal({
              title: 'Palavra Atualizada',
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




function deletaPalavra(id){
    swal({
      title: "Deletar Palavra?",
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
          url: 'https://'+server+'/deleta-palavra',
          type: "POST",
          data:  {idPal: id}, 
          success: function(data){
            if (data.trim() == 'ok'){
              swal({
                  title: 'Palavra Deletada!',
                  icon: 'success',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'Ok'
                }).then((value) => {
                  window.location.href="https://"+server+"/palavra_pastoral_adm";
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
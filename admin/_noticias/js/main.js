var host = location.host;
var server = "";
if (host == 'localhost'){
  server = host+'/'+pasta;
}else{
  server = host;
}

// Cadastro de noticia
$('#btnNoticia').click(function(){
    var tituloNot = $('#tituloNot').val();
    var imgNot = $('.contIMG input[type=file]').get(0).files.length;
    var descricaoNot = (CKEDITOR.instances.editor1.getData());


    if (tituloNot == '' || descricaoNot == '' || imgNot == 0){
      swal({
        title: 'Preencha os campos corretamente!',
        text: 'Título, imagem e descrição',
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok'
      })
    }else{

    var formulario = document.getElementById('formNot');
    var dataForm = new FormData(formulario);

    // text area
    var textNotice = $('.descricaoNot').val();
    var textNotice = (CKEDITOR.instances.editor1.getData());
  
    dataForm.append('not-descricao', textNotice);

      $.ajax({
        url: 'https://'+server+'/nova-noticia',
        type: "POST",
        data:  dataForm,
        contentType: false,
        cache: false,
        processData:false,
        success: function(data){
          if (data.trim() == 'ok'){
            swal({
                title: 'Notícia Publicada',
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
$('#att_noticia').click(function(){

  var AttTituloNot = $('#tituloNot').val();
  var AttdescricaoNot = (CKEDITOR.instances.editor1.getData());

  if (AttTituloNot == '' || AttdescricaoNot == ''){
    swal({
      title: 'Preencha os campos corretamente!',
      text: 'Título, imagem e descrição',
      icon: 'warning',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Ok'
    })
  }else{

    var formulario = document.getElementById('FormAttNot');
    var dataForm = new FormData(formulario);

    // text area
    var textNotice = (CKEDITOR.instances.editor1.getData());
    
    dataForm.append('att-descricao', textNotice);

    $.ajax({
      url: 'https://'+server+'/edita-noticia',
      type: "POST",
      data:  dataForm,
      contentType: false,
      cache: false,
      processData:false,
      success: function(data){
        // alert(data);
        if (data.trim() == 'ok'){
          swal({
              title: 'Notícia Atualizada',
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


function deletaNoticia(id){
    swal({
      title: "Deletar Notícia?",
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
          url: 'https://'+server+'/deleta-noticia',
          type: "POST",
          data:  {idNoticia: id}, 
          success: function(data){
            swal({
                title: 'Notícia Deletada',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
            }).then((value) => {
              window.location.href='https://'+server+'/noticias_adm';
            });
          }         
        });
      } else {
        closeModal: true
      }
    });
}
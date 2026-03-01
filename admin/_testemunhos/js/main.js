var host = location.host;
var server = "";
if (host == 'localhost'){
  server = host+'/'+pasta;
}else{
  server = host;
}


$('#btnTestemunhos').click(function(){

  var tituloNot = $('#titulo').val();
  var nome = $('#nome').val();
  var imgNot = $('.contIMG input[type=file]').get(0).files.length;
  var descricaoNot = (CKEDITOR.instances.editor1.getData());


  if (tituloNot == '' || descricaoNot == '' || imgNot == 0 || nome == ''){
    swal({
      title: 'Ooops!',
      text: 'Preencha todos os campos (título, nome, imagem e  descrição)',
      icon: 'warning',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Ok'
    })
  }else{

    var formulario = document.getElementById('formTestemunhos');
    var dataForm = new FormData(formulario);

  
    dataForm.append('test-descricao', descricaoNot);

    $.ajax({
      url: 'https://'+server+'/novo-testemunho',
      type: "POST",
      data:  dataForm,
      contentType: false,
      cache: false,
      processData:false,
      success: function(data){
        if (data.trim() == 'ok'){
          swal({
              title: 'Testemunho Publicado',
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
$('#btnAtt').click(function(){

  var tituloNot = $('#titulo').val();
  var nome = $('#nome').val();
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

    var formulario = document.getElementById('attTest');
    var dataForm = new FormData(formulario);

    // text area
    var textNotice = (CKEDITOR.instances.editor1.getData());
    
    dataForm.append('att-descricao', textNotice);

    $.ajax({
      url: 'https://'+server+'/edita-testemunho',
      type: "POST",
      data:  dataForm,
      contentType: false,
      cache: false,
      processData:false,
      success: function(data){
        if (data.trim() == 'ok'){
          swal({
              title: 'Testemunho Atualizado',
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




function deletaTst(id){
    swal({
      title: "Deletar Testemunho?",
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
          url: 'https://'+server+'/deleta-testemunho',
          type: "POST",
          data:  {idTst: id}, 
          success: function(data){
            if (data.trim() == 'ok'){
              swal({
                  title: 'Testemunho Deletado!',
                  icon: 'success',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'Ok'
                }).then((value) => {
                  window.location.href="https://"+server+"/testemunhos_adm";
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
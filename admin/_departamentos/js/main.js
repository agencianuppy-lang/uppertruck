var host = location.host;
var server = "";
if (host == 'localhost'){
  server = host+'/'+pasta;
}else{
  server = host;
}

// Cadastro de departamento
$('#btnDepto').click(function(){
    var tituloDepto = $('#titulo').val();
    var imgDepto = $('.contIMG input[type=file]').get(0).files.length;
    var descricaoDepto = (CKEDITOR.instances.editor1.getData());


    if (tituloDepto == '' || descricaoDepto == '' || imgDepto == 0){
      swal({
        title: 'Preencha os campos corretamente!',
        text: 'Título, imagem e descrição',
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok'
      })
    }else{

    var formulario = document.getElementById('formDepto');
    var dataForm = new FormData(formulario);

    // text area
    var textNotice = (CKEDITOR.instances.editor1.getData());
  
    dataForm.append('descricao', textNotice);

      $.ajax({
        url: 'https://'+server+'/novo-departamento',
        type: "POST",
        data:  dataForm,
        contentType: false,
        cache: false,
        processData:false,
        success: function(data){
          if (data.trim() == 'ok'){
            swal({
                title: 'Departamento Cadastrado',
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
$('#attDepto').click(function(){

  var tituloDeptoAtt = $('#titulo').val();
  var descricaoDeptoAtt = (CKEDITOR.instances.editor1.getData());

  if (tituloDeptoAtt == '' || descricaoDeptoAtt == ''){
    swal({
      title: 'Preencha os campos corretamente!',
      text: 'Título e descrição',
      icon: 'warning',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Ok'
    })
  }else{

    var formulario = document.getElementById('FormAttDepto');
    var dataForm = new FormData(formulario);

    // text area
    var textNotice = (CKEDITOR.instances.editor1.getData());
    
    dataForm.append('att-descricao', textNotice);

    $.ajax({
      url: 'https://'+server+'/edita-departamento',
      type: "POST",
      data:  dataForm,
      contentType: false,
      cache: false,
      processData:false,
      success: function(data){
        // alert(data);
        if (data.trim() == 'ok'){
          swal({
              title: 'Departamento Atualizado',
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


function deletaDepto(id){
    swal({
      title: "Deletar Departamento?",
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
          url: 'https://'+server+'/deleta-departamento',
          type: "POST",
          data:  {idDepto: id}, 
          success: function(data){
            swal({
                title: 'Departamento Deletado',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
            }).then((value) => {
              window.location.href='https://'+server+'/departamentos_adm';
            });
          }         
        });
      } else {
        closeModal: true
      }
    });
}
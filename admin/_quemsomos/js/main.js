var host = location.host;
var server = "";
if (host == 'localhost'){
  server = host+'/'+pasta;
}else{
  server = host;
}

// Cadastro de noticia
$('#publicarQS').click(function(){
    var quemsomos = (CKEDITOR.instances.editor1.getData());


    if (quemsomos == ''){
      swal({
        title: 'Oooops!',
        text: 'conte um pouquinho sobre você ou sua empresa no campo de descrição acima :)',
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok'
      })
    }else{

    var formulario = document.getElementById('formDesc');
    var dataForm = new FormData(formulario);

    // text area
    var textNotice = (CKEDITOR.instances.editor1.getData());
  
    dataForm.append('descricao', textNotice);

      $.ajax({
        url: 'https://'+server+'/atualiza-quemsomos',
        type: "POST",
        data:  dataForm,
        contentType: false,
        cache: false,
        processData:false,
        success: function(data){
          if (data.trim() == 'ok'){
            swal({
                title: 'Seu texto foi atualizado :)',
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
              window.location.href='https://'+server+'/noticias';
            });
          }         
        });
      } else {
        closeModal: true
      }
    });
}
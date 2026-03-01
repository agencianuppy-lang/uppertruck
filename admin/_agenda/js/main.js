var host = location.host;
var server = "";
if (host == 'localhost'){
  server = host+'/'+pasta;
}else{
  server = host;
}

// Cadastro de agendamento
$('#btnAgendamento').click(function(){
    var tituloAg = $('#titulo').val();
    var descricaoAg = (CKEDITOR.instances.editor1.getData());
    var dataAg = $('#data').val();


    if (tituloAg == '' || descricaoAg == '' || dataAg == ''){
      swal({
        title: 'Preencha os campos corretamente!',
        text: 'Título, data e descrição',
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok'
      })
    }else{

    var formulario = document.getElementById('FormAgendamento');
    var dataForm = new FormData(formulario);

    // text area
    var textNotice = (CKEDITOR.instances.editor1.getData());
  
    dataForm.append('descricao', textNotice);

      $.ajax({
        url: 'https://'+server+'/novo-agendamento',
        type: "POST",
        data:  dataForm,
        contentType: false,
        cache: false,
        processData:false,
        success: function(data){
          if (data.trim() == 'ok'){
            swal({
                title: 'Agendamento Realizado',
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
$('#att_agendamento').click(function(){

    var tituloAg = $('#titulo').val();
    var descricaoAg = (CKEDITOR.instances.editor1.getData());
    var dataAg = $('#data').val();


    if (tituloAg == '' || descricaoAg == '' || dataAg == ''){
      swal({
        title: 'Preencha os campos corretamente!',
        text: 'Título, data e descrição',
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok'
      })
    }else{

    var formulario = document.getElementById('attAgendamento');
    var dataForm = new FormData(formulario);
    // text area
    var textNotice = (CKEDITOR.instances.editor1.getData());
    
    dataForm.append('att-descricao', textNotice);

    $.ajax({
      url: 'https://'+server+'/edita-agendamento',
      type: "POST",
      data:  dataForm,
      contentType: false,
      cache: false,
      processData:false,
      success: function(data){
        // alert(data);
        if (data.trim() == 'ok'){
          swal({
              title: 'Agendamento Atualizado',
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


function deletaAgendamento(id){
    swal({
      title: "Deletar Agendamento?",
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
          url: 'https://'+server+'/deleta-agendamento',
          type: "POST",
          data:  {idAgenda: id}, 
          success: function(data){
            swal({
                title: 'Agendamento Deletado',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
            }).then((value) => {
              window.location.href='https://'+server+'/agenda_adm';
            });
          }         
        });
      } else {
        closeModal: true
      }
    });
}
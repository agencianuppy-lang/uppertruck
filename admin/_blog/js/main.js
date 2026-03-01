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

    var Ncat = $('#Ncategoria').length;
    if (Ncat == 0){
      var categoria = $('#categoria').val();
    }else{
      var categoria = $('#Ncategoria').val();
    }


    if (tituloNot == '' || descricaoNot == '' || imgNot == 0 || categoria == ''){
      swal({
        title: 'Preencha os campos corretamente!',
        text: 'Título, imagem, categoria e descrição',
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
        url: 'https://'+server+'/novo-blog',
        type: "POST",
        data:  dataForm,
        contentType: false,
        cache: false,
        processData:false,
        success: function(data){
          if (data.trim() == 'ok'){
            swal({
                title: 'Publicação Realizada',
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

  var Ncat = $('#Ncategoria').length;
  if (Ncat == 0){
    var categoria = $('#categoria').val();
  }else{
    var categoria = $('#Ncategoria').val();
  }

  // alert(categoria);

  if (AttTituloNot == '' || AttdescricaoNot == '' || categoria == ''){
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
      url: 'https://'+server+'/edita-blog',
      type: "POST",
      data:  dataForm,
      contentType: false,
      cache: false,
      processData:false,
      success: function(data){
        // alert(data);
        if (data.trim() == 'ok'){
          swal({
              title: 'Publicação Atualizada',
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
      title: "Deletar Publicação?",
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
          url: 'https://'+server+'/deleta-blog',
          type: "POST",
          data:  {idNoticia: id}, 
          success: function(data){
            swal({
                title: 'Publicação Deletada',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
            }).then((value) => {
              window.location.href='https://'+server+'/blog_adm';
            });
          }         
        });
      } else {
        closeModal: true
      }
    });
}

function VerificaValor(valor){
  if (valor != ''){
    $('.delCat').show();
  }else{
    $('.delCat').hide();
  }
}


function Add(){
  // oculta a categoria de select
  $('#categoria').hide();

  // remove o icone de adicionar categoria
  $('#addCat').remove();

  // cria um input text para digitar uma categoria
  $('<input>').attr({
      type: 'text',
      id: 'Ncategoria',
      name: 'Ncategoria',
      class: 'form-control',
      maxlength: '60'
  }).appendTo('.dCat');

  // cria o icone de voltar
  $('<b>').attr({
      id: 'backCat',
      class: 'fa fa-arrow-left',
      title: 'Voltar e selecionar uma categoria existente',
  }).appendTo('.btDin');

  // Adiciona o onclick no icone
  $('#backCat').attr('onClick', 'Back();');

  // Oculta a opção de deletar categoria
  $('.delCat').hide();

}

function Back(){
  $('#Ncategoria').remove();
  $('#backCat').remove();

  $('<b>').attr({
      id: 'addCat',
      class: 'fa fa-plus',
      title: 'Adicionar nova categoria',
  }).appendTo('.btDin');

  $('#addCat').attr('onClick', 'Add();');

  $('#categoria').show();

  var value = $('#categoria').val();

  if (value != ''){
    $('.delCat').show();
  }else{
    $('.delCat').hide();
  }
}


function Remove(){
  swal({
      title: "Deletar Categoria?",
      text: "As suas notícias irão ficar sem essa categoria",
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

        var idcat = $('#categoria').val();
        // Ajax
        $.ajax({
          url: 'https://'+server+'/deleta-categoria',
          type: "POST",
          data:  {categoria: idcat}, 
          success: function(data){
            swal({
                title: 'Categoria Deletada',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
            }).then((value) => {
              window.location.reload();
            });
          }         
        });

      }else{
        // closeModal: true;
      }
  });
}
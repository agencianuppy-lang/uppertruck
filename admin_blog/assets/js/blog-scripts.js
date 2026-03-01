document.getElementById('gerarComIA').addEventListener('click', function () {
  const tema = document.getElementById('temaIA').value || 'tema livre';

  Swal.fire({
    title: 'Gerando conteúdo com IA...',
    text: 'Aguarde alguns segundos...',
    allowOutsideClick: false,
    didOpen: () => {
      Swal.showLoading();
    }
  });

  fetch('generate_article.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: 'tema=' + encodeURIComponent(tema)
  })
  .then(res => res.json())
  .then(data => {
    document.getElementById('title').value = data.title;
    document.getElementById('slug').value = data.slug;
    document.getElementById('meta_title').value = data.meta_title;
    document.getElementById('meta_description').value = data.meta_description;
    document.getElementById('tags').value = data.tags.join(', ');
    if (window.editor) {
      editor.setData(data.content);
    } else {
      document.getElementById('editor').value = data.content;
    }

    Swal.fire({
      icon: 'success',
      title: 'Artigo gerado!',
      text: 'Revise antes de publicar.',
      timer: 3000,
      showConfirmButton: false
    });
  })
  .catch(() => {
    Swal.fire({
      icon: 'error',
      title: 'Erro',
      text: 'Não foi possível gerar o artigo.',
    });
  });
});

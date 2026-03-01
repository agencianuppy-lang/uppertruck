document.addEventListener("DOMContentLoaded", function () {
	document.querySelectorAll('.table-bordered').forEach(el => {
	  el.classList.remove('table-bordered');
	  el.classList.add('table');
	});
  
	document.querySelectorAll('.card.border-primary, .card.border-success, .card.border-info, .card.border-secondary').forEach(card => {
	  card.classList.remove('border-primary', 'border-success', 'border-info', 'border-secondary');
	  card.classList.add('shadow-sm');
	});
  });
  

  document.addEventListener("DOMContentLoaded", function () {
	const img = document.getElementById("img-publicado");

	if (img) {
		const imagens = [
			"assets/img/2v.png",
			"assets/img/2.2v.png",
			"assets/img/2.3v.png",
			"assets/img/2.5v.png"
		];

		function trocarImagemAleatoria() {
			const proxima = imagens[Math.floor(Math.random() * imagens.length)];
			img.src = proxima;

			const delay = Math.floor(Math.random() * 1500) + 800; // entre 1s e 3s
			setTimeout(trocarImagemAleatoria, delay);
		}

		trocarImagemAleatoria();
	}
});


document.addEventListener("DOMContentLoaded", function () {
	const img2 = document.getElementById("img-publicado2");

	if (img2) {
		const imagens2 = [
			"assets/img/1v.png",
			"assets/img/1.2v.png",
		];

		function trocarImagem2() {
			const proxima = imagens2[Math.floor(Math.random() * imagens2.length)];
			img2.src = proxima;

			const delay = Math.floor(Math.random() * 2000) + 1000;
			setTimeout(trocarImagem2, delay);
		}

		trocarImagem2();
	}
});




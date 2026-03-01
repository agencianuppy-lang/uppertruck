<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../../auth/login.php');
    exit;
}

require_once '../../includes/header.php';
require_once '../../includes/sidebar.php';
require_once '../../config/db.php'; // ✅ ADICIONE ESTA LINHA
require_once '../../includes/topbar.php';


// Lista de feeds RSS confiáveis
$feeds = [
    'TechCrunch' => 'https://techcrunch.com/feed/',
    'G1 Tecnologia' => 'https://g1.globo.com/rss/g1/tecnologia/',
    'OpenAI Blog' => 'https://openai.com/blog/rss',
    'The Verge' => 'https://www.theverge.com/rss/index.xml',
    'MacMagazine' => 'https://macmagazine.com.br/feed/'
];


function carregarNoticias($url, $limite = 3) {
    $xml = @simplexml_load_file($url);
    if (!$xml) return [];

    $noticias = [];
    foreach ($xml->channel->item as $item) {
        $noticias[] = [
            'titulo' => (string) $item->title,
            'link' => (string) $item->link,
            'descricao' => strip_tags((string) $item->description),
            'data' => date('d/m/Y H:i', strtotime((string) $item->pubDate))
        ];
        if (count($noticias) >= $limite) break;
    }
    return $noticias;
}
?>

<div class="container mt-4">
  <h4 class="mb-4"><i class="fas fa-newspaper me-2"></i>Notícias Atuais</h4>

  <form method="GET" class="mb-4">
    <div class="row g-2">
      <div class="col-md-6">
        <input type="text" name="filtro" class="form-control"
          placeholder="Filtrar por palavra-chave (ex: IA, iPhone, marketing)"
          value="<?= htmlspecialchars($_GET['filtro'] ?? '') ?>">
      </div>
      <div class="col-auto">
        <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-filter me-1"></i>Filtrar</button>
      </div>
    </div>
  </form>



  <?php foreach ($feeds as $fonte => $url): ?>
  <div class="card mb-4 shadow-sm">
    <div class="card-header bg-primary text-white">
      <strong>
        <?= htmlspecialchars($fonte) ?>
      </strong>
    </div>
    <div class="card-body">
      <?php
                $noticias = carregarNoticias($url);
                if (empty($noticias)) {
                    echo "<p>⚠️ Não foi possível carregar as notícias dessa fonte.</p>";
                } else {
                    foreach ($noticias as $noticia): ?>
      <div class="mb-3">
        <h5 class="mb-1">
          <?= htmlspecialchars($noticia['titulo']) ?>
        </h5>
        <small class="text-muted">Publicado em
          <?= $noticia['data'] ?>
        </small>
        <p class="mt-2">
          <?= htmlspecialchars(mb_strimwidth($noticia['descricao'], 0, 180, '...')) ?>
        </p>
        <a href="<?= $noticia['link'] ?>" class="btn btn-sm btn-outline-primary" target="_blank">
          Ler original
        </a>
        <button class="btn btn-sm btn-outline-success copiar-btn ms-2"
          data-conteudo="<?= htmlspecialchars($noticia['titulo'] . " \n\n" . $noticia['descricao']) ?>">
          <i class="fas fa-copy"></i> Copiar resumo
        </button>
      </div>

      <hr>
      <?php endforeach;
                }
                ?>
    </div>
  </div>
  <?php endforeach; ?>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.querySelectorAll('.copiar-btn').forEach(btn => {
    btn.addEventListener('click', function () {
      const conteudo = this.dataset.conteudo;
      navigator.clipboard.writeText(conteudo).then(() => {
        Swal.fire({
          icon: 'success',
          title: 'Copiado!',
          text: 'Resumo copiado para usar com a IA.',
          timer: 1500,
          showConfirmButton: false
        });
      });
    });
  });
</script>
<?php require_once '../../includes/footer.php'; ?>
<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['role'] !== 'admin') {
	header('Location: ../../auth/login.php');
	exit;
}

require_once '../../config/config.php';
require_once '../../config/db.php';

$titulo = $_POST['titulo'] ?? '';
$slug = $_POST['slug'] ?? '';
$categoria_id = $_POST['categoria_id'] ?? null;
$conteudo = $_POST['conteudo'] ?? '';
$data_publicacao = $_POST['data_publicacao'] ?? null;
$imagem_destacada = null;
$autor_id = $_SESSION['usuario']['id'] ?? 1;

// Upload da imagem destacada
if (!empty($_FILES['imagem']['name'])) {
	$extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
	$novo_nome = uniqid() . '.' . $extensao;
	$caminho = '../../assets/uploads/' . $novo_nome;

	if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho)) {
		$imagem_destacada = 'assets/uploads/' . $novo_nome;
	}
}

// Definir status e datas
if ($data_publicacao && strtotime($data_publicacao) > time()) {
	$status = 'agendado';
	$scheduled_at = $data_publicacao;
	$published_at = null;
} else {
	$status = 'publicado';
	$scheduled_at = null;
	$published_at = date('Y-m-d H:i:s');
}

// Inserir no banco
$stmt = $pdo->prepare("INSERT INTO posts (title, slug, content, image, status, scheduled_at, published_at, category_id, author_id, created_at)
	VALUES (:title, :slug, :content, :image, :status, :scheduled_at, :published_at, :category_id, :author_id, NOW())");

$stmt->execute([
	'title' => $titulo,
	'slug' => $slug,
	'content' => $conteudo,
	'image' => $imagem_destacada,
	'status' => $status,
	'scheduled_at' => $scheduled_at,
	'published_at' => $published_at,
	'category_id' => $categoria_id,
	'author_id' => $autor_id
]);

header('Location: list_posts.php?sucesso=1');
exit;
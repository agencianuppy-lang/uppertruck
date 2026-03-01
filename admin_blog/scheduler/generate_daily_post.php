<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/db.php';

function gerarImagemIA($prompt) {
    $apiKey = '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'; // sua chave da OpenAI

    $ch = curl_init('https://api.openai.com/v1/images/generations');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey
    ]);

    $data = [
        "prompt" => "Foto ultra realista, tema: {$prompt}. Iluminação profissional, fundo limpo, sem texto, estilo editorial.",
        "n" => 1,
        "size" => "1024x1024"
    ];

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);
    $url = $result['data'][0]['url'] ?? null;

    if ($url) {
        $ext = '.png';
        $nome_arquivo = time() . '_' . uniqid() . $ext;
        $caminho_absoluto = __DIR__ . '/../assets/uploads/' . $nome_arquivo;
        $caminho_relat = 'assets/uploads/' . $nome_arquivo;

        $img_data = file_get_contents($url);
        if ($img_data) {
            file_put_contents($caminho_absoluto, $img_data);
            return $caminho_relat;
        }
    }

    return null;
}

function gerarTemaAleatorio() {
    $apiKey = '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'; // sua chave da OpenAI

    $prompt = "Crie um tema criativo e informativo para um artigo de blog voltado para o segmento de brigadeiro. Apenas responda com o tema.";

    $ch = curl_init('https://api.openai.com/v1/chat/completions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey
    ]);

    $data = [
        "model" => "gpt-4o",
        "messages" => [
            ["role" => "user", "content" => $prompt]
        ],
        "temperature" => 0.95
    ];

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    curl_close($ch);

    $res = json_decode($response, true);
    return trim($res['choices'][0]['message']['content'] ?? 'Tema criativo');
}

function gerarPostComIA($tema) {
    $apiKey = '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'; // sua chave da OpenAI

    $prompt = "
Você é um redator profissional. Escreva um artigo completo e otimizado sobre o tema: \"$tema\".

Instruções obrigatórias:
- Gere um **título atrativo** com até 60 caracteres (use <h1>)
- Crie **meta title** (até 65) e **meta description** (até 160)
- Liste de 3 a 6 **tags**
- Estrutura com <h2>, <ul><li>, <p> com quebras <br> para respiro
- Use exemplos reais e linguagem acessível

JSON puro no formato:
{
  \"title\": \"\",
  \"slug\": \"\",
  \"meta_title\": \"\",
  \"meta_description\": \"\",
  \"tags\": [\"\", \"\"],
  \"reading_time\": 0,
  \"content\": \"<h1>...</h1><p>...</p>\"
}";

    $ch = curl_init('https://api.openai.com/v1/chat/completions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey
    ]);

    $data = [
        "model" => "gpt-4o",
        "messages" => [
            ["role" => "user", "content" => $prompt]
        ],
        "temperature" => 0.7
    ];

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    curl_close($ch);

    $res = json_decode($response, true);
    $content = $res['choices'][0]['message']['content'] ?? '{}';
    $content = preg_replace('/^```json\s*|\s*```$/', '', trim($content));
    return json_decode($content, true);
}

// Gera novo tema aleatório
$tema = gerarTemaAleatorio();

// Gera o post com esse tema
$post = gerarPostComIA($tema);

if ($post && isset($post['title'])) {
    $image_path = gerarImagemIA($tema);

    $stmt = $pdo->prepare("
        INSERT INTO posts 
        (title, slug, content, image, status, published_at, category_id, author_id, meta_title, meta_description, leitura_minutos, created_at) 
        VALUES 
        (:title, :slug, :content, :image, 'publicado', NOW(), NULL, 1, :meta_title, :meta_description, :reading_time, NOW())
    ");

    $stmt->execute([
        'title' => $post['title'],
        'slug' => $post['slug'],
        'content' => $post['content'],
        'image' => $image_path,
        'meta_title' => $post['meta_title'],
        'meta_description' => $post['meta_description'],
        'reading_time' => $post['reading_time'] ?? 5
    ]);

    echo "✅ Post criado com sucesso: <strong>{$post['title']}</strong>";
} else {
    echo "❌ Erro ao gerar artigo com IA.";
}
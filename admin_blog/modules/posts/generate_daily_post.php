<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../config/config.php';
require_once '../../config/db.php';

function gerarPostComIA($tema = 'tema livre') {
    $apiKey = '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';

    $prompt = "
Você é um redator profissional. Escreva um artigo completo e otimizado sobre o tema: \"$tema\".

Instruções obrigatórias:

- Gere um **título principal atrativo** com até 60 caracteres (use tag <h1>)
- Crie um **meta title** com até 65 caracteres (para SEO)
- Crie uma **meta description** com até 160 caracteres
- Liste entre **3 e 6 tags** relacionadas ao tema

CONTEÚDO DO ARTIGO:
- Comece com uma **introdução envolvente** explicando por que o tema é importante, usando tag <p>
- Os parágrafos devem conter de 6 a 7 linhas — use quebras de linha <br> para dar respiro no texto (ex: 2 linhas, quebra; 3 linhas, quebra...)
- Use subtítulos <h2> para dividir os tópicos
- Utilize listas <ul><li> sempre que fizer sentido
- Dê **exemplos práticos e reais**
- Use **analogias** para facilitar a compreensão
- A linguagem deve ser **humana e acessível**, como se estivesse explicando para um colega

Responda apenas com um JSON puro, sem markdown, no formato:
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

// Lista de temas
$temas = [
    'Tendências de marketing digital para 2025',
    'Como usar IA para criar campanhas mais eficientes',
    'Neuromarketing: como aplicar no tráfego pago',
    'Copywriting persuasivo: técnicas que convertem',
    'Erros comuns em anúncios no Google e como evitar',
    'Como montar uma jornada do cliente estratégica',
    'SEO local para negócios físicos: passo a passo',
    'Funil de vendas no Instagram: como estruturar',
    'Marketing de conteúdo: como gerar autoridade',
    'Automação de marketing: o que usar e quando usar',
    'A importância da identidade visual no digital',
    'Como utilizar storytelling em campanhas de tráfego pago',
    'Remarketing e estratégias de recuperação de leads',
    'Criação de personas para campanhas de alto desempenho',
    'Como integrar mídia paga e orgânica em campanhas de performance'
];

// Escolhe um tema aleatório por dia
$tema = $temas[array_rand($temas)];
$post = gerarPostComIA($tema);

// Publica se tudo estiver OK
if ($post && isset($post['title'])) {
    $stmt = $pdo->prepare("INSERT INTO posts 
    (title, slug, content, image, status, published_at, category_id, author_id, meta_title, meta_description, leitura_minutos, created_at)
    VALUES 
    (:title, :slug, :content, NULL, 'publicado', NOW(), NULL, 1, :meta_title, :meta_description, :reading_time, NOW())");

    $stmt->execute([
        'title' => $post['title'],
        'slug' => $post['slug'],
        'content' => $post['content'],
        'meta_title' => $post['meta_title'],
        'meta_description' => $post['meta_description'],
        'reading_time' => $post['reading_time'] ?? 3
    ]);
}
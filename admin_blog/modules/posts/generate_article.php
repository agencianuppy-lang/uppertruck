<?php
// Caminho: /admin_blog/modules/posts/generate_article.php

header('Content-Type: application/json');

// ✅ Sua chave da OpenAI
$apiKey = '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';

// ✅ Tema recebido via POST
$tema = $_POST['tema'] ?? 'tema livre';

// ✅ Prompt base fixo oculto (muito completo)
$promptPadrao = "
Você é um redator profissional. Crie um artigo extremamente completo, envolvente e explicativo sobre \"$tema\".

Siga estas instruções:

**ESTRUTURA GERAL DO ARTIGO:**
- Gere um título principal atrativo com até 60 caracteres (tag <h1>)

- Crie um **meta title** com até 65 caracteres (para SEO)
- Crie uma **meta description** com até 160 caracteres
- Liste entre 3 e 6 **tags** (relacionadas ao tema)


**CONTEÚDO DO ARTIGO:**
- Comece com uma **introdução envolvente** com `<p>` explicando por que o tema é importante
- para paragrafo, deve conter 6 a 7 linhas, exemplo, escreve 2 linhas e quebra a linha, escreve 3 linhas e quebra a linha, fique a vontade mas precisa ter respiro.
- Use listas `<ul><li>` quando fizer sentido
- Traga **exemplos práticos e reais**, e use analogias para facilitar a compreensão
- Use uma linguagem acessível e humana, como se estivesse explicando a um colega


Evite usar linguagem de IA ou termos genéricos demais. O texto deve parecer escrito por um redator profissional.


{
  \"title\": \"\",
  \"slug\": \"\",
  \"meta_title\": \"\",
  \"meta_description\": \"\",
  \"tags\": [\"\", \"\"],
  \"reading_time\": 0,
  \"content\": \"<h2>...</h2><p>...</p>\"
}
";

$prompt = $promptPadrao;

// ✅ Requisição para a API da OpenAI
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

// ✅ Interpreta a resposta bruta
$result = json_decode($response, true);
$content = $result['choices'][0]['message']['content'] ?? '{}';

// ✅ Remove crases e markdown se vierem
$content = preg_replace('/^```json\s*|\s*```$/', '', trim($content));

// ✅ Decodifica JSON da IA
$dados = json_decode($content, true);

// ✅ Se falhar, retorna o conteúdo bruto para debug
if (!$dados || !isset($dados['title'])) {
    echo json_encode([
        "error" => true,
        "message" => "Falha ao interpretar JSON da IA.",
        "debug_raw" => $content,
        "debug_api_response" => $response
    ]);
    exit;
}

// ✅ Sucesso: envia conteúdo pronto para o JS
echo json_encode($dados);
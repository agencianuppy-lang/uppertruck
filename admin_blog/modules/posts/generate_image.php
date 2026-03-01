<?php
header('Content-Type: application/json');

// 🔑 Sua API Key da OpenAI
$apiKey = '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'; // substitua pela sua

$userPrompt = $_POST['prompt'] ?? '';
$prompt = "Ultra-realistic photo, extremely detailed, sharp lighting, cinematic background, professional style, high fidelity — " . $userPrompt;

if (!$prompt) {
  echo json_encode(['error' => true, 'message' => 'Prompt não fornecido.']);
  exit;
}

$ch = curl_init('https://api.openai.com/v1/images/generations');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  'Content-Type: application/json',
  'Authorization: Bearer ' . $apiKey
]);

$data = [
  'prompt' => $prompt,
  'n' => 1,
  'size' => '512x512',
  'response_format' => 'url'
];

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

if (isset($result['data'][0]['url'])) {
  echo json_encode(['success' => true, 'image_url' => $result['data'][0]['url']]);
} else {
  echo json_encode(['error' => true, 'message' => 'Erro ao gerar imagem.', 'debug' => $response]);
}
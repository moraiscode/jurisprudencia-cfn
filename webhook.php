
<?php
// Função para enviar requisição HTTP e retornar a resposta
function sendRequest($url, $method, $message, $data = null) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);

    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data ? json_encode($data) : '');
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    } else {
        // Para GET, adiciona os dados como query string se houver
        if ($data) {
            $url .= (strpos($url, '?') === false ? '?' : '&') . http_build_query($data);
            curl_setopt($ch, CURLOPT_URL, $url);
        }
    }

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return [
        'status' => $httpCode,
        'response' => $response ? $response : 'Nenhuma resposta',
        'message' => $message
    ];
}

// Testes para as variações de URL e métodos
$urls = [
    'https://n8n-n8n.bqznqa.easypanel.host/webhook/55468fea-aa14-4b74-8e47-8fcccb9cffc1' => 'Prod',
    'https://n8n-n8n.bqznqa.easypanel.host/webhook-test/55468fea-aa14-4b74-8e47-8fcccb9cffc1' => 'Test'
];
$data = ['query' => 'Qual é a lei 1234?'];

$results = [];
foreach ($urls as $url => $mode) {
    $results[$url]['POST'] = sendRequest($url, 'POST', "Tentativa de Produção com POST ($mode/POST)", $data);
    $results[$url]['GET'] = sendRequest($url, 'GET', "Tentativa de Teste com GET ($mode/GET)", $data);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste de Webhook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .result-box {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Resultados do Teste de Webhook</h2>
        <?php foreach ($results as $url => $methods): ?>
            <div class="result-box">
                <h4>URL: <?php echo htmlspecialchars($url); ?></h4>
                <?php foreach ($methods as $method => $result): ?>
                    <div>
                        <strong>Método <?php echo $method; ?>:</strong>
                        <p>Status: <?php echo $result['status']; ?></p>
                        <p>Resposta: <?php echo htmlspecialchars($result['response']); ?></p>
                        <p>Mensagem: <?php echo htmlspecialchars($result['message']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>

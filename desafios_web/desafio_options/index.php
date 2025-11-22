<?php
$method = $_SERVER['REQUEST_METHOD'];
$message = "Error 405: Método no permitido.";
$http_code = 405;

if ($method === 'OPTIONS') {
    header('Allow: GET, POST, OPTIONS');
    header('X-Flag-Info: flag{OPTIONS_c4n_b3_t00_v3rb0s3}');
    $message = "Métodos permitidos: GET, POST, OPTIONS. Revisa las cabeceras para más información.";
    $http_code = 200;
} else if ($method === 'GET') {
    $message = "Error 405: Método GET no permitido. Intenta con otros métodos.";
}

http_response_code($http_code);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>API Endpoint</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;600&display=swap');
        body { background-color: #1e1e1e; color: #d4d4d4; font-family: 'Fira Code', monospace; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .container { background-color: #252526; border: 1px solid #3c3c3c; border-radius: 8px; width: 600px; padding: 30px; }
        h1 { color: #ce9178; margin: 0 0 10px 0; font-size: 2em; }
        span.code { color: #9cdcfe; }
        span.error { color: #f48771; }
        p { font-size: 1.1em; line-height: 1.6; }
    </style>
</head>
<body>
    <div class="container">
        <h1><span class="code">/api/v1/status</span></h1>
        <p><span class="error"><?= htmlspecialchars($message) ?></span></p>
    </div>
</body>
</html>

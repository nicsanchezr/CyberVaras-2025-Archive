<?php
$content = "<p class='placeholder'>Introduce una URL para verificar su estado (ej: https://google.com)</p>";
if (isset($_GET['url'])) {
    $url = $_GET['url'];
    if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
        $content = "<h2>Error</h2><pre>URL no válida.</pre>";
    } else {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);

	// --- INICIO DE LA SOLUCIÓN ---
	// Añade esta línea para forzar el Host header
	// y que Nginx sepa qué sitio servir.
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: desafio.cybervaras.xyz'));
	// --- FIN DE LA SOLUCIÓN ---


        $output = curl_exec($ch);

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        $status = $http_code >= 200 && $http_code < 300 ? 'online' : 'offline';
        $content = "
            <h2>Reporte de Estado</h2>
            <div class='status-box $status'>
                <strong>Estado:</strong> $status (Código: $http_code)
            </div>
            <h3>Respuesta del Servidor:</h3>
            <pre class='output-box'>" . htmlspecialchars($output) . "</pre>
        ";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Desafío: SSRF</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap');
        body { background-color: #f4f7f9; color: #333; font-family: 'Roboto', sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .container { background-color: #fff; border-radius: 10px; box-shadow: 0 8px 25px rgba(0,0,0,0.1); width: 800px; padding: 40px; }
        h1 { text-align: center; color: #0a2540; margin-top: 0; }
        form { display: flex; margin-bottom: 20px; }
        input[type="text"] { flex-grow: 1; padding: 12px 15px; border: 1px solid #dcdcdc; border-radius: 6px 0 0 6px; font-size: 16px; }
        input[type="submit"] { padding: 12px 20px; border: none; background-color: #007bff; color: white; font-size: 16px; font-weight: bold; border-radius: 0 6px 6px 0; cursor: pointer; }
        .placeholder { color: #777; text-align: center; }
        .status-box { padding: 15px; border-radius: 5px; font-weight: bold; font-size: 1.1em; margin: 15px 0; }
        .online { background-color: #e6f7ec; color: #1e8e3e; border: 1px solid #1e8e3e; }
        .offline { background-color: #fce8e6; color: #d93025; border: 1px solid #d93025; }
        .output-box { background-color: #2a2a2e; color: #f1f1f1; padding: 15px; border-radius: 5px; max-height: 300px; overflow-y: auto; white-space: pre-wrap; word-wrap: break-word; }
    </style>
</head>
<body><div class="container"><h1>Verificador de Estado de Sitios Web</h1><form><input type="text" name="url" placeholder="https://ejemplo.com"><input type="submit" value="Verificar"></form><?= $content ?></div></body>
</html>

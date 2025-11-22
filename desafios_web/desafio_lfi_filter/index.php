<?php
// flag{php_f1lt3rs_4r3_p0w3rfu1}

$page = $_GET['page'] ?? 'ayuda.txt';
$content = '';

if (strpos($page, '../') !== false) {
    $content = '<h1>Ataque Detectado</h1><p>Intento de traversa de directorio bloqueado.</p>';
} else {
    ob_start();
    @include($page);
    $content = ob_get_clean();
    if (empty($content) && $page === 'ayuda.txt') {
        $content = '<h1>Página de Ayuda</h1><p>Bienvenido al centro de ayuda. Use el parámetro ?page= para cargar otras guías.</p>';
    } else if (empty($content)) {
        $content = "<h1>Error</h1><p>No se pudo cargar la página: " . htmlspecialchars($page) . "</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Desafío: Lector de Código</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap');
        body { background-color: #f9f9f9; color: #333; font-family: 'Lato', sans-serif; }
        .container { max-width: 900px; margin: 40px auto; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { color: #2c3e50; }
        .content-area { background-color: #fff; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .sidebar { float: left; width: 200px; padding: 20px; background-color: #f1f1f1; border-radius: 8px 0 0 8px; }
        .sidebar h2 { margin-top: 0; }
        .sidebar ul { list-style: none; padding: 0; }
        .sidebar ul li a { text-decoration: none; color: #007bff; display: block; padding: 8px 0; }
        .sidebar ul li a:hover { text-decoration: underline; }
        .main-content { margin-left: 240px; padding: 30px; min-height: 200px; word-wrap: break-word; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header"><h1>Base de Conocimiento</h1></div>
        <div class="content-area">
            <div class="sidebar">
                <h2>Navegación</h2>
                <ul>
                    <li><a href="?page=ayuda.txt">Ayuda General</a></li>
                    <li><a href="?page=contacto.txt">Contacto</a> (no existe)</li>
                </ul>
            </div>
            <div class="main-content">
                <?= $content // El contenido (o la flag en base64) se imprime aquí ?>
            </div>
        </div>
    </div>
</body>
</html>

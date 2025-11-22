<?php
// Lee el User-Agent enviado por el cliente. Si no existe, lo deja en blanco.
$user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
$content = '';
$page_title = 'Portal de Mantenimiento - Acceso Denegado';
$granted = false;

// Compara de forma estricta si el User-Agent es el correcto.
if ($user_agent === 'CyberVaras-Secret-Bot/1.0') {
    // Si es correcto, prepara el contenido de éxito y actualiza el título.
    $granted = true;
    $page_title = 'Portal de Mantenimiento - Acceso Concedido';
    $content = "
        <p class='line message granted'>> ACCESO AUTORIZADO</p>
        <p class='line message granted' style='animation-delay: 2s;'>> Protocolos de mantenimiento activados.</p>
        <p class='line message granted' style='animation-delay: 4s;'>> La flag es: flag{wH0_4m_1_t0d4y?}</p>
    ";
} else {
    // Si no es correcto, prepara el contenido de denegación.
    $content = "
        <p class='line message denied'>> ERROR: ACCESO DENEGADO</p>
        <p class='line message denied' style='animation-delay: 2s;'>> User-Agent no autorizado.</p>
        <p class='line message denied' style='animation-delay: 4s;'>> Desconectando...</p>
    ";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $page_title ?></title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap');

        body {
            background-color: #0a0a0a;
            color: #00ff41;
            font-family: 'Share Tech Mono', monospace;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            text-shadow: 0 0 5px #00ff41;
        }

        .terminal {
            width: 800px;
            background-color: rgba(0, 0, 0, 0.8);
            border: 2px solid #00ff41;
            border-radius: 5px;
            box-shadow: 0 0 20px rgba(8, 255, 80, 0.51);
            padding: 20px;
        }

        .terminal-header {
            background-color: #00ff41;
            color: #0a0a0a;
            padding: 5px 10px;
            text-shadow: none;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .terminal-header .cursor {
            display: inline-block;
            background-color: #0a0a0a;
            animation: blink 1s step-end infinite;
        }

        .terminal-body {
            padding-top: 20px;
            height: 150px;
        }

        .line {
            white-space: pre;
            overflow: hidden;
            width: 0;
            animation: typing 2s steps(40, end) forwards;
        }

        .message.denied {
            color: #ff4141;
            text-shadow: 0 0 5px #ff4141;
        }

        .message.granted {
            color: #00ff41;
            text-shadow: 0 0 5px #00ff41;
        }

        @keyframes typing {
            from { width: 0; }
            to { width: 100%; }
        }
        
        @keyframes blink {
            from, to { background-color: transparent }
            50% { background-color: #0a0a0a; }
        }

    </style>
</head>
<body>
    <div class="terminal">
        <div class="terminal-header">
            <span>[root@cybervaras ~]#&nbsp;<span class="cursor">_</span></span>
            <span>SYSTEM MAINTENANCE PORTAL</span>
        </div>
        <div class="terminal-body">
            <?= $content ?>
        </div>
    </div>
</body>
</html>

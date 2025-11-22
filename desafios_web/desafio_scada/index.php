<?php
$pressure = rand(980, 1020) / 100.0;
$diagnostic_output = '';
if (isset($_GET['debug_ping'])) {
    $host = $_GET['debug_ping'];
    $diagnostic_output = shell_exec('ping -c 2 ' . $host);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>SCADA - Panel de Presa</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap');
        body { background-color: #1a1a1a; color: #e0e0e0; font-family: 'Orbitron', sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .container { background: linear-gradient(145deg, #2c2c2c, #1e1e1e); border: 2px solid #00c853; border-radius: 10px; box-shadow: 0 0 25px rgba(0, 200, 83, 0.3); max-width: 800px; width: 100%; padding: 30px; }
        .header { text-align: center; border-bottom: 1px solid #444; margin-bottom: 20px; padding-bottom: 10px; }
        .header h1 { color: #00c853; text-shadow: 0 0 10px #00c853; margin: 0; font-size: 24px; letter-spacing: 2px; }
        #gauge { background-color: #111; border: 1px solid #333; padding: 25px; text-align: center; border-radius: 8px; margin-bottom: 20px; }
        #gauge h2 { margin: 0 0 10px 0; color: #ffab00; font-size: 18px; }
        #gauge .pressure-value { font-size: 4em; font-weight: 700; color: #ffffff; text-shadow: 0 0 15px #fff; }
        #gauge .status { font-size: 1.2em; font-weight: bold; }
        .status.stable { color: #00e676; }
        .status.warning { color: #ffd600; }
        .status.danger { color: #ff1744; animation: blink 1s linear infinite; }
        #results { background-color: #000; border: 1px solid #00c853; border-radius: 5px; padding: 15px; margin-top: 20px; }
        #results strong { color: #00c853; display: block; margin-bottom: 10px; }
        pre { white-space: pre-wrap; word-wrap: break-word; color: #ccc; font-family: 'Courier New', monospace; font-size: 14px; }
        @keyframes blink { 50% { opacity: 0; } }
    </style>
</head>
<body>
    <div class="container">
        <div class="header"><h1>[HMI] PANEL DE CONTROL - PRESA CYBERVARAS</h1></div>
        <div id="gauge">
            <h2>LECTURA DE PRESIÓN HIDRÁULICA</h2>
            <p class="pressure-value"><?= $pressure ?> Bar</p>
            <p class="status stable">ESTADO: ESTABLE</p>
        </div>
        <?php if ($diagnostic_output): ?>
        <div id="results">
            <strong>> Salida de Diagnóstico del Sistema:</strong>
            <pre><?= htmlspecialchars($diagnostic_output) ?></pre>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>

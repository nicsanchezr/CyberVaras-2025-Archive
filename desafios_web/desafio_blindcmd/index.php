<?php
$message = '';
if (isset($_POST['ip'])) {
    $ip = $_POST['ip'];
    // VULNERABILIDAD: La entrada se usa directamente en shell_exec
    // La salida se oculta intencionalmente con @
    @shell_exec('ping -c 1 ' . $ip);
    
    $message = "Ping a <strong>" . htmlspecialchars($ip) . "</strong> enviado. Petición completada.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Desafío: El Oráculo</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
        body { background-color: #f0f2f5; color: #333; font-family: 'Poppins', sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .container { background-color: #fff; border-radius: 10px; box-shadow: 0 8px 25px rgba(0,0,0,0.1); width: 500px; padding: 40px; text-align: center; }
        h1 { color: #0a2540; margin-top: 0; }
        p { color: #555; }
        form { display: flex; flex-direction: column; margin: 20px 0; }
        input[type="text"] { padding: 12px 15px; border: 1px solid #dcdcdc; border-radius: 6px; font-size: 16px; margin-bottom: 15px; }
        input[type="submit"] { padding: 12px 20px; border: none; background-color: #007bff; color: white; font-size: 16px; font-weight: bold; border-radius: 6px; cursor: pointer; }
        .message-box { min-height: 50px; padding-top: 20px; font-size: 1.1em; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Diagnóstico de Red</h1>
        <p>Introduce una IP para enviar un ping de diagnóstico.</p>
        <form action="" method="POST">
            <input type="text" name="ip" placeholder="8.8.8.8">
            <input type="submit" value="Hacer Ping">
        </form>
        <div class="message-box"><?= $message ?></div>
    </div>
</body>
</html>

<?php
session_start();
// Doble chequeo: debe estar logueado Y tener la cookie de admin.
if (!isset($_SESSION['loggedin']) || ($_COOKIE['is_admin'] ?? 'false') !== 'true') {
    die('Acceso Denegado. Se requiere autenticación y privilegios de administrador.');
}

$ping_output = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ip'])) {
    $ip = $_POST['ip'];
    // VULNERABILIDAD: Inyección de Comandos. La entrada se concatena.
    $command = 'ping -c 3 ' . $ip;
    $ping_output = shell_exec($command);
}
?>
<!DOCTYPE html>
<html>
<head><title>El Bastión - Admin Panel</title><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="container">
        <h1>Panel de Diagnóstico [ADMIN]</h1>
        <p>Este panel permite ejecutar comandos de diagnóstico de red para verificar la conectividad del servidor.</p>
        
        <form action="" method="POST">
            <div class="form-group">
                <input type="text" name="ip" placeholder="8.8.8.8">
            </div>
            <input type="submit" value="Ejecutar Ping">
        </form>
        
        <?php if ($ping_output): ?>
            <h2>Resultado del Diagnóstico:</h2>
            <pre><?= htmlspecialchars($ping_output) ?></pre>
        <?php endif; ?>
    </div>
</body>
</html>

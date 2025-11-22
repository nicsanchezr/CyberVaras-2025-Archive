<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php'); // Redirige si no está logueado
    exit;
}
// VULNERABILIDAD: El rol se lee de una cookie que el cliente puede cambiar.
$is_admin = $_COOKIE['is_admin'] ?? 'false';
?>
<!DOCTYPE html>
<html>
<head><title>El Bastión - Dashboard</title><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="container">
        <h1>Dashboard de Usuario</h1>
        <p>Bienvenido, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>. Tu nivel de acceso es: <strong><?= htmlspecialchars($is_admin) ?></strong>.</p>
        
        <div class="message success">¡Login exitoso! Has superado la primera defensa.</div>
        <div class="flag">FLAG 1: flag{SQLi_bypass_is_just_the_beginning}</div>
        
        <hr style="border-color:#444; margin: 30px 0;">
        
        <?php if ($is_admin === 'true'): ?>
            <h2>Acceso de Administrador</h2>
            <div class="message success">¡Privilegios escalados!</div>
            <div class="flag">FLAG 2: flag{admin_privileges_are_only_a_cookie_away}</div>
            <p>Has ganado acceso al panel de diagnóstico del sistema. Úsalo para encontrar la flag final.</p>
            <a href="admin_panel.php" style="font-weight:bold; font-size: 1.2em;">&gt; Ir al Panel de Diagnóstico &lt;</a>
        
        <?php else: ?>
            <h2>Acceso de Usuario</h2>
            <p>Has accedido al panel de usuario. La siguiente etapa requiere privilegios de administrador, pero el panel parece estar oculto. ¿Cómo podría el servidor saber qué tipo de usuario eres?</p>
        <?php endif; ?>
    </div>
</body>
</html>

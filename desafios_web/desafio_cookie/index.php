<?php
if (!isset($_COOKIE['user_role'])) {
    setcookie('user_role', 'invitado', time() + 3600, '/desafio_cookie/');
    $role = 'invitado';
} else {
    $role = $_COOKIE['user_role'];
}
$is_admin = ($role === 'admin');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Desafío: Panel de Usuario</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
        body { background-color: #f0f2f5; color: #333; font-family: 'Poppins', sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .container { background-color: #fff; border-radius: 10px; box-shadow: 0 8px 25px rgba(0,0,0,0.1); width: 600px; overflow: hidden; }
        .header { padding: 25px 30px; background-color: <?= $is_admin ? '#28a745' : '#007bff' ?>; color: white; }
        .header h1 { margin: 0; font-size: 1.8em; }
        .header p { margin: 5px 0 0 0; opacity: 0.9; }
        .content { padding: 30px; }
        .content p { font-size: 1.1em; line-height: 1.6; }
        .flag-box { background-color: #f8f9fa; border: 1px dashed #ddd; padding: 20px; border-radius: 5px; font-family: 'Courier New', monospace; font-size: 1.2em; color: #c7254e; }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($is_admin): ?>
            <div class="header">
                <h1>Panel de Administración</h1>
                <p>Bienvenido, Admin. Acceso Total.</p>
            </div>
            <div class="content">
                <p>¡Acceso concedido! Aquí están los controles del sistema:</p>
                <div class="flag-box">flag{c00k13s_4r3_n0t_s3cur3_st0r4g3}</div>
            </div>
        <?php else: ?>
            <div class="header">
                <h1>Portal de Invitados</h1>
                <p>Bienvenido, <?= htmlspecialchars($role) ?>.</p>
            </div>
            <div class="content">
                <p>El panel de administración está actualmente restringido solo para personal autorizado.</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>

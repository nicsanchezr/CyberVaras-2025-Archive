<?php
function is_blocked($input) {
    $blacklist = ['union', 'select', 'or', 'and', ' ', '--', ';', '/*', '*/'];
    $lower_input = strtolower($input);
    foreach ($blacklist as $word) {
        if (strpos($lower_input, $word) !== false) return true;
    }
    return false;
}

$message = "";
$message_type = ""; // 'success', 'error', 'blocked'

if (isset($_GET['username'])) {
    $username = $_GET['username'];
    if (is_blocked($username)) {
        $message = "¡ATAQUE DETECTADO POR EL GUARDIÁN!";
        $message_type = 'blocked';
    } else {
        try {
            $db = new PDO('sqlite:ctf_challenges.db');
            $sql = "SELECT username, fullname, password FROM users WHERE username = '$username'";
            $stmt = $db->query($sql);
            $user = $stmt->fetch();
            if ($user) {
                // Si la búsqueda es exitosa, se muestra el nombre, pero la flag es la contraseña.
                $message = "<strong>Usuario:</strong> " . htmlspecialchars($user['username']) . "<br><strong>Nombre:</strong> " . htmlspecialchars($user['fullname']);
                if (strtolower($user['username']) === 'ghost_racer') {
                     $message .= "<br><strong>FLAG:</strong> flag{" . htmlspecialchars($user['password']) . "}";
                }
                $message_type = 'success';
            } else {
                $message = "Usuario no encontrado.";
                $message_type = 'error';
            }
        } catch (PDOException $e) { 
            $message = "Error de sintaxis SQL.";
            $message_type = 'error';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Desafío: El Guardián</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #eef2f5; color: #333; margin: 0; padding: 20px; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .container { max-width: 600px; background-color: #fff; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); padding: 2rem; text-align: center; }
        h1 { color: #0056b3; }
        p { color: #555; }
        .logo { font-weight: bold; font-size: 1.5em; color: #0056b3; margin-bottom: 20px; }
        form { display: flex; justify-content: center; margin: 30px 0; }
        input[type="text"] { width: 70%; padding: 12px; border: 1px solid #ccc; border-radius: 5px 0 0 5px; font-size: 1em; }
        input[type="submit"] { padding: 12px 20px; background-color: #007bff; color: white; border: none; border-radius: 0 5px 5px 0; cursor: pointer; font-size: 1em; transition: background-color 0.3s; }
        input[type="submit"]:hover { background-color: #0056b3; }
        #results { margin-top: 20px; padding: 15px; border-radius: 5px; min-height: 50px; text-align: left; }
        .success { background-color: #d4edda; border-left: 5px solid #28a745; color: #155724; }
        .error { background-color: #f8d7da; border-left: 5px solid #dc3545; color: #721c24; }
        .blocked { background-color: #fff3cd; border-left: 5px solid #ffc107; color: #856404; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">CyberCorp</div>
        <h1>Portal de Búsqueda de Empleados</h1>
        <p>Busca un empleado por su nombre de usuario. El sistema está protegido por un WAF.</p>
        <form action="" method="GET">
            <input type="text" name="username" placeholder="Nombre de usuario..." value="<?= isset($_GET['username']) ? htmlspecialchars($_GET['username']) : '' ?>">
            <input type="submit" value="Buscar">
        </form>
        <?php if ($message): ?>
            <div id="results" class="<?= $message_type ?>"><?= $message ?></div>
        <?php endif; ?>
    </div>
</body>
</html>

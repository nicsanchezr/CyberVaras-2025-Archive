<?php
session_start();
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['user'] === 'guest' && $_POST['pass'] === 'guest') {
        $header = rtrim(strtr(base64_encode('{"alg":"HS256","typ":"JWT"}'), '+/', '-_'), '=');
        $payload = rtrim(strtr(base64_encode('{"user":"guest","role":"user","exp":'.(time() + 3600).'}'), '+/', '-_'), '=');
        $token = "$header.$payload.";
        setcookie("session_token", $token, time()+3600, "/desafio_jwt/");
        $message = "<div class='message success'>Login exitoso. Intenta acceder al <a href='admin.php'>panel de admin</a>.</div>";
    } else { $message = "<div class='message error'>Credenciales incorrectas.</div>"; }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Portal de Acceso</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
        body { background: #1f2029; color: #c4c3ca; font-family: 'Poppins', sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .container { background: #2a2b38; background-image: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/1462889/pat.svg'); background-position: bottom center; background-repeat: no-repeat; background-size: 300%; border-radius: 6px; box-shadow: 0 20px 50px rgba(0,0,0,0.3); width: 400px; padding: 50px; }
        h1 { font-weight: 600; text-align: center; color: #fff; margin-bottom: 30px; }
        .form-group { margin-bottom: 20px; position: relative; }
        .form-group label { display: block; color: #8a8991; margin-bottom: 5px; }
        input[type="text"], input[type="password"] { width: 100%; padding: 12px; background: #1f2029; border: 2px solid #2e2f3c; border-radius: 4px; color: #c4c3ca; font-size: 16px; transition: border-color 0.3s; box-sizing: border-box; }
        input[type="text"]:focus, input[type="password"]:focus { outline: none; border-color: #ffeba7; }
        input[type="submit"] { width: 100%; padding: 12px; border: none; background-color: #ffeba7; color: #102770; font-size: 16px; font-weight: 600; border-radius: 4px; cursor: pointer; transition: background-color 0.3s; }
        input[type="submit"]:hover { background-color: #ffc44f; }
        .message { padding: 15px; border-radius: 4px; margin-top: 20px; text-align: center; }
        .message.success { background-color: rgba(46, 160, 67, 0.2); color: #2ea043; }
        .message.success a { color: #58a6ff; font-weight: 600; }
        .message.error { background-color: rgba(247, 120, 186, 0.2); color: #f778ba; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Acceso al Portal</h1>
        <form action="" method="POST">
            <div class="form-group">
                <label for="user">Usuario</label>
                <input type="text" id="user" name="user">
            </div>
            <div class="form-group">
                <label for="pass">Contraseña</label>
                <input type="password" id="pass" name="pass">
            </div>
            <input type="submit" value="Iniciar Sesión">
        </form>
        <?= $message ?>
    </div>
</body>
</html>

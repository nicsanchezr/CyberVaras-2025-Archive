<?php
function base64url_decode($data) { return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); }
$flag = "Acceso Denegado. Solo para administradores.";
$access_granted = false;
if (isset($_COOKIE['session_token'])) {
    $token_parts = explode('.', $_COOKIE['session_token']);
    if(count($token_parts) === 3) {
        list($header_b64, $payload_b64, $signature_b64) = $token_parts;
        $header = json_decode(base64url_decode($header_b64));
        if (isset($header->alg) && strtolower($header->alg) === 'none') {
            $payload = json_decode(base64url_decode($payload_b64));
            if ($payload && isset($payload->role) && $payload->role === 'admin') {
                $flag = "¡Acceso concedido! flag{JWT_should_not_be_n0ne}";
                $access_granted = true;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Panel de Admin</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
        body { background: #1f2029; color: #c4c3ca; font-family: 'Poppins', sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .container { background: #2a2b38; border-radius: 6px; box-shadow: 0 20px 50px rgba(0,0,0,0.3); width: 600px; padding: 50px; text-align: center; }
        h1 { font-weight: 600; color: #fff; margin-bottom: 30px; }
        p { font-size: 1.2em; padding: 20px; border-radius: 4px; }
        .access-denied { background-color: rgba(247, 120, 186, 0.2); color: #f778ba; border: 1px solid #f778ba; }
        .access-granted { background-color: rgba(46, 160, 67, 0.2); color: #2ea043; border: 1px solid #2ea043; }
        a { color: #ffeba7; text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Panel de Administración Secreto</h1>
        <p class="<?= $access_granted ? 'access-granted' : 'access-denied' ?>">
            <?= $flag ?>
        </p>
        <br><br>
        <a href="index.php">Volver al Login</a>
    </div>
</body>
</html>

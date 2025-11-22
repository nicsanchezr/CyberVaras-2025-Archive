<?php
$message = 'Acceso Denegado. La contraseña es incorrecta.';
$secret_hash = '0e830400451993494058024219903391'; // MD5 de 's541589535a'
$message_class = 'error';

if (isset($_POST['password'])) {
    $pass = $_POST['password'];
    $pass_hash = md5($pass);

    if ($pass_hash == $secret_hash) {
        $message = "Acceso Concedido! El hash $pass_hash es igual a $secret_hash.<br>La flag es: flag{php_l00s3_c0mp4r1s0n_is_w31rd}";
        $message_class = 'success';
    } else {
        $message = "Acceso Denegado. Tu hash ($pass_hash) no es igual a $secret_hash.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Desafío: Comparación Mágica</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=VT323&display=swap');
        body { background-color: #000; color: #0f0; font-family: 'VT323', monospace; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .container { background-color: #0a0a0a; border: 2px solid #0f0; border-radius: 8px; box-shadow: 0 0 20px #0f0; width: 600px; padding: 30px; animation: text-flicker 3s linear infinite; }
        h1 { color: #0f0; text-align: center; font-size: 2.5em; text-shadow: 0 0 5px #0f0; }
        .hash-info { background-color: #111; border: 1px dashed #0f0; padding: 15px; font-size: 1.2em; word-wrap: break-word; text-align: center; margin-bottom: 20px; }
        form { display: flex; flex-direction: column; }
        input[type="text"] { background-color: #111; border: 1px solid #0f0; color: #0f0; padding: 10px; font-family: 'VT323', monospace; font-size: 1.2em; margin-bottom: 15px; }
        input[type="submit"] { background-color: #0f0; color: #000; border: none; padding: 10px; font-family: 'VT323', monospace; font-size: 1.4em; cursor: pointer; }
        .message { margin-top: 20px; font-size: 1.1em; line-height: 1.6; word-wrap: break-word; }
        .error { color: #f00; }
        .success { color: #0f0; }
        @keyframes text-flicker { 0% { opacity: 0.9; } 2% { opacity: 0.7; } 4% { opacity: 0.9; } 6% { opacity: 0.8; } 8% { opacity: 0.9; } 100% { opacity: 0.9; } }
    </style>
</head>
<body>
    <div class="container">
        <h1>PHP Magic Auth</h1>
        <div class="hash-info">Hash Secreto: <?= $secret_hash ?></div>
        <form action="" method="POST">
            <input type="text" name="password" placeholder="Contraseña...">
            <input type="submit" value="Login">
        </form>
        <p class="<?= $message_class ?>"><?= $message ?></p>
    </div>
</body>
</html>

<?php
// --- Definición de Clases ---
class UserProfile {
    public $username = 'guest';
    public $logFile = 'guest.log';

    public function __construct() {
        $this->username = 'guest';
        $this->logFile = 'guest.log';
    }

    // Este es el "gadget"
    public function __destruct() {
        if (file_exists($this->logFile)) {
            echo "";
        }
    }
}

// --- Lógica Principal ---
$user = new UserProfile();
if (isset($_COOKIE['profile'])) {
    try {
        $user = unserialize(base64_decode($_COOKIE['profile']));
    } catch (Exception $e) { $user = new UserProfile(); }
}
$cookie_data = base64_encode(serialize($user));
setcookie('profile', $cookie_data, time() + 3600, '/desafio_deserialize/');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Desafío: Deserialización</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap');
        body { background-color: #f9f9f9; color: #333; font-family: 'Lato', sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .container { text-align: center; }
        h1 { font-size: 3em; color: #2c3e50; }
        p { font-size: 1.2em; color: #7f8c8d; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenido, <?= htmlspecialchars($user->username) ?></h1>
        <p>Tu perfil está siendo cargado desde la sesión.</p>
    </div>
    </body>
</html>

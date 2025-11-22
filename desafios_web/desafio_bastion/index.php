<?php
session_start();
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $db = new PDO('sqlite:bastion.db');
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // VULNERABILIDAD: Blind SQL Injection. La consulta se concatena.
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $stmt = $db->query($sql);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user['username'];
        // Setea la cookie de "no-admin" para la Etapa 2
        setcookie('is_admin', 'false', time() + 3600, '/desafio_bastion/');
        header('Location: dashboard.php');
        exit;
    } else {
        $message = "<div class='message error'>Login fallido. Usuario o contraseña incorrectos.</div>";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>El Bastión - Login</title><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="container">
        <h1>El Bastión [Acceso Central]</h1>
        <form action="" method="POST">
            <div class="form-group">
                <input type="text" name="username" placeholder="ID de Usuario">
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Contraseña">
            </div>
            <input type="submit" value="Autenticar">
        </form>
        <?= $message ?>
    </div>
</body>
</html>

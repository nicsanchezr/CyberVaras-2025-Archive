<?php
session_start();
$db = new PDO('sqlite:ctf_shop.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// --- LÓGICA DE SESIÓN MULTIJUGADOR ---
if (!isset($_SESSION['username'])) {
    $new_username = 'player_' . uniqid();
    $starting_points = 100;
    $stmt = $db->prepare("INSERT INTO users (username, points) VALUES (?, ?)");
    $stmt->execute([$new_username, $starting_points]);
    $_SESSION['username'] = $new_username;
}

$current_username = $_SESSION['username'];
$stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$current_username]);
$user = $stmt->fetch();

// --- LÓGICA DE COMPRA ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_price'])) {
    $price = (int)$_POST['item_price'];
    if ($user['points'] >= $price) {
        $new_points = $user['points'] - $price;
        $update_stmt = $db->prepare("UPDATE users SET points = ? WHERE username = ?");
        $update_stmt->execute([$new_points, $current_username]);
        if ($_POST['item_name'] === 'La Bandera' && $price > 0) {
            $_SESSION['message'] = "¡Felicidades! Aquí tienes tu premio: flag{Pr1c3_T4mp3r1ng_FTW}";
            $_SESSION['message_type'] = 'success';
        } else if ($_POST['item_name'] === 'La Bandera' && $price <= 0) {
            $_SESSION['message'] = "¡Buen intento! Pero no puedes obtener la bandera gratis.";
            $_SESSION['message_type'] = 'error';
        } else {
           $_SESSION['message'] = "Compra exitosa. Puntos restantes: " . $new_points;
           $_SESSION['message_type'] = 'info';
        }
    } else {
        $_SESSION['message'] = "Puntos insuficientes.";
        $_SESSION['message_type'] = 'error';
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
// Volver a obtener los datos del usuario para mostrar los puntos actualizados
$stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$current_username]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Desafío: Tienda de Puntos</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
        body { background-color: #1e1e2f; color: #dcdcdc; font-family: 'Poppins', sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .container { background-color: #2a2a3e; border-radius: 15px; box-shadow: 0 10px 40px rgba(0,0,0,0.4); width: 800px; padding: 40px; }
        .header { text-align: center; border-bottom: 1px solid #4a4a6a; padding-bottom: 20px; margin-bottom: 20px; }
        .header h1 { color: #8a78ff; margin: 0; }
        .user-info { display: flex; justify-content: space-between; align-items: center; background-color: #3a3a5a; padding: 15px 25px; border-radius: 10px; margin-bottom: 30px; }
        .user-info .username { font-size: 1.1em; color: #a0a0c0; }
        .user-info .points { font-size: 1.5em; font-weight: 700; color: #ffab00; }
        .shop-items { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .item { background-color: #3a3a5a; border-radius: 10px; padding: 20px; text-align: center; border: 1px solid #4a4a6a; transition: transform 0.2s, box-shadow 0.2s; }
        .item:hover { transform: translateY(-5px); box-shadow: 0 5px 15px rgba(138, 120, 255, 0.2); }
        .item h2 { margin: 0 0 10px 0; color: #dcdcdc; }
        .item .price { font-size: 1.2em; font-weight: 600; color: #ffab00; margin-bottom: 20px; }
        .item button { width: 100%; padding: 12px; border: none; background-color: #8a78ff; color: #fff; font-size: 1em; font-weight: 600; border-radius: 8px; cursor: pointer; transition: background-color 0.3s; }
        .item button:hover { background-color: #705de8; }
        .message { padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center; font-weight: 600; }
        .message.success { background-color: rgba(46, 160, 67, 0.2); color: #2ea043; }
        .message.error { background-color: rgba(247, 120, 186, 0.2); color: #f778ba; }
        .message.info { background-color: rgba(88, 166, 255, 0.2); color: #58a6ff; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Tienda del Gremio</h1>
            <p>¡Gasta tus puntos de recompensa!</p>
        </div>
        
        <?php if(isset($_SESSION['message'])) { echo "<div class='message ".$_SESSION['message_type']."'>".$_SESSION['message']."</div>"; unset($_SESSION['message']); unset($_SESSION['message_type']); } ?>

        <div class="user-info">
            <span class="username">Jugador: <?= htmlspecialchars($user['username']) ?></span>
            <span class="points"><?= $user['points'] ?> Puntos</span>
        </div>

        <div class="shop-items">
            <div class="item">
                <h2>Poción Barata</h2>
                <p class="price">20 Puntos</p>
                <form action="" method="POST">
                    <input type="hidden" name="item_name" value="Poción Barata">
                    <input type="hidden" name="item_price" value="20">
                    <button type="submit">Comprar</button>
                </form>
            </div>
            <div class="item">
                <h2>La Bandera</h2>
                <p class="price">1000 Puntos</p>
                <form action="" method="POST">
                    <input type="hidden" name="item_name" value="La Bandera">
                    <input type="hidden" name="item_price" value="1000">
                    <button type="submit">Comprar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

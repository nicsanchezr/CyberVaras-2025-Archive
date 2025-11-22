<?php
$db = new PDO('sqlite:ctf_profiles.db');
// Simulación de sesión: el ID por defecto es 2, pero se puede cambiar por la URL
$user_id = $_GET['user_id'] ?? 2;

$stmt = $db->prepare("SELECT name, description FROM profiles WHERE id = ?");
$stmt->execute([$user_id]);
$profile = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Desafío: Ver Perfil</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');
        body { background-color: #eef2f5; color: #333; font-family: 'Montserrat', sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .profile-card { background-color: #ffffff; border-radius: 20px; box-shadow: 0 15px 40px rgba(0, 80, 150, 0.15); width: 500px; text-align: center; overflow: hidden; }
        .profile-header { background: linear-gradient(135deg, #007bff, #0056b3); color: white; padding: 40px 20px; }
        .profile-header .avatar { width: 120px; height: 120px; border-radius: 50%; border: 4px solid #fff; margin-bottom: 10px; }
        .profile-header h1 { margin: 0; font-size: 24px; }
        .profile-content { padding: 30px; }
        .profile-content h2 { color: #0056b3; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px; margin-bottom: 20px; font-size: 18px; }
        .profile-content p { color: #555; font-size: 16px; line-height: 1.6; }
        .not-found { color: #d9534f; font-weight: bold; }
        .challenge-brief { background-color: #f8f9fa; border-top: 1px solid #e0e0e0; padding: 20px; font-size: 14px; color: #6c757d; }
    </style>
</head>
<body>
    <div class="profile-card">
        <div class="profile-header">
            <img src="https://i.imgur.com/V4RclNb.png" alt="Avatar" class="avatar">
            <h1><?= $profile ? htmlspecialchars($profile['name']) : 'Desconocido' ?></h1>
        </div>
        <div class="profile-content">
            <h2>Descripción del Perfil</h2>
            <?php if ($profile): ?>
                <p><?= htmlspecialchars($profile['description']) ?></p>
            <?php else: ?>
                <p class="not-found">Usuario no encontrado.</p>
            <?php endif; ?>
        </div>
        <div class="challenge-brief">
            <strong>Tu misión:</strong> Se rumorea que el perfil del administrador contiene información sensible. ¿Puedes acceder a ella?
        </div>
    </div>
</body>
</html>

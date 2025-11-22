<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Desafío: Galería de Avatares</title>
    <style>/* Estilos similares a los anteriores para consistencia */</style>
</head>
<body>
    <div class="container">
        <h1>Desafío: La Galería de Avatares</h1>
        <p>¡Bienvenido al nuevo portal de la comunidad! Para personalizar tu perfil, puedes subir una imagen de avatar. Por seguridad, nuestro sistema de última generación solo permite archivos de tipo <strong>imagen/jpeg</strong> o <strong>imagen/png</strong>.</p>
        <p><strong>Tu misión:</strong> ¿Puedes encontrar una forma de tomar control del sistema a través de este portal de carga?</p>

        <form action="desafio_upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="avatar" required>
            <input type="submit" value="Subir Avatar">
        </form>

        <div id="results">
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['avatar'])) {
                $allowed_types = ['image/jpeg', 'image/png'];
                $file_type = $_FILES['avatar']['type'];
                $file_name = basename($_FILES['avatar']['name']);
                $upload_dir = 'uploads/';
                $upload_file = $upload_dir . $file_name;

                // Vulnerabilidad: El script confía en el Content-Type enviado por el cliente.
                if (in_array($file_type, $allowed_types)) {
                    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $upload_file)) {
                        echo "<p style='color: #2ea043;'>¡Éxito! Tu avatar <a href='$upload_file' target='_blank'>$file_name</a> ha sido subido.</p>";
                    } else {
                        echo "<p style='color: #f778ba;'>Error al mover el archivo.</p>";
                    }
                } else {
                    echo "<p style='color: #f778ba;'>Error: Tipo de archivo no permitido. Solo se aceptan JPEG o PNG. (Detectado: " . htmlspecialchars($file_type) . ")</p>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>

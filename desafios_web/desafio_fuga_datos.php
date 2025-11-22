<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafío: Fuga de Credenciales</title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; background-color: #0d1117; color: #c9d1d9; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; padding: 20px; }
        .container { max-width: 700px; width: 100%; background-color: #161b22; border: 1px solid #30363d; border-radius: 8px; padding: 2rem; box-shadow: 0 4px 12px rgba(0,0,0,0.3); }
        h1 { color: #f778ba; border-bottom: 1px solid #30363d; padding-bottom: 10px; }
        p { line-height: 1.6; }
        form { margin: 20px 0; }
        input[type="text"] { width: 70%; padding: 10px; background-color: #0d1117; border: 1px solid #30363d; color: #c9d1d9; border-radius: 5px; }
        input[type="submit"] { padding: 10px 15px; background-color: #9e6a03; color: white; border: none; border-radius: 5px; cursor: pointer; margin-left: 10px; }
        input[type="submit"]:hover { background-color: #c99313; }
        #results { margin-top: 20px; background-color: #010409; padding: 15px; border-radius: 5px; border: 1px solid #30363d; min-height: 50px; }
        .user-entry { border-bottom: 1px dashed #30363d; padding: 8px 0; font-family: monospace; }
        .user-entry:last-child { border-bottom: none; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Desafío: Fuga de Credenciales</h1>
        <p>Este antiguo portal de búsqueda parece tener más secretos de los que muestra. La información superficial es accesible, pero nuestra inteligencia sugiere que la base de datos contiene datos mucho más sensibles.</p>
        <p><strong>Tu misión:</strong> Encuentra la forma de explotar el buscador para exfiltrar las credenciales completas de los usuarios. La funcionalidad básica es solo una fachada.</p>

        <form action="desafio_fuga_datos.php" method="get">
            <input type="text" name="q" placeholder="Inyecta tu consulta aquí..." value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
            <input type="submit" value="Ejecutar">
        </form>

        <div id="results">
            <strong>Salida de la Consulta:</strong><br><br>
            <?php
            if (isset($_GET['q'])) {
                try {
                    $db = new PDO('sqlite:ctf_challenges.db');
                    $q = $_GET['q'];
                    $sql = "SELECT username, fullname FROM users WHERE username LIKE '%$q%' OR fullname LIKE '%$q%';";

                    $results_found = false;
                    foreach ($db->query($sql) as $row) {
                        $results_found = true;
                        echo "<div class='user-entry'><strong>Columna 1:</strong> ".htmlspecialchars($row['username'])."<br><strong>Columna 2:</strong> ".htmlspecialchars($row['fullname'])."</div>";
                    }

                    if (!$results_found) {
                        echo "<div>La consulta no devolvió resultados.</div>";
                    }
                } catch (PDOException $e) {
                    echo "<div>Error de sintaxis SQL o conexión.</div>";
                }
            } else {
                echo "<div>Esperando una consulta...</div>";
            }
            ?>
        </div>
    </div>
</body>
</html>

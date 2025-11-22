<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafío: El Buscador Olvidado</title>
    <style>
        body { 
            font-family: 'Courier New', Courier, monospace; 
            background-color: #0d1117; 
            color: #c9d1d9; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .container { 
            max-width: 700px; 
            width: 100%;
            background-color: #161b22; 
            border: 1px solid #30363d; 
            border-radius: 8px; 
            padding: 2rem; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }
        h1 { color: #58a6ff; border-bottom: 1px solid #30363d; padding-bottom: 10px; }
        p { line-height: 1.6; }
        form { margin: 20px 0; }
        input[type="text"] { 
            width: 70%; 
            padding: 10px; 
            background-color: #0d1117; 
            border: 1px solid #30363d; 
            color: #c9d1d9; 
            border-radius: 5px;
        }
        input[type="submit"] {
            padding: 10px 15px;
            background-color: #238636;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
        }
        input[type="submit"]:hover { background-color: #2ea043; }
        #results { 
            margin-top: 20px; 
            background-color: #010409; 
            padding: 15px; 
            border-radius: 5px; 
            border: 1px solid #30363d;
            min-height: 50px;
        }
        .user-entry { border-bottom: 1px dashed #30363d; padding: 8px 0; }
        .user-entry:last-child { border-bottom: none; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Desafío: Inyección SQL</h1>
        <p>Nuestro equipo encontró un antiguo portal de búsqueda de empleados que fue dado de baja. Creemos que la base de datos detrás de este portal todavía contiene información de usuarios. El sistema de búsqueda parece estar dañado y no funciona como se espera.</p>
        <p><strong>Tu misión:</strong> ¿Puedes manipular el buscador para que revele la información de todos los usuarios registrados?</p>

        <form action="desafio_sql.php" method="get">
            <input type="text" name="q" placeholder="Buscar por nombre..." value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
            <input type="submit" value="Buscar">
        </form>

        <div id="results">
            <strong>Resultados:</strong><br><br>
            <?php
            // Solo ejecutar la búsqueda si el parámetro 'q' fue enviado
            if (isset($_GET['q'])) {
                try {
                    // Conexión a la base de datos
                    $db = new PDO('sqlite:ctf_challenges.db');
                    
                    // Obtener el término de búsqueda de la URL
                    $q = $_GET['q'];
                    
                    // La consulta SQL vulnerable.
                    // Se eliminó LIMIT 10 para que el exploit muestre todos los resultados.
                    $sql = "SELECT username, fullname FROM users WHERE username LIKE '%$q%' OR fullname LIKE '%$q%';";

                    $results_found = false;
                    foreach ($db->query($sql) as $row) {
                        $results_found = true;
                        echo "<div class='user-entry'><strong>Usuario:</strong> ".htmlspecialchars($row['username'])."<br><strong>Nombre:</strong> ".htmlspecialchars($row['fullname'])."</div>";
                    }

                    if (!$results_found) {
                        echo "<div>No se encontraron resultados.</div>";
                    }

                } catch (PDOException $e) {
                    // Mensaje de error si la base de datos no se puede abrir
                    echo "<div>Error: No se pudo conectar a la base de datos.</div>";
                }
            } else {
                echo "<div>Esperando una consulta...</div>";
            }
            ?>
        </div>
    </div>
</body>
</html>

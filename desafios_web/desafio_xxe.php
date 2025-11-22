<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Desafío: Lector de Noticias XML</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;600&display=swap');
        body { background-color: #1e1e1e; color: #d4d4d4; font-family: 'Fira Code', monospace; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .container { background-color: #252526; border: 1px solid #3c3c3c; border-radius: 8px; max-width: 900px; width: 100%; padding: 30px; }
        .header { text-align: center; margin-bottom: 25px; }
        .header h1 { color: #4ec9b0; margin: 0; }
        .header p { color: #9cdcfe; }
        .columns { display: flex; gap: 20px; }
        .column { flex: 1; }
        textarea { width: 100%; height: 250px; background-color: #1e1e1e; border: 1px solid #3c3c3c; color: #d4d4d4; font-family: 'Fira Code', monospace; font-size: 14px; padding: 10px; border-radius: 4px; box-sizing: border-box; resize: vertical; }
        input[type="submit"] { width: 100%; padding: 12px; margin-top: 10px; border: none; background-color: #4ec9b0; color: #1e1e1e; font-size: 16px; font-weight: 600; border-radius: 4px; cursor: pointer; transition: background-color 0.3s; }
        input[type="submit"]:hover { background-color: #3db8a0; }
        #results { background-color: #1e1e1e; border: 1px solid #3c3c3c; padding: 20px; border-radius: 4px; min-height: 250px; }
        #results h2 { color: #569cd6; border-bottom: 1px solid #3c3c3c; padding-bottom: 10px; margin-top: 0; }
        #results p { white-space: pre-wrap; word-wrap: break-word; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>XML Content Renderer</h1>
            <p>Pega un payload XML para procesar y mostrar.</p>
        </div>
        <div class="columns">
            <div class="column">
                <form action="" method="POST">
                    <textarea name="xml_data" placeholder='<?xml version="1.0"?>
<noticia>
    <titulo>Hola</titulo>
    <contenido>Mundo</contenido>
</noticia>'><?= isset($_POST['xml_data']) ? htmlspecialchars($_POST['xml_data']) : '' ?></textarea>
                    <input type="submit" value="Procesar XML">
                </form>
            </div>
            <div class="column">
                <div id="results">
                    <?php
                    if (isset($_POST['xml_data']) && !empty($_POST['xml_data'])) {
                        libxml_use_internal_errors(true);
                        $doc = new DOMDocument();
                        $doc->loadXML($_POST['xml_data'], LIBXML_NOENT);
                        $tituloNode = $doc->getElementsByTagName('titulo')->item(0);
                        $contenidoNode = $doc->getElementsByTagName('contenido')->item(0);
                        if ($tituloNode && $contenidoNode) {
                            $titulo = $tituloNode->nodeValue;
                            $contenido = $contenidoNode->nodeValue;
                            echo "<h2>" . htmlspecialchars($titulo) . "</h2><p>" . htmlspecialchars($contenido) . "</p>";
                        } else {
                            echo "<p style='color:#ce9178;'>Error: XML malformado o etiquetas no encontradas.</p>";
                        }
                    } else {
                        echo "<p style='color:#6a9955;'>// Esperando output...</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

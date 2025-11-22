<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Desafío: La Imagen Misteriosa</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap');
        
        body {
            background-color: #121212;
            color: #e0e0e0;
            font-family: 'Montserrat', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        .gallery-container {
            background-color: #1e1e1e;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
            max-width: 900px;
            width: 100%;
            padding: 40px;
            text-align: center;
            border: 1px solid #2a2a2a;
        }

        .gallery-header h1 {
            color: #ffffff;
            font-weight: 700;
            font-size: 2.5em;
            margin: 0 0 10px 0;
        }

        .gallery-header .quote {
            color: #a0a0a0;
            font-style: italic;
            font-size: 1.1em;
            margin-bottom: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .image-frame {
            padding: 15px;
            background: #121212;
            border-radius: 10px;
            display: inline-block;
            box-shadow: inset 0 0 10px rgba(0,0,0,0.5);
        }
        
        .image-frame img {
            max-width: 100%;
            height: auto;
            display: block;
            border-radius: 5px;
        }

    </style>
</head>
<body>
    <div class="gallery-container">
        <div class="gallery-header">
            <h1>Galería Anónima</h1>
            <p class="quote">"A veces, la información más importante es la que no se ve a simple vista."</p>
        </div>
        <div class="image-frame">
            <img src="artefacto.jpeg" alt="Paisaje urbano misterioso">
        </div>
    </div>
</body>
</html>

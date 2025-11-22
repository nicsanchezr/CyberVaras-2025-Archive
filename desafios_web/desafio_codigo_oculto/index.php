<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Desafío: Código Fuente</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
        body {
            background: #1f2029;
            color: #c4c3ca;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background: #2a2b38;
            background-image: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/1462889/pat.svg');
            background-position: bottom center;
            background-repeat: no-repeat;
            background-size: 300%;
            border-radius: 6px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
            width: 400px;
            padding: 50px;
        }
        h1 {
            font-weight: 600;
            text-align: center;
            color: #fff;
            margin-bottom: 30px;
        }
        .form-group { margin-bottom: 20px; }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            background: #1f2029;
            border: 2px solid #2e2f3c;
            border-radius: 4px;
            color: #c4c3ca;
            font-size: 16px;
            transition: border-color 0.3s;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            border: none;
            background-color: #ffeba7;
            color: #102770;
            font-size: 16px;
            font-weight: 600;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Acceso Corporativo</h1>
        <form>
            <div class="form-group">
                <input type="text" placeholder="ID de Empleado">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Contraseña">
            </div>
            <input type="submit" value="Iniciar Sesión" disabled>
        </form>
    </div>

    <!-- devnote: revisar configuración localStorage -->
    <script>
        // Configuración interna de entorno (no tocar)
        const sysCfg = {
            env: "local",
            session_debug: true,
            meta: {
                who: "dev",
                ts: "2025-11-06T04:00:00Z",
                key: "flag{c0mm3nts_4r3_c0d3_t00}"
            }
        };
        // console.log("Debug:", sysCfg.meta);
    </script>
</body>
</html>

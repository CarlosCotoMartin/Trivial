<?php
    require_once 'conectarbbdd.php';

    session_start();

    if (isset($_SESSION['id'])) {
        $jugador = $db->query("select nick, email from usuarios where id = " . $_SESSION['id'] . ";");
        $jug = $jugador->fetch_assoc();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PREGUNTA2</title>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/usuario.css">
        <script src="js/script.js"></script>
    </head>
    <body>
    <header>
        <div class="titulo">
            <a href="index.php"><img src="images/titulo.png" alt="Titulo Pregunta2" height="100%"></a>
        </div>
            <ul>
                <li>
                    <a href="juego.php"><img src="images/juego.png" id="menuimagen" alt="Jugar"> Jugar</a>
                </li><li>
                    <a href="leaderboard.php"><img src="images/leaderboard.png" id="menuimagen" alt="Leaderboard"> Leaderboard</a>
                </li><li>
                    <a href="usuario.php"><img src="images/user.png" id="menuimagen" alt="Imagen Perfil"> Usuario</a>
                </li>
            </ul>
        </header>

        <div class="main">
            <div class="portada">
                <div class="bg"></div>
                <div class="portada-titulo"><img src="images/usuario.png" alt="Titulo Leaderboard"></div>
                <div class="nick"><?php echo $jug['nick'];?></div>
                <div class="mail"><?php echo $jug['email'];?></div>
                <div class="cerrar"><a href="logout.php">Cerrar Sesión</a></div>               
            </div>
        </div>

        <footer>
            &copy; Todos los derechos reservados.
        </footer>
    </body>
</html>
<?php
    require_once 'conectarbbdd.php';

    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PREGUNTA2</title>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/juego.css">
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
                    <?php
                    if (isset($_SESSION['logeado'])) { 
                        if ($_SESSION['logeado'] == true) {
                            echo '<a href="usuario.php"><img src="images/user.png" id="menuimagen" alt="Imagen Perfil"> Usuario</a>';
                        } else {
                            echo '<a href="#"><img src="images/acceder.png" id="menuimagen" alt="Acceder"> Acceder</a>
                            <ul>
                                <li><a href="inicio_sesion.php"><img src="images/sesion.png" id="menuimagen" alt="Inicio de sesion"> Iniciar sesión</a></li>
                                <li><a href="registro.php"><img src="images/registrarse.png" id="menuimagen" alt="Registrarse"> Registrarse</a></li>
                            </ul>';
                        }
                    } else {
                        echo '<a href="#"><img src="images/acceder.png" id="menuimagen" alt="Acceder"> Acceder</a>
                        <ul>
                            <li><a href="inicio_sesion.php"><img src="images/sesion.png" id="menuimagen" alt="Inicio de sesion"> Iniciar sesión</a></li>
                            <li><a href="registro.php"><img src="images/registrarse.png" id="menuimagen" alt="Registrarse"> Registrarse</a></li>
                        </ul>';
                    }
                    ?>
                </li>
            </ul>
        </header>

        <div class="main">
            <div class="portada">
                <div class="bg"></div>
                <div class="portada-titulo"><img src="images/JUGAR.png" alt="Titulo Jugar"></div>
                <div class="categoria" id="categoria"></div>
                <div id="pregunta"></div>
                <div class="puntaje" id="puntaje"></div>
                <div class="contenedor">
                    <div class="btn" id="resp1" onclick="oprimir_btn(0)"></div>
                    <div class="btn" id="resp2" onclick="oprimir_btn(1)"></div>
                    <div class="btn" id="resp3" onclick="oprimir_btn(2)"></div>
                    <div class="btn" id="resp4" onclick="oprimir_btn(3)"></div>
                </div>
            </div>
        </div>

        <footer>
            &copy; Todos los derechos reservados.
        </footer>
    </body>
</html>
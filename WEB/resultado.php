<?php
    require_once 'conectarbbdd.php';

    session_start();
  
    if (isset($_GET["rc"])) {
        $punt_jug = $_GET["rc"];
    } else {
        $punt_jug = -1;
    }

    $verusuario = $db->query("select nick from usuarios where id = " . $_SESSION['id'] . ";");
    $vu = $verusuario->fetch_assoc();

    $sql = "INSERT INTO partidas (player) VALUES (" . $vu['nick'] . ");";
    if ($db->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
    
    $verpartida = $db->query("select max(id) as part from partidas;");
    $vp = $verpartida->fetch_assoc();

    $sql1 = "INSERT INTO leaderboard (puntuacion,fk_partida,fk_jugador) VALUES (" . $punt_jug . "," . $vp['part'] . "," .  $_SESSION['id'] . ");";
    if ($db->query($sql1) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql1 . "<br>" . $db->error;
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PREGUNTA2</title>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/resultado.css">
        <script src="js/script.js"></script>
    </head>
    <body>
        <header>

        <div class="titulo">
            <a href="index.php"><img src="images/titulo.png" alt="Titulo Pregunta2" height="100%"></a>
        </div>
            <ul>
                <li>
                <?php 
                if (isset($_SESSION['logeado'])) {
                    if ($_SESSION['logeado'] == true) {
                        echo '<a href="juego.php">';
                    } else {
                        echo '<a onclick="logerr();">';
                    }
                } else {
                    echo '<a onclick="logerr();">';
                }
                ?>
                    <img src="images/juego.png" id="menuimagen" alt="Jugar"> Jugar</a>
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
                <div class="portada-titulo"><img src="images/result.png" alt="Titulo Pregunta2"></div>
                <div class="contenedor">
                    <img src="images/corona.png" class="corona" alt="Corona Olimpica">
                    <div class="punt">
                        <?php echo $punt_jug; ?>/10
                    </div>
                </div>
            </div>
        </div>

        <footer>
            &copy; Todos los derechos reservados.
        </footer>
    </body>
</html>
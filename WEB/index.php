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
        <link rel="stylesheet" href="css/portada.css">
        <script src="js/script.js"></script>
    </head>
    <body>
        <header>

            <div class="titulo">
                <a href="index.php"><img src="images/titulo.png" alt="Titulo Pregunta2" height="100%"></a>
            </div>

            <div class="nav-btn">
			    <label for="nav-check">
				    <span></span>
				    <span></span>
				    <span></span>
			    </label>
    		</div>
            <input type="checkbox" id="nav-check">

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
                <div class="portada-titulo"><img src="images/portadatitulo.png" id="titulo" alt="Titulo Pregunta2"></div>
                <div class="links">
                    <div class="link-jug">
                        <?php
                        if (isset($_SESSION['logeado'])) {
                            if ($_SESSION['logeado'] == true) {
                                echo '<div class="btn"><a href="juego.php"><img src="images/juego.png" class="images" alt="Jugar"></a></div>';
                            } else {
                                echo '<div class="btn" onclick="logerr();"><img src="images/juego.png" class="images" alt="Jugar"></a></div>';
                            }
                        } else {
                            echo '<div class="btn" onclick="logerr();"><img src="images/juego.png" class="images" alt="Jugar"></a></div>';
                        }
                        ?>
                        <div class="text">Jugar</div>
                    </div>
                    <div class="link-lead">
                        <div class="btn"><a href="leaderboard.php"><img src="images/leaderboard.png" class="images" alt="Leaderboard"></a></div>
                        <div class="text">Leaderboard</div>
                    </div>
                        <?php
                        if (isset($_SESSION['logeado'])) {
                            if ($_SESSION['logeado'] == true) {
                                echo '<div class="link-usu">';
                                    echo '<div class="btn"><a href="usuario.php"><img src="images/user.png" class="images" alt="Imagen Perfil"></a></div>';
                                    echo '<div class="text">Perfil Usuario</div>';
                                echo '</div>';
                            } else {
                                echo '<div class="link-ini">';
                                    echo '<div class="btn"><a href="inicio_sesion.php"><img src="images/sesion.png" class="images" alt="Inicio de sesion"></a></div>';
                                    echo '<div class="text">Iniciar Sesion</div>';
                                echo '</div>';
                                echo '<div class="link-reg">';
                                    echo '<div class="btn"><a href="registro.php"><img src="images/registrarse.png" class="images" alt="Registrarse"></a></div>';
                                    echo '<div class="text">Registrarse</div>';
                                echo '</div>';
                            }
                        } else {
                            echo '<div class="link-ini">';
                                echo '<div class="btn"><a href="inicio_sesion.php"><img src="images/sesion.png" class="images" alt="Inicio de sesion"></a></div>';
                                echo '<div class="text">Iniciar Sesion</div>';
                            echo '</div>';
                            echo '<div class="link-reg">';
                                echo '<div class="btn"><a href="registro.php"><img src="images/registrarse.png" class="images" alt="Registrarse"></a></div>';
                                echo '<div class="text">Registrarse</div>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            &copy; Todos los derechos reservados.
        </footer>
    </body>
</html>
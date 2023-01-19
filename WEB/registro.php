<?php
    require_once 'conectarbbdd.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['mail'])){
            $sentencia = $db->prepare('INSERT INTO usuarios (nick, pass, email) VALUES (?, ?, ?)');
            $sentencia->bind_param('sss', $_POST['user'], $_POST['pass'], $_POST['mail']);
            $sentencia->execute();

            $result = $sentencia->get_result();
            $user_id = $sentencia->insert_id;
            if($user_id > 0){
                session_start();
                $_SESSION['logeado'] = true;
                $_SESSION['id'] =  $user_id;
                header('Location: usuario.php');
            }
        }
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
        <link rel="stylesheet" href="css/registro.css">
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
                    <a href="#"><img src="images/acceder.png" id="menuimagen" alt="Acceder"> Acceder</a>
                    <ul>
                        <li><a href="inicio_sesion.php"><img src="images/sesion.png" id="menuimagen" alt="Inicio de sesion"> Iniciar sesión</a></li>
                        <li><a href="registro.php"><img src="images/registrarse.png" id="menuimagen" alt="Registrarse"> Registrarse</a></li>
                    </ul>
                </li>
            </ul>
        </header>

        <div class="main">
            <div class="portada">
                <div class="bg"></div>
                <div class="portada-titulo"><img src="images/REGISTRO.png" alt="Titulo Registro"></div>
                <div class="recuadro">
                    <form class="form-registro" action="registro.php" method="POST">
                        <input type="text" class="input-registro" name="user" placeholder="Usuario" required>
                        <input type="text" class="input-registro" name="mail" placeholder="Email" required>
                        <input type="password" class="input-registro" name="pass" id="password" placeholder="Contraseña" required>
                        <input type="password" class="input-registro" id="confirm_password" placeholder="Confirme Contraseña">
                        <div class="input-registro aceptar"><input type="checkbox" required>
                            <a href="javascript:ventanaSecundaria('terminoscondiciones.php')">
                                Acepto los Términos y Condiciones de Pregunta2
                            </a>
                        </div>
                        <input type="submit" class="input-registro" value="Entrar">
                    </form>
                </div>
            </div>
        </div>

        <footer>
            &copy; Todos los derechos reservados.
        </footer>
    </body>
</html>
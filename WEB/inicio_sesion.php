<?php
    require_once 'conectarbbdd.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['user']) && isset($_POST['pass'])){
            $sentencia = $db->prepare('SELECT id FROM usuarios WHERE nick = ? AND pass = ?');
            if(!$sentencia) {
                die('Error');
            }
            if(!$sentencia->bind_param('ss', $_POST['user'],  $_POST['pass'])) {
                die('Error');
            }
            $sentencia->execute();
            $result = $sentencia->get_result();
            if($result->num_rows === 1){
                $usuario = $result->fetch_assoc();
                session_start();
                $_SESSION['logeado'] = true;
                $_SESSION['id'] =  $usuario['id'];
                header('Location: usuario.php');
            }
        }
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
        <link rel="stylesheet" href="css/inicio_sesion.css">
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
                <div class="portada-titulo"><img src="images/INICIOSESION.png" alt="Titulo Inicio de Sesión"></div>
                <div class="decoracion1"><img src="images/inter.gif" id="int" alt="Persona andando con una interrogacion"></div>
                <form class="form-login"  method="POST">
                    <input type="text" name="user" placeholder="Usuario" required>
                    <input type="password" name="pass" placeholder="Contraseña" required>
                    <input type="submit" value="Entrar">
                </form>
                <div class="decoracion2"><img src="images/inter.gif" id="int" alt="Persona andando con una interrogacion"></div>
                <div class="recuadro"></div>
            </div>
        </div>

        <footer>
            &copy; Todos los derechos reservados.
        </footer>
    </body>
</html>
<?php
    require_once 'conectarbbdd.php';

    $leader = $db->query("select rank() over (order by leaderboard.puntuacion desc) as top, usuarios.nick as nombre, leaderboard.puntuacion as punt
                                from usuarios join leaderboard on usuarios.id = leaderboard.fk_jugador
                                join partidas on leaderboard.fk_partida = partidas.id limit 0,1;");
    $top = $leader->fetch_assoc();
    
    $segundo = $db->query("select rank() over (order by leaderboard.puntuacion desc) as top, usuarios.nick as nombre, leaderboard.puntuacion as punt
                                from usuarios join leaderboard on usuarios.id = leaderboard.fk_jugador
                                join partidas on leaderboard.fk_partida = partidas.id limit 1,1;");
    $seg = $segundo->fetch_assoc();

    $tercero = $db->query("select rank() over (order by leaderboard.puntuacion desc) as top, usuarios.nick as nombre, leaderboard.puntuacion as punt
                                from usuarios join leaderboard on usuarios.id = leaderboard.fk_jugador
                                join partidas on leaderboard.fk_partida = partidas.id limit 2,1;");
    $ter = $tercero->fetch_assoc();

    $cuarto = $db->query("select rank() over (order by leaderboard.puntuacion desc) as top, usuarios.nick as nombre, leaderboard.puntuacion as punt
                                from usuarios join leaderboard on usuarios.id = leaderboard.fk_jugador
                                join partidas on leaderboard.fk_partida = partidas.id limit 3,1;");
    $cua = $cuarto->fetch_assoc();

    $quinto = $db->query("select rank() over (order by leaderboard.puntuacion desc) as top, usuarios.nick as nombre, leaderboard.puntuacion as punt
                                from usuarios join leaderboard on usuarios.id = leaderboard.fk_jugador
                                join partidas on leaderboard.fk_partida = partidas.id limit 4,1;");
    $qui = $quinto->fetch_assoc();

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
        <link rel="stylesheet" href="css/leaderboard.css">
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
                <div class="portada-titulo"><img src="images/tablalideres.png" id="titulo" alt="Titulo Leaderboard"></div>
                <div class="container-posiciones">
                    <div>
                        <img src="images/oro.png" class="medalla" alt="Medalla de oro">
                        <div class="pos">1º</div>
                        <div class="us">
                            <a><?php echo $top['nombre']; ?></a>
                        </div>
                        <div class="punt"><?php echo $top['punt'];?></div>
                    </div>
                    <div>
                        <img src="images/plata.png" class="medalla" alt="Medalla de plata">
                        <div class="pos">2º</div>
                        <div class="us">
                            <a><?php echo $seg['nombre']; ?></a>
                        </div>
                        <div class="punt"><?php echo $seg['punt']; ?></div>
                    </div>
                    <div>
                        <img src="images/bronce.png" class="medalla" alt="Medalla de bronce">
                        <div class="pos">3º</div>
                        <div class="us">
                            <a><?php echo $ter['nombre']; ?></a>
                        </div>
                        <div class="punt"><?php echo $ter['punt']; ?></div>
                    </div>
                    <div>
                        <img src="images/diploma.png" class="medalla" alt="Diploma 4º">
                        <div class="pos">4º</div>
                        <div class="us">
                            <a><?php echo $cua['nombre']; ?></a>
                        </div>
                        <div class="punt"><?php echo $cua['punt']; ?></div>
                    </div>
                    <div>
                        <img src="images/diploma.png" class="medalla" alt="Diploma 5º">
                        <div class="pos">5º</div>
                        <div class="us">
                            <a><?php echo $qui['nombre']; ?></a>
                        </div>
                        <div class="punt"><?php echo $qui['punt']; ?></div>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            &copy; Todos los derechos reservados.
        </footer>
    </body>
</html>
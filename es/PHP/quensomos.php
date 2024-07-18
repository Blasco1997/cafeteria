<?php
    define('CSSPATH', '');
    $css = "../CSS/estilosxeraiscafeteria.css";
    session_start();
    if(!isset($_SESSION["cliente"])){
        $usuario = '<a id="usuario" href="login.php">Iniciar sesión</a>|<a href="rexistrarse.php">Registrarse</a>';
    } else {
        $usuario = '<img style="border-radius: 100%;" src="../Imaxes/Xerais/User.png" width="30" alt="User"/>'.$_SESSION["cliente"].'<span class="material-symbols-outlined" id="morevert">more_vert
        <ul>
            <li><a href="cerrarsesioncliente.php">Cerrar sesión</a></li><br/>
            <li><a href="eliminarcuentacliente.php"><span class="material-symbols-outlined" id="eliminarcuenta">close</span>Eliminar cuenta</a></li>
        </ul>
    </span>';;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PROXECTO FIN DE CICLO">
    <meta name="keywords" content="HTML, CSS, JavaScript, PHP, MYSQL">
    <title>BAR MANOLA - Quiénes somos</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="<?php echo (CSSPATH . "$css" );?>">
    <script src="../JavaScript/jQuery/jquery-3.6.3.js" type="text/javascript"></script>
</head>
<body>
    <header>
        <div id="logoytitulo">
            <?php 
                if(!isset($_SESSION["cliente"])){
                    echo "<a href='../../es/index.html'><img src='../Imaxes/Xerais/Logo_Cafetería.png' width='100%' alt='Bar Manola'/></a>";
                } else {
                    echo "<a href='indexcliente.php'><img src='../Imaxes/Xerais/Logo_Cafetería.png' width='100%' alt='Bar Manola'/></a>";
                }
            ?>
            <div id="desctitulo">
                <h1>BIENVENIDO A BAR MANOLA</h1><br/>
                <h4>A tu servicio desde 2017</h4>
            </div>
        </div>
        <div id="barrasuperior">
            <?php echo $usuario;?>
            <form action="busqueda.php" method="get">
                <input type="search" name="buscar" id="buscar" placeholder="&#128269; Buscar"/>
            </form>
        </div>
        <nav id="navegacion">
            <ul>
                <?php
                    if(!isset($_SESSION["cliente"])){
                        echo "";
                    } else {
                        echo "<li><a href='reservarprato.php'>Reservar</a></li>";
                    } 
                ?>
                <li><a href="produtos1.php">Productos</a></li>
                <li><a href="novasdonosolocal.php">Noticias de nuestro local</a></li>
            </ul>
        </nav>
    </header>
    <hr>
    <main>
        <section id="quensomos">
            <h1>QUEN SOMOS</h1>
            <?php
                $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                if(!$conexion) {
                    echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo conectar a nuestra base de datos. Inténtelo más tarde.</div>";
                } else {
                    $listarempregados = "SELECT * FROM empregados";
                    $resultados = $conexion->query($listarempregados);
                    if($resultados->num_rows==0) {
                        echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No hay empleados o aún no se han definido.</div>";
                    } else {
                        $row = $resultados->fetch_assoc();
                        while($row){
                            if($row["Nome_completo"]=="María Victoria Pazos Rodríguez"){
                                echo "<div class='empregado'>
                                <img class='perfil' src='../Imaxes/Xerais/Victoria.jpg' width='100%' alt='Perfil'/>
                                <div class='descempregado'><h3>{$row["Nome_completo"]}</h3><p>Jefa, dependienta del local e cocinera</p></div>
                                </div>";
                            } else if($row["Nome_completo"]=="Administrador") {
                                echo "";
                            } else {
                                echo "<div class='empregado'>
                                <img class='perfil' src='../Imaxes/Xerais/User.png' width='100%' alt='Perfil'/>
                                <div class='descempregado'><h1>{$row["Nome_completo"]}</h1><p>Empleado</p></div>
                                </div>";
                            }
                            $row = $resultados->fetch_assoc();  
                        }
                    }
                }
            ?>
        </section>
    </main>
    <footer>
        <div class="colaboradores">
            <h2>Nuestros colaboradores</h2>
            <a href="https://edu.xunta.gal/centros/iesmaximinoromerodelema"><img class="empresa" src="../Imaxes/Xerais/Logo-Final.png" width="100" alt="IES Maximino Romero de Lema"></a>
            <a href="https://www.facebook.com/PanaderiaSampedro/"><img class="empresa" src="../Imaxes/Xerais/Panadería Sampedro Empresa Colaboradora.jpeg" width="100" alt="Panadería Sampedro"></a>
        </div>
        <div class="contacto">
            <p>Calle Prado da Torre s/n 15150, Baio-Zas (A Coruña)<br/>
            ies.maximinoromerodelema@edu.xunta.gal<br/>
            (+34) 881 96 00 15</p>
            <a href="https://www.facebook.com/maximino.romerodelema"><img class="empresa" src="../Imaxes/Xerais/Facebook.png" width="25" alt="Facebook"></a>
            <a href="https://www.instagram.com/iesbaio/"><img class="empresa" src="../Imaxes/Xerais/Instagram.png" width="25" alt="Instagram"></a>
        </div>
        <div class="soporte">
            <a class="axuda" href="../../gl/PHP/quensomos.php">Gallego</a>
            <a class="axuda" href="../../es/PHP/quensomos.php">Castellano</a>
            <a class="axuda" href="https://www.aepd.es/es/politica-de-privacidad-y-aviso-legal">Política de privacidad</a>
            <a class="axuda" href="https://phylo.co/blog/traccion/que-son-los-terminos-y-condiciones/">Términos</a>
        </div>
        <div class="copyright"><p>Copyright &copy;2023. IES Maximino Romero de Lema</p></div>
    </footer>
</body>
</html>
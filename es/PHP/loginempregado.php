<?php
    define('CSSPATH', '');
    $css = "../CSS/estilosxeraiscafeteria.css";?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PROXECTO FIN DE CICLO">
    <meta name="keywords" content="HTML, CSS, JavaScript, PHP, MYSQL">
    <title>BAR MANOLA - Iniciar sesión</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="<?php echo (CSSPATH . "$css" );?>">
    <script src="../JavaScript/jQuery/jquery-3.6.3.js" type="text/javascript"></script>
</head>
<body>
    <header>
        <div id="logoytitulo">
            <a href="../../es/index.html"><img src="../Imaxes/Xerais/Logo_Cafetería.png" width="100%" alt="Bar Manola"/></a>
            <div id="desctitulo">
                <h1>BIENVENIDO A BAR MANOLA</h1><br/>
                <h4>A tu servicio desde 2017</h4>
            </div>
        </div>
        <div id="barrasuperior">
            <a id="usuario" href="rexistrarse.php">Rexistrarse</a>
        </div>
    </header>
    <hr>
    <main>
        <section id="acceso">
            <form class="login" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="get">
                <?php
                    if(isset($_GET["usuario"]) && isset($_GET["contrasinal"])){
                        $usuario = $_GET["usuario"];
                        $contrasinal = $_GET["contrasinal"];
                        $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                        if(!$conexion) {
                            echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='20%' alt='Aviso'/>No se pudo conectar á nuestra base de datos. Inténtelo más tarde.";
                        } else {
                            $existecliente = "SELECT Perfil, Usuario, Contrasinal, Nome_completo FROM empregados WHERE Usuario = '$usuario'";
                            $resultado = $conexion->query($existecliente);
                            if($resultado->num_rows==0){
                                echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No existe el empleado $usuario.";
                            } else {
                                $row = $resultado->fetch_assoc();
                                if($usuario == $row["Usuario"] && $contrasinal == $row["Contrasinal"]){
                                    session_start();
                                    $_SESSION["usuario"] = $row["Nome_completo"];
                                    header("location: indexempregado.php");
                                } else if($usuario != $row["Usuario"] || $contrasinal != $row["Contrasinal"]) {
                                    echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>El usuario o contraseña no son correctos.";
                                }
                            }
                        }
                    }
                ?>
                <nav>
                    <ul>
                        <li id="enlacerol">Cliente</li>
                        <li id="linklogindisabled">Empleado</li>
                    </ul>
                </nav>
                <script>
                    let enlacerol = document.getElementById("enlacerol");
                    enlacerol.addEventListener("click", function(){
                        window.location.href = "login.php";
                    });
                </script>
                <div class="campo">
                    <h1>Iniciar sesión</h1>
                </div>
                <div class="campo">
                    <label for="usuario">Usuario:</label>
                    <input type="text" name="usuario" id="usuario"/>
                </div><br/>
                <div class="campo">
                    <label for="contrasinal">Contraseña:</label>
                    <input type="password" name="contrasinal" id="contrasinal">
                </div><br/>
                <div class="campo">
                    <a href="contrasinalesquecida.php">¿Has olvidado la contraseña?</a><br/>
                </div>
                <div class="campo">
                    <button id="acceder">Acceder</button>
                </div>
            </form>
            <div class="avisos"></div>
            <script>
                let usuario = document.getElementById("usuario");
                let contrasinal = document.getElementById("contrasinal");
                let acceder = document.getElementById("acceder");
                let avisos = document.querySelector(".avisos");
                acceder.addEventListener("click", function(){
                    if (usuario.value=="" || contrasinal.value=="") {
                        avisos.style.display = "block";
                        avisos.innerHTML = "<img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/></p>Tienes algunos campos sin completar. Revíselo.</p>";
                        event.preventDefault();
                    }
                });
            </script>
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
            <a class="axuda" href="../../gl/PHP/loginempregado.php">Gallego</a>
            <a class="axuda" href="../../es/PHP/loginempregado.php">Castellano</a>
            <a class="axuda" href="https://www.aepd.es/es/politica-de-privacidad-y-aviso-legal">Política de privacidad</a>
            <a class="axuda" href="https://phylo.co/blog/traccion/que-son-los-terminos-y-condiciones/">Términos</a>
        </div>
        <div class="copyright"><p>Copyright &copy;2023. IES Maximino Romero de Lema</p></div>
    </footer>
</body>
</html>
<?php
    define('CSSPATH', '');
    $css = "../CSS/estilosxeraiscafeteria.css";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PROXECTO FIN DE CICLO">
    <meta name="keywords" content="HTML, CSS, JavaScript, PHP, MYSQL">
    <title>BAR MANOLA - Restablecer contrasinal</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="<?php echo (CSSPATH . "$css" );?>">
    <script src="../JavaScript/jQuery/jquery-3.6.3.js" type="text/javascript"></script>
</head>
<body>
    <header>
        <div id="logoytitulo">
            <a href="../../gl/index.html"><img src="../Imaxes/Xerais/Logo_Cafetería.png" width="100%" alt="Bar Manola"/></a>
            <div id="desctitulo">
                <h1>BENVIDO A BAR MANOLA</h1><br/>
                <h4>Ao teu servizo dende 2017</h4>
            </div>
        </div>
        <div id="barrasuperior">
            <a id="usuario" href="login.php">Iniciar sesión</a>|<a id="usuario" href="rexistrarse.php">Rexistrarse</a>
        </div>
    </header>
    <hr>
    <main>
        <section id="acceso">
            <form class="login" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="get">
                <?php
                    if(isset($_GET["usuario"]) && isset($_GET["novacontrasinal"]) && isset($_GET["repitacontrasinal"])){
                        $usuario = $_GET["usuario"];
                        $novacontrasinal = $_GET["novacontrasinal"];
                        $repitacontrasinal = $_GET["repitacontrasinal"];
                        if($novacontrasinal!=$repitacontrasinal){
                            echo "<div class='avisos'><img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>As contrasinais non coinciden.</div>";
                        } else {
                            $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                            if(!$conexion) {
                                echo "<div class='avisos'><img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non se puido conectar á nosa base de datos. Inténteo máis tarde.</div>";
                            } else {
                                $existecliente = "SELECT Perfil, Usuario, Contrasinal, Nome_completo FROM empregados WHERE Usuario = '$usuario'";
                                $resultado = $conexion->query($existecliente);
                                if($resultado->num_rows==0){
                                    echo "<div class='avisos'><img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non existe o cliente $usuario.</div>";
                                } else {
                                    $row = $resultado->fetch_assoc();
                                    $cambiarcontrasinal = "UPDATE empregados SET Contrasinal = '$novacontrasinal' WHERE Usuario = '$usuario'";
                                    if($conexion->query($cambiarcontrasinal)==true){
                                        echo "<div class='avisos'><img class='correcto' src='../Imaxes/Xerais/correcto.png' width='100%' alt='Aviso'/>Contrasinal cambiado correctamente.</div>";
                                    } else if($conexion->query($cambiarcontrasinal)==false){
                                        echo "<div class='avisos'><img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Por motivos técnicos non se puido cambiar a túa contrasinal.</div>";
                                    }
                                }
                            }
                        }
                    }
                ?>
                <div class="campo">
                    <h1>Cambiar contrasinal</h1>
                </div>
                <div class="campo">
                    <label for="usuario">Usuario:</label>
                    <input type="text" name="usuario" id="usuario"/>
                </div><br/>
                <div class="campo">
                    <label for="contrasinal">Nova contrasinal:</label>
                    <input type="password" name="novacontrasinal" id="novacontrasinal">
                </div><br/>
                <div class="campo">
                    <label for="contrasinal">Repita contrasinal:</label>
                    <input type="password" name="repitacontrasinal" id="repitacontrasinal">
                </div><br/>
                <div class="campo">
                    <button id="acceder">Gardar contrasinal</button>
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
                        avisos.innerHTML = "<img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/></p>Tes algúns campos sen completar. Revísao.</p>";
                        event.preventDefault();
                    }
                });
            </script>
        </section>
    </main>
    <footer>
        <div class="colaboradores">
            <h2>Os nosos colaboradores</h2>
            <a href="https://edu.xunta.gal/centros/iesmaximinoromerodelema"><img class="empresa" src="../Imaxes/Xerais/Logo-Final.png" width="100" alt="IES Maximino Romero de Lema"></a>
            <a href="https://www.facebook.com/PanaderiaSampedro/"><img class="empresa" src="../Imaxes/Xerais/Panadería Sampedro Empresa Colaboradora.jpeg" width="100" alt="Panadería Sampedro"></a>
        </div>
        <div class="contacto">
            <p>Rúa Prado da Torre s/n 15150, Baio-Zas (A Coruña)<br/>
            ies.maximinoromerodelema@edu.xunta.gal<br/>
            (+34) 881 96 00 15</p>
            <a href="https://www.facebook.com/maximino.romerodelema"><img class="empresa" src="../Imaxes/Xerais/Facebook.png" width="25" alt="Facebook"></a>
            <a href="https://www.instagram.com/iesbaio/"><img class="empresa" src="../Imaxes/Xerais/Instagram.png" width="25" alt="Instagram"></a>
        </div>
        <div class="soporte">
            <a class="axuda" href="../../gl/PHP/contrasinalesquecidaempregado.php">Galego</a>
            <a class="axuda" href="../../es/PHP/contrasinalesquecidaempregado.php">Castelán</a>
            <a class="axuda" href="https://www.aepd.es/es/politica-de-privacidad-y-aviso-legal">Política de privacidade</a>
            <a class="axuda" href="https://phylo.co/blog/traccion/que-son-los-terminos-y-condiciones/">Términos</a>
        </div>
        <div class="copyright"><p>Copyright &copy;2023. IES Maximino Romero de Lema</p></div>
    </footer>
</body>
</html>
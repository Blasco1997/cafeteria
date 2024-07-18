<?php
    define('CSSPATH', '');
    $css = "../CSS/estilosxeraiscafeteria.css";
    session_start();
    if(!isset($_SESSION["cliente"])){
        header("location: login.php?redirigido=true");
        exit();
    } else {
        $usuario = '<img style="border-radius: 100%;" src="../Imaxes/Xerais/User.png" width="30" alt="User"/>'.$_SESSION["cliente"];
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
    <title>BAR MANOLA - Eliminar cuenta</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="<?php echo (CSSPATH . "$css" );?>">
    <script src="../JavaScript/jQuery/jquery-3.6.3.js" type="text/javascript"></script>
</head>
<body>
    <header>
        <div id="logoytitulo">
            <a href='indexcliente.php'><img src='../Imaxes/Xerais/Logo_Cafetería.png' width='100%' alt='Bar Manola'/></a>
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
                <li><a href="reservarprato.php">Reservar</a></li>
                <li><a href="produtos1.php">Productos</a></li>
                <li><a href="quensomos.php">Quiénes somos</a></li>
            </ul>
        </nav>
    </header>
    <hr>
    <main>
        <section id="busqueda">
            <?php
                if(isset($_SESSION["cliente"]) && isset($_POST["motivo"])){
                    $usuario = $_SESSION["cliente"];
                    $motivo = $_POST["motivo"];
                    $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                    if(!$conexion) {
                        echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo conectar a nuestra base de datos. Inténtelo más tarde.</div>";
                    } else {
                        $existecliente = "SELECT * FROM clientes WHERE Nome_completo = '$usuario'";
                        $resultado = $conexion->query($existecliente);
                        if($resultado->num_rows==0){
                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No existe el cliente $usuario.</div>";
                        } else {
                            $row = $resultado->fetch_assoc();
                            $eliminarcuentacliente = "DELETE FROM clientes WHERE Nome_completo = '$usuario'";
                            if($conexion->query($eliminarcuentacliente)==true){
                                echo "<script>alert('Tu motivo de darte de baja es: $motivo');</script>";
                                echo "<script>alert('Ya estás dado de baja. Gracias por formar parte de nuestra aplicación. Recuerda que puedes volver a crearte tu usuario cuando quieras.');</script>";
                                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='10%' alt='Aviso'/>Cuenta eliminada. <a href='login.php'>Ir a Login.</a></div>";
                                session_destroy();
                                exit();
                            } else if($conexion->query($eliminarcuentacliente)==true){
                                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Por motivos técnicos no se pudo eliminar tu cuenta.</div>";
                            }
                        }
                    }
                } else if(isset($_SESSION["cliente"]) && isset($_POST["outrosmotivos"])){
                    $usuario = $_SESSION["cliente"];
                    $outrosmotivos = $_POST["outrosmotivos"];
                    $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                    if(!$conexion) {
                        echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo conectar a nuestra base de datos. Inténtelo más tarde.</div>";
                    } else {
                        $existecliente = "SELECT * FROM clientes WHERE Nome_completo = '$usuario'";
                        $resultado = $conexion->query($existecliente);
                        if($resultado->num_rows==0){
                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No existe el cliente $usuario.</div>";
                        } else {
                            $row = $resultado->fetch_assoc();
                            $eliminarcuentacliente = "DELETE FROM clientes WHERE Nome_completo = '$usuario'";
                            if($conexion->query($eliminarcuentacliente)==true){
                                echo "<script>alert('Tu motivo de darte de baja es: $outrosmotivos');</script>";
                                echo "<script>alert('Ya estás dado de baja. Gracias por formar parte de nuestra aplicación. Recuerda que puedes volver a crearte tu usuario cuando quieras.');</script>";
                                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Cuenta eliminada. <a href='login.php'>Ir a Login.</a></div>";
                                session_destroy();
                                exit();
                            } else if($conexion->query($eliminarcuentacliente)==true){
                                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Por motivos técnicos no se pudo eliminar tu cuenta.</div>";
                            }
                        }
                    }
                }
            ?>
            <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>" method="post">
                <h1>Seleccione el motivo para darse de baja:</h1><br/>
                <input type="radio" name="motivo" value="No estoy a gusto con la aplicación."/><label>No estoy a gusto con la aplicación.</label><br/><br/>
                <input type="radio" name="motivo" value="No me interesa la aplicación."/><label>No me interesa la aplicación.</label><br/><br/>
                <input type="radio" name="motivo" value="La aplicación non me hace lo que pido"/><label>La aplicación no me hace lo que pido.</label><br/><br/>
                <input type="radio" name="motivo" value="Estou cansado de navegar en esta aplicación."/><label>Estoy cansado de navegar en esta aplicación.</label><br/><br/>
                <input type="radio" name="motivo" value="Pido otras mejoras para la aplicación."/><label>Pido otras mejoras para la aplicación.</label><br/><br/>
                <input type="radio" name="motivo" id="outro"/><label>Otro:</label>
                <textarea style="display: none" name="outrosmotivos" id="outrosmotivos" placeholder="(Opcional) Describe tu motivo..."></textarea><br/><br/>
                <button>Enviar</button>
            </form>
            <script>
                let outro = document.getElementById("outro");
                outro.addEventListener("click", function(){
                    let outrosmotivos = document.getElementById("outrosmotivos");
                    outrosmotivos.style.display = "block";
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
            <p>Calle Prado da Torre s/n 15150, Baio-Zas (La Coruña)<br/>
            ies.maximinoromerodelema@edu.xunta.gal<br/>
            (+34) 881 96 00 15</p>
            <a href="https://www.facebook.com/maximino.romerodelema"><img class="empresa" src="../Imaxes/Xerais/Facebook.png" width="25" alt="Facebook"></a>
            <a href="https://www.instagram.com/iesbaio/"><img class="empresa" src="../Imaxes/Xerais/Instagram.png" width="25" alt="Instagram"></a>
        </div>
        <div class="soporte">
            <a class="axuda" href="../../gl/PHP/eliminarcuentacliente.php">Gallego</a>
            <a class="axuda" href="../../es/PHP/eliminarcuentacliente.php">Castellano</a>
            <a class="axuda" href="https://www.aepd.es/es/politica-de-privacidad-y-aviso-legal">Política de privacidad</a>
            <a class="axuda" href="https://phylo.co/blog/traccion/que-son-los-terminos-y-condiciones/">Términos</a>
        </div>
        <div class="copyright"><p>Copyright &copy;2023. IES Maximino Romero de Lema</p></div>
    </footer>
</body>
</html>
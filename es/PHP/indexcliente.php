<?php
    define('CSSPATH', '');
    $css = "../CSS/estilosxeraiscafeteria.css";
    session_start();
    if(!isset($_SESSION["cliente"])){
        header("Location: login.php?redirigido=true");
    } else {
        $usuario = '<img style="border-radius: 100%;" src="../Imaxes/Xerais/User.png" width="30" alt="User"/>'.$_SESSION["cliente"].'<span class="material-symbols-outlined" id="morevert">more_vert
        <ul>
            <li><a href="cerrarsesioncliente.php">Cerrar sesión</a></li><br/>
            <li><a href="eliminarcuentacliente.php"><span class="material-symbols-outlined" id="eliminarcuenta">close</span>Eliminar cuenta</a></li>
        </ul>
        </span>';
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
    <title>BAR MANOLA - Inicio</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="<?php echo (CSSPATH . "$css" );?>">
    <script src="../JavaScript/jQuery/jquery-3.6.3.js" type="text/javascript"></script>
</head>
<body>
    <header>
        <div id="logoytitulo">
            <img src="../Imaxes/Xerais/Logo_Cafetería.png" width="100%" alt="Bar Manola"/>
            <div id="desctitulo">
                <h1>BIENVENIDO A BAR MANOLA</h1><br/>
                <h4>A tu servicio desde 2017</h4>
            </div>
        </div>
        <?php
            $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
            if(!$conexion) {
                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo conectar a nuestra base de datos. Inténtelo más tarde.</div>";
            } else {
                $numreservas = "SELECT COUNT(Id_Reserva) AS NumReservas FROM reservas AS r JOIN clientes AS cl JOIN menus AS mn ON r.Id_Cliente = cl.Id_Cliente AND r.Id_Menú = mn.Id_Menú WHERE 
                r.Pagado = 'Pendente de entrega' OR r.Pagado = 'Pendente de pagar' AND cl.Nome_completo = '{$_SESSION["cliente"]}' AND mn.Día = CURDATE()";
                $resultado = $conexion->query($numreservas);
                if($resultado->num_rows==0){
                    echo "";
                } else {
                    $row = $resultado->fetch_assoc();
                    $totalreservas = $row["NumReservas"];
                    if($row["NumReservas"]==1){
                        echo "<div id='avisoreserva'><img src='../Imaxes/Xerais/aviso.png' width='15' alt='Aviso'/>Tes $totalreservas reserva para o día de hoxe. <a href='verreservascliente.php'>Ver reservas</a></div>";
                    } else if($row["NumReservas"]>1){
                        echo "<div id='avisoreserva'><img src='../Imaxes/Xerais/aviso.png' width='15' alt='Aviso'/>Tes $totalreservas reservas para o día de hoxe. <a href='verreservascliente.php'>Ver reservas</a></div>";
                    }
                    
                }
            } 
        ?>
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
        <section id="galeria">
            <button class="moverimagen" id="moveratras">&#8249;</button>
            <button class="moverimagen" id="moveradelante">&#8250;</button>
            <div id="carrusel">
                <img class="foto" src="../Imaxes/Carrusel/Foto1.jpg" style="width: 100%; filter: brightness(1.5);" alt="Foto1"/>
                <img class="foto" src="../Imaxes/Carrusel/Foto2.jpg" style="width: 100%; filter: brightness(1.5);" alt="Foto2"/>
                <img class="foto" src="../Imaxes/Carrusel/Foto3.jpg" style="width: 100%; filter: brightness(1.5);" alt="Foto3"/>
                <img class="foto" src="../Imaxes/Carrusel/Foto4.jpg" style="width: 100%; filter: brightness(1.5);" alt="Foto4"/>
                <img class="foto" src="../Imaxes/Carrusel/Foto5.jpg" style="width: 100%; filter: brightness(1.5);" alt="Foto5"/>
                <img class="foto" src="../Imaxes/Carrusel/Foto6.jpg" style="width: 100%; filter: brightness(1.5);" alt="Foto6"/>
                <img class="foto" src="../Imaxes/Carrusel/Foto7.jpg" style="width: 100%; filter: brightness(1.5);" alt="Foto7"/>
            </div>
            <script type="text/javascript" src="../gl/JavaScript/carrusel.js"></script>
        </section>
        <section class="banner">
            <div class="descbanner1">
                <h1>Productos a la venta</h1>
                <p>Ven a echar un vistazo a nuestros productos que tenemos en venta. Desde bebidas
                y chucherías hasta productos hechos por nosotros como bocatas, paninis, etc. <a href="produtos1.php">Visite
                nuestra página de productos</a>.
                </p>
            </div>
            <hr class="vline">
            <div class="descbanner2">
                <h1>Hacer una reserva</h1>
                <p>En nuestra cafetería contamos con autoservicio de comidas los lunes y los miércoles, 
                    ya que el alumnado de nuestro instituto tiene que estar en la clase por las tardes. Puedes 
                    reservar presencialmente en la cafetería o también puedes reservar un plato y una
                    bebida para una fecha en concreto <a href="reservarprato.php">en la página de reservas</a>.
                    ¡Te esperamos!
                </p>
            </div>
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
            <a class="axuda" href="../../gl/PHP/indexcliente.php">Gallego</a>
            <a class="axuda" href="../../es/PHP/indexcliente.php">Castellano</a>
            <a class="axuda" href="https://www.aepd.es/es/politica-de-privacidad-y-aviso-legal">Política de privacidad</a>
            <a class="axuda" href="https://phylo.co/blog/traccion/que-son-los-terminos-y-condiciones/">Términos</a>
        </div>
        <div class="copyright"><p>Copyright &copy;2023. IES Maximino Romero de Lema</p></div>
    </footer>
</body>
</html>
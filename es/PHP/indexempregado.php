<?php
    define('CSSPATH', '');
    $css = "../CSS/estilosxeraiscafeteria.css";
    session_start();
    if(!isset($_SESSION["usuario"])){
        header("location: loginempregado.php?redirigido=true");
    } else {
        $usuario = '<img style="border-radius: 100%;" src="../Imaxes/Xerais/User.png" width="30" alt="User"/>'.$_SESSION["usuario"].'<span class="material-symbols-outlined" id="morevert">more_vert
            <ul>
                <li><a href="cerrarsesionempregado.php">Cerrar sesión</a></li>
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
        <div id="barrasuperior">
            <?php echo $usuario;?>
            <form action="busqueda.php" method="get">
                <input type="search" name="buscar" id="buscar" placeholder="&#128269; Buscar"/>
            </form>
        </div>
        <nav id="navegacion">
            <ul>
                <li><a href="#">Administración</a>
                    <ul>
                        <li><a href="modificarmenu.php">Modificar Menú</a></li>
                        <li><a href="rexistroempregado.php">Añadir Empleado</a></li>
                        <li><a href="engadirproduto.php">Añadir Producto</a></li>
                        <li><a href="engadirprovedor.php">Añadir Proveedor</a></li>
                        <li><a href="engadirnova.php">Añadir noticia</a></li>
                    </ul>
                </li>
                <li><a href="#">Consultas</a>
                    <ul>
                        <li><a href="listadeprodutos.php">Lista de productos</a></li>
                        <li><a href="listadeusuarios.php">Lista de usuarios</a></li>
                        <li><a href="produtoscomprados.php">Lista de productos comprados</a></li>
                        <li><a href="pedidosrealizados.php">Pedidos realizados</a></li>
                        <li><a href="listadeempregados.php">Lista de empleados</a></li>
                        <li><a href="listadepratos.php">Lista de platos</a></li>
                        <li><a href="listademenus.php">Lista de menús</a></li>
                        <li><a href="listademesas.php">Lista de mesas</a></li>
                        <li><a href="listadereservas.php">Lista de reservas</a></li>
                        <li><a href="listadeprovedores.php">Lista de proveedores</a></li>
                        <li><a href="listadenovas.php">Lista de noticias</a></li>
                    </ul>
                </li>
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
            <script type="text/javascript" src="../JavaScript/carrusel.js"></script>
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
            <a class="axuda" href="../../gl/PHP/indexempregado.php">Gallego</a>
            <a class="axuda" href="../../es/PHP/indexempregado.php">Castellano</a>
            <a class="axuda" href="https://www.aepd.es/es/politica-de-privacidad-y-aviso-legal">Política de privacidad</a>
            <a class="axuda" href="https://phylo.co/blog/traccion/que-son-los-terminos-y-condiciones/">Términos</a>
        </div>
        <div class="copyright"><p>Copyright &copy;2023. IES Maximino Romero de Lema</p></div>
    </footer>
</body>
</html>
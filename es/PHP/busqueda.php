<?php
    define('CSSPATH', '');
    $css = "../CSS/estilosxeraiscafeteria.css";
    session_start();
    if(!isset($_SESSION["cliente"]) && !isset($_SESSION["usuario"])){
        $usuario = '<a id="usuario" href="login.php">Iniciar sesión</a>|<a href="rexistrarse.php">Registrarse</a>';
    } else if(isset($_SESSION["cliente"])){
        $usuario = '<img style="border-radius: 100%;" src="../Imaxes/Xerais/User.png" width="30" alt="User"/>'.$_SESSION["cliente"].'<span class="material-symbols-outlined" id="morevert">more_vert
            <ul>
                <li><a href="cerrarsesioncliente.php">Cerrar sesión</a></li><br/>
                <li><a href="eliminarcuentacliente.php"><span class="material-symbols-outlined" id="eliminarcuenta">close</span>Eliminar cuenta</a></li>
            </ul>
        </span>';
    } else if(isset($_SESSION["usuario"])){
        $usuario = '<img style="border-radius: 100%;" src="../Imaxes/Xerais/User.png" width="30" alt="User"/> '.$_SESSION["usuario"].'<span class="material-symbols-outlined" id="morevert">more_vert
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
    <title>BAR MANOLA - Resultados de la búsqueda</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="<?php echo (CSSPATH . "$css" );?>">
    <script src="../JavaScript/jQuery/jquery-3.6.3.js" type="text/javascript"></script>
</head>
<body>
    <header>
        <div id="logoytitulo">
            <?php 
                if(!isset($_SESSION["cliente"]) && !isset($_SESSION["usuario"])){
                    echo "<a href='../index.html'><img src='../Imaxes/Xerais/Logo_Cafetería.png' width='100%' alt='Bar Manola'/></a>";
                } else if(isset($_SESSION["cliente"])) {
                    echo "<a href='indexcliente.php'><img src='../Imaxes/Xerais/Logo_Cafetería.png' width='100%' alt='Bar Manola'/></a>";
                } else if(isset($_SESSION["usuario"])) {
                    echo "<a href='indexempregado.php'><img src='../Imaxes/Xerais/Logo_Cafetería.png' width='100%' alt='Bar Manola'/></a>";
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
                    if(!isset($_SESSION["cliente"]) && !isset($_SESSION["usuario"])){
                        echo "<li><a href='produtos1.php'>Productos</a></li>
                        <li><a href='quensomos.php'>Quiénes somos</a></li>";
                    } else if(isset($_SESSION["cliente"])){
                        echo "<li><a href='reservarprato.php'>Reservar</a></li>
                        <li><a href='produtos1.php'>Productos</a></li>
                        <li><a href='quensomos.php'>Quiénes somos</a></li>";
                    } else if(isset($_SESSION["usuario"])) {
                        echo "<li><a href='#'>Administración</a>
                            <ul>
                                <li><a href='modificarmenu.php'>Modificar Menú</a></li>
                                <li><a href='rexistroempregado.php'>Añadir Empleado</a></li>
                                <li><a href='engadirproduto.php'>Añadir Producto</a></li>
                                <li><a href='engadirprovedor.php'>Añadir Proveedor</a></li>
                                <li><a href='engadirnova.php'>Añadir noticia</a></li>
                            </ul>
                        </li>
                        <li><a href='#'>Consultas</a>
                            <ul>
                                <li><a href='listadeprodutos.php'>Lista de productos</a></li>
                                <li><a href='listadeusuarios.php'>Lista de usuarios</a></li>
                                <li><a href='produtoscomprados.php'>Lista de productos comprados</a></li>
                                <li><a href='listadeempregados.php'>Lista de empleados</a></li>
                                <li><a href='listadepratos.php'>Lista de platos</a></li>
                                <li><a href='listademenus.php'>Lista de menús</a></li>
                                <li><a href='listademesas.php'>Lista de mesas</a></li>
                                <li><a href='listadereservas.php'>Lista de reservas</a></li>
                                <li><a href='listadeprovedores.php'>Lista de proveedores</a></li>
                                <li><a href='listadenovas.php'>Lista de noticias</a></li>
                            </ul>
                        </li>";
                    }
                ?>
            </ul>
        </nav>
    </header>
    <hr>
    <main>
        <section id="busqueda">
            <?php
                if(isset($_GET['buscar'])) {
                    $busqueda = $_GET['buscar'];
                    $urls = array(
                        "contrasinalesquecida.php",
                        "contrasinalesquecidaempregado.php",
                        "detallesreserva.php",
                        "engadirproduto.php",
                        "engadirprovedor.php",
                        "indexcliente.php",
                        "indexempregado.php",
                        "listadeempregados.php",
                        "listademenus.php",
                        "listademesas.php",
                        "listadepratos.php",
                        "listadeprodutos.php",
                        "listadeprovedores.php",
                        "listadereservas.php",
                        "listadeusuarios.php",
                        "login.php",
                        "loginempregado.php",
                        "modificarmenu.php",
                        "novasdonosolocal.php",
                        "produtos1.php",
                        "produtos2.php",
                        "produtos3.php",
                        "produtoscomprados.php",
                        "quensomos.php",
                        "realizarpedido.php",
                        "reservarprato.php",
                        "rexistrarse.php",
                        "rexistroempregado.php",
                        "verproduto.php",
                        "verreservas.php"
                    );
                    function buscarPalabraClaveEnPagina($url, $busqueda) {
                        $request = file_get_contents($url);
                        return strpos($request, $busqueda) !== false;
                    }
                    $resultados = 0;
                    foreach ($urls as $url) {
                        if (buscarPalabraClaveEnPagina($url, $busqueda)) {
                            echo "<div class='resultadobusqueda'>La palabra clave '$busqueda' fue encontrada en la página: $url<br/>";
                            echo "<iframe src='$url' width='100%' height='300'></iframe></div>";
                            $resultados++;
                        } else {
                            echo "";
                        }
                    }
                    if($resultados == 0){
                        echo "<p>No hubo resultados de búsqueda para la palabra clave '$busqueda'.</p>";
                    } else {
                        echo "<p>Total de resultados obtenidos: $resultados.</p>";
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
            <p>Calle Prado da Torre s/n 15150, Baio-Zas (La Coruña)<br/>
            ies.maximinoromerodelema@edu.xunta.gal<br/>
            (+34) 881 96 00 15</p>
            <a href="https://www.facebook.com/maximino.romerodelema"><img class="empresa" src="../Imaxes/Xerais/Facebook.png" width="25" alt="Facebook"></a>
            <a href="https://www.instagram.com/iesbaio/"><img class="empresa" src="../Imaxes/Xerais/Instagram.png" width="25" alt="Instagram"></a>
        </div>
        <div class="soporte">
            <a class="axuda" href="../../gl/PHP/busqueda.php">Gallego</a>
            <a class="axuda" href="../../es/PHP/busqueda.php">Castellano</a>
            <a class="axuda" href="https://www.aepd.es/es/politica-de-privacidad-y-aviso-legal">Política de privacidad</a>
            <a class="axuda" href="https://phylo.co/blog/traccion/que-son-los-terminos-y-condiciones/">Términos</a>
        </div>
        <div class="copyright"><p>Copyright &copy;2023. IES Maximino Romero de Lema</p></div>
    </footer>
</body>
</html>
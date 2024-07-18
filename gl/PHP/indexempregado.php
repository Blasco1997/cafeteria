<?php
    define('CSSPATH', '');
    $css = "../CSS/estilosxeraiscafeteria.css";
    session_start();
    if(!isset($_SESSION["usuario"])){
        header("location: loginempregado.php?redirixido=true");
    } else {
        $usuario = '<img style="border-radius: 100%;" src="../Imaxes/Xerais/User.png" width="30" alt="User"/>'.$_SESSION["usuario"].'<span class="material-symbols-outlined" id="morevert">more_vert
            <ul>
                <li><a href="cerrarsesionempregado.php">Pechar sesión</a></li>
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
                <h1>BENVIDO A BAR MANOLA</h1><br/>
                <h4>Ao teu servizo dende 2017</h4>
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
                        <li><a href="rexistroempregado.php">Engadir Empregado</a></li>
                        <li><a href="engadirproduto.php">Engadir Produto</a></li>
                        <li><a href="engadirprovedor.php">Engadir Provedor</a></li>
                        <li><a href="engadirnova.php">Engadir nova</a></li>
                    </ul>
                </li>
                <li><a href="#">Consultas</a>
                    <ul>
                        <li><a href="listadeprodutos.php">Listado de produtos</a></li>
                        <li><a href="listadeusuarios.php">Listado de usuarios</a></li>
                        <li><a href="produtoscomprados.php">Listado de produtos comprados</a></li>
                        <li><a href="pedidosrealizados.php">Pedidos realizados</a></li>
                        <li><a href="listadeempregados.php">Listado de empregados</a></li>
                        <li><a href="listadepratos.php">Listado de pratos</a></li>
                        <li><a href="listademenus.php">Listado de menús</a></li>
                        <li><a href="listademesas.php">Listado de mesas</a></li>
                        <li><a href="listadereservas.php">Listado de reservas</a></li>
                        <li><a href="listadeprovedores.php">Listado de provedores</a></li>
                        <li><a href="listadenovas.php">Listado de novas</a></li>
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
                <h1>Produtos á venta</h1>
                <p>Ven botar un vistazo aos nosos produtos que temos en venta. Dende bebidas
                e lambetadas ata produtos feitos por nós como bocatas, paninis, etc. <a href="produtos1.php">Visite
                a nosa páxina de produtos</a>.
                </p>
            </div>
            <hr class="vline">
            <div class="descbanner2">
                <h1>Facer unha reserva</h1>
                <p>Na nosa cafetería contamos con autoservicio de comidas os luns e os mércores, 
                    xa que o alumnado do noso instituto ten que estar na clase polas tardes. Podes 
                    reservar presencialmente na cafetería ou tamén podes reservar un prato e unha
                    bebida para unha data en concreto <a href="reservarprato.php">na páxina de reservas</a>.
                    Esperámoste!
                </p>
            </div>
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
            <a class="axuda" href="../../gl/PHP/indexempregado.php">Galego</a>
            <a class="axuda" href="../../es/PHP/indexempregado.php">Castelán</a>
            <a class="axuda" href="https://www.aepd.es/es/politica-de-privacidad-y-aviso-legal">Política de privacidade</a>
            <a class="axuda" href="https://phylo.co/blog/traccion/que-son-los-terminos-y-condiciones/">Términos</a>
        </div>
        <div class="copyright"><p>Copyright &copy;2023. IES Maximino Romero de Lema</p></div>
    </footer>
</body>
</html>
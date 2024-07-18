<?php
    define('CSSPATH', '');
    $css = "../CSS/estilosxeraiscafeteria.css";
    session_start();
    if(!isset($_SESSION["usuario"])){
        header("Location: loginempregado.php?redirigido=true");
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
    <title>BAR MANOLA - Lista de productos comprados</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="<?php echo (CSSPATH . "$css" );?>">
    <script src="../JavaScript/jQuery/jquery-3.6.3.js" type="text/javascript"></script>
</head>
    <body>
        <header>
            <div id="logoytitulo">
                <a href="indexempregado.php"><img src="../Imaxes/Xerais/Logo_Cafetería.png" width="100%" alt="Bar Manola"/></a>
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
                            <li>Lista de productos comprados</li>
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
            <section class="consulta">
                <h1 class="tituloconsulta">PRODUCTOS COMPRADOS:</h1>
                <div class="filtrocategoria">
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="get">
                        <button name="vaciarcarrito">Vaciar lista</button>
                    </form>
                </div>
                <form class="busquedaproduto" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="get">
                    <input type="search" name="buscarproduto" id="buscar" placeholder="&#128269; Buscar producto"/>
                    <button>Filtrar</button>
                </form>
                <?php
                    if(isset($_GET["vaciarcarrito"])) {
                        unset($_SESSION["comprado"]);
                    } else {
                        echo "<div class='listadoprodutos'>";
                        if(isset($_SESSION["comprado"])){
                            echo "<form action='realizarpedido.php' method='post'>";
                            echo "<table><tr><th>Producto</th><th>Descripción</th><th>Cantidad</th><th>Precio</th><th>Subtotal</th><th>Proveedor</th></tr>";
                            $j=1;
                            $total = 0;
                            foreach ($_SESSION["comprado"] as $fila){
                                $produto = $fila["produto"];
                                $descricion = $fila['descricion'];
                                $cantidade = $fila['cantidade'];
                                $prezo = $fila['prezo'];
                                $subtotal = $fila['subtotal'];
                                $provedor = $fila['provedor'];
                                echo "<tr><td><input type='hidden' name='produto$j' value='$produto'/>$produto</td>
                                <td><input type='hidden' name='descricion$j' value='$descricion'/>$descricion</td>
                                <td><input type='hidden' name='cantidade$j' value='$cantidade'/>$cantidade uds</td>
                                <td><input type='hidden' name='prezo$j' value='$prezo'/>$prezo €</td>
                                <td><input type='hidden' name='subtotal$j' value='$subtotal'/>$subtotal €</td>
                                <td><input type='hidden' name='provedor$j' value='$provedor'/>$provedor</td></tr>";
                                $total = $total + $subtotal;
                                $j++;
                            }
                            echo "<tr><td colspan='4' style='text-align: center;'><h3>TOTAL A PAGAR:</h3></td><td colspan='3'><h3 id='total'>$total €</h3><button id='realizarpedido'>REALIZAR PEDIDO</button></td></tr>
                            </table></form></div>";
                        } else {
                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Aún no se compró ningún producto.</div>";
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
                <a class="axuda" href="../../gl/PHP/produtoscomprados.php">Gallego</a>
                <a class="axuda" href="../../es/PHP/produtoscomprados.php">Castellano</a>
                <a class="axuda" href="https://www.aepd.es/es/politica-de-privacidad-y-aviso-legal">Política de privacidad</a>
                <a class="axuda" href="https://phylo.co/blog/traccion/que-son-los-terminos-y-condiciones/">Términos</a>
            </div>
            <div class="copyright"><p>Copyright &copy;2023. IES Maximino Romero de Lema</p></div>
        </footer>
    </body>
</html>
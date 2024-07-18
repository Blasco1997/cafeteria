<?php
    define('CSSPATH', '');
    $css = "../CSS/estilosxeraiscafeteria.css";
    session_start();
    if(!isset($_SESSION["usuario"])){
        header("Location: loginempregado.php?redirixido=true");
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
    <title>BAR MANOLA - Listado de produtos comprados</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="<?php echo (CSSPATH . "$css" );?>">
    <script src="../JavaScript/jQuery/jquery-3.6.3.js" type="text/javascript"></script>
</head>
    <body>
        <header>
            <div id="logoytitulo">
                <a href="indexempregado.php"><img src="../Imaxes/Xerais/Logo_Cafetería.png" width="100%" alt="Bar Manola"/></a>
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
                            <li><a href="engadirnova.php">Engadir Nova</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Consultas</a>
                        <ul>
                            <li><a href="listadeprodutos.php">Listado de produtos</a></li>
                            <li><a href="listadeusuarios.php">Listado de usuarios</a></li>
                            <li>Listado de produtos comprados</li>
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
            <section class="consulta">
                <h1 class="tituloconsulta">PRODUTOS COMPRADOS:</h1>
                <div class="filtrocategoria">
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="get">
                        <button name="vaciarcarrito">Vaciar lista</button>
                    </form>
                </div>
                <form class="busquedaproduto" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="get">
                    <input type="search" name="buscarproduto" id="buscar" placeholder="&#128269; Buscar produto"/>
                    <button>Filtrar</button>
                </form>
                <?php
                    if(isset($_GET["vaciarcarrito"])) {
                        unset($_SESSION["comprado"]);
                    } else {
                        echo "<div class='listadoprodutos'>";
                        if(isset($_SESSION["comprado"])){
                            echo "<form action='realizarpedido.php' method='post'>";
                            echo "<table><tr><th>Produto</th><th>Descrición</th><th>Cantidade</th><th>Prezo</th><th>Subtotal</th><th>Provedor</th></tr>";
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
                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Aínda non se mercou ningún produto.</div>";
                        }
                    }
                ?>
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
                <a class="axuda" href="../../gl/PHP/produtoscomprados.php">Galego</a>
                <a class="axuda" href="../../es/PHP/produtoscomprados.php">Castelán</a>
                <a class="axuda" href="https://www.aepd.es/es/politica-de-privacidad-y-aviso-legal">Política de privacidade</a>
                <a class="axuda" href="https://phylo.co/blog/traccion/que-son-los-terminos-y-condiciones/">Términos</a>
            </div>
            <div class="copyright"><p>Copyright &copy;2023. IES Maximino Romero de Lema</p></div>
        </footer>
    </body>
</html>
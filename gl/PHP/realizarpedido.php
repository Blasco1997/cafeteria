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
    <title>BAR MANOLA - REALIZAR PEDIDO</title>
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
                <div class='listadoprodutos'>
                    <?php
                        $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                        if(!$conexion) {
                            echo "<div class='avisos' style='display: block;'><img src='Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non se puido conectar á nosa base de datos. Inténteo máis tarde.</div>";
                        } else {
                            if(isset($_SESSION["comprado"])){
                                $numprodutoscomprados = count($_SESSION["comprado"]);
                                for($j=0; $j<=$numprodutoscomprados; $j++){
                                    if(isset($_POST["produto$j"]) && isset($_POST["descricion$j"]) && isset($_POST["cantidade$j"]) && isset($_POST["prezo$j"]) && 
                                    isset($_POST["subtotal$j"]) && isset($_POST["provedor$j"])) {
                                        $produto = $_POST["produto$j"];
                                        $descricion = $_POST["descricion$j"];
                                        $cantidade = $_POST["cantidade$j"];
                                        $prezo = $_POST["prezo$j"];
                                        $subtotal = $_POST["subtotal$j"];
                                        $provedor = $_POST["provedor$j"];
                                        $existeproduto = "SELECT * FROM produtos WHERE Produto = '$produto'";
                                        $resultado = $conexion->query($existeproduto);
                                        if($resultado->num_rows==0){
                                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non existe o produto $produto.</div>";
                                        } else {
                                            $row = $resultado->fetch_assoc();
                                            $idproduto = $row["Id_Produto"];
                                            $existeprovedor = "SELECT * FROM provedores WHERE Provedor = '$provedor'";
                                            $resultado = $conexion->query($existeprovedor);
                                            if($resultado->num_rows==0){
                                                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non existe o provedor $provedor.</div>";
                                            } else {
                                                $row = $resultado->fetch_assoc();
                                                $idprovedor = $row["Id_Provedor"];
                                                $existeempregado = "SELECT * FROM empregados WHERE Nome_completo = '".$_SESSION["usuario"]."'";
                                                $resultado = $conexion->query($existeempregado);
                                                if($resultado->num_rows==0){
                                                    echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non existe o empregado ".$_SESSION["usuario"].".</div>";
                                                } else {
                                                    $row = $resultado->fetch_assoc();
                                                    $idempregado = $row["Id_Empregado"];
                                                    $rexistrarpedidos = "INSERT INTO pedidos(Data_Pedido, Id_Produto, Id_Provedor, Id_Empregado, Stock_Engadir)
                                                    VALUES (CURDATE(), '$idproduto', '$idprovedor', '$idempregado', '$cantidade')";
                                                    if($conexion->query($rexistrarpedidos)==true){
                                                        echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/correcto.png' width='100%' alt='Aviso'/>Pedido do produto $produto rexistrado correctamente. <a href='pedidosrealizados.php'>Ir á sección de pedidos realizados</a>.</div>";
                                                    } else if($conexion->query($rexistrarpedidos)==false) {
                                                        echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non se puido rexistrar o pedido do produto $produto.</div>";
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    ?>
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
                <a class="axuda" href="../../gl/PHP/realizarpedido.php">Galego</a>
                <a class="axuda" href="../../es/PHP/realizarpedido.php">Castelán</a>
                <a class="axuda" href="https://www.aepd.es/es/politica-de-privacidad-y-aviso-legal">Política de privacidade</a>
                <a class="axuda" href="https://phylo.co/blog/traccion/que-son-los-terminos-y-condiciones/">Términos</a>
            </div>
            <div class="copyright"><p>Copyright &copy;2023. IES Maximino Romero de Lema</p></div>
        </footer>
    </body>
</html>
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
    <title>BAR MANOLA - Detalles do produto seleccionado</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="<?php echo (CSSPATH . "$css" );?>">
    <script src="../JavaScript/jQuery/jquery-3.6.3.js" type="text/javascript"></script>
</head>
    <body>
        <header>
            <div id="logoytitulo">
                <a href="index-es.html"><img src="../Imaxes/Xerais/Logo_Cafetería.png" width="100%" alt="Bar Manola"/></a>
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
                            <li>Listado de produtos</li>
                            <li><a href="listadeusuarios.php">Listado de usuarios</a></li>
                            <li><a href="produtoscomprados.php">Listado de produtos comprados</a></li>
                            <li><a href="pedidosrealizados.php">Pedidos realizados</a></li>
                            <li><a href="listadeempregados.php">Listado de empregados</a></li>
                            <li><a href="listadepratos.php">Listado de pratos</a></li>
                            <li><a href="listademenus.php">Listado de menús</a></li>
                            <li><a href="listadereservas.php">Listado de reservas</a></li>
                            <li><a href="listadeprovedores.php">Lista de provedores</a></li>
                            <li><a href="listadenovas.php">Lista de novas</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
        <hr>
        <main>
            <section id="detallesproduto">
                <?php
                    $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                    if(!$conexion) {
                        echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non se puido conectar á nosa base de datos. Inténteo máis tarde.</div>";
                    } else {
                        $numprodutos = "SELECT COUNT(Id_Produto) AS NumProdutos FROM produtos";
                        $resultado = $conexion->query($numprodutos);
                        if($resultado->num_rows==0){
                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Sen produtos que mostrar.</div>";
                        } else {
                            $row = $resultado->fetch_assoc();
                            $totalprodutos = $row["NumProdutos"];
                            for($j=1; $j<=$totalprodutos; $j++){
                                if(isset($_GET["foto$j"]) && isset($_GET["produto$j"]) && isset($_GET["descricion$j"]) && isset($_GET["stock$j"]) && isset($_GET["prezo$j"])){
                                    $foto = $_GET["foto$j"];
                                    $produto = $_GET["produto$j"];
                                    $descricion = $_GET["descricion$j"];
                                    $stock = $_GET["stock$j"];
                                    $prezo = $_GET["prezo$j"];
                                    $verproduto = "SELECT pr.Foto AS Foto, pr.Produto AS Produto, pr.Descrición AS Descrición, pr.Stock AS Stock, pr.Prezo AS Prezo,
                                    pv.Logo AS LogoProvedor, pv.Provedor AS Empresa FROM produtos AS pr JOIN provedores AS pv ON pr.Id_Provedor = pv.Id_Provedor
                                    WHERE pr.Produto = '$produto'";
                                    $resultado = $conexion->query($verproduto);
                                    if($resultado->num_rows==0){
                                        echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non existe o produto $produto.</div>";
                                    } else {
                                        $row = $resultado->fetch_assoc();
                                        echo "<div class='detallefoto'><img src='{$row["Foto"]}' width='100%' alt='Foto'/></div>";
                                        echo "<h1 class='titleproduto'>{$row["Produto"]}</h1><p class='descproduto'>{$row["Descrición"]}</p>";
                                        if($row["Stock"]==0){
                                            echo "<h3 class='stockproduto' style='color: red;'><img src='../Imaxes/Xerais/aviso.png' width='50' alt='Aviso'/>ESGOTADO</h3>";
                                        } else if($row["Stock"]<10) {
                                            echo "<h3 class='stockproduto'style='color: red;'>Só quedan {$row["Stock"]} uds en stock</h3>";
                                        } else {
                                            echo "<h3 class='stockproduto' style='color: green;'>{$row["Stock"]} uds en stock</h3>";
                                        }
                                        echo "<h2 class='prezoproduto'>{$row["Prezo"]} €</h2>
                                        <figure class='provedorproduto'>
                                            <img src='{$row["LogoProvedor"]}' width='100%' alt='Empresa'/>
                                            <figcaption>{$row["Empresa"]}</figcaption>
                                        </figure>
                                        <form class='formulariomercar' action='mercarunidades.php' method='post'>
                                            <h3>REALIZAR PEDIDO</h3><br/>
                                            <input type='hidden' name='produto' value='{$row["Produto"]}'/>
                                            <input type='hidden' name='descproduto' value='{$row["Descrición"]}'/>
                                            <input type='hidden' name='stockproduto' value='{$row["Stock"]}'/>
                                            <input type='hidden' name='prezoproduto' value='{$row["Prezo"]}'/>
                                            <input type='hidden' name='provedorproduto' value='{$row["Empresa"]}'/>
                                            <label for='cantidade'>Cantidade: </label>
                                            <input type='number' min='0' name='cantidade'/><br/><br/>
                                            <button>MERCAR AO PROVEDOR</button>
                                        </form>";
                                    }
                                }
                            }
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
                <a class="axuda" href="../../gl/PHP/verproduto.php">Galego</a>
                <a class="axuda" href="../../es/PHP/verproduto.php">Castelán</a>
                <a class="axuda" href="https://www.aepd.es/es/politica-de-privacidad-y-aviso-legal">Política de privacidade</a>
                <a class="axuda" href="https://phylo.co/blog/traccion/que-son-los-terminos-y-condiciones/">Términos</a>
            </div>
            <div class="copyright"><p>Copyright &copy;2023. IES Maximino Romero de Lema</p></div>
        </footer>
    </body>
</html>
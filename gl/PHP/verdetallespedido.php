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
    <title>BAR MANOLA - Ver detalles do pedido</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="<?php echo (CSSPATH . "$css" );?>">
    <script src="../JavaScript/jQuery/jquery-3.6.3.js" type="text/javascript"></script>
</head>
    <body>
        <header>
            <div id="logoytitulo">
                <a href="indexempregados.php"><img src="../Imaxes/Xerais/Logo_Cafetería.png" width="100%" alt="Bar Manola"/></a>
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
                            <li><a href="produtoscomprados.php">Listado de produtos comprados</a></li>
                            <li>Pedidos realizados</li>
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
                <h1 class="tituloconsulta">VER DETALES DO PEDIDO:</h1>
                <div class="filtrocategoria"></div>
                <?php
                    if(isset($_GET["datapedido"])){
                        $datapedido = $_GET["datapedido"];
                        $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                        if(!$conexion) {
                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non se puido conectar á nosa base de datos. Inténteo máis tarde.</div>";
                        } else {
                            $verdetallespedido = "SELECT pd.Id_Pedido AS Id_Pedido, pd.Data_Pedido AS Data_Pedido, pr.Produto AS Produto, em.Nome_completo AS Empregado, pv.Provedor AS Provedor, pd.Stock_Engadir AS Stock_Engadir 
                            FROM pedidos AS pd JOIN produtos AS pr JOIN empregados AS em JOIN provedores AS pv ON pd.Id_Produto = pr.Id_Produto AND pd.Id_Empregado = em.Id_Empregado
                            AND pd.Id_Provedor = pv.Id_Provedor WHERE pd.Data_Pedido = '$datapedido' AND em.Nome_completo ='".$_SESSION["usuario"]."'";
                            $resultados = $conexion->query($verdetallespedido);
                            if($resultados->num_rows==0) {
                                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non hai pedidos realizados no dia $datapedido.</div>";
                            } else {
                                if(isset($_GET["pg"])) {
                                    $paginacion = $_GET["pg"];
                                    if($paginacion<=0 || is_numeric($paginacion)==false) $paginacion=1;
                                }
                                else
                                $paginacion=1;
                                $url="listadereservas.php?verdetallespedido&pg=";  
                                echo "<p class='pagina'>";
                                if($paginacion>1)
                                    echo "<a href='$url".($paginacion-1)."'>&lt;&lt;Anterior</a>";
                                $total_paginas=(int)($resultados->num_rows/12+1);
                                for($i=1;$i<=$total_paginas;$i++){
                                    if($i==$paginacion)
                                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$i&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                    else
                                        echo "<a href='$url".$i."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$i&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>";
                                }
                                if($paginacion<$total_paginas)
                                    echo "<a href='$url".($paginacion+1)."'>Seguinte&gt;&gt;</a>";
                                echo "</p>";
                                $posicion=($paginacion-1)*12;
                                $resultados->data_seek($posicion);
                                $cont=1;
                                $j=1;
                                $row=$resultados->fetch_assoc();
                                echo "<div class='listadoprodutos'>";
                                echo "<table><tr><th>Produto</th><th>Provedor</th><th>Unidades Mercadas</th><th>Opciones</th></tr>";
                                while($row && $cont<=12){
                                    echo "<tr><td>{$row["Produto"]}</td><td>{$row["Provedor"]}</td><td>{$row["Stock_Engadir"]}</td>
                                    <td><form action='".htmlentities($_SERVER["PHP_SELF"])."' method='get'>
                                    <input type='hidden' name='data' value='$datapedido'/>
                                    <input type='hidden' name='idpedido$j' value='{$row["Id_Pedido"]}'/>
                                    <input type='hidden' name='produto$j' value='{$row["Produto"]}'/>
                                    <input type='hidden' name='unidadesengadidas$j' value='{$row["Stock_Engadir"]}'/>
                                    <button>Repoñer unidades</button>
                                    </form></td></tr>";
                                    $row=$resultados->fetch_assoc();
                                    $cont++;
                                    $j++;
                                }
                                echo "</table></div>";
                            }
                        }
                    }
                ?>
                <?php
                    if(isset($_GET["data"])){
                        $data = $_GET["data"];
                        $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                        if(!$conexion) {
                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non se puido conectar á nosa base de datos. Inténteo máis tarde.</div>";
                        } else {
                            $numprodutospedido = "SELECT COUNT(pd.Id_Produto) AS Id_Produto FROM pedidos AS pd JOIN produtos AS pr JOIN empregados AS em ON pd.Id_Produto = pr.Id_Produto AND pd.Id_Empregado = em.Id_Empregado
                            WHERE pd.Data_Pedido = '$data' AND em.Nome_completo ='".$_SESSION["usuario"]."'";
                            $resultado = $conexion->query($numprodutospedido);
                            if($resultado->num_rows==0) {
                                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non hai pedidos realizados no dia $data.</div>";
                            } else {
                                $row = $resultado->fetch_assoc();
                                $totalpedidosproduto = $row["Id_Produto"];
                                for($j=1; $j<=$totalpedidosproduto; $j++){
                                    if(isset($_GET["idpedido$j"]) && isset($_GET["produto$j"]) && isset($_GET["unidadesengadidas$j"])){
                                        $idpedido = $_GET["idpedido$j"];
                                        $produto = $_GET["produto$j"];
                                        $unidadesengadidas = $_GET["unidadesengadidas$j"];
                                        $existeproduto = "SELECT * FROM produtos WHERE Produto = '$produto'";
                                        if($resultado->num_rows==0) {
                                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non existe o produto $produto.</div>";
                                        } else {
                                            $row = $resultado->fetch_assoc();
                                            $reponerstock = "UPDATE produtos SET Stock = Stock + $unidadesengadidas WHERE Produto = '$produto'";
                                            if($conexion->query($reponerstock)==true){
                                                $borrarproduto = "DELETE FROM pedidos WHERE Id_Pedido = '$idpedido'";
                                                if($conexion->query($borrarproduto)==true){
                                                    echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/correcto.png' width='100%' alt='Aviso'/>$unidadesengadidas unidades do produto $produto repostas.</div>";
                                                } else if($conexion->query($borrarproduto)==false){
                                                    echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non se puido eliminar o pedido $idpedido do día $data.</div>";
                                                }
                                            } else if($conexion->query($reponerstock)==false){
                                                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non se puideron repoñer as unidades do produto $produto.</div>";
                                            }
                                        }    
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
                <a class="axuda" href="../../gl/PHP/verdetallespedido.php">Galego</a>
                <a class="axuda" href="../../es/PHP/verdetallespedido.php">Castelán</a>
                <a class="axuda" href="https://www.aepd.es/es/politica-de-privacidad-y-aviso-legal">Política de privacidade</a>
                <a class="axuda" href="https://phylo.co/blog/traccion/que-son-los-terminos-y-condiciones/">Términos</a>
            </div>
            <div class="copyright"><p>Copyright &copy;2023. IES Maximino Romero de Lema</p></div>
        </footer>
    </body>
</html>
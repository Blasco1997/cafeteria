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
    <title>BAR MANOLA - Listado de produtos</title>
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
                            <li>Listado de produtos</li>
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
            <section class="consulta">
                <h1 class="tituloconsulta">LISTADO DE PRODUTOS:</h1>
                <div class="filtrocategoria"></div>
                <form class="busquedaproduto" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="get">
                    <input type="search" name="buscarproduto" id="buscar" placeholder="&#128269; Buscar produto"/>
                    <button>Filtrar</button>
                </form>
                <?php
                    $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                    if(!$conexion) {
                        echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se puido conectar a nosa base de datos. Inténteo máis tarde.</div>";
                    } else {
                        $numprodutos = "SELECT COUNT(Id_Produto) AS NumProdutos FROM produtos";
                        $resultado = $conexion->query($numprodutos);
                        if($resultado->num_rows==0){
                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Aínda non hai produtos publicados.</div>";
                        } else {
                            $row = $resultado->fetch_assoc();
                            $totalprodutos = $row["NumProdutos"];
                            for($j=1; $j<=$totalprodutos; $j++){
                                if(isset($_POST["nomeanteriorproduto"]) && isset($_POST["produto"]) && isset($_POST["descricion"]) && isset($_POST["categoria"]) &&
                                isset($_POST["stock"]) && isset($_POST["prezo"]) && isset($_POST["imaxe"]) && isset($_POST["gardarcambios"])){
                                    $nomeanteriorproduto = $_POST["nomeanteriorproduto"];
                                    $produto = $_POST["produto"];
                                    $descricion = $_POST["descricion"];
                                    $categoria = $_POST["categoria"];
                                    $stock = $_POST["stock"];
                                    $prezo = $_POST["prezo"];
                                    $imaxe = $_POST["imaxe"];
                                    $existeproduto = "SELECT * FROM produtos WHERE Produto = '$nomeanteriorproduto'";
                                    $resultado = $conexion->query($existeproduto);
                                    if($resultado->num_rows==0){
                                        echo "";
                                    } else {
                                        $row = $resultado->fetch_assoc();
                                        $idproduto = $row["Id_Produto"];
                                        $actualizarproduto = "UPDATE produtos SET Produto = '$produto', Descrición = '$descricion', Tipo = '$categoria', Stock = '$stock', Prezo = '$prezo' WHERE Produto = '$nomeanteriorproduto'";
                                        if($conexion->query($actualizarproduto)==true){
                                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/correcto.png' width='100%' alt='Aviso'/>Produto actualizado correctamente.</div>";
                                        } else if($conexion->query($actualizarproduto)==false){
                                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Por motivos técnicos non se puido actualizar o produto $produto.</div>";
                                        }
                                    }
                                }
                                if(isset($_POST["produto"]) && isset($_POST["descricion"]) && isset($_POST["categoria"]) &&
                                isset($_POST["stock"]) && isset($_POST["prezo"]) && isset($_POST["imaxe"]) && isset($_POST["eliminarproduto"])){
                                    $produto = $_POST["produto"];
                                    $descricion = $_POST["descricion"];
                                    $categoria = $_POST["categoria"];
                                    $stock = $_POST["stock"];
                                    $prezo = $_POST["prezo"];
                                    $imaxe = $_POST["imaxe"];
                                    $existeproduto = "SELECT * FROM produtos WHERE Produto = '$produto'";
                                    $resultado = $conexion->query($existeproduto);
                                    if($resultado->num_rows==0){
                                        echo "";
                                    } else {
                                        $row = $resultado->fetch_assoc();
                                        $idproduto = $row["Id_Produto"];
                                        $eliminarproduto = "DELETE FROM produtos WHERE Id_Produto = $idproduto";
                                        if($conexion->query($eliminarproduto)==true){
                                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/correcto.png' width='100%' alt='Aviso'/>Produto eliminado correctamente.</div>";
                                        } else if($conexion->query($eliminarproduto)==false){
                                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Por motivos técnicos non se puido eliminar o produto $produto.</div>";
                                        }
                                    }
                                }
                            }
                        }
                    }
                ?>
                <form id="edicion" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
                    <span class="material-symbols-outlined" id="cerrarformulario">close</span>
                    <script>
                        let cerrarformulario = document.getElementById("cerrarformulario");
                        cerrarformulario.addEventListener("click", function(){
                            let edicion = document.getElementById("edicion");
                            edicion.style.display = "none";
                        });
                    </script>
                    <div class="campoprodutoh1">
                        <h1>MODIFICAR PRODUTO</h1>
                    </div>
                    <input type="hidden" name="nomeanteriorproduto" id="nomeanteriorproduto"/>
                    <div class="campoproduto">
                        <label for="produto">Novo nome do produto:</label>
                        <input type="text" name="produto" id="produto"/>
                    </div>
                    <div class="campoproduto">
                        <label for="descricion">Descrición:</label>
                        <textarea name="descricion" id="descricion"></textarea>
                    </div><br/>
                    <div class="campoproduto">
                        <label for="categoria">Categoría:</label>
                        <select name="categoria" id="categoria">
                            <option selected="selected">Seleccione categoría</option>
                            <option value="Varios">Varios</option>
                            <option value="Bebida">Bebida</option>
                            <option value="Outros">Outros</option>
                        </select>
                    </div>
                    <div class="campoproduto">
                        <label for="stock">Stock:</label>
                        <input type="number" name="stock" id="stock" min="0"/><p>uds</p>
                    </div>
                    <div class="campoproduto">
                        <label for="prezo">Prezo:</label>
                        <input type="number" step="0.01" name="prezo" id="prezo" min="0"/><p>€</p>
                    </div><br/>
                    <div class="campoproduto">
                        <label for="imaxe">Imaxe:</label>
                        <input type="file" name="imaxe" id="seleccionArchivos" accept="image/*">
                        <br><br>
                        <!-- A imaxe que imos usar para previsualizar o que o usuario seleccione -->
                        <img id="imagenPrevisualizacion">
                        <script type="text/javascript" src="subirimagen.js"></script>
                    </div>
                    <div class="campoproduto">
                        <button id="engadir" name="gardarcambios">GARDAR CAMBIOS</button>
                        <button id="eliminar" name="eliminarproduto">ELIMINAR PRODUTO</button>
                    </div>
                </form>
                <?php
                    if(isset($_GET["buscarproduto"])){
                        $produto = $_GET["buscarproduto"];
                        $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                        if(!$conexion) {
                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non se puido conectar á nosa base de datos. Inténteo máis tarde.</div>";
                        } else {
                            $buscarproduto = "SELECT pr.Id_Produto AS Id_Produto, pr.Foto AS Foto, pr.Produto AS Produto, pr.Descrición AS Descrición, pr.Stock AS Stock,
                            pr.Prezo AS Prezo, pv.Provedor AS Provedor FROM produtos AS pr JOIN provedores AS pv ON pr.Id_Provedor = pv.Id_Provedor
                            WHERE Produto LIKE '%$produto%'";
                            $resultados = $conexion->query($buscarproduto);
                            if($resultados->num_rows==0) {
                                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non hai ningún produto que conteña os caracteres $produto.</div>";
                            } else {
                                if(isset($_GET["pg"])) {
                                    $paginacion = $_GET["pg"];
                                    if($paginacion<=0 || is_numeric($paginacion)==false) $paginacion=1;
                                }
                                else
                                $paginacion=1;
                                $url="listadeprodutos.php?buscarproduto=$produto&pg=";  
                                echo "<p class='pagina'>";
                                if($paginacion>1)
                                    echo "<a href='$url".($paginacion-1)."'>&lt; Anterior</a>";
                                $total_paginas=(int)($resultados->num_rows/12+1);
                                for($i=1;$i<=$total_paginas;$i++){
                                    if($i==$paginacion)
                                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$i&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;S";
                                    else
                                        echo "<a href='$url".$i."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$i&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>";
                                }
                                if($paginacion<$total_paginas)
                                    echo "<a href='$url".($paginacion+1)."'>Seguinte &gt;</a>";
                                echo "</p>";
                                $posicion=($paginacion-1)*12;
                                $resultados->data_seek($posicion);
                                $cont=1;
                                $j=1;
                                $row=$resultados->fetch_assoc();
                                echo "<div class='listadoprodutos'>";
                                echo "<table><tr><th>Foto</th><th>Produto</th><th>Descrición</th><th>Stock</th><th>Prezo</th><th>Venta</th><th>Opcións</th></tr>";
                                while($row && $cont<=12){
                                    echo "<tr><td id='imaxe$j'><input type='hidden' name='imaxe' value='{$row["Foto"]}'/><img src='{$row["Foto"]}' width='70' alt='Produto'/></td>
                                    <td id='produto$j'><input type='hidden' name='produto' value='{$row["Produto"]}'/>{$row["Produto"]}</td>
                                    <td id='descricion$j'><input type='hidden' name='descricion' value='{$row["Descrición"]}'/>{$row["Descrición"]}</td>
                                    <td id='stock$j'><input type='hidden' name='stock' value='{$row["Stock"]}'/>{$row["Stock"]} uds</td>
                                    <td id='prezo$j'><input type='hidden' name='prezo' value='{$row["Prezo"]}'/>{$row["Prezo"]} €</td>
                                    <td><form action='venderunidades.php' method='post'><input type='hidden' name='produto$j' value='{$row["Produto"]}'/><input type='number' min='0' max='{$row["Stock"]}' style='width: 60px;' name='unidades$j'/><button>Vender</button></form></td>
                                    <td><form action='verproduto.php' method='get'>
                                        <input type='hidden' name='foto$j' value='{$row["Foto"]}'/>
                                        <input type='hidden' name='produto$j' value='{$row["Produto"]}'/>
                                        <input type='hidden' name='descricion$j' value='{$row["Descrición"]}'/>
                                        <input type='hidden' name='stock$j' value='{$row["Stock"]}'/>
                                        <input type='hidden' name='prezo$j' value='{$row["Prezo"]}'/>
                                        <button class='details'><span class='material-symbols-outlined'>details</span></button>
                                    </form>
                                    <button class='editnote' id='modificarproduto$j'><span class='material-symbols-outlined'>edit_note</span></button></td></tr>";
                                    echo "<script>
                                        let modificarproduto$j = document.getElementById('modificarproduto$j');
                                        modificarproduto$j.addEventListener('click', function(){
                                            let edicion = document.getElementById('edicion');
                                            edicion.style.display = 'block';
                                            document.getElementById('nomeanteriorproduto').value = '{$row["Produto"]}';
                                            document.getElementById('produto').value = '{$row["Produto"]}';
                                            document.getElementById('descricion').value = '{$row["Descrición"]}';
                                            document.getElementById('stock').value = '{$row["Stock"]}';
                                            document.getElementById('prezo').value = '{$row["Prezo"]}';
                                            document.getElementById('imaxe').value = '{$row["Foto"]}';
                                        });
                                    </script>";
                                    $row=$resultados->fetch_assoc();
                                    $cont++;
                                    $j++;
                                }
                                echo "</table></div>";
                            }
                        }
                    } else {
                        $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                        if(!$conexion) {
                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non se puido conectar á nosa base de datos. Inténteo máis tarde.</div>";
                        } else {
                            $listarprodutos = "SELECT pr.Id_Produto AS Id_Produto, pr.Foto AS Foto, pr.Produto AS Produto, pr.Descrición AS Descrición, pr.Stock AS Stock,
                            pr.Prezo AS Prezo, pv.Provedor AS Provedor FROM produtos AS pr JOIN provedores AS pv ON pr.Id_Provedor = pv.Id_Provedor";
                            $resultados = $conexion->query($listarprodutos);
                            if($resultados->num_rows==0) {
                                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Aínda non hai produtos publicados.</div>";
                            } else {
                                if(isset($_GET["pg"])) {
                                    $paginacion = $_GET["pg"];
                                    if($paginacion<=0 || is_numeric($paginacion)==false) $paginacion=1;
                                }
                                else
                                $paginacion=1;
                                $url="listadeprodutos.php?produtos&pg=";  
                                echo "<p class='pagina'>";
                                if($paginacion>1)
                                    echo "<a href='$url".($paginacion-1)."'>&lt; Anterior</a>";
                                $total_paginas=(int)($resultados->num_rows/12+1);
                                for($i=1;$i<=$total_paginas;$i++){
                                    if($i==$paginacion)
                                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$i&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                    else
                                        echo "<a href='$url".$i."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$i&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>";
                                }
                                if($paginacion<$total_paginas)
                                    echo "<a href='$url".($paginacion+1)."'>Seguinte &gt;</a>";
                                echo "</p>";
                                $posicion=($paginacion-1)*12;
                                $resultados->data_seek($posicion);
                                $cont=1;
                                $j=1;
                                $row=$resultados->fetch_assoc();
                                echo "<div class='listadoprodutos'>";
                                echo "<table><tr><th>Foto</th><th>Produto</th><th>Descrición</th><th>Stock</th><th>Prezo</th><th>Venta</th><th>Opcións</th></tr>";
                                while($row && $cont<=12){  
                                    echo "<tr><td id='imaxe$j'><input type='hidden' name='imaxe' value='{$row["Foto"]}'/><img src='{$row["Foto"]}' width='70' alt='Produto'/></td>
                                    <td id='produto$j'><input type='hidden' name='produto' value='{$row["Produto"]}'/>{$row["Produto"]}</td>
                                    <td id='descricion$j'><input type='hidden' name='descricion' value='{$row["Descrición"]}'/>{$row["Descrición"]}</td>
                                    <td id='stock$j'><input type='hidden' name='stock' value='{$row["Stock"]}'/>{$row["Stock"]} uds</td>
                                    <td id='prezo$j'><input type='hidden' name='prezo' value='{$row["Prezo"]}'/>{$row["Prezo"]} €</td>
                                    <td><form action='venderunidades.php' method='post'><input type='hidden' name='produto$j' value='{$row["Produto"]}'/><input type='number' min='0' max='{$row["Stock"]}' style='width: 60px;' name='unidades$j'/><button>Vender</button></form></td>
                                    <td><form action='verproduto.php' method='get'>
                                        <input type='hidden' name='foto$j' value='{$row["Foto"]}'/>
                                        <input type='hidden' name='produto$j' value='{$row["Produto"]}'/>
                                        <input type='hidden' name='descricion$j' value='{$row["Descrición"]}'/>
                                        <input type='hidden' name='stock$j' value='{$row["Stock"]}'/>
                                        <input type='hidden' name='prezo$j' value='{$row["Prezo"]}'/>
                                        <button class='details'><span class='material-symbols-outlined'>details</span></button>
                                    </form>
                                    <button class='editnote' id='modificarproduto$j'><span class='material-symbols-outlined'>edit_note</span></button></td></tr>";
                                    echo "<script>
                                        let modificarproduto$j = document.getElementById('modificarproduto$j');
                                        modificarproduto$j.addEventListener('click', function(){
                                            let edicion = document.getElementById('edicion');
                                            edicion.style.display = 'block';
                                            document.getElementById('nomeanteriorproduto').value = '{$row["Produto"]}';
                                            document.getElementById('produto').value = '{$row["Produto"]}';
                                            document.getElementById('descricion').value = '{$row["Descrición"]}';
                                            document.getElementById('stock').value = '{$row["Stock"]}';
                                            document.getElementById('prezo').value = '{$row["Prezo"]}';
                                            document.getElementById('imaxe').value = '{$row["Foto"]}';
                                        });
                                    </script>";
                                    $row=$resultados->fetch_assoc();
                                    $cont++;
                                    $j++;
                                }
                                echo "</table></div>";
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
                <a class="axuda" href="../../gl/PHP/listadeprodutos.php">Galego</a>
                <a class="axuda" href="../../es/PHP/listadeprodutos.php">Castelán</a>
                <a class="axuda" href="https://www.aepd.es/es/politica-de-privacidad-y-aviso-legal">Política de privacidade</a>
                <a class="axuda" href="https://phylo.co/blog/traccion/que-son-los-terminos-y-condiciones/">Términos</a>
            </div>
            <div class="copyright"><p>Copyright &copy;2023. IES Maximino Romero de Lema</p></div>
        </footer>
    </body>
</html>
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
    <title>BAR MANOLA - Engadir produto</title>
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
                        <li>Engadir Produto</li>
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
        <section id="acceso">
            <form class="login" action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>" method="post">
                <?php
                    if(isset($_POST["produto"]) && isset($_POST["descricion"]) 
                    && isset($_POST["categoria"]) && isset($_POST["stock"])
                    && isset($_POST["prezo"]) && isset($_POST["provedor"]) || isset($_POST["imaxe"])) {
                        $imaxe = $_POST["imaxe"];
                        $produto = $_POST["produto"];
                        $descricion = $_POST["descricion"];
                        $categoria = $_POST["categoria"];
                        $stock = $_POST["stock"];
                        $prezo = $_POST["prezo"];
                        $provedor = $_POST["provedor"];
                        $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                        if(!$conexion) {
                            echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non se puido conectar á nosa base de datos. Inténteo máis tarde.";
                        } else {
                            $existeprovedor = "SELECT Id_Provedor FROM provedores WHERE Provedor = '$provedor'";
                            $resultado = $conexion->query($existeprovedor);
                            if($resultado->num_rows==0){
                                echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non existe o provedor $provedor ou ainda non está rexistrado na sección de provedores.";
                            } else {
                                $row = $resultado->fetch_assoc();
                                $idprovedor = $row["Id_Provedor"];
                                $rexistro = "INSERT INTO produtos(Foto, Produto, Descrición, Tipo, Stock, Prezo, Id_Provedor) 
                                VALUES ('../Imaxes/Produtos/$categoria/$imaxe', '$produto', '$descricion', '$categoria', $stock, $prezo, $idprovedor)";
                                if($conexion->query($rexistro)==true) {
                                    echo "<img class='correcto' src='../Imaxes/Xerais/correcto.png' width='100%' alt='Aviso'/>Produto $produto rexistrado correctamente.";
                                } else if($conexion->query($rexistro)==false) {
                                    echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non se puido rexistrar o produto $produto.";
                                }
                            }
                        }  
                    }
                ?>
                <div class="campo">
                    <h1>ENGADIR PRODUTO</h1>
                </div>
                <div class="campo">
                    <label for="produto">Produto:</label>
                    <input type="text" name="produto" id="produto"/>
                </div><br/>
                <div class="campo">
                    <label for="descricion">Descrición:</label>
                    <textarea name="descricion" id="descricion"></textarea>
                </div>
                <div class="campo">
                    <label for="categoria">Categoría:</label>
                    <select name="categoria" id="categoria">
                        <option selected="selected">Seleccione categoría</option>
                        <option value="Varios">Varios</option>
                        <option value="Bebida">Bebida</option>
                        <option value="Outros">Outros</option>
                    </select>
                </div>
                <div class="campo">
                    <label for="stock">Stock:</label>
                    <input type="number" name="stock" id="stock" min="0"/><p>uds</p>
                </div><br/>
                <div class="campo">
                    <label for="prezo">Prezo:</label>
                    <input type="number" step="0.01" name="prezo" id="prezo" min="0"/><p>€</p>
                </div><br/>
                <div class="campo">
                    <label for="provedor">Provedor:</label>
                    <select name="provedor" id="provedor">
                        <option selected="selected">----Seleccione provedor----</option>
                        <?php
                            $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                            if(!$conexion) {
                                echo "<option>ERROR: DATABASE_NOT_CONNECTED</option>";
                            } else {
                                $listaprovedores = "SELECT Provedor FROM provedores";
                                $resultados = $conexion->query($listaprovedores);
                                if($resultados->num_rows==0) {
                                    echo "<option>(Sen provedores)</option>";
                                } else {
                                    $row = $resultados->fetch_assoc();
                                    while($row) {
                                        echo "<option>{$row["Provedor"]}</option>";
                                        $row = $resultados->fetch_assoc();
                                    }
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="campo">
                    <label for="imaxe">Imaxe:</label>
                    <input type="file" name="imaxe" id="seleccionArchivos" accept="image/*">
                    <br><br>
                    <!-- A imaxe que imos usar para previsualizar o que o usuario seleccione -->
                    <img id="imagenPrevisualizacion">
                    <script type="text/javascript" src="../JavaScript/subirimagen.js"></script>
                </div>
                <div class="campo">
                    <button id="engadir">ENGADIR</button>
                </div>
            </form>
            <div class="avisos"></div>
            <script type="text/javascript" src="../JavaScript/engadirproduto.js"></script>
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
            <a class="axuda" href="../../gl/PHP/engadirproduto.php">Galego</a>
            <a class="axuda" href="../../es/PHP/engadirproduto.php">Castelán</a>
            <a class="axuda" href="https://www.aepd.es/es/politica-de-privacidad-y-aviso-legal">Política de privacidade</a>
            <a class="axuda" href="https://phylo.co/blog/traccion/que-son-los-terminos-y-condiciones/">Términos</a>
        </div>
        <div class="copyright"><p>Copyright &copy;2023. IES Maximino Romero de Lema</p></div>
    </footer>
</body>
</html>
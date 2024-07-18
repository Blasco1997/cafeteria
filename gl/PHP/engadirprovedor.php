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
    <title>BAR MANOLA - Engadir Provedor</title>
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
                            <li>Engadir Provedor</li>
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
                            <li><a href="listadenovas.php">Lista de novas</a></li>
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
                        if(isset($_POST["provedor"]) && isset($_POST["direccion"])
                        && isset($_POST["telefono"]) && isset($_POST["paginaweb"]) || isset($_POST["imaxe"])) {
                            $imaxe = $_POST["imaxe"];
                            $provedor = $_POST["provedor"];
                            $direccion = $_POST["direccion"];
                            $telefono = $_POST["telefono"];
                            $paginaweb = $_POST["paginaweb"];
                            $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                            if(!$conexion) {
                                echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non se puido conectar á nosa base de datos. Inténteo máis tarde.";
                            } else {
                                $rexistro = "INSERT INTO provedores(Logo, Provedor, Dirección, Teléfono, Páxina_web) 
                                VALUES('../Imaxes/Provedores/$imaxe', '$provedor', '$direccion', '$telefono', '$paginaweb')";
                                if($conexion->query($rexistro)==true) {
                                    echo "<img class='correcto' src='../Imaxes/Xerais/correcto.png' width='100%' alt='Aviso'/>Provedor $proveedor contratado con éxito.";
                                } else if($conexion->query($rexistro)==false) {
                                    echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non se puido contratar ao provedor $proveedor.";
                                }
                            }
                        } 
                    ?>
                    <div class="campo">
                        <h1>REXISTRAR PROVEDOR</h1>
                    </div>
                    <div class="campo">
                        <label for="imaxe">Logo:</label>
                        <input type="file" name="imaxe" id="seleccionArchivos" accept="image/*">
                        <br><br>
                        <!-- A imaxe que imos usar para previsualizar o que o usuario seleccione -->
                        <img id="imagenPrevisualizacion">
                        <script type="text/javascript" src="../JavaScript/subirimagen.js"></script>
                    </div><br/>
                    <div class="campo">
                        <label for="provedor">Provedor:</label>
                        <input type="text" name="provedor" id="provedor"/>
                    </div><br/>
                    <div class="campo">
                        <label for="direccion">Dirección:</label>
                        <input type="text" name="direccion" id="direccion"/>
                    </div><br/>
                    <div class="campo">
                        <label for="telefono">Teléfono:</label>
                        <input type="tel" name="telefono" id="telefono"/>
                    </div><br/>
                    <div class="campo">
                        <label for="paxinaweb">Páxina web:</label>
                        <input type="url" name="paxinaweb" id="paxinaweb"/>
                    </div><br/>
                    <div class="campo">
                        <button id="engadir">CONTRATAR</button>
                    </div>
                </form>
                <div class="avisos"></div>
                <script>
                    let provedor = document.getElementById("provedor");
                    let direccion = document.getElementById("direccion");
                    let telefono = document.getElementById("telefono");
                    let paxinaweb = document.getElementById("paxinaweb");
                    let engadir = document.getElementById("engadir");
                    let avisos = document.querySelector(".avisos");
                    engadir.addEventListener("click", function(){
                        if(provedor.value=="" || direccion.value=="" || telefono.value=="" 
                        || paxinaweb.value=="") {
                            avisos.style.display = "block";
                            avisos.innerHTML = "<img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Tes algúns campos sen completar. Revísao.";
                            event.preventDefault();
                        }
                    });
                </script>
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
                <a class="axuda" href="../../gl/PHP/engadirprovedor.php">Galego</a>
                <a class="axuda" href="../../es/PHP/engadirprovedor.php">Castelán</a>
                <a class="axuda" href="https://www.aepd.es/es/politica-de-privacidad-y-aviso-legal">Política de privacidade</a>
                <a class="axuda" href="https://phylo.co/blog/traccion/que-son-los-terminos-y-condiciones/">Términos</a>
            </div>
            <div class="copyright"><p>Copyright &copy;2023. IES Maximino Romero de Lema</p></div>
        </footer>
    </body>
</html>
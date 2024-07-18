<?php
    define('CSSPATH', '');
    $css = "../CSS/estilosxeraiscafeteria.css";
    session_start();
    if(!isset($_SESSION["usuario"])){
        header("location: loginempregado.php?redirixido=true");
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
    <title>BAR MANOLA - Añadir noticia</title>
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
                        <li>Añadir Noticia</li>
                    </ul>
                </li>
                <li><a href="#">Consultas</a>
                    <ul>
                        <li><a href="listadeprodutos.php">Lista de productos</a></li>
                        <li><a href="listadeusuarios.php">Lista de usuarios</a></li>
                        <li><a href="produtoscomprados.php">Lista de productos comprados</a></li>
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
        <section id="acceso">
            <form class="login" action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>" method="post">
                <?php
                    if(isset($_POST["empregado"]) && isset($_POST["titulo"]) && isset($_POST["enlace"]) 
                    && isset($_POST["data"]) || isset($_POST["imaxe"])) {
                        $imaxe = $_POST["imaxe"];
                        $titulo = $_POST["titulo"];
                        $enlace = $_POST["enlace"];
                        $data = $_POST["data"];
                        $empregado = $_POST["empregado"];
                        $conexion = new  mysqli("127.0.0.1", "root", "", "cafeteria");
                        if(!$conexion) {
                            echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo conectar a nuestra base de datos. Inténtelo más tarde.";
                        } else {
                            $existeprovedor = "SELECT Id_Empregado FROM empregados WHERE Nome_completo = '$empregado'";
                            $resultado = $conexion->query($existeprovedor);
                            if($resultado->num_rows==0){
                                echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No existe el empleado $empregado.";
                            } else {
                                $row = $resultado->fetch_assoc();
                                $idempregado = $row["Id_Empregado"];
                                $publicarnova = "INSERT INTO publicacions(Enlace, Titulo, Imaxe, Día, Id_Empregado) 
                                VALUES ('$enlace', '$titulo', '../Imaxes/Noticias/$imaxe', '$data', $idempregado)";
                                if($conexion->query($publicarnova)==true) {
                                    echo "<img class='correcto' src='../Imaxes/Xerais/correcto.png' width='100%' alt='Aviso'/>Noticia publicada correctamente.";
                                } else if($conexion->query($publicarnova)==false) {
                                    echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo publicar la noticia.";
                                }
                            }
                        }  
                    }
                ?>
                <input type="hidden" name="empregado" value="<?php echo $_SESSION["usuario"];?>"/>
                <div class="campo">
                    <h1>AÑADIR NOTICIA</h1>
                </div>
                <div class="campo">
                    <label for="titulo">Título:</label>
                    <input type="text" name="titulo" id="titulo"/>
                </div><br/>
                <div class="campo">
                    <label for="enlace">Enlace:</label>
                    <input type="text" name="enlace" id="enlace"/>
                </div><br/>
                <div class="campo">
                    <label for="data">Fecha:</label>
                    <input type="date" name="data" id="data"/>
                </div><br/>
                <div class="campo">
                    <label for="imaxe">Imagen:</label>
                    <input type="file" name="imaxe" id="seleccionArchivos" accept="image/*">
                    <br><br>
                    <!-- A imaxe que imos usar para previsualizar o que o usuario seleccione -->
                    <img id="imagenPrevisualizacion">
                    <script type="text/javascript" src="../JavaScript/subirimagen.js"></script>
                </div>
                <div class="campo">
                    <button id="engadir">PUBLICAR</button>
                </div>
            </form>
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
            <a class="axuda" href="../../gl/PHP/engadirnova.php">Gallego</a>
            <a class="axuda" href="../../es/PHP/engadirnova.php">Castellano</a>
            <a class="axuda" href="https://www.aepd.es/es/politica-de-privacidad-y-aviso-legal">Política de privacidad</a>
            <a class="axuda" href="https://phylo.co/blog/traccion/que-son-los-terminos-y-condiciones/">Términos</a>
        </div>
        <div class="copyright"><p>Copyright &copy;2023. IES Maximino Romero de Lema</p></div>
    </footer>
</body>
</html>
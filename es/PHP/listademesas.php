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
    <title>BAR MANOLA - Lista de mesas</title>
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
                            <li><a href="produtoscomprados.php">Lista de productos comprados</a></li>
                            <li><a href="pedidosrealizados.php">Pedidos realizados</a></li>
                            <li><a href="listadeempregados.php">Lista de empleados</a></li>
                            <li><a href="listadepratos.php">Lista de platos</a></li>
                            <li><a href="listademenus.php">Lista de menús</a></li>
                            <li>Lista de mesas</li>
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
            <section class="consultamesas">
                <h1 class="tituloconsulta">LISTA DE MESAS:</h1>
                <div class="filtrocategoria"></div>
                <form class="busquedaproduto" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="get">
                    <input type="search" name="buscarmesa" id="buscar" placeholder="&#128269; Buscar mesa"/>
                    <button>Filtrar</button>
                </form>
                <div class='mesas'>
                    <?php
                        $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                        if(!$conexion) {
                            echo "<div class='avisos' style='display: block;'><img src='Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo conectar a nuestra base de datos. Inténtelo más tarde.</div>";
                        } else {
                            $nummesas = "SELECT COUNT(Id_Mesa) AS NumMesas FROM mesas";
                            $resultado = $conexion->query($nummesas);
                            if($resultado->num_rows==0){
                                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Sin mesas que mostrar.</div>";
                            } else {
                                $row = $resultado->fetch_assoc();
                                $totalmesas = $row["NumMesas"];
                                for($j=1; $j<=$totalmesas; $j++){
                                    if(isset($_GET["mesaocupada$j"]) && isset($_GET["liberarmesa"])){
                                        $mesaocupada = $_GET["mesaocupada$j"];
                                        $existemesaocupada = "SELECT * FROM mesas WHERE Mesa = '$mesaocupada'";
                                        $resultado = $conexion->query($existemesaocupada);
                                        if($resultado->num_rows==0){
                                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No existe la $mesaocupada.</div>";
                                        } else {
                                            $row = $resultado->fetch_assoc();
                                            $liberarmesa = "UPDATE mesas SET Estado = 'LIBRE' WHERE Mesa = '$mesaocupada'";
                                            if($conexion->query($liberarmesa)==true){
                                                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/correcto.png' width='100%' alt='Aviso'/>$mesaocupada liberada.</div>";
                                            } else if($conexion->query($liberarmesa)==false){
                                                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo liberar la $mesaocupada.</div>";
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    ?>
                    <?php
                        if(isset($_GET["buscarmesa"])){
                            $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                            if(!$conexion) {
                                echo "<div class='avisos' style='display: block;'><img src='Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo conectar a nuestra base de datos. Inténtelo más tarde.</div>";
                            } else {
                                $mesa = $_GET["buscarmesa"];
                                $buscarmesa = "SELECT * FROM mesas WHERE Mesa LIKE '%$mesa%'";
                                $resultados = $conexion->query($buscarmesa);
                                if($resultados->num_rows==0) {
                                    echo "<div class='avisos' style='display: block;'><img src='Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No existen mesas que tengan los caracteres $mesa.</div>";
                                } else {
                                    if(isset($_GET["pg"])) {
                                        $paginacion = $_GET["pg"];
                                        if($paginacion<=0 || is_numeric($paginacion)==false) $paginacion=1;
                                    }
                                    else
                                    $paginacion=1;
                                    $url="listademesas.php?buscarmesas=$mesa&pg=";  
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
                                        echo "<a href='$url".($paginacion+1)."'>Siguiente &gt;</a>";
                                    echo "</p>";
                                    $posicion=($paginacion-1)*12;
                                    $resultados->data_seek($posicion);
                                    $cont=1;
                                    $j=1;
                                    $row=$resultados->fetch_assoc();
                                    while($row && $cont<=12){
                                        if($row["Estado"]=="LIBRE"){
                                            echo "<div class='mesa'>
                                            <img class='foto' src='../Imaxes/Xerais/Mesa-madeira.png' width='100%' alt='Mesa'/>
                                            <h3 class='mueble'>{$row["Mesa"]}</h3><h3 class='estado' style='background-color: green; color: white; width: 75%;'>{$row["Estado"]}</h3></div>";
                                        } else if($row["Estado"]=="RESERVADA"){
                                            echo "<div class='mesa'>
                                            <img class='foto' src='../Imaxes/Xerais/Mesa-madeira.png' width='100%' alt='Mesa'/>
                                            <h3 class='mueble'>{$row["Mesa"]}</h3><h3 class='estado' style='background-color: orange; color: white; width: 45%;'>{$row["Estado"]}</h3>
                                            <form action='detallesreserva.php' method='get'><input type='hidden' name='mesa$j' value='{$row["Mesa"]}'/>
                                            <button>Ver detalles</button></form></div>";
                                        } else if($row["Estado"]=="OCUPADA"){
                                            echo "<div class='mesa'>
                                            <img class='foto' src='../Imaxes/Xerais/Mesa-madeira.png' width='100%' alt='Mesa'/>
                                            <h3 class='mueble'>{$row["Mesa"]}</h3><h3 class='estado' style='background-color: red; color: white;'>{$row["Estado"]}</h3>
                                            <form action='detallesmesaocupada.php' method='get'><input type='hidden' name='mesa$j' value='{$row["Mesa"]}'/>
                                            <button>Ver detalles</button></form>
                                            <form action='".htmlentities($_SERVER["PHP_SELF"])."' method='get'><input type='hidden' name='mesaocupada$j' value='{$row["Mesa"]}'/>
                                            <button name='liberarmesa'>Liberar mesa</button></form></div>";
                                        }
                                        $row=$resultados->fetch_assoc();
                                        $cont++;
                                        $j++;
                                    }
                                }
                            }
                        } else {
                            $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                            if(!$conexion) {
                                echo "<div class='avisos' style='display: block;'><img src='Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo conectar a nuestra base de datos. Inténtelo más tarde.</div>";
                            } else {
                                $listarmesas = "SELECT * FROM mesas";
                                $resultados = $conexion->query($listarmesas);
                                if($resultados->num_rows==0) {
                                    echo "<div class='avisos' style='display: block;'><img src='Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Aún no se registraron las mesas.</div>";
                                } else {
                                    if(isset($_GET["pg"])) {
                                        $paginacion = $_GET["pg"];
                                        if($paginacion<=0 || is_numeric($paginacion)==false) $paginacion=1;
                                    }
                                    else
                                    $paginacion=1;
                                    $url="listademesas.php?mesas&pg=";  
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
                                        echo "<a href='$url".($paginacion+1)."'>Siguiente &gt;</a>";
                                    echo "</p>";
                                    $posicion=($paginacion-1)*12;
                                    $resultados->data_seek($posicion);
                                    $cont=1;
                                    $j=1;
                                    $row=$resultados->fetch_assoc();
                                    while($row && $cont<=12){
                                        if($row["Estado"]=="LIBRE"){
                                            echo "<div class='mesa'>
                                            <img class='foto' src='../Imaxes/Xerais/Mesa-madeira.png' width='100%' alt='Mesa'/>
                                            <h3 class='mueble'>{$row["Mesa"]}</h3><h3 class='estado' style='background-color: green; color: white; width: 75%;'>{$row["Estado"]}</h3></div>";
                                        } else if($row["Estado"]=="RESERVADA"){
                                            echo "<div class='mesa'>
                                            <img class='foto' src='../Imaxes/Xerais/Mesa-madeira.png' width='100%' alt='Mesa'/>
                                            <h3 class='mueble'>{$row["Mesa"]}</h3><h3 class='estado' style='background-color: orange; color: white; width: 45%;'>{$row["Estado"]}</h3>
                                            <form action='detallesreserva.php' method='get'><input type='hidden' name='mesa$j' value='{$row["Mesa"]}'/>
                                            <button>Ver detalles</button></form></div>";
                                        } else if($row["Estado"]=="OCUPADA"){
                                            echo "<div class='mesa'>
                                            <img class='foto' src='../Imaxes/Xerais/Mesa-madeira.png' width='100%' alt='Mesa'/>
                                            <h3 class='mueble'>{$row["Mesa"]}</h3><h3 class='estado' style='background-color: red; color: white;'>{$row["Estado"]}</h3>
                                            <form action='detallesmesaocupada.php' method='get'><input type='hidden' name='mesa$j' value='{$row["Mesa"]}'/>
                                            <button>Ver detalles</button></form>
                                            <form action='".htmlentities($_SERVER["PHP_SELF"])."' method='get'><input type='hidden' name='mesaocupada$j' value='{$row["Mesa"]}'/>
                                            <button name='liberarmesa'>Liberar mesa</button></form></div>";
                                        }
                                        $row=$resultados->fetch_assoc();
                                        $cont++;
                                        $j++;
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
                <a class="axuda" href="../../gl/PHP/listademesas.php">Gallego</a>
                <a class="axuda" href="../../es/PHP/listademesas.php">Castellano</a>
                <a class="axuda" href="https://www.aepd.es/es/politica-de-privacidad-y-aviso-legal">Política de privacidad</a>
                <a class="axuda" href="https://phylo.co/blog/traccion/que-son-los-terminos-y-condiciones/">Términos</a>
            </div>
            <div class="copyright"><p>Copyright &copy;2023. IES Maximino Romero de Lema</p></div>
        </footer>
    </body>
</html>
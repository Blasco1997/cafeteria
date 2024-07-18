<?php
    define('CSSPATH', '');
    $css = "../CSS/estilosxeraiscafeteria.css";
    session_start();
    if(!isset($_SESSION["usuario"])){
        header("Location: loginempregado.php?redirigido=true");
    } else {
        $usuario ='<img style="border-radius: 100%;" src="../Imaxes/Xerais/User.png" width="30" alt="User"/> '.$_SESSION["usuario"].'<span class="material-symbols-outlined" id="morevert">more_vert
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
    <title>BAR MANOLA - Detalles de mesas reservadas</title>
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
            <section class="consulta">
                <h1>DETALLES DE LA RESERVA</h1>
                <?php
                    if(isset($_GET["idreserva"]) && isset($_GET["idmesa"])){
                        $idreserva = $_GET["idreserva"];
                        $idmesa = $_GET["idmesa"];
                        $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                        if(!$conexion) {
                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo conectar a nuestra base de datos. Inténtelo más tarde.</div>";
                        } else {
                            $existereserva = "SELECT * FROM reservas WHERE Id_Reserva = '$idreserva'";
                            $resultado = $conexion->query($existereserva);
                            if($resultado->num_rows==0){
                                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No existe la reserva Nº $idreserva.</div>";
                            } else {
                                $row = $resultado->fetch_assoc();
                                if($row["Pagado"] == "Pendente de entrega"){
                                    $actualizarestadoreserva = "UPDATE reservas SET Pagado = 'Pendente de pagar' WHERE Id_Reserva = '$idreserva'";
                                    if($conexion->query($actualizarestadoreserva)==true){
                                        echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Reserva actualizada.</div>";
                                    } else if($conexion->query($actualizarestadoreserva)==false){
                                        echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Por motivos técnicos, no se pudo actualizar el estado de la reserva.</div>";
                                    }
                                } else if($row["Pagado"] == "Pendente de pagar"){
                                    $actualizarestadoreserva = "UPDATE reservas SET Pagado = 'Pagado' WHERE Id_Reserva = '$idreserva'";
                                    if($conexion->query($actualizarestadoreserva)==true){
                                        $existemesa = "SELECT * FROM mesas WHERE Id_Mesa = '$idmesa'";
                                        $resultado = $conexion->query($existemesa);
                                        if($resultado->num_rows==0){
                                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No existe la mesa Nº $idmesa.</div>";
                                        } else {
                                            $row = $resultado->fetch_assoc();
                                            $mesaocupada = "UPDATE mesas SET Estado = 'OCUPADA' WHERE Id_Mesa = '$idmesa'";
                                            if($conexion->query($mesaocupada)==true){
                                                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/correcto.png' width='100%' alt='Aviso'/>Reserva actualizada.</div>";
                                            } else if($conexion->query($mesaocupada)==false){
                                                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Por motivos técnicos, no se pudo actualizar el estado de la mesa.</div>";
                                            }
                                        }
                                    } else if($conexion->query($actualizarestadoreserva)==false){
                                        echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Por motivos técnicos, no se pudo actualizar el estado de la reserva.</div>";
                                    }
                                }
                            }
                        }
                    }
                ?>
                <?php
                    $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                    if(!$conexion) {
                        echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo conectar a nuestra base de datos. Inténtelo más tarde.</div>";
                    } else {
                        $nummesas = "SELECT COUNT(Id_Mesa) AS NumMesas FROM mesas";
                        $resultado = $conexion->query($nummesas);
                        if($resultado->num_rows==0){
                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Sin mesas que mostrar.</div>";
                        } else {
                            $row = $resultado->fetch_assoc();
                            $totalmesas = $row["NumMesas"];
                            for($j=1; $j<=$totalmesas; $j++){
                                if(isset($_GET["mesa$j"])){
                                    $mesa = $_GET["mesa$j"];
                                    $existemesa = "SELECT * FROM mesas WHERE Mesa = '$mesa'";
                                    $resultado = $conexion->query($existemesa);
                                    if($resultado->num_rows==0){
                                        echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No existe la $mesa.</div>";
                                    } else {
                                        $row = $resultado->fetch_assoc();
                                        $verreserva = "SELECT r.Id_Reserva AS IdReserva, mn.Día AS Día, r.Hora AS Hora, ms.Id_Mesa AS IdMesa, ms.Mesa AS Mesa, cl.Nome_completo AS Cliente, pt.Prato AS Prato, pr.Produto AS Bebida, r.Pagado AS Estado 
                                        FROM reservas AS r JOIN mesas AS ms JOIN clientes AS cl JOIN pratos AS pt JOIN menus AS mn JOIN produtos AS pr ON r.Id_Menú = mn.Id_Menú AND r.Id_Mesa = ms.Id_Mesa AND r.Id_Cliente = cl.Id_cliente
                                        AND r.Id_Prato = pt.Id_Prato WHERE ms.Mesa = '$mesa'";
                                        $resultado = $conexion->query($verreserva);
                                        if($resultado->num_rows==0){
                                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No hay ninguna reserva para la $mesa.</div>";
                                        } else {
                                            $row = $resultado->fetch_assoc();
                                            echo "<div class='listadoprodutos'>";
                                            echo "<table><tr><th>Día</th><th>Hora</th><th>Mesa</th><th>Cliente</th><th>Plato</th><th>Bebida</th><th>Estado</th></tr>";
                                            if($row["Estado"]=="Pagado"){
                                                echo "<tr><td>{$row["Día"]}</td><td>{$row["Hora"]}</td><td>{$row["Mesa"]}</td><td>{$row["Cliente"]}</td><td>{$row["Prato"]}</td>
                                                <td>{$row["Bebida"]}</td><td style='background-color: green; color: white;'>{$row["Estado"]}</td></tr>";
                                            } else if($row["Estado"]=="Pendente de pagar") {
                                                echo "<tr><td>{$row["Día"]}</td><td>{$row["Hora"]}</td><td>{$row["Mesa"]}</td><td>{$row["Cliente"]}</td><td>{$row["Prato"]}</td>
                                                <td>{$row["Bebida"]}</td><td style='background-color: orange'>{$row["Estado"]}</td>
                                                <td><form action='".htmlentities($_SERVER["PHP_SELF"])."' method='get'>
                                                    <input type='hidden' name='idmesa' value='{$row["IdMesa"]}'/>
                                                    <input type='hidden' name='idreserva' value='{$row["IdReserva"]}'/>
                                                    <button>Marcar como pagado</button>
                                                </form></td></tr>";
                                            } else if($row["Estado"]=="Pendente de entrega") {
                                                echo "<tr><td>{$row["Día"]}</td><td>{$row["Hora"]}</td><td>{$row["Mesa"]}</td><td>{$row["Cliente"]}</td><td>{$row["Prato"]}</td>
                                                <td>{$row["Bebida"]}</td><td style='background-color: red'>{$row["Estado"]}</td>
                                                <td><form action='".htmlentities($_SERVER["PHP_SELF"])."' method='get'>
                                                    <input type='hidden' name='idmesa' value='{$row["IdMesa"]}'/>
                                                    <input type='hidden' name='idreserva' value='{$row["IdReserva"]}'/>
                                                    <button>Marcar como pendiente de pagar</button>
                                                </form></td></tr>";
                                            }
                                            echo "</table></div>";
                                        }
                                    }
                                }
                            }
                        }
                    }
                ?>
                <p class="pagina"><a href="listademesas.php">Volver atrás</a></p>
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
                <a class="axuda" href="../../gl/PHP/detallesreserva.php">Gallego</a>
                <a class="axuda" href="../../es/PHP/detallesreserva.php">Castellano</a>
                <a class="axuda" href="https://www.aepd.es/es/politica-de-privacidad-y-aviso-legal">Política de privacidad</a>
                <a class="axuda" href="https://phylo.co/blog/traccion/que-son-los-terminos-y-condiciones/">Términos</a>
            </div>
            <div class="copyright"><p>Copyright &copy;2023. IES Maximino Romero de Lema</p></div>
        </footer>
    </body>
</html>
<?php
    define('CSSPATH', '');
    $css = "../CSS/estilosxeraiscafeteria.css";
    session_start();
    if(!isset($_SESSION["cliente"])){
        header("Location: login.php?redirigido=true");
    } else {
        $usuario = '<img style="border-radius: 100%;" src="../Imaxes/Xerais/User.png" width="30" alt="User"/>'.$_SESSION["cliente"].'<span class="material-symbols-outlined" id="morevert">more_vert
        <ul>
            <li><a href="cerrarsesioncliente.php">Cerrar sesión</a></li><br/>
            <li><a href="eliminarcuentacliente.php"><span class="material-symbols-outlined" id="eliminarcuenta">close</span>Eliminar cuenta</a></li>
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
    <title>BAR MANOLA - Lista de reservas</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="<?php echo (CSSPATH . "$css" );?>">
    <script src="../JavaScript/jQuery/jquery-3.6.3.js" type="text/javascript"></script>
</head>
    <body>
        <header>
            <div id="logoytitulo">
                <a href='indexcliente.php'><img src='../Imaxes/Xerais/Logo_Cafetería.png' width='100%' alt='Bar Manola'/></a>
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
                    <li><a href='reservarprato.php'>Reservar</a></li>
                    <li><a href="produtos1.php">Productos</a></li>
                    <li><a href="novasdonosolocal.php">Noticias de nuestro local</a></li>
                </ul>
            </nav>
        </header>
        <hr>
        <main>
            <section class="consulta">
                <a href='indexcliente.php'>Volver atrás</a>
                <h1 class="tituloconsulta">LISTA DE RESERVAS:</h1>
                <div class="filtrocategoria"></div>
                <?php
                    $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                    if(!$conexion) {
                        echo "<div class='avisos' style='display: block;'><img src='Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo conectar a nuestra base de datos. Inténtelo más tarde.</div>";
                    } else {
                        $listarreservas = "SELECT r.Id_Reserva AS IdReserva, mn.Día AS Día, r.Hora AS Hora, ms.Id_Mesa AS IdMesa, ms.Mesa AS Mesa, cl.Nome_completo AS Cliente, pt.Prato AS Prato, pr.Produto AS Bebida, r.Pagado AS Estado 
                        FROM reservas AS r JOIN mesas AS ms JOIN clientes AS cl JOIN pratos AS pt JOIN produtos AS pr JOIN menus AS mn ON r.Id_Produto = pr.Id_Produto AND r.Id_Menú = mn.Id_Menú AND r.Id_Mesa = ms.Id_Mesa AND r.Id_Cliente = cl.Id_cliente
                        AND r.Id_Prato = pt.Id_Prato";
                        $resultados = $conexion->query($listarreservas);
                        if($resultados->num_rows==0) {
                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Aún no se registró ninguna reserva.</div>";
                        } else {
                            if(isset($_GET["pg"])) {
                                $paginacion = $_GET["pg"];
                                if($paginacion<=0 || is_numeric($paginacion)==false) $paginacion=1;
                            }
                            else
                            $paginacion=1;
                            $url="verreservascliente.php?reservas&pg=";  
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
                            echo "<div class='listadoprodutos'>";
                            echo "<table><tr><th>Día</th><th>Hora</th><th>Mesa</th><th>Cliente</th><th>Plato</th><th>Bebida</th><th>Estado</th></tr>";
                            while($row && $cont<=12){
                                if($row["Estado"]=="Pagado"){
                                    echo "<tr><td>{$row["Día"]}</td><td>{$row["Hora"]}</td><td>{$row["Mesa"]}</td><td>{$row["Cliente"]}</td><td>{$row["Prato"]}</td>
                                    <td>{$row["Bebida"]}</td><td style='background-color: green; font-weight: bold; color: white;'>{$row["Estado"]}</td></tr>";
                                } else if($row["Estado"]=="Pendente de pagar") {
                                    echo "<tr><td>{$row["Día"]}</td><td>{$row["Hora"]}</td><td>{$row["Mesa"]}</td><td>{$row["Cliente"]}</td><td>{$row["Prato"]}</td>
                                    <td>{$row["Bebida"]}</td><td style='background-color: orange; font-weight: bold; color: white;'>{$row["Estado"]}</td></tr>";
                                } else if($row["Estado"]=="Pendente de entrega") {
                                    echo "<tr><td>{$row["Día"]}</td><td>{$row["Hora"]}</td><td>{$row["Mesa"]}</td><td>{$row["Cliente"]}</td><td>{$row["Prato"]}</td>
                                    <td>{$row["Bebida"]}</td><td style='background-color: red; font-weight: bold; color: white;'>{$row["Estado"]}</td></tr>";
                                }
                                $row=$resultados->fetch_assoc();
                                $cont++;
                                $j++;
                            }
                            echo "</table></div>";
                        }
                    }
                ?>
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
                <a class="axuda" href="../../gl/PHP/verreservascliente.php">Gallego</a>
                <a class="axuda" href="../../es/PHP/verreservascliente.php">Castellano</a>
                <a class="axuda" href="https://www.aepd.es/es/politica-de-privacidad-y-aviso-legal">Política de privacidad</a>
                <a class="axuda" href="https://phylo.co/blog/traccion/que-son-los-terminos-y-condiciones/">Términos</a>
            </div>
            <div class="copyright"><p>Copyright &copy;2023. IES Maximino Romero de Lema</p></div>
        </footer>
    </body>
</html>
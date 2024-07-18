<?php
    define('CSSPATH', '');
    $css = "../CSS/estilosxeraiscafeteria.css";
    session_start();
    if(!isset($_SESSION["cliente"])){
        header("location: login.php?redirixido=true");
    } else {
        $usuario = '<img style="border-radius: 100%;" src="../Imaxes/Xerais/User.png" width="30" alt="User"/>'.$_SESSION["cliente"].'<span class="material-symbols-outlined" id="morevert">more_vert
        <ul>
            <li><a href="cerrarsesioncliente.php">Pechar sesión</a></li><br/>
            <li><a href="eliminarcuentacliente.php"><span class="material-symbols-outlined" id="eliminarcuenta">close</span>Eliminar conta</a></li>
        </ul>
    </span>';;
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
    <title>BAR MANOLA - Inicio</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="<?php echo (CSSPATH . "$css" );?>">
    <script src="../JavaScript/jQuery/jquery-3.6.3.js" type="text/javascript"></script>
</head>
<body>
    <header>
        <div id="logoytitulo">
            <a href="indexcliente.php"><img src="../Imaxes/Xerais/Logo_Cafetería.png" width="100%" alt="Bar Manola"/></a>
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
                <li>Reservar</li>
                <li><a href="produtos1.php">Produtos</a></li>
                <li><a href="quensomos.php">Quen somos</a></li>
            </ul>
        </nav>
    </header>
    <hr>
    <main>
        <section id="reserva">
            <h1 class="proposta">O NOSO MENÚ PROPOSTO PARA HOXE</h1>
            <div class="menudodia">
                <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>" method="post">
                    <?php
                        $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                        if(!$conexion) {
                            echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non se puido conectar á nosa base de datos. Inténteo máis tarde.";
                        } else {
                            $listarpratos = "SELECT pm.Id_Prato AS IdPrato, p.Prato AS Prato, pm.Id_Menu AS IdMenú, m.Prezo AS Prezo, m.Día AS Día 
                            FROM pratosmenus AS pm JOIN pratos AS p JOIN menus AS m ON pm.Id_Prato = p.Id_Prato AND pm.Id_Menu = m.Id_Menú
                            WHERE m.Día = CURDATE()";
                            $resultados = $conexion->query($listarpratos);
                            if($resultados->num_rows==0) {
                                echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' style='width: 15%; transform: translate(130px, -3px);' alt='Aviso'/><p>Hoxe non hai menú.</p>";
                            } else {
                                $row = $resultados->fetch_assoc();
                                echo "<div class='custo'><h1>Custo: {$row["Prezo"]}€</h1></div>";
                                echo "<input type='hidden' name='idmenu' value='{$row["IdMenú"]}'/>";
                                $i = 1;
                                echo "<div class='options'>";
                                while($row){
                                    echo "<input type='radio' name='prato$i' class='prato' value='{$row["Prato"]}'/><label for='prato$i'>{$row["Prato"]}</label><br/>";
                                    $row = $resultados->fetch_assoc();
                                    $i++;
                                }
                                echo "</div>";
                            }
                        }
                    ?>
                    <div class="bebidaaelegir">
                        <label for="bebida">De beber:</label>
                        <select name="bebida" id="bebida">
                            <option selected="selected">Seleccionar bebida</option>
                            <?php
                                $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                                if(!$conexion) {
                                    echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non se puido conectar á nosa base de datos. Inténteo máis tarde.";
                                } else {
                                    $listabebidas = "SELECT * FROM produtos WHERE Tipo = 'Bebida'";
                                    $resultados = $conexion->query($listabebidas);
                                    if($resultados->num_rows==0) {
                                        echo "<option>(Sen bebidas)</option>";
                                    } else {
                                        $row = $resultados->fetch_assoc();
                                        while($row){
                                            echo "<option>{$row["Produto"]}</option>";
                                            $row = $resultados->fetch_assoc();
                                        }
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="horaaelegir">
                        <label for="hora">Hora:</label>
                        <select name="hora" id="hora">
                            <option selected="selected">Seleccione unha hora</option>
                            <option>13:00</option>
                            <option>13:15</option>
                            <option>13:30</option>
                            <option>13:45</option>
                            <option>14:00</option>
                            <option>14:15</option>
                            <option>14:30</option>
                            <option>14:45</option>
                            <option>15:00</option>
                            <option>15:15</option>
                            <option>15:30</option>
                            <option>15:45</option>
                        </select>
                    </div>
                    <div class="mesaaelegir">
                        <label for="mesa">Mesa:</label>
                        <select name="mesa" id="mesa">
                            <option selected="selected">Seleccione mesa</option>
                            <?php
                                $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                                if(!$conexion) {
                                    echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non se puido conectar á nosa base de datos. Inténteo máis tarde.";
                                } else {
                                    $mesasdisponibles = "SELECT * FROM mesas WHERE Estado = 'LIBRE'";
                                    $resultados = $conexion->query($mesasdisponibles);
                                    if($resultados->num_rows==0) {
                                        echo "<option>Sentimos informarlle que xa non hai mesas dispoñibles para facer reservas</option>";
                                    } else {
                                        $row = $resultados->fetch_assoc();
                                        while($row){
                                            echo "<option>{$row["Mesa"]}</option>";
                                            $row = $resultados->fetch_assoc();
                                        }
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div id="reservarprato">
                        <button id="reservar">RESERVAR PRATO</button>
                    </div>
                </form>
                <div class="avisos"></div>
                <script>
                    let prato = document.querySelector(".prato");
                    let bebida = document.getElementById("bebida");
                    let hora = document.getElementById("hora");
                    let mesa = document.getElementById("mesa");
                    let reservar = document.getElementById("reservar");
                    let avisos = document.querySelector(".avisos");
                    reservar.addEventListener("click", function(event){
                        if(prato.checked == false || bebida.value=='Seleccionar bebida' || hora.value == 'Seleccionar hora' || mesa.value == 'Seleccionar mesa') {
                            avisos.style.display = "block";
                            avisos.innerHTML = '<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Por motivos técnicos non se puido publicar a reserva.';
                            event.praventDefault();
                        }
                    });
                </script>
                <?php
                     $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                     if(!$conexion) {
                         echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non se puido conectar á nosa base de datos. Inténteo máis tarde.";
                     } else {
                        $numpratosactuais = "SELECT COUNT(pm.Id_Prato_Menu) AS NumPratosActuais FROM pratosmenus AS pm JOIN menus AS m ON pm.Id_Menu=m.Id_Menú WHERE m.Día=CURDATE()";
                        $resultado = $conexion->query($numpratosactuais);
                        if($resultado->num_rows==0){
                            echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' style='width: 15%; transform: translate(130px, -3px);' alt='Aviso'/><p>Hoxe non hai menú.</p>";
                            echo "<script>
                                    $('.bebidaaelegir').css('display', 'none');
                                </script>";
                        } else {
                            $row = $resultado->fetch_assoc();
                            $totalpratosactuais = $row["NumPratosActuais"];
                            for($i=1; $i<=$totalpratosactuais; $i++){
                                if(isset($_POST["prato$i"]) && isset($_POST["idmenu"]) && isset($_POST["bebida"]) && isset($_POST["hora"]) && isset($_POST["mesa"]) && isset($_SESSION["cliente"])) {
                                    $prato = $_POST["prato$i"];
                                    $idmenu = $_POST["idmenu"];
                                    $bebida = $_POST["bebida"];
                                    $hora = $_POST["hora"];
                                    $mesa = $_POST["mesa"];
                                    $cliente = $_SESSION["cliente"];
                                    $existeprato = "SELECT * FROM pratos WHERE Prato = '$prato'";
                                    $resultado = $conexion->query($existeprato);
                                    if($resultado->num_rows==0){
                                        echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non existe o prato $prato.";
                                    } else {
                                        $row = $resultado->fetch_assoc();
                                        $idprato = $row["Id_Prato"];
                                        $existebebida = "SELECT * FROM produtos WHERE Tipo = 'Bebida' AND Produto = '$bebida'";
                                        $resultado = $conexion->query($existebebida);
                                        if($resultado->num_rows==0){
                                            echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non existe o produto $bebida.";
                                        } else {
                                            $row = $resultado->fetch_assoc();
                                            $idproduto = $row["Id_Produto"];
                                            $existemenu = "SELECT * FROM menus WHERE Id_Menú = '$idmenu'";
                                            $resultado = $conexion->query($existemenu);
                                            if($resultado->num_rows==0){
                                                echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No existe o menú Nº $idmenu.";
                                            } else {
                                                $row = $resultado->fetch_assoc();
                                                $existemesa = "SELECT * FROM mesas WHERE Mesa = '$mesa'";
                                                $resultado = $conexion->query($existemesa);
                                                if($resultado->num_rows==0){
                                                    echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non existe a $mesa.";
                                                } else {
                                                    $row = $resultado->fetch_assoc();
                                                    $idmesa = $row["Id_Mesa"];
                                                    $existecliente = "SELECT * FROM clientes WHERE Nome_completo = '$cliente'";
                                                    $resultado = $conexion->query($existecliente);
                                                    if($resultado->num_rows==0){
                                                        echo "<img class='advertencia' src='Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non existe o cliente $cliente.";
                                                    } else {
                                                        $row = $resultado->fetch_assoc();
                                                        $idcliente = $row["Id_cliente"];
                                                        $publicarreserva = "INSERT INTO reservas(Hora, Id_Menú, Id_Mesa, Id_Cliente, Id_Prato, Id_Produto, Pagado) 
                                                        VALUES('$hora', '$idmenu', '$idmesa', '$idcliente', '$idprato', '$idproduto', 'Pendente de entrega')";
                                                        if($conexion->query($publicarreserva)==true){
                                                            $mesareservada = "UPDATE mesas SET Estado = 'RESERVADA' WHERE Id_Mesa = '$idmesa'";
                                                            if($conexion->query($mesareservada)==true){
                                                                $stockbebidaactualizado = "UPDATE produtos SET Stock = Stock - 1 WHERE Id_Produto = '$idproduto'";
                                                                if($conexion->query($stockbebidaactualizado)==true){
                                                                    echo "<img class='correcto' src='../Imaxes/Xerais/correcto.png' width='100%' alt='Aviso'/>Reserva do prato $prato para as $hora feita correctamente.";
                                                                } else if($conexion->query($stockbebidaactualizado)==false){
                                                                    echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non se puido actualizar o stock do produto $bebida.";
                                                                }
                                                            } else if($conexion->query($mesareservada)==false){
                                                                echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Por motivos técnicos houbo un erro ao reservar a mesa.";  
                                                            }
                                                        } else if($conexion->query($publicarreserva)==false){
                                                            echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Por motivos técnicos non se puido publicar a reserva.";
                                                        }
                                                    }
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
            <a class="axuda" href="../../gl/PHP/reservarprato.php">Galego</a>
            <a class="axuda" href="../../es/PHP/reservarprato.php">Castelán</a>
            <a class="axuda" href="https://www.aepd.es/es/politica-de-privacidad-y-aviso-legal">Política de privacidade</a>
            <a class="axuda" href="https://phylo.co/blog/traccion/que-son-los-terminos-y-condiciones/">Términos</a>
        </div>
        <div class="copyright"><p>Copyright &copy;2023. IES Maximino Romero de Lema</p></div>
    </footer>
</body>
</html>
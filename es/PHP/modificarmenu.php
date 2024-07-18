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
    <title>BAR MANOLA - Modificar menú</title>
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
                        <li>Modificar Menú</li>
                        <li><a href="rexistroempregado.php">Añadir Empleado</a></li>
                        <li><a href="engadirproduto.php">Añadir Producto</a></li>
                        <li><a href="engadirprovedor.php">Añadir Proveedor</a></li>
                        <li><a href="engadirnova.php">Añadir Noticia</a></li>
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
        <section id="modificarmenu">
            <div class="crearnovomenu">
                <h1>CREAR UN NUEVO MENÚ</h1>
                <?php
                    if(isset($_POST["dia"]) && isset($_POST["prezo"]) && isset($_POST["crearmenu"])){
                        $dia = $_POST["dia"];
                        $prezo = $_POST["prezo"];
                        $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                        if(!$conexion){
                            echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo conectar a nuestra base de datos. Inténtelo más tarde.";
                        } else {
                            $rexistrarmenu = "INSERT INTO menus(Prezo, Día) VALUES ('$prezo', '$dia')";
                            if($conexion->query($rexistrarmenu)==true) {
                                echo "<img class='correcto' src='../Imaxes/Xerais/correcto.png' width='100%' alt='Aviso'/>Menú del día $dia creado correctamente. Prezo del menú: $prezo €.";
                            } else if($conexion->query($rexistrarmenu)==false){
                                echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo crear el menú del día $dia.";
                            }
                        }
                    } else if(isset($_POST["dia"]) && isset($_POST["prezo"]) && isset($_POST["diaanterior"]) && isset($_POST["gardarmenu"])){
                        $datamenu = $_POST["dia"];
                        $prezomenu = $_POST["prezo"];
                        $diaanterior = $_POST["diaanterior"];
                        $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                        if(!$conexion) {
                            echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo conectar a nuestra base de datos. Inténtelo más tarde..";
                        } else {
                            $existemenu = "SELECT * FROM menus WHERE Día = '$diaanterior'";
                            $resultado = $conexion->query($existemenu);
                            if($resultado->num_rows==0){
                                echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No hay menú en el día $datamenu.";
                            } else {
                                $row = $resultado->fetch_assoc();
                                $gardarmenu = "UPDATE menus SET Día = '$datamenu', Prezo = '$prezomenu' WHERE Día = '$diaanterior'";
                                if($conexion->query($gardarmenu)==true){
                                    echo "<img class='advertencia' src='../Imaxes/Xerais/correcto.png' width='100%' alt='Aviso'/>Menú del día $datamenu actualizado.";
                                } else if($conexion->query($gardarmenu)==false){
                                    echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Por motivos técnicos no se pudo actualizar el menú del día $datamenu.";
                                }
                            }
                        }
                    }
                ?>
                <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>" method="post">
                    <label for="dia">Día:</label>
                    <input type="date" name="dia" id="dia"/>
                    <label for="prezo">Precio(€):</label>
                    <input type="number" min="0" name="prezo" id="prezo" style="width: 40px;"/>
                    <input type='hidden' name='diaanterior' id='diaanterior'/>
                    <button name="crearmenu" id="crearmenu">CREAR MENÚ</button>
                    <button name="gardarmenu" id="gardarmenu" style='display: none;'>GUARDAR MENÚ</button>
                </form>
            </div>
            <div class="engadirprato">
                <h1>AÑADIR PLATO</h1>
                <?php
                    if(isset($_GET["pratoaengadir"])){
                        $pratoaengadir = $_GET["pratoaengadir"];
                        $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                        if(!$conexion){
                            echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo conectar a nuestra base de datos. Inténtelo más tarde.";
                        } else {
                            $existeprato = "SELECT * FROM pratos WHERE Prato = '$pratoaengadir'";
                            $resultado = $conexion->query($existeprato);
                            if($resultado->num_rows==0){
                                echo "<div class='avisos'><img class='advertencia' src='Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No existe el plato $pratoaengadir.</div>";
                            } else {
                                $row = $resultado->fetch_assoc();
                                $idprato = $row["Id_Prato"];
                                $engadirprato = "UPDATE pratos SET Disponible = 'Sí' WHERE Id_Prato = '$idprato'";
                                if($conexion->query($engadirprato)==true) {
                                    echo "<img class='advertencia' src='../Imaxes/Xerais/correcto.png' width='100%' alt='Aviso'/>Plato $pratoaengadir añadido al menú.";
                                } else if($conexion->query($engadirprato)==false){
                                    echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo añadir el plato $pratoaengadir al menú.";
                                }
                            }
                        }
                    }
                ?>
                <?php
                    $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                    if(!$conexion) {
                        echo "<img class='advertencia' src='Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo conectar a nuestra base de datos. Inténtelo más tarde.";
                    } else {
                        $numpratosdisponibles = "SELECT COUNT(Id_Prato) AS NumPratos FROM pratos WHERE Disponible = 'Sí'";
                        $resultado = $conexion->query($numpratosdisponibles);
                        if($resultado->num_rows==0){
                            echo "<div class='avisos'><img class='advertencia' src='Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Aún no hay pratos disponibles.</div>";
                        } else {
                            $row = $resultado->fetch_assoc();
                            $pratosactivos = $row["NumPratos"];
                            for($i = 1; $i <= $pratosactivos; $i++){
                                if(isset($_GET["data"]) && isset($_GET["prato$i"]) && isset($_GET["gardar"]) ){
                                    $data = $_GET["data"];
                                    $prato = $_GET["prato$i"];
                                    $existedata = "SELECT * FROM menus WHERE Día = '$data'";
                                    $resultado = $conexion->query($existedata);
                                    if($resultado->num_rows==0){
                                        echo "<div class='avisos'><img class='advertencia' src='Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No existe el menú del día $data.</div>";
                                    } else {
                                        $row = $resultado->fetch_assoc();
                                        $idmenu = $row["Id_Menú"];
                                        $existeprato = "SELECT * FROM pratos WHERE Prato = '$prato'";
                                        $resultado = $conexion->query($existeprato);
                                        if($resultado->num_rows==0){
                                            echo "<div class='avisos'><img class='advertencia' src='Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No existe el prato $prato.</div>";
                                        } else {
                                            $row = $resultado->fetch_assoc();
                                            $idprato = $row["Id_Prato"];
                                            $publicarpratosdomenu = "INSERT INTO pratosmenus(Id_Prato, Id_Menu) VALUES($idprato, $idmenu)";
                                            if($conexion->query($publicarpratosdomenu)==true) {
                                                echo "<div class='avisos'><img class='correcto' src='Imaxes/Xerais/correcto.png' width='100%' alt='Aviso'/>Menú del día publicado correctamente.</div>";
                                            } else if($conexion->query($publicarpratosdomenu)==false) {
                                                echo "<div class='avisos'><img class='advertencia' src='Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Hubo un problema al publicar el menú del día.</div>";
                                            }
                                        }
                                    }
                                } else if(isset($_GET["prato$i"]) && isset($_GET["delete$i"])){
                                    $prato = $_GET["prato$i"];
                                    $existeprato = "SELECT * FROM pratos WHERE Prato = '$prato'";
                                    $resultado = $conexion->query($existeprato);
                                    if($resultado->num_rows==0){
                                        echo "<div class='avisos'><img class='advertencia' src='Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non existe el prato $prato.</div>";
                                    } else {
                                        $row = $resultado->fetch_assoc();
                                        $idprato = $row["Id_Prato"];
                                        $quitarprato = "UPDATE pratos SET Disponible = 'No' WHERE Prato = '$prato'";
                                        if($conexion->query($quitarprato)==true){
                                            echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Plato $prato quitado del menú.";
                                        } else if($conexion->query($quitarprato)==false){
                                            echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non se pudo quitar el plato $prato del menú.";
                                        }
                                    }
                                }
                            }
                        }
                    }
                ?>
                <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>" method="get">
                    <label for="pratoaengadir">Plato:</label>
                    <select name="pratoaengadir" id="pratoengadido">
                        <option selected="selected">Seleccione plato</option>
                        <?php
                            $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                            if(!$conexion){
                                echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo conectar á nuestra base de datos. Inténteo más tarde.";
                            } else {
                                $listarpratos = "SELECT * FROM pratos WHERE Disponible = 'No'";
                                $resultados = $conexion->query($listarpratos);
                                if($resultados->num_rows==0) {
                                    echo "<option>No hay platos disponibles.</option>";
                                } else {
                                    $row = $resultados->fetch_assoc();
                                    while($row){
                                        echo "<option>{$row["Prato"]}</option>";
                                        $row = $resultados->fetch_assoc();
                                    }
                                }
                            }
                        ?>
                    </select>
                    <button id="engadir">AÑADIR</button>
                </form>
            </div>
            <div class="rexistrarprato">
                <h1>REGISTRAR PLATO</h1>
                <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>" method="post">
                    <input type="hidden" name="nomeanteriorprato" id="nomeanteriorprato"/>
                    <label for="prato">Nombre del plato:</label>
                    <input type="text" name="prato" id="prato"/>
                    <label for="disponible">Disponible:</label>
                    <select name="disponible" id="disponible">
                        <option selected="selected">No</option>
                        <option>Sí</option>
                    </select>
                    <button name="rexistrar" id="rexistrar">REGISTRAR</button>
                    <button name="gardarprato" id="gardarprato" style="display: none;">GUARDAR PLATO</button>
                </form>
                <?php
                    if(isset($_POST["prato"]) && isset($_POST["disponible"]) && isset($_POST["rexistrar"])){
                        $prato = $_POST["prato"];
                        $disponible = $_POST["disponible"];
                        $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                        if(!$conexion){
                            echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo conectar a nuestra base de datos. Inténtelo más tarde.";
                        } else {
                            $rexistrarprato = "INSERT INTO pratos(Prato, Disponible) VALUES ('$prato', '$disponible')";
                            if($conexion->query($rexistrarprato)==true) {
                                echo "<img class='advertencia' src='../Imaxes/Xerais/correcto.png' width='100%' alt='Aviso'/>Plato $prato registrado.";
                            } else if($conexion->query($rexistrarprato)==false){
                                echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo registrar el plato $prato.";
                            }
                        }
                    } else if(isset($_POST["nomeanteriorprato"]) && isset($_POST["prato"]) && isset($_POST["disponible"]) && isset($_POST["gardarprato"])){
                        $nomeanteriorprato = $_POST["nomeanteriorprato"];
                        $prato = $_POST["prato"];
                        $disponible = $_POST["disponible"];
                        $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                        if(!$conexion){
                            echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo conectar a nuestra base de datos. Inténtelo más tarde.";
                        } else {
                            $existeprato = "SELECT * FROM pratos WHERE Prato = '$nomeanteriorprato'";
                            $resultado = $conexion->query($existeprato);
                            if($resultado->num_rows==0){
                                echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No existe el plato $prato.";
                            } else {
                                $row = $resultado->fetch_assoc();
                                $gardarprato = "UPDATE pratos SET Prato = '$prato', Disponible = '$disponible' WHERE Prato = '$nomeanteriorprato'";
                                if($conexion->query($gardarprato)==true) {
                                    echo "<img class='advertencia' src='../Imaxes/Xerais/correcto.png' width='100%' alt='Aviso'/>Plato $prato actualizado.";
                                } else if($conexion->query($gardarprato)==false){
                                    echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo actualizar el plato $nomeanteriorprato.";
                                }
                            }
                        }
                    }
                ?>
            </div>
            <div class="displaymenu">
                <form action='<?php echo htmlentities($_SERVER["PHP_SELF"]);?>' method='get'>
                    <div class="elecciondia">
                        <h1>MENÚ DO DÍA:
                        <?php
                            $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                            if(!$conexion) {
                                echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo conectar a nuestra base de datos. Inténtelo más tarde.";
                            } else {
                                $datas = "SELECT Día FROM menus";
                                $resultados = $conexion->query($datas);
                                if($resultados->num_rows==0) {
                                    echo "<select><option>(Sin fechas)</option></select>";
                                } else {
                                    $row1 = $resultados->fetch_assoc();
                                    $i = 1;
                                    echo "<select name='data' id='data'>";
                                    while($row1){
                                        echo "<option>{$row1["Día"]}</option>";
                                        $row1 = $resultados->fetch_assoc();
                                        $i++;
                                    }
                                    echo "</select>";
                                }
                                $prezos = "SELECT Prezo FROM menus";
                                $resultados = $conexion->query($prezos);
                                if($resultados->num_rows==0) {
                                    echo "<select><option>(Sen precios)</option></select>";
                                } else {
                                    $row2 = $resultados->fetch_assoc();
                                    echo "<select name='prezomenu' id='prezomenu''>";
                                    while($row2){
                                        echo "<option>{$row2["Prezo"]}</option>";
                                        $row2 = $resultados->fetch_assoc();
                                    }
                                    echo "</select>€<br/>";
                                    echo "<input type='button' name='actualizarmenu' id='actualizarmenu' value='ACTUALIZAR MENÚ'/>";
                                }
                            }
                        ?></h1>
                    </div>
                    <script>
                        let data = document.getElementById('data');
                        let prezomenu = document.getElementById('prezomenu');
                        let actualizarmenu = document.getElementById('actualizarmenu');
                        let gardarmenu = document.getElementById('gardarmenu');
                        let crearmenu = document.getElementById('crearmenu');
                        let dia = document.getElementById('dia');
                        let prezo = document.getElementById('prezo');
                        let diaanterior = document.getElementById('diaanterior');
                        actualizarmenu.addEventListener('click', function(){
                            gardarmenu.style.display = 'block';
                            crearmenu.style.display = 'none';
                            dia.value = `${data.value}`;
                            prezo.value = `${prezomenu.value}`;
                            diaanterior.value = `${data.value}`;
                        });
                    </script>
                    <?php
                        $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                        if(!$conexion) {
                            echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo conectar a nuestra base de datos. Inténtelo más tarde.";
                        } else {
                            $pratosdisponibles = "SELECT * FROM pratos WHERE Disponible = 'Sí'";
                            $resultados = $conexion->query($pratosdisponibles);
                            if($resultados->num_rows==0){
                                echo "<div class='pratosdisponibles'><img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Aúna no hay platos disponibles.</div>";
                            } else {
                                echo "<table>";
                                $row = $resultados->fetch_assoc();
                                $i = 1;
                                while($row){
                                    echo "<tr><td class='nomeprato'>
                                    <input type='hidden' name='prato$i' id='prato$i' value='{$row["Prato"]}'/>{$row["Prato"]}</td>
                                    <td><button id='editnote$i'><span class='material-symbols-outlined'>edit_note</span></button></td>
                                    <td><button name='delete$i'><span class='material-symbols-outlined'>delete</span></button>
                                    </td></tr>";
                                    echo "<script>
                                        let editnote$i = document.getElementById('editnote$i');
                                        editnote$i.addEventListener('click', function(event){
                                            document.getElementById('nomeanteriorprato').value = '{$row["Prato"]}';
                                            document.getElementById('prato').value = '{$row["Prato"]}';
                                            document.getElementById('disponible').selected = '{$row["Disponible"]}';
                                            document.getElementById('rexistrar').style.display = 'none';
                                            document.getElementById('gardarprato').style.display = 'block';
                                            event.preventDefault();
                                        });
                                    </script>";
                                    $row = $resultados->fetch_assoc();
                                    $i++;
                                }
                                echo "</table>";
                            }
                        }
                    ?>
                    <button id="gardar" name='gardar'>GUARDAR Y PUBLICAR</button>
                </form>
            </div>
        </section>
    </main>
    <div class="clear"></div>
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
            <a class="axuda" href="../../gl/PHP/modificarmenu.php">Gallego</a>
            <a class="axuda" href="../../es/PHP/modificarmenu.php">Castellano</a>
            <a class="axuda" href="https://www.aepd.es/es/politica-de-privacidad-y-aviso-legal">Política de privacidad</a>
            <a class="axuda" href="https://phylo.co/blog/traccion/que-son-los-terminos-y-condiciones/">Términos</a>
        </div>
        <div class="copyright"><p>Copyright &copy;2023. IES Maximino Romero de Lema</p></div>
    </footer>
</body>
</html>
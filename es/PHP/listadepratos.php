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
    <title>BAR MANOLA - Lista de platos</title>
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
                            <li>Lista de platos</li>
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
            <section class="consulta">
                <h1 class="tituloconsulta">LISTA DE PLATOS:</h1>
                <div class="filtrocategoria"></div>
                <form class="busquedaproduto" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="get">
                    <input type="search" name="buscarprato" id="buscar" placeholder="&#128269; Buscar plato"/>
                    <button>Filtrar</button>
                </form>
                <?php
                    $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                    if(!$conexion) {
                        echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo conectar a nuestra base de datos. Inténtelo más tarde.</div>";
                    } else {
                        $numpratos = "SELECT COUNT(Id_Prato) AS NumPratos FROM pratos";
                        $resultado = $conexion->query($numpratos);
                        if($resultado->num_rows==0){
                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Aún no hay platos publicados.</div>";
                        } else {
                            $row = $resultado->fetch_assoc();
                            $totalpratos = $row["NumPratos"];
                            for($j=1; $j<=$totalpratos; $j++){
                                if(isset($_POST["nomeanteriorprato"]) && isset($_POST["prato"]) && isset($_POST["disponible"]) &&
                                isset($_POST["gardarcambios"])){
                                    $nomeanteriorprato = $_POST["nomeanteriorprato"];
                                    $prato = $_POST["prato"];
                                    $disponible = $_POST["disponible"];
                                    $existeprato = "SELECT * FROM pratos WHERE Prato = '$nomeanteriorprato'";
                                    $resultado = $conexion->query($existeprato);
                                    if($resultado->num_rows==0){
                                        echo "";
                                    } else {
                                        $row = $resultado->fetch_assoc();
                                        $idprato = $row["Id_Prato"];
                                        $actualizarprato = "UPDATE pratos SET Prato = '$prato', Disponible = '$disponible' WHERE Id_Prato = $idprato";
                                        if($conexion->query($actualizarprato)==true){
                                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/correcto.png' width='100%' alt='Aviso'/>Datos del plato actualizados correctamente.</div>";
                                        } else if($conexion->query($actualizarprato)==false){
                                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Por motivos técnicos no se pudo actualizar el plato $prato.</div>";
                                        }
                                    }
                                }
                                if(isset($_POST["prato"]) && isset($_POST["disponible"]) && isset($_POST["eliminarprato"])){
                                    $prato = $_POST["prato"];
                                    $disponible = $_POST["disponible"];
                                    $existeprato = "SELECT * FROM pratos WHERE Prato = '$prato'";
                                    $resultado = $conexion->query($existeprato);
                                    if($resultado->num_rows==0){
                                        echo "";
                                    } else {
                                        $row = $resultado->fetch_assoc();
                                        $idprato = $row["Id_Prato"];
                                        $actualizarprato = "DELETE FROM pratos WHERE Id_Prato = $idprato";
                                        if($conexion->query($actualizarprato)==true){
                                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/correcto.png' width='100%' alt='Aviso'/>Plato $prato eliminado.</div>";
                                        } else if($conexion->query($actualizarprato)==false){
                                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Por motivos técnicos no se pudo eliminar o plato $prato.</div>";
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
                        <h1>MODIFICAR PLATO</h1>
                    </div>
                    <input type="hidden" name="nomeanteriorprato" id="nomeanteriorprato"/>
                    <div class="campoproduto">
                        <label for="produto">Nuevo nombre del plato:</label>
                        <input type="text" name="prato" id="prato"/>
                    </div>
                    <div class="campoproduto">
                    <label for="disponible">Disponible:</label>
                        <select name="disponible" id="disponible">
                            <option selected="selected">No</option>
                            <option>Sí</option>
                        </select>
                    </div><br/>
                    <div class="campoproduto">
                        <button id="engadir" name="gardarcambios">GUARDAR CAMBIOS</button>
                        <button id="eliminar" name="eliminarprato">ELIMINAR PLATO</button>
                    </div>
                </form>
                <?php
                    if(isset($_GET["buscarprato"])){
                        $prato = $_GET["buscarprato"];
                        if(!$conexion) {
                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo conectar á nuestra base de datos. Inténtelo más tarde.</div>";
                        } else {
                            $buscarprato = "SELECT * FROM pratos WHERE Prato LIKE '%$prato%'";
                            $resultados = $conexion->query($buscarprato);
                            if($resultados->num_rows==0) {
                                echo "<div class='avisos' style='display: block;'><img src='../../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No existen los platos que tengan los caracteres $prato.</div>";
                            } else {
                                if(isset($_GET["pg"])) {
                                    $paginacion = $_GET["pg"];
                                    if($paginacion<=0 || is_numeric($paginacion)==false) $paginacion=1;
                                }
                                else
                                $paginacion=1;
                                $url="listadepratos.php?buscarplato=$prato&pg=";  
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
                                echo "<table><tr><th>Plato</th><th>Disponible</th><th>Opciones</th></tr>";
                                while($row && $cont<=12){ 
                                    if($row["Disponible"]=="No"){
                                        echo "<tr><td id='prato$j'><input type='hidden' name='prato' value='{$row["Prato"]}'/>{$row["Prato"]}</td>
                                        <td id='disponible$j' style='background-color: red; color: white;'><input type='hidden' name='disponible' value='{$row["Disponible"]}'/>{$row["Disponible"]}</td>
                                        <td><button class='editnote' id='modificarprato$j'><span class='material-symbols-outlined'>edit_note</span></button></td></tr>";
                                        echo "<script>
                                            let modificarprato$j = document.getElementById('modificarprato$j');
                                            modificarprato$j.addEventListener('click', function(){
                                                let edicion = document.getElementById('edicion');
                                                edicion.style.display = 'block';
                                                document.getElementById('nomeanteriorprato').value = '{$row["Prato"]}';
                                                document.getElementById('prato').value = '{$row["Prato"]}';
                                                document.getElementById('disponible').selected = '{$row["Disponible"]}';
                                            });
                                        </script>";
                                    } else if($row["Disponible"]=="Sí"){
                                        echo "<tr><td id='prato$j'><input type='hidden' name='prato' value='{$row["Prato"]}'/>{$row["Prato"]}</td>
                                        <td id='disponible$j' style='background-color: green; color: white;'><input type='hidden' name='disponible' value='{$row["Disponible"]}'/>{$row["Disponible"]}</td>
                                        <td><button class='editnote' id='modificarprato$j'><span class='material-symbols-outlined'>edit_note</span></button></td></tr>";
                                        echo "<script>
                                            let modificarprato$j = document.getElementById('modificarprato$j');
                                            modificarprato$j.addEventListener('click', function(){
                                                let edicion = document.getElementById('edicion');
                                                edicion.style.display = 'block';
                                                document.getElementById('nomeanteriorprato').value = '{$row["Prato"]}';
                                                document.getElementById('prato').value = '{$row["Prato"]}';
                                                document.getElementById('disponible').selected = '{$row["Disponible"]}';
                                            });
                                        </script>";
                                    }
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
                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo conectar á nuestra base de datos. Inténtelo más tarde.</div>";
                        } else {
                            $listarpratos = "SELECT * FROM pratos";
                            $resultados = $conexion->query($listarpratos);
                            if($resultados->num_rows==0) {
                                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Aún no se registraron los platos.</div>";
                            } else {
                                if(isset($_GET["pg"])) {
                                    $paginacion = $_GET["pg"];
                                    if($paginacion<=0 || is_numeric($paginacion)==false) $paginacion=1;
                                }
                                else
                                $paginacion=1;
                                $url="listadepratos.php?platos&pg=";  
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
                                echo "<table><tr><th>Plato</th><th>Disponible</th><th>Opciones</th></tr>";
                                while($row && $cont<=12){ 
                                    if($row["Disponible"]=="No"){
                                        echo "<tr><td id='prato$j'><input type='hidden' name='prato' value='{$row["Prato"]}'/>{$row["Prato"]}</td>
                                        <td id='disponible$j' style='background-color: red; color: white;'><input type='hidden' name='disponible' value='{$row["Disponible"]}'/>{$row["Disponible"]}</td>
                                        <td><button class='editnote' id='modificarprato$j'><span class='material-symbols-outlined'>edit_note</span></button></td></tr>";
                                        echo "<script>
                                            let modificarprato$j = document.getElementById('modificarprato$j');
                                            modificarprato$j.addEventListener('click', function(){
                                                let edicion = document.getElementById('edicion');
                                                edicion.style.display = 'block';
                                                document.getElementById('nomeanteriorprato').value = '{$row["Prato"]}';
                                                document.getElementById('prato').value = '{$row["Prato"]}';
                                                document.getElementById('disponible').value = '{$row["Disponible"]}';
                                            });
                                        </script>";
                                    } else if($row["Disponible"]=="Sí"){
                                        echo "<tr><td id='prato$j'><input type='hidden' name='prato' value='{$row["Prato"]}'/>{$row["Prato"]}</td>
                                        <td id='disponible$j' style='background-color: green; color: white;'><input type='hidden' name='disponible' value='{$row["Disponible"]}'/>{$row["Disponible"]}</td>
                                        <td><button class='editnote' id='modificarprato$j'><span class='material-symbols-outlined'>edit_note</span></button></td></tr>";
                                        echo "<script>
                                            let modificarprato$j = document.getElementById('modificarprato$j');
                                            modificarprato$j.addEventListener('click', function(){
                                                let edicion = document.getElementById('edicion');
                                                edicion.style.display = 'block';
                                                document.getElementById('nomeanteriorprato').value = '{$row["Prato"]}';
                                                document.getElementById('prato').value = '{$row["Prato"]}';
                                                document.getElementById('disponible').value = '{$row["Disponible"]}';
                                            });
                                        </script>";
                                    }
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
                <a class="axuda" href="../../gl/PHP/listadepratos.php">Gallego</a>
                <a class="axuda" href="../../es/PHP/listadepratos.php">Castellano</a>
                <a class="axuda" href="https://www.aepd.es/es/politica-de-privacidad-y-aviso-legal">Política de privacidad</a>
                <a class="axuda" href="https://phylo.co/blog/traccion/que-son-los-terminos-y-condiciones/">Términos</a>
            </div>
            <div class="copyright"><p>Copyright &copy;2023. IES Maximino Romero de Lema</p></div>
        </footer>
    </body>
</html>
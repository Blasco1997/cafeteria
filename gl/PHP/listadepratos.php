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
    <title>BAR MANOLA - Listado de pratos</title>
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
                            <li><a href="listadeprodutos.php">Listado de produtos</a></li>
                            <li><a href="listadeusuarios.php">Listado de usuarios</a></li>
                            <li><a href="produtoscomprados.php">Listado de produtos comprados</a></li>
                            <li><a href="pedidosrealizados.php">Pedidos realizados</a></li>
                            <li><a href="listadeempregados.php">Listado de empregados</a></li>
                            <li>Listado de pratos</li>
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
                <h1 class="tituloconsulta">LISTADO DE PRATOS:</h1>
                <div class="filtrocategoria"></div>
                <form class="busquedaproduto" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="get">
                    <input type="search" name="buscarprato" id="buscar" placeholder="&#128269; Buscar prato"/>
                    <button>Filtrar</button>
                </form>
                <?php
                    $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                    if(!$conexion) {
                        echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non se puido conectar á nosa base de datos. Inténteo máis tarde.</div>";
                    } else {
                        $numpratos = "SELECT COUNT(Id_Prato) AS NumPratos FROM pratos";
                        $resultado = $conexion->query($numpratos);
                        if($resultado->num_rows==0){
                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Ainda non hai pratos publicados.</div>";
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
                                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/correcto.png' width='100%' alt='Aviso'/>Datos do prato actualizados correctamente.</div>";
                                        } else if($conexion->query($actualizarprato)==false){
                                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Por motivos técnicos non se puido actualizar o prato $prato.</div>";
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
                                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/correcto.png' width='100%' alt='Aviso'/>Prato $prato eliminado.</div>";
                                        } else if($conexion->query($actualizarprato)==false){
                                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Por motivos técnicos non se puido eliminar o prato $prato.</div>";
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
                        <h1>MODIFICAR PRATO</h1>
                    </div>
                    <input type="hidden" name="nomeanteriorprato" id="nomeanteriorprato"/>
                    <div class="campoproduto">
                        <label for="produto">Novo nome do prato:</label>
                        <input type="text" name="prato" id="prato"/>
                    </div>
                    <div class="campoproduto">
                    <label for="disponible">Dispoñible:</label>
                        <select name="disponible" id="prato">
                            <option selected="selected">No</option>
                            <option>Sí</option>
                        </select>
                    </div><br/>
                    <div class="campoproduto">
                        <button id="engadir" name="gardarcambios">GARDAR CAMBIOS</button>
                        <button id="eliminar" name="eliminarprato">ELIMINAR PRATO</button>
                    </div>
                </form>
                <?php
                    if(isset($_GET["buscarprato"])){
                        $prato = $_GET["buscarprato"];
                        if(!$conexion) {
                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non se puido conectar á nosa base de datos. Inténteo máis tarde.</div>";
                        } else {
                            $buscarprato = "SELECT * FROM pratos WHERE Prato LIKE '%$prato%'";
                            $resultados = $conexion->query($buscarprato);
                            if($resultados->num_rows==0) {
                                echo "<div class='avisos' style='display: block;'><img src='../../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non existen os pratos que teñan os caracteres $prato.</div>";
                            } else {
                                if(isset($_GET["pg"])) {
                                    $paginacion = $_GET["pg"];
                                    if($paginacion<=0 || is_numeric($paginacion)==false) $paginacion=1;
                                }
                                else
                                $paginacion=1;
                                $url="listadepratos.php?buscarprato=$prato&pg=";  
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
                                echo "<table><tr><th>Prato</th><th>Dispoñible</th><th>Opcións</th></tr>";
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
                                                document.getElementById('disponible').value = 'No';
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
                                                document.getElementById('disponible').value = 'Sí';
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
                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non se puido conectar á nosa base de datos. Inténteo máis tarde.</div>";
                        } else {
                            $listarpratos = "SELECT * FROM pratos";
                            $resultados = $conexion->query($listarpratos);
                            if($resultados->num_rows==0) {
                                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Aínda non se rexistraron os pratos.</div>";
                            } else {
                                if(isset($_GET["pg"])) {
                                    $paginacion = $_GET["pg"];
                                    if($paginacion<=0 || is_numeric($paginacion)==false) $paginacion=1;
                                }
                                else
                                $paginacion=1;
                                $url="listadepratos.php?pratos&pg=";  
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
                                echo "<table><tr><th>Prato</th><th>Dispoñible</th><th>Opcións</th></tr>";
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
                                                document.getElementById('disponible').value = 'No';
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
                                                document.getElementById('disponible').value = 'Sí';
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
                <a class="axuda" href="../../gl/PHP/listadepratos.php">Galego</a>
                <a class="axuda" href="../../es/PHP/listadepratos.php">Castelán</a>
                <a class="axuda" href="https://www.aepd.es/es/politica-de-privacidad-y-aviso-legal">Política de privacidade</a>
                <a class="axuda" href="https://phylo.co/blog/traccion/que-son-los-terminos-y-condiciones/">Términos</a>
            </div>
            <div class="copyright"><p>Copyright &copy;2023. IES Maximino Romero de Lema</p></div>
        </footer>
    </body>
</html>
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
    <title>BAR MANOLA - Lista de proveedores</title>
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
                    <h4>A tu servicio dende 2017</h4>
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
                            <li><a href="listademesas.php">Lista de mesas</a></li>
                            <li><a href="listadereservas.php">Lista de reservas</a></li>
                            <li>Lista de proveedores</li>
                            <li><a href="listadenovas.php">Lista de noticias</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
        <hr>
        <main>
            <section class="consulta">
                <h1 class="tituloconsulta">LISTA DE PROVEEDORES:</h1>
                <div class="filtrocategoria"></div>
                <form class="busquedaproduto" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="get">
                    <input type="search" name="buscarprovedor" id="buscar" placeholder="&#128269; Buscar proveedor"/>
                    <button>Filtrar</button>
                </form>
                <?php
                    $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                    if(!$conexion) {
                        echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo conectar a nuestra base de datos. Inténtelo más tarde.</div>";
                    } else {
                        $numprodutos = "SELECT COUNT(Id_Provedor) AS NumProvedores FROM provedores";
                        $resultado = $conexion->query($numprodutos);
                        if($resultado->num_rows==0){
                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Aún no hay proveedores contratados.</div>";
                        } else {
                            $row = $resultado->fetch_assoc();
                            $totalprovedores = $row["NumProvedores"];
                            for($j=1; $j<=$totalprovedores; $j++){
                                if(isset($_POST["nomeanteriorprovedor"]) && isset($_POST["provedor"]) && isset($_POST["direccion"]) &&
                                isset($_POST["telefono"]) && isset($_POST["paxinaweb"]) && isset($_POST["imaxe"]) && isset($_POST["gardarcambios"])){
                                    $nomeanteriorprovedor = $_POST["nomeanteriorprovedor"];
                                    $provedor = $_POST["provedor"];
                                    $direccion = $_POST["direccion"];
                                    $telefono = $_POST["telefono"];
                                    $paxinaweb = $_POST["paxinaweb"];
                                    $imaxe = $_POST["imaxe"];
                                    $existeprovedor = "SELECT * FROM provedores WHERE Provedor = '$nomeanteriorprovedor'";
                                    $resultado = $conexion->query($existeprovedor);
                                    if($resultado->num_rows==0){
                                        echo "";
                                    } else {
                                        $row = $resultado->fetch_assoc();
                                        $idprovedor = $row["Id_Provedor"];
                                        $actualizarprovedor= "UPDATE provedores SET Provedor = '$provedor', Dirección = '$direccion', Teléfono = '$telefono', Páxina_web = '$paxinaweb' WHERE Id_Provedor = $idprovedor";
                                        if($conexion->query($actualizarprovedor)==true){
                                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/correcto.png' width='100%' alt='Aviso'/>Datos del proveedor actualizados correctamente.</div>";
                                        } else if($conexion->query($actualizarprovedor)==false){
                                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Por motivos técnicos no se pudo actualizar el proveedor $provedor.</div>";
                                        }
                                    }
                                }
                                if(isset($_POST["provedor"]) && isset($_POST["direccion"]) &&
                                isset($_POST["telefono"]) && isset($_POST["paxinaweb"]) && isset($_POST["imaxe"]) && isset($_POST["despedirprovedor"])){
                                    $provedor = $_POST["provedor"];
                                    $direccion = $_POST["direccion"];
                                    $telefono = $_POST["telefono"];
                                    $paxinaweb = $_POST["paxinaweb"];
                                    $imaxe = $_POST["imaxe"];
                                    $existeproduto = "SELECT * FROM provedores WHERE Provedor = '$provedor'";
                                    $resultado = $conexion->query($existeproduto);
                                    if($resultado->num_rows==0){
                                        echo "";
                                    } else {
                                        $row = $resultado->fetch_assoc();
                                        $idprovedor = $row["Id_Provedor"];
                                        $despedirprovedor = "DELETE FROM provedores WHERE Id_Provedor = $idprovedor";
                                        if($conexion->query($despedirprovedor)==true){
                                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/correcto.png' width='100%' alt='Aviso'/>Se ha despedido al proveedor $provedor.</div>";
                                        } else if($conexion->query($despedirprovedor)==false){
                                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Por motivos técnicos no se pudo dar la orden de despido para el proveedor $provedor.</div>";
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
                        <h1>MODIFICAR PROVEEDOR</h1>
                    </div>
                    <input type="hidden" name="nomeanteriorprovedor" id="nomeanteriorprovedor"/>
                    <div class="campoproduto">
                        <label for="produto">Nuevo nombre do provedor:</label>
                        <input type="text" name="provedor" id="provedor"/>
                    </div>
                    <div class="campoproduto">
                        <label for="direccion">Dirección:</label>
                        <input type="text" name="direccion" id="direccion"/>
                    </div><br/>
                    <div class="campoproduto">
                        <label for="telefono">Teléfono:</label>
                        <input type="tel" name="telefono" id="telefono"/>
                    </div>
                    <div class="campoproduto">
                        <label for="paxinaweb">Página web:</label>
                        <input type="url" name="paxinaweb" id="paxinaweb"/>
                    </div>
                    <div class="campoproduto">
                        <label for="imaxe">Imagen:</label>
                        <input type="file" name="imaxe" id="seleccionArchivos" accept="image/*">
                        <br><br>
                        <!-- A imaxe que imos usar para previsualizar o que o usuario seleccione -->
                        <img id="imagenPrevisualizacion">
                        <script type="text/javascript" src="../JavaScript/subirimagen.js"></script>
                    </div>
                    <div class="campoproduto">
                        <button id="engadir" name="gardarcambios">GUARDAR CAMBIOS</button>
                        <button id="eliminar" name="despedirprovedor">DESPEDIR PROVEEDOR</button>
                    </div>
                </form>
                <?php
                    if(isset($_GET["buscarprovedor"])){
                        $provedor = $_GET["buscarprovedor"];
                        $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                        if(!$conexion) {
                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo conectar a nuestra base de datos. Inténtelo más tarde.</div>";
                        } else {
                            $buscarprovedor = "SELECT * FROM provedores WHERE Provedor LIKE '%$provedor%'";
                            $resultados = $conexion->query($buscarprovedor);
                            if($resultados->num_rows==0) {
                                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No hay ningún proveedor que contenga los caracteres $provedor.</div>";
                            } else {
                                if(isset($_GET["pg"])) {
                                    $paginacion = $_GET["pg"];
                                    if($paginacion<=0 || is_numeric($paginacion)==false) $paginacion=1;
                                }
                                else
                                $paginacion=1;
                                $url="listadeprovedores.php?buscarproveedor=$provedores&pg=";  
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
                                echo "<div class='listadoprovedores'>";
                                echo "<table><tr><th>Logo</th><th>Proveedor</th><th>Dirección</th><th>Teléfono</th><th>Página web</th><th>Opciones</th></tr>";
                                while($row && $cont<=12){  
                                    echo "<tr><td id='logo$j'><input type='hidden' name='logo' value='{$row["Logo"]}'/><img src={$row["Logo"]} width='70' alt='Empresa'/></td>
                                    <td id='provedor$j'><input type='hidden' name='provedor' value='{$row["Provedor"]}'/>{$row["Provedor"]}</td>
                                    <td id='direccion$j'><input type='hidden' name='direccion' value='{$row["Dirección"]}'/>{$row["Dirección"]}</td>
                                    <td id='telefono$j'><input type='hidden' name='telefono' value='{$row["Teléfono"]}'/>{$row["Teléfono"]}</td>
                                    <td id='paxinaweb$j'><input type='hidden' name='paxinaweb' value='{$row["Páxina_web"]}'/><a href='{$row["Páxina_web"]}'>{$row["Páxina_web"]}</a></td>
                                    <td><button class='editnote' id='modificarprovedor$j'><span class='material-symbols-outlined'>edit_note</span></button></td></tr>";
                                    echo "<script>
                                        let modificarprovedor$j = document.getElementById('modificarprovedor$j');
                                        modificarprovedor$j.addEventListener('click', function(){
                                            let edicion = document.getElementById('edicion');
                                            edicion.style.display = 'block';
                                            document.getElementById('nomeanteriorprovedor').value = '{$row["Provedor"]}';
                                            document.getElementById('provedor').value = '{$row["Provedor"]}';
                                            document.getElementById('direccion').value = '{$row["Dirección"]}';
                                            document.getElementById('telefono').value = '{$row["Teléfono"]}';
                                            document.getElementById('paxinaweb').value = '{$row["Páxina_web"]}';
                                            document.getElementById('imaxe').value = '{$row["Logo"]}';
                                        });
                                    </script>";
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
                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se puido conectar a nuestra base de datos. Inténtelo más tarde.</div>";
                        } else {
                            $listarprovedores = "SELECT * FROM provedores";
                            $resultados = $conexion->query($listarprovedores);
                            if($resultados->num_rows==0) {
                                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Aún no hay proveedores contratados.</div>";
                            } else {
                                if(isset($_GET["pg"])) {
                                    $paginacion = $_GET["pg"];
                                    if($paginacion<=0 || is_numeric($paginacion)==false) $paginacion=1;
                                }
                                else
                                $paginacion=1;
                                $url="listadeprovedores.php?proveedores&pg=";  
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
                                    echo "<a href='$url".($paginacion+1)."'>Seguinte&gt;&gt;</a>";
                                echo "</p>";
                                $posicion=($paginacion-1)*12;
                                $resultados->data_seek($posicion);
                                $cont=1;
                                $j=1;
                                $row=$resultados->fetch_assoc();
                                echo "<div class='listadoprodutos'>";
                                echo "<table><tr><th>Logo</th><th>Proveedor</th><th>Dirección</th><th>Teléfono</th><th>Página web</th><th>Opciones</th></tr>";
                                while($row && $cont<=12){  
                                    echo "<tr><td id='logo$j'><input type='hidden' name='logo' value='{$row["Logo"]}'/><img src={$row["Logo"]} width='70' alt='Empresa'/></td>
                                    <td id='provedor$j'><input type='hidden' name='provedor' value='{$row["Provedor"]}'/>{$row["Provedor"]}</td>
                                    <td id='direccion$j'><input type='hidden' name='direccion' value='{$row["Dirección"]}'/>{$row["Dirección"]}</td>
                                    <td id='telefono$j'><input type='hidden' name='telefono' value='{$row["Teléfono"]}'/>{$row["Teléfono"]}</td>
                                    <td id='paxinaweb$j'><input type='hidden' name='paxinaweb' value='{$row["Páxina_web"]}'/><a href='{$row["Páxina_web"]}'>{$row["Páxina_web"]}</a></td>
                                    <td><button class='editnote' id='modificarprovedor$j'><span class='material-symbols-outlined'>edit_note</span></button></td></tr>";
                                    echo "<script>
                                        let modificarprovedor$j = document.getElementById('modificarprovedor$j');
                                        modificarprovedor$j.addEventListener('click', function(){
                                            let edicion = document.getElementById('edicion');
                                            edicion.style.display = 'block';
                                            document.getElementById('nomeanteriorprovedor').value = '{$row["Provedor"]}';
                                            document.getElementById('provedor').value = '{$row["Provedor"]}';
                                            document.getElementById('direccion').value = '{$row["Dirección"]}';
                                            document.getElementById('telefono').value = '{$row["Teléfono"]}';
                                            document.getElementById('paxinaweb').value = '{$row["Páxina_web"]}';
                                            document.getElementById('imaxe').value = '{$row["Logo"]}';
                                        });
                                    </script>";
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
                <a class="axuda" href="../../gl/PHP/listadeprovedores.php">Gallego</a>
                <a class="axuda" href="../../es/PHP/listadeprovedores.php">Castellano</a>
                <a class="axuda" href="https://www.aepd.es/es/politica-de-privacidad-y-aviso-legal">Política de privacidad</a>
                <a class="axuda" href="https://phylo.co/blog/traccion/que-son-los-terminos-y-condiciones/">Términos</a>
            </div>
            <div class="copyright"><p>Copyright &copy;2023. IES Maximino Romero de Lema</p></div>
        </footer>
    </body>
</html>
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
    <title>BAR MANOLA - Lista de empleados</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="<?php echo (CSSPATH . "$css" );?>">
    <script src="../JavaScript/jQuery/jquery-3.6.3.js" type="text/javascript"></script>
</head>
    <body>
        <header>
            <div id="logoytitulo">
                <a href="indexempregado.php"><img src="../Imaxes/Xerais/Logo_Cafetería.png" width="100%" alt="Bar Manola"/></a>
                <div id="desctitulo">
                    <h1>BIENVIDO A BAR MANOLA</h1><br/>
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
                            <li>Lista de empleados</li>
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
            <section class="consulta">
                <h1 class="tituloconsulta">LISTA DE EMPLEADOS:</h1>
                <div class="filtrocategoria"></div>
                <form class="busquedaproduto" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="get">
                    <input type="search" name="buscarempregado" id="buscar" placeholder="&#128269; Buscar empleado"/>
                    <button>Filtrar</button>
                </form>
                <?php
                    $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                    if(!$conexion) {
                        echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo conectar a nuestra base de datos. Inténtelo más tarde.</div>";
                    } else {
                        $numempregados = "SELECT COUNT(Id_Empregado) AS NumEmpregados FROM empregados";
                        $resultado = $conexion->query($numempregados);
                        if($resultado->num_rows==0){
                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Sin empregados.</div>";
                        } else {
                            $row = $resultado->fetch_assoc();
                            $totalempregados = $row["NumEmpregados"];
                            for($j=1; $j<=$totalempregados; $j++){
                                if(isset($_POST["nomeanteriorusuario"]) && isset($_POST["imaxe"]) && isset($_POST["usuario"]) && isset($_POST["nomecompleto"]) && isset($_POST["novacontrasinal"]) &&
                                isset($_POST["repitacontrasinal"]) && isset($_POST["telefono"]) && isset($_POST["correo"]) && isset($_POST["gardarcambios"])){
                                    $nomeanteriorusuario = $_POST["nomeanteriorusuario"];
                                    $imaxe = $_POST["imaxe"];
                                    $usuario = $_POST["usuario"];
                                    $nomecompleto = $_POST["nomecompleto"];
                                    $novacontrasinal = $_POST["novacontrasinal"];
                                    $repitacontrasinal = $_POST["repitacontrasinal"];
                                    $telefono = $_POST["telefono"];
                                    $correo = $_POST["correo"];
                                    $existeempregado= "SELECT * FROM empregados WHERE Usuario = '$nomeanteriorusuario'";
                                    $resultado = $conexion->query($existeempregado);
                                    if($resultado->num_rows==0){
                                        echo "";
                                    } else {
                                        $row = $resultado->fetch_assoc();
                                        if($novacontrasinal == $repitacontrasinal){
                                            $idempregado = $row["Id_Empregado"];
                                            $actualizarempregado = "UPDATE empregados SET Perfil = '$imaxe', Usuario = '$usuario', Nome_completo = '$nomecompleto', Contrasinal = '$novacontrasinal', Telefono = '$telefono', Correo = '$correo' WHERE Id_Empregado = $idempregado";
                                            if($conexion->query($actualizarempregado)==true){
                                                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/correcto.png' width='100%' alt='Aviso'/>Datos del empleado actualizados correctamente.</div>";
                                            } else if($conexion->query($actualizarempregado)==false){
                                                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Por motivos técnicos no se pudo actualizar los datos del empleado $nomecompleto.</div>";
                                            }
                                        } else if($novacontrasinal != $repitacontrasinal){
                                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Las contraseñas no coinciden.</div>";
                                        }
                                    }
                                }
                                if(isset($_POST["imaxe"]) && isset($_POST["usuario"]) && isset($_POST["nomecompleto"]) && isset($_POST["novacontrasinal"]) &&
                                isset($_POST["repitacontrasinal"]) && isset($_POST["telefono"]) && isset($_POST["correo"]) && isset($_POST["eliminarempregado"])){
                                    $imaxe = $_POST["imaxe"];
                                    $usuario = $_POST["usuario"];
                                    $nomecompleto = $_POST["nomecompleto"];
                                    $novacontrasinal = $_POST["novacontrasinal"];
                                    $repitacontrasinal = $_POST["repitacontrasinal"];
                                    $telefono = $_POST["telefono"];
                                    $correo = $_POST["correo"];
                                    $existeempregado= "SELECT * FROM empregados WHERE Usuario = '$usuario'";
                                    $resultado = $conexion->query($existeempregado);
                                    if($resultado->num_rows==0){
                                        echo "";
                                    } else {
                                        $row = $resultado->fetch_assoc();
                                        $idempregado = $row["Id_Empregado"];
                                        $eliminarempregado = "DELETE FROM empregados WHERE Id_Empregado = $idempregado";
                                        if($conexion->query($eliminarempregado)==true){
                                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/correcto.png' width='100%' alt='Aviso'/>Empleado eliminado correctamente.</div>";
                                        } else if($conexion->query($eliminarempregado)==false){
                                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Por motivos técnicos no se pudo despedir al empleado $nomecompleto.</div>";
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
                        <h1>MODIFICAR EMPLEADO</h1>
                    </div><br/>
                    <input type="hidden" name='nomeanteriorusuario' id="nomeanteriorusuario"/>
                    <div class="campoproduto">
                        <label for="imaxe">Imagen:</label>
                        <input type="file" name="imaxe" id="seleccionArchivos" accept="image/*">
                        <br><br>
                        <!-- A imaxe que imos usar para previsualizar o que o usuario seleccione -->
                        <img id="imagenPrevisualizacion">
                        <script type="text/javascript" src="../JavaScript/subirimagen.js"></script>
                    </div><br/>
                    <div class="campoproduto">
                        <label for="novousuario">Nuevo nombre de usuario:</label>
                        <input type="text" name="usuario" id="usuario"/>
                    </div>
                    <div class="campoproduto">
                        <label for="nomecompleto">Nombre completo:</label>
                        <input type="text" name="nomecompleto" id="nomecompleto"/>
                    </div>
                    <div class="campoproduto">
                        <label for="novacontrasinal">Nueva contraseña:</label>
                        <input type="password" name="novacontrasinal" id="novacontrasinal"/>
                    </div><br/>
                    <div class="campoproduto">
                        <label for="repitacontrasinal">Repita contraseña:</label>
                        <input type="password" name="repitacontrasinal" id="repitacontrasinal"/>
                    </div>
                    <div class="campoproduto">
                        <label for="telefono">Teléfono:</label>
                        <input type="tel" name="telefono" id="telefono"/>
                    </div>
                    <div class="campoproduto">
                        <label for="correo">Correo:</label>
                        <input type="email" name="correo" id="correo"/>
                    </div><br/>
                    <div class="campoproduto">
                        <button id="rexistrar" name="gardarcambios">GUARDAR CAMBIOS</button>
                        <button id="eliminar" name="eliminarempregado">DESPEDIR EMPLEADO</button>
                    </div>
                </form>
                <?php
                    if(isset($_GET["buscarempregado"])){
                        $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                        if(!$conexion) {
                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo conectar a nuestra base de datos. Inténtelo más tarde.</div>";
                        } else {
                            $empregado = $_GET["buscarempregado"];
                            $buscarempregado = "SELECT * FROM empregados WHERE Usuario LIKE '%$empregado%' OR Nome_completo LIKE '%$empregado%'";
                            $resultados = $conexion->query($buscarempregado);
                            if($resultados->num_rows==0) {
                                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No existen los empleados que tengan los caracteres $empregado.</div>";
                            } else {
                                if(isset($_GET["pg"])) {
                                    $paginacion = $_GET["pg"];
                                    if($paginacion<=0 || is_numeric($paginacion)==false) $paginacion=1;
                                }
                                else
                                $paginacion=1;
                                $url="listadeempregados.php?buscarempleado=$empregado&pg=";  
                                echo "<p class='pagina'>";
                                if($paginacion>1)
                                    echo "<a href='$url".($paginacion-1)."'>&lt; Anterior</a>";
                                $total_paginas=(int)($resultados->num_rows/12+1);
                                for($i=1;$i<=$total_paginas;$i++){
                                    if($i==$paginacion)
                                        echo "<span class='paginaActual'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$i&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>";
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
                                echo "<table><tr><th>Perfil</th><th>Usuario</th><th>Nombre completo</th><th>Teléfono</th><th>Correo</th><th>Opciones</th></tr>";
                                while($row && $cont<=12){  
                                    if($row["Usuario"]=="admin"){
                                        echo "<tr><td colspan='6' style='background-color: red; color: white; text-align: center;'>La cuenta de Administrador no se puede borrar ni modificar.</td></tr>";
                                    } else {
                                        echo "<tr><td id='perfil$j'><input type='hidden' name='perfil' value='{$row["Perfil"]}'/><img src='{$row["Perfil"]}' width='70' alt='Perfil'/></td>
                                        <td id='usuario$j'><input type='hidden' name='produto' value='{$row["Usuario"]}'/>{$row["Usuario"]}</td>
                                        <td id='nomecompleto$j'><input type='hidden' name='descricion' value='{$row["Nome_completo"]}'/>{$row["Nome_completo"]}</td>
                                        <td id='telefono$j'><input type='hidden' name='stock' value='{$row["Telefono"]}'/>{$row["Telefono"]}</td>
                                        <td id='correo$j'><input type='hidden' name='correo' value='{$row["Correo"]}'/><a href='mailto:{$row["Correo"]}'>{$row["Correo"]}</a></td>
                                        <td><button class='editnote' id='modificarproduto$j'><span class='material-symbols-outlined'>edit_note</span></button></td></tr>";
                                        echo "<script>
                                            let modificarproduto$j = document.getElementById('modificarproduto$j');
                                            modificarproduto$j.addEventListener('click', function(){
                                                let edicion = document.getElementById('edicion');
                                                edicion.style.display = 'block';
                                                document.getElementById('nomeanteriorusuario').value = '{$row["Usuario"]}';
                                                document.getElementById('usuario').value = '{$row["Usuario"]}';
                                                document.getElementById('novacontrasinal').value = '{$row["Contrasinal"]}';
                                                document.getElementById('repitacontrasinal').value = '{$row["Contrasinal"]}';
                                                document.getElementById('nomecompleto').value = '{$row["Nome_completo"]}';
                                                document.getElementById('telefono').value = '{$row["Telefono"]}';
                                                document.getElementById('correo').value = '{$row["Correo"]}';
                                                document.getElementById('seleccionArchivos').value = '{$row["Perfil"]}';
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
                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo conectar a nosa base de datos. Inténtelo más tarde.</div>";
                        } else {
                            $listarempregados = "SELECT * FROM empregados";
                            $resultados = $conexion->query($listarempregados);
                            if($resultados->num_rows==0) {
                                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Aún no se registraron los empleados.</div>";
                            } else {
                                if(isset($_GET["pg"])) {
                                    $paginacion = $_GET["pg"];
                                    if($paginacion<=0 || is_numeric($paginacion)==false) $paginacion=1;
                                }
                                else
                                $paginacion=1;
                                $url="listadeempregados.php?empleados&pg=";  
                                echo "<p class='pagina'>";
                                if($paginacion>1)
                                    echo "<a href='$url".($paginacion-1)."'>&lt; Anterior</a>";
                                $total_paginas=(int)($resultados->num_rows/12+1);
                                for($i=1;$i<=$total_paginas;$i++){
                                    if($i==$paginacion)
                                        echo "";
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
                                echo "<table><tr><th>Perfil</th><th>Usuario</th><th>Nombre completo</th><th>Teléfono</th><th>Correo</th><th>Opciones</th></tr>";
                                while($row && $cont<=12){  
                                    if($row["Usuario"]=="admin"){
                                        echo "<tr><td colspan='6' style='background-color: red; color: white; text-align: center;'>La cuenta de Administrador no se puede borrar ni modificar.</td></tr>";
                                    } else {
                                        echo "<tr><td id='perfil$j'><input type='hidden' name='perfil' value='{$row["Perfil"]}'/><img src='{$row["Perfil"]}' width='70' alt='Perfil'/></td>
                                        <td id='usuario$j'><input type='hidden' name='produto' value='{$row["Usuario"]}'/>{$row["Usuario"]}</td>
                                        <td id='nomecompleto$j'><input type='hidden' name='descricion' value='{$row["Nome_completo"]}'/>{$row["Nome_completo"]}</td>
                                        <td id='telefono$j'><input type='hidden' name='stock' value='{$row["Telefono"]}'/>{$row["Telefono"]}</td>
                                        <td id='correo$j'><input type='hidden' name='correo' value='{$row["Correo"]}'/><a href='mailto:{$row["Correo"]}'>{$row["Correo"]}</a></td>
                                        <td><button class='editnote' id='modificarproduto$j'><span class='material-symbols-outlined'>edit_note</span></button></td></tr>";
                                        echo "<script>
                                            let modificarproduto$j = document.getElementById('modificarproduto$j');
                                            modificarproduto$j.addEventListener('click', function(){
                                                let edicion = document.getElementById('edicion');
                                                edicion.style.display = 'block';
                                                document.getElementById('nomeanteriorusuario').value = '{$row["Usuario"]}';
                                                document.getElementById('usuario').value = '{$row["Usuario"]}';
                                                document.getElementById('novacontrasinal').value = '{$row["Contrasinal"]}';
                                                document.getElementById('repitacontrasinal').value = '{$row["Contrasinal"]}';
                                                document.getElementById('nomecompleto').value = '{$row["Nome_completo"]}';
                                                document.getElementById('telefono').value = '{$row["Telefono"]}';
                                                document.getElementById('correo').value = '{$row["Correo"]}';
                                                document.getElementById('seleccionArchivos').value = '{$row["Perfil"]}';
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
                <a class="axuda" href="../../gl/PHP/listadeempregados.php">Gallego</a>
                <a class="axuda" href="../../es/PHP/listadeempregados.php">Castellano</a>
                <a class="axuda" href="https://www.aepd.es/es/politica-de-privacidad-y-aviso-legal">Política de privacidad</a>
                <a class="axuda" href="https://phylo.co/blog/traccion/que-son-los-terminos-y-condiciones/">Términos</a>
            </div>
            <div class="copyright"><p>Copyright &copy;2023. IES Maximino Romero de Lema</p></div>
        </footer>
    </body>
</html>
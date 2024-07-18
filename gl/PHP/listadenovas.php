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
    <title>BAR MANOLA - Lista de novas</title>
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
                            <li><a href="listadepratos.php">Listado de pratos</a></li>
                            <li><a href="listademenus.php">Listado de menús</a></li>
                            <li><a href="listademesas.php">Listado de mesas</a></li>
                            <li><a href="listadereservas.php">Listado de reservas</a></li>
                            <li><a href="listadeprovedores.php">Listado de provedores</a></li>
                            <li>Listado de novas</li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
        <hr>
        <main>
            <section class="consulta">
                <h1 class="tituloconsulta">LISTA DE NOVAS:</h1>
                <div class="filtrocategoria"></div>
                <form class="busquedaproduto" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="get">
                    <input type="search" name="buscarnova" id="buscar" placeholder="&#128269; Buscar nova"/>
                    <button>Filtrar</button>
                </form>
                <?php
                    $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                    if(!$conexion) {
                        echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='50%' alt='Aviso'/>Non se puido conectar a nosa base de datos. Inténteo máis tarde.</div>";
                    } else {
                        $numnovas = "SELECT COUNT(Id_Publicacion) AS NumNovas FROM publicacions";
                        $resultado = $conexion->query($numnovas);
                        if($resultado->num_rows==0){
                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='50%' alt='Aviso'/>Aínda non hai novas publicadas.</div>";
                        } else {
                            $row = $resultado->fetch_assoc();
                            $totalnovas = $row["NumNovas"];
                            for($j=1; $j<=$totalnovas; $j++){
                                if(isset($_POST["tituloanterior"]) && isset($_POST["enlace"]) && isset($_POST["titulo"]) && isset($_POST["dia"]) 
                                && isset($_SESSION["usuario"]) && isset($_POST["gardarcambios"])){
                                    $tituloanterior = $_POST["tituloanterior"];
                                    $enlace = $_POST["enlace"];
                                    $titulo = $_POST["titulo"];
                                    $dia = $_POST["dia"];
                                    $empregado = $_SESSION["usuario"];
                                    $existepublicacion = "SELECT * FROM publicacions WHERE Titulo = '$tituloanterior'";
                                    $resultado = $conexion->query($existepublicacion);
                                    if($resultado->num_rows==0){
                                        echo "";
                                    } else {
                                        $row = $resultado->fetch_assoc();
                                        $idpublicacion = $row["Id_Publicacion"];
                                        $existeempregado = "SELECT * FROM empregados WHERE Nome_completo = '$empregado'";
                                        $resultado = $conexion->query($existeempregado);
                                        if($resultado->num_rows==0){
                                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='50%' alt='Aviso'/>Non existe o empregado $empregado.</div>";
                                        } else {
                                            $row = $resultado->fetch_assoc();
                                            $idempregado = $row["Id_Empregado"];
                                            $actualizarnova = "UPDATE publicacions SET Enlace = '$enlace', Titulo = '$titulo', Día = '$dia', Id_Empregado = '$idempregado' WHERE Titulo = '$tituloanterior'";
                                            if($conexion->query($actualizarnova)==true){
                                                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/correcto.png' width='50%' alt='Aviso'/>Nova actualizada correctamente.</div>";
                                            } else if($conexion->query($actualizarnova)==false){
                                                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='50%' alt='Aviso'/>Por motivos técnicos non se puido eliminar a nova.</div>";
                                            }
                                        }
                                    }
                                } else if(isset($_POST["enlace"]) && isset($_POST["titulo"]) && isset($_POST["dia"]) 
                                && isset($_SESSION["usuario"]) && isset($_POST["eliminarnova"])){
                                    $enlace = $_POST["enlace"];
                                    $titulo = $_POST["titulo"];
                                    $dia = $_POST["dia"];
                                    $empregado = $_SESSION["usuario"];
                                    $existepublicacion = "SELECT * FROM publicacions WHERE Titulo = '$titulo'";
                                    $resultado = $conexion->query($existepublicacion);
                                    if($resultado->num_rows==0){
                                        echo "";
                                    } else {
                                        $row = $resultado->fetch_assoc();
                                        $idpublicacion = $row["Id_Publicacion"];
                                        $existeempregado = "SELECT * FROM empregados WHERE Nome_completo = '$empregado'";
                                        $resultado = $conexion->query($existeempregado);
                                        if($resultado->num_rows==0){
                                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='50%' alt='Aviso'/>Non existe o empregado $empregado.</div>";
                                        } else {
                                            $row = $resultado->fetch_assoc();
                                            $idempregado = $row["Id_Empregado"];
                                            $eliminarnova = "DELETE FROM publicacions WHERE Id_Publicacion = $idpublicacion";
                                            if($conexion->query($eliminarnova)==true){
                                                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/correcto.png' width='50%' alt='Aviso'/>Nova eliminada correctamente.</div>";
                                            } else if($conexion->query($eliminarnova)==false){
                                                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='50%' alt='Aviso'/>Por motivos técnicos non se puido eliminar a nova.</div>";
                                            }
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
                        <h1>MODIFICAR NOVA</h1>
                    </div>
                    <input type="hidden" name="tituloanterior" id="tituloanterior"/>
                    <div class="campoproduto">
                        <label for="titulo">Título da nova:</label>
                        <input type="text" name="titulo" id="titulo"/>
                    </div>
                    <div class="campoproduto">
                        <label for="enlace">Enlace:</label>
                        <input type="text" name="enlace" id="enlace"/>
                    </div>
                    <div class="campoproduto">
                        <label for="dia">Data:</label>
                        <input type="date" name="dia" id="dia"/>
                    </div><br/>
                    <div class="campoproduto">
                        <button id="engadir" name="gardarcambios">GARDAR CAMBIOS</button>
                        <button id="eliminar" name="eliminarnova">ELIMINAR NOVA</button>
                    </div>
                </form>
                <?php
                    if(isset($_GET["buscarnova"])){
                        $nova = $_GET["buscarnova"];
                        if(!$conexion) {
                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non se puido conectar a nosa base de datos. Inténteo máis tarde.</div>";
                        } else {
                            $buscarnova = "SELECT pb.Id_Publicacion AS Id_Publicación, pb.Imaxe AS Imaxe, pb.Titulo AS Titulo, pb.Enlace AS Enlace, pb.Día AS Día, em.Nome_completo AS Autor FROM publicacions AS pb 
                            JOIN empregados AS em ON pb.Id_Empregado = em.Id_Empregado WHERE pb.Titulo LIKE '%$nova%' OR pb.Enlace LIKE '%$nova%'";
                            $resultados = $conexion->query($buscarnova);
                            if($resultados->num_rows==0) {
                                echo "<div class='avisos' style='display: block;'><img src='../../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non existen novas que teñan os caracteres $nova.</div>";
                            } else {
                                if(isset($_GET["pg"])) {
                                    $paginacion = $_GET["pg"];
                                    if($paginacion<=0 || is_numeric($paginacion)==false) $paginacion=1;
                                }
                                else
                                $paginacion=1;
                                $url="listadenovas.php?buscarnova=$noticia&pg=";  
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
                                echo "<table><tr><th>Imaxe</th><th>Título</th><th>Enlace</th><th>Día</th><th>Autor</th><th>Opcións</th></tr>";
                                while($row && $cont<=12){ 
                                    echo "<tr><td id='imaxe$j'><input type='hidden' name='imaxe' value='{$row["Imaxe"]}'/>{$row["Imaxe"]}</td>
                                    <td id='titulo$j'><input type='hidden' name='titulo' value='{$row["Titulo"]}'/>{$row["Titulo"]}</td>
                                    <td id='enlace$j'><input type='hidden' name='enlace' value='{$row["Enlace"]}'/><a href='{$row["Enlace"]}'>{$row["Enlace"]}</a></td>
                                    <td id='dia$j'><input type='hidden' name='dia' value='{$row["Día"]}'/>{$row["Día"]}</td>
                                    <td id='autor$j'><input type='hidden' name='autor' value='{$row["Autor"]}'/>{$row["Autor"]}</td>
                                    <td><button class='editnote' id='modificarprato$j'><span class='material-symbols-outlined'>edit_note</span></button></td></tr>";
                                    echo "<script>
                                        let modificarprato$j = document.getElementById('modificarprato$j');
                                        modificarprato$j.addEventListener('click', function(){
                                            let edicion = document.getElementById('edicion');
                                            edicion.style.display = 'block';
                                            document.getElementById('tituloanterior').value = '{$row["Titulo"]}';
                                            document.getElementById('titulo').value = '{$row["Titulo"]}';
                                            document.getElementById('enlace').value = '{$row["Enlace"]}';
                                            document.getElementById('dia').value = '{$row["Día"]}';
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
                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non se puido conectar a nosa base de datos. Inténtelo máis tarde.</div>";
                        } else {
                            $listarpratos = "SELECT pb.Id_Publicacion AS Id_Publicación, pb.Imaxe AS Imaxe, pb.Titulo AS Titulo, pb.Enlace AS Enlace, pb.Día AS Día, em.Nome_completo AS Autor FROM publicacions AS pb 
                            JOIN empregados AS em ON pb.Id_Empregado = em.Id_Empregado";
                            $resultados = $conexion->query($listarpratos);
                            if($resultados->num_rows==0) {
                                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Aínda non foi publicada ningunha nova</div>";
                            } else {
                                if(isset($_GET["pg"])) {
                                    $paginacion = $_GET["pg"];
                                    if($paginacion<=0 || is_numeric($paginacion)==false) $paginacion=1;
                                }
                                else
                                $paginacion=1;
                                $url="listadenovas.php?novas&pg=";  
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
                                echo "<table><tr><th>Imaxe</th><th>Título</th><th>Enlace</th><th>Día</th><th>Autor</th><th>Opcións</th></tr>";
                                while($row && $cont<=12){ 
                                    echo "<tr><td id='imaxe$j'><input type='hidden' name='imaxe' value='{$row["Imaxe"]}'/><img src='{$row["Imaxe"]}' width='70' alt='Imaxe'/></td>
                                    <td id='titulo$j'><input type='hidden' name='titulo' value='{$row["Titulo"]}'/>{$row["Titulo"]}</td>
                                    <td id='enlace$j'><input type='hidden' name='enlace' value='{$row["Enlace"]}'/><a href='{$row["Enlace"]}'>{$row["Enlace"]}</a></td>
                                    <td id='dia$j'><input type='hidden' name='dia' value='{$row["Día"]}'/>{$row["Día"]}</td>
                                    <td id='autor$j'><input type='hidden' name='autor' value='{$row["Autor"]}'/>{$row["Autor"]}</td>
                                    <td><button class='editnote' id='modificarprato$j'><span class='material-symbols-outlined'>edit_note</span></button></td></tr>";
                                    echo "<script>
                                        let modificarprato$j = document.getElementById('modificarprato$j');
                                        modificarprato$j.addEventListener('click', function(){
                                            let edicion = document.getElementById('edicion');
                                            edicion.style.display = 'block';
                                            document.getElementById('tituloanterior').value = '{$row["Titulo"]}';
                                            document.getElementById('titulo').value = '{$row["Titulo"]}';
                                            document.getElementById('enlace').value = '{$row["Enlace"]}';
                                            document.getElementById('dia').value = '{$row["Día"]}';
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
                <h2>Os novos colaboradores</h2>
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
                <a class="axuda" href="../../gl/PHP/listadenovas.php">Galego</a>
                <a class="axuda" href="../../es/PHP/listadenovas.php">Castelán</a>
                <a class="axuda" href="https://www.aepd.es/es/politica-de-privacidad-y-aviso-legal">Política de privacidade</a>
                <a class="axuda" href="https://phylo.co/blog/traccion/que-son-los-terminos-y-condiciones/">Términos</a>
            </div>
            <div class="copyright"><p>Copyright &copy;2023. IES Maximino Romero de Lema</p></div>
        </footer>
    </body>
</html>
<?php
    define('CSSPATH', '');
    $css = "../CSS/estilosxeraiscafeteria.css";
    session_start();
    if(!isset($_SESSION["cliente"])){
        $usuario = '<a id="usuario" href="login.php">Iniciar sesión</a>|<a href="rexistrarse.php">Rexistrarse</a>';
    } else {
        $usuario = '<img style="border-radius: 100%;" src="../Imaxes/Xerais/User.png" width="30" alt="User"/>'.$_SESSION["cliente"].'<span class="material-symbols-outlined" id="morevert">more_vert
        <ul>
            <li><a href="cerrarsesioncliente.php">Pechar sesión</a></li><br/>
            <li><a href="eliminarcuentacliente.php"><span class="material-symbols-outlined" id="eliminarcuenta">close</span>Eliminar conta</a></li>
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
    <title>BAR MANOLA - Novas do noso local</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="<?php echo (CSSPATH . "$css" );?>">
    <script src="../JavaScript/jQuery/jquery-3.6.3.js" type="text/javascript"></script>
</head>
<body>
    <header>
        <div id="logoytitulo">
            <?php 
                if(!isset($_SESSION["cliente"])){
                    echo "<a href='../../gl/index.html'><img src='../Imaxes/Xerais/Logo_Cafetería.png' width='100%' alt='Bar Manola'/></a>";
                } else {
                    echo "<a href='indexcliente.php'><img src='../Imaxes/Xerais/Logo_Cafetería.png' width='100%' alt='Bar Manola'/></a>";
                }
            ?>
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
                <?php
                    if(!isset($_SESSION["cliente"])){
                        echo "";
                    } else {
                        echo "<li><a href='reservarprato.php'>Reservar</a></li>";
                    } 
                ?>
                <li><a href="produtos1.php">Produtos</a></li>
                <li><a href="quensomos.php">Quen somos</a></li>
            </ul>
        </nav>
    </header>
    <hr>
    <main>
        <section id="quensomos">
            <h1>NOVAS DO NOSO LOCAL</h1>
            <?php
                $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
                if(!$conexion) {
                    echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non se puido conectar á nosa base de datos. Inténteo máis tarde.</div>";
                } else {
                    $publicacions = "SELECT p.Titulo AS Titulo, p.Imaxe AS Imaxe, p.Enlace AS Enlace, p.Día AS DataPublicacion, e.Nome_completo AS Usuario 
                    FROM publicacions AS p JOIN empregados AS e ON p.Id_Empregado = e.Id_Empregado ORDER BY p.Día DESC";
                    $resultados = $conexion->query($publicacions);
                    if($resultados->num_rows==0) {
                        echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Aínda non foi publicada ningunha nova.</div>";
                    } else {
                        if(isset($_GET["pg"])) {
                            $paginacion = $_GET["pg"];
                            if($paginacion<=0 || is_numeric($paginacion)==false) $paginacion=1;
                        }
                        else
                        $paginacion=1;
                        $url="novasdonosolocal.php?noticias&pg=";  
                        echo "<p class='pagina'>";
                        if($paginacion>1)
                            echo "<a href='$url".($paginacion-1)."'>&lt; Anterior</a>";
                        $total_paginas=(int)($resultados->num_rows/9+1);
                        for($i=1;$i<=$total_paginas;$i++){
                            if($i==$paginacion)
                                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$i&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                            else
                                echo "<a href='$url".$i."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$i&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>";
                        }
                        if($paginacion<$total_paginas)
                            echo "<a href='$url".($paginacion+1)."'>Seguinte &gt;</a>";
                        echo "</p>";
                        $posicion=($paginacion-1)*9;
                        $resultados->data_seek($posicion);
                        $cont=1;
                        $row = $resultados->fetch_assoc();
                        while($row && $cont<=9){
                            echo "<div class='publicacion'>
                            <img class='perfil' src='{$row["Imaxe"]}' width='100%' alt='Noticia'/>
                            <a href='{$row["Enlace"]}'><h3>{$row["Titulo"]}</h3></a><p>By {$row["Usuario"]} | Data de publicación: {$row["DataPublicacion"]}</p></div>
                            </div>";
                            $row = $resultados->fetch_assoc(); 
                            $cont++; 
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
            <a class="axuda" href="../../gl/PHP/novasdonosolocal.php">Galego</a>
            <a class="axuda" href="../../es/PHP/novasdonosolocal.php">Castelán</a>
            <a class="axuda" href="https://www.aepd.es/es/politica-de-privacidad-y-aviso-legal">Política de privacidade</a>
            <a class="axuda" href="https://phylo.co/blog/traccion/que-son-los-terminos-y-condiciones/">Términos</a>
        </div>
        <div class="copyright"><p>Copyright &copy;2023. IES Maximino Romero de Lema</p></div>
    </footer>
</body>
</html>
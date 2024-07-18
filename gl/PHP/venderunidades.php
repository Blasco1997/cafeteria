<?php
     $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
     if(!$conexion) {
         echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non se puido conectar á nosa base de datos. Inténteo máis tarde.</div>";
     } else {
        $numprodutos = "SELECT COUNT(Id_Produto) AS NumProdutos FROM produtos";
        $resultado = $conexion->query($numprodutos);
        if($resultado->num_rows==0){
            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Aínda non hai produtos dispoñibles.</div>";
        } else {
            $row = $resultado->fetch_assoc();
            $totalprodutos = $row["NumProdutos"];
            for($j=1; $j<=$totalprodutos; $j++){
                if(isset($_POST["produto$j"]) && isset($_POST["unidades$j"])){
                    $produto = $_POST["produto$j"];
                    $unidades = $_POST["unidades$j"];
                    $existeproduto = "SELECT * FROM produtos WHERE Produto = '$produto'";
                    $resultado = $conexion->query($existeproduto);
                    if($resultado->num_rows==0){
                        echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non existe o produto $produto.</div>";
                    } else {
                        $row = $resultado->fetch_assoc();
                        $venderunidades = "UPDATE produtos SET Stock = Stock - $unidades WHERE Produto = '$produto'";
                        if($conexion->query($venderunidades)==true){
                            header("location: listadeprodutos.php");
                        } else if($conexion->query($venderunidades)==false){
                            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Por motivos técnicos non se puido reducir o stock do produto $produto.</div>";
                        }
                    }
                }
            }
        }
     }
?>
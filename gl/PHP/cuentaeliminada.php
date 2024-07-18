<?php
    if(isset($_SESSION["cliente"]) && isset($_POST["motivo"])){
        $usuario = $_SESSION["cliente"];
        $motivo = $_POST["motivo"];
        $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
        if(!$conexion) {
            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non se puido conectar a nosa base de datos. Inténteo máis tarde.</div>";
        } else {
            $existecliente = "SELECT * FROM clientes WHERE Nome_completo = '$usuario'";
            $resultado = $conexion->query($existecliente);
            if($resultado->num_rows==0){
                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non existe o cliente $usuario.</div>";
            } else {
                $row = $resultado->fetch_assoc();
                $eliminarcuentacliente = "DELETE FROM clientes WHERE Nome_completo = '$usuario'";
                if($conexion->query($eliminarcuentacliente)==true){
                    echo "<script>alert('O teu motivo de darte de baixa é: $motivo');</script>";
                    echo "<script>alert('Xa estás dado de baixa. Grazas por formar parte da nosa aplicación. Recorda que podes volver a crearte o teu usuario cando queiras.');</script>";
                    unset($usuario);
                    session_destroy();
                    header("location: login.php");
                } else if($conexion->query($eliminarcuentacliente)==false){
                    echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Por motivos técnicos non se puido eliminar a túa conta.</div>";
                }
            }
        }
    } else if(isset($_SESSION["cliente"]) && isset($_POST["outrosmotivos"])){
        $usuario = $_SESSION["cliente"];
        $outrosmotivos = $_POST["outrosmotivos"];
        $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
        if(!$conexion) {
            echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non se puido conectar a nosa base de datos. Inténteo máis tarde.</div>";
        } else {
            $existecliente = "SELECT * FROM clientes WHERE Nome_completo = '$usuario'";
            $resultado = $conexion->query($existecliente);
            if($resultado->num_rows==0){
                echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non existe o cliente $usuario.</div>";
            } else {
                $row = $resultado->fetch_assoc();
                $eliminarcuentacliente = "DELETE FROM clientes WHERE Nome_completo = '$usuario'";
                if($conexion->query($eliminarcuentacliente)==true){
                    echo "<script>alert('O teu motivo de darte de baixa é: $outrosmotivos');</script>";
                    echo "<script>alert('Xa estás dado de baixa. Grazas por formar parte da nosa aplicación. Recorda que podes volver a crearte o teu usuario cando queiras.');</script>";
                    unset($usuario);
                    session_destroy();
                    header("location: login.php");
                } else if($conexion->query($eliminarcuentacliente)==false){
                    echo "<div class='avisos' style='display: block;'><img src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Por motivos técnicos non se puido eliminar a túa conta.</div>";
                }
            }
        }
    }
?>
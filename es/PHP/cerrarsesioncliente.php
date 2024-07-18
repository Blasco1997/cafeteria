<?php
    session_start();
    if(isset($_SESSION["cliente"])){
        $usuario = $_SESSION["cliente"];
        $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
        if(!$conexion) {
            echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo conectar a nuestra base de datos. Inténtelo más tarde.";
        } else {
            $usuarioinactivo = "UPDATE clientes SET Estado = 'Inactivo' WHERE Nome_completo = '$usuario'";
            if($conexion->query($usuarioinactivo)==true) {
                unset($_SESSION["cliente"]);
                header("location: login.php");
            } else if($conexion->query($usuarioinactivo)==false) {
                echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Por motivos técnicos no se pudo desactivar tu usuario y, por lo tanto, no se pudo cerrar la sesión.";
            }
        }
    }
?>
<?php
    session_start();
    if(isset($_SESSION["cliente"])){
        $usuario = $_SESSION["cliente"];
        $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
        if(!$conexion) {
            echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Non se puido conectar á nosa base de datos. Inténteo máis tarde.";
        } else {
            $usuarioinactivo = "UPDATE clientes SET Estado = 'Inactivo' WHERE Nome_completo = '$usuario'";
            if($conexion->query($usuarioinactivo)==true) {
                unset($_SESSION["cliente"]);
                header("location: login.php");
            } else if($conexion->query($usuarioinactivo)==false) {
                echo "<img class='advertencia' src='../Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Por motivos técnicos non se puido desactivar o teu usuario. E polo tanto, non se puido pechar a sesión.";
            }
        }
    }
?>
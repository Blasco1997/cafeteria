<?php
    if(isset($_GET["idreserva"]) && isset($_GET["idmesa"])){
        $idreserva = $_GET["idreserva"];
        $idmesa = $_GET["idmesa"];
        $conexion = new mysqli("127.0.0.1", "root", "", "cafeteria");
        if(!$conexion) {
            echo "<div class='avisos' style='display: block;'><img src='Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No se pudo conectar a nuestra base de datos. Inténtelo más tarde.</div>";
        } else {
            $existereserva = "SELECT * FROM reservas WHERE Id_Reserva = '$idreserva'";
            $resultado = $conexion->query($existereserva);
            if($resultado->num_rows==0){
                echo "<div class='avisos' style='display: block;'><img src='Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No existe la reserva Nº $idreserva.</div>";
            } else {
                $row = $resultado->fetch_assoc();
                if($row["Pagado"] == "Pendente de entrega"){
                    $actualizarestadoreserva = "UPDATE reservas SET Pagado = 'Pendente de pagar' WHERE Id_Reserva = '$idreserva'";
                    if($conexion->query($actualizarestadoreserva)==true){
                        header("location: detallesreserva.php");
                    } else if($conexion->query($actualizarestadoreserva)==false){
                        echo "<div class='avisos' style='display: block;'><img src='Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Por motivos técnicos, no se pudo actualizar el estado de la reserva.</div>";
                    }
                } else if($row["Pagado"] == "Pendente de pagar"){
                    $actualizarestadoreserva = "UPDATE reservas SET Pagado = 'Pagado' WHERE Id_Reserva = '$idreserva'";
                    if($conexion->query($actualizarestadoreserva)==true){
                        $existemesa = "SELECT * FROM mesas WHERE Id_Mesa = '$idmesa'";
                        $resultado = $conexion->query($existemesa);
                        if($resultado->num_rows==0){
                            echo "<div class='avisos' style='display: block;'><img src='Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>No existe la mesa Nº $idmesa.</div>";
                        } else {
                            $row = $resultado->fetch_assoc();
                            $mesaocupada = "UPDATE mesas SET Estado = 'OCUPADA' WHERE Id_Mesa = '$idmesa'";
                            if($conexion->query($mesaocupada)==true){
                                header("location: detallesreserva.php");
                            } else if($conexion->query($mesaocupada)==false){
                                echo "<div class='avisos' style='display: block;'><img src='Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Por motivos técnicos, no se pudo actualizar el estado de la mesa.</div>";
                            }
                        }
                    } else if($conexion->query($actualizarestadoreserva)==false){
                        echo "<div class='avisos' style='display: block;'><img src='Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Por motivos técnicos, no se pudo actualizar el estado de la reserva.</div>";
                    }
                }
            }
        }
    }
?>
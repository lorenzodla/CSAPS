<?php

    include_once '../../database_conn.php';
    $conexion = conexion();

    $query = " INSERT INTO Profesor_Actividad VALUES ('".$_GET['correo']."', ".$_GET['id'].")  ";

    mysqli_query($conexion, $query);
    
    echo "<script>
            alert('Se ha aceptado la propuesta de actividad. A partir de ahora es visible para todos los usuarios.');
            window.location.assign('http://csaps.alphaduck.software/principal_gestor.php');
        </script>";
?>
<?php

    include_once '../../database_conn.php';
    $conexion = conexion();

    $query = " INSERT INTO Asignatura_Actividad VALUES ('".$_GET['asignatura']."', ".$_GET['id'].")  ";

    mysqli_query($conexion, $query);
    
    echo "<script>
            alert('Se ha aceptado la propuesta de actividad. A partir de ahora es visible para todos los usuarios.');
            window.location.assign('http://csaps.alphaduck.software/principal_gestor.php');
        </script>";

    header("location: principal_gestor.php");

?>
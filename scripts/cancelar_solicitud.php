<?php
    include_once '../../../database_conn.php';
    $conexion = conexion();

    $participante = $_GET['participante'];
    $actividad = $_GET['actividad'];

    $query = "DELETE FROM Usuario_Actividad WHERE usuario ='$participante' and actividad='$actividad'";
    mysqli_query($conexion, $query);

    echo "
    <script>
        alert('Su solicitud ha sido cancelada.');
        window.location.assign('http://csaps.alphaduck.software/gestionar_solicitudes.php?option=todas');
    </script>
    ";

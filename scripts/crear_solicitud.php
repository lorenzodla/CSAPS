<?php
    include_once '../../../database_conn.php';
    $conexion = conexion();

    $participante = $_GET['participante'];
    $actividad = $_GET['actividad'];

    $query = "INSERT INTO Usuario_Actividad (usuario, actividad) VALUES ('$participante', $actividad)";
    mysqli_query($conexion, $query);

    echo "
    <script>
        alert('Su solicitud se ha enviado con éxito. Por favor espere a que se responda.');
        window.location.assign('http://csaps.alphaduck.software/visualizar_actividades_usuario.php?option=todas');
    </script>
    ";
    
?>
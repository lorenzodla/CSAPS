<?php
include_once('session.php');
if (!isset($_SESSION['user'])) {
    header('location: login.php');
}

if ($_SESSION['user']['categoryName'] != 'ONG') {
    header('location : perfil.php');
}

include_once('../../database_conn.php');
$conexion = conexion();

$alumno= $_GET['alumno'];
$actividad= $_GET['actividad'];

$query = "UPDATE Usuario_Actividad SET estado='RECHAZADA' WHERE usuario='$alumno' AND actividad=$actividad";
$resultado = mysqli_query($conexion, $query);

echo "<script type='text/javascript'>
        alert('Solicitud rechazada.');
        window.location='http://csaps.alphaduck.software/solicitudes_ong.php?actividad=$actividad';
</script>";
                                        
?>
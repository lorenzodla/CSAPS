<?php
include_once('session.php');
if (!isset($_SESSION['user'])) {
    header('location: login.php');
}

if (!$esGestor) {
    header('location : perfil.php');
}

include_once('../../database_conn.php');
$conexion = conexion();

$id= $_GET['id'];

$query = "UPDATE Actividad SET tipo='Descartada', aceptado=0,modificado=0 WHERE ID=$id";
$resultado = mysqli_query($conexion, $query);

echo "<script type='text/javascript'>
                                                          alert('Actividad rechazada. La actividad se eliminará de la plataforma de manera definitiva en breves momentos.');
                                                          window.location='http://csaps.alphaduck.software/perfil.php';
</script>";
                                        
?>
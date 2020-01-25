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

$id= $_GET['id'];

$query = "UPDATE Actividad SET aceptada=1,modificado=0 WHERE ID=$id";
$resultado = mysqli_query($conexion, $query);

echo "<script type='text/javascript'>
                                                          alert('Modificaciones aceptadas. La actividad se encontrará disponible en breves momentos.');
                                                          window.location='http://csaps.alphaduck.software/perfil.php';
</script>";
                                        
?>
<?php
include_once('../../../database_conn.php');
$conexion = conexion();

$id = $_GET['id']; //Cojo la actividad que tengo que aceptar

//Actualizar BD
//Modificado a 1 para que no le vuelva a salir al gestor.
$query="UPDATE Actividad SET tipo='Denegada', revisada = 1, modificado = 1 WHERE id=$id";
mysqli_query($conexion,$query);

 echo "<script>
            alert('Se ha denegado la propuesta de actividad.');
            window.location.assign('http://csaps.alphaduck.software/principal_gestor.php');
        </script>";

?>
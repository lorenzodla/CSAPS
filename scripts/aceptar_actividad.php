<?php
include_once('../../../database_conn.php');
$conexion = conexion();

$id = $_GET['id']; //Cojo la actividad que tengo que aceptar
$tipo = $_GET['tipo'];

if($tipo=="Voluntariado"){
    //Si el tipo es voluntariado, la acepto y palante
    $query = "UPDATE Actividad SET aceptada = 1 WHERE ID = $id";
    mysqli_query($conexion,$query);

     echo "<script>
            alert('Se ha aceptado la propuesta de actividad. A partir de ahora es visible para todos los usuarios.');
            window.location.assign('http://csaps.alphaduck.software/principal_gestor.php');
        </script>";
}

if($tipo=="Docencia"){
    $query = "UPDATE Actividad SET aceptada = 1 WHERE ID = $id";
    mysqli_query($conexion,$query);
    
    header("location: http://csaps.alphaduck.software/asignar_asignatura.php?id=$id");
}


if($tipo=="Investigación"){
    $query = "UPDATE Actividad SET aceptada = 1 WHERE ID = $id";
    mysqli_query($conexion,$query);
    
    header("location: http://csaps.alphaduck.software/asignar_profesor.php?id=$id");
}

?>
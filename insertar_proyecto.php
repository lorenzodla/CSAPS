<?php

    include_once ('session.php');
    include_once ('../../database_conn.php');


    $conexion = conexion();

    $nombreProyecto = $_GET['nombreProyecto'];

    $query = "INSERT INTO Proyecto (ID) VALUES ('".$nombreProyecto."')";

    //echo $query;

    mysqli_query($conexion, $query);

    foreach ($_GET as $clave => $valor) {
        
        if ($clave != 'nombreProyecto') {
            $query = "INSERT INTO Actividad_Proyecto VALUES (".$clave.", '".$nombreProyecto."')";
            //echo $query;
            mysqli_query($conexion, $query);
        }

    }

   
    

   header('location: perfil.php');
?>
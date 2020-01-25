<?php

    include_once '../../database_conn.php';
    $conexion = conexion();

    $query = "SELECT Actividad.ID FROM Actividad, Actividad_Proyecto WHERE Actividad.ID = Actividad_Proyecto.actividad AND Actividad_Proyecto.proyecto='".$_GET['nombreProyecto']."'";

    $resultados = mysqli_query($conexion, $query);

    // echo $resultados;

    while($data = mysqli_fetch_assoc($resultados)){
        foreach ($_GET as $clave => $valor) {
            if (strcmp ($clave, "nombreProyecto") != 0) { 
                try {
                    $correo = $clave;
                    $correo = substr($correo, 0, strlen($correo) - 3);
                    $correo = $correo.".es";
                    //echo "INSERT INTO Usuario_Actividad VALUES ('".$correo. "', ".$data['ID'].")";
                    $query = "INSERT INTO Usuario_Actividad VALUES ('".$correo. "', ".$data['ID'].")";
                    mysqli_query($conexion, $query);
                } catch (Exception $e) {

                }
            }
        }
    }

    

    header('location: perfil.php');



?>
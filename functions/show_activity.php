<?php

function getImg($organizacion)
{
    $conexion = conexion();

    $query = "SELECT picture FROM ONG where email='$organizacion'";
    $img = mysqli_query($conexion, $query);
    $result = mysqli_fetch_assoc($img)['picture'];

    return base64_encode($result);
}

function solicitudEnviada($rows){
    $conexion = conexion();
    $query = "SELECT usuario, actividad 
                FROM Usuario_Actividad 
                WHERE usuario = '".$_SESSION['user']['userEmail']."' AND
                    actividad = ".$rows['ID']; 

    $query = mysqli_query($conexion,$query);
    
    return $query->num_rows > 0;
}

function esFoto($archivo){
   return  strpos($archivo, '.jpeg') !== false || strpos($archivo, '.jpg') !== false || strpos($archivo, '.png') !== false;
}

function show_activity($rows)
{
    $conexion = conexion();

    echo "<div class='row' style='margin-top: 1%; border: 1px solid #103567; border-radius: 10px;'>
                <div class='col-md-8'>
                    <p class='text-left' style='font-size: 30px;font-weight: bold;' >" . $rows['Titulo'] . "</p>
                    <p class='text-left'><strong>Descripcion de la actividad:</strong> " . $rows['descripcion'] . "</p>
                    <p class='text-left'><strong>Fecha de Inicio:</strong> " . $rows['fechaInicio'] . "</p>
                    <p class='text-left'><strong>Fecha de Finalizacion:</strong> " . $rows['fechaFin'] . "</p>
                    <p class='text-left'><strong>Numero de participantes:</strong> " . $rows['participantes'] . "</p>
                    <p class='text-left'><strong>Horas Diarias:</strong> " . $rows['horasDia'] . "</p>";
    if ($rows['archivo'] != null && !esFoto($rows['archivo']) ) {
        $file_name = basename($rows['archivo']);
        echo "<p class='text-left'><strong>Documentacion Adicional:</strong> ";
        echo "<a class='' href='" . $rows['archivo'] . "' target='_blank'>$file_name</a></p>";
    }

    echo "<p class='text-left'><strong>Perfiles Buscados: </strong><br>";
    $query = "SELECT habilidad FROM Actividad_Habilidad WHERE actividad = '" . $rows['ID'] . "'";
    $habilities = mysqli_query($conexion, $query);
    while ($data = mysqli_fetch_assoc($habilities)) {
        echo " - " . $data['habilidad'] . "</br>";
    }
    echo "</p>";

    echo "</div>
             <div class='col-md-4' style='display: flex; flex-direction: column;'>";
             if(esFoto($rows['archivo'])){
                echo "<img class='roundImage' height='250' src='".$rows['archivo']."'>";
             }else{
                echo "<img class='roundImage' height='250' src='data:image/*;base64," . getImg($rows['propuestaPor']) . "'>";
             }

    
    if(!solicitudEnviada($rows)){
           echo " <a id='button' class='btn btn-blue action-button' role='button' href = '/scripts/crear_solicitud.php?actividad=".$rows['ID']."&participante=".$_SESSION['user']['userEmail']."'>
                 Solicitar Plaza
                </a>";
        }else{
            echo "<p>Ya has solicitado plaza en esta actividad</p>";
        }
                

    echo    "<a id='button' class='btn btn-blue action-button' role='button' href = '/nuevo_mensaje.php?destino=".$rows['propuestaPor']."'> Contactar Organizacion</a>
            </div>
            </div>";
}
?>

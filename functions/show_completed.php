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

function esFoto($archivo)
{
    return  strpos($archivo, '.jpeg') !== false || strpos($archivo, '.jpg') !== false || strpos($archivo, '.png') !== false;
}

function getQuote($rows){
    $conexion = conexion();
    $query = "SELECT Comentario FROM Informe WHERE Alumno = '".$_SESSION['user']['userEmail']."' AND Actividad = ".$rows['ID'];
    $resultado = mysqli_query($conexion,$query);

    if($resultado->num_rows == 0){
        return "La organizacion aun no ha redactado su informe";
    }else{
        return mysqli_fetch_assoc($resultado)['Comentario'];
    }
}


function show_completed($rows)
{
    $conexion = conexion();

    echo "<div class='row' style='margin-top: 1%; border: 1px solid #103567; border-radius: 10px;'>
                <div class='col-md-8'>
                    <p style='font-size: 20px;font-weight: bold;' class='text-left'>" . $rows['Titulo'] . "</p>
                    <p class='text-left'><strong>Descripcion de la actividad:</strong> " . $rows['descripcion'] . "</p>
                    <p class='text-left'><strong>Fecha de Finalizacion:</strong> " . $rows['fechaFin'] . "</p>";

                    $query = "SELECT * FROM Valoraciones_AUX WHERE alumno = '".$_SESSION['user']['userEmail']."' AND Actividad=".$rows['ID'];
                    $resultados = mysqli_query($conexion,$query);

                    if($resultados->num_rows > 0){
                        
                        $valor = mysqli_fetch_assoc($resultados)['Likes'];
                        
                        echo "<p class='text-left'>$valor <span class='star'>★</span></p>";

                        echo "<p class='text-left'><strong>La organizacion dejo el siguiente comentario: </strong>".getQuote($rows)."</p>";
                        //echo "<a class='text-left' href='generar_diploma.php?actividad=".$rows['ID']."&alumno=".$_SESSION['user']['userEmail']."'> Certificado de Participacion</a>";
                    }else{
                        echo "<form class='text-left' action='../scripts/gustar_actividad.php' method='get'>
                        <input type='hidden' name='actividad' value='".$rows['ID']."'>
                        <input type='hidden' name='alumno' value='".$_SESSION['user']['userEmail']."'>
                        <p class='clasificacion'>
                            <input class='line' type='submit'>
                            <input id='radio1' type='radio' name='estrellas' value='5'>
                            <label for='radio1'>★</label>
                            <input id='radio2' type='radio' name='estrellas' value='4'>
                            <label for='radio2'>★</label>
                            <input id='radio3' type='radio' name='estrellas' value='3'>
                            <label for='radio3'>★</label>
                            <input id='radio4' type='radio' name='estrellas' value='2'>
                            <label for='radio4'>★</label>
                            <input id='radio5' type='radio' name='estrellas' value='1'>
                            <label for='radio5'>★</label>
                        </p>
                        
                    </form>";
                    }
                    

    echo "</div>
             <div class='col-md-4' style='display: flex; flex-direction: column;'>";
            if(esFoto($rows['archivo'])){
                echo "<img class='roundImage' height='250' src='".$rows['archivo']."'>";
             }else{
                echo "<img class='roundImage' height='250' src='data:image/*;base64," . getImg($rows['propuestaPor']) . "'>";
             }
      echo"</div>
        </div>";
}
?>

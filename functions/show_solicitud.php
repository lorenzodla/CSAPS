<?php
  function show_asignaturas($chaval){
    $conexion = conexion();

    $query = "SELECT * from Usuario_Asignatura where usuario = '$chaval'";
    $resultados = mysqli_query($conexion,$query);
    while($subject = mysqli_fetch_assoc($resultados)){
      echo "<li class='text-left'>".$subject['asignatura']."</li>";
    }
  }

  function show_solicitud ($rows, $resultados2){
    echo"<div class='row' style='Margin-top:2%; Border: 1px solid #103567; Border-radius: 5px; flex-direction: column;'>
          <div class='col'> 
            <h4 class='text-left'>".$rows['nombre']." ".$rows['apellido1']." ".$rows['apellido2']."</h4>
            <p class='text-left'><strong>Direccion: </strong>".$rows['direccion']. "</p>
            <p class='text-left'><strong>Facultad: </strong>" . $rows['facultad'] . "</p>
            <p class='text-left'><strong>Perfil: </strong></p>
            <ul>";

            while($skill = mysqli_fetch_assoc($resultados2)){
              echo "<li class='text-left'>".$skill['habilidad']."</li>";
            }
            echo "</ul><p class='text-left'><strong>Asignaturas: </strong></p><ul>";
            show_asignaturas($rows['email']);
            echo "</ul>";

         echo "<div class='row'>
              <div class='col'>
                <a id='button' class='btn btn-blue action-button' role='button' href='/aceptar_solicitud_alumno_ong.php?alumno=".$rows['email']."&actividad=".$rows['actividad']."'> Confirmar Solicitud </a>
              </div>
              <div class='col'>
                <a id='button' class='btn btn-blue action-button' role='button' href='/rechazar_solicitud_alumno_ong.php?alumno=".$rows['email']."&actividad=".$rows['actividad']."'> Rechazar Solicitud</a>
              </div>
            </div>
          </div>
        </div>";

  }
 ?>

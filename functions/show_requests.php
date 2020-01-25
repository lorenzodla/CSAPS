<?php 
    function showRequest($row){
        //$conexion = conexion();

        echo "<div class='row' style='margin-top: 1%; margin-bottom: 5%; border: 1px solid #103567; border-radius: 10px;'>
                <div class='col'>
                    <p style='font-size: 20px;font-weight: bold;' class='text-left'>" . $row['Titulo'] . "</p>
                    <p class='text-left'>Descripcion: " . $row['descripcion'] . "</p>
                    <div class='row'>
                        <div class='col'>
                            <p class='text-center'>Fecha de Inicio: " . $row['fechaInicio'] . "</p>
                        </div>
                        <div class='col'>
                            <p class='text-center'>Fecha de Finalizacion: " . $row['fechaFin'] . "</p>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col'>
                            <p class='text-center'>Horas Diarias: " . $row['horasDia'] . " hora/s </p>
                        </div>
                        <div class='col'>
                            <p class='text-center'>Numero de Participantes: " . $row['participantes'] . "</p>
                        </div>
                    </div>
                    <p class='text-left' style='text-decoration: underline;'>Estado: ".$row['estado']."</p>
                    <div class='row'>
                        <div class='col'>";
                        if($row['estado'] === "ACEPTADA" || $row['estado'] === "RECHAZADA" ){
                            echo "<p class='text-center'>Su solicitud ya ha sido procesada, por favor contacte con la organización</p>";
                        }else{
                            echo "<a id='button' class='btn btn-blue action-button' role='button' href = '/scripts/cancelar_solicitud.php?actividad=" . $row['ID'] . "&participante=" . $_SESSION['user']['userEmail'] . "'>
                                Cancelar Solicitud
                            </a>";
                        }
                            

                      echo"  </div>
                        <div class='col'>
                            <a id='button' class='btn btn-blue action-button' role='button' href = '/correo de lorenzo cuando esté.php'> Contactar Organizacion</a>
                        </div>
                    </div>
                </div>
            </div>";

    }

?>
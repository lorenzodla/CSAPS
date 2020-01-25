<?php
	include_once 'session.php';
  include_once '../../database_conn.php';
  $conexion = conexion();

  if(!isset($_SESSION['user'])) {
    header('location : login.php');
  } 

  
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Selecciona una actividad</title>
    <link rel="stylesheet" href="assetsFAQ/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assetsFAQ/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assetsFAQ/css/Footer-Dark.css">
    <link rel="stylesheet" href="assetsFAQ/css/Navegacin-APS.css">
    <link rel="stylesheet" href="assetsFAQ/css/Search-Input-responsive.css">
    <link rel="stylesheet" href="assetsFAQ/css/Sidebar-1.css">
    <link rel="stylesheet" href="assetsFAQ/css/Sidebar-Menu-1.css">
    <link rel="stylesheet" href="assetsFAQ/css/Sidebar-Menu.css">
    <link rel="stylesheet" href="assetsFAQ/css/Sidebar.css">
    <link rel="stylesheet" href="assetsFAQ/css/simple-footer.css">
    <link rel="stylesheet" href="assetsFAQ/css/styles.css">

    <!-- Script de Búsqueda -->
    <?php
      function Search($input){

        if($count > 0){
          while($rows = mysqli_fetch_assoc($resultados)){
            echo "<div class='row' style='margin-top: 1%;'>
                <div class='col'>
                    <h1 class='text-left'>".$rows['decripcion']."</h1>
                    <h1 class='text-left'>".$rows['fechaInicio']."</h1>
                    <h1 class='text-left'>".$rows['fechaFin']."</h1>
                    <h1 class='text-left'>".$rows['participantes']."</h1>
                    <h1 class='text-left'>".$rows['horasDia']."</h1>
                    <h1 class='text-left'>".$rows['archivo']."</h1>
                    <h1 class='text-left'>".$rows['tipo']."</h1>
                    <h1 class='text-left'>".$rows['propuestaPor']."</h1>
                    <h1 class='text-left'>".$rows['aceptado']."</h1>
                    <h1 class='text-left'>".$rows['ID']."</h1>


                </div>
            </div>";
          }
        }else{
          echo "<div class='row' style='margin-top: 1%;'>
                  <div class='col'>
                    <h1 class='text-left'>No hay actividades de investigación sin asignar</h1>
                  </div>
                </div>";
        }

      }
     ?>

    <!-- Listener de retorno de carro para la barrita de búsqueda -->
     <script>
        function pressed(e) {
            // Has the enter key been pressed?
            if ( (window.event ? event.keyCode : e.which) == 13) {
                // If it has been so, manually submit the <form>
                document.forms[0].submit();
            }
        }
    </script>

  </head>
  <body>
    <?php include "_navbar.php"; ?>

    <div class="container" style="margin-left: 15%;">
        <div class="col-xl-8">
            <div class="row">
                <div class="col-md-4 col-lg-10 col-xl-12 text-center">
                    <div class="row">
                        <div class="col">
                            <h1 class="text-left" style="color: #56c6c6;padding-top: 20px;padding-bottom: 20px;">Actividades Propuestas</h1>
                        </div>
                    </div>

                    <?php
                      $query = "SELECT * FROM Actividad WHERE tipo LIKE 'INVESTIGACION' AND NOT EXISTS (SELECT * FROM Profesor_Actividad WHERE Profesor_Actividad.actividad = Actividad.ID)";
                      $resultados = mysqli_query($conexion, $query);
                      while($rows = mysqli_fetch_assoc($resultados)){
                        echo "<div class='row' style='margin-top: 1%;'>";
                        echo "<div class='col' style='border: 1px solid #56c6c6; border-radius: 10px;'>";
                        echo "<p style='font-size: 20px;font-weight: bold;' class='text-left'><a  href='asignar_profesor.php?id=".$rows['ID']."'>".$rows['Titulo']."</a></p>";

                        if ($rows['aceptado']) {
                          echo "<p style='color: LawnGreen' class='text-left'>Actividad Aceptada</p>";
                        } else {
                          echo "<p style='color: Red' class='text-left'>Actividad NO Aceptada</p>";
                        }

                        echo    
                                "<p class='text-left'>Descripcion de la actividad: ".$rows['descripcion']."</p>
                                <p class='text-left'>Propuesta por: ".$rows['propuestaPor']."</p>
                                <p class='text-left'>Fecha de Inicio: ".$rows['fechaInicio']."</p>
                                <p class='text-left'>Fecha de Finalización: ".$rows['fechaFin']."</p>
                                <p class='text-left'>Numero de participantes: ".$rows['participantes']."</p>
                                <p class='text-left'>Horas Diarias: ".$rows['horasDia']."</p>
                                <p class='text-left'>Tipo: ".$rows['tipo']."</p>
																<p class='text-left'>Perfiles Buscados: </br>";
												$query = "SELECT habilidad FROM Actividad_Habilidad WHERE actividad = '".$rows['ID']."'";
												$habilities = mysqli_query($conexion,$query);
												while($data = mysqli_fetch_assoc($habilities)){
													echo "\t - ".$data['habilidad']."</br>";
												}
												echo "</p>";
												echo"</div>
		                       </div>";
											}







                     ?>

                </div>
            </div>
        </div>
    </div>
    
    <script src="assetsIndex/js/jquery.min.js"></script>
    <script src="assetsIndex/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
    <script src="assetsIndex/js/Simple-Slider.js"></script>
  </body>
</html>

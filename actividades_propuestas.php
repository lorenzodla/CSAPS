<?php
	include_once 'session.php';
  include_once '../../database_conn.php';
  $conexion = conexion();

  if(!isset($_SESSION['user'])) {
    header('location : login.php');
  } 

  if($_SESSION['user']['categoryName'] != 'ONG') {
      header('location : perfil.php');
  }
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>AccionSocialMed</title>
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

    <style>
      #button{
        border: 1px solid #103567;
        border-radius: 7px; 
        background: #103567;
        color: white;
        width: 100%;
        margin-bottom: 1%; 
      }
    </style>
  </head>
  <body>
    <?php include "_navbar.php"; ?>

    <div class="container" style="margin-left: 15%;">
        <div class="col-xl-8">
            <div class="row">
                <div class="col-md-4 col-lg-10 col-xl-12 text-center">
                    <div class="row">
                        <div class="col">
                            <h1 class="text-left" style="color: #103567;padding-top: 20px;padding-bottom: 20px;">Actividades Propuestas</h1>
                        </div>
                    </div>

                    <?php
                      $query = "SELECT * FROM Actividad WHERE propuestaPor='".$_SESSION['user']['userEmail']."'";
                      $resultados = mysqli_query($conexion, $query);
                      while($rows = mysqli_fetch_assoc($resultados)){
                        echo "<div class='row' style='margin-top: 1%;'>
                              <div class='col' style='border: 1px solid #103567; border-radius: 10px;'>
                                <p style='font-size: 20px;font-weight: bold;' class='text-left'>".$rows['Titulo']. "</p>
                                <p class='text-left'><strong>Descripcion de la actividad:</strong></strong> ".$rows['descripcion']."</p>
                                <p class='text-left'><strong>Fecha de Inicio:</strong> ".$rows['fechaInicio']."</p>
                                <p class='text-left'><strong>Fecha de Finalización:</strong> ".$rows['fechaFin']."</p>
                                <p class='text-left'><strong>Numero de participantes:</strong> ".$rows['participantes']."</p>
                                <p class='text-left'><strong>Horas Diarias:</strong> ".$rows['horasDia']."</p>";
                                if($rows['archivo'] != null){
                                    echo "<p class='text-left'><strong>Documentación Adicional:</strong> ";
                                    $file_name = basename($rows['archivo']); 
                                    echo "<a class='' href='".$rows['archivo']."' target='_blank'>$file_name</a></p>";
                                }

												echo "<p class='text-left'><strong>Perfiles Buscados:</strong> </br>";
												$query = "SELECT habilidad FROM Actividad_Habilidad WHERE actividad = '".$rows['ID']."'";
												$habilities = mysqli_query($conexion,$query);
												while($data = mysqli_fetch_assoc($habilities)){
													echo "\t - ".$data['habilidad']."</br>";
												}
                        echo "</p>";
                        echo "<p class='text-left'> <strong>Clasificada Como:</strong> ".$rows['tipo']."</p>";
                        
                        echo "<div class='row'>";
                        if($rows['modificado'] && !$rows['aceptada']){
                          echo "<div class='col'>";
                          echo "<a id='button' class='btn' href='subir_actividades.php?id=".$rows['ID']."'>Revisar Modificaciones Propuestas</a>";
                          echo "</div>";
                        }

                        if($rows['aceptada']){
                          echo "<div class='col'>";
                          echo "<a id='button' class='btn' href='solicitudes_ong.php?actividad=".$rows['ID']."'>Gestionar Solicitudes</a>";
                          echo "</div>";
                        }

                        echo"  </div>
                              </div>
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

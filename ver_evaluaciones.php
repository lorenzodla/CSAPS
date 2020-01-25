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
    <title>Evaluaciones Relaciondas</title>
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
  </head>

  <body>
    <?php include "_navbar.php"; ?>

    <div class="container" style="margin-left: 15%;">
        <div class="col-xl-8">
            <div class="row">
                <div class="col-md-4 col-lg-10 col-xl-12 text-center">
                    <div class="row">
                        <div class="col">
                            <h1 class="text-left" style="color: #103567;padding-top: 20px;padding-bottom: 20px;">Evaluaciones</h1>
                        </div>
                    </div>

                    <?php
                      $query = "SELECT * FROM Evaluacion WHERE alumno='".$_SESSION['user']['userEmail']."' OR profesor='".$_SESSION['user']['userEmail']."'";
                      $resultados = mysqli_query($conexion, $query);

                      if($resultados->num_rows < 1){
                        echo "<h6 class='text-left'>Aun no hay evaluaciones</h6>";
                      }
                      
                      
                      while($rows = mysqli_fetch_assoc($resultados)){
                        echo "<div class='row' style='margin-top: 1%;'>
                                    <div class='col' style='border: 1px solid #103567; border-radius: 10px;'>
                                        <p style='font-size: 20px;font-weight: bold;' class='text-left'>" . $rows['Titulo'] . "</p>
                                        <p class='text-left'>Calificación: " . $rows['nota'] . "</p>
                                        <p class='text-left'>Comentario: " . $rows['comentario'] . "</p>";

                        $query2 = "SELECT nombre, apellido1, apellido2 FROM UMA WHERE email='".$rows['alumno']."'";
                        $resultados2 = mysqli_query($conexion, $query2);
                        $res2 = mysqli_fetch_assoc($resultados2);

                            echo "<p class='text-left'>Alumno: " . $res2['nombre'] . " ".$res2['apellido1']." ".$res2['apellido2']."</p>";

                        $query3 = "SELECT nombre, apellido1, apellido2 FROM UMA WHERE email='".$rows['profesor']."'";
                        $resultados3 = mysqli_query($conexion, $query3);
                        $res3 = mysqli_fetch_assoc($resultados3);

                            echo            "<p class='text-left'>Profesor: " . $res3['nombre'] . " ".$res3['apellido1']." ".$res3['apellido2']."</p>";

                        $query4 = "SELECT Titulo FROM Actividad WHERE ID=".$rows['actividad']."";
                        $resultados4 = mysqli_query($conexion, $query4);
                        $res4 = mysqli_fetch_assoc($resultados4);

                            echo            "<p class='text-left'>Actividad: " . $res4['Titulo'] . "</p>";
                       
                        echo "</div>
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

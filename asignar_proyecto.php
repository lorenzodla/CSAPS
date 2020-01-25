<?php
	include_once 'session.php';
  include_once '../../database_conn.php';
  $conexion = conexion();

  if(!isset($_SESSION['user'])) {
    header('location : login.php');
  }
  
  $contador = 0;


  if(isset($_POST['guardar'])) {

    $query = "INSERT INTO Prueba VALUES ('BIEN3.0')";

    mysqli_query($conexion, $query);

    header('location: perfil.php');

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
                      
                      echo"<form action = 'insertar_proyecto.php'>";
                      

                      $query = "SELECT * FROM Proyecto";
                      $resultados = mysqli_query($conexion, $query);

                      

                      while($rows = mysqli_fetch_assoc($resultados)){
                        echo "<div class='row' style='margin-top: 1%;'>";
                        echo "<div class='col' style='border: 1px solid #56c6c6; border-radius: 10px;'>";
                        echo "<p style='font-size: 20px;font-weight: bold;' class='text-left'><a  href='seleccionar_alumno.php?id=".$rows['ID']."'>".$rows['ID']."</a></p>";
                        echo    
                                "
											<p class='text-left'>Actividades: </br>";
												$query = "SELECT Actividad.ID, Actividad.Titulo FROM Proyecto, Actividad, Actividad_Proyecto WHERE Proyecto.ID = Actividad_Proyecto.proyecto AND Actividad.ID = Actividad_Proyecto.actividad AND Proyecto.ID= '".$rows['ID']."'";
												$habilities = mysqli_query($conexion,$query);
												while($data = mysqli_fetch_assoc($habilities)){
													echo "\t - ".$data['Titulo']." (".$data['ID'].")</br>";
												}
												echo "</p>";
												echo"</div>
                           </div>";
                           
                            $contador++;
						}

                      

                       

                      

                      

                     ?>
                     
                      
                      
                      </form>

                      <?php
                         

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

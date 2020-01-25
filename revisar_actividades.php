<?php
  include_once 'session.php';
  include_once '../../database_conn.php';
  $conexion = conexion();

  if (!isset($_SESSION['user'])) {
    header('location : login.php');
  }

  if (!$esGestor) {
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
      a{
        color: #103567;
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
          $query = "SELECT * FROM Actividad WHERE aceptada = 0 AND modificado = 0";
          $resultados = mysqli_query($conexion, $query);
          if(mysqli_num_rows($resultados) == 0){
            echo "<h2 class='text-left'>No hay actividades pendiendes de revision</h1>";
          }
            while ($rows = mysqli_fetch_assoc($resultados)) {

              echo "<div class='row' style='margin-top: 1%;'>";
              echo "<div class='col' style='border: 1px solid #103567; border-radius: 10px;'>";
              echo "<p style='font-size: 20px;font-weight: bold;' class='text-left'>
                      <a  href='modificar_actividad.php?id=" . $rows['ID'] . "'>" . $rows['Titulo'] . "</a>
                    </p>";

              echo "<p style='color: Red' class='text-left'>Actividad NO Aceptada</p>";


              echo
                "<p class='text-left'>Descripcion de la actividad: " . $rows['descripcion'] . "</p>
                                  <p class='text-left'>Propuesta por: " . $rows['propuestaPor'] . "</p>
                                  <p class='text-left'>Fecha de Inicio: " . $rows['fechaInicio'] . "</p>
                                  <p class='text-left'>Fecha de Finalización: " . $rows['fechaFin'] . "</p>
                                  <p class='text-left'>Numero de participantes: " . $rows['participantes'] . "</p>
                                  <p class='text-left'>Horas Diarias: " . $rows['horasDia'] . "</p>
                                  <p class='text-left'>Clasificada Como: " . $rows['tipo'] . "</p>
                                  <p class='text-left'>Perfiles Buscados: </br>";
              $query = "SELECT habilidad FROM Actividad_Habilidad WHERE actividad = '" . $rows['ID'] . "'";
              $habilities = mysqli_query($conexion, $query);
              while ($data = mysqli_fetch_assoc($habilities)) {
                echo "\t - " . $data['habilidad'] . "</br>";
              }
              echo "</p>";
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
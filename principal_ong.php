<?php
    include_once 'session.php';
    include_once '../../database_conn.php';

    if(!isset($_SESSION['user'])) {
      header('location : login.php');
    } 
  
    if($_SESSION['user']['categoryName']!='ONG') {
        header('location : perfil.php');
    }
?>

<!DOCTYPE html>
<html>

  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <title>AccionSocialMed</title>
      <link rel="stylesheet" href="assetsPrincipalONG/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="assetsPrincipalONG/css/Navegacin-APS.css">
      <link rel="stylesheet" href="assetsPrincipalONG/css/styles.css">

      <style media="screen">
        #button{
          border: 1px solid #103567;
        }

        .botonera{
          display: flex;
          flex-direction: column;
        }  

        .botonera a{
          width: 80%;
        }
      </style>
  </head>

<body>
    <?php include "_navbar.php"; ?>
    <label></label>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center">
                    <?php
                        $conexion = conexion();

                        $query = "select name, picture from ONG where email='".$_SESSION['user']['userEmail']."'";

                        if ($resultado = mysqli_query($conexion, $query)) {
                            $datos = mysqli_fetch_assoc($resultado);
                            echo "<img src='data:image/jpg; base64, " . base64_encode ($datos['picture'])."' style='width: 250px;height: 250px;'>";
                            echo "<div class='form-group'>
                                    <label>".$datos['name']."</label>
                                  </div>";
                        } else {
                            echo "error en la consulta";
                        }
                    ?>
                </div>

                <div class="col-md-6 text-center">
                  <div class="botonera">
                    <div class="form-group">
                          <label>¿Qué te gustaría hacer?</label>
                        </div>
                        <div class="form-group">
                          <a id="button" class="btn btn-blue action-button" role="button" href = "modificar_datos_ong.php">Modificar Datos</a>
                        </div>
                        <div class="form-group">
                          <a id="button" class="btn btn-blue action-button" role="button" href = "subir_actividades.php">Proponer Actividad</a>
                        </div>
                        <div class="form-group">
                          <a id="button" class="btn btn-blue action-button" role="button" href = "actividades_propuestas.php">Ver Actividades Propuestas</a>
                        </div>
                        <div class="form-group">
                          <a id="button" class="btn btn-blue action-button" role="button" href = "informe_actividad.php">Redactar Informes de Participacion</a>
                        </div>
                  </div>
                </div>

            </div>
        </div>
    </div>

    <script src="assetsPrincipalONG/js/jquery.min.js"></script>
    <script src="assetsPrincipalONG/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>

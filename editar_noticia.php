<?php
  include_once 'session.php';
  include_once ('../../database_conn.php');

  if(!isset($_SESSION['user'])) {
    header('location : login.php');
  } 

  if(!$esGestor) {
      header('location : perfil.php');
  }

  $conexion = conexion();

  if(isset($_POST['send'])){
    $date = date('Y-m-d');
    if($_GET['id'] == -1){
          $query = "INSERT INTO Noticias (fecha, cuerpo, title, image, escritor) VALUES ('$date', '".$_POST['cuerpo']."', '".$_POST['titulo']."', NULL, '".$_SESSION['user']['userEmail']."')";
    }else{
      $query = "UPDATE Noticias SET fecha='$date',cuerpo='".$_POST['cuerpo']."', title='".$_POST['titulo']."',escritor='".$_SESSION['user']['userEmail']."' WHERE ID =".$_GET['id'];
    }
    mysqli_query($conexion, $query);
    header('location: gestion_noticias.php');
  }



 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>AccionSocialMed</title>
    <link rel="stylesheet" href="assetsContact/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assetsContact/css/styles.min.css">
</head>

<body>

    <?php include "_navbar.php"; ?>

    <div>
        <!-- Contenedor Central -->
        <div class="container" style="margin-left: 15%;">
            <div class="col-xl-8">
                <div class="row">
                    <div class="col-md-4 col-lg-10 col-xl-12 text-center">
                        <div class="row">
                            <div class="col">
                                  <div class="form-container" style="padding-top: 20px">
                                    <?php
                                      $title = "";
                                      $cuerpo = "";
                                      $id = -1;
                                      if(isset($_GET['id'])){
                                        $query = "SELECT title, cuerpo FROM Noticias WHERE ID = ".$_GET['id'];
                                        $resultados = mysqli_query($conexion,$query);
                                        $row = mysqli_fetch_assoc($resultados);
                                        $title = $row['title'];
                                        $cuerpo = $row['cuerpo'];
                                        $id = $_GET['id'];
                                      }
                                      echo "
                                      <form method='post' action=".$_SERVER['PHP_SELF']."?id=".$id.">
                                          <h2 class='text-center' style='color: #56c6c6;'><strong>Nueva Noticia</strong></h2>
                                          <div class='form-group'><input class='form-control' type='text' name='titulo' placeholder='Titulo' value='".$title."' required></div>
                                          <div class='form-group'>
                                            <textarea style='height: 160px; resize: none' class='form-control' name='cuerpo' placeholder='Noticia' required>".$cuerpo."</textarea>
                                          </div>
                                          <!--
                                          <div style='margin-left: -50%' class='form-group'>
                                            <input type='file' name='image' placeholder='Imagenes Relacionadas'>
                                          </div>
                                          -->

                                          <div class='form-group'>
                                            <button class='btn btn-primary btn-block border rounded' type='submit' name='send' style='background-color: #56c6c6'>Colgar</button>
                                          </div>
                                      </form>";
                                      ?>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="assetsContact/js/jquery.min.js"></script>
    <script src="assetsContact/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>

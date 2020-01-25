<?php
	include_once 'session.php';
  include_once '../../database_conn.php';
  $conexion = conexion();

  if(!isset($_SESSION['user'])) {
    header('location : login.php');
  }  
  
  if(isset($_POST['enviar'])){
	  $query = "INSERT INTO Correo(remite, destino, asunto, mensaje) VALUES ('".$_SESSION['user']['userEmail']."', '".$_POST['destino']."', '".$_POST['asunto']."', '".$_POST['mensaje']."')";
	  
	  if($resultado = mysqli_query($conexion, $query)){
		  header('location: correo.php?ok=1');
	  }else{
		  echo 'Error';
	  }
  }

  if(isset($_GET['destino'])){
    $destino = $_GET['destino'];
  }else{
    $destino = "Destinatario";
  }
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Correo de CSAPS</title>
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
                            <h1 class="text-left" style="color: #103567;padding-top: 20px;">Nuevo mensaje</h1>
                        </div>
                    </div>
                    
                    <p class="text-left">
	                    
	                    <form method="post">
		                    <input type="text" class="form-control" placeholder="<?php echo $destino;  ?>" name="destino"><br>
		                    <input type="text" class="form-control" placeholder="Asunto" name="asunto"><br>
		                    <textarea class="form-control" placeholder="Mensaje" name="mensaje"></textarea><br>
		                    <button style="background-color: #103567; border: none; margin-bottom: 20px;" class = "btn btn-primary btn-block" type="submit" name="enviar">Enviar</button>
	                    </form>    
	                    
	                </p>

                    
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

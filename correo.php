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
                            <h1 class="text-left" style="color: #103567;padding-top: 20px;">Bandeja de entrada</h1>
                        </div>
                        <a style="background-color: #103567; border: none; margin-bottom: 20px;" class = "btn btn-primary btn-block" href="nuevo_mensaje.php">Redactar Correo</a>
                    </div>
                    
                    <?php
	                 
	                 $query = "SELECT * FROM Correo WHERE destino = '".$_SESSION['user']['userEmail']."'";
	                 $resultado = mysqli_query($conexion, $query);
	                 if($resultado->num_rows < 1){ ?>
		              
		              <h6 class="text-left">No hay correo que mostrar.</h6>
		             
		             <?php   
	                 }else{
		                 while($row = mysqli_fetch_assoc($resultado)){ ?>
		                 
		                 
		                 <div class="row" style="margin-top: 1%;">
		                    <div class="col" style="border: 1px solid #103567; border-radius: 10px;">
			                    <a href="ver_mensaje.php?id=<?php echo $row['id']; ?>"><p style="font-size: 20px; font-weight: bold;" class="text-left"><?php echo $row['asunto']; ?></p></a>
			                    <p class="text-left">De: <?php echo $row['remite']; ?></p>
		                    </div>
	                    </div>
		                 
		                 <?php
			                 
		                 }
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

<?php
include_once 'session.php';
include_once '../../database_conn.php';

if (!isset($_SESSION['user'])) {
    header('location : login.php');
}

if ($_SESSION['user']['categoryName'] != 'ONG') {
    header('location : perfil.php');
}
include 'functions/show_solicitud.php';

$conexion = conexion();
?>

<!DOCTYPE html>
<html lang="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  <title>Solicitudes Actividad</title>

    <style>
        .specialButton {
            width: 90%;
            color: #103567;
            z-index: 2;
        }

        .row {
            display: flex;
        }

        button {
            background: transparent;
            border: none;
            padding: 0;
            margin: 0;
            justify-self: start;
            font-weight: bold;
        }

        #button {
            border: 1px solid #103567;
            width: 100%;
            background: #103567;
            margin: 5px 0;
            color: white;
        }

    </style>
</head>



  <body>
    <?php include "_navbar.php";   ?>

    <div class="container" style="margin-left: 15%;">
        <div class="col-xl-8">
            <div class="col-md-4 col-lg-10 col-xl-12 text-center">
                <div class="row">
                    <h1 class="text-left" style="color: #103567;padding-top: 20px;padding-bottom: 20px;">Solicitudes Propuestas</h1>
                </div>

                <?php
                    $id = $_GET['actividad'];

                    $query = " SELECT * FROM Usuario_Actividad u, UMA uma where u.actividad = '$id' AND u.usuario = uma.email AND u.estado = 'pendiente'";
                    $resultados = mysqli_query($conexion, $query);
                    if($resultados->num_rows == 0){
                        echo "<p class='text-left' style='font-size=20px;'>Aun no hay solicitudes o ya se han revisado todas</p>";
                    }
                    while($rows = mysqli_fetch_assoc($resultados)){
                        $alumno = $rows['email'];
                        $habilidades = "SELECT habilidad FROM Alumno_Habilidad WHERE alumno = '$alumno'";
                        $resultados2 = mysqli_query($conexion, $habilidades);
                        show_solicitud($rows, $resultados2);
                    }
                ?>
            </div> 
        </div>
    </div>

    <script src="assetsIndex/js/jquery.min.js"></script>
    <script src="assetsIndex/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
    <script src="assetsIndex/js/Simple-Slider.js"></script>
  </body>
</html>

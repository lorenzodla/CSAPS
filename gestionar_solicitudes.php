<?php
include_once 'session.php';
include_once '../../database_conn.php';

if (!isset($_SESSION['user'])) {
    header('location : login.php');
}

$conexion = conexion();

include 'functions/show_requests.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
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
    <title>AccionSocialMed</title>

    <style>
        .specialButton {
            width: 90%;
            color: #103456;
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
            border: 1px solid #103456;
            width: 100%;
            background: #103456;
            margin: 5px 0;
            color: white;
        }
    </style>
</head>

<body>
    <?php include '_navbar.php'; ?>

    <!-- Barra de navegaciรณn Izquierda -->
    <div id="wrapper">
        <div class="shadow-sm" id="sidebar-wrapper" style="width: 15%; background: transparent;">
            <ul class="sidebar-nav">
                <li style="margin-top: 15%;">
                    <a class="border rounded shadow-sm" href="gestionar_solicitudes.php?option=todas" style="color: #103456;">Ver Todas</a>
                </li>
                <li>
                    <a class="border rounded shadow-sm" href="gestionar_solicitudes.php?option=pendientes" style="color: #103456;">Pendientes</a>
                </li>
                <li>
                    <a class="border rounded shadow-sm" href="gestionar_solicitudes.php?option=aceptadas" style="color: #103456;">Aceptadas</a>
                </li>
                <li>
                    <a class="border rounded shadow-sm" href="gestionar_solicitudes.php?option=rechazadas" style="color: #103456;">Rechazadas</a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Contenedor Central-->
    <div class="container" style="margin-left: 15%;">
        <div class="col-xl-8">
            <div class="row">
                <div class="col-md-4 col-lg-10 col-xl-12 text-center">
                    <div class="row">
                        <div class="col">
                            <h1 class="text-left" style="color: #103456;padding-top: 20px;padding-bottom: 20px;">Solicitudes Realizadas</h1>
                        </div>
                    </div>
                    <div class="col">
                        <?php
                        switch ($_GET['option']) {
                            case 'todas':
                                $query = "SELECT * 
                                    FROM Actividad INNER JOIN Usuario_Actividad on (Actividad.ID = Usuario_Actividad.actividad) 
                                    WHERE usuario = '".$_SESSION['user']['userEmail']."'";
                                $text = "Aun no has realizado ninguna solicitud.";
                                break;
                            
                            case 'pendientes':
                                $query = "SELECT * 
                                    FROM Actividad INNER JOIN Usuario_Actividad on (Actividad.ID = Usuario_Actividad.actividad) 
                                    WHERE usuario = '" . $_SESSION['user']['userEmail'] . "' AND 
                                          estado = 'pendiente'";
                                $text = "Aun no has realizado ninguna solicitud.";
                                break;

                            case 'aceptadas':
                                $query = "SELECT * 
                                    FROM Actividad INNER JOIN Usuario_Actividad on (Actividad.ID = Usuario_Actividad.actividad) 
                                    WHERE usuario = '" . $_SESSION['user']['userEmail'] . "' AND 
                                          estado = 'aceptada'";
                                $text = "Aun no has sido aceptado en ninguna actividad.";
                                break;

                            case 'rechazadas':
                                $query = "SELECT * 
                                    FROM Actividad INNER JOIN Usuario_Actividad on (Actividad.ID = Usuario_Actividad.actividad) 
                                    WHERE usuario = '" . $_SESSION['user']['userEmail'] . "' AND 
                                          estado = 'rechazada'";
                                $text = "Aun no has sido rechazado en ninguna actividad.";
                                break;
                        }

                        $resultados = mysqli_query($conexion, $query);
                        if ($resultados->num_rows == 0) {
                            echo "<p style='font-size: 20px;' class='text-left'>$text</p>";
                        }
                        while ($rows = mysqli_fetch_assoc($resultados)) {
                            showRequest($rows);
                        }
                        ?>
                    </div>

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
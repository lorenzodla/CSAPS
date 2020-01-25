<?php
include_once 'session.php';
include_once '../../database_conn.php';
$conexion = conexion();

if (!isset($_SESSION['user'])) {
    header('location : login.php');
}

include 'functions/show_completed.php';

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

    <style>
        label {
            color: grey;
        }

        input[type="radio"] {
            display: none;
        }

        .clasificacion {
            direction: rtl;
            /* right to left */
            unicode-bidi: bidi-override;
            /* bidi de bidireccional */
        }

        label:hover {
            color: orange;
        }

        label:hover~label {
            color: orange;
        }

        input[type="radio"]:checked~label {
            color: orange;
        }

        .line {
            border: none;
            background: transparent;
            color: #103567;
        }

        .star {
            color: orange;
        }

        .roundImage {
            margin-top: 5px;
            border-radius: 50%;
            border: 1px solid #103567;
        }
    </style>
</head>

<body>
    <?php include "_navbar.php"; ?>

    <div class="container" style="margin-left: 15%;">
        
            <div class="row">
                <div class="col-md-4 col-lg-10 col-xl-12 text-center">
                    <div class="row">
                        <div class="col">
                            <h1 class="text-left" style="color: #103567;padding-top: 20px;padding-bottom: 20px;">Actividades Completadas</h1>
                        </div>
                    </div>

                    <?php
                    $query = "SELECT * FROM Actividad a, Usuario_Actividad ua where a.ID = ua.actividad AND ua.estado = 'ACEPTADA' AND a.fechaFin <= CURRENT_DATE";
                    $resultados = mysqli_query($conexion, $query);
                    while ($rows = mysqli_fetch_assoc($resultados)) {
                        show_completed($rows);
                    }
                    ?>

                </div>
            </div>
        
    </div>

    <script>

    </script>

    <script src="assetsIndex/js/jquery.min.js"></script>
    <script src="assetsIndex/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
    <script src="assetsIndex/js/Simple-Slider.js"></script>
</body>

</html>
<?php
    include_once 'session.php';
    include_once '../../database_conn.php';
    include_once ('algoritmo.php');

    $conexion = conexion();

    if (!isset($_SESSION['user'])) {
        header('location : login.php');
    }

    if($_SESSION['user']['categoryName'] == 'ONG') {
        header('location : modificar_datos_ong.php');
    }

    function getValoracion($email){
        $conexion = conexion();

        $query = "SELECT sum(v.likes)/count(v.Actividad) 'media' FROM Valoraciones_AUX v WHERE v.Actividad IN (SELECT ID FROM Actividad a WHERE a.propuestaPor = '$email' )";
        $resultado = mysqli_query($conexion,$query);

        $media = mysqli_fetch_assoc($resultado)['media'];

        if( $media == NULL){
            return 0.0;
        }else{
            return $media;
        }
        
        
    }

    function show_ONG($rows){
    echo "<div class='row' style='display: flex; margin-top: 1%; border: 1px solid #103567; border-radius: 10px;'>
             <div class='col-md-10' style='width: 60%;'>
                <p style='font-size: 20px;font-weight: bold;' class='text-left'>" . $rows['name'] . "</p>";
    if ($rows['description'] != NULL) {
        echo  "<p class='text-left'><strong>Cometido:</strong> " . $rows['description'] . "</p>";
    }
    if ($rows['ubication'] != NULL) {
        echo  "<p class='text-left'><strong>Sede:</strong> " . $rows['ubication'] . "</p>";
    }
    if ($rows['website'] != NULL) {
        echo  "<p class='text-left'><strong>Web:</strong> ";
        echo    "<a href='http://" . $rows['website'] . "'>" . $rows['website'] . "</a></p>";
    }
    echo   "</div>";

    if ($rows['picture'] != NULL) {
        $content = $rows['picture'];
        echo "<div class='col-md-2'>";
        echo "<img height='150' style='margin: 6px;'src='data:image/jpg; base64, " . base64_encode($content) . "'>";
        echo "<p>Valoracion: ".getValoracion($rows['email'])."<span style='color: gold;'> &#9733;</span></p>";
        echo "</div>";
    }
    echo  "</div>";
    }
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
    <title>Visualizar ONGs</title>

    <style>
        a{
            color: #103567;
        }
    </style>
</head>

<body>
    <?php include '_navbar.php'; ?>
    <!-- Barra de navegaci?n Izquierda -->
    <div id="wrapper">
        <div class="shadow-sm" id="sidebar-wrapper" style="width: 15%;background-color: transparent;">
            <ul class="sidebar-nav">
                <li style="margin-top: 15%;">
                    <a class="border rounded shadow-sm" href="visualizar_organizaciones.php?option=todas" style="color: #103567;">Ver Todas</a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Contenedor Central-->
    <div class="container" style="margin-left: 15%;">
        
            <div class="row">
                <div class="col-md-4 col-lg-10 col-xl-12 text-center">
                    <div class="row">
                        <div class="col">
                            <h1 class="text-left" style="color: #103567;padding-top: 20px;padding-bottom: 20px;">Organizaciones Colaboradoras</h1>
                        </div>
                    </div>

                    <!-- Barra de Busqueda -->
                    <div class="row" style = "margin-bottom: 5%;">
                        <div class="col">
                            <div class="d-table mt-5 mt-md-0 search-area" style="width: 500px;">
                              <i class="fas fa-search float-left search-icon"></i>
                              <?php
                                echo "<form action='visualizar_organizaciones.php' method='get'>
                                        <input onkeydown='pressed(event)' class='float-left float-sm-right custom-search-input' type='search' name='input' placeholder='Buscar una Organizacion' style='width: 100%;'>
                                      </form>";
                                ?>
                            </div>

                        </div>
                    </div>
                  
                    <?php
                    if ($_GET['option'] == 'todas') {
                        $query = "SELECT * FROM ONG";
                        $resultados = mysqli_query($conexion, $query);
                        while ($rows = mysqli_fetch_assoc($resultados)) {
                            show_ONG($rows);
                        }
                    } else if ($_GET['option'] == 'recomendadas') {
                        $user_email = $_SESSION['user']['userEmail'];
                        $lista = getActividadesFiltro($user_email);

                        for ($i=0;$i<count($lista);$i++) {
                            $id = $lista[$i]['ID'];
                            
                            $query = "SELECT DISTINCT propuestaPor FROM Actividad WHERE id = ".$id;
                            $actividad = mysqli_query($conexion, $query);
                            $row = mysqli_fetch_assoc($actividad);
                            $query_ong = "SELECT DISTINCT * FROM ONG WHERE email = '".$row['propuestaPor']."'";
                            $resultados = mysqli_query($conexion, $query_ong);
                            while ($rows = mysqli_fetch_assoc($resultados)) {
                                show_ONG($rows);
                            }
                        }
                    } else {
                        
                        $busqueda= $_GET['input'];
                        $query = "SELECT * FROM ONG WHERE description like '%$busqueda%' OR name like '%$busqueda%'";
                        $resultado = mysqli_query($conexion, $query);
                        
                        while($rows = mysqli_fetch_assoc($resultado)){
                            show_ONG($rows);
                        }
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
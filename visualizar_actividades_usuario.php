<?php
include_once('session.php');
include_once('../../database_conn.php');
include_once('algoritmo.php');

if (!isset($_SESSION['user'])) {
    header('location : login.php');
}

if ($_SESSION['user']['categoryName'] == 'ONG') {
    header('location : modificar_datos_ong.php');
}

$conexion = conexion();

include_once('functions/show_activity.php');

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
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
    <title>Visualizar actividades</title>

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

        .roundImage {
            margin-top: 5px;
            border-radius: 50%;
            border: 1px solid #103567;
        }

        a {
            color: #103567;
        }
    </style>
</head>

<body>
    <?php include '_navbar.php'; ?>

    <!-- Barra de navegación Izquierda -->
    <div id="wrapper">
        <div class="shadow-sm" id="sidebar-wrapper" style="width: 15%; background: transparent;">
            <ul class="sidebar-nav">
                <li style="margin-top: 15%;">
                    <a class="border rounded shadow-sm" href="visualizar_actividades_usuario.php?option=todas" style="color: #103567;">Ver Todas</a>
                </li>
                <li>
                    <a class="border rounded shadow-sm" href="visualizar_actividades_usuario.php?option=recomendadas" style="color: #103567;">Ver Recomendadas</a>
                </li>
                <li>
                    <form method="get">
                        <label>Ambito</label>
                        <?php
                        $query = "SELECT * FROM Habilidades WHERE tipo=0";
                        $resultset = mysqli_query($conexion, $query);
                        while ($row = mysqli_fetch_assoc($resultset)) {
                            echo "<div class='form-check'>
                                    <input name='ambitos[]' class='form-check-input' type='checkbox' id='formCheck' value ='" . $row['Nombre'] . "'>
                                    <label class='form-check-label' for='formCheck'>" . $row['Nombre'] . "</label>
                                </div>";
                        }
                        ?>
                        <label>Tipo</label>
                        <?php
                        $query = "SELECT * FROM Habilidades WHERE tipo=1";
                        $resultset = mysqli_query($conexion, $query);
                        while ($row = mysqli_fetch_assoc($resultset)) {
                            echo "<div class='form-check' >
                                <input name='tipos[]' class='form-check-input' type='checkbox' id='formCheck' value ='" . $row['Nombre'] . "'>
                                <label class='form-check-label' for='formCheck'>" . $row['Nombre'] . "</label>
                            </div>";
                        }
                        ?>
                        <input style = "margin-bottom: 200px;" class="specialButton border rounded shadow-sm" type="submit" value="buscar">
                    </form>

                </li>
            </ul>
        </div>
    </div>

    <!-- Contenedor Central-->
    <div class="container" style="margin-left: 15%;">
            <div class="row">
                <div class="col">
                    <h1 class="text-left" style="color: #103567;padding-top: 20px;padding-bottom: 20px;">Actividades Disponibles</h1>
                </div>
            </div>

            <!-- Barra de Busqueda -->
            <div class="row" style="margin-bottom: 5%;">
                <div class="col">
                    <div class="d-table mt-5 mt-md-0 search-area" style="width: 500px;">
                        <i class="fas fa-search float-left search-icon"></i>
                        <?php
                        echo "<form action='visualizar_actividades_usuario.php' method='get'>
                                    <input onkeydown='pressed(event)' class='float-left float-sm-right custom-search-input' type='search' name='input' placeholder='Buscar una Actividad' style='width: 100%;'>
                                    </form>";
                        ?>
                    </div>

                </div>
            </div>

            <div class="col text-center">
                <?php
                    if ($_GET['option'] == 'todas') {
                        $query = "SELECT * FROM Actividad WHERE aceptada=1";
                        $resultados = mysqli_query($conexion, $query);
                    
                        if($resultados->num_rows == 0){
                            echo "<p style='font-size: 20px;' class='text-left'> Aun no hay ninguna actividad disponible.</p>";
                        }else{
                            while ($rows = mysqli_fetch_assoc($resultados)) {
                                show_activity($rows);
                            }
                        }

                    } else if ($_GET['option'] == 'recomendadas') {

                        $user_email = $_SESSION['user']['userEmail'];
                        $lista = getActividadesFiltro($user_email);

                        if(count($lista) == 0){
                            echo "<p style='font-size: 20px;' class='text-left'>Ninguna actividad se adapta a ti o aun no has elegido preferencias.</p>";
                        }

                        for ($i = 0; $i < count($lista); $i++) {
                            $id = $lista[$i]['ID'];

                            $query = "SELECT * FROM Actividad WHERE ID = " . $id;
                            $actividad = mysqli_query($conexion, $query);
                            while ($rows = mysqli_fetch_assoc($actividad)) {
                                show_activity($rows);
                            }
                        }
                    } else if ($_GET['input']) {

                        $query = "SELECT * FROM Actividad WHERE Titulo LIKE '%" . $_GET['input'] . "%' OR descripcion LIKE '%" . $_GET['input'] . "%'";
                        $actividad = mysqli_query($conexion, $query);

                        if($actividad->num_rows == 0){
                            echo "<p style='font-size: 20px;' class='text-left'>Ninguna actividad coincide con tu busqueda.</p>";
                        }
                        while ($rows = mysqli_fetch_assoc($actividad)) {
                            show_activity($rows);
                        }
                    } else {

                        //NO TOCAR ESTE CODIGO PLS QUE ESTA EN PROCESO

                        $ambitos = $_GET['ambitos'];
                        $tipos = $_GET['tipos'];

                        for ($i = 0; $i < count($ambitos); $i++) {

                            $query_seleccionar = "SELECT * FROM Actividad, Actividad_Habilidad 
                                        WHERE actividad = ID AND habilidad = '" . $ambitos[$i] . "'";
                            $resultado = mysqli_query($conexion, $query_seleccionar);


                            if (mysqli_num_rows($resultado) != 0) {
                                while ($rows = mysqli_fetch_assoc($resultado)) {
                                    show_activity($rows);
                                }
                            }else{
                                echo "<p style='font-size: 20px;' class='text-left'>Ninguna actividad coincide con tu busqueda</p>";
                            }
                        }

                        for ($i = 0; $i < count($tipos); $i++) {
                            $query_seleccionar = "SELECT * FROM Actividad, Actividad_Habilidad 
                                        WHERE actividad = ID AND habilidad = '" . $tipos[$i] . "'";
                            $resultado = mysqli_query($conexion, $query_seleccionar);

                            if (mysqli_num_rows($resultado) != 0) {
                                while ($rows = mysqli_fetch_assoc($resultado)) {
                                    show_activity($rows);
                                }
                            }
                        }
                    }
                ?>
            </div>
    </div>



    <script src="assetsIndex/js/jquery.min.js"></script>
    <script src="assetsIndex/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
    <script src="assetsIndex/js/Simple-Slider.js"></script>
</body>

</html
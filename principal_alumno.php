<?php
include_once 'session.php';
include_once '../../database_conn.php';

if (!isset($_SESSION['user'])) {
    header('location : login.php');
}

if ($_SESSION['user']['categoryName'] == 'ONG') {
    header('location : perfil.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Pantalla Principal Alumno</title>
    <link rel="stylesheet" href="assetsPrincipalAlumno/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assetsPrincipalAlumno/css/Navegacin-APS.css">
    <link rel="stylesheet" href="assetsPrincipalAlumno/css/styles.css">

    <style media="screen">
        #button {
            border: 1px solid #103567;
            width: 80%;
        }
    </style>

</head>

<body>
    <?php include "_navbar.php"; ?>


    <div style="margin-top: 30px">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center">

                    <?php
                    $conexion = conexion();

                    $query = "select nombre, apellido1, apellido2, picture from UMA where email='" . $_SESSION['user']['userEmail'] . "'";

                    if ($resultado = mysqli_query($conexion, $query)) {
                        $datos = mysqli_fetch_assoc($resultado);
                        echo "<form>";
                        echo "<div class='form-group'><img src='data:image/jpg; base64, " . base64_encode($datos['picture']) . "' style='width: 250px;height: 250px;' ></div>";
                        echo "</form>";
                        echo "<div class='form-group'><label>" . $datos['nombre'] . " " . $datos['apellido1'] . " " . $datos['apellido2'] . "</label></div>";
                    } else {
                        echo "error en la consulta";
                    }



                    ?>

                </div>
                <div class="col-md-6 text-center">
                    <form>
                        <div class="form-group"><label>¿Qué te gustaría hacer?</label></div>
                        <div class="form-group"> <a id="button" class="btn btn-blue action-button" role="button" href="/modificar_datos_usuario.php"> Editar Información Personal</a></div>
                        <div class="form-group"><a id="button" class="btn btn-blue action-button" role="button" href="visualizar_organizaciones.php?option=todas">Organizaciones Colaboradoras</a></div>
                        <div class="form-group"><a id="button" class="btn btn-blue action-button" role="button" href="visualizar_actividades_usuario.php?option=todas">Catálogo de actividades</a></div>
                        <hr>
                        <p>Mi Área Personal</p>
                        <div class="form-group"><a id="button" class="btn btn-blue action-button" role="button" href="gestionar_solicitudes.php?option=todas">Gestión de Solicitudes</a></div>
                        <!--<div class="form-group"> <a id="button" class="btn btn-blue action-button" role="button" href="ver_evaluaciones.php">Actividades en curso</a></div>-->
                        <div class="form-group"> <a id="button" class="btn btn-blue action-button" role="button" href="valorar_act_completa_al.php">Actividades Completadas</a></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="assetsPrincipalAlumno/js/jquery.min.js"></script>
    <script src="assetsPrincipalAlumno/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
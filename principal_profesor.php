<?php
include_once 'session.php';
include_once '../../database_conn.php';

if (!isset($_SESSION['user'])) {
    header('location : login.php');
}

if ($_SESSION['user']['categoryName'] != 'PDI' && $_SESSION['user']['categoryName'] != 'PAS') {
    header('location : index.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Pantalla Principal Profesor</title>
    <link rel="stylesheet" href="assetsPrincipalProfesor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assetsPrincipalProfesor/css/Navegacin-APS.css">
    <link rel="stylesheet" href="assetsPrincipalProfesor/css/styles.css">

    <style media="screen">
        #button {
            border: 1px solid #103567;
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
                        <div class="form-group"> <a id="button" class="btn btn-blue action-button" role="button" href="/modificar_datos_usuario.php"> Modificar Datos</a></div>
                        <div class="form-group"><a id="button" class="btn btn-blue action-button" role="button" href="visualizar_organizaciones.php?option=todas">Organizaciones Colaboradoras</a></div>
                        <div class="form-group"> <a id="button" class="btn btn-blue action-button" role="button" href="/visualizar_actividades.php"> Catálogo de Actividades</a></div>
                        <label>Panel de Docencia</label>
                        <hr>
                        <!--<div class="form-group"> <a id="button" class="btn btn-blue action-button" role="button" href="revisar_actividades_profesor.php"> Mis asignaturas</a></div>-->
                        <!--<div class="form-group"> <a id="button" class="btn btn-blue action-button" role="button" href="asignar_proyecto.php">Asignar Proyecto a Estudiantes</a></div>-->
                        <div class="form-group"> <a id="button" class="btn btn-blue action-button" role="button" href="ver_evaluaciones.php">Ver Evaluaciones</a></div>
                        <div class="form-group"> <a id="button" class="btn btn-blue action-button" role="button" href="evaluacion_alumno.php">Evaluar Alumnos</a></div>
                        <!--<div class="form-group"> <a id="button" class="btn btn-blue action-button" role="button" href="revisar_act_docencia_prof.php">Requisito GA6</a></div>-->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="assetsPrincipalProfesor/js/jquery.min.js"></script>
    <script src="assetsPrincipalProfesor/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
<?php
    include_once 'session.php';
    include_once '../../database_conn.php';

    if(!isset($_SESSION['user'])) {
        header('location : login.php');
    } 

    if(!$esGestor) {
        header('location : perfil.php');
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Pantalla Principal Gestor</title>
    <link rel="stylesheet" href="assetsPrincipalGestor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assetsPrincipalGestor/css/Navegacin-APS.css">
    <link rel="stylesheet" href="assetsPrincipalGestor/css/styles.css">

    <style media="screen">
      #button{
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

                        $query = "select nombre, apellido1, apellido2, picture from UMA where email='".$_SESSION['user']['userEmail']."'";

                        if ($resultado = mysqli_query($conexion, $query)) {
                            $datos = mysqli_fetch_assoc($resultado);
                            echo "<form>";
                            echo "<div class='form-group'><img src='data:image/jpg; base64, " . base64_encode ($datos['picture'])."' style='width: 250px;height: 250px;' ></div>";
                            echo "</form>";
                            echo "<div class='form-group'><label>".$datos['nombre']." ".$datos['apellido1']." ".$datos['apellido2']."</label></div>";
                        } else {
                            echo "error en la consulta";
                        }
                    ?>

                </div>
                <div class="col-md-6 text-center">
                    <form>
                        <div class="form-group"><label>¿Qué te gustaría hacer?</label></div>
                        <!--<div class="form-group"><a id="button" class="btn btn-blue action-button" role="button" href = "/modificar_datos_usuario.php"> Modificar Datos</a></div>-->
                        <div class="form-group"><a id="button" class="btn btn-blue action-button" role="button" href = "/gestion_noticias.php">Editar noticias</a></div>
                        <div class="form-group"><a id="button" class="btn btn-blue action-button" role="button" href = "/revisar_actividades.php">Propuestas de Actividades</a></div>
                        <!--<div class="form-group"><a id="button" class="btn btn-blue action-button" role="button" href = "/actividad_a_profesor.php">Enviar Actividad Investigación a un Profesor</a></div>
                        <div class="form-group"><a id="button" class="btn btn-blue action-button" role="button" href = "/actividad_a_asignatura.php">Enlazar Actividad Docencia con Asignatura</a></div>-->
                        <!--<div class="form-group"><a id="button" class="btn btn-blue action-button" role="button" href = "/agrupar_en_proyectos.php">Agrupar Actividades en un Proyecto</a></div>-->
                        <div class="form-group"><a id="button" class="btn btn-blue action-button" role="button" href ="/registro.php">Registrar gestores/Organizaciones</a></div>
                        <!--<div class="form-group"><a id="button" class="btn btn-blue action-button" role="button" href = "visualizar_organizaciones.php?option=todas">Ver Organizaciones</a></div>-->
                        <div class="form-group"><a id="button" class="btn btn-blue action-button" role="button" href ="/eliminar_ongs.php">Eliminar Organizaciones</a></div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="assetsPrincipalGestor/js/jquery.min.js"></script>
    <script src="assetsPrincipalGestor/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>

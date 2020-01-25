<?php
include_once('session.php');
include_once('../../database_conn.php');

if (!isset($_SESSION['user'])) {
    header('location : login.php');
}

if ($_SESSION['user']['categoryName'] != 'PDI') {
    header('location : perfil.php');
}

$conexion = conexion();


if (isset($_POST['submit'])) {
    $nota = $_POST['nota'];

    $query = "INSERT INTO Evaluacion VALUES ('" . $_GET['email'] . "','" . $_SESSION['user']['userEmail'] . "'," . $_GET['actividad'] . ", '" . $_POST['comentario'] . "', " . $nota . ")";

    mysqli_query($conexion, $query);

    echo "<script>";
    echo "alert('Se ha evaluado al alumno');";
    echo "window.location.assign('https://www.csaps.alphaduck.software/evaluacion_alumno.php')";
    echo "</script>";
}


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Evaluar Alumno</title>
    <link rel="stylesheet" href="assets_Evaluacion_Alumno/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets_Evaluacion_Alumno/css/Navegacin-APS.css">
    <link rel="stylesheet" href="assets_Evaluacion_Alumno/css/styles.css">

    <style>
        a {
            color: #103567;

        }
    </style>
</head>

<body>
    <?php include "_navbar.php"; ?>

    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-4"><label class="text-center" style="font-size: 31px;padding: 6px;width: 343px;">Alumnos</label>
                    <form method="get">
                        <ul style="border: #103567;" class="list-group">
                            <?php
                            $query = "SELECT u.email, u.nombre, u.apellido1, u.apellido2, a.ID AS id, a.tipo AS tipo FROM UMA u, Usuario_Actividad ua, Actividad a 
                                                WHERE u.email = ua.usuario and a.ID = ua.actividad and CURDATE() >= fechaFin and u.email <> ALL (select alumno from Evaluacion) 
                                                and a.aceptada = 1";
                            $res = mysqli_query($conexion, $query);
                            if ($res->num_rows == 0) {
                                echo "<li class='list-group-item border-info'><span>No es posible evaluar ningún alumno</span></li>";
                            } else {
                                while ($data = mysqli_fetch_assoc($res)) {
                                    echo "<li class='list-group-item border-info'><a href='evaluacion_alumno.php?email=" . $data['email'] . "&actividad=" . $data['id'] . "&tipo=" . $data['tipo'] . "'>" . $data['nombre'] . " " . $data['apellido1'] . " " . $data['apellido2'] . " - Actividad: " . $data['id'] . " - " . $data['tipo'] . "</a></li>";
                                }
                            }
                            ?>
                        </ul>
                    </form>
                </div>

                <div class="col-md-4">
                    <label class="text-left" style="font-size: 22px;width:50;padding: 12px;">Informe realizado por ONG a cargo</label>

                    <textarea class='border-info' style='width: 359px;height: 431px;' disabled>
                    <?php
                    if ($_GET['email'] and $_GET['actividad']) {
                        $query = "SELECT * FROM Informe, Actividad a WHERE Alumno = '" . $_GET['email'] . "' AND Actividad = " . $_GET['actividad'];
                        $resultados = mysqli_query($conexion, $query);
                        if ($res = mysqli_fetch_assoc($resultados)) {
                            $query = "select Titulo from Actividad where ID = " . $_GET['actividad'];
                            $nombre = mysqli_fetch_assoc(mysqli_query($conexion, $query));

                            echo "\nInforme del alumno con email " . $_GET['email'] . " que realizó la actividad " . $nombre['Titulo'] . ".\n\n";

                            echo "El alumno ha realizado un total de " . $res['Horas'] . " horas, realizando una serie de actividades que consistian en " . $res['Trabajo_Realizado'] . ".\n\n";

                            echo "Comentarios: " . $res['Comentario'] . "\n\n";

                            echo "Valoración : " . $res['Valoracion'];
                        }
                    }
                    ?>
                    
                    </textarea>

                </div>

                <div class="col-md-4">
                    <?php

                    if ($_GET['actividad'] && $_GET['email'] && $_GET['tipo'] != "Voluntariado") {
                        echo "<form method='post' enctype='multipart/form-data'>";
                        echo "<div class='col-md-4'><label class='text-center' style='font-size: 31px;padding: 6px;width: 356px;'>Evaluación final</label>";
                        echo "<div class='col-md-4'><label class='text-center' style='font-size: 15px;padding: 6px;width: 356px;'>Comentarios</label>";
                        echo "<textarea class='border-info' name='comentario' id='comentario' type='text' style='width: 306px;height: 70px; padding: 0px;margin: 29px;'></textarea>";

                        echo "<div class='col-md-4'><label class='text-center' style='font-size: 15px;padding: 6px;width: 356px;'>Nota</label>";
                        echo "<input class='border-info' name='nota' id='nota' type='text' style='width: 306px;padding: 0px;margin: 29px;'>";

                        echo "<button class='btn btn-primary' type='submit' name='submit' id='submit' style='padding: 10px;width: 106px;margin: 128px;'>Guardar</button></div>";
                        echo "</form>";
                    } else {
                        echo "<div class='col-md-4'><label class='text-center' style='font-size: 31px;padding: 6px;width: 356px;'>Evaluación final</label>";
                        echo "<div class='col-md-4'><label class='text-center' style='font-size: 15px;padding: 6px;width: 356px;'>Comentarios</label>";
                        echo "<textarea class='border-info' name='comentario' id='comentario' type='text' style='width: 306px;height: 70px; padding: 0px;margin: 29px;' disabled></textarea>";

                        echo "<div class='col-md-4'><label class='text-center' style='font-size: 15px;padding: 6px;width: 356px;'>Nota</label>";
                        echo "<input class='border-info' name='nota' id='nota' type='text' style='width: 306px;padding: 0px;margin: 29px;' disabled>";

                        echo "<button class='btn btn-primary' type='submit' name='submit' id='submit' style='padding: 10px;width: 106px;margin: 128px;' disabled>Guardar</button></div>";
                    }

                    ?>


                </div>
            </div>
        </div>
    </div>
    <script src="assets_Evaluacion_Alumno/js/jquery.min.js"></script>
    <script src="assets_Evaluacion_Alumno/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
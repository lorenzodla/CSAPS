<?php
    include_once ('session.php');
    include_once ('../../database_conn.php');

    if(!isset($_SESSION['user'])) {
        header('location : login.php');
      } 
    
    if($_SESSION['user']['categoryName'] != 'ONG') {
        header('location : perfil.php');
    }

    $conexion = conexion();
    
    if (isset($_POST['submit'])) {
       
        $query = "INSERT INTO Informe values ('".$_SESSION['user']['userEmail']."','".$_GET['alumno']."', ".$_GET['actividad'].", '".$_POST['horas']."', '".$_POST['trabajo']."', '".$_POST['comentario']."', '".$_POST['valoracion']."')";
        
        mysqli_query($conexion, $query);
        echo "<script>";
        echo "alert('Se ha añadido el informe');";
        echo "window.location.assign('https://www.csaps.alphaduck.software/informe_actividad.php')";
        echo "</script>";
    }

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Informe Actividad ONG</title>
    <link rel="stylesheet" href="assets_Informe_Actividad/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets_Informe_Actividad/css/FPE-Gentella-form-elements-1.css">
    <link rel="stylesheet" href="assets_Informe_Actividad/css/FPE-Gentella-form-elements.css">
    <link rel="stylesheet" href="assets_Informe_Actividad/css/Navegacin-APS.css">
    <link rel="stylesheet" href="assets_Informe_Actividad/css/styles.css">
</head>

<body style="background-color: rgb(255,255,255);">
<?php include '_navbar.php'; ?>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-4"><label style="font-size: 22px;padding: 8px;">Seleccione una actividad</label>
                    <form>
                        <ul class="list-group">
                        <?php
                            $query = "SELECT ID, Titulo FROM Actividad WHERE fechaFin <= CURDATE() AND propuestaPor = '".$_SESSION['user']['userEmail']."'";
                            $res = mysqli_query($conexion, $query);
                            if ($res->num_rows == 0) {
                                echo "<li class='list-group-item border-info'><span>No hay ninguna actividad para evaluar</span></li>";
                            } else {
                                while($data = mysqli_fetch_assoc($res)){
                                    echo "<li class='list-group-item border-info'><a href='informe_actividad.php?actividad=".$data['ID']."'>".$data['ID']." ".$data['Titulo']."</a></li>";
                                }
                            }
                            
                        ?>
                        </ul>
                    
                    
                        </form><label style="font-size: 22px;padding: 11px;">Seleccione un alumno</label>
                    <ul class="list-group">
                    <?php
                        if ($_GET['actividad']) {
                            $query = "SELECT email, nombre, apellido1, apellido2 FROM UMA, Usuario_Actividad WHERE usuario = email AND actividad = ".$_GET['actividad']." AND usuario <> ALL (select alumno from Informe)";
                            $res = mysqli_query($conexion, $query);
                            if ($res->num_rows == 0) {
                                echo "<li class='list-group-item border-info'><span>No existe ningun alumno disponible</span></li>";
                            } else {
                                while($data = mysqli_fetch_assoc($res)){
                                    echo "<li class='list-group-item border-info'><a href='informe_actividad.php?actividad=".$_GET['actividad']."&alumno=".$data['email']."'>".$data['nombre']." ".$data['apellido1']." ".$data['apellido2']."</a></li>";
                                }
                            }
                        } else {
                            echo "<li class='list-group-item border-info'><span>No existe ningun alumno disponible</span></li>";
                        }
                    ?>
                        
                    </ul>
                </div>
                
                <div class='col'>
                <?php
                        if ($_GET['actividad'] && $_GET['alumno']) {
                            echo "<form method='post' id ='formulario' enctype='multipart/form-data'> ";
                            echo "<label class='text-center' style='width: 621px;font-size: 21px;padding: 11px;'>Informe sobre transcurso de actividad</label>";

                            echo "<label class='text-center' style='width: 621px;font-size: 15px;padding: 11px;'>Número de horas</label>";
                            echo "<textarea class='border rounded-0 border-info' style='width: 618px;height: 40px;' id='horas' name='horas'></textarea>";
                            
                            echo "<label class='text-center' style='width: 621px;font-size: 15px;padding: 11px;'>Trabajo realizado</label>";
                            echo "<textarea class='border rounded-0 border-info' style='width: 618px;height: 150px;' id='trabajo' name='trabajo'></textarea>";

                            echo "<label class='text-center' style='width: 621px;font-size: 15px;padding: 11px;'>Comentarios</label>";
                            echo "<textarea class='border rounded-0 border-info' style='width: 618px;height: 150px;' id='comentario' name='comentario'></textarea>";

                            echo "<label class='text-center' style='width: 621px;font-size: 15px;padding: 11px;'>Valoracion final</label>";
                            echo "<textarea class='border rounded-0 border-info' style='width: 618px;height: 40px;' id='valoracion' name='valoracion'></textarea>";

                            echo "<button class='btn btn-primary' type='submit' style='padding: 9px;margin: 19px;width: 101px;' id='submit' name='submit'>Enviar</button>";
                            echo "</form>";
                        } else {
                            echo "<label class='text-center' style='width: 621px;font-size: 21px;padding: 11px;'>Informe sobre transcurso de actividad</label>";

                            echo "<label class='text-center' style='width: 621px;font-size: 15px;padding: 11px;'>Número de horas</label>";
                            echo "<textarea class='border rounded-0 border-info' style='width: 618px;height: 40px;' id='horas' name='horas' disabled></textarea>";
                            
                            echo "<label class='text-center' style='width: 621px;font-size: 15px;padding: 11px;'>Trabajo realizado</label>";
                            echo "<textarea class='border rounded-0 border-info' style='width: 618px;height: 150px;' id='trabajo' name='trabajo' disabled></textarea>";

                            echo "<label class='text-center' style='width: 621px;font-size: 15px;padding: 11px;'>Comentarios</label>";
                            echo "<textarea class='border rounded-0 border-info' style='width: 618px;height: 150px;' id='comentario' name='comentario' disabled></textarea>";

                            echo "<label class='text-center' style='width: 621px;font-size: 15px;padding: 11px;'>Valoracion final</label>";
                            echo "<textarea class='border rounded-0 border-info' style='width: 618px;height: 40px;' id='valoracion' name='valoracion' disabled></textarea>";

                            echo "<button class='btn btn-primary' type='submit' style='padding: 9px;margin: 19px;width: 101px;' id='submit' name='submit' disabled>Enviar</button>";
                        }

                        
                ?>
                </div>
            </div>
        </div>
    </div>
    <script src="assets_Informe_Actividad/js/jquery.min.js"></script>
    <script src="assets_Informe_Actividad/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
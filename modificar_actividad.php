<?php
include_once('session.php');
if (!isset($_SESSION['user'])) {
    header('location: login.php');
}

if ($_SESSION['user']['categoryName'] != 'ONG' && !$esGestor && $_SESSION['user']['categoryName'] != 'PAS') {
    header('location : perfil.php');
}

include_once('../../database_conn.php');
$conexion = conexion();

//Campos De la actividad que estoy modificando
$id = $_GET['id'];
$query = "SELECT * FROM Actividad WHERE ID=$id";
$resultado = mysqli_query($conexion, $query);
$row = mysqli_fetch_assoc($resultado);

$titulo = $row['Titulo']; //Titulo
$tipo = $row['tipo']; //Clasificacion - Debe ser sin aceptar, pero no puede salir de aquí sin ser de un tipo.
$proyecto = $row['proyecto']; //Proyecto - Debe ser null, pero no se puede salir de aquí sin que el gestor diga si se asigna o si no.
$participantes = $row['participantes']; //Numero de participantes
$horasDia = $row['horasDia']; //Numero de horas al dia
$descripcion = $row['descripcion']; //Descripcion de la actividad
$fechaInic = $row['fechaInicio']; //Fecha de inicio de la actividad
$fechaFin = $row['fechaFin']; //Fecha fin de la actividad
$horario = $row['horario']; //Horario elegido
$archivo = $row['archivo']; //Archivo que se ha subido

//Cargo en 2 arrays las Preferencias
$query = "SELECT * 
            FROM Actividad_Habilidad ah,Habilidades a
            WHERE ah.actividad = $id AND
                  ah.habilidad = a.Nombre";
$result = mysqli_query($conexion, $query);
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['Tipo'] == 0) {
        $ambitos[] = $row['habilidad'];
    } else {
        $tipos[] = $row['habilidad'];
    }
}



//Funciones para manejar la vista del formulario

// Permite marcar como elegido el horario preferente que estaba.
function setSelected($option, $horario)
{
    if ($option === $horario) {
        echo "selected";
    }
}

// Permite marcar un check si la habilidad estaba en la actividad
function setChecked($skill, $preferencias) {
    if($preferencias ==NULL){
        return;
    } else if (in_array($skill, $preferencias)) {
        return "checked";
    }
}


?>

<!DOCTYPE html>
<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>AccionSocialMed</title>
    <link rel="stylesheet" href="assetsSubirActividades/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assetsSubirActividades/css/16-scrollbar-styles-1.css">
    <link rel="stylesheet" href="assetsSubirActividades/css/16-scrollbar-styles.css">
    <link rel="stylesheet" href="assetsSubirActividades/css/componente-fromulario.css">
    <link rel="stylesheet" href="assetsSubirActividades/css/Custom-Checkbox.css">
    <link rel="stylesheet" href="assetsSubirActividades/css/Navegacin-APS.css">
    <link rel="stylesheet" href="assetsSubirActividades/css/styles.css">
    
    <style>
        textarea{
            height: 80%;
            width: 100%;
            resize: none;
            color: #555;
            background-color: rgb(248,249,252);
            
            border: 1px  #ccc;
            border-radius: 4px;
            
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
                    box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                
            text-align: left;
        }
    </style>
</head>

<body>
    <?php include "_navbar.php"; ?>

    <div class="register-photo">
        <div class="form-container">
            <form method="POST" enctype="multipart/form-data" action="scripts/modificar_actividad_gestor.php">
                <!--Bloque para Elegir el título -->
                <?php
                if ($esGestor) {
                    echo "<h2 class='text-center'><strong>Actividad Propuesta</strong></h2>";
                } else {
                    echo "<h2 class='text-center'><strong>Propuesta de Modificaciones</strong></h2>";
                }
                ?>

                <div class="form-group">
                    <!--Parámetros Ocultos--> 
                    <input type="hidden" name=id value="<?php echo $id?>">
                    <!--Clasificar Actividad / Ver clasificación -->
                    <div class="form-row">
                        <div class="col-6 col-lg-11">
                            <?php
                            if ($esGestor) {
                                echo '<label>Clasificar Como:</label>
                                            <select class="form-control" name="clasificacion" required style="margin: 6px;">
                                                <option value="Voluntariado">Voluntariado</option>
                                                <option value="Investigación">Investigación</option>
                                                <option value="Docencia">Docencia</option>
                                            </select>';
                            } else {
                                echo "<label> Clasificada Como: $tipo";
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-row">
                        <!--Primera Columna + Archivo + Descripcion -->
                        <div class="col-6 col-lg-6">
                            <div class="form-row">
                                <div class="col-lg-8">
                                    <label>Titulo:</label>
                                    <input class='form-control' type='text' name='titulo' style='margin: 6px;' value='<?php echo $titulo; ?>' required>

                                    <label>Participantes:</label>
                                    <input class='form-control' type='number' name='participantes' style='margin: 6px;' value='<?php echo $participantes; ?>' required>

                                    <label>Horas/Día:</label>
                                    <input class='form-control' type='number' name='horasDia' required placeholder='H/D' style='margin: 6px;' value='<?php echo $horasDia; ?>'>

                                    <label>Descripción de la actividad:</label>
                                    <div  style='height: 200px; width: 288%;margin-bottom: -20px;'>
                                        <textarea rows='8' name='descripcion' required>
                                            <?php echo $descripcion; ?>
                                        </textarea>
                                    </div>

                                    <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero (Para subir archivos al servidor)-->
                                    <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />

                                    <?php
                                        if ($archivo != NULL) {
                                            echo "<label>Archivos adicionales: <a href='$archivo' target='_blank'>" . basename($archivo) . "</a><label>";
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- Segunda Columna -->
                        <div class="col-lg-5 ">
                            <label>Fecha Inicio:</label>
                            <input class='form-control' type='date' name='fechaInicio' required style='margin: 6px;' value='<?php echo $fechaInic; ?>'>

                            <label>Fecha Finalización:</label>
                            <input class='form-control' type='date' name='fechaFinalizacion' required style='margin: 6px;' value='<?php echo $fechaFin; ?>'>

                            <label>Horario Preferente:</label>
                            <select class="form-control" name="horario" required style="margin: 6px;">
                                <option value="Mañana">Mañana</option>
                                <option value="Tarde" <?php setSelected('Tarde', $horario) ?>>Tarde</option>
                                <option value="Noche" <?php setSelected('Noche', $horario) ?>>Noche</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-6 col-lg-8">
                        <div class="form-row">
                            <!--Ámbito -->
                            <div class="col">
                                <h1 style="font-size: 24px;"><strong>Ámbito:</strong></h1>
                                <?php
                                    $query = "SELECT * FROM Habilidades WHERE Tipo = 0";
                                    $res = mysqli_query($conexion, $query);
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        echo "<div class='form-check' style='margin: 3px;'>
                                                <input value='".$row['Nombre']."' name='ambitos[]' class='form-check-input' type='checkbox' id='formCheck' " . setChecked($row['Nombre'], $ambitos) . ">
                                                <label class='form-check-label' for='formCheck'>" . $row['Nombre'] . "</label>
                                            </div>";
                                    }
                                ?>
                            </div>
                            <!--Tipo-->
                            <div class="col">
                                <h1 style="font-size: 24px;"><strong>Tipo:</strong></h1>
                                <?php
                                    $query = "SELECT * FROM Habilidades WHERE Tipo = 1";
                                    $res = mysqli_query($conexion, $query);
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        echo "<div class='form-check' style='margin: 3px;'>
                                                <input value='" . $row['Nombre'] . "' name='tipos[]' class='form-check-input' type='checkbox' id='formCheck' " . setChecked($row['Nombre'], $tipos) . ">
                                                <label class='form-check-label' for='formCheck'>" . $row['Nombre'] . "</label>
                                        </div>";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Botonera -->
                <div class='form-group'>
                    <button style='background: #56c6c6; max-width: 20%; margin-left: 40%;' class='btn btn-primary btn-block' type='submit' name='Reenviar'>Proponer Modificacion</button>
                    <button style='background: #56c6c6; max-width: 20%; margin-left: 40%;' class='btn btn-primary btn-block' type='submit' name='Aceptar'>Aceptar Actividad</button>
                    <button style='background: #56c6c6; max-width: 20%; margin-left: 40%;' class='btn btn-primary btn-block' type='submit' name='Denegar'>Denegar Actividad</button>
                </div>
            </form>
        </div>
    </div>
    <script src="assetsSubirActividades/js/jquery.min.js"></script>
    <script src="assetsSubirActividades/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
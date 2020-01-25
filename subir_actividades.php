<?php
    include_once('session.php');
    if (!isset($_SESSION['user'])) {
        header('location: login.php');
    }

    if ($_SESSION['user']['categoryName'] != 'ONG') {
        header('location : perfil.php');
    }

    include_once('../../database_conn.php');
    $conexion = conexion();
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
            <form method="POST" enctype="multipart/form-data" action="scripts/subir_actividad_script.php">
                
                <h2 class='text-center'><strong>Nueva Solicitud de Actividad</strong></h2>
            
                <div class="form-group">
                    <div class="form-row">
                        <!--El script está en una subcarpeta, y al importar la session peta a little bit, entonces mando el correo de la ONG por aquí
                        Sin que se vea :) -->
                        <input type="hidden" name="organizacion" value="<?php echo $_SESSION['user']['userEmail'];?>">

                        <!-- Primera Columna a la izquierda +  Descripcion + Subida de archivo -->
                        <div class="col-6 col-lg-6">
                            <div class="form-row">
                                <div class="col-lg-8">
                                    <label>Título:</label>
                                    <input class='form-control' type='text' name='titulo' min='0' style='margin: 6px;' placeholder="Título" required>

                                    <label>Participantes:</label>
                                    <input class='form-control' type='number' name='participantes' min='0' style='margin: 6px;' placeholder="Número de participantes" required>
                                    
                                    <label>Horas/Día:</label>
                                    <input class='form-control' type='number' name='horasDia' required min='0' placeholder='H/D' style='margin: 6px;'>
                                    
                                    <label>Descripción de la actividad:</label>
                                    <div class='form-row' style='height: 200px; width: 288%;margin-bottom: -20px;'>
                                        <textarea class='form-control' rows='8' name='descripcion' required style='height: 150px;' placeholder="Descripcion de la actividad"></textarea>  
                                    </div>
                                    
                                    <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero (Para subir archivos al servidor-->
                                    <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
                                    <label>Archivos Adicionales:</label>
                                    <input type='file' name='archivo' style='width: 410px;'>   
                                </div>
                            </div>
                        </div>

                        <!-- Primera Columna a la derecha -->
                        <div class="col-lg-5 ">
                            <label>Fecha Inicio:</label>
                            <input class='form-control' type='date' name='fechaInicio' required style='margin: 6px;'>
                            
                            <label>Fecha Finalización:</label>
                            <input class='form-control' type='date' name='fechaFinalizacion' required style='margin: 6px;'>
                            
                            <label>Horario Preferente:</label>
                            <select class="form-control" name="horario" required style="margin: 6px;">
                                <option value="Mañana">Mañana</option>
                                <option value="Tarde">Tarde</option>
                                <option value="Noche">Noche</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-6 col-lg-8">
                                <div class="form-row">
                                    <!--Columna de los ámbitos -->
                                    <div class="col">
                                        <h1 style="font-size: 24px;"><strong>Ámbito:</strong></h1>
                                        <?php //ÁMBITO
                                            $query = "SELECT * FROM Habilidades WHERE Tipo = 0"; 
                                            $res_nombre = mysqli_query($conexion, $query);
                                            while ($row = mysqli_fetch_assoc($res_nombre)) {
                                        echo"  <div class='form-check' style='margin: 3px;'>
                                                    <input name='ambitos[]' class='form-check-input' type='checkbox' id='formCheck' value='".$row['Nombre']."'>
                                                    <label class='form-check-label' for='formCheck'>" . $row['Nombre'] . "</label>
                                                </div>";
                                            }
                                        ?>
                                    </div>
                                    
                                    <!--Columna de los tipos -->
                                    <div class="col">
                                        <h1 style="font-size: 24px;"><strong>Tipo:</strong></h1>
                                        <?php
                                            $query = "SELECT * FROM Habilidades WHERE Tipo = 1";
                                            $res_nombre = mysqli_query($conexion, $query);
                                            while ($row = mysqli_fetch_assoc($res_nombre)) {
                                            echo "<div class='form-check' style='margin: 3px;''>
                                                    <input name='tipos[]' class='form-check-input' type='checkbox' id='formCheck' value='".$row['Nombre']."'>
                                                    <label class='form-check-label' for='formCheck'>" . $row['Nombre'] . "</label>
                                                </div>";
                                            }
                                        ?>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                
                <!--Botones -->
                <div class='form-group'>
                    <button style='background: #103567; max-width: 20%; margin-left: 40%;' class='btn btn-primary btn-block' type='submit' name='enviar'>Enviar Solicitud</button>
                    <a style='background: #103567; max-width: 20%; margin-left: 40%;' class='btn btn-primary btn-block' href='/principal_ong.php'>Cancelar</a>
                </div>
                
                
            </form>
        </div>
    </div>
    <script src="assetsSubirActividades/js/jquery.min.js"></script>
    <script src="assetsSubirActividades/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
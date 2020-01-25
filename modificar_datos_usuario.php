<?php
    include_once ('session.php');
    include_once ('../../database_conn.php');

    if(!isset($_SESSION['user'])) {
        header('location : login.php');
      } 
    
    if($_SESSION['user']['categoryName'] == 'ONG') {
        header('location : modificar_datos_ong.php');
    }

    $conexion = conexion();
    
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>AccionSocialMed</title>
    <link rel="stylesheet" href="assetsmodificardatosusuario/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assetsmodificardatosusuario/css/Navegacin-APS.css">
    <link rel="stylesheet" href="assetsmodificardatosusuario/css/styles.css">
</head>

<body>
    <?php include "_navbar.php"; ?>
    <div style="padding: 100;"><label></label></div>
    <div class="container">
        <div class="row">
            
            <div class="col-md-4 text-center">
            <?php
                $query = "select * from UMA where email='".$_SESSION['user']['userEmail']."'";

                if ($resultado = mysqli_query($conexion, $query)) {
                    $datos = mysqli_fetch_assoc($resultado);

                    //Mando el forma a el script para que el se haga cargo de todo lo de modificar la bbdd :)

                    echo "<form method='POST' id ='formulario' enctype='multipart/form-data' action='scripts/modificar_datos_usuario_script.php'> ";
                        
                        echo "<input type='hidden' name='usuario' value='".$_SESSION['user']['userEmail']."'>";

                        echo "<div class='form-group'>
                                <img src='data:image/jpg; base64, " . base64_encode ($datos['picture'])."' style='width: 250px;height: 250px;'>
                            </div>";

                        echo "<div class='form-group'>
                                <input type='file'accept='image/*' name='archivo' style='margin: 6px;width: 310px;'>
                            </div>";

            echo "</div>";

            echo "<div class='col-md-4 text-left'>";

                        echo "<div class='form-group'>
                                <label>Nombre:</label>
                                <input class='form-control' type='text' name='nombre' id='nombre' value='".$datos['nombre']."' disabled>
                            </div>";
                        echo "<div class='form-group'>
                                <label>Apellidos</label>
                                <input class='form-control' type='text' name='apellidos' id='apellidos' value='".$datos['apellido1']." ".$datos['apellido2']."' disabled>
                            </div>";

                        echo "<div class='form-group'>
                            <label>DNI:</label>
                            <input class='form-control' type='text' name='dni' id='dni' value='" . $datos['DNI'] . "' >
                        </div>";

                        echo "<div class='form-group'>
                                <label>Facultad:</label>
                                <input class='form-control' type='text' name='facultad' id='facultad' value='".$datos['facultad']."' >
                            </div>";

                        echo "<div class='form-group'>
                                        <label>Correo Electrónico</label>
                                        <input class='form-control' type='text' name='email' id='email' value='" . $datos['email'] . "' disabled>
                                    </div>";
                        echo "<div class='form-group'>
                                        <label>Dirección:</label>
                                        <input class='form-control' type='text' name='ubicacion' id='ubicacion' value='" . $datos['direccion'] . "'>
                                    </div>";
                        echo "<div class='form-group'>
                                        <label>Número de Teléfono:</label>
                                        <input class='form-control' type='text' name='telefono' id='telefono' value='" . $datos['telefono'] . "'>
                                    </div>";                

                            
                            echo "</div>"; 
                        
                
                echo "<div class='col-md-4'>";
                        echo "<div class='form-group'>
                                <label>Asignaturas:</label><br>";
                        $resultado = $_SESSION['user']['courses'];
                        for ($i = 0, $size = count($resultado); $i < $size; ++$i) {
                            echo " - ".$resultado[$i]['name'] . "<br>";
                        }
                        echo "</div>";

                        echo "<label>Ambito:</label>";
                        $query_nombre = "select * from Habilidades where Tipo = false";
                        $res_nombre = mysqli_query($conexion, $query_nombre);
                        while ($data = mysqli_fetch_assoc($res_nombre)) {
                            $colAmbito = $data['Nombre'];
                            $query_seleccionar = "select alumno from Alumno_Habilidad where alumno = '" . $_SESSION['user']['userEmail'] . "' and habilidad = '" . $colAmbito . "'";

                            $resultado = mysqli_query($conexion, $query_seleccionar);
                            if ($resultado->num_rows != 0) {
                                echo "<div class='form-check' style='margin: 3px;''>
                                                    <input name='ambitos[]' class='form-check-input' type='checkbox' id='formCheck' value='" . $colAmbito . "'checked>
                                                    <label class='form-check-label' for='formCheck'>" . $colAmbito . "</label>
                                                </div>";
                            } else {
                                echo "<div class='form-check' style='margin: 3px;''>
                                                    <input name='ambitos[]' class='form-check-input' type='checkbox' id='formCheck' value='" . $colAmbito . "'>
                                                    <label class='form-check-label' for='formCheck'>" . $colAmbito . "</label>
                                                </div>";
                            }
                        }
                       

                            echo "<label>Preferencias:</label>";
                            $contTipos = 0;
                            $cols = [];

                            $query_nombre = "select * from Habilidades where Tipo = true";
                            $res_nombre = mysqli_query($conexion, $query_nombre);
                            while($data = mysqli_fetch_assoc($res_nombre)){
                                $colTipo = $data['Nombre'];
                                $colsTipo[$contTipos] = $colTipo;
                                $posTipo = "cbox".$contTipos;
                                $query_seleccionar = "select alumno from Alumno_Habilidad where alumno = '".$_SESSION['user']['userEmail']."' and habilidad = '".$colTipo."'";
                                
                                $resultado = mysqli_query($conexion, $query_seleccionar);
                                if ($resultado->num_rows != 0) {
                                    echo "<div class='form-check' style='margin: 3px;''>
                                        <input name='tipos[]' class='form-check-input' type='checkbox' id='formCheck' value='".$colTipo."' checked>
                                        <label class='form-check-label' for='formCheck'>".$colTipo."</label>
                                    </div>";
                                } else {
                                    echo "<div class='form-check' style='margin: 3px;''>
                                        <input name='tipos[]' class='form-check-input' type='checkbox' id='formCheck' value='".$colTipo."'>
                                        <label class='form-check-label' for='formCheck'>".$colTipo."</label>
                                    </div>";
                                }
                                $contTipos++;
                            }
                        
                        echo "<div class='form-group'>
                                <label></label>
                                <button style='background: #103567; border: none;' class='btn btn-primary btn-block' id='submit' name='submit' type='submit'>Guardar</button>
                            </div>
                        </div>";
                    echo "</form>";
                } 

                
                
            ?>
        </div>
    </div>
    <script src="assetsmodificardatosusuario/js/jquery.min.js"></script>
    <script src="assetsmodificardatosusuario/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
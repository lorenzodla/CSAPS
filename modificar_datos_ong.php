<?php
    include_once ('session.php');
    include_once ('../../database_conn.php');

    if(!isset($_SESSION['user'])) {
        header('location : login.php');
      } 
    
      if($_SESSION['user']['categoryName'] != 'ONG') {
          header('location : perfil.php');
      }
      

    if (isset($_POST['submit'])) {
        $conexion = conexion();

        ///////////
        $file = $_FILES['archivo']['tmp_name'];
        $filename = $_FILES['archivo']['name'];
        //parse Binary
        
        ///// Me refiero como $file

        if ($file != NULL) {
            $file=mysqli_real_escape_string($conexion, file_get_contents($_FILES['archivo']['tmp_name']));
            $query = "update ONG set name='".$_POST['nombre']."', password='".$_POST['password']."', description='".$_POST['descripcion']."', ubication='".$_POST['ubicacion']."', website='".$_POST['contacto']."', picture='".$file."' where email='".$_SESSION['user']['userEmail']."'";
        } else {
            $query = "update ONG set name='".$_POST['nombre']."', password='".$_POST['password']."', description='".$_POST['descripcion']."', ubication='".$_POST['ubicacion']."', website='".$_POST['contacto']."' where email='".$_SESSION['user']['userEmail']."'";
        }

        //INTENTO PEDRO
        //$foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));
        //$foto = base64_encode($foto);
        //////



        mysqli_query($conexion, $query);
        header('location: principal_ong.php');
    }
?>



<!DOCTYPE html>
<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>AccionSocialMed</title>
    <link rel="stylesheet" href="assetsModificarDatosONG/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assetsModificarDatosONG/css/Custom-File-Upload.css">
    <link rel="stylesheet" href="assetsModificarDatosONG/css/Navegacin-APS.css">
    <link rel="stylesheet" href="assetsModificarDatosONG/css/styles.css">

</head>

<body>
    <?php include '_navbar.php'; ?>
    <div style="padding: 100;"><label></label></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-center">

            <?php

                $conexion = conexion();

                $query = "select name, email, password, description, ubication, website, picture from ONG where email='".$_SESSION['user']['userEmail']."'";



                if ($resultado = mysqli_query($conexion, $query)) {
                    $datos = mysqli_fetch_assoc($resultado);
                    echo "<form method='post' id ='formulario' enctype='multipart/form-data'> ";
                    echo "<div class='form-group'>
                            <img src='data:image/jpg; base64, " . base64_encode ($datos['picture'])."' style='width: 250px;height: 250px;' >
                          </div>";
                    echo "<div class='form-group'>
                            <input type='file'accept='image/*' name='archivo' style='margin: 6px;width: 310px;'>
                          </div>";
                    echo "</div>";
                    echo "<div class='col-md-4'>";
                    echo "<div class='form-group'>
                            <label>Correo Electrónico</label>
                            <input class='form-control' type='text' id='email' name='email'value='".$datos['email']."' disabled>
                          </div>";
                    echo "<div class='form-group'>
                            <label>Nombre:</label>
                            <input class='form-control' type='text' id='nombre' name='nombre'value='".$datos['name']."'>
                          </div>";
                    echo "<div class='form-group'>
                            <label>Contraseña:</label>
                              <input class='form-control' type='password' id='password' name='password' value='".$datos['password']."'>
                          </div>";
                    echo "<div class='form-group'>
                            <label>Ubicación:</label>
                            <input class='form-control' type='text' id='ubicacion' name='ubicacion'value='" . $datos['ubication'] . "'>
                          </div>";

                    echo "<div class='form-group'>
                            <label>Contacto:</label>
                            <input class='form-control' type='text' id='contacto' name='contacto'value='" . $datos['website'] . "'>
                          </div>";

                    echo "</div>";
                    echo "<div class='col-md-4'>";
                    echo "<div class='form-group' style='height: 100%;'>
                            <label>Descripción:</label>
                            <textarea style='height: 90%; resize: none;'class='form-control' id='descripcion' name='descripcion'>" . $datos['description'] . "</textarea>
                          </div>";

                    
                   
                } else {
                    echo "error en la consulta";
                }
            ?>
              </div>
              <button class="btn btn-primary btn-block" style="margin-left: 34%; width: 66%;background-color: #103567; border: none" type="submit" name="submit">Guardar</button>
              </form>
        </div>
    </div>
    <script src="assetsModificarDatosONG/js/jquery.min.js"></script>
    <script src="assetsModificarDatosONG/bootstrap/js/bootstrap.min.js"></script>
    <script src="assetsModificarDatosONG/js/Custom-File-Upload.js"></script>
</body>

</html>

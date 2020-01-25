<?php
    include_once 'session.php';
    include_once '../../database_conn.php';

    if(!isset($_SESSION['user'])) {
        header('location : login.php');
    } 

    if(!$esGestor) {
        header('location : perfil.php');
    }

    if (isset($_POST['submit'])) {
        $conexion = conexion();
        if ($_POST['seleccionarTipo'] == 'Ong') {
            $query = "insert into ONG (email, password, name) values ('".$_POST['email']."', '".$_POST['password']."', '".$_POST['name']."')";
        } else {
            $query = "insert into Gestores (email) values ('".$_POST['email']."')";

        }
        mysqli_query($conexion, $query);

         echo "<script type='text/javascript'>
                alert('La organizacion se ha registrado con exito a la lista de organizaciones colaboradoras');
                window.location.replace('http://csaps.alphaduck.software/registro.php');
              </script>";
    }
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>AccionSocialMed</title>
    <link rel="stylesheet" href="assetsRegistro/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assetsRegistro/css/Navegacin-APS.css">
    <link rel="stylesheet" href="assetsRegistro/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assetsRegistro/css/styles.css">
</head>

<body>
    <?php include "_navbar.php"; ?>
    <div class="register-photo">
        <div class="form-container">
            <form method="post" id ="formulario">
                <h2 class="text-center">Registrar una nueva cuenta.</h2>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-6">
                            <div class="form-check text-center">
                                <input class="form-check-input" type="radio" id="gestorButton" name="seleccionarTipo" value="Gestor">
                                <label class="form-check-label" for="formCheck-1">Gestor</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-check text-center">
                                <input class="form-check-input" type="radio" id="ongButton" name="seleccionarTipo" value="Ong">
                                <label class="form-check-label" for="formCheck-2" checked>Organizacion</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" id="name" name="name" placeholder="Nombre" required>
                </div>
                <div class="form-group">
                    <input class="form-control" type="email" id="email" name="email" placeholder="Email" required>
                </div>
                <input class="form-control" type="password" id="password" name="password" placeholder="Contraseña" required>
                <div class="form-group"><button style="background-color: #103567"class="btn btn-primary btn-block" type="submit" name="submit">Registrar</button></div>
                </form>
        </div>
    </div>
    <div></div>
    <script src="assetsRegistro/js/jquery.min.js"></script>
    <script src="assetsRegistro/bootstrap/js/bootstrap.min.js"></script>


    <script>
        document.getElementById("gestorButton")
		        .addEventListener("click", function() {
		  document.getElementById("name").hidden = true;
		  document.getElementById("password").hidden = true;
          document.getElementById("name").required = false;
		  document.getElementById("password").required = false;
		}, false);

		document.getElementById("ongButton")
		        .addEventListener("click", function() {
		  document.getElementById("name").hidden = false;
		  document.getElementById("password").hidden = false;
          document.getElementById("name").required = true;
		  document.getElementById("password").required = true;
		}, false);

    </script>
</body>

</html>

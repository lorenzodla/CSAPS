<?php
	include_once 'session.php';
	include_once 'auth.php';

    if(isset($_SESSION['user'])){
	    header('location: index.php');
    }


    $error = 0;
    if (isset($_POST['submit'])) {

	    $datos = authenticateONG($_POST['email'], $_POST['password']);

	    if($datos['email'] == NULL){
		    $error = 1;
	    }else{
		    $_SESSION['user']['userEmail'] = $datos['email'];
	        $_SESSION['user']['categoryName'] = "ONG";
	        $_SESSION['user']['nombre'] = $datos['name'];

	        if(isFirstLogin($_SESSION['user'])){
		        firstLoginONG($_SESSION['user']['userEmail']);
		        header('location: perfil.php?first=1');
	        }else{
		        header('location: perfil.php');
	        }
	    }

    }
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Iniciar sesión · CSAPS</title>
    <link rel="stylesheet" href="assetsRegistro/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assetsRegistro/css/Navegacin-APS.css">
    <link rel="stylesheet" href="assetsRegistro/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assetsRegistro/css/styles.css">
</head>

<body>
    <?php include "_navbar.php"; ?>
    
    <div class="register-photo">

	    <?php if($error == 1) { ?>
	    <div class="container">
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  <strong>Usuario o contraseña incorrectos</strong> Comprueba tu usuario y contraseña.
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
	    </div>
	    <?php } ?>

        <div class="form-container">
            <form method="post" id ="formulario">
                <h2 class="text-center"><strong>Iniciar sesión</strong></h2>
                <div class="form-group"><input class="form-control" type="email" id="email" name="email" placeholder="Email" required></div>
                <div class="form-group"><input class="form-control" type="password" id="password" name="password" placeholder="Contraseña" required></div>
                <div class="form-group"><button style="background: #103567"class="btn btn-primary btn-block" type="submit" name="submit">Iniciar Sesión</button></div>
            </form>
        </div>
    </div>
    <div></div>
    <script src="assetsRegistro/js/jquery.min.js"></script>
    <script src="assetsRegistro/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>

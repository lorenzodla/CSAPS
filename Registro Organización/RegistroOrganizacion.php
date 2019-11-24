<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>RegistrarGestorOOng</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Navegacin-APS.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md shadow-sm navigation-clean-button">
        <div class="container"><a class="navbar-brand" href="#" style="height: 100px;"><img src="assets/img/Imagen1.png" width="125"></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav mr-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="#">Inicio</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#">Sobre nosotros</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#">FAQ</a></li>
                </ul><span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" href="#">Iniciar sesión</a></span></div>
        </div>
    </nav>
    <div class="register-photo">
        <div class="form-container">
            <form method="post">
                <h2 class="text-center"><strong>Create</strong> an account.</h2>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-6">
                            <div class="form-check text-center"><input class="form-check-input" type="radio" id="radio1" name="seleccionarTipo" value="option1"><label class="form-check-label" for="formCheck-1">Gestor</label></div>
                        </div>
                        <div class="col-6">
                            <div class="form-check text-center"><input class="form-check-input" type="radio" id="radio2" name="seleccionarTipo" value="option2"><label class="form-check-label" for="formCheck-2">ONG</label></div>
                        </div>
                    </div>
                </div>
                <div class="form-group"><input class="form-control" type="email" name="name" placeholder="Name"></div>
                <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"></div><input class="form-control" type="password" name="password" placeholder="Initial password">
                <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Sign Up</button></div><a class="already" href="#">You already have an account? Login here.</a></form>
        </div>
    </div>
    <div></div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
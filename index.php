<?php
include_once 'session.php';
include_once '../../database_conn.php';
$conexion = conexion();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>AccionSocialMed</title>
    <link rel="stylesheet" href="assetsIndex/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abel">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abhaya+Libre">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Actor">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Advent+Pro">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alef">
    <link rel="stylesheet" href="assetsIndex/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assetsIndex/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css">
    <link rel="stylesheet" href="assetsIndex/css/Navegacin-APS.css">
    <link rel="stylesheet" href="assetsIndex/css/Simple-Slider.css">
    <link rel="stylesheet" href="assetsIndex/css/styles.css">

    <style>
        @keyframes jump {
            0% {
                transform: translate3d(0, 0, 0) scale3d(1, 1, 1);
            }

            40% {
                transform: translate3d(0, 30%, 0) scale3d(1, 1, 1);
            }

            100% {
                transform: translate3d(0, 100%, 0) scale3d(1, 1, 1);
            }
        }

        .jump {
            transform-origin: 50% 50%;
            animation: jump .5s linear alternate infinite;
        }

        .colaborador {
            width: 128px;
            height: 128px;
            margin-left: 30px;
        }
    </style>
</head>

<body>
    <?php include "_navbar.php"; ?>

    <div class="container">
        <div class="carousel slide" data-ride="carousel" id="carousel-1" style="margin-top: 10px; width: 100%;">
            <div class="carousel-inner" role="listbox" style="width: 100%;">
                <div class="carousel-item active">
                    <div class="jumbotron hero-nature carousel-hero" style="width: 100%;background-position: 100%;background-size: cover;background-image: url(https://images.pexels.com/photos/242236/pexels-photo-242236.jpeg?cs=srgb&dl=aspero-blanco-cemento-fondo-242236.jpg&fm=jpg);padding: 100px 0px;height: 350px;">
                        <h1 id="clock" class="text-center hero-title"></h1>
                        <h1 class="text-center hero-title" style="margin-left: 10px;">Inauguración de la Plataforma</h1>
                        <p class="text-center hero-subtitle" style="margin-left: 10px;">
                            Bienvenido a AccionSocialMed.</br>
                            Actualmente la plataforma se encuentra en construcción pero puedes ir familiarizandote con ella.</br>
                            ¡Podrás disfrutar de todas sus ventajas cuando el reloj llegue a 0!
                        </p>
                    </div>
                </div>
                <?php
                $query = "SELECT title,cuerpo FROM Noticias";
                $resultados = mysqli_query($conexion, $query);
                while ($rows = mysqli_fetch_assoc($resultados)) {
                    echo "<div class='carousel-item'>
	                    	<div class='jumbotron hero-photography carousel-hero' style='color: white; width: 100%;background-position: 100%;background-size: cover;background-image: url(https://images.pexels.com/photos/518543/pexels-photo-518543.jpeg?cs=srgb&dl=anuncios-apretar-comercio-518543.jpg&fm=jpg);padding: 100px 0px;height: 350px;'>
	                            <h1 class='text-center hero-title'>" . $rows['title'] . "</h1>
	                            <p class='text-center hero-subtitle'>" . $rows['cuerpo'] . "</p>
	                    </div>
	                </div>";
                }

                ?>
            </div>

            <div>
                <a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev">
                    <i class="fa fa-chevron-left">
                    </i><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carousel-1" role="button" data-slide="next">
                    <i class="fa fa-chevron-right"></i><span class="sr-only">Next</span></a></div>
            <ol class="carousel-indicators" style="margin: 0px 0px 0px;">
                <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-1" data-slide-to="1"></li>
                <li data-target="#carousel-1" data-slide-to="2"></li>
            </ol>
        </div>
    </div>

    <div id="About">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <div class="container text-center">
                    <div class="text-center intro" style="width: 607px;">
                        <h2 class="text-center" style="color: #103567;">Plataforma Cs-ApS</h2>
                        <hr style="height: 2px;color: #103567;background-color: #103567;">
                        <p class="text-center" style="color: #103567;width: 610px;"><br><br> La plataforma Cs-ApS es la herramienta que la Universidad de Málaga usa para gestionar sus recursos de prácticas. <br>Desde esta plataforma, <strong>totalmente gratuita</strong>, ONGs y alumnos pueden registrarse para
                            participar en voluntariado o actividades de aprendizaje y servicio. <br><br> Nuestro objetivo es intermediar satisfactoriamente entre lo <br>que las ONGs demandan y la formación y experiencia de nuestros <br>alumnos y titulados,
                            con la idea de mejorar su Curriculum.<br> <br><br></p>
                        <div class="row" style="width: 653px;height: 45px;"></div>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>

    <div class="container">
        <h2 class="text-center" style="color: #103567;margin-bottom: 20px;">CON QUIÉN COLABORAMOS</h2>
        <div class="row" style=" width: 100%; display: flex; justify-items: center;">
            <img class="colaborador" src="https://www.uco.es/investigacion/proyectos/SEBASENet/images/Logo_UMA.png" alt="Universidad de Malaga">
            <img class="colaborador" src="https://www.elvagon.org.uy/wp-content/uploads/2015/10/favicon.png" alt="Por los Niños Urugyayos">
            <img class="colaborador" src="https://media-exp1.licdn.com/dms/image/C4E0BAQHnjfXsqJVOxQ/company-logo_200_200/0?e=2159024400&v=beta&t=tsDR8Lez_W3cAJnNfg7pJyrm7I7LDcfS35B0XEfd77c" alt="Manos Unidas">
            <img class="colaborador" src="https://www.plataformaong.org/imagenes/mision_1@2x.png" alt="Manos Unidas">
            <img class="colaborador" src="https://www.fundacionlealtad.org/wp-content/uploads/sites/2/WordPressImg_364.png" alt="Manos Unidas">
            <img class="colaborador" src="https://caritas-web.s3.amazonaws.com/main-files/uploads/2018/12/logo_2x_caritas.png" alt="Manos Unidas">
            <img class="colaborador" src="https://www.edu.xunta.gal/portal/sites/web/files/styles/thumbnail_medium/public/content_type/learningobject/2016/01/21/3a206e1baf13fe85b41209fb3b61d9f8.jpeg?itok=UHDxdINr" alt="Manos Unidas">
        </div>
    </div>

    <div class="row" style="background-color: #ffffff;height: 5%;width: 100vw;">
        <div class="col" style="height: 5%;background-color: #103567;">
            <h1 style="height: 5%;background-color: #103567;"></h1>
        </div>
    </div>

    <footer>
        <div class="row" style="padding-bottom: 20px;">
            <div class="col" style="margin: auto; display:flex; flex-direction: row; margin-left: 10px;">
                <h6 style="margin-top: 1%;"><a href='https://alphaduck.software'>Powered by Alphaduck Software &copy;2020</a></h6>
                <img style="margin-left: 10px;" class="jump" src="https://cdn.cyberduck.io/img/cyberduck-icon-384.png" height="20px" width="20px">
            </div>
            
        </div>

    </footer>

    <!--Clock Script-->
    <script>
        // Set the date we're counting down to
        var countDownDate = new Date("Jan 24, 2020 10:30:00").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("clock").innerHTML = days + "d " + hours + "h " +
                minutes + "m " + seconds + "s ";
        }, 1000);
    </script>

    <script src="assetsIndex/js/jquery.min.js"></script>
    <script src="assetsIndex/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
    <script src="assetsIndex/js/Simple-Slider.js"></script>
</body>

</html>
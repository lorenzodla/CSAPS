<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>AccionSocialMed</title>
    <link rel="stylesheet" href="assetsContact/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assetsContact/css/styles.min.css">

    <!-- Left nav bar -->
    <link rel="stylesheet" href="assetsFAQ/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assetsFAQ/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assetsFAQ/css/Footer-Dark.css">
    <link rel="stylesheet" href="assetsFAQ/css/Navegacin-APS.css">
    <link rel="stylesheet" href="assetsFAQ/css/Search-Input-responsive.css">
    <link rel="stylesheet" href="assetsFAQ/css/Sidebar-1.css">
    <link rel="stylesheet" href="assetsFAQ/css/Sidebar-Menu-1.css">
    <link rel="stylesheet" href="assetsFAQ/css/Sidebar-Menu.css">
    <link rel="stylesheet" href="assetsFAQ/css/Sidebar.css">
    <link rel="stylesheet" href="assetsFAQ/css/simple-footer.css">
    <link rel="stylesheet" href="assetsFAQ/css/styles.css">

    <style media="screen">
      .successEmail{
        width: 100%;
        border-radius: 7px;
        border: solid 1px #103567;
        background-color: #103567;
        color: white;
      }
    </style>
    <?php
      function sendMail($email,$nombre,$asunto,$body){

        $headers = "From:".$nombre." <".$email.">\r\n";

        mail('alphaduck@alphaduck.software',$asunto,$body,$headers);

        echo "<p class='successEmail'> Gracias por ponerte en contacto con AccionSocialMed. En la máxima brevedad posible alguien revisará
                  tu mensaje y responderá tus dudas.</p>";
      }
     ?>

</head>

<body>
	
    <?php include "_navbar.php"; ?>

    <div>
        <!-- Barra de navegación Izquierda -->
        <div id="wrapper">
            <div class="shadow-sm" id="sidebar-wrapper" style="width: 15%;background-color: transparent;">
                <ul class="sidebar-nav">
                    <li style="margin-top: 15%;">
                      <a class="border rounded shadow-sm" href="/faq.php" style="color: #103567;">Preguntas Comunes</a>
                    </li>
                    <li>
                      <a class="border rounded shadow-sm" href="" style="color: #103567;">Contacta</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Contenedor Central -->
        <div class="container" style="margin-left: 15%;">
            <div class="col-xl-8">
                <div class="row">
                    <div class="col-md-4 col-lg-10 col-xl-12 text-center">
                        <div class="row">
                            <div class="col">
                                  <div class="form-container" style="padding-top: 20px">
                                    <?php
                                        echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
                                     ?>
                                          <h2 class="text-center" style="color: #103567;"><strong>Contacta Con AccionSocialMed</strong></h2>
                                          <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email" required></div>
                                          <div class="form-group"><input class="form-control" type="text" name="nombre" placeholder="Nombre"></div>
                                          <div class="form-group"><input class="form-control" type="text" name="asunto" placeholder="Asunto"></div>
                                          <div class="form-group"><textarea style="height: 160px; resize: none" class="form-control" name="body" placeholder="¿Que te gustaría preguntar?"required></textarea></div>
                                          <div class="form-group">
                                            <button class="btn btn-primary btn-block border rounded" type="submit" style="background-color: #103567;">Enviar</button>
                                          </div>
                                      </form>

                                      <?php
                                        $email = $_POST['email'];
                                        $nombre = $_POST['nombre'];
                                        $asunto = $_POST['asunto'];
                                        $body = $_POST['body'];

                                        if(isset($_POST['email'])){
                                          sendMail($email,$nombre,$asunto,$body);
                                        }
                                       ?>
                                  </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>


    </div>

  </div>

    <script src="assetsContact/js/jquery.min.js"></script>
    <script src="assetsContact/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>

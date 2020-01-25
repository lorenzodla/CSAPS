<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>FAQ</title>
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

    <!-- Script de Búsqueda -->
    <?php
      function Search($input){
        require('../../database_conn.php');

        $conexion = conexion();

        $query = "SELECT * FROM FAQ";

        if($input != NULL){
          $query = "SELECT *
                    FROM FAQ
                    WHERE Head LIKE '%".$input."%' or
                          Body LIKE '%".$input."%'";
        }


        $resultados = mysqli_query($conexion,$query);

        $count = mysqli_num_rows($resultados);

        if($count > 0){
          while($rows = mysqli_fetch_assoc($resultados)){
            echo "<div class='row' style='margin-top: 1%;'>
                <div class='col'>
                    <h1 class='text-left'>".$rows['Head']."</h1>
                    <p class='text-justify'>".$rows['Body']."</p>
                </div>
            </div>";
          }
        }else{
          echo "<div class='row' style='margin-top: 1%;'>
                  <div class='col'>
                    <h1 class='text-left'>No se encontraron resultados</h1>
                    <p class='text-justify'>#Consejo: Cuantas menos palabras busques mejor.</p>
                  </div>
                </div>";
        }

      }
     ?>

    <!-- Listener de retorno de carro para la barrita de búsqueda -->
     <script>
        function pressed(e) {
            // Has the enter key been pressed?
            if ( (window.event ? event.keyCode : e.which) == 13) {
                // If it has been so, manually submit the <form>
                document.forms[0].submit();
            }
        }
        </script>

</head>

<body>
    <!-- Barra de navegación -->
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
                      <a class="border rounded shadow-sm" href="/contact.php" style="color: #103567;">Contacta</a>
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
                                <h1 class="text-left" style="color: #103567;padding-top: 20px;padding-bottom: 20px;">FAQ-Preguntas Frecuentes</h1>
                            </div>
                        </div>

                        <div class="row" style = "margin-bottom: 10%;">
                            <div class="col">
                                <div class="d-table mt-5 mt-md-0 search-area" style="width: 500px;">
                                  <i class="fas fa-search float-left search-icon"></i>
                                  <?php
                                    $input = $_GET['input'];
                                    $direccion = $_SERVER['PHP_SELF'];

                                    echo "<form action='$direccion' method='get'>
                                            <input onkeydown='pressed(event)' class='float-left float-sm-right custom-search-input' type='search' name='input' placeholder='Buscar un Tema Concreto' style='width: 100%;'>
                                          </form>";

                                   ?>
                                </div>

                            </div>
                        </div>

                        <?php
                          Search($input);
                         ?>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="assetsFAQ/js/jquery.min.js"></script>
    <script src="assetsFAQ/bootstrap/js/bootstrap.min.js"></script>
    <script src="assetsFAQ/js/Sidebar-Menu.js"></script>
</body>

</html>

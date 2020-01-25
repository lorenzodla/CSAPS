<?php
  include_once 'session.php';
  include_once '../../database_conn.php';

  if(!isset($_SESSION['user'])) {
    header('location : login.php');
  } 

  if(!$esGestor) {
      header('location : perfil.php');
  }

  $conexion = conexion();

 ?>

 <!DOCTYPE html>
 <html lang="es" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>AccionSocialMed</title>
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
       .deleteButton, .editButton{
         border: none;
         color: #56c6c6;
         text-decoration: underline;
       }
     </style>
   </head>

   <body>
      <?php
        include '_navbar.php';
       ?>

         <div class="container" style="margin-left: 15%;">
             <div class="col-xl-8">
                 <div class="row">
                     <div class="col-md-4 col-lg-10 col-xl-12 text-center">
                         <div class="row">
                             <div class="col">
                                 <h1 class="text-left" style="color: #56c6c6;padding-top: 20px;padding-bottom: 20px;">Noticias</h1>
                             </div>
                         </div>

                         <form action="editar_noticia.php" method="get">
                           <button style="background-color: #56c6c6; border: none" class = "btn btn-primary btn-block" type="submit">Añadir Nueva Noticia</button>
                         </form>

                         <?php
                          $query = "SELECT title, cuerpo, fecha, escritor, ID FROM Noticias";
                          $resultados = mysqli_query($conexion,$query);
                          while($rows = mysqli_fetch_assoc($resultados)){
                          echo "<div class='col' style='margin-top: 20px; border: 1px solid #56c6c6; border-radius: 10px;'>
                                <p style='font-size: 20px;font-weight: bold;' class='text-left'>".$rows['title']."</p>
                                <p class='text-left'>".$rows['cuerpo']."</p>
                                <p class='text-left'>Fecha: ".$rows['fecha']."</p>
                                <p class='text-left'>autor: ".$rows['escritor']."</p>
                                <div class='row' style='margin-left: 1px'>
                                  <form action='delete_news.php?id=".$rows['ID']."' method='post'>
                                    <button class='deleteButton' type='submit'>Eliminar</button>
                                  </form>
                                  <form action='editar_noticia.php?id=".$rows['ID']."' method='post'>
                                    <button class='editButton' type='submit'>Editar</button>
                                  </form>
                                </div>
                            </div>";
                          }
                          ?>


                     </div>
                 </div>
             </div>
         </div>

       <script src="assetsIndex/js/jquery.min.js"></script>
       <script src="assetsIndex/bootstrap/js/bootstrap.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
       <script src="assetsIndex/js/Simple-Slider.js"></script>
   </body>
 </html>

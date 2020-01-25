<?php
  include_once 'session.php';
  include_once '../../database_conn.php';
  

  if(!isset($_SESSION['user'])) {
    header('location : login.php');
  } 

  if(!$esGestor) {
      header('location : perfil.php');
  } else {
    $conexion = conexion();
    $query = "DELETE FROM Noticias WHERE ID = ".$_GET['id'];
    mysqli_query($conexion, $query);
    header('location: gestion_noticias.php');
  }
 ?>

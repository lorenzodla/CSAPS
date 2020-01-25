<?php
include_once('../../../database_conn.php');

$conexion = conexion();
$actividad = $_GET['actividad'];
$likes = $_GET['estrellas'];
$alumno = $_GET['alumno'];

$query = "INSERT INTO Valoraciones_AUX (alumno, Actividad, Likes) VALUES ('$alumno', '$actividad', '$likes')";
mysqli_query($conexion,$query);


header("location:../valorar_act_completa_al.php");

?>
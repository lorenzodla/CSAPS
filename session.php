<?php

include_once '../../database_conn.php';	

session_start();

if(isset($_SESSION['user'])){
	
	$conn = conexion();
	$query = "SELECT * FROM Gestores WHERE email = '".$_SESSION['user']['userEmail']."'";
	$resultado = mysqli_query($conn, $query);
	$esGestor = (mysqli_num_rows($resultado) > 0);
	
}

?>
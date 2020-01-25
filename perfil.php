<?php

include_once 'session.php';

include_once ('../../database_conn.php');
$conexion = conexion();

if(!isset($_SESSION['user'])){
	header('location: login.php');
}else{

	if($_SESSION['user']['categoryName'] == 'ONG'){
		if($_GET['first']){
			header('location: modificar_datos_ong.php');
		}else{
			header('location: principal_ong.php');
		}
	}else if($_SESSION['user']['categoryName'] == "PDI"){
		if($_GET['first']){
			header('location: modificar_datos_usuario.php');
		}else{
			header('location: principal_profesor.php'); // cambiar por la principal de usuarios
		}
	}else{
		if($_GET['first']){
			header('location: modificar_datos_usuario.php');
		}else{
			header('location: principal_alumno.php'); // cambiar por la principal de usuarios
		}
	}

}

?>

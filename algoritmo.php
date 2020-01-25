<?php
include_once '../../database_conn.php';
	
function getActividadesFiltro($user){
	$lista = Array();
	
	$conexion = conexion();
	
	$horario_query = "SELECT horario FROM Usuario_Horario WHERE email='".$user."'";
	$horario_result = mysqli_query($conexion, $horario_query);
	$horario = Array();
	
	while($row = mysqli_fetch_assoc($horario_result)){
		$horario[] = $row['horario'];
	}
	
	$habilidades_usuario = "SELECT a.habilidad FROM Alumno_Habilidad as a LEFT JOIN Habilidades as h ON a.habilidad = h.Nombre WHERE a.alumno='".$user."' AND h.Tipo = 1";
	$habilidades_result = mysqli_query($conexion, $habilidades_usuario);
	$habilidades_tipo = Array();
	
	while($row = mysqli_fetch_assoc($habilidades_result)){
		$habilidades_tipo[] = $row;
	}
	
	$habilidades_usuario = "SELECT a.habilidad FROM Alumno_Habilidad as a LEFT JOIN Habilidades as h ON a.habilidad = h.Nombre WHERE a.alumno='".$user."' AND h.Tipo = 0";
	$habilidades_result = mysqli_query($conexion, $habilidades_usuario);
	$habilidades_ambito = Array();
	
	while($row = mysqli_fetch_assoc($habilidades_result)){
		$habilidades_ambito[] = $row;
	}
	
	
	// ACTIVIDADES QUE COINICDEN EN HORARIO, UN TIPO Y UN ÝMBITO
	
	$query = "SELECT DISTINCT a.ID, a.Titulo, a.tipo FROM Actividad AS a LEFT JOIN Actividad_Habilidad as h ON a.id = h.actividad WHERE a.aceptada = 1";
	
	for($i = 0; $i<count($horario); $i++){
		if($i == 0){
			if($i == count($horario)-1){
				$query = $query." AND (a.horario = '".$horario[$i]."')";
			}else{
				$query = $query." AND (a.horario = '".$horario[$i]."'";
			}
		}else{
			if($i == count($horario)-1){
				$query = $query." OR a.horario = '".$horario[$i]."')";
			}else{
				$query = $query." OR a.horario = '".$horario[$i]."'";
			}
			
		}
	}
	
	for($i = 0; $i<count($habilidades_tipo); $i++){
		if($i == 0){
			if($i == count($habilidades_tipo)-1){
				$query = $query." AND (h.habilidad = '".$habilidades_tipo[$i]['habilidad']."')";
			}else{
				$query = $query." AND (h.habilidad = '".$habilidades_tipo[$i]['habilidad']."'";
			}
		}else{
			if($i == count($habilidades_tipo)-1){
				$query = $query." OR h.habilidad = '".$habilidades_tipo[$i]['habilidad']."')";
			}else{
				$query = $query." OR h.habilidad = '".$habilidades_tipo[$i]['habilidad']."'";
			}
			
		}
	}
	
	for($i = 0; $i<count($habilidades_ambito); $i++){
		if($i == 0){
			if($i == count($habilidades_ambito)-1){
				$query = $query." AND (h.habilidad = '".$habilidades_ambito[$i]['habilidad']."')";
			}else{
				$query = $query." AND (h.habilidad = '".$habilidades_ambito[$i]['habilidad']."'";
			}
		}else{
			if($i == count($habilidades_ambito)-1){
				$query = $query." OR h.habilidad = '".$habilidades_ambito[$i]['habilidad']."')";
			}else{
				$query = $query." OR h.habilidad = '".$habilidades_ambito[$i]['habilidad']."'";
			}
			
		}
	}
	
	$result = mysqli_query($conexion, $query);
	$actividades = Array();
	
	
	if(mysqli_num_rows($result)!=0){
		while($row = mysqli_fetch_assoc($result)){
			$lista[] = $row;
		}
	}
	
	
	// ACTIVIDADES QUE COINICDEN EN HORARIO Y UN TIPO
	
	$query = "SELECT DISTINCT a.ID, a.Titulo, a.tipo FROM Actividad AS a LEFT JOIN Actividad_Habilidad as h ON a.id = h.actividad WHERE a.aceptada = 1";
	
	for($i = 0; $i<count($horario); $i++){
		if($i == 0){
			if($i == count($horario)-1){
				$query = $query." AND (a.horario = '".$horario[$i]."')";
			}else{
				$query = $query." AND (a.horario = '".$horario[$i]."'";
			}
		}else{
			if($i == count($horario)-1){
				$query = $query." OR a.horario = '".$horario[$i]."')";
			}else{
				$query = $query." OR a.horario = '".$horario[$i]."'";
			}
			
		}
	}
	
	for($i = 0; $i<count($habilidades_tipo); $i++){
		if($i == 0){
			if($i == count($habilidades_tipo)-1){
				$query = $query." AND (h.habilidad = '".$habilidades_tipo[$i]['habilidad']."')";
			}else{
				$query = $query." AND (h.habilidad = '".$habilidades_tipo[$i]['habilidad']."'";
			}
		}else{
			if($i == count($habilidades_tipo)-1){
				$query = $query." OR h.habilidad = '".$habilidades_tipo[$i]['habilidad']."')";
			}else{
				$query = $query." OR h.habilidad = '".$habilidades_tipo[$i]['habilidad']."'";
			}
			
		}
	}
	
	$result = mysqli_query($conexion, $query);
	$actividades = Array();
	
	
	if(mysqli_num_rows($result)!=0){
		while($row = mysqli_fetch_assoc($result)){
			$lista[] = $row;
		}
	}
	
	// ACTIVIDADES QUE COINICDEN EN HORARIO Y UN ÝMBITO
	
	$query = "SELECT DISTINCT a.ID, a.Titulo, a.tipo FROM Actividad AS a LEFT JOIN Actividad_Habilidad as h ON a.id = h.actividad WHERE a.aceptada = 1";
	
	for($i = 0; $i<count($horario); $i++){
		if($i == 0){
			if($i == count($horario)-1){
				$query = $query." AND (a.horario = '".$horario[$i]."')";
			}else{
				$query = $query." AND (a.horario = '".$horario[$i]."'";
			}
		}else{
			if($i == count($horario)-1){
				$query = $query." OR a.horario = '".$horario[$i]."')";
			}else{
				$query = $query." OR a.horario = '".$horario[$i]."'";
			}
			
		}
	}
	
	for($i = 0; $i<count($habilidades_ambito); $i++){
		if($i == 0){
			if($i == count($habilidades_ambito)-1){
				$query = $query." AND (h.habilidad = '".$habilidades_ambito[$i]['habilidad']."')";
			}else{
				$query = $query." AND (h.habilidad = '".$habilidades_ambito[$i]['habilidad']."'";
			}
		}else{
			if($i == count($habilidades_ambito)-1){
				$query = $query." OR h.habilidad = '".$habilidades_ambito[$i]['habilidad']."')";
			}else{
				$query = $query." OR h.habilidad = '".$habilidades_ambito[$i]['habilidad']."'";
			}
			
		}
	}
	
	$result = mysqli_query($conexion, $query);
	$actividades = Array();
	
	
	if(mysqli_num_rows($result)!=0){
		while($row = mysqli_fetch_assoc($result)){
			$lista[] = $row;
		}
	}
	

	/*
	if(count($lista)==0){
		echo 'No hay coincidencias.';
	}else{
		foreach($lista as $a){
			echo $a['Titulo']." - ".$a['tipo']." - ".$a['ID'];
		}
	}
	*/

	return $lista;
}
	

/*

if(!isset($_SESSION['user'])){
	echo "Please log in.";
	var_dump($_SESSION['user']);
}else{
	$lista = Array();
	
	
	$conexion = conexion();
	
	$horario_query = "SELECT horario FROM Usuario_Horario WHERE email='".$_SESSION['user']['userEmail']."'";
	$horario_result = mysqli_query($conexion, $horario_query);
	$horario = Array();
	
	while($row = mysqli_fetch_assoc($horario_result)){
		$horario[] = $row['horario'];
	}
	
	$habilidades_usuario = "SELECT a.habilidad FROM Alumno_Habilidad as a LEFT JOIN Habilidades as h ON a.habilidad = h.Nombre WHERE a.alumno='".$_SESSION['user']['userEmail']."' AND h.Tipo = 1";
	$habilidades_result = mysqli_query($conexion, $habilidades_usuario);
	$habilidades_tipo = Array();
	
	while($row = mysqli_fetch_assoc($habilidades_result)){
		$habilidades_tipo[] = $row;
	}
	
	$habilidades_usuario = "SELECT a.habilidad FROM Alumno_Habilidad as a LEFT JOIN Habilidades as h ON a.habilidad = h.Nombre WHERE a.alumno='".$_SESSION['user']['userEmail']."' AND h.Tipo = 0";
	$habilidades_result = mysqli_query($conexion, $habilidades_usuario);
	$habilidades_ambito = Array();
	
	while($row = mysqli_fetch_assoc($habilidades_result)){
		$habilidades_ambito[] = $row;
	}
	
	
	// ACTIVIDADES QUE COINICDEN EN HORARIO, UN TIPO Y UN ÝMBITO
	
	$query = "SELECT DISTINCT a.ID, a.Titulo, a.tipo FROM Actividad AS a LEFT JOIN Actividad_Habilidad as h ON a.id = h.actividad WHERE a.tipo = WHERE tipo <> 'Sin Aceptar'";
	
	for($i = 0; $i<count($horario); $i++){
		if($i == 0){
			if($i == count($horario)-1){
				$query = $query." AND (a.horario = '".$horario[$i]."')";
			}else{
				$query = $query." AND (a.horario = '".$horario[$i]."'";
			}
		}else{
			if($i == count($horario)-1){
				$query = $query." OR a.horario = '".$horario[$i]."')";
			}else{
				$query = $query." OR a.horario = '".$horario[$i]."'";
			}
			
		}
	}
	
	for($i = 0; $i<count($habilidades_tipo); $i++){
		if($i == 0){
			if($i == count($habilidades_tipo)-1){
				$query = $query." AND (h.habilidad = '".$habilidades_tipo[$i]['habilidad']."')";
			}else{
				$query = $query." AND (h.habilidad = '".$habilidades_tipo[$i]['habilidad']."'";
			}
		}else{
			if($i == count($habilidades_tipo)-1){
				$query = $query." OR h.habilidad = '".$habilidades_tipo[$i]['habilidad']."')";
			}else{
				$query = $query." OR h.habilidad = '".$habilidades_tipo[$i]['habilidad']."'";
			}
			
		}
	}
	
	for($i = 0; $i<count($habilidades_ambito); $i++){
		if($i == 0){
			if($i == count($habilidades_ambito)-1){
				$query = $query." AND (h.habilidad = '".$habilidades_ambito[$i]['habilidad']."')";
			}else{
				$query = $query." AND (h.habilidad = '".$habilidades_ambito[$i]['habilidad']."'";
			}
		}else{
			if($i == count($habilidades_ambito)-1){
				$query = $query." OR h.habilidad = '".$habilidades_ambito[$i]['habilidad']."')";
			}else{
				$query = $query." OR h.habilidad = '".$habilidades_ambito[$i]['habilidad']."'";
			}
			
		}
	}
	
	$result = mysqli_query($conexion, $query);
	$actividades = Array();
	
	
	if(mysqli_num_rows($result)!=0){
		while($row = mysqli_fetch_assoc($result)){
			$lista[] = $row;
		}
	}
	
	
	// ACTIVIDADES QUE COINICDEN EN HORARIO Y UN TIPO
	
	$query = "SELECT DISTINCT a.ID, a.Titulo FROM Actividad AS a LEFT JOIN Actividad_Habilidad as h ON a.id = h.actividad";
	
	for($i = 0; $i<count($horario); $i++){
		if($i == 0){
			if($i == count($horario)-1){
				$query = $query." WHERE (a.horario = '".$horario[$i]."')";
			}else{
				$query = $query." WHERE (a.horario = '".$horario[$i]."'";
			}
		}else{
			if($i == count($horario)-1){
				$query = $query." OR a.horario = '".$horario[$i]."')";
			}else{
				$query = $query." OR a.horario = '".$horario[$i]."'";
			}
			
		}
	}
	
	for($i = 0; $i<count($habilidades_tipo); $i++){
		if($i == 0){
			if($i == count($habilidades_tipo)-1){
				$query = $query." AND (h.habilidad = '".$habilidades_tipo[$i]['habilidad']."')";
			}else{
				$query = $query." AND (h.habilidad = '".$habilidades_tipo[$i]['habilidad']."'";
			}
		}else{
			if($i == count($habilidades_tipo)-1){
				$query = $query." OR h.habilidad = '".$habilidades_tipo[$i]['habilidad']."')";
			}else{
				$query = $query." OR h.habilidad = '".$habilidades_tipo[$i]['habilidad']."'";
			}
			
		}
	}
	
	$result = mysqli_query($conexion, $query);
	$actividades = Array();
	
	
	if(mysqli_num_rows($result)!=0){
		while($row = mysqli_fetch_assoc($result)){
			$lista[] = $row;
		}
	}
	
	// ACTIVIDADES QUE COINICDEN EN HORARIO Y UN ÝMBITO
	
	$query = "SELECT DISTINCT a.ID, a.Titulo FROM Actividad AS a LEFT JOIN Actividad_Habilidad as h ON a.id = h.actividad";
	
	for($i = 0; $i<count($horario); $i++){
		if($i == 0){
			if($i == count($horario)-1){
				$query = $query." WHERE (a.horario = '".$horario[$i]."')";
			}else{
				$query = $query." WHERE (a.horario = '".$horario[$i]."'";
			}
		}else{
			if($i == count($horario)-1){
				$query = $query." OR a.horario = '".$horario[$i]."')";
			}else{
				$query = $query." OR a.horario = '".$horario[$i]."'";
			}
			
		}
	}
	
	for($i = 0; $i<count($habilidades_ambito); $i++){
		if($i == 0){
			if($i == count($habilidades_ambito)-1){
				$query = $query." AND (h.habilidad = '".$habilidades_ambito[$i]['habilidad']."')";
			}else{
				$query = $query." AND (h.habilidad = '".$habilidades_ambito[$i]['habilidad']."'";
			}
		}else{
			if($i == count($habilidades_ambito)-1){
				$query = $query." OR h.habilidad = '".$habilidades_ambito[$i]['habilidad']."')";
			}else{
				$query = $query." OR h.habilidad = '".$habilidades_ambito[$i]['habilidad']."'";
			}
			
		}
	}
	
	$result = mysqli_query($conexion, $query);
	$actividades = Array();
	
	
	if(mysqli_num_rows($result)!=0){
		while($row = mysqli_fetch_assoc($result)){
			$lista[] = $row;
		}
	}
	
	if(count($lista)==0){
		echo 'No hay coincidencias.';
	}else{
		foreach($lista as $a){
			echo $a['Titulo'];
		}
	}
	

}*/
?>
<?php
	
include_once '../../database_conn.php';

function callAPI($method, $url, $data){
   $curl = curl_init();

   switch ($method){
      case "POST":
         curl_setopt($curl, CURLOPT_POST, 1);
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         break;
      case "PUT":
         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
         break;
      default:
         if ($data)
            $url = sprintf("%s?%s", $url, http_build_query($data));
   }

   // OPTIONS:
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
   ));
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

   // EXECUTE:
   $result = curl_exec($curl);
   if(!$result){die("Connection Failure");}
   curl_close($curl);
   return $result;
}

function authenticateUMA($user, $password){
	
	$get_data = callAPI('GET', 'http://idumamockup-env.3mca2qexfx.eu-central-1.elasticbeanstalk.com/getuser/'.$user.'/'.$password, false);
	$response = json_decode($get_data, true);
	
	$user_info = Array();
	$exists = $response['situation'];
	
	if($exists == 'PRESENT'){
		$user_info['nombre'] = $response['nombre'];
		$user_info['primerApellido'] = $response['primerApellido'];
		$user_info['segundoApellido'] = $response['segundoApellido'];
		$user_info['userEmail'] = $response['userEmail'];
		$user_info['categoryName'] = $response['categoryName']; 
		$user_info['courses'] = $response['courses'];
	}else{
		$user_info['nombre'] = NULL;
	}
	
	return $user_info;
}

function authenticateONG($user, $password){
	$datos = Array();
	$conexion = conexion();
        
    $query = "select * from ONG where email='".$_POST['email']."' and  password='".$_POST['password']."'";
    
    if($resultado = mysqli_query($conexion, $query)){
        if(mysqli_num_rows($resultado)>0){
	        $datos = mysqli_fetch_assoc($resultado);
	        $datos['categoryName'] = 'ONG';
        }else{
	        $datos['email'] = NULL;
        }
    }
    
    return $datos;
	
}

function isFirstLogin($datos){
	$isFirstLogin = true;
	
	$conexion = conexion();
	
	if($datos['categoryName'] == "ONG"){
		$query = "SELECT * FROM ONG WHERE email='".$datos['userEmail']."' AND firstAccess=0";
	}else{
		$query = "SELECT * FROM UMA WHERE email='".$datos['userEmail']."'";
	}
	
	$resultado = mysqli_query($conexion, $query);
	
	if(mysqli_num_rows($resultado)==0){
		$isFirstLogin = true;
	}else{
		$isFirstLogin = false;
	}
	
	return $isFirstLogin;
}

function firstLoginUMA($datos){
	
	$conexion = conexion();
	$query = "INSERT INTO UMA(email, nombre, apellido1, apellido2, tipo) VALUES ('".$datos['userEmail']."', '".$datos['nombre']."', '".$datos['primerApellido']."', '".$datos['segundoApellido']."', '".$datos['categoryName']."')";
	mysqli_query($conexion, $query);
	
	for($i = 0; $i<count($datos['courses']); $i++){
		$query = "INSERT INTO Usuario_Asignatura(usuario, asignatura) VALUES ('".$datos['userEmail']."', '".$datos['courses'][$i]['name']."')";
		mysqli_query($conexion, $query);
	}

}

function firstLoginONG($email){
	$conexion = conexion();
	$query = "UPDATE ONG SET firstAccess = 0 WHERE email='".$email."'";
	mysqli_query($conexion, $query);
	
}
	
?>
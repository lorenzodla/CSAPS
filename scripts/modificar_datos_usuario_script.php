<?php
    include_once('../../../database_conn.php');
    $conexion = conexion();

    //foto
    /*NOTA PARA ALGUIEN DEL FUTURO:
    *   si el if da verdadero se usa $archivo porque despues voy a transformar eso en $fichero
    *   si da falso, uso $fichero porque es lo que voy a poner en el $query :)
    */


    //datos
    $dni = $_POST['dni'];
    $facultad = $_POST['facultad'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['ubicacion'];

    //Checkboxes activas
    $ambitos = $_POST['ambitos']; //Array
    $tipos = $_POST['tipos']; //Array

    //Obtenidos de campos ocultos
    $usuario = $_POST['usuario'];
    
    //Subir Archivo, si el caso

    ///////////
    $file = $_FILES['archivo']['tmp_name'];
    $filename = $_FILES['archivo']['name'];
    //parse Binary
    
    
    if($file) {
        $file=mysqli_real_escape_string($conexion, file_get_contents($_FILES['archivo']['tmp_name']));
        $query = "UPDATE UMA SET DNI='".$dni."', facultad='".$facultad."', telefono='".$telefono."', direccion='".$direccion."', picture = '".$fichero."' where email='".$usuario."'";
    } else {
        $query = "UPDATE UMA SET DNI='$dni', facultad='$facultad', telefono='$telefono', direccion='$direccion' where email='$usuario'";
    }

    //Ahora actualizo el usuario pero no las preferencias
   mysqli_query($conexion,$query);

   $queryAmbitos = "SELECT nombre FROM Habilidades WHERE Tipo=0";
   $queryTipos = "SELECT nombre FROM Habilidades WHERE Tipo=1";

   if ($resultado = mysqli_query($conexion, $queryAmbitos)) {
    $datos = mysqli_fetch_assoc($resultado);

        for ($i=0; $i<count($datos); $i++){
            $query = "DELETE FROM Alumno_Habilidad WHERE alumno = '".$usuario."'";
            mysqli_query($conexion,$query);
        }
   }

   if ($resultado = mysqli_query($conexion, $queryTipos)) {
    $datos = mysqli_fetch_assoc($resultado);

        for ($i=0; $i<count($datos); $i++){
            $query = "DELETE FROM Alumno_Habilidad WHERE alumno = '".$usuario."'";
            mysqli_query($conexion,$query);
        }
   }

    //Escribir SQL para insertar los ambitos
        for($j = 0; $j < count($ambitos);$j++){
            $query = "INSERT INTO Alumno_Habilidad(alumno,habilidad) VALUES('".$usuario."','".$ambitos[$j]."')";
            mysqli_query($conexion,$query);
        
    }
    

   //Escribir SQL para insertar los tipos
        for($j = 0; $j < count($tipos);$j++){
            $query = "INSERT INTO Alumno_Habilidad(alumno,habilidad) VALUES('".$usuario."','".$tipos[$j]."')";
            mysqli_query($conexion,$query);
    }

    echo "<script>
    window.location.assign('http://csaps.alphaduck.software/perfil.php');
    </script>";
    
    

    //Fin del script
?>
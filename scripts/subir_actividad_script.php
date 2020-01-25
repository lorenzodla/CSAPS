<?php
    include_once('../../../database_conn.php');
    $conexion = conexion();
    //1ª Columna
    $titulo = $_POST['titulo'];
    $numParticipantes = $_POST['participantes'];
    $horasDia = $_POST['horasDia'];
    $descripcion = $_POST['descripcion'];
    /*NOTA PARA ALGUIEN DEL FUTURO:
    *   si el if da verdadero se usa $archivo porque despues voy a transformar eso en $fichero
    *   si da falso, uso $fichero porque es lo que voy a poner en el $query :)
    */
    if($_FILES['archivo']['size'] > 0){ //CAMPO OPCIONAL
        $archivo = $_FILES['archivo']; 
    }else{
        $fichero = NULL;
    }
    

    //2ª Columna
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFinalizacion = $_POST['fechaFinalizacion'];
    $horario = $_POST['horario'];

    //Checkboxes
    $ambitos = $_POST['ambitos']; //Array
    $tipos = $_POST['tipos']; //Array

    //Obtenidos de campos ocultos
    $organizacion = $_POST['organizacion'];

    //Subir Archivo, si el caso
    if($archivo != NULL){
        $dir_subida="../csaps_user_files/".$organizacion."/"; //Carpeta donde se va a subir el fichero

        if (!file_exists($dir_subida)) { //Crearla por si no exixte
            mkdir($dir_subida, 0777, true);
        }

        $fichero = $dir_subida.basename($archivo['name']);

        move_uploaded_file($archivo['tmp_name'], $fichero);
    }

    //Escribir SQL
    //Faltan los campos que no se recogen del formulario, pero queda más limpios ponerlos por defecto en la BD que aquí
    $query = "INSERT INTO Actividad
                (Titulo, descripcion, propuestaPor, fechaInicio, fechaFin, horario, participantes, horasDia, archivo)
            VALUES ('$titulo', '$descripcion', '$organizacion', '$fechaInicio', 
                    '$fechaFinalizacion', '$horario',$numParticipantes,$horasDia,'$fichero')";

    //Ahora inserto la actividad (Sin preferencias yet)
   mysqli_query($conexion,$query);

    //Ahora, para insertar las preferencias, necesito el id de la actividad.
    $query = "SELECT max(ID) AS 'ID' FROM Actividad";

    $result = mysqli_query($conexion,$query);
    $id = mysqli_fetch_assoc($result)['ID'];

    //Escribir SQL para insertar los ambitos
    for($i = 0; $i < count($ambitos);$i++){
        $query = "INSERT INTO Actividad_Habilidad(actividad,habilidad)
                    VALUES($id,'$ambitos[$i]')";
        mysqli_query($conexion,$query);
    }

    //Escribir SQL para insertar los tipos
    for ($i = 0; $i < count($tipos); $i++) {
        $query = "INSERT INTO Actividad_Habilidad(actividad,habilidad)
                        VALUES($id,'$tipos[$i]')";
        mysqli_query($conexion, $query);
    }

    //Ahora muestro el pop - up
    echo "<script>
            alert('La actividad ha sido propuesta. Por favor espera a que un gestor la revise.');
            window.location.assign('http://csaps.alphaduck.software/principal_ong.php');
        </script>";
    

    //Fin del script
    //NOTA para quien lea esto: Es lo mismo de antes, 
    //pero ahora esta limpito y no es codigo spaguetti, 
    //por eso he encontrado el error y ya funciona :)
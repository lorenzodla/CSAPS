<?php
include_once('../../../database_conn.php');

//Parámetros ocultos
$id = $_POST['id'];

//Fila extra
$tipo = $_POST['clasificacion'];

if (isset($_POST['Aceptar'])) {
    //Si el gestor ha pulsado aceptar, yo le mando el id y el tipo de actividad a otro script y ya el que se las averigue :)
    header("location: aceptar_actividad.php?id=$id&tipo=$tipo");
}

if(isset($_POST['Denegar'])){
    //Si el gestor ha pulsado denegar, igual que antes.
    header("location: denegar_actividad.php?id=$id");
}

$conexion = conexion();

//1ª Columna
$titulo = $_POST['titulo'];
$numParticipantes = $_POST['participantes'];
$horasDia = $_POST['horasDia'];
$descripcion = $_POST['descripcion'];
//En este caso el archivo no se puede modificar (No me quiero calentar la cabeza, gracias :)

//2ª Columna
$fechaInicio = $_POST['fechaInicio'];
$fechaFinalizacion = $_POST['fechaFinalizacion'];
$horario = $_POST['horario'];

//Checkboxes
$ambitos = $_POST['ambitos']; //Array
$tipos = $_POST['tipos']; //Array

//Tampoco se puede cambiar el organizador de la actividad
//Si estas leyendo esto y no sabes por que pone tampoco es porque he copiado este del script de subir actividad :)

//No se modifican los archivos

//Escribir SQL
// Aceptada se queda en 0 porque esto es modificar
//Se pone a 1 el bit de modificado
//No se puede cambiar el organizador
//El proyecto ya si eso se asigna después en el aceptar
//revisada a 1, que no vale pa mucho pero weno

$query = "UPDATE Actividad
          SET Titulo='$titulo', tipo='$tipo', descripcion='$descripcion',  
              modificado = 1, revisada = 1, fechaInicio = '$fechaInicio', 
              fechaFin = '$fechaFinalizacion', horario='$horario', 
              participantes = '$numParticipantes', horasDia='$horasDia'
          WHERE ID = $id";

//Ahora actualizo la actividad (Sin preferencias yet)
mysqli_query($conexion, $query);

//El id ya lo tengo

//Para no liar mucho la cosa, quito todas las preferencias y los ambitos y los meto de nuevo
$query = "DELETE FROM Actividad_Habilidad WHERE actividad = $id";
mysqli_query($conexion,$query);

//Escribir SQL para insertar los ambitos
for ($i = 0; $i < count($ambitos); $i++) {
    $query = "INSERT INTO Actividad_Habilidad(actividad,habilidad)
                    VALUES($id,'$ambitos[$i]')";
    mysqli_query($conexion, $query);
}

//Escribir SQL para insertar los tipos
for ($i = 0; $i < count($tipos); $i++) {
    $query = "INSERT INTO Actividad_Habilidad(actividad,habilidad)
                        VALUES($id,'$tipos[$i]')";
    mysqli_query($conexion, $query);
}

//Ahora muestro el pop - up
//Ahora depende del tipo de la actividad, entonces hay 3 pop ups

if($tipo == "Voluntariado"){
    echo "<script>
            alert('Se han propuesto las modificaciones. En caso de que la organizacion las acepte, la actividad se publicara');
            window.location.assign('http://csaps.alphaduck.software/principal_gestor.php');
    </script>";
}else if ($tipo == "Docencia"){
    echo "<script>
            alert('Se han propuesto las modificaciones. En caso de que la organizacion las acepte, debera asignar una asignatura a la actividad');
            window.location('http://csaps.alphaduck.software/principal_gestor.php');
    </script>";
}else{
    echo "<script>
            alert('Se han propuesto las modificaciones. En caso de que la organización las acepte, debera asignar un profesor a la actividad');
            window.location('http://csaps.alphaduck.software/principal_gestor.php');
    </script>";
}


    //Fin del script
    //NOTA para quien lea esto: Es lo mismo de antes, 
    //pero ahora esta limpito y no es codigo spaguetti, 
    //por eso he encontrado el error y ya funciona :)

?>
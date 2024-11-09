<?php
require("conexion.php");
$regex = '/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+(?:\s[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+)+$/';
$nombre = $_POST['nombre'] ?? NULL;
$dni = $_POST['dni'] ?? NULL;
$obra_social = $_POST['obrasocial'] ?? NULL;
$especialidad = $_POST['especialidad'] ?? NULL;
//valido los datos que recibo desde el formulario
if (preg_match($regex, $nombre) && strlen($nombre) > 60  || $dni >99999999 || $dni < 100000
    || $obra_social == 0 || $obra_social == NULL || $especialidad == 0 || $especialidad == null) {
    echo json_encode(["success" => false, "message" => "Hay datos erroneos y/o incompletos, reviselos por favor."]);
} else {
    try {

            $registrar_solicitud = $conn->prepare("INSERT INTO solicitudes(nombre,dni, 
            obra_social,especialidad) VALUES (:nombre, :dni, :obra_social,:especialidad)");
            $registrar_solicitud->bindParam(':especialidad', $especialidad);
            $registrar_solicitud->bindParam(':obra_social', $obra_social);
            $registrar_solicitud->bindParam(':dni',$dni );
            $registrar_solicitud->bindParam(':nombre', $nombre);
            $registrar_solicitud->execute();
          // Retornar los datos en formato JSON
          header('Content-Type: application/json');
          echo json_encode(["success" => true, "message" => "Solicitud registrada con exito."]);
      
    } catch (PDOException $e) {
          echo json_encode(['error' => $e->getMessage().$id_municipio.$cant_habitantes.$descripcion]);
    }
      

}


?>
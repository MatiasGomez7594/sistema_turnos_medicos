<?php
require("conexion.php");

try {
    $sql = "
SELECT 
id,
nombre
FROM especialidades;";
    // Preparar la declaración
    $stmt = $conn->prepare($sql);
    // Ejecutar la consulta
    $stmt->execute();
    // Obtener todos los resultados
    $especialidades = $stmt->fetchAll(PDO::FETCH_ASSOC);


    // Retornar los datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($especialidades);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}


?>
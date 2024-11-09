<?php
require("conexion.php");

try {
    $sql = "
SELECT 
id,
nombre
FROM obras_sociales;";
    // Preparar la declaración
    $stmt = $conn->prepare($sql);
    // Ejecutar la consulta
    $stmt->execute();
    // Obtener todos los resultados
    $obras_sociales = $stmt->fetchAll(PDO::FETCH_ASSOC);


    // Retornar los datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($obras_sociales);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}


?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "turnos";

try{
    $conn = new PDO("mysql:host=".$servername.";dbname=".$db.";charset=utf8", $username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//setea para que los errores se manden como excepciones

}catch(PDOException $e) { //e de exception si falla no se pudo conectar

    echo"fallo la conexion:" . $e->getMessage();
} 
?>
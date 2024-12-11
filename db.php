<?php
$host = 'localhost'; //Direccion del servidor de base de datos
$dbname = 'nasa'; //Nombre de la base de datos en este caso nasa
$user = 'admin'; // Credencial de acceso
$pasword = 'abc123'; //Credencial de acceso

try{
    // Se usa PDO(PHP Data Objects) para conectar a la base de datos
    $pdo = new PDO("mysql:host=$host;dbname=$dbname, $user, $password");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Asegura que cualquier error en la base de datos sea lanzado como una excepcion
}catch (PDOException $e){ //Muestra un mensaje que detiene la ejecucion
    die("Error al conectar con la base de datos: " .$e->getMessage());
}
?>
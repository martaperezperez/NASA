<?php
include 'db.php';
include 'nasa_api.php'; //Funciones para interactuar con la API para obtener imagen del dia, datos de asteroides cercanos, limites de peticiones restantes
session_start();

if(!isset($_SESSION['user'])){ //Verificar si el usuario esta autenticado
    header('Location: login.php');
    exit;
}
//Llama a funciones para obtener datos de la API
$image_data = get_nasa_image($_SESSION['token']);
$asteroid_data = get_asteroids($_SESSION['token']);
$api_limit = get_api_limit($_SESSION['token']);
?>

<!DOCTYPE html>
<html>
<head>
        <title>Pagina principal NASA</title>
</head>
<body>
    <h1>Foto del Día</h1>
    <img src="<?= $image_data['url']?>" alt="Imagen del Día">
    <p><?= $image_data['title']?></p>
    <p><?= $image_data['explanation']?></p>
    <a href="download_image.php?url=<?= $image_data['url']?>">Descargar Imagen</a>

    <h2>Asdteroides cercanos</h2>
    <p>Total detectados: <?=$asteroid_data['count']?></p>
    <p>Amenazas: <?=$asteroid_data['threat_count']?></p>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Diametro (km)</th>
            <th>Velocidad (km/s)</th>
            <th>Distancia (lunas)</th>
        </tr>
        <?php foreach ($asteroid_data['threats'] as $asteroid): ?>
        <tr>
            <td><?= $asteroid['name']?></td>
            <td><?= $asteroid['diameter_km']?></td>
            <td><?= $asteroid['speed_kms']?></td>
            <td><?= $asteroid['distance_lunar']?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Estado de la API</h2>
    <p>Quedan <?=$api_limit?>peticiones.</p>

    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>
<?php
function get_nasa_image($token){
    $api_url = "https://api.nasa.gov/planetary/apod?api_key=" .$token;

    $response = file_get_contents($api_url);
    if($response === FALSE) {
        die("Error al obtener la imagen del día");
    }
    $data = json_decode($response, true);
    return [
        'url' => $data['url'],
        'title' => $data['title'],
        'explanation' => $data['explanation']
    ];
}
function get_asteroids($token){
    $date = date('Y-m-d'); //Fecha actual
    $api_url = "https://api.nasa.gov/neo/rest/v1/feed?start_date=$date&end_date=$date&api_key=" .$token;

    $response = file_get_contents($api_url);
    if($response === FALSE){
        die("Eroor al obtener los datos de asteroides");
    }

    $data = json_decode($response, true);

    $threats = [];
    foreach ($data['near_earth_objects'][$date]as $asteroid){
        if ($asteroid['is_potentially_hazardous_asteroid']){
            $threats[]=[
                'name' => $asteroid['name'],
                'diameter_km' => $asteroid['estimated_diameter']['kilometers']['estimated_diameter_max'],
                'speed_kms' => $asteroid['close_approach_data'][0]['relative_velocity']['kilometers_per_second'],
                'distance_lunar' => $asteroid['close_approach_data'][0]['miss_distance']['lunar']
            ];
        }
    }
    return [
        'count' => $data['element_count'],
        'threat_count' => count($threats),
        'threats' => $threats
    ];
}

function get_api_limit($token){
    $api_url = "https://api.nasa.gov/planetary/apod?api_key=" . $token;

    $headers = get_headers($api_url, 1);
    if(!isset($headers['X-RateLimit-Remaining'])){
        return "No se puedo obtener el limite de la API";
    }
    return $headers['X-RateLimit-Remaning'];
}
?>
<?php

$url = 'http://csgobackpack.net/api/GetItemsList/v2?no_details=true&currency=EUR';
/*$url= 'http://csgobackpack.net/api/GetItemPrice/?currency=EUR&id=AK-47%20|%20Wasteland%20Rebel%20(Battle-Scarred)&time=7&icon=1';*/

$options = [
    'http' => [
        'method' => 'GET',
    ],
];

$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);

// Vérifiez si la requête a réussi
if ($response === FALSE) {
    die('Erreur lors de la requête HTTP');
}

// Affiche la réponse
//print_r(json_decode($response));
$jsonDecoded = json_decode($response, true);
echo '<pre>' . json_encode($jsonDecoded, JSON_PRETTY_PRINT) . '</pre>';


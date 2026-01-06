<?php
header('Content-Type: application/json');

$url = "https://api.nekosia.cat/api/v1/images/random?count=20";
$response = file_get_contents($url);

echo $response;

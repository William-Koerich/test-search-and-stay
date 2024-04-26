<?php
require_once 'Database.php';

$conn = new Database();

function getCoordinatesFromCEP($cep)
{
    $cep = str_replace('-', '', $cep);
    $url = "https://www.cepaberto.com/api/v3/cep?cep={$cep}";

    $cep_aberto_token = getenv('CEP_ABERTO_TOKEN');

    $headers = array(
        'Authorization: Token token=' . $cep_aberto_token,
        'Content-Type: application/json'
    );

    $options = array(
        'http' => array(
            'header' => implode("\r\n", $headers),
            'method' => 'GET'
        )
    );

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    if ($response === false) {
        return false;
    }

    $data = json_decode($response, true);

    if (isset($data['latitude']) && isset($data['longitude'])) {
        return array('latitude' => $data['latitude'], 'longitude' => $data['longitude']);
    } else {
        return json_encode(array('error' => "Erro ao obter o retorno da api cep aberto"));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cep_origem']) && isset($_POST['cep_destino'])) {
    $cep_origem = $_POST['cep_origem'];
    $cep_destino = $_POST['cep_destino'];

    $coordinates_origem = getCoordinatesFromCEP($cep_origem);
    $coordinates_destino = getCoordinatesFromCEP($cep_destino);

    if ($coordinates_origem && $coordinates_destino) {
        $lat1 = $coordinates_origem['latitude'];
        $lon1 = $coordinates_origem['longitude'];
        $lat2 = $coordinates_destino['latitude'];
        $lon2 = $coordinates_destino['longitude'];

        $distance = DistanceCalculator::calculateDistance($lat1, $lon1, $lat2, $lon2);
        $stmt = $conn->prepare('INSERT INTO distances (cep_origem, cep_destino, distancia,data_cadastro) VALUES (?, ?, ?, ?)');
        $cep = $cep_origem;
        $cep_dest = $cep_destino;
        $data_cadastro = date("Y-m-d H:i:s");
        $stmt->execute([$cep_origem, $cep_destino, $distance, $data_cadastro]);

    } else {
        return json_encode(array('error' => "Erro ao obter coordenadas dos CEPs."));
    }
} else {
    json_encode(array('error' => "Erro ao obter coordenadas dos CEPs."));
}



<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distance;


class CalculateDistanceController extends Controller
{
    public function getCoordinatesFromCEP($cep)
    {
        try {
            $cep = str_replace('-', '', $cep);
            $url = "https://www.cepaberto.com/api/v3/cep?cep={$cep}";
            $request = curl_init();
            curl_setopt($request, CURLOPT_HTTPHEADER, array('Authorization: Token token=' . getenv('CEP_ABERTO_TOKEN')));
            curl_setopt($request, CURLOPT_URL, $url);
            curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($request, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($request, CURLOPT_CUSTOMREQUEST, 'GET'); // Certifique-se de usar GET, pois POST não é o método correto aqui.
            $file_contents = curl_exec($request);
            curl_close($request);

            $data = json_decode($file_contents, true); // Convertendo JSON em array associativo
            if (!$data || isset($data['error'])) {
                return false; // Retornar false se a resposta não conter dados válidos
            }
            return $data; // Retorna o array de dados
        } catch (Exception $e) {
            return false; // Tratamento de exceção retorna false
        }
    }

    private function calculateHaversineDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // Raio da Terra em quilômetros

        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lon1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lon2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }

    public function calculateDistance(Request $request)
    {
        $cepOrigem = $request->cep_origem;
        $cepDestino = $request->cep_destino;

        $coordsOrigem = $this->getCoordinatesFromCEP($cepOrigem);
        $coordsDestino = $this->getCoordinatesFromCEP($cepDestino);

        if (!$coordsOrigem || !$coordsDestino) {
            return redirect()->back()->with('error', 'Invalid CEP'); // Redirecionar de volta com mensagem de erro
        }

        $distance = $this->calculateHaversineDistance(
            $coordsOrigem['latitude'], $coordsOrigem['longitude'],
            $coordsDestino['latitude'], $coordsDestino['longitude']
        );

        Distance::create([
            'cep_origem' => $cepOrigem,
            'cep_destino' => $cepDestino,
            'distancia' => $distance,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return view('calculate_distance_form', ['distancia' => $distance]); // Retornar para a mesma página com o resultado do cálculo
    }
    public function showForm()
    {
        return view('calculate_distance_form');
    }
}


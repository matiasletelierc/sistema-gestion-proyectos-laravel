<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class UFService
{
    private $apiUrl = 'https://mindicador.cl/api/uf';

    public function getCurrentUFValue()
    {
        try {
            // Cache por 1 hora
            return Cache::remember('uf_value', 3600, function () {
                $response = Http::get($this->apiUrl);
                
                if ($response->successful()) {
                    $data = $response->json();
                    $latest = $data['serie'][0];
                    
                    return [
                        'value' => number_format($latest['valor'], 2),
                        'date' => $latest['fecha'],
                        'raw_value' => $latest['valor']
                    ];
                }
                
                throw new \Exception('Error al obtener datos de la API');
            });
        } catch (\Exception $e) {
            return [
                'value' => 'No disponible',
                'date' => date('Y-m-d'),
                'error' => $e->getMessage()
            ];
        }
    }
}

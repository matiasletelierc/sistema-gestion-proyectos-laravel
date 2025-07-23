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
            // Cache por 1 hora con key única por día
            $cacheKey = 'uf_value_' . date('Y-m-d');
            
            return Cache::remember($cacheKey, 3600, function () {
                $response = Http::timeout(15)
                    ->retry(3, 100)
                    ->withHeaders([
                        'User-Agent' => 'Laravel UF Service/1.0',
                        'Accept' => 'application/json'
                    ])
                    ->get($this->apiUrl);
                
                if ($response->successful()) {
                    $data = $response->json();
                    
                    if (isset($data['serie']) && count($data['serie']) > 0) {
                        $latest = $data['serie'][0];
                        $valor = floatval($latest['valor']);
                        
                        // Validar que el valor sea razonable (entre 25000 y 50000)
                        if ($valor < 25000 || $valor > 50000) {
                            throw new \Exception('Valor UF fuera del rango esperado: ' . $valor);
                        }
                        
                        return [
                            'value' => $valor,
                            'formatted_value' => number_format($valor, 2, ',', '.'),
                            'currency_format' => '$' . number_format($valor, 2, ',', '.'),
                            'date' => $latest['fecha'],
                            'source' => 'mindicador.cl',
                            'cached_at' => now()->toISOString(),
                            'success' => true
                        ];
                    }
                }
                
                throw new \Exception('No se encontraron datos válidos en la API de mindicador.cl');
            });
        } catch (\Exception $e) {
            // Intentar obtener el último valor válido del cache
            $lastValidValue = Cache::get('uf_last_valid_value');
            
            if ($lastValidValue) {
                return array_merge($lastValidValue, [
                    'error' => 'Usando último valor conocido: ' . $e->getMessage(),
                    'success' => false,
                    'is_cached' => true
                ]);
            }
            
            // Valor de respaldo actualizado (valor típico actual)
            $fallbackValue = 39000.00;
            
            $fallbackData = [
                'value' => $fallbackValue,
                'formatted_value' => number_format($fallbackValue, 2, ',', '.'),
                'currency_format' => '$' . number_format($fallbackValue, 2, ',', '.'),
                'date' => date('Y-m-d'),
                'source' => 'valor_respaldo',
                'error' => 'Servicio no disponible: ' . $e->getMessage(),
                'success' => false,
                'is_fallback' => true
            ];
            
            return $fallbackData;
        }
    }

    public function saveLastValidValue($data) 
    {
        if ($data['success'] ?? false) {
            Cache::put('uf_last_valid_value', $data, 86400); // 24 horas
        }
    }
}

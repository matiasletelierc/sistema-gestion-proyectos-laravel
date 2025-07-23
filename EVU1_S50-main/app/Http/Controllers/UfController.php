<?php

namespace App\Http\Controllers;

use App\Services\UFService;
use Illuminate\Http\Request;

class UfController extends Controller
{
    protected $ufService;

    public function __construct(UFService $ufService)
    {
        $this->ufService = $ufService;
    }

    public function getCurrentValue()
    {
        try {
            $ufData = $this->ufService->getCurrentUFValue();
            
            // Guardar último valor válido si es exitoso
            if ($ufData['success'] ?? false) {
                $this->ufService->saveLastValidValue($ufData);
            }
            
            return response()->json($ufData);
            
        } catch (\Exception $e) {
            return response()->json([
                'value' => 0,
                'currency_format' => 'No disponible',
                'error' => 'Error al obtener datos de UF: ' . $e->getMessage(),
                'success' => false
            ], 500);
        }
    }

    public function getUf()
    {
        $ufData = $this->ufService->getCurrentUFValue();
        
        return response()->json($ufData);
    }

    public function showUfPage()
    {
        try {
            $ufData = $this->ufService->getCurrentUFValue();
            
            // Guardar último valor válido si es exitoso
            if ($ufData['success'] ?? false) {
                $this->ufService->saveLastValidValue($ufData);
            }
            
            return view('uf.index', compact('ufData'));
            
        } catch (\Exception $e) {
            return view('uf.index', [
                'ufData' => [
                    'value' => 0,
                    'currency_format' => 'No disponible',
                    'error' => 'Error al obtener datos de UF: ' . $e->getMessage(),
                    'success' => false
                ]
            ])->with('notification', [
                'type' => 'error',
                'title' => 'Error UF',
                'message' => 'No se pudo obtener el valor de la UF. Intente nuevamente más tarde.',
                'duration' => 6000
            ]);
        }
    }
}

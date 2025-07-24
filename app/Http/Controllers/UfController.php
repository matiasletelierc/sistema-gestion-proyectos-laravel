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
        $ufData = $this->ufService->getCurrentUFValue();
        
        return response()->json($ufData);
    }
}

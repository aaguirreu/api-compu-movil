<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Transaccion;

class TransaccionController extends Controller
{
    public function index()
    {
        $transacciones = Transaccion::all();
        return response()->json($transacciones);
    }
}

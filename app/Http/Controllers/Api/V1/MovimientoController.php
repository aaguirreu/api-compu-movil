<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Movimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovimientoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cuentas = $user->cuentas()->with('movimientos')->get();

        return response()->json($cuentas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'cuenta_id' => 'required|exists:cuentas,id',
            'tipo' => 'required|integer',
            'monto' => 'required|integer',
            'descripcion' => 'nullable|string',
        ]);

        $movimiento = Movimiento::create($request->all());

        return response()->json($movimiento, 201);
    }
}

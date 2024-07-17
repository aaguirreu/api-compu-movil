<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Banco;
use Illuminate\Http\Request;

class BancoController extends Controller
{
    public function index()
    {
        return response()->json(Banco::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $banco = Banco::create($request->all());

        return response()->json($banco, 201);
    }

    public function show(Banco $banco)
    {
        return response()->json($banco);
    }

    public function update(Request $request, Banco $banco)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $banco->update($request->all());

        return response()->json($banco);
    }

    public function destroy(Banco $banco)
    {
        $banco->delete();

        return response()->json(['message' => 'Banco deleted successfully']);
    }
}

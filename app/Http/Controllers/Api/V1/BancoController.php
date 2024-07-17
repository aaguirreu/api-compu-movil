<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Banco;
use Illuminate\Http\Request;

class BancoController extends Controller
{
    public function index()
    {
        $bancos = Banco::all();
        return response()->json($bancos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'email_id' => 'required|exists:emails,id',
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
            'user_id' => 'required|exists:users,id',
            'email_id' => 'required|exists:emails,id',
            'nombre' => 'required|string|max:255',
        ]);

        $banco->update($request->all());
        return response()->json($banco);
    }

    public function destroy(Banco $banco)
    {
        $banco->delete();
        return response()->json(null, 204);
    }
}

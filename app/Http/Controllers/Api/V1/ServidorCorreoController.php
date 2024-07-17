<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\ServidorCorreo;
use Illuminate\Http\Request;

class ServidorCorreoController extends Controller
{
    public function index()
    {
        return response()->json(ServidorCorreo::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'protocol' => 'required|string|max:255',
            'host' => 'required|string|max:255',
            'port' => 'required|string|max:255',
            'encryption' => 'required|string|max:255',
        ]);

        $servidorCorreo = ServidorCorreo::create($request->all());

        return response()->json($servidorCorreo, 201);
    }

    public function show(ServidorCorreo $servidorCorreo)
    {
        return response()->json($servidorCorreo);
    }

    public function update(Request $request, ServidorCorreo $servidorCorreo)
    {
        $request->validate([
            'protocol' => 'required|string|max:255',
            'host' => 'required|string|max:255',
            'port' => 'required|string|max:255',
            'encryption' => 'required|string|max:255',
        ]);

        $servidorCorreo->update($request->all());

        return response()->json($servidorCorreo);
    }

    public function destroy(ServidorCorreo $servidorCorreo)
    {
        $servidorCorreo->delete();

        return response()->json(['message' => 'Servidor de correo deleted successfully']);
    }
}

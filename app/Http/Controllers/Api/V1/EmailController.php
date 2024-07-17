<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Email;
use App\Models\ServidorCorreo;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index()
    {
        return response()->json(Email::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'protocol' => 'required|string|max:255',
            'host' => 'required|string|max:255',
            'port' => 'required|max:255',
            'encryption' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:emails',
            'password' => 'required|string|max:255',
        ]);

        // Verificar si existe el servidor
        $servidorCorreo = $this->getCorreo($request);

        // Crear un nuevo registro de email con el ID del servidor
        $email = Email::create([
            'servidor_id' => $servidorCorreo->id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            ]);

        return response()->json($email, 201);
    }

    public function show(Email $email)
    {
        if ($email->servidorCorreo) {
            return response()->json([
                'id' => $email->id,
                'protocol' => $email->servidorCorreo->protocol,
                'host' => $email->servidorCorreo->host,
                'port' => $email->servidorCorreo->port,
                'encryption' => $email->servidorCorreo->encryption,
                'email' => $email->email,
            ]);
        } else {
            return response()->json([
                'id' => $email->id,
                'email' => $email->email,
            ]);
        }
    }

    public function update(Request $request, Email $email)
    {
        $request->validate([
            'protocol' => 'required|string|max:255',
            'host' => 'required|string|max:255',
            'port' => 'required|max:255',
            'encryption' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:emails,email,' . $email->id,
            'password' => 'required|string|max:255',
        ]);

        // Verificar si existe el servidor
        $servidorCorreo = $this->getCorreo($request);

        // Actualizar el registro del email con el ID del servidor
        $email->update([
            'servidor_id' => $servidorCorreo->id,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return response()->json($email);
    }

    public function destroy(Email $email)
    {
        $email->delete();

        return response()->json(['message' => 'Email deleted successfully']);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getCorreo(Request $request)
    {
        $servidorCorreo = ServidorCorreo::where([
            ['protocol', $request->protocol],
            ['host', $request->host],
            ['port', $request->port],
            ['encryption', $request->encryption]
        ])->first();

        // Si no existe, crear un nuevo registro
        if (!$servidorCorreo) {
            $servidorCorreo = ServidorCorreo::create([
                'protocol' => $request->protocol,
                'host' => $request->host,
                'port' => $request->port,
                'encryption' => $request->encryption,
            ]);
        }
        return $servidorCorreo;
    }
}

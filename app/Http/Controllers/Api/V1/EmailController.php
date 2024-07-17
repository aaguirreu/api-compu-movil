<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index()
    {
        $emails = Email::all();
        return response()->json($emails);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        $email = Email::create($request->all());
        return response()->json($email, 201);
    }

    public function show(Email $email)
    {
        return response()->json($email);
    }

    public function update(Request $request, Email $email)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        $email->update($request->all());
        return response()->json($email);
    }

    public function destroy(Email $email)
    {
        $email->delete();
        return response()->json(null, 204);
    }
}

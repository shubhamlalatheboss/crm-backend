<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return Client::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email'
        ]);

        $client = Client::create($request->only('name', 'email'));
        return response()->json($client, 201);
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email'
        ]);

        $client->update($request->only('name', 'email'));
        return response()->json($client);
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return response()->json(['message' => 'Client deleted successfully.']);
    }
}

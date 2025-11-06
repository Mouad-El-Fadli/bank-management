<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::orderBy('nom')->paginate(10);
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'nullable|email|unique:clients,email',
            // Supprimé: 'telephone' => 'nullable|string|max:20',
            // Supprimé: 'cin' => 'nullable|string|max:50'
        ]);

        Client::create($validated);

        return redirect()->route('clients.index')
                         ->with('success', 'Client créé avec succès!');
    }

    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'nullable|email|unique:clients,email,' . $client->id,
            // Supprimé: 'telephone' => 'nullable|string|max:20',
            // Supprimé: 'cin' => 'nullable|string|max:50'
        ]);

        $client->update($validated);

        return redirect()->route('clients.index')
                         ->with('success', 'Client mis à jour avec succès!');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')
                         ->with('success', 'Client supprimé avec succès!');
    }
}
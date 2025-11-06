<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompteController extends Controller
{
    public function index()
    {
        $comptes = Compte::with('client')->orderBy('created_at', 'desc')->paginate(10);
        return view('comptes.index', compact('comptes'));
    }

    public function create()
    {
        $clients = Client::orderBy('nom')->get();
        return view('comptes.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'RIB' => 'required|string|size:20|unique:comptes,RIB',
            'solde' => 'required|numeric|min:0|max:1000000',
            'client_id' => 'required|exists:clients,id'
        ]);

        try {
            DB::beginTransaction();

            $compte = Compte::create([
                'RIB' => $validated['RIB'],
                'solde' => $validated['solde'],
                'client_id' => $validated['client_id'],
                'date_ouverture' => now(),
                'statut' => 'actif'
            ]);

            DB::commit();

            return redirect()->route('comptes.index')
                ->with('success', 'Compte créé avec succès!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Erreur: ' . $e->getMessage());
        }
    }

    public function show(Compte $compte)
    {
        $compte->load('client');
        return view('comptes.show', compact('compte'));
    }

    public function edit(Compte $compte)
    {
        $clients = Client::orderBy('nom')->get();
        return view('comptes.edit', compact('compte', 'clients'));
    }

    public function update(Request $request, Compte $compte)
    {
        $validated = $request->validate([
            'RIB' => 'required|string|size:20|unique:comptes,RIB,' . $compte->id,
            'solde' => 'required|numeric|min:0|max:1000000',
            'client_id' => 'required|exists:clients,id',
            'statut' => 'required|in:actif,inactif,bloque'
        ]);

        $compte->update($validated);

        return redirect()->route('comptes.index')
            ->with('success', 'Compte mis à jour avec succès!');
    }

    public function destroy(Compte $compte)
    {
        $compte->delete();
        return redirect()->route('comptes.index')
            ->with('success', 'Compte supprimé avec succès!');
    }
}
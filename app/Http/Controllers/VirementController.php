<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Compte; // Vérifiez que le modèle Compte existe

class VirementController extends Controller
{
    public function index()
    {
        // Affiche la liste des virements
        return view('virements.index');
    }

    public function create()
    {
        // Affiche le formulaire de virement
        return view('virements.create');
    }

    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'compte_source_id' => 'required|exists:comptes,id',
            'compte_destinataire_id' => 'required|exists:comptes,id|different:compte_source_id',
            'montant' => 'required|numeric|min:0.01',
        ]);

        $montant = $validatedData['montant'];

        try {
            DB::beginTransaction();

            $compteSource = Compte::findOrFail($validatedData['compte_source_id']);
            $compteDestinataire = Compte::findOrFail($validatedData['compte_destinataire_id']);

            // Vérification du solde
            if ($compteSource->solde < $montant) {
                DB::rollBack();
                return back()->withInput()->withErrors(['montant' => 'Solde insuffisant pour effectuer ce virement.']);
            }

            // Débit et crédit
            $compteSource->solde -= $montant;
            $compteSource->save();

            $compteDestinataire->solde += $montant;
            $compteDestinataire->save();

            // Optionnel : enregistrement d’une trace du virement
            // Virement::create([...]);

            DB::commit();

            return redirect()->route('virements.index')
                ->with('success', 'Virement effectué avec succès !');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['system' => 'Une erreur interne est survenue. Veuillez réessayer.']);
        }
    }
}

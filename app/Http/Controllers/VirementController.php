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
        $comptes = Compte::with('client')->get();
        return view('virements.create', compact('comptes'));
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

            // Générer le PDF
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('virements.receipt', [
                'source' => $compteSource,
                'destination' => $compteDestinataire,
                'montant' => $montant,
                'date' => now()->format('d/m/Y H:i:s')
            ]);

            // Sauvegarder temporairement ou retourner le flux
            // Pour simplifier, on redirige avec un lien de téléchargement en session ou on télécharge direct
            // Mais comme c'est une requête POST, on ne peut pas télécharger direct et rediriger.
            // On va stocker les infos en session pour le téléchargement.
            
            session()->put('last_virement', [
                'source_id' => $compteSource->id,
                'destination_id' => $compteDestinataire->id,
                'montant' => $montant,
                'date' => now()
            ]);

            return redirect()->route('virements.index')
                ->with('success', 'Virement effectué avec succès !')
                ->with('download_receipt', true);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['system' => 'Une erreur interne est survenue: ' . $e->getMessage()]);
        }
    }

    public function downloadReceipt()
    {
        if (!session()->has('last_virement')) {
            return redirect()->route('virements.index')->with('error', 'Aucun reçu disponible.');
        }

        $data = session('last_virement');
        $source = Compte::with('client')->find($data['source_id']);
        $destination = Compte::with('client')->find($data['destination_id']);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('virements.receipt', [
            'source' => $source,
            'destination' => $destination,
            'montant' => $data['montant'],
            'date' => $data['date']->format('d/m/Y H:i:s')
        ]);

        return $pdf->download('recu_virement_' . time() . '.pdf');
    }
}
